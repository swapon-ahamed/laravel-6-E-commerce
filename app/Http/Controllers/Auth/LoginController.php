<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyRegistration;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;

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
        $this->middleware('guest')->except('logout');
    }

    /**
    override login function form vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php
    */
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // find user

        $user = User::where('email',$request->email)->first();

        if($user->status == 1){
            //login
            if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password ], $request->remember ))
            {   
                return redirect()->intended(route('index'));

            }else{
                session()->flash('sticky_errors', 'Invalid login');
                return back();
            }
        }else{
            // send him token again
            if(!is_null($user)){
                $user->notify( new VerifyRegistration( $user, $user->remember_token));
                session()->flash('success', 'A new confirmation email sent to your emmail. Please check and active your account');
        return redirect('/');
            }else{
                session()->flash('sticky_errors', 'Please login first.');
                return redirect()->route('login');
            }
            
        }
    }
}
