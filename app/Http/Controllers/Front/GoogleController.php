<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::whereEmail($user->email)->first();
       
            if($finduser){
                Auth::login($finduser);
      
                return redirect()->intended('/')->with('success', 'Loggedin successfully!');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => encrypt('123456789')
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('/')->with('success', 'Loggedin successfully!');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
