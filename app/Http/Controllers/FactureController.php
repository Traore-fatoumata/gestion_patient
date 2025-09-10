<?php
namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Patient;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with('patient')->get();
        $patients = Patient::all();
        return view('factures.index', compact('factures', 'patients'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('factures.create', compact('patients'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'montant' => 'required|numeric|min:0',
                'date_emission' => 'required|date',
                'statut' => 'required|in:en_attente,payee,annulee',
                'description' => 'nullable|string',
            ]);

            // Générer un numéro unique
            $numero = 'FACT-' . date('Ymd') . '-' . str_pad(Facture::count() + 1, 4, '0', STR_PAD_LEFT);
            $validated['numero'] = $numero;

            Facture::create($validated);

            return redirect()->route('factures.index')->with('success', 'Facture ajoutée avec succès.');
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création de la facture : ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Facture $facture)
    {
        $facture->load('patient');
        return view('factures.show', compact('facture'));
    }

    public function edit(Facture $facture)
    {
        $patients = Patient::all();
        return view('factures.edit', compact('facture', 'patients'));
    }

    public function update(Request $request, Facture $facture)
    {
        try {
            $validated = $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'montant' => 'required|numeric|min:0',
                'date_emission' => 'required|date',
                'statut' => 'required|in:en_attente,payee,annulee',
                'description' => 'nullable|string',
            ]);

            // Conserver le numéro existant
            $validated['numero'] = $facture->numero;

            $facture->update($validated);
            return redirect()->route('factures.index')->with('success', 'Facture modifiée avec succès.');
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la modification de la facture : ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()])->withInput();
        }
    }
}