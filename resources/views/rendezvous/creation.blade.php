<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Rendez-vous - Back-Office</title>
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
        <h1 class="text-3xl font-bold mb-6">Créer un Rendez-vous</h1>
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('rendezvous.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label class="form-label">Nom complet</label>
                <input type="text" class="form-control" name="nom_complet" value="{{ old('nom_complet') }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Téléphone</label>
                <input type="tel" class="form-control" name="telephone" value="{{ old('telephone') }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label class="form-label">Choisir un médecin</label>
                <select class="form-select" name="medecin_id" required>
                    <option value="">Sélectionnez un médecin</option>
                    @foreach($medecins as $medecin)
                        <option value="{{ $medecin->id }}" {{ old('medecin_id') == $medecin->id ? 'selected' : '' }}>
                            {{ $medecin->nom }} {{ $medecin->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Date du rendez-vous</label>
                <input type="datetime-local" class="form-control" name="date_heure" value="{{ old('date_heure') }}" required>
            </div>
            <input type="hidden" name="statut" value="en_attente">
            <div class="mb-4">
                <label class="form-label">Message (optionnel)</label>
                <textarea class="form-control" name="raison" rows="3">{{ old('raison') }}</textarea>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Créer</button>
                <a href="{{ route('rendezvous.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 ml-2">Annuler</a>
            </div>
        </form>
    </section>
</body>
</html>