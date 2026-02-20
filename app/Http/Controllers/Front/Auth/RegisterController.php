<?php

namespace App\Http\Controllers\Front\Auth;

use App\Models\User;
use App\Models\Company;
use App\Http\Controllers\Front\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Models\MetaDetail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $meta = MetaDetail::wherePage('register')->first();

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

        return view('front.auth.register', compact('seoData'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'         => ['required', 'string'],
            'email'        => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password'     => ['required',  'max:191']
            // ,'confirm_password' => ['required',  'same:password']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return $user;
    }
}
