<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\QuizAttempt;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class QuizAttemptController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of quiz attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Base query with eager loading
        $query = QuizAttempt::with('quiz')
            ->latest('start_time');

        // Apply filters
        $query->byStatus($request->status)
            ->byPassFail($request->is_passed)
            ->byQuiz($request->quiz_id)
            ->byDateRange($request->start_date, $request->end_date)
            ->search($request->search);

        // Get statistics (before pagination)
        $stats = [
            'total_attempts' => QuizAttempt::count(),
            'completed_attempts' => QuizAttempt::where('status', 'completed')->count(),
            'passed_count' => QuizAttempt::where('is_passed', true)->count(),
            'failed_count' => QuizAttempt::where('is_passed', false)->where('status', 'completed')->count(),
        ];

        // Paginate results
        $attempts = $query->paginate(15)->withQueryString();

        // Get quizzes for filter dropdown
        $quizzes = Quiz::orderBy('title')->get();

        return view('admin.quiz-attempts.index', compact('attempts', 'quizzes', 'stats'));
    }

    /**
     * Display the specified quiz attempt.
     *
     * @param  mixed  $quizAttempt
     * @return \Illuminate\Http\Response
     */
    public function show($quizAttempt)
    {
        // Route model binding will provide the QuizAttempt instance
        // Eager load all necessary relationships to avoid N+1 queries
        $quizAttempt->load([
            'quiz.questions.options',
            'userAnswers.question.options',
            'userAnswers.selectedOption'
        ]);

        return view('admin.quiz-attempts.show', compact('quizAttempt'));
    }

    /**
     * Export quiz attempts to CSV.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        // Base query with eager loading
        $query = QuizAttempt::with('quiz')
            ->latest('start_time');

        // Apply same filters as index
        $query->byStatus($request->status)
            ->byPassFail($request->is_passed)
            ->byQuiz($request->quiz_id)
            ->byDateRange($request->start_date, $request->end_date)
            ->search($request->search);

        $attempts = $query->get();

        $filename = 'quiz_attempts_' . Carbon::now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($attempts) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'Attempt ID',
                'Quiz Title',
                'Name',
                'Email',
                'Phone',
                'Student ID',
                'Status',
                'Score',
                'Percentage',
                'Pass/Fail',
                'Total Questions',
                'Total Marks',
                'Start Time',
                'End Time',
                'IP Address'
            ]);

            // Add data rows
            foreach ($attempts as $attempt) {
                fputcsv($file, [
                    $attempt->id,
                    $attempt->quiz->title ?? 'N/A',
                    $attempt->name ?? 'N/A',
                    $attempt->email ?? 'N/A',
                    $attempt->phone ?? 'N/A',
                    $attempt->student_id ?? 'N/A',
                    ucfirst(str_replace('_', ' ', $attempt->status)),
                    $attempt->score ?? '0',
                    $attempt->percentage ?? '0',
                    $attempt->is_passed ? 'Pass' : 'Fail',
                    $attempt->total_questions ?? '0',
                    $attempt->total_marks ?? '0',
                    $attempt->start_time ? $attempt->start_time->format('Y-m-d H:i:s') : 'N/A',
                    $attempt->end_time ? $attempt->end_time->format('Y-m-d H:i:s') : 'N/A',
                    $attempt->ip_address ?? 'N/A'
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
