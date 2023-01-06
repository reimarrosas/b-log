<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function signin()
    {
        session()->flash('register_success', 'User registration successful!');
        return view('pages.signin');
    }
}
