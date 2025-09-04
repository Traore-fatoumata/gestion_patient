<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Patient - Back-Office</title>
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
        <h1 class="text-3xl font-bold mb-6">Détails du Patient</h1>
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">{{ $patient->nom }} {{ $patient->prenom }}</h2>
            <p class="mb-2"><strong>Date de naissance :</strong> {{ $patient->date_naissance ?? 'Non spécifiée' }}</p>
            <p class="mb-2"><strong>Genre :</strong> {{ ucfirst($patient->genre) ?? 'Non spécifié' }}</p>
            <p class="mb-2"><strong>Adresse :</strong> {{ $patient->adresse ?? 'Non spécifiée' }}</p>
            <p class="mb-2"><strong>Téléphone :</strong> {{ $patient->telephone ?? 'Non spécifié' }}</p>
            <p class="mb-2"><strong>Courriel :</strong> {{ $patient->courriel ?? 'Non spécifié' }}</p>
            <p class="mb-2"><strong>Groupe sanguin :</strong> {{ $patient->groupe_sanguin ?? 'Non spécifié' }}</p>
            <p class="mb-2"><strong>Antécédents médicaux :</strong> {{ $patient->antecedents_medicaux ?? 'Aucun' }}</p>
            <div class="mt-4">
                <a href="{{ route('patients.edit', $patient) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Modifier</a>
                <a href="{{ route('patients.transmit', $patient) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 ml-2">Transmettre</a>
                <a href="{{ route('patients.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 ml-2">Retour</a>
            </div>
        </div>
        <h2 class="text-2xl font-bold mt-8 mb-4">Rendez-vous associés</h2>
        @if($rendezVous->isEmpty())
            <div class="bg-blue-300 border-l-4 border-blue-300 text-white-700 p-4 mb-6" role="alert">
                Aucun rendez-vous associé à ce patient.
            </div>
        @else
            <table class="w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-600">
                        <th class="p-4 text-left">Médecin</th>
                        <th class="p-4 text-left">Date/Heure</th>
                        <th class="p-4 text-left">Motif</th>
                        <th class="p-4 text-left">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rendezVous as $rdv)
                        <tr>
                            <td class="p-4">{{ $rdv->medecin->nom }} {{ $rdv->medecin->prenom }} ({{ optional($rdv->medecin->specialite)->nom ?? 'Non spécifié' }})</td>
                            <td class="p-4">{{ $rdv->date_heure }}</td>
                            <td class="p-4">{{ $rdv->raison ?? 'Non spécifié' }}</td>
                            <td class="p-4">{{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <h2 class="text-2xl font-bold mt-8 mb-4">Factures associées</h2>
        @if($factures->isEmpty())
            <div class="bg-blue-300 border-l-4 border-blue-300 text-white-700 p-4 mb-6" role="alert">
                Aucune facture associée à ce patient.
            </div>
        @else
            <table class="w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-600">
                        <th class="p-4 text-left">Numéro</th>
                        <th class="p-4 text-left">Rendez-vous</th>
                        <th class="p-4 text-left">Montant</th>
                        <th class="p-4 text-left">Date d’émission</th>
                        <th class="p-4 text-left">Statut</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($factures as $facture)
                        <tr>
                            <td class="p-4">{{ $facture->numero }}</td>
                            <td class="p-4">{{ $facture->rendezVous->date_heure }} ({{ $facture->rendezVous->medecin->nom }})</td>
                            <td class="p-4">{{ number_format($facture->montant, 2) }} €</td>
                            <td class="p-4">{{ $facture->date_emission->format('d/m/Y') }}</td>
                            <td class="p-4">{{ ucfirst(str_replace('_', ' ', $facture->statut)) }}</td>
                            <td class="p-4">
                                <a href="{{ route('factures.show', $facture) }}" class="text-blue-600 hover:underline">Voir</a>
                                <a href="{{ route('factures.edit', $facture) }}" class="text-blue-600 hover:underline ml-2">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
</body>
</html>