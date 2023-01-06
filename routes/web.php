<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Route;

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
    return view('pages.home');
})->middleware('auth');

Route::get('/auth/signup', [SignupController::class, 'signup'])->middleware('guest');
Route::post('/auth/register', [SignupController::class, 'register'])->middleware('guest');

Route::get('/auth/signin', [LoginController::class, 'signin'])->name('signin')->middleware('guest');
Route::post('/auth/login', [LoginController::class, 'login'])->middleware('guest');

Route::post('/auth/logout', [LoginController::class, 'logout'])->middleware('auth');
