<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Back-Office</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
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
                <a href="{{ route('ordonnances.index') }}" class="px-4 text-2xl font-bold">Ordonnances</a>
                <a href="{{ route('statistiques.index') }}" class="px-4 text-2xl font-bold">Statistiques</a>
            </div>
        </div>
    </nav>
    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">Statistiques</h1>

        <!-- Nombre total de patients consultés -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Nombre total de patients consultés</h2>
            <p class="text-lg">{{ $totalPatients }} patients</p>
        </div>

        <!-- Pathologies fréquentes -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Diagnostic fréquentes</h2>
            @if($pathologiesFrequentes->isEmpty())
                <p class="text-lg">Aucune Diagnostic enregistrée.</p>
            @else
                <table class="w-full bg-white rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600">
                            <th class="p-4 text-left">Diagnostic</th>
                            <th class="p-4 text-left">Nombre de cas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pathologiesFrequentes as $pathologie)
                            <tr>
                                <td class="p-4">{{ $pathologie->diagnostic }}</td>
                                <td class="p-4">{{ $pathologie->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Rendez-vous par médecin -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Nombre de rendez-vous par médecin</h2>
            @if($rendezVousParMedecin->isEmpty())
                <p class="text-lg">Aucun rendez-vous enregistré.</p>
            @else
                <table class="w-full bg-white rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600">
                            <th class="p-4 text-left">Médecin</th>
                            <th class="p-4 text-left">Nombre de rendez-vous</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rendezVousParMedecin as $medecin)
                            <tr>
                                <td class="p-4">{{ $medecin->nom }} {{ $medecin->prenom }}</td>
                                <td class="p-4">{{ $medecin->total_rdv }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Graphique des pathologies fréquentes -->
        @if(!$pathologiesFrequentes->isEmpty())
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Graphique des pathologies fréquentes</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <canvas id="pathologiesChart"></canvas>
                    <script>
                        const ctx = document.getElementById('pathologiesChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: {!! json_encode($pathologiesFrequentes->pluck('diagnostic')->toArray()) !!},
                                datasets: [{
                                    label: 'Nombre de cas',
                                    data: {!! json_encode($pathologiesFrequentes->pluck('total')->toArray()) !!},
                                    backgroundColor: [
                                        'rgba(59, 130, 246, 0.5)',
                                        'rgba(234, 179, 8, 0.5)',
                                        'rgba(239, 68, 68, 0.5)',
                                        'rgba(34, 197, 94, 0.5)',
                                        'rgba(168, 85, 247, 0.5)'
                                    ],
                                    borderColor: [
                                        'rgba(59, 130, 246, 1)',
                                        'rgba(234, 179, 8, 1)',
                                        'rgba(239, 68, 68, 1)',
                                        'rgba(34, 197, 94, 1)',
                                        'rgba(168, 85, 247, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Nombre de cas'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Pathologies'
                                        }
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        @endif
    </section>
</body>
</html>