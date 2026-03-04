<?php

namespace App\Http\Controllers\Front;

// use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\GradingScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\UserAnswer;

class QuizAttemptController extends Controller
{
    /**
     * Store a new quiz attempt (from quiz details page)
     */
    public function store(Request $request, $quiz_id)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'studentId' => 'required|string|max:50',
            'agreeInstructions' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create quiz attempt
        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz_id,
            'name' => $request->fullName,
            'email' => $request->email,
            'phone' => $request->phone,
            'student_id' => $request->studentId,
            'status' => 'in_progress',
            'start_time' => now(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('quiz.take', $attempt->id);
    }

    /**
     * Show the take quiz page
     */
    public function show($attempt_id)
    {
        $attempt = QuizAttempt::find($attempt_id);

        if (!session()->has('quiz') || !session()->has('questions')) {
            $quiz = Quiz::find($attempt->quiz_id);
            $questions = Question::whereQuizId($attempt->quiz_id)
                ->select('id', 'quiz_id', 'question_text', 'marks')
                ->with(['options' => function ($query) {
                    $query->select('id', 'question_id', 'option_text');
                }])
                ->when($quiz->random_questions_count > 0, function ($query) use ($quiz) {
                    $query->inRandomOrder()
                          ->limit($quiz->random_questions_count);
                }, function ($query) {
                    $query->inRandomOrder();
                })
                ->get();

            session([
                'quiz' => $quiz,
                'questions' => $questions,
            ]);
        }   

        // Always load from session
        $quiz = session('quiz');
        $questions = session('questions');

        // Calculate timer data
        $startTime = $attempt->start_time;
        $durationMinutes = $quiz->duration_minutes;
        $endTime = $startTime->copy()->addMinutes($durationMinutes);
        $remainingSeconds = max(0, now()->diffInSeconds($endTime, false));

        return view('front.take-quiz', compact('attempt', 'quiz', 'questions', 'startTime', 'endTime', 'remainingSeconds'));
    }

    public function submit(Request $request, $attempt_id)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Get attempt
            $attempt = QuizAttempt::findOrFail($attempt_id);

            // Get questions from session (same as shown in the quiz)
            if (!session()->has('questions')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Quiz session expired. Please start the quiz again.',
                    'errors' => []
                ], 422);
            }

            $questions = session('questions');
            $quiz = session('quiz');

            $totalQuestions = $questions->count();
            
            // Safety check
            if ($totalQuestions == 0 || $quiz->total_marks == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid quiz configuration.',
                    'errors' => []
                ], 422);
            }
            
            $marksPerQuestion = $quiz->total_marks / $totalQuestions;

            $score = 0;
            $correct = 0;
            $wrong = 0;
            $attempted = 0;

            // Process each question
            foreach ($questions as $question) {
                $selectedOptionId = $request->input("answers.{$question->id}");

                // Count attempted questions
                if ($selectedOptionId) {
                    $attempted++;
                }

                $correctOption = QuestionOption::where('question_id', $question->id)
                                    ->where('is_correct', 1)
                                    ->first();

                $isCorrect = false;
                $marksObtained = 0;

                if ($selectedOptionId && $correctOption) {
                    if ($correctOption->id == $selectedOptionId) {
                        $isCorrect = true;
                        $marksObtained = $marksPerQuestion;
                        $score += $marksPerQuestion;
                        $correct++;
                    } else {
                        $wrong++;
                    }
                } else {
                    // Question not attempted or no correct option found
                    if ($selectedOptionId) {
                        $wrong++;
                    }
                }

                // Save user answer
                UserAnswer::create([
                    'quiz_attempt_id'   => $attempt_id,
                    'question_id'       => $question->id,
                    'selected_option_id'=> $selectedOptionId,
                    'is_correct'        => $isCorrect,
                    'marks_obtained'    => $marksObtained,
                ]);
            }

            // Calculate percentage
            $percentage = $quiz->total_marks > 0 ? ($score / $quiz->total_marks) * 100 : 0;
            $isPassed = $score >= $quiz->pass_marks;

            // Get reward based on percentage from grading scheme
            $rewardAmount = 0;
            $gradingScheme = GradingScheme::active()
                ->where('min_percentage', '<=', $percentage)
                ->where('max_percentage', '>=', $percentage)
                ->first();

            if ($gradingScheme) {
                $rewardAmount = $gradingScheme->reward_amount;
            }

            // Update attempt with all data
            $attempt->update([
                'status'          => 'completed',
                'end_time'        => now(),
                'score'           => $score,
                'percentage'      => $percentage,
                'is_passed'       => $isPassed,
                'total_questions' => $totalQuestions,
                'reward_amount'   => $rewardAmount,
                'payment_status'  => 'pending',
            ]);

            // Return success JSON response
            return response()->json([
                'status' => 'success',
                'data' => [
                    'total_questions' => $totalQuestions,
                    'attempted' => $attempted,
                    'correct' => $correct,
                    'wrong' => $wrong,
                    'score' => round($score, 2),
                    'percentage' => round($percentage, 2),
                    'reward' => round($rewardAmount, 2),
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while submitting the quiz.',
                'errors' => []
            ], 500);
        }
    }
}
