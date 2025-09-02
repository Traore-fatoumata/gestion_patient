<?php
namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class VitrineController extends Controller
{
    public function rendezVous(Request $request)
    {
        $medecins = Medecin::with('specialite')->get();
        return view('vitrine.rendez_vous', compact('medecins'));
    }

    public function storeRendezVous(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'courriel' => 'required|email|max:100',
            'telephone' => 'nullable|string|max:20',
            'medecin_id' => 'required|exists:medecins,id',
            'date_heure' => 'required|date|after:now',
            'raison' => 'nullable|string',
        ]);

        // Créer ou récupérer le patient
        $patient = Patient::firstOrCreate(
            ['courriel' => $validated['courriel']],
            [
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'telephone' => $validated['telephone'],
            ]
        );

        // Créer le rendez-vous
        RendezVous::create([
            'patient_id' => $patient->id,
            'medecin_id' => $validated['medecin_id'],
            'date_heure' => $validated['date_heure'],
            'raison' => $validated['raison'],
            'statut' => 'en_attente',
        ]);

        return redirect()->route('vitrine.rendez_vous')->with('success', 'Rendez-vous soumis avec succès.');
    }
}
