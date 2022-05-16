<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Disable
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->disable_at)) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Your account has been disabled, contact the admin');
        }

        return $next($request);
    }
}
