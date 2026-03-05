<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;

class HomeController extends Controller
{
    /**
     * Public Web
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function login()
    {
        return redirect()->route('login');
    }

    public function index()
    {
        $featured_quizzes = Quiz::withCount('quizAttempts')->inRandomOrder()->with('category')->get();

        return view('front.index', compact('featured_quizzes'));
    }

    public function quizIndex()
    {
        return view('front.quizzes');
    }

    public function takeQuizIndex()
    {
        return view('front.take-quiz');
    }

    public function quizDetail($id)
    {
        $quiz = Quiz::with('category')->withCount('questions')->find($id);

        return view('front.quiz-details', compact('quiz'));
    }
}
