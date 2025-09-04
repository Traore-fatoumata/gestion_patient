@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Liste des Médecins</h4>
            <a href="{{ route('medecins.create') }}" class="btn btn-success btn-sm float-end">+ Ajouter Médecin</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($medecins->isEmpty())
                <p>Aucun médecin enregistré.</p>
            @else

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom & Prénom</th>
                            <th>Sexe</th>
                            <th>Spécialité</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Disponibilités</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medecins as $medecin)
                            <tr>
                                <td>{{ $medecin->Nom_Prenom }}</td>
                                <td>{{ $medecin->Sexe }}</td>
                                <td>{{ $medecin->Specialite }}</td>
                                <td>{{ $medecin->Telephone }}</td>
                                <td>{{ $medecin->Email }}</td>
                                <td>
                                    @if($medecin->Disponibilites)
                                        <ul>
                                            @foreach(json_decode($medecin->Disponibilites, true) as $dispo)
                                                <li>{{ $dispo }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        Non défini
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('medecins.show', $medecin->id) }}" class="btn btn-info btn-sm">Voir</a>
                                    <a href="{{ route('medecins.edit', $medecin->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('medecins.destroy', $medecin->id) }}" method="POST" style="display:inline;"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce médecin ?');">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce médecin ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
