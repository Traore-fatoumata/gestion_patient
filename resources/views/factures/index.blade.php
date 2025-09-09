@extends('layouts.app')

@section('content')
<section class="container mx-auto py-12">
    <h1 class="text-3xl font-bold mb-6">Liste des Factures</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Bouton Ajouter -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#ajouterFactureModal">
        Nouvelle Facture
    </button>

    @if($factures->isEmpty())
        <div class="alert alert-info">Aucune facture enregistrée.</div>
    @else
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Numéro</th>
                    <th>Patient</th>
                    <th>Rendez-vous</th>
                    <th>Montant</th>
                    <th>Date d’émission</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factures as $facture)
                <tr>
                    <td>{{ $facture->numero }}</td>
                    <td>{{ $facture->patient->nom }} {{ $facture->patient->prenom }}</td>
                    <td>{{ $facture->rendezVous->date_heure->format('d/m/Y H:i') }} ({{ $facture->rendezVous->medecin->nom }})</td>
                    <td>{{ number_format($facture->montant, 2) }} €</td>
                    <td>{{ $facture->date_emission->format('d/m/Y') }}</td>
                    <td>{{ ucfirst(str_replace('_',' ', $facture->statut)) }}</td>
                    <td>
                        <!-- Voir modal -->
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#voirFactureModal{{ $facture->id }}">Voir</button>
                        <!-- Modifier modal -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modifierFactureModal{{ $facture->id }}">Modifier</button>
                    </td>
                </tr>

                <!-- Modal Voir Facture -->
                <div class="modal fade" id="voirFactureModal{{ $facture->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Facture #{{ $facture->numero }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Patient:</strong> {{ $facture->patient->nom }} {{ $facture->patient->prenom }}</p>
                                <p><strong>Rendez-vous:</strong> {{ $facture->rendezVous->date_heure->format('d/m/Y H:i') }} ({{ $facture->rendezVous->medecin->nom }})</p>
                                <p><strong>Montant:</strong> {{ number_format($facture->montant, 2) }} €</p>
                                <p><strong>Date d’émission:</strong> {{ $facture->date_emission->format('d/m/Y') }}</p>
                                <p><strong>Statut:</strong> {{ ucfirst(str_replace('_',' ', $facture->statut)) }}</p>
                                <p><strong>Description:</strong> {{ $facture->description ?? 'Aucune' }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Ajout Facture -->
                <div class="modal fade" id="modifierFactureModal{{ $facture->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('factures.update', $facture) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Modifier Facture #{{ $facture->numero }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Numéro</label>
                                        <input type="text" name="numero" value="{{ old('numero', $facture->numero) }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Patient</label>
                                        <select name="patient_id" class="form-select" required>
                                            @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}" {{ old('patient_id', $facture->patient_id) == $patient->id ? 'selected':'' }}>
                                                    {{ $patient->nom }} {{ $patient->prenom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Rendez-vous</label>
                                        <select name="rendez_vous_id" class="form-select" required>
                                            @foreach ($rendezVous as $rdv)
                                                <option value="{{ $rdv->id }}" {{ old('rendez_vous_id', $facture->rendez_vous_id) == $rdv->id ? 'selected':'' }}>
                                                    {{ $rdv->date_heure->format('d/m/Y H:i') }} - {{ $rdv->patient->nom }} ({{ $rdv->medecin->nom }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Montant (FG)</label>
                                        <input type="number" step="0.01" name="montant" value="{{ old('montant', $facture->montant) }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date d’émission</label>
                                        <input type="date" name="date_emission" value="{{ old('date_emission', $facture->date_emission->format('Y-m-d')) }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Statut</label>
                                        <select name="statut" class="form-select" required>
                                            <option value="en_attente" {{ old('statut', $facture->statut)=='en_attente'?'selected':'' }}>En attente</option>
                                            <option value="payee" {{ old('statut', $facture->statut)=='payee'?'selected':'' }}>Payée</option>
                                            <option value="annulee" {{ old('statut', $facture->statut)=='annulee'?'selected':'' }}>Annulée</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control">{{ old('description', $facture->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
    @endif
    <div class="modal fade" id="ajouterFactureModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('factures.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Ajouter Une Facture </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Numéro</label>
                                        <input type="text" name="numero" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Patient</label>
                                        <select name="patient_id" class="form-select" required>
                                            @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}" >
                                                    {{ $patient->nom }} {{ $patient->prenom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Rendez-vous</label>
                                        <select name="rendez_vous_id" class="form-select" required>
                                            @foreach ($rendezVous as $rdv)
                                                <option value="{{ $rdv->id }}">
                                                    {{ $rdv->date_heure->format('d/m/Y H:i') }} - {{ $rdv->patient->nom }} ({{ $rdv->medecin->nom }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Montant (FG)</label>
                                        <input type="number" step="0.01" name="montant"  class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date d’émission</label>
                                        <input type="date" name="date_emission"  class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Statut</label>
                                        <select name="statut" class="form-select" required>
                                            <option value="en_attente" >En attente</option>
                                            <option value="payee">Payée</option>
                                            <option value="annulee">Annulée</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
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
</section>

@endsection