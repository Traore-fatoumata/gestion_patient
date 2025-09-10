<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RendezVous;


class PatientAuthController extends Controller
{
    // Middleware pour s'assurer que seul le patient connecté accède
    public function __construct()
    {
        $this->middleware('auth:patient');
    }

    // Afficher le tableau de bord
    public function index()
    {
        $patient = Auth::guard('patient')->user();

        // Ses rendez-vous uniquement
        $rendezVous = RendezVous::where('patient_id', $patient->id)
                                 ->orderBy('date', 'desc')
                                 ->get();

        return view('patient.dashboard', compact('patient', 'rendezVous'));
    }
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.patientLogin');
    }

    // Traiter le login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'telephone' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('patient')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/patient/dashboard');
        }

        return back()->withErrors([
            'telephone' => 'Téléphone ou mot de passe incorrect.',
        ])->onlyInput('telephone');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('patient')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/patient/login');
    }
}
