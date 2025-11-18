<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AuthToken
{
    public function handle(Request $request, Closure $next)
    {
        // If already authenticated by some other means, proceed
        if ($request->user()) {
            return $next($request);
        }

        $token = $request->cookie('auth_token');

        if (! $token) {
            return redirect()->route('login');
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (! $accessToken) {
            // invalid token, remove cookie and redirect to login
            $forget = cookie()->forget('auth_token');
            return redirect()->route('login')->withCookie($forget);
        }

        // login the tokenable (user) for this request
        $user = $accessToken->tokenable;
        auth()->login($user);

        return $next($request);
    }
}
