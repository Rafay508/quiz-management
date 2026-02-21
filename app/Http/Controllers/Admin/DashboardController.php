<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
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
     * Admin Dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Statistics
        $totalQuizzes = Quiz::count();
        $activeQuizzes = Quiz::where('status', 'published')->where('is_published', true)->count();
        $totalQuestions = Question::count();
        $totalUsers = User::count();
        $todayAttempts = QuizAttempt::whereDate('created_at', Carbon::today())->count();

        // Quiz Attempts Chart Data (Last 7 days)
        $attemptsData = [];
        $attemptsLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = QuizAttempt::whereDate('created_at', $date->format('Y-m-d'))->count();
            $attemptsData[] = $count;
            $attemptsLabels[] = $date->format('M d');
        }

        // Popular Categories Chart Data
        $categoriesData = Category::withCount('quizzes')
            ->orderBy('quizzes_count', 'desc')
            ->limit(5)
            ->get();
        $categoryLabels = $categoriesData->pluck('name')->toArray();
        $categoryCounts = $categoriesData->pluck('quizzes_count')->toArray();

        // User Registrations Chart Data (Last 7 days)
        $registrationsData = [];
        $registrationsLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', $date->format('Y-m-d'))->count();
            $registrationsData[] = $count;
            $registrationsLabels[] = $date->format('M d');
        }

        // Recent Quiz Attempts
        $recentAttempts = QuizAttempt::with(['quiz', 'user'])
            ->latest('created_at')
            ->limit(10)
            ->get();

        // Recent User Registrations
        $recentUsers = User::latest('created_at')
            ->limit(10)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalQuizzes',
            'activeQuizzes',
            'totalQuestions',
            'totalUsers',
            'todayAttempts',
            'attemptsData',
            'attemptsLabels',
            'categoryLabels',
            'categoryCounts',
            'registrationsData',
            'registrationsLabels',
            'recentAttempts',
            'recentUsers'
        ));
    }

    public function crm()
    {
        return view('admin.crm');
    }

    public function forms()
    {
        return view('admin.forms');
    }
}
