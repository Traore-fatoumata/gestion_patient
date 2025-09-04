<?php
namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Specialite;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    public function index()
    {
        $medecins = Medecin::with(['specialite', 'utilisateur'])->get();
        return view('medecins.index', compact('medecins'));
    }

    public function create()
    {
        $specialites = Specialite::all();
        $utilisateurs = Utilisateur::all();
        return view('medecins.creation', compact('specialites', 'utilisateurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'utilisateur_id' => 'nullable|exists:utilisateurs,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite_id' => 'required|exists:specialites,id',
            'biographie' => 'nullable|string',
            'photo_url' => 'nullable|string|max:255',
            'annees_experience' => 'nullable|string|max:255',
        ]);

        Medecin::create($validated);
        return redirect()->route('medecins.index')->with('success', 'Médecin ajouté avec succès.');
    }

    public function show(Medecin $medecin)
    {
        $medecin->load(['specialite', 'utilisateur', 'rendezVous']);
        return view('medecins.show', compact('medecin'));
    }

    public function edit(Medecin $medecin)
    {
        $specialites = Specialite::all();
        $utilisateurs = Utilisateur::all();
        return view('medecins.edit', compact('medecin', 'specialites', 'utilisateurs'));
    }

    public function update(Request $request, Medecin $medecin)
    {
        $validated = $request->validate([
            'utilisateur_id' => 'nullable|exists:utilisateurs,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite_id' => 'required|exists:specialites,id',
            'biographie' => 'nullable|string',
            'photo_url' => 'nullable|string|max:255',
            'annees_experience' => 'nullable|string|max:255',
        ]);

        $medecin->update($validated);
        return redirect()->route('medecins.index')->with('success', 'Médecin modifié avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $medecins = Medecin::where('nom', 'LIKE', "%{$query}%")
            ->orWhere('prenom', 'LIKE', "%{$query}%")
            ->with(['specialite', 'utilisateur'])
            ->get();
        return view('medecins.index', compact('medecins'));
    }
}