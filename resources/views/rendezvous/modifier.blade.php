<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Rendez-vous - Back-Office</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold">Clinique</a>
            <div>
                <a href="{{ route('rendezvous.index') }}" class="px-4">Rendez-vous</a>
                <a href="{{ route('patients.index') }}" class="px-4">Patients</a>
                <a href="{{ route('medecins.index') }}" class="px-4">Médecins</a>
            </div>
        </div>
    </nav>
    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">Modifier un Rendez-vous</h1>
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('rendezvous.update', $rendezVous->id) }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="form-label">Nom complet</label>
                <input type="text" class="form-control" name="nom_complet" value="{{ old('nom_complet', $rendezVous->nom_complet) }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Téléphone</label>
                <input type="tel" class="form-control" name="telephone" value="{{ old('telephone', $rendezVous->telephone) }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $rendezVous->email) }}">
            </div>
            <div class="mb-4">
                <label class="form-label">Choisir un médecin</label>
                <select class="form-select" name="medecin_id" required>
                    <option value="">Sélectionnez un médecin</option>
                    @foreach($medecins as $medecin)
                        <option value="{{ $medecin->id }}" {{ $rendezVous->medecin_id == $medecin->id ? 'selected' : '' }}>
                            {{ $medecin->nom }} {{ $medecin->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Date du rendez-vous</label>
                <input type="datetime-local" class="form-control" name="date_heure"
                    value="{{ old('date_heure', \Carbon\Carbon::parse($rendezVous->date_heure)->format('Y-m-d\TH:i')) }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Message (optionnel)</label>
                <textarea class="form-control" name="raison" rows="3">{{ old('raison', $rendezVous->raison) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label">Statut</label>
                <select class="form-select" name="statut" required>
                    <option value="en_attente" {{ $rendezVous->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="confirme" {{ $rendezVous->statut == 'confirme' ? 'selected' : '' }}>Confirmé</option>
                    <option value="annule" {{ $rendezVous->statut == 'annule' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Modifier</button>
        </form>
    </section>
</body>
</html>