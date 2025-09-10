<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedecinAuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.medecinLogin');
    }

    // Traiter le login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'telephone' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('medecin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/medecin/dashboard');
        }

        return back()->withErrors([
            'telephone' => 'Téléphone ou mot de passe incorrect.',
        ])->onlyInput('telephone');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('medecin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/medecin/login');
    }
}
