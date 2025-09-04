@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>Détails du Patient</h4>
        </div>
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $patient->Nom }}</p>
            <p><strong>Prénom :</strong> {{ $patient->Prenom }}</p>
            <p><strong>Sexe :</strong> {{ $patient->Sexe }}</p>
            <p><strong>Date de Naissance :</strong> {{ $patient->Date_de_Naissance }}</p>
            <p><strong>Adresse :</strong> {{ $patient->Adresse }}</p>
            <p><strong>Téléphone :</strong> {{ $patient->Telephone }}</p>
            <p><strong>Email :</strong> {{ $patient->Email }}</p>
            <p><strong>Profession :</strong> {{ $patient->Profession }}</p>
            <p><strong>Antécédents Médicaux :</strong> {{ $patient->Antecedents_Medicaux }}</p>
            <p><strong>Numéro de Dossier :</strong> {{ $patient->Numero_Dossier }}</p>

            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
@endsection
