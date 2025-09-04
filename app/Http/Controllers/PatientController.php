<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.creation');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'date_naissance' => 'nullable|date',
            'genre' => 'nullable|in:homme,femme,autre',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
            'courriel' => 'nullable|email|max:100|unique:patients,courriel',
            'groupe_sanguin' => 'nullable|string|max:5',
            'antecedents_medicaux' => 'nullable|string',
        ]);

        Patient::create($validated);
        return redirect()->route('patients.index')->with('success', 'Patient ajouté avec succès.');
    }

    public function show(Patient $patient)
    {
        $rendezVous = $patient->rendez_vous()->with('medecin')->get();
        $factures = $patient->factures()->with('rendez_vous.medecin')->get();
        return view('patients.show', compact('patient', 'rendezVous', 'factures'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'date_naissance' => 'nullable|date',
            'genre' => 'nullable|in:homme,femme,autre',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
            'courriel' => 'nullable|email|max:100|unique:patients,courriel,' . $patient->id,
            'groupe_sanguin' => 'nullable|string|max:5',
            'antecedents_medicaux' => 'nullable|string',
        ]);

        $patient->update($validated);
        return redirect()->route('patients.index')->with('success', 'Patient modifié avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $patients = Patient::where('nom', 'LIKE', "%{$query}%")
            ->orWhere('prenom', 'LIKE', "%{$query}%")
            ->orWhere('courriel', 'LIKE', "%{$query}%")
            ->get();
        return view('patients.index', compact('patients'));
    }

    public function transmit(Patient $patient)
    {
        return redirect()->route('patients.index')->with('success', "Dossier de {$patient->nom} transmis.");
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès.');
    }
}