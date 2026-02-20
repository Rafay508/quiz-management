<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
      
            $user = Socialite::driver('facebook')->user();
       
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
