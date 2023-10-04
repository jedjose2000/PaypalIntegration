<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\CreateAccount;
use  App\Http\Controllers\Login;
use  App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        // return view('dashboard', ['user'=>Auth()->user()]);
        $user = Auth::user();
        return view('dashboard', ['user' => $user]);
    }
    return view('welcome-page');
})->name('home');


Route::get('/account', [CreateAccount::class,'index'])->name('account');

Route::get('/dashboard', [Dashboard::class,'index'])->name('dashboard');

Route::post('/logout', [Dashboard::class,'logout'])->name('logout');

Route::post('/create-account', [CreateAccount::class,'create'])->name('create-account');

Route::post('/login', [Login::class,'login'])->name('login');



