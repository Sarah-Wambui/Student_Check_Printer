<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Check;

class CheckController extends Controller
{
    public function index()
    {
        $checks = Check::with('company', 'user')->latest()->get();
        return view('backend.admin.checks.index', compact('checks'));
    }
}
