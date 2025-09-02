<?php
namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\RendezVous;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $consultations = Consultation::with(['patient', 'medecin', 'rendezVous'])
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
        return view('consultations.index', compact('consultations'));
    }

    public function create()
    {
        $rendezVous = RendezVous::with(['patient', 'medecin'])->get();
        return view('consultations.create', compact('rendezVous'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
            'date_consultation' => 'required|date|after:now',
            'notes' => 'nullable|string',
            'diagnostic' => 'nullable|string',
            'traitement' => 'nullable|string',
        ]);

        // Récupérer le rendez-vous pour remplir patient_id et medecin_id
        $rendezVous = RendezVous::findOrFail($validated['rendez_vous_id']);
        $validated['patient_id'] = $rendezVous->patient_id;
        $validated['medecin_id'] = $rendezVous->medecin_id;

        Consultation::create($validated);
        return redirect()->route('consultations.index')->with('success', 'Consultation ajoutée avec succès.');
    }

    public function show($id)
    {
        $consultation = Consultation::with(['patient', 'medecin', 'rendezVous'])->findOrFail($id);
        return view('consultations.show', compact('consultation'));
    }

    public function edit($id)
    {
        $consultation = Consultation::findOrFail($id);
        $rendezVous = RendezVous::with(['patient', 'medecin'])->get();
        return view('consultations.edit', compact('consultation', 'rendezVous'));
    }

    public function update(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);
        $validated = $request->validate([
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
            'date_consultation' => 'required|date|after:now',
            'notes' => 'nullable|string',
            'diagnostic' => 'nullable|string',
            'traitement' => 'nullable|string',
        ]);

        // Mettre à jour patient_id et medecin_id
        $rendezVous = RendezVous::findOrFail($validated['rendez_vous_id']);
        $validated['patient_id'] = $rendezVous->patient_id;
        $validated['medecin_id'] = $rendezVous->medecin_id;

        $consultation->update($validated);
        return redirect()->route('consultations.index')->with('success', 'Consultation modifiée avec succès.');
    }

    public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();
        return redirect()->route('consultations.index')->with('success', 'Consultation supprimée avec succès.');
    }
}