<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Médecin - Back-Office</title>
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
        <h1 class="text-3xl font-bold mb-6">Détails du Médecin</h1>
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">{{ $medecin->nom }} {{ $medecin->prenom }}</h2>
            @if ($medecin->photo_url)
                <img src="{{ $medecin->photo_url }}" alt="{{ $medecin->nom }}" class="w-24 h-24 rounded-full object-cover mb-4">
            @endif
            <p class="mb-2"><strong>Spécialité :</strong> {{ optional($medecin->specialite)->nom ?? 'Non spécifiée' }}</p>
            <p class="mb-2"><strong>Années d’expérience :</strong> {{ $medecin->annees_experience ?? 'Non spécifié' }}</p>
            <p class="mb-2"><strong>Biographie :</strong> {{ $medecin->biographie ?? 'Aucune' }}</p>
            <p class="mb-2"><strong>Utilisateur associé :</strong> {{ optional($medecin->utilisateur)->nom ?? 'Non associé' }}</p>
            <div class="mt-4">
                <a href="{{ route('medecins.edit', $medecin) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Modifier</a>
                <a href="{{ route('medecins.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 ml-2">Retour</a>
            </div>
        </div>
        <h2 class="text-2xl font-bold mt-8 mb-4">Rendez-vous associés</h2>
        @if($medecin->rendezVous->isEmpty())
            <div class="bg-blue-300 border-l-4 border-blue-300 text-white-700 p-4 mb-6" role="alert">
                Aucun rendez-vous associé à ce médecin.
            </div>
        @else
            <table class="w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-600">
                        <th class="p-4 text-left">Patient</th>
                        <th class="p-4 text-left">Date/Heure</th>
                        <th class="p-4 text-left">Motif</th>
                        <th class="p-4 text-left">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medecin->rendezVous as $rdv)
                        <tr>
                            <td class="p-4">{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</td>
                            <td class="p-4">{{ $rdv->date_heure }}</td>
                            <td class="p-4">{{ $rdv->raison ?? 'Non spécifié' }}</td>
                            <td class="p-4">{{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
</body>
</html>