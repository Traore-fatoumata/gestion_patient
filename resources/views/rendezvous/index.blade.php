@extends('layouts.app')
@section( 'content')
<section class="container mx-auto py-12">
    <h1 class="text-4xl font-bold mb-6">Gestion des Rendez-vous</h1>

    <!-- Bouton Ajouter 
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#ajouterRdvModal">
        Ajouter un Rendez-vous
    </button>
    -->

    <!-- Recherche -->
    <form method="GET" action="{{ route('rendezvous.index') }}" class="mb-6 d-flex gap-2">
        <input type="text" name="search" placeholder="Recherche par Patient/Médecin" value="{{ request('search') }}" class="form-control">
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tableau des rendez-vous -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Patient</th>
                    <th>Médecin</th>
                    <th>Date/Heure</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rendezVous as $rdv)
                <tr>
                    <td>{{ $rdv->nom_complet}}</td>
                    <td>{{ optional($rdv->medecin)->nom }} {{ optional($rdv->medecin)->prenom }}</td>
                    <td>{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                    <td>{{ ucfirst($rdv->statut) }}</td>
                    <td>
                        <!-- Voir modal -->
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#voirRdvModal{{ $rdv->id }}">Voir</button>

                        <!-- Modifier modal -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modifierRdvModal{{ $rdv->id }}">Modifier</button>

                        <!-- Supprimer -->
                        <form action="{{ route('rendezvous.destroy', $rdv->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce rendez-vous ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Voir -->
                <div class="modal fade" id="voirRdvModal{{ $rdv->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Détails du Rendez-vous</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Patient:</strong> {{ optional($rdv->patient)->nom }} {{ optional($rdv->patient)->prenom }}</p>
                                <p><strong>Médecin:</strong> {{ optional($rdv->medecin)->nom }} {{ optional($rdv->medecin)->prenom }}</p>
                                <p><strong>Date/Heure:</strong> {{ $rdv->date_heure->format('d/m/Y H:i') }}</p>
                                <p><strong>Motif:</strong> {{ $rdv->raison ?? 'Non spécifié' }}</p>
                                <p><strong>Statut:</strong> {{ ucfirst($rdv->statut) }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Modifier -->
                <div class="modal fade" id="modifierRdvModal{{ $rdv->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('rendezvous.update', $rdv->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Modifier le Rendez-vous</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Patient</label>
                                        <select name="patient_id" class="form-select" required>
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}" {{ $rdv->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->nom }} {{ $patient->prenom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Médecin</label>
                                        <select name="medecin_id" class="form-select" required>
                                            @foreach($medecins as $medecin)
                                                <option value="{{ $medecin->id }}" {{ $rdv->medecin_id == $medecin->id ? 'selected' : '' }}>
                                                    {{ $medecin->nom }} {{ $medecin->prenom }} ({{ optional($medecin->specialite)->nom ?? 'Non spécifié' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date/Heure</label>
                                        <input type="datetime-local" name="date_heure" value="{{ $rdv->date_heure->format('Y-m-d\TH:i') }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Motif</label>
                                        <textarea name="raison" class="form-control">{{ $rdv->raison }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Statut</label>
                                        <select name="statut" class="form-select" required>
                                            <option value="en_attente" {{ $rdv->statut=='en_attente' ? 'selected':'' }}>En attente</option>
                                            <option value="confirme" {{ $rdv->statut=='confirme' ? 'selected':'' }}>Confirmé</option>
                                            <option value="annule" {{ $rdv->statut=='annule' ? 'selected':'' }}>Annulé</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun rendez-vous trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $rendezVous->links() }}</div>

</section>
@endsection
