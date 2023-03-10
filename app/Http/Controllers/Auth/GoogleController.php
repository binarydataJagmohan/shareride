<?php

namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

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
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
                if(Auth::user()->status == 'active'){
                   return redirect()->intended('/dashboard');
                }else{
                   return redirect()->intended('/welcome/phone'); 
                }
       
            }else{
                // dd("new");
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'verify_email'=>1,
                     'social_type'=> 'google',
                    'password' => encrypt('12345678')
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('/welcome/phone');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
