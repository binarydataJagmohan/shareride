<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
     
        protected function authenticated(Request $request, $user)
    {
        if($user->status == "active") {
            return redirect('/dashboard ');
        }
        else if((Auth::user()->mobile_no == '') && (Auth::user()->status == 'pending'))
        {
            return redirect('/welcome/phone');
        }
          else if(($user->dob == "") && (Auth::user()->status == 'pending')){
            return redirect('/details');
        }
        else if(($user->img == "") && (Auth::user()->status == 'pending')){
            return redirect('/profile-upload');
        }
         else if(($user->description == "") && (Auth::user()->status == 'pending')){
            return redirect('/description');
        }
        else if ($user->verify_email == 1 && $user->status == "pending") {
            return redirect('/welcome/phone');
        }
        else if ($user->status == "pending") {
            return redirect('/welcome/email');
        } else {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
    }
     
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
