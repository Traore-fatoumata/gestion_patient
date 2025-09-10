<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medecin;
use App\Models\RendezVous;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiquesController extends Controller
{
    public function index()
    {
        // Nombre total de patients consultés (patients avec au moins une consultation)
        $totalPatients = Consultation::distinct('patient_id')->count('patient_id');
         // Nombre total de médecins (tous)
         $totalMedecins = Medecin::count();

   
    // Nombre total de rendez-vous
    $totalRendezVous = RendezVous::count();

    // ...existing code...
        // Pathologies fréquentes (basé sur la colonne diagnostic de consultations)
        $pathologiesFrequentes = Consultation::select('diagnostic', DB::raw('COUNT(*) as total'))
            ->whereNotNull('diagnostic')
            ->groupBy('diagnostic')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        // Nombre de rendez-vous par médecin
        $rendezVousParMedecin = RendezVous::select('medecins.nom', 'medecins.prenom', DB::raw('COUNT(*) as total_rdv'))
            ->join('medecins', 'rendez_vous.medecin_id', '=', 'medecins.id')
            ->groupBy('medecins.nom', 'medecins.prenom')
            ->orderByDesc('total_rdv')
            ->get();

        return view('statistiques.index', compact('totalPatients', 'pathologiesFrequentes', 'rendezVousParMedecin', 'totalMedecins',
        'totalRendezVous'));
    }
}