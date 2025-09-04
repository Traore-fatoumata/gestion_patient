@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4>Modifier un Médecin</h4>

             {{-- Gestion des erreurs --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('medecins.update', $medecin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="Nom_Prenom" class="form-label">Nom & Prénom</label>
                    <input type="text" name="Nom_Prenom" id="Nom_Prenom" class="form-control" value="{{ $medecin->Nom_Prenom }}" required>
                </div>
                <div class="mb-3">
                    <label for="Sexe" class="form-label">Sexe</label>
                    <select name="Sexe" id="Sexe" class="form-select" required>
                        <option value="H" {{ $medecin->Sexe == 'H' ? 'selected' : '' }}>Homme</option>
                        <option value="F" {{ $medecin->Sexe == 'F' ? 'selected' : '' }}>Femme</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Specialite" class="form-label">Spécialité</label>
                    <input type="text" name="Specialite" id="Specialite" class="form-control" value="{{ $medecin->Specialite }}" required>
                </div>
                <div class="mb-3">
                    <label for="Telephone" class="form-label">Téléphone</label>
                    <input type="text" name="Telephone" id="Telephone" class="form-control" value="{{ $medecin->Telephone }}">
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" name="Email" id="Email" class="form-control" value="{{ $medecin->Email }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Disponibilités</label><br>
                    @php
                        $jours = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
                        $dispos = json_decode($medecin->Disponibilites, true) ?? [];
                    @endphp
                    @foreach ($jours as $jour)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="Disponibilites[]" value="{{ $jour }}"
                                {{ in_array($jour, old('Disponibilites', $dispos)) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $jour }}</label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('medecins.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
@endsection
