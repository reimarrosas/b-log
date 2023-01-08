<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\LogController;
use App\Providers\RouteServiceProvider;
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
    return redirect(RouteServiceProvider::HOME);
});

Route::get('/auth/signup', [SignupController::class, 'signup'])->middleware('guest');
Route::post('/auth/register', [SignupController::class, 'register'])->middleware('guest');

Route::get('/auth/signin', [LoginController::class, 'signin'])->name('signin')->middleware('guest');
Route::post('/auth/login', [LoginController::class, 'login'])->middleware('guest');

Route::post('/auth/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::resource('logbooks', LogbookController::class)->except(['show'])->middleware('auth');

Route::resource('logbooks.logs', LogController::class)->middleware('auth');
