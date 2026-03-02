<?php

namespace App\Http\Controllers\Front;

// use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Question;
use App\Models\QuestionOption;
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
        $request->validate([
            'answers' => 'required|array',
        ]);

        // echo "<pre>";
        // print_r($request->toArray());
        // echo "</pre>";
        // die();

        // Get attempt with quiz
        $attempt = QuizAttempt::with('quiz.questions.options')
                    ->findOrFail($attempt_id);

        $quiz = $attempt->quiz;
        $questions = $quiz->questions;

        $totalQuestions = $questions->count();
        $marksPerQuestion = $quiz->total_marks / $totalQuestions;

        $score = 0;

        foreach ($questions as $question) {

            $selectedOptionId = $request->input("answers.{$question->id}");

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
                }
            }

            UserAnswer::create([
                'quiz_attempt_id'   => $attempt_id,
                'question_id'       => $question->id,
                'selected_option_id'=> $selectedOptionId,
                'is_correct'        => $isCorrect,
                'marks_obtained'    => $marksObtained,
            ]);
        }

        $percentage = ($score / $quiz->total_marks) * 100;
        $isPassed = $score >= $quiz->pass_marks;

        $attempt->update([
            'status'          => 'completed',
            'end_time'        => now(),
            'score'           => $score,
            'percentage'      => $percentage,
            'is_passed'       => $isPassed,
            'total_questions' => $totalQuestions,
        ]);

        return redirect()->route('quiz.index')
                         ->with('success', 'Quiz submitted successfully!');
    }
}
