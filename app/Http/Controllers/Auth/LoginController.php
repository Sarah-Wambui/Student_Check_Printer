<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login'); // Create this view
    }

    // Handle login request
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($request->only('email', 'password'), $remember)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showEmployeeLoginForm()
    {
        return view('auth.userlogin');
    }


    public function employeeLogin(Request $request)
    {
        $request->validate([
            'phone_cell' => ['required'],
            'password' => ['required'],
        ]);

        // Attempt login using phone_number
        if (Auth::attempt($request->only('phone_cell', 'password'))) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Ensure only employees use this login
            if ($user->role !== 'employee') {
                Auth::logout();
                throw ValidationException::withMessages([
                    'phone_number' => 'You are not authorized to log in here.',
                ]);
            }

            return redirect()->route('user.dashboard');
        }

        throw ValidationException::withMessages([
            'phone_number' => 'The provided credentials do not match our records.',
        ]);
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
