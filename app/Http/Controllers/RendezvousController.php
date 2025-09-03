<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $rendezVous = RendezVous::with(['patient', 'medecin'])
            ->when($search, function ($query, $search) {
                $query->whereHas('patient', function ($q) use ($search) {
                    $q->where('nom', 'like', "%$search%")
                      ->orWhere('prenom', 'like', "%$search%");
                })->orWhereHas('medecin', function ($q) use ($search) {
                    $q->where('nom', 'like', "%$search%")
                      ->orWhere('prenom', 'like', "%$search%");
                });
            })
            ->paginate(10);
        return view('rendezvous.index', compact('rendezVous'));
    }

    public function create()
    {
        $patients = Patient::all();
        $medecins = Medecin::with('specialite')->get();
        return view('rendezvous.creation', compact('patients', 'medecins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date_heure' => 'required|date|after:now',
            'raison' => 'nullable|string|max:255',
            'statut' => 'required|in:en_attente,confirme,annule',
        ]);

        RendezVous::create($validated);
        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous ajouté avec succès.');
    }

    public function show($id)
    {
        $rendezVous = RendezVous::with(['patient', 'medecin.specialite'])->findOrFail($id);
        return view('rendezvous.show', compact('rendezVous'));
    }

    public function edit($id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $patients = Patient::all();
        $medecins = Medecin::with('specialite')->get();
        return view('rendezvous.modifier', compact('rendezVous', 'patients', 'medecins'));
    }

    public function update(Request $request, $id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date_heure' => 'required|date|after:now',
            'raison' => 'nullable|string|max:255',
            'statut' => 'required|in:en_attente,confirme,annule',
        ]);

        $rendezVous->update($validated);
        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous modifié avec succès.');
    }

    public function destroy($id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $rendezVous->delete();
        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous supprimé avec succès.');
    }
}
