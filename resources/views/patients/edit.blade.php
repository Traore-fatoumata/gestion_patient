<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Patient - Back-Office</title>
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
        <h1 class="text-3xl font-bold mb-6">Modifier le Patient</h1>
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('patients.update', $patient) }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $patient->nom) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="prenom" class="block text-gray-700 font-semibold mb-2">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $patient->prenom) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="date_naissance" class="block text-gray-700 font-semibold mb-2">Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $patient->date_naissance) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="genre" class="block text-gray-700 font-semibold mb-2">Genre</label>
                <select name="genre" id="genre" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionner</option>
                    <option value="homme" {{ old('genre', $patient->genre) == 'homme' ? 'selected' : '' }}>Homme</option>
                    <option value="femme" {{ old('genre', $patient->genre) == 'femme' ? 'selected' : '' }}>Femme</option>
                    <option value="autre" {{ old('genre', $patient->genre) == 'autre' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="adresse" class="block text-gray-700 font-semibold mb-2">Adresse</label>
                <textarea name="adresse" id="adresse" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('adresse', $patient->adresse) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="telephone" class="block text-gray-700 font-semibold mb-2">Téléphone</label>
                <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $patient->telephone) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="courriel" class="block text-gray-700 font-semibold mb-2">Courriel</label>
                <input type="email" name="courriel" id="courriel" value="{{ old('courriel', $patient->courriel) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="groupe_sanguin" class="block text-gray-700 font-semibold mb-2">Groupe sanguin</label>
                <input type="text" name="groupe_sanguin" id="groupe_sanguin" value="{{ old('groupe_sanguin', $patient->groupe_sanguin) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="antecedents_medicaux" class="block text-gray-700 font-semibold mb-2">Antécédents médicaux</label>
                <textarea name="antecedents_medicaux" id="antecedents_medicaux" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('antecedents_medicaux', $patient->antecedents_medicaux) }}</textarea>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Mettre à jour</button>
                <a href="{{ route('patients.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 ml-2">Annuler</a>
            </div>
        </form>
    </section>
</body>
</html>