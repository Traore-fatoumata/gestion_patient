<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Rendez-vous </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <nav class="bg-blue-900 p-6 text-white">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('rendezvous.index') }}" class="text-2xl font-bold">Clinique</a>
        <div>
            <a href="{{ route('rendezvous.index') }}" class="px-4 text-2xl">Rendez-vous</a>
        </div>
    </div>
</nav>
    <section class="container mx-auto py-12">
        <h1 class="text-4xl font-bold mb-6">Gestion des Rendez-vous</h1>
        <a href="{{ route('rendezvous.creation') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">Ajouter un Rendez-vous</a>
        <form method="GET" action="{{ route('rendezvous.index') }}" class="mb-6">
            <input type="text" name="search" placeholder="Recherche par Patient/Médecin" value="{{ request('search') }}" class="border p-2 rounded-lg">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Rechercher</button>
        </form>
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <table class="w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-blue-200">
                    <th class="p-4 text-2xl">Patient</th>
                    <th class="p-4 text-2xl">Médecin</th>
                    <th class="p-4 text-2xl">Date/Heure</th>
                    <th class="p-4 text-2xl">Statut</th>
                    <th class="p-4 text-2xl">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rendezVous as $rdv)
                    <tr>
                        <td class="p-4">{{ optional($rdv->patient)->nom }} {{ optional($rdv->patient)->prenom }}</td>
                        <td class="p-4">{{ optional($rdv->medecin)->nom }} {{ optional($rdv->medecin)->prenom }}</td>
                        <td class="p-4">{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                        <td class="p-4">{{ $rdv->statut }}</td>
                        <td class="p-4">
                            <a href="{{ route('rendezvous.show', $rdv->id) }}" class="text-green-600 mr-2">Voir</a>
                            <a href="{{ route('rendezvous.modifier', $rdv->id) }}" class="text-blue-600 mr-2">Modifier</a>
                            <form action="{{ route('rendezvous.destroy', $rdv->id) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce rendez-vous ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center">Aucun rendez-vous trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $rendezVous->links() }}</div>
    </section>
</body>
</html>