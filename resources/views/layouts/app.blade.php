<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinique - Backoffice</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: #0d6efd;
            color: white;
        }
        .sidebar a {
            color: #dbeafe;
            text-decoration: none;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #0b5ed7;
            color: #fff;
            border-radius: .375rem;
        }
        .content {
            padding: 2rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 1050;
                left: -250px;
                top: 0;
                width: 250px;
                transition: left 0.3s;
            }
            .sidebar.show {
                left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container-fluid">
            <button class="btn btn-primary d-lg-none me-3" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand fw-bold text-primary" href="{{ route('welcome') }}">🏥 Clinique</a>

            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-4 me-2"></i> Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        {{-- <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item">Se déconnecter</button>
                            </form>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-2 sidebar p-3 collapse d-lg-block" id="sidebarMenu">
                <h5 class="fw-bold mb-4">Menu</h5>
                <ul class="nav flex-column gap-2">
                    <li><a href="{{ route('patients.index') }}" class="nav-link px-2 {{ request()->routeIs('patients.*') ? 'active' : '' }}"><i class="bi bi-people me-2"></i> Patients</a></li>
                    <li><a href="{{ route('medecins.index') }}" class="nav-link px-2 {{ request()->routeIs('medecins.*') ? 'active' : '' }}"><i class="bi bi-person-badge me-2"></i> Médecins</a></li>
                    <li><a href="{{ route('rendezvous.index') }}" class="nav-link px-2 {{ request()->routeIs('rendezvous.*') ? 'active' : '' }}"><i class="bi bi-calendar-check me-2"></i> Rendez-vous</a></li>
                    <li><a href="{{ route('factures.index') }}" class="nav-link px-2 {{ request()->routeIs('factures.*') ? 'active' : '' }}"><i class="bi bi-receipt me-2"></i> Factures</a></li>
                    <li><a href="{{ route('statistiques.index') }}" class="nav-link px-2 {{ request()->routeIs('statistiques.*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line me-2"></i> Statistiques</a></li>
                </ul>
            </div>

            <!-- Contenu principal -->
            <main class="col-lg-10 ms-auto content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar responsive
        const sidebar = document.getElementById('sidebarMenu');
        const toggleBtn = document.getElementById('sidebarToggle');
        toggleBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
    </script>
</body>
</html>
