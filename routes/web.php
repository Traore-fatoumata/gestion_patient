<?php

use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\StatistiquesController; 

Route::resource('patients', PatientController::class)->names([
    'index' => 'patients.index',
    'create' => 'patients.creation',
    'store' => 'patients.store',
    'show' => 'patients.show',
    'edit' => 'patients.edit',
    'update' => 'patients.update',
]);
Route::get('patients/search', [PatientController::class, 'search'])->name('patients.search');
Route::get('patients/{patient}/transmit', [PatientController::class, 'transmit'])->name('patients.transmit');
Route::get('/', [RendezVousController::class, 'create'])->name('welcome');
Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
Route::get('/rendezvous/create', [RendezVousController::class, 'create'])->name('rendezvous.creation');
Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
Route::get('/rendezvous/{id}', [RendezVousController::class, 'show'])->name('rendezvous.show');
Route::get('/rendezvous/{id}/edit', [RendezVousController::class, 'edit'])->name('rendezvous.modifier');
Route::put('/rendezvous/{id}', [RendezVousController::class, 'update'])->name('rendezvous.update');
Route::delete('/rendezvous/{id}', [RendezVousController::class, 'destroy'])->name('rendezvous.destroy');
// Routes pour les consultations
Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultations.index');
Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultations.create');
Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');
Route::get('/consultations/{id}', [ConsultationController::class, 'show'])->name('consultations.show');
Route::get('/consultations/{id}/edit', [ConsultationController::class, 'edit'])->name('consultations.edit');
Route::put('/consultations/{id}', [ConsultationController::class, 'update'])->name('consultations.update');
Route::delete('/consultations/{id}', [ConsultationController::class, 'destroy'])->name('consultations.destroy');
//Routes pour les consultations
Route::resource('ordonnances', OrdonnanceController::class);
Route::resource('medecins', MedecinController::class)->names([
    'index' => 'medecins.index',
    'create' => 'medecins.creation',
    'store' => 'medecins.store',
    'show' => 'medecins.show',
    'edit' => 'medecins.edit',
    'update' => 'medecins.update',
Route::get('medecins/search', [MedecinController::class, 'search'])->name('medecins.search'),
]);
Route::resource('factures', FactureController::class)->names([
    'index' => 'factures.index',
    'create' => 'factures.create',
    'store' => 'factures.store',
    'show' => 'factures.show',
    'edit' => 'factures.edit',
    'update' => 'factures.update',
]);
Route::get('statistiques', [StatistiquesController::class, 'index'])->name('statistiques.index');