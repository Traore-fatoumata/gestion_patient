<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'Nom' => 'required|string|max:150',
            'Prenom' =>'required|string|max:200',
            'Sexe'=>'required',
            'Date_de_Naissance' => 'required|date',
            'Adresse' => 'required|max:200|string',
            'Telephone' => 'nullable|max:20',
            'Email' => 'nullable|unique:patients,Email|email|max:100',
            'Profession' => 'nullable|string|max:100',
            'Antecedents_Medicaux' => 'nullable|string',
            'Numero_Dossier' => 'required|unique:patients,Numero_Dossier',
        ]);

        //
        $patient = Patient::create($validated);
        

        return redirect()->route('patients.index')->with('success', 'Patient ajouté avec succès !!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('patients.edit', [
            'patient' => Patient::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    //Mis à jour d'un patient
    public function update(Request $request, Patient $patient)
    {
        //
          $validated = $request->validate([
            'Nom' => 'required|string|max:150',
            'Prenom' =>'required|string|max:200',
            'Sexe'=>'required',
            'Date_de_Naissance' => 'required|date',
            'Adresse' => 'required|max:200|string',
            'Telephone' => 'nullable|max:20',
            'Email' => 'nullable|email|max:100|unique:patients,Email,' . $patient->id,
            'Profession' => 'nullable|string|max:100',
            'Antecedents_Medicaux' => 'nullable|string',
            'Numero_Dossier' => 'required|unique:patients,Numero_Dossier,' . $patient->id,
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Patient mis à jour avec succès !!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $patient = Patient::find($id);
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès !!');
    }
}
