@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Liste des Médecins</h1>
        <!-- Bouton ouverture modale ajout -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedecinModal">
            <i class="bi bi-person-plus"></i> Nouveau Médecin
        </button>
    </div>

    <!-- Table des médecins -->
    <div class="table-responsive">
        <table class="table table-striped align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Spécialité</th>
                    <th>Expérience</th>
                    <th>Biographie</th>
                    <th>Utilisateur</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medecins as $medecin)
                <tr>
                    <td>
                        @if ($medecin->photo_url)
                            <img src="{{ $medecin->photo_url }}" class="rounded-circle" width="50" height="50">
                        @else
                            <span class="text-muted">Sans photo</span>
                        @endif
                    </td>
                    <td>{{ $medecin->nom }}</td>
                    <td>{{ $medecin->prenom }}</td>
                    <td>{{ $medecin->specialite->nom ?? 'Non spécifiée' }}</td>
                    <td>{{ $medecin->annees_experience ?? '-' }} ans</td>
                    <td>{{ Str::limit($medecin->biographie, 40, '...') }}</td>
                    <td>{{ $medecin->utilisateur->nom ?? 'Non associé' }}</td>
                    <td class="text-center">
                        <!-- Bouton ouverture modale édition -->
                        <button class="btn btn-sm btn-outline-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editMedecinModal{{ $medecin->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal Edition -->
                <div class="modal fade" id="editMedecinModal{{ $medecin->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content shadow-lg">
                            <div class="modal-header bg-warning text-white">
                                <h5 class="modal-title">Modifier le médecin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('medecins.update', $medecin) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nom</label>
                                            <input type="text" name="nom" class="form-control"
                                                value="{{ $medecin->nom }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Prénom</label>
                                            <input type="text" name="prenom" class="form-control"
                                                value="{{ $medecin->prenom }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Spécialité</label>
                                            <select name="specialite_id" class="form-select" required>
                                                @foreach($specialites as $specialite)
                                                    <option value="{{ $specialite->id }}"
                                                        {{ $medecin->specialite_id == $specialite->id ? 'selected' : '' }}>
                                                        {{ $specialite->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Années d’expérience</label>
                                            <input type="number" name="annees_experience" class="form-control"
                                                value="{{ $medecin->annees_experience }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Biographie</label>
                                            <textarea name="biographie" class="form-control">{{ $medecin->biographie }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Photo (URL)</label>
                                            <input type="text" name="photo_url" class="form-control"
                                                value="{{ $medecin->photo_url }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Mettre à jour</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
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

<!-- Modal Ajout -->
<div class="modal fade" id="addMedecinModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nouveau Médecin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('medecins.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Spécialité</label>
                            <select name="specialite_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($specialites as $specialite)
                                    <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Années d’expérience</label>
                            <input type="number" name="annees_experience" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Biographie</label>
                            <textarea name="biographie" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Photo (URL)</label>
                            <input type="text" name="photo_url" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
