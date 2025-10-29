<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    public function landing()
    {
        return view('school.landing');
    }

    public function login()
    {
        return view('school.login');
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('school.login');
        }
        
        return view('school.dashboard');
    }
}