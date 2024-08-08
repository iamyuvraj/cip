<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function login(): string
    {
        return view('login');
    }
    public function register(): string
    {
        return view('register');
    }
    public function dashboard(): string
    {
        return view('dashboard');
    }
}
