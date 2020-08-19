<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/admin');
        }
        if ($guard == "benharian" && Auth::guard($guard)->check()) {
            return redirect('/benharian');
        }

        if ($guard == "benadventure" && Auth::guard($guard)->check()) {
            return redirect('/benadventure');
        }
        if ($guard == "manajer" && Auth::guard($guard)->check()) {
            return redirect('/manajer');
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
