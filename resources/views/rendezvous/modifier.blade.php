<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Rendez-vous - Back-Office</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-500 p-4 text-white">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('welcome') }}" class="text-2xl font-bold">Clinique</a>
        <div>
            <a href="{{ route('rendezvous.index') }}" class="px-4">Rendez-vous</a>
            <a href="{{ route('patients.index') }}" class="px-4">Patients</a>
            <a href="{{ route('medecins.index') }}" class="px-4">Médecins</a>
        </div>
    </div>
</nav>
    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">Modifier un Rendez-vous</h1>
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('rendezvous.update', $rendezVous->id) }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="patient_id" class="block text-sm font-medium text-gray-700">Patient</label>
                <select name="patient_id" id="patient_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionnez un patient</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $rendezVous->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->nom }} {{ $patient->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="medecin_id" class="block text-sm font-medium text-gray-700">Médecin</label>
                <select name="medecin_id" id="medecin_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionnez un médecin</option>
                    @foreach($medecins as $medecin)
                        <option value="{{ $medecin->id }}" {{ $rendezVous->medecin_id == $medecin->id ? 'selected' : '' }}>{{ $medecin->nom }} {{ $medecin->prenom }} ({{ optional($medecin->specialite)->nom ?? 'Non spécifié' }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="date_heure" class="block text-sm font-medium text-gray-700">Date et heure</label>
                <input type="datetime-local" name="date_heure" id="date_heure" value="{{ $rendezVous->date_heure->format('Y-m-d\TH:i') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="raison" class="block text-sm font-medium text-gray-700">Motif</label>
                <textarea name="raison" id="raison" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $rendezVous->raison }}</textarea>
            </div>
            <div class="mb-4">
                <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="statut" id="statut" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="en_attente" {{ $rendezVous->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="confirme" {{ $rendezVous->statut == 'confirme' ? 'selected' : '' }}>Confirmé</option>
                    <option value="annule" {{ $rendezVous->statut == 'annule' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Modifier</button>
        </form>
    </section>
</body>
</html>