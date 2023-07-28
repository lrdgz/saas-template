<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate()
    {
        return redirect()->route('home');
    }

    public function register()
    {
        return redirect()->route('home');
    }
}
