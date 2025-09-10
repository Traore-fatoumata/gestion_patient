<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\StatistiquesController;
use App\Http\Controllers\MedecinAuthController;
use App\Http\Controllers\PatientAuthController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\MedecinDashboardController;

// -------------------------
// ROUTES PUBLIQUES
// -------------------------
Route::get('/', [RendezVousController::class, 'create'])->name('welcome');
Route::post('rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');

// -------------------------
// ROUTES PATIENTS
// -------------------------
Route::prefix('patient')->name('patient.')->group(function () {
    // Login / Logout
    Route::get('login', [PatientAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [PatientAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [PatientAuthController::class, 'logout'])->name('logout');

    // Routes protégées pour patients
    Route::middleware('auth:patient')->group(function () {
        Route::get('dashboard', [PatientController::class, 'index'])->name('dashboard');

        // Gestion des rendez-vous propres au patient
        Route::resource('mes-rendezvous', RendezVousController::class)->names([
            'index' => 'rendezvous.index',
            'create' => 'rendezvous.create',
            'show' => 'rendezvous.show',
            'edit' => 'rendezvous.edit',
            'update' => 'rendezvous.update',
            'destroy' => 'rendezvous.destroy',
        ]);
    });
});

// -------------------------
// ROUTES MEDECINS
// -------------------------
Route::prefix('medecin')->name('medecin.')->group(function () {
    // Login / Logout
    Route::get('login', [MedecinAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [MedecinAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [MedecinAuthController::class, 'logout'])->name('logout');

    // Routes protégées pour médecins
    Route::middleware('auth:medecin')->group(function () {
        Route::get('dashboard', [MedecinController::class, 'index'])->name('dashboard');

        // Gestion des consultations
        Route::resource('consultations', ConsultationController::class);

        // Gestion des patients
        Route::resource('patients', PatientController::class)->names([
            'index' => 'patients.index',
            'create' => 'patients.create',
            'store' => 'patients.store',
            'show' => 'patients.show',
            'edit' => 'patients.edit',
            'update' => 'patients.update',
        ]);
        Route::get('patients/search', [PatientController::class, 'search'])->name('patients.search');
    });
});

// -------------------------
// ROUTES ADMIN / FACTURES / STATISTIQUES
// -------------------------
Route::resource('medecins', MedecinController::class)->names([
    'index' => 'medecins.index',
    'create' => 'medecins.create',
    'store' => 'medecins.store',
    'show' => 'medecins.show',
    'edit' => 'medecins.edit',
    'update' => 'medecins.update',
]);
Route::get('medecins/search', [MedecinController::class, 'search'])->name('medecins.search');

Route::resource('factures', FactureController::class)->names([
    'index' => 'factures.index',
    'create' => 'factures.create',
    'store' => 'factures.store',
    'show' => 'factures.show',
    'edit' => 'factures.edit',
    'update' => 'factures.update',
]);

Route::resource('ordonnances', OrdonnanceController::class);

Route::get('statistiques', [StatistiquesController::class, 'index'])->name('statistiques.index');
