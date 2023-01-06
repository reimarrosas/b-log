<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function signup()
    {
        return view('pages.signup');
    }

    public function register(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

        User::create($attributes);

        return redirect('auth/signin')->with('register_success', 'User registration successful!');
    }
}
