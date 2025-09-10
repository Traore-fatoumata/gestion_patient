@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-3xl font-bold">Gestion des Consultations</h1>
        <button type="button" class="btn btn-info text-white px-4 py-2 rounded-lg" 
                data-bs-toggle="modal" data-bs-target="#createConsultation">
            Ajouter une Consultation
        </button>
    </div>

    <form method="GET" action="{{ route('consultations.index') }}" class="mb-6 d-flex gap-2">
        <input type="text" name="search" placeholder="Rechercher par patient ou médecin" value="{{ request('search') }}" class="form-control">
        <button type="submit" class="btn btn-info text-white px-4 py-2 rounded-lg">Rechercher</button>
    </form>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive shadow rounded bg-white">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th>Rendez-vous</th>
                    <th>Patient</th>
                    <th>Médecin</th>
                    <th>Date Consultation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($consultations as $consultation)
                    <tr>
                        <td>{{ optional($consultation->rendezVous)->id }}</td>
                        <td>{{ optional($consultation->patient)->nom }} {{ optional($consultation->patient)->prenom }}</td>
                        <td>{{ optional($consultation->medecin)->nom }} {{ optional($consultation->medecin)->prenom }}</td>
                        <td>{{ $consultation->date->format('d/m/Y H:i') }}</td>
                        <td class="d-flex gap-2">
                            <!-- Voir Modal Trigger -->
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#showConsultation{{ $consultation->id }}">
                                Voir
                            </button>

                            <!-- Modifier Modal Trigger -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editConsultation{{ $consultation->id }}">
                                Modifier
                            </button>

                            <!-- Supprimer -->
                            <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" onsubmit="return confirm('Voulez-vous supprimer cette consultation ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Voir -->
                    <div class="modal fade" id="showConsultation{{ $consultation->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Détails de la Consultation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Rendez-vous :</strong> RDV #{{ optional($consultation->rendezVous)->id }}</p>
                                    <p><strong>Patient :</strong> {{ optional($consultation->patient)->nom }} {{ optional($consultation->patient)->prenom }}</p>
                                    <p><strong>Médecin :</strong> {{ optional($consultation->medecin)->nom }} {{ optional($consultation->medecin)->prenom }}</p>
                                    <p><strong>Date et heure :</strong> {{ $consultation->date->format('d/m/Y H:i') }}</p>
                                    <p><strong>Notes :</strong> {{ $consultation->notes ?: 'Aucune note précisée' }}</p>
                                    <p><strong>Diagnostic :</strong> {{ $consultation->diagnostic ?: 'Aucun diagnostic précisé' }}</p>
                                    <p><strong>Traitement :</strong> {{ $consultation->traitement ?: 'Aucun traitement précisé' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Modifier -->
                    <div class="modal fade" id="editConsultation{{ $consultation->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('consultations.update', $consultation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifier la Consultation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="patient_id" class="form-label">Patient</label>
                                            <select name="patient_id" class="form-select" required>
                                                @foreach($patients as $patient)
                                                    <option value="{{ $patient->id }}" {{ $consultation->patient_id == $patient->id ? 'selected' : '' }}>
                                                        {{ $patient->nom }} {{ $patient->prenom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="medecin_id" class="form-label">Médecin</label>
                                            <select name="medecin_id" class="form-select" required>
                                                @foreach($medecins as $medecin)
                                                    <option value="{{ $medecin->id }}" {{ $consultation->medecin_id == $medecin->id ? 'selected' : '' }}>
                                                        {{ $medecin->nom }} {{ $medecin->prenom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Date de consultation</label>
                                            <input type="datetime-local" name="date" value="{{ $consultation->date->format('Y-m-d\TH:i') }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="notes" class="form-label">Notes</label>
                                            <textarea name="notes" class="form-control">{{ $consultation->notes }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="diagnostic" class="form-label">Diagnostic</label>
                                            <textarea name="diagnostic" class="form-control">{{ $consultation->diagnostic }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="traitement" class="form-label">Traitement</label>
                                            <textarea name="traitement" class="form-control">{{ $consultation->traitement }}</textarea>
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
                        <td colspan="5" class="text-center">Aucune consultation</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $consultations->links() }}</div>
</div>

<!-- Modal Ajouter Consultation -->
<div class="modal fade" id="createConsultation" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('consultations.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Ajouter une Consultation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="patient_id" class="form-label">Patient</label>
            <select name="patient_id" class="form-select" required>
              <option value="">Sélectionnez un patient</option>
              @foreach($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->nom }} {{ $patient->prenom }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="medecin_id" class="form-label">Médecin</label>
            <select name="medecin_id" class="form-select" required>
                <option value="">Sélectionnez un médecin</option>
                @foreach($medecins as $medecin)
                    <option value="{{ $medecin->id }}">{{ $medecin->nom }} {{ $medecin->prenom }}</option>
                @endforeach
            </select>
        </div>
          <div class="mb-3">
            <label for="date" class="form-label">Date de consultation</label>
            <input type="datetime-local" name="date" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label for="diagnostic" class="form-label">Diagnostic</label>
            <textarea name="diagnostic" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label for="traitement" class="form-label">Traitement</label>
            <textarea name="traitement" class="form-control"></textarea>
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
