<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use App\Models\ElementOrdonnance;
use App\Models\Consultation;
use Illuminate\Http\Request;

class OrdonnanceController extends Controller
{
    /**
     * Afficher la liste des ordonnances
     */
    public function index()
    {
        $ordonnances = Ordonnance::with(['consultation', 'elements'])->latest()->get();
        $consultations = Consultation::all();
        return view('ordonnances.index', compact('ordonnances','consulations'));
    }

    /**
     * Formulaire de création d'une ordonnance
     */
    public function create()
    {
        $consultations = Consultation::all();
        return view('ordonnances.create', compact('consultations'));
    }

    /**
     * Enregistrer une nouvelle ordonnance
     */
    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'date' => 'required|date',
            'instructions' => 'nullable|string',
            'medicament.*' => 'required|string',
            'posologie.*' => 'required|string',
            'duree.*' => 'required|string',
        ]);

        // Création de l'ordonnance
        $ordonnance = Ordonnance::create([
            'consultation_id' => $request->consultation_id,
            'date' => $request->date,
            'instructions' => $request->instructions,
        ]);

        // Ajout des éléments de l’ordonnance
        foreach ($request->medicament as $index => $medicament) {
            ElementOrdonnance::create([
                'ordonnance_id' => $ordonnance->id,
                'medicament' => $medicament,
                'posologie' => $request->posologie[$index],
                'duree' => $request->duree[$index],
            ]);
        }

        return redirect()->route('ordonnances.index')->with('success', 'Ordonnance créée avec succès.');
    }

    /**
     * Afficher une ordonnance en détail
     */
    public function show($id)
    {
        $ordonnance = Ordonnance::with(['consultation', 'elements'])->findOrFail($id);
        return view('ordonnances.show', compact('ordonnance'));
    }

    /**
     * Formulaire d'édition d'une ordonnance
     */
    public function edit($id)
    {
        $ordonnance = Ordonnance::with('elements')->findOrFail($id);
        $consultations = Consultation::all();

        return view('ordonnances.edit', compact('ordonnance', 'consultations'));
    }

    /**
     * Mettre à jour une ordonnance
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'date' => 'required|date',
            'instructions' => 'nullable|string',
            'medicament.*' => 'required|string',
            'posologie.*' => 'required|string',
            'duree.*' => 'required|string',
        ]);

        $ordonnance = Ordonnance::findOrFail($id);

        // Mise à jour de l'ordonnance
        $ordonnance->update([
            'consultation_id' => $request->consultation_id,
            'date' => $request->date,
            'instructions' => $request->instructions,
        ]);

        // Supprimer les anciens éléments et recréer
        $ordonnance->elements()->delete();

        foreach ($request->medicament as $index => $medicament) {
            ElementOrdonnance::create([
                'ordonnance_id' => $ordonnance->id,
                'medicament' => $medicament,
                'posologie' => $request->posologie[$index],
                'duree' => $request->duree[$index],
            ]);
        }

        return redirect()->route('ordonnances.index')->with('success', 'Ordonnance mise à jour avec succès.');
    }

    /**
     * Supprimer une ordonnance
     */
    public function destroy($id)
    {
        $ordonnance = Ordonnance::findOrFail($id);
        $ordonnance->delete();

        return redirect()->route('ordonnances.index')->with('success', 'Ordonnance supprimée avec succès.');
    }
}
