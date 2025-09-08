<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with(['patient', 'rendezVous.medecin'])->get();
        $patients = Patient::all();
        $rendezVous = RendezVous::all();
        return view('factures.index', compact('factures','patients'));
    }

    public function create()
    {
        $patients = Patient::all();
        $rendezVous = RendezVous::with('patient', 'medecin')->get();
        return view('factures.create', compact('patients', 'rendezVous'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string|unique:factures,numero',
            'patient_id' => 'required|exists:patients,id',
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
            'montant' => 'required|numeric|min:0',
            'date_emission' => 'required|date',
            'statut' => 'required|in:en_attente,payee,annulee',
            'description' => 'nullable|string',
        ]);

        Facture::create($validated);
        return redirect()->route('factures.index')->with('success', 'Facture ajoutée avec succès.');
    }

    public function show(Facture $facture)
    {
        $facture->load(['patient', 'rendezVous.medecin']);
        return view('factures.show', compact('facture'));
    }

    public function edit(Facture $facture)
    {
        $patients = Patient::all();
        $rendezVous = RendezVous::with('patient', 'medecin')->get();
        return view('factures.edit', compact('facture', 'patients', 'rendezVous'));
    }

    public function update(Request $request, Facture $facture)
    {
        $validated = $request->validate([
            'numero' => 'required|string|unique:factures,numero,' . $facture->id,
            'patient_id' => 'required|exists:patients,id',
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
            'montant' => 'required|numeric|min:0',
            'date_emission' => 'required|date',
            'statut' => 'required|in:en_attente,payee,annulee',
            'description' => 'nullable|string',
        ]);

        $facture->update($validated);
        return redirect()->route('factures.index')->with('success', 'Facture modifiée avec succès.');
    }
}