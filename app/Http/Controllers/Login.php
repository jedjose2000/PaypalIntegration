<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class Login extends Controller 
{
    public function login(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()
                ->route('dashboard');
        }else{
            return redirect()
                ->route('home')
                ->withErrors(['login_error' => 'Incorrect username or password!'])
                ->withInput();
        }
    }
}
