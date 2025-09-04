<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Ordonnances</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-900 p-6 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold">Clinique</a>
            <div>
                <a href="{{ route('rendezvous.index') }}" class="px-4 text-2xl">Ordonnances</a>
            </div>
            
        </div>
    </nav>

    <section class="container mx-auto py-12">
        <a href="{{ route('ordonnances.create') }}" class="bg-blue-500 px-4 py-2 rounded-lg">Ajouter une Ordonnance</a>
        <h1 class="text-3xl font-bold mb-6">Liste des Ordonnances</h1>
        <table class="w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-4 text-2xl">Consultation</th>
                    <th class="p-4 text-2xl">Patient</th>
                    <th class="p-4 text-2xl">Médecin</th>
                    <th class="p-4 text-2xl">Date</th>
                    <th class="p-4 text-2xl">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordonnances as $ordonnance)
                    <tr>
                        <td class="p-4 text-2xl">{{ optional($ordonnance->consultation)->id }}</td>
                        <td class="p-4 text-2xl">{{ optional($ordonnance->consultation->patient)->nom ?? '' }}</td>
                        <td class="p-4 text-2xl">{{ optional($ordonnance->consultation->medecin)->nom ?? '' }}</td>
                        <td class="p-4 text-2xl">{{ $ordonnance->date->format('d/m/Y') }}</td>
                        <td class="p-4 text-2xl">
                            <a href="{{ route('ordonnances.show', $ordonnance->id) }}" class="text-green-600 mr-2">Voir</a>
                            <a href="{{ route('ordonnances.edit', $ordonnance->id) }}" class="text-blue-600 mr-2">Modifier</a>
                            <form action="{{ route('ordonnances.destroy', $ordonnance->id) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous supprimer cette ordonnance ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center">Aucune ordonnance</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</body>
</html>
