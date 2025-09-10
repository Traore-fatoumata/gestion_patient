@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold text-primary">📊 Tableau de Bord</h1>

    <!-- Cards statistiques -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-muted">Patients</h5>
                    <h2 class="fw-bold text-primary">{{ $totalPatients ?? 0 }}</h2>
                    <small class="text-muted">Total consultés</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-muted">Médecins</h5>
                    <h2 class="fw-bold text-success">{{ $totalMedecins ?? 0 }}</h2>
                    <small class="text-muted">Disponibles</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-muted">Rendez-vous</h5>
                    <h2 class="fw-bold text-danger">{{ $totalRendezVous ?? 0 }}</h2>
                    <small class="text-muted">Total enregistrés</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Nombre total de patients consultés -->
    <div class="mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Nombre total de patients consultés</h2>
                <p class="fs-5 text-dark">{{ $totalPatients ?? 0 }} patients</p>
            </div>
        </div>
    </div>

    <!-- Pathologies fréquentes -->
    <div class="mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Diagnostics fréquents</h2>
                @if($pathologiesFrequentes->isEmpty())
                    <p class="text-muted">Aucun diagnostic enregistré.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>Diagnostic</th>
                                    <th>Nombre de cas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pathologiesFrequentes as $pathologie)
                                    <tr>
                                        <td>{{ $pathologie->diagnostic }}</td>
                                        <td><span class="badge bg-primary fs-6">{{ $pathologie->total }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Rendez-vous par médecin -->
    <div class="mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Nombre de rendez-vous par médecin</h2>
                @if($rendezVousParMedecin->isEmpty())
                    <p class="text-muted">Aucun rendez-vous enregistré.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>Médecin</th>
                                    <th>Nombre de rendez-vous</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rendezVousParMedecin as $medecin)
                                    <tr>
                                        <td>{{ $medecin->nom }} {{ $medecin->prenom }}</td>
                                        <td><span class="badge bg-success fs-6">{{ $medecin->total_rdv }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Graphique des pathologies fréquentes -->
    @if(!$pathologiesFrequentes->isEmpty())
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Graphique des diagnostics fréquents</h2>
                <canvas id="pathologiesChart"></canvas>
            </div>
        </div>
    @endif

    <!-- Graphique des rendez-vous par médecin -->
    @if(!$rendezVousParMedecin->isEmpty())
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Graphique des rendez-vous par médecin</h2>
                <canvas id="medecinsChart"></canvas>
            </div>
        </div>
    @endif
</div>

<!-- Scripts Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(!$pathologiesFrequentes->isEmpty())
        const ctxPatho = document.getElementById('pathologiesChart').getContext('2d');
        new Chart(ctxPatho, {
            type: 'bar',
            data: {
                labels: {!! json_encode($pathologiesFrequentes->pluck('diagnostic')->toArray()) !!},
                datasets: [{
                    label: 'Nombre de cas',
                    data: {!! json_encode($pathologiesFrequentes->pluck('total')->toArray()) !!},
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.6)',
                        'rgba(25, 135, 84, 0.6)',
                        'rgba(220, 53, 69, 0.6)',
                        'rgba(255, 193, 7, 0.6)',
                        'rgba(111, 66, 193, 0.6)'
                    ],
                    borderColor: [
                        'rgba(13, 110, 253, 1)',
                        'rgba(25, 135, 84, 1)',
                        'rgba(220, 53, 69, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(111, 66, 193, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });
    @endif

    @if(!$rendezVousParMedecin->isEmpty())
        const ctxMed = document.getElementById('medecinsChart').getContext('2d');
        new Chart(ctxMed, {
            type: 'pie',
            data: {
                labels: {!! json_encode($rendezVousParMedecin->map(fn($m) => $m->nom . ' ' . $m->prenom)->toArray()) !!},
                datasets: [{
                    label: 'Nombre de rendez-vous',
                    data: {!! json_encode($rendezVousParMedecin->pluck('total_rdv')->toArray()) !!},
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.6)',
                        'rgba(25, 135, 84, 0.6)',
                        'rgba(220, 53, 69, 0.6)',
                        'rgba(255, 193, 7, 0.6)',
                        'rgba(111, 66, 193, 0.6)'
                    ],
                    borderColor: [
                        'rgba(13, 110, 253, 1)',
                        'rgba(25, 135, 84, 1)',
                        'rgba(220, 53, 69, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(111, 66, 193, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'right' } }
            }
        });
    @endif
</script>
@endsection@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold text-primary">📊 Tableau de Bord</h1>

    <!-- Cards statistiques -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-muted">Patients</h5>
                    <h2 class="fw-bold text-primary">{{ $totalPatients }}</h2>
                    <small class="text-muted">Total consultés</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-muted">Médecins</h5>
                    <h2 class="fw-bold text-success">{{ $totalMedecins ?? 0 }}</h2>
                    <small class="text-muted">Disponibles</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-muted">Rendez-vous</h5>
                    <h2 class="fw-bold text-danger">{{ $totalRendezVous ?? 0 }}</h2>
                    <small class="text-muted">Enregistrés</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Nombre total de patients consultés -->
    <div class="mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Nombre total de patients consultés</h2>
                <p class="fs-5 text-dark">{{ $totalPatients }} patients</p>
            </div>
        </div>
    </div>

    <!-- Pathologies fréquentes -->
    <div class="mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Diagnostics fréquents</h2>
                @if($pathologiesFrequentes->isEmpty())
                    <p class="text-muted">Aucun diagnostic enregistré.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>Diagnostic</th>
                                    <th>Nombre de cas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pathologiesFrequentes as $pathologie)
                                    <tr>
                                        <td>{{ $pathologie->diagnostic }}</td>
                                        <td><span class="badge bg-primary fs-6">{{ $pathologie->total }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Rendez-vous par médecin -->
    <div class="mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Nombre de rendez-vous par médecin</h2>
                @if($rendezVousParMedecin->isEmpty())
                    <p class="text-muted">Aucun rendez-vous enregistré.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>Médecin</th>
                                    <th>Nombre de rendez-vous</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rendezVousParMedecin as $medecin)
                                    <tr>
                                        <td>{{ $medecin->nom }} {{ $medecin->prenom }}</td>
                                        <td><span class="badge bg-success fs-6">{{ $medecin->total_rdv }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Graphique des pathologies fréquentes -->
    @if(!$pathologiesFrequentes->isEmpty())
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Graphique des diagnostics fréquents</h2>
                <canvas id="pathologiesChart"></canvas>
            </div>
        </div>
    @endif

    <!-- Graphique des rendez-vous par médecin -->
    @if(!$rendezVousParMedecin->isEmpty())
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Graphique des rendez-vous par médecin</h2>
                <canvas id="medecinsChart"></canvas>
            </div>
        </div>
    @endif
</div>

<!-- Scripts Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(!$pathologiesFrequentes->isEmpty())
        const ctxPatho = document.getElementById('pathologiesChart').getContext('2d');
        new Chart(ctxPatho, {
            type: 'bar',
            data: {
                labels: {!! json_encode($pathologiesFrequentes->pluck('diagnostic')->toArray()) !!},
                datasets: [{
                    label: 'Nombre de cas',
                    data: {!! json_encode($pathologiesFrequentes->pluck('total')->toArray()) !!},
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.6)',
                        'rgba(25, 135, 84, 0.6)',
                        'rgba(220, 53, 69, 0.6)',
                        'rgba(255, 193, 7, 0.6)',
                        'rgba(111, 66, 193, 0.6)'
                    ],
                    borderColor: [
                        'rgba(13, 110, 253, 1)',
                        'rgba(25, 135, 84, 1)',
                        'rgba(220, 53, 69, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(111, 66, 193, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });
    @endif

    @if(!$rendezVousParMedecin->isEmpty())
        const ctxMed = document.getElementById('medecinsChart').getContext('2d');
        new Chart(ctxMed, {
            type: 'pie',
            data: {
                labels: {!! json_encode($rendezVousParMedecin->map(fn($m) => $m->nom . ' ' . $m->prenom)->toArray()) !!},
                datasets: [{
                    label: 'Nombre de rendez-vous',
                    data: {!! json_encode($rendezVousParMedecin->pluck('total_rdv')->toArray()) !!},
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.6)',
                        'rgba(25, 135, 84, 0.6)',
                        'rgba(220, 53, 69, 0.6)',
                        'rgba(255, 193, 7, 0.6)',
                        'rgba(111, 66, 193, 0.6)'
                    ],
                    borderColor: [
                        'rgba(13, 110, 253, 1)',
                        'rgba(25, 135, 84, 1)',
                        'rgba(220, 53, 69, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(111, 66, 193, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'right' } }
            }
        });
    @endif
</script>
@endsection
