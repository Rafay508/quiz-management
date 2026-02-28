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
            'started_at' => now(),
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

        return view('front.take-quiz', compact('attempt', 'quiz', 'questions'));
    }
}
