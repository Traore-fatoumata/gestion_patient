<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Rendez-vous - Back-Office</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-500 p-4 text-white">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('welcome') }}" class="text-2xl font-bold">Clinique</a>
        <div>
            <a href="{{ route('rendezvous.index') }}" class="px-4">Rendez-vous</a>
            <a href="{{ route('patients.index') }}" class="px-4 text-2xl font-bold">Patients</a>
            <a href="{{ route('medecins.index') }}" class="px-4 text-2xl font-bold">Médecins</a>
        </div>
    </div>
</nav>
    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">Détails du Rendez-vous</h1>
        <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <p><strong>Patient :</strong> {{ optional($rendezVous->patient)->nom }} {{ optional($rendezVous->patient)->prenom }}</p>
            <p><strong>Médecin :</strong> {{ optional($rendezVous->medecin)->nom }} {{ optional($rendezVous->medecin)->prenom }} ({{ optional($rendezVous->medecin->specialite)->nom ?? 'Non spécifié' }})</p>
            <p><strong>Date et heure :</strong> {{ $rendezVous->date_heure->format('d/m/Y H:i') }}</p>
            <p><strong>Motif :</strong> {{ $rendezVous->raison ?: 'Aucun motif précisé' }}</p>
            <p><strong>Statut :</strong> {{ $rendezVous->statut }}</p>
            <div class="mt-6">
                <a href="{{ route('rendezvous.modifier', $rendezVous->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">Modifier</a>
                <a href="{{ route('rendezvous.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Retour</a>
            </div>
        </div>
    </section>
</body>
</html>