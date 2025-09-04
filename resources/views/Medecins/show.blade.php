@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>Détails du Médecin</h4>
        </div>
        <div class="card-body">
            <p><strong>Nom & Prénom :</strong> {{ $medecin->Nom_Prenom }}</p>
            <p><strong>Sexe :</strong> {{ $medecin->Sexe }}</p>
            <p><strong>Spécialité :</strong> {{ $medecin->Specialite }}</p>
            <p><strong>Téléphone :</strong> {{ $medecin->Telephone }}</p>
            <p><strong>Email :</strong> {{ $medecin->Email }}</p>
            <p><strong>Disponibilités :</strong>
                @if($medecin->Disponibilites)
                    <ul>
                        @foreach(json_decode($medecin->Disponibilites, true) as $dispo)
                            <li>{{ $dispo }}</li>
                        @endforeach
                    </ul>
                @else
                    Non définies
                @endif
            </p>

            <a href="{{ route('medecins.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
@endsection
