<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotMedecin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('medecin')->check()) {
            return redirect()->route('medecin.login'); // route login medecin
        }

        return $next($request);
    }
}
