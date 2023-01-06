<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function signin()
    {
        return view('pages.signin');
    }

    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required|min:8'
        ]);

        if (!auth()->attempt($attributes))
        {
            return back()->withErrors(['login_failure' => 'Email/Password invalid!']);
        }

        return redirect()->intended(RouteServiceProvider::HOME)->with('login_success', 'User login successful!');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/auth/signin');
    }
}
