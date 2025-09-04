<!-- resources/views/patients/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier un patient</h1>

        <!-- Formulaire d'édition -->
        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="Nom">Nom :</label>
                <input type="text" name="Nom" value="{{ $patient->Nom }}" class="form-control" maxlength="100" required>
            </div>

            <div class="form-group mb-3">
                <label for="Prenom">Prénom :</label>
                <input type="text" name="Prenom" value="{{ $patient->Prenom }}" class="form-control" maxlength="250" required>
            </div>

            <div class="form-group mb-3">
                <label for="Sexe">Sexe :</label>
                <select name="Sexe" class="form-control" required>
                    <option value="H" {{ $patient->Sexe == 'H' ? 'selected' : '' }}>Homme</option>
                    <option value="F" {{ $patient->Sexe == 'F' ? 'selected' : '' }}>Femme</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="Date_de_Naissance">Date de naissance :</label>
                <input type="date" name="Date_de_Naissance" value="{{ $patient->Date_de_Naissance }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="Adresse">Adresse :</label>
                <input type="text" name="Adresse" value="{{ $patient->Adresse }}" class="form-control" maxlength="250" required>
            </div>

            <div class="form-group mb-3">
                <label for="Telephone">Téléphone :</label>
                <input type="text" name="Telephone" value="{{ $patient->Telephone }}" class="form-control" maxlength="15">
            </div>

            <div class="form-group mb-3">
                <label for="Email">Email :</label>
                <input type="email" name="Email" value="{{ $patient->Email }}" class="form-control" maxlength="150">
            </div>

            <div class="form-group mb-3">
                <label for="Profession">Profession :</label>
                <input type="text" name="Profession" value="{{ $patient->Profession }}" class="form-control" maxlength="100" required>
            </div>

            <div class="form-group mb-3">
                <label for="Antecedents_Medicaux">Antécédents médicaux :</label>
                <textarea name="Antecedents_Medicaux" class="form-control" rows="4">{{ $patient->Antecedents_Medicaux }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="Numero_Dossier">Numéro de dossier :</label>
                <input type="text" name="Numero_Dossier" value="{{ $patient->Numero_Dossier }}" class="form-control" maxlength="50" required>
            </div>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
