<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Médecin - Back-Office</title>
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
        <h1 class="text-3xl font-bold mb-6">Nouveau Médecin</h1>
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('medecins.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="utilisateur_id" class="block text-gray-700 font-semibold mb-2">Utilisateur</label>
                <select name="utilisateur_id" id="utilisateur_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Aucun</option>
                    @foreach ($utilisateurs as $utilisateur)
                        <option value="{{ $utilisateur->id }}" {{ old('utilisateur_id') == $utilisateur->id ? 'selected' : '' }}>{{ $utilisateur->nom ?? 'Utilisateur ' . $utilisateur->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="prenom" class="block text-gray-700 font-semibold mb-2">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="specialite_id" class="block text-gray-700 font-semibold mb-2">Spécialité</label>
                <select name="specialite_id" id="specialite_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Sélectionner une spécialité</option>
                    @foreach ($specialites as $specialite)
                        <option value="{{ $specialite->id }}" {{ old('specialite_id') == $specialite->id ? 'selected' : '' }}>{{ $specialite->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="biographie" class="block text-gray-700 font-semibold mb-2">Biographie</label>
                <textarea name="biographie" id="biographie" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('biographie') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="photo_url" class="block text-gray-700 font-semibold mb-2">URL de la photo</label>
                <input type="text" name="photo_url" id="photo_url" value="{{ old('photo_url') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="annees_experience" class="block text-gray-700 font-semibold mb-2">Années d’expérience</label>
                <input type="text" name="annees_experience" id="annees_experience" value="{{ old('annees_experience') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="telephone" class="block text-gray-700 font-semibold mb-2">Téléphone</label>
                <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Créer</button>
                <a href="{{ route('medecins.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 ml-2">Annuler</a>
            </div>
        </form>
    </section>
</body>
</html>