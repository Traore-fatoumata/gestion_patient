@extends('layouts.app')
@section('content')
<section class="container mx-auto py-12">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Détails de la Consultation</h1>

    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
        <!-- Header -->
        <div class="bg-blue-500 text-white px-6 py-4">
            <h2 class="text-2xl font-semibold">Consultation #{{ $consultation->id }}</h2>
            <p class="text-sm mt-1">Rendez-vous : RDV #{{ optional($consultation->rendez_vous)->id ?? 'Non attribué' }}</p>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="font-semibold text-gray-700">Patient</h3>
                    <p class="text-gray-900">{{ optional($consultation->patient)->nom ?? 'N/A' }} {{ optional($consultation->patient)->prenom ?? '' }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Médecin</h3>
                    <p class="text-gray-900">{{ optional($consultation->medecin)->nom ?? 'N/A' }} {{ optional($consultation->medecin)->prenom ?? '' }}</p>
                    <p class="text-gray-500 text-sm">{{ optional($consultation->medecin->specialite)->nom ?? 'Spécialité non précisée' }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Date et Heure</h3>
                    <p class="text-gray-900">{{ optional($consultation->date)->format('d/m/Y H:i') ?? 'Non renseigné' }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Notes</h3>
                    <p class="text-gray-900">{{ $consultation->notes ?: 'Aucune note précisée' }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h3 class="font-semibold text-gray-700">Diagnostic</h3>
                <p class="text-gray-900">{{ $consultation->diagnostic ?: 'Aucun diagnostic précisé' }}</p>
            </div>

            <div class="mt-4">
                <h3 class="font-semibold text-gray-700">Traitement</h3>
                <p class="text-gray-900">{{ $consultation->traitement ?: 'Aucun traitement précisé' }}</p>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="bg-gray-100 px-6 py-4 flex justify-end space-x-2">
            <a href="{{ route('consultations.edit', $consultation->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">Modifier</a>
            <a href="{{ route('consultations.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Retour</a>
        </div>
    </div>
</section>
@endsection
