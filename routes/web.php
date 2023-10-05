<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\CreateAccount;
use  App\Http\Controllers\Login;
use  App\Http\Controllers\Dashboard;
use  App\Http\Controllers\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Payment;

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
        $user = Auth::user();
        $pageTitle = "Dashboard";
        return view('dashboard', ['user' => $user] + compact('pageTitle'));
    }
    return view('welcome-page');
})->name('home');

//Dashboard Routes
Route::get('/dashboard', [Dashboard::class,'index'])->name('dashboard');

Route::post('/logout', [Dashboard::class,'logout'])->name('logout');

//Create Account Routes
Route::get('/account', [CreateAccount::class,'index'])->name('account');

Route::post('/create-account', [CreateAccount::class,'create'])->name('create-account');

//Login Routes
Route::post('/login', [Login::class,'login'])->name('login');

//Payment Routes
Route::post('/payment', [Payment::class,'payment'])->name('payment');

Route::get('/payment/success', [Payment::class,'success'])->name('payment-success');

Route::get('/payment/cancelled', [Payment::class,'cancel'])->name('payment-cancelled');

//Orders Routes
Route::get('/orders', [Orders::class,'index'])->name('orders');

Route::get('/viewOrder', [Orders::class,'viewOrder'])->name('viewOrder');



