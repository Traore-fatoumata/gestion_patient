```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prise de Rendez-vous - Clinique Médicale</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    @include('vitrine.partials.nav')
    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6 text-center">Prendre un Rendez-vous</h1>
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('vitrine.rendez_vous.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="courriel" class="block text-sm font-medium text-gray-700">Courriel</label>
                <input type="email" name="courriel" id="courriel" value="{{ old('courriel') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="medecin_id" class="block text-sm font-medium text-gray-700">Médecin</label>
                <select name="medecin_id" id="medecin_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionnez un médecin</option>
                    @foreach($medecins as $medecin)
                        <option value="{{ $medecin->id }}" {{ old('medecin_id', request('medecin')) == $medecin->id ? 'selected' : '' }}>
                            {{ $medecin->nom }} {{ $medecin->prenom }} ({{ $medecin->specialite->nom }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="date_heure" class="block text-sm font-medium text-gray-700">Date et heure</label>
                <input type="datetime-local" name="date_heure" id="date_heure" value="{{ old('date_heure') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="raison" class="block text-sm font-medium text-gray-700">Motif du rendez-vous</label>
                <textarea name="raison" id="raison" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('raison') }}</textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Soumettre le rendez-vous</button>
        </form>
    </section>
    @include('vitrine.partials.footer')
</body>
</html>
```