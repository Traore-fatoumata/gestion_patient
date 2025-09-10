<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotPatient
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('patient')->check()) {
            return redirect()->route('patient.login'); // route login patient
        }

        return $next($request);
    }
}
