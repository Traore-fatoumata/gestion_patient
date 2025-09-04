<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Consultation - Back-Office</title>
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
        <h1 class="text-3xl font-bold mb-6">Modifier une Consultation</h1>
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('consultations.update', $consultation->id) }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="rendez_vous_id" class="block text-sm font-medium text-gray-700">Rendez-vous</label>
                <select name="rendez_vous_id" id="rendez_vous_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm ">
                    <option value="">Sélectionnez un rendez-vous</option>
                    @foreach($rendezVous as $rdv)
                        <option value="{{ $rdv->id }}" {{ $consultation->rendez_vous_id == $rdv->id ? 'selected' : '' }}>RDV #{{ $rdv->id }} - {{ optional($rdv->patient)->nom }} {{ optional($rdv->patient)->prenom }} avec {{ optional($rdv->medecin)->nom }} {{ optional($rdv->medecin)->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="date_consultation" class="block text-sm font-medium text-gray-700">Date et heure</label>
                <input type="datetime-local" name="date_consultation" id="date_consultation" value="{{ $consultation->date_consultation->format('Y-m-d\TH:i') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm ">{{ $consultation->notes }}</textarea>
            </div>
            <div class="mb-4">
                <label for="diagnostic" class="block text-sm font-medium text-gray-700">Diagnostic</label>
                <textarea name="diagnostic" id="diagnostic" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm ">{{ $consultation->diagnostic }}</textarea>
            </div>
            <div class="mb-4">
                <label for="traitement" class="block text-sm font-medium text-gray-700">Traitement</label>
                <textarea name="traitement" id="traitement" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm ">{{ $consultation->traitement }}</textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Modifier</button>
        </form>
    </section>
</body>
</html>