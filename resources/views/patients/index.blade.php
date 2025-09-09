@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Liste des Patients</h1>
        <!-- Bouton ouverture modale ajout -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPatientModal">
            <i class="bi bi-person-plus"></i> Nouveau Patient
        </button>
    </div>

    <!-- Table des patients -->
    <div class="table-responsive bg-white shadow rounded">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date naissance</th>
                    <th>Genre</th>
                    <th>Téléphone</th>
                    <th>Courriel</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->nom }}</td>
                    <td>{{ $patient->prenom }}</td>
                    <td>{{ $patient->date_naissance ? $patient->date_naissance->format('d/m/Y') : '-' }}</td>
                    <td>{{ ucfirst($patient->genre) ?? '-' }}</td>
                    <td>{{ $patient->telephone ?? '-' }}</td>
                    <td>{{ $patient->courriel ?? '-' }}</td>
                    <td>
                        <!-- Voir -->
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewPatientModal{{ $patient->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <!-- Modifier -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPatientModal{{ $patient->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <!-- Supprimer -->
                        <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce patient ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Voir Patient -->
                <div class="modal fade" id="viewPatientModal{{ $patient->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">Détails Patient</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nom :</strong> {{ $patient->nom }}</p>
                                <p><strong>Prénom :</strong> {{ $patient->prenom }}</p>
                                <p><strong>Date Naissance :</strong> {{ $patient->date_naissance ?? '-' }}</p>
                                <p><strong>Genre :</strong> {{ $patient->genre }}</p>
                                <p><strong>Adresse :</strong> {{ $patient->adresse }}</p>
                                <p><strong>Téléphone :</strong> {{ $patient->telephone }}</p>
                                <p><strong>Email :</strong> {{ $patient->courriel }}</p>
                                <p><strong>Groupe sanguin :</strong> {{ $patient->groupe_sanguin }}</p>
                                <p><strong>Antécédents :</strong> {{ $patient->antecedents_medicaux }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Modifier Patient -->
                <div class="modal fade" id="editPatientModal{{ $patient->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title">Modifier Patient</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('patients.update', $patient) }}" method="POST">
                                @csrf @method('PUT')
                                 <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nom</label>
                                        <input type="text" name="nom" value="{{ $patient->nom }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Prénom</label>
                                        <input type="text" name="prenom" value="{{ $patient->prenom }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Date de naissance</label>
                                        <input type="date" name="date_naissance" value="{{ $patient->date_naissance }}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Genre</label>
                                        <select name="genre" class="form-select">
                                            <option value="">Sélectionner</option>
                                            <option value="homme" {{ $patient->genre=='homme' ? 'selected' : '' }}>Homme</option>
                                            <option value="femme" {{ $patient->genre=='femme' ? 'selected' : '' }}>Femme</option>
                                            <option value="autre" {{ $patient->genre=='autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Téléphone</label>
                                        <input type="text" name="telephone" value="{{ $patient->telephone }}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="courriel" value="{{ $patient->courriel }}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Adresse</label>
                                        <textarea name="adresse" class="form-control">{{ $patient->adresse }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Groupe sanguin</label>
                                        <input type="text" name="groupe_sanguin" value="{{ $patient->groupe_sanguin }}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Antécédents médicaux</label>
                                        <textarea name="antecedents_medicaux" class="form-control">{{ $patient->antecedents_medicaux }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button class="btn btn-warning">Mettre à jour</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Ajouter Patient -->
<div class="modal fade" id="createPatientModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nouveau Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date de naissance</label>
                        <input type="date" name="date_naissance" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genre</label>
                        <select name="genre" class="form-select">
                            <option value="">Sélectionner</option>
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="courriel" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <textarea name="adresse" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Groupe sanguin</label>
                        <input type="text" name="groupe_sanguin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Antécédents médicaux</label>
                        <textarea name="antecedents_medicaux" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
