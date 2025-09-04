<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Consultation - Back-Office</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
     <nav class="bg-blue-500 p-6 text-white">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('welcome') }}" class="text-2xl font-bold">Clinique</a>
        <div>
            <a href="{{ route('consultations.index') }}" class="px-4 text-2xl">Consultations</a>
        </div>
    </div>
</nav>
    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">Détails de la Consultation</h1>
        <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <p><strong>Rendez-vous :</strong> RDV #{{ optional($consultation->rendezVous)->id }}</p>
            <p><strong>Patient :</strong> {{ optional($consultation->patient)->nom }} {{ optional($consultation->patient)->prenom }}</p>
            <p><strong>Médecin :</strong> {{ optional($consultation->medecin)->nom }} {{ optional($consultation->medecin)->prenom }} ({{ optional($consultation->medecin->specialite)->nom ?? 'Non spécifié' }})</p>
            <p><strong>Date et heure :</strong> {{ $consultation->date_consultation->format('d/m/Y H:i') }}</p>
            <p><strong>Notes :</strong> {{ $consultation->notes ?: 'Aucune note précisée' }}</p>
            <p><strong>Diagnostic :</strong> {{ $consultation->diagnostic ?: 'Aucun diagnostic précisé' }}</p>
            <p><strong>Traitement :</strong> {{ $consultation->traitement ?: 'Aucun traitement précisé' }}</p>
            <div class="mt-6">
                <a href="{{ route('consultations.edit', $consultation->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">Modifier</a>
                <a href="{{ route('consultations.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Retour</a>
            </div>
        </div>
    </section>
</body>
</html>