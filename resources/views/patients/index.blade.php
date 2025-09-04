<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Patients - Back-Office</title>
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
        <h1 class="text-3xl font-bold mb-6">Liste des Patients</h1>
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-6">
            <form action="{{ route('patients.search') }}" method="GET" class="flex">
                <input type="text" name="query" placeholder="Rechercher par nom, prénom ou courriel" class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('query') }}">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700">Rechercher</button>
            </form>
        </div>
        <a href="{{ route('patients.creation') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mb-6">Nouveau Patient</a>
        @if($patients->isEmpty())
            <div class="bg-blue-300 border-l-4 border-blue-300 text-white-700 p-4 mb-6" role="alert">
                Aucun patient enregistré.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600">
                            <th class="p-4 text-left">Nom</th>
                            <th class="p-4 text-left">Prénom</th>
                            <th class="p-4 text-left">Date de naissance</th>
                            <th class="p-4 text-left">Genre</th>
                            <th class="p-4 text-left">Adresse</th>
                            <th class="p-4 text-left">Téléphone</th>
                            <th class="p-4 text-left">Courriel</th>
                            <th class="p-4 text-left">Groupe sanguin</th>
                            <th class="p-4 text-left">Antécédents</th>
                            <th class="p-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                            <tr>
                                <td class="p-4">{{ $patient->nom }}</td>
                                <td class="p-4">{{ $patient->prenom }}</td>
                                <td class="p-4">{{ $patient->date_naissance ? $patient->date_naissance->format('d/m/Y') : 'Non spécifiée' }}</td>
                                <td class="p-4">{{ ucfirst($patient->genre) ?? 'Non spécifié' }}</td>
                                <td class="p-4">{{ Str::limit($patient->adresse, 30, '...') }}</td>
                                <td class="p-4">{{ $patient->telephone ?? 'Non spécifié' }}</td>
                                <td class="p-4">{{ $patient->courriel ?? 'Non spécifié' }}</td>
                                <td class="p-4">{{ $patient->groupe_sanguin ?? 'Non spécifié' }}</td>
                                <td class="p-4">{{ $patient->antecedents_medicaux ? 'Oui' : 'Non' }}</td>
                                <td class="p-4">
                                    <a href="{{ route('patients.show', $patient) }}" class="text-blue-600 hover:underline">Voir</a>
                                    <a href="{{ route('patients.edit', $patient) }}" class="text-blue-600 hover:underline ml-2">Modifier</a>
                                    <a href="{{ route('patients.transmit', $patient) }}" class="text-blue-600 hover:underline ml-2">Transmettre</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</body>
</html>