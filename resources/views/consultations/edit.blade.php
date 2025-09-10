@extends('layouts.app')
@section('content')
<section class="container mx-auto py-12">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Modifier une Consultation</h1>

    @if($errors->any())
        <div class="max-w-lg mx-auto mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('consultations.update', $consultation->id) }}" method="POST" class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-200 space-y-6">
        @csrf
        @method('PUT')

        <!-- Rendez-vous -->
        <div>
            <label for="rendez_vous_id" class="block text-sm font-medium text-gray-700 mb-1">Rendez-vous</label>
            <select name="rendez_vous_id" id="rendez_vous_id" required
                class="block w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Sélectionnez un rendez-vous</option>
                @foreach($rendezVous as $rdv)
                    <option value="{{ $rdv->id }}" {{ $consultation->rendez_vous_id == $rdv->id ? 'selected' : '' }}>
                        RDV #{{ $rdv->id }} - {{ optional($rdv->patient)->nom }} {{ optional($rdv->patient)->prenom }} avec {{ optional($rdv->medecin)->nom }} {{ optional($rdv->medecin)->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date -->
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date et heure</label>
            <input type="datetime-local" name="date" id="date" value="{{ $consultation->date->format('Y-m-d\TH:i') }}" required
                class="block w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Notes -->
        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea name="notes" id="notes" rows="4"
                class="block w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">{{ $consultation->notes }}</textarea>
        </div>

        <!-- Diagnostic -->
        <div>
            <label for="diagnostic" class="block text-sm font-medium text-gray-700 mb-1">Diagnostic</label>
            <textarea name="diagnostic" id="diagnostic" rows="4"
                class="block w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">{{ $consultation->diagnostic }}</textarea>
        </div>

        <!-- Traitement -->
        <div>
            <label for="traitement" class="block text-sm font-medium text-gray-700 mb-1">Traitement</label>
            <textarea name="traitement" id="traitement" rows="4"
                class="block w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">{{ $consultation->traitement }}</textarea>
        </div>

        <!-- Bouton -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                Modifier
            </button>
        </div>
    </form>
</section>
@endsection
