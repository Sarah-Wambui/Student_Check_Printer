<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        // Remove old tokens (optional)
        $user->tokens()->delete();

        // Create token - set name to include user id or agent if you want
        // lifetime: minutes (e.g. 60 * 24 * 7 = 10080 for 7 days)
        $tokenResult = $user->createToken('web-login');
        $plainTextToken = $tokenResult->plainTextToken;

        // Set token in an HTTP-only cookie
        $cookie = cookie(
            'auth_token',
            $plainTextToken,
            60 * 24 * 7, // minutes -> here 7 days
            '/',                // path
            null,               // domain (null = default)
            config('app.env') !== 'local', // secure: true in non-local
            true,               // httpOnly
            false,              // raw
            'Lax'               // sameSite (Lax is usually fine)
        );

        // Redirect to the intended dashboard based on role
        $redirect = $user->role === 'admin'
            ? route('admin.dashboard')
            : route('user.dashboard');

        return redirect()->intended($redirect)->withCookie($cookie);
    }

    public function logout(Request $request)
    {
        // get token from cookie
        $token = $request->cookie('auth_token');

        if ($token) {
            // delete token (PersonalAccessToken::findToken)
            $request->user()?->currentAccessToken()?->delete();

            // also delete any matching token by value (if user not authenticated yet)
            \Laravel\Sanctum\PersonalAccessToken::findToken($token)?->delete();
        }

        // remove cookie
        $forget = cookie()->forget('auth_token');

        // normal redirect to login
        return redirect('/login')->withCookie($forget);
    }
}
