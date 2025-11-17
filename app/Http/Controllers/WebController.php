<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        return view('website.home');
    }

    public function dashboard()
    {
        return view('layouts.dashboard');
    }
}
