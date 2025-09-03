<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Ordonnance</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-900 p-6 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('ordonnances.index') }}" class="text-2xl font-bold">Clinique</a>
        </div>
    </nav>

    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">Ajouter une Ordonnance</h1>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ordonnances.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <label for="consultation_id" class="block text-xl font-semibold mb-2">Consultation</label>
                <select name="consultation_id" id="consultation_id" class="border p-2 rounded-lg w-full">
                    <option value="">-- Sélectionnez une consultation --</option>
                    @foreach($consultations as $consultation)
                        <option value="{{ $consultation->id }}">
                            {{ optional($consultation->patient)->nom }} {{ optional($consultation->patient)->prenom }} - {{ optional($consultation->medecin)->nom ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-xl font-semibold mb-2">Date</label>
                <input type="date" name="date" id="date" class="border p-2 rounded-lg w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Ajouter</button>
        </form>
    </section>
</body>
</html>
