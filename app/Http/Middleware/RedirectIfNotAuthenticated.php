<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            if ($guard === 'medecin') {
                return redirect()->route('medecin.login');
            } elseif ($guard === 'patient') {
                return redirect()->route('patient.login');
            } else {
                return redirect()->route('login'); // fallback
            }
        }

        return $next($request);
    }
}
