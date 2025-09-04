<!-- resources/views/patients/create.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Ajouter un patient</h1>

        <!-- Formulaire de création -->
        <form action="{{ route('patients.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="Nom">Nom :</label>
                <input type="text" name="Nom" class="form-control" maxlength="100" required>
            </div>

            <div class="form-group mb-3">
                <label for="Prenom">Prénom :</label>
                <input type="text" name="Prenom" class="form-control" maxlength="250" required>
            </div>

            <div class="form-group mb-3">
                <label for="Sexe">Sexe :</label>
                <select name="Sexe" class="form-control" required>
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="Date_de_Naissance">Date de naissance :</label>
                <input type="date" name="Date_de_Naissance" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="Adresse">Adresse :</label>
                <input type="text" name="Adresse" class="form-control" maxlength="250" required>
            </div>

            <div class="form-group mb-3">
                <label for="Telephone">Téléphone :</label>
                <input type="text" name="Telephone" class="form-control" maxlength="15">
            </div>

            <div class="form-group mb-3">
                <label for="Email">Email :</label>
                <input type="email" name="Email" class="form-control" maxlength="150">
            </div>

            <div class="form-group mb-3">
                <label for="Profession">Profession :</label>
                <input type="text" name="Profession" class="form-control" maxlength="100" required>
            </div>

            <div class="form-group mb-3">
                <label for="Antecedents_Medicaux">Antécédents médicaux :</label>
                <textarea name="Antecedents_Medicaux" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="Numero_Dossier">Numéro de dossier :</label>
                <input type="text" name="Numero_Dossier" class="form-control" maxlength="50" required>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
