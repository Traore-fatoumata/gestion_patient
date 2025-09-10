<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Medecin;
use Illuminate\Http\Request;
use App\Http\Controllers\Patient;
use App\Models\Patient as ModelsPatient;

class RendezVousController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $rendezVous = RendezVous::with(['patient', 'medecin.specialite'])
        ->when($search, function($query, $search) {
            $query->whereHas('patient', function($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                  ->orWhere('prenom', 'like', "%$search%");
            })
            ->orWhereHas('medecin', function($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                  ->orWhere('prenom', 'like', "%$search%");
            });
        })
        ->paginate(10);

    // 🔹 Ajouter patients et medecins
    $patients = ModelsPatient::all();
    $medecins = Medecin::with('specialite')->get();

    return view('rendezvous.index', compact('rendezVous', 'patients', 'medecins'));
}


    public function create()
    {
        $medecins = Medecin::all();
       if (request()->route()->getName() === 'welcome') {
        return view('welcome', compact('medecins'));
    }

    // Sinon, on affiche la page de création de rendez-vous
    return view('rendezvous.creation', compact('medecins'));

    }

    public function store(Request $request)
    {
        $request->validate([
        'nom_complet' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'email' => 'nullable|email',
        'medecin_id' => 'required|exists:medecins,id',
        'date_heure' => 'required|date',
        'raison' => 'nullable|string',
        'statut' => 'required|string',
    ]);

        // statut par défaut
    

         RendezVous::create($request->all());

        return back()->with('success', 'Rendez-vous ajouté avec succès.');
    }

    public function show($id)
    {
        $rendezVous = RendezVous::with(['medecin.specialite'])->findOrFail($id);
        return view('rendezvous.show', compact('rendezVous'));
    }

    public function edit($id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $medecins = Medecin::with('specialite')->get();
        $patients =Patient::all();
        return view('rendezvous.modifier', compact('rendezVous', 'medecins','patients'));
    }
public function update(Request $request, $id)
{
    $rendezVous = RendezVous::findOrFail($id);

    $validated = $request->validate([
         'patient_id'   => 'required|exists:patients,id',
        'nom_complet' => 'required|string|max:255',
        'medecin_id' => 'required|exists:medecins,id',
        'date_heure' => 'required|date',
        'email' => 'nullable|email',
        'telephone' => 'required|string|max:20',
        'raison' => 'nullable|string',
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
