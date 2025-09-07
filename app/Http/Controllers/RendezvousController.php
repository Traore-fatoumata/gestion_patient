<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Medecin;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $rendezVous = RendezVous::with(['medecin'])
            ->when($search, function ($query, $search) {
                $query->whereHas('medecin', function ($q) use ($search) {
                    $q->where('nom', 'like', "%$search%")
                      ->orWhere('prenom', 'like', "%$search%");
                });
            })
            ->paginate(10);

        $medecins = Medecin::all();

        return view('rendezvous.index', compact('rendezVous', 'medecins'));
    }

    public function create()
    {
        $medecins = Medecin::all();
        return view('welcome', compact('medecins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'medecin_id' => 'required|exists:medecins,id',
            'email' => 'nullable|email',
            'telephone' => 'required|string|max:20',
            'date_heure' => 'required|date|after:now',
            'raison' => 'nullable|string',
        ]);

        // statut par défaut
        $validated['statut'] = 'en_attente';

        RendezVous::create($validated);

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
        return view('rendezvous.modifier', compact('rendezVous', 'medecins'));
    }

    public function update(Request $request, $id)
    {
        $rendezVous = RendezVous::findOrFail($id);

        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'medecin_id' => 'required|exists:medecins,id',
            'date_heure' => 'required|date|after:now',
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
