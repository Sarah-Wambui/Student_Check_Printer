<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('auth.password'); // create this view
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8'],
        ]);

        $user = Auth::user();

        // Update password
        $user->password = $request->password; // using your mutator
        $user->save();

        // Logout user
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('employee.login')->with('success', 'Password updated successfully. Please log in again.');
    }

}
