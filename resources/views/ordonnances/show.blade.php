<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir Ordonnance</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-900 p-6 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold">Clinique</a>
        </div>
    </nav>

    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">Ordonnance #{{ $ordonnance->id }}</h1>

        <p class="mb-2"><strong>Consultation :</strong> {{ optional($ordonnance->consultation)->id }}</p>
        <p class="mb-2"><strong>Patient :</strong> {{ optional($ordonnance->consultation->patient)->nom ?? '' }}</p>
        <p class="mb-2"><strong>Médecin :</strong> {{ optional($ordonnance->consultation->medecin)->nom ?? '' }}</p>
        <p class="mb-4"><strong>Date :</strong> {{ $ordonnance->date->format('d/m/Y') }}</p>

        <h2 class="text-2xl font-bold mb-2">Éléments de l’ordonnance</h2>
        <ul class="list-disc pl-6">
            @foreach($ordonnance->element_ordonnance as $element)
                <li>{{ $element->medicament }} - {{ $element->posologie ?? '' }}</li>
            @endforeach
        </ul>
    </section>
</body>
</html>
