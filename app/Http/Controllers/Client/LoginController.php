<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showlogin(){
        return view('client.auth.login',[
            'title' => 'Login'
        ]);
    }

    public function login(Request $request){
        $data = $request->all();
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('client.home');
        }

        return redirect()->route('client.login')->withErrors(['errors' => 'The provided credentials do not match our records.']);

        
    }

    public function logout(){
        Auth::logout();  
        return redirect('/client/home');
    }
}
