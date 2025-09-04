<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Facture - Back-Office</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-500 p-6 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold">Clinique</a>
            <div>
                <a href="{{ route('patients.index') }}" class="px-4 text-2xl font-bold">Patients</a>
                <a href="{{ route('medecins.index') }}" class="px-4 text-2xl font-bold">Médecins</a>
                <a href="{{ route('rendezvous.index') }}" class="px-4 text-2xl font-bold">Rendez-vous</a>
                <a href="{{ route('factures.index') }}" class="px-4 text-2xl font-bold">Factures</a>
            </div>
        </div>
    </nav>
    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">Nouvelle Facture</h1>
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('factures.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="numero" class="block text-gray-700 font-semibold mb-2">Numéro de facture</label>
                <input type="text" name="numero" id="numero" value="{{ old('numero') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="patient_id" class="block text-gray-700 font-semibold mb-2">Patient</label>
                <select name="patient_id" id="patient_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Sélectionner un patient</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->nom }} {{ $patient->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="rendez_vous_id" class="block text-gray-700 font-semibold mb-2">Rendez-vous</label>
                <select name="rendez_vous_id" id="rendez_vous_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Sélectionner un rendez-vous</option>
                    @foreach ($rendezVous as $rdv)
                        <option value="{{ $rdv->id }}" {{ old('rendez_vous_id') == $rdv->id ? 'selected' : '' }}>{{ $rdv->date_heure }} - {{ $rdv->patient->nom }} ({{ $rdv->medecin->nom }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="montant" class="block text-gray-700 font-semibold mb-2">Montant (€)</label>
                <input type="number" name="montant" id="montant" step="0.01" value="{{ old('montant') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="date_emission" class="block text-gray-700 font-semibold mb-2">Date d’émission</label>
                <input type="date" name="date_emission" id="date_emission" value="{{ old('date_emission') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="statut" class="block text-gray-700 font-semibold mb-2">Statut</label>
                <select name="statut" id="statut" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="payee" {{ old('statut') == 'payee' ? 'selected' : '' }}>Payée</option>
                    <option value="annulee" {{ old('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Créer</button>
                <a href="{{ route('factures.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 ml-2">Annuler</a>
            </div>
        </form>
    </section>
</body>
</html>