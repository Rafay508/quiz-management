<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Front\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MetaDetail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
         * Logged in user should not be able to visit login page, unless logged out
         *
         * It's redirection is managed from App > Http > Middleware > RedirectIfAuthenticated
         */
        $this->middleware('guest')->except('logout');
        //parent::__construct();
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $meta = MetaDetail::wherePage('login')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.auth.login', compact('seoData'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param Request $request
     * @param $user
     */
    public function authenticated(Request $request, $user)
    {
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        /*
         * Here, admin guard is being called by $this->guard()
         */
        $this->guard()->logout();

        // $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // return $request->only($this->username(), 'password');
        return [
            'email'    => $request->{$this->username()},
            'password' => $request->password
        ];
    }
}
