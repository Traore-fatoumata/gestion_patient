@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center-md">
        <h1 class="text-3xl font-bold mb-6">Gestion des Consultations</h1>
        <button href="{{ route('consultations.create') }}" class="btn btn-info text-white px-4 py-2 rounded-lg mb-4 inline-block">Ajouter une Consultation</button>
        <form method="GET" action="{{ route('consultations.index') }}" class="mb-6">
            <input type="text" name="search" placeholder="Rechercher par patient ou médecin" value="{{ request('search') }}" class="border p-2 rounded-lg">
            <button type="submit" class="btn btn-info text-white px-4 py-2 rounded-lg">Rechercher</button>
        </form>
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="table-responsive bg-while shadow rounded">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th >Rendez-vous</th>
                    <th >Patient</th>
                    <th >Médecin</th>
                    <th >Date Consultation</th>
                    <th >Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($consultations as $consultation)
                    <tr>
                        <td class="p-4 text-2xl">{{ optional($consultation->rendezVous)->id }}</td>
                        <td class="p-4 text-2xl">{{ optional($consultation->patient)->nom }} {{ optional($consultation->patient)->prenom }}</td>
                        <td class="p-4 text-2xl">{{ optional($consultation->medecin)->nom }} {{ optional($consultation->medecin)->prenom }}</td>
                        <td class="p-4 text-2xl">{{ $consultation->date_consultation->format('d/m/Y H:i') }}</td>
                        <td class="p-4 text-2xl">
                            <a href="{{ route('consultations.show', $consultation->id) }}" class="text-green-600 mr-2">Voir</a>
                            <a href="{{ route('consultations.edit', $consultation->id) }}" class="text-blue-600 mr-2">Modifier</a>
                            <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous supprimer cette consultation ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center">Aucune consultation</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $consultations->links() }}</div>

</div>
@endsection