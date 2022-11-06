<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function showLogin(){
        return view('auth.login');
    }

    public function register(){
        
    }


    public function loginAdmin(Request $request){
        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->withErrors(['errors' => 'The provided credentials do not match our records.']);
        }
        
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();  
        return redirect()->route('login');
    }
}
