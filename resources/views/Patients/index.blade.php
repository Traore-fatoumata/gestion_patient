

@extends('layouts.app')  

@section('content')
    <div class="container">
        <h1>Liste des patients</h1>

        <!-- Bouton pour créer un nouveau patient -->
        <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Ajouter un patient</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Tableau des patients -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Date de naissance</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Profession</th>
                    <th>Antecedents_Medicaux</th>
                    <th>Numero de Dossier</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->Nom }}</td>
                        <td>{{ $patient->Prenom }}</td>
                        <td>{{ $patient->Sexe }}</td>
                        <td>{{ $patient->Date_de_Naissance }}</td>
                        <td>{{ $patient->Adresse}}</td>
                        <td>{{ $patient->Telephone }}</td>
                        <td>{{ $patient->Email }}</td>
                        <td>{{ $patient->Profession }}</td>
                        <td>{{ $patient->Antecedents_Medicaux }}</td>
                        <td>{{ $patient->Numero_Dossier }}</td>
                        <td>
                            <!-- Lien pour voir les patients -->
                            <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info btn-sm">Voir</a>
                            
                            <!-- Lien pour modifier -->
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            
                            <!-- Formulaire pour supprimer -->
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce patient ?');">
                                
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
