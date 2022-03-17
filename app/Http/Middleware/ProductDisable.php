<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProductDisable
{
    public function handle(Request $request, Closure $next)
    {
        /*if(product() -> disable_at)
        {
            $request->
            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Your account has been disabled, contact the admin');
        }*/
        return $next($request);
    }
}