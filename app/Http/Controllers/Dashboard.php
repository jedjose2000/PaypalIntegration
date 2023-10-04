<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index(){
        if (Auth::check()) {
            $user = Auth::user();
            return view('dashboard', ['user' => $user]);
        }
        return redirect()->route('home')->withErrors(['login_error' => 'Please login first!'])->withInput();
    }

    public function logout(){
    Auth::logout();
    return redirect()->route('home')->with('success', 'Logout Successful');
    }
}
