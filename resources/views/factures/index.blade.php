<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Factures - Back-Office</title>
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
        <h1 class="text-3xl font-bold mb-6">Liste des Factures</h1>
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('factures.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mb-6">Nouvelle Facture</a>
        @if($factures->isEmpty())
            <div class="bg-blue-300 border-l-4 border-blue-300 text-white-700 p-4 mb-6" role="alert">
                Aucune facture enregistrée.
            </div>
        @else
            <table class="w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-600">
                        <th class="p-4 text-left">Numéro</th>
                        <th class="p-4 text-left">Patient</th>
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
                            <td class="p-4">{{ $facture->patient->nom }} {{ $facture->patient->prenom }}</td>
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