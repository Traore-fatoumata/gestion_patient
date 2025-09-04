<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-container {
            display: flex;
            flex: 1;
        }
        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: white;
            flex-shrink: 0;
            padding-top: 20px;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        /* Contenu principal */
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
        /* Mobile: cacher sidebar par défaut */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 56px; /* hauteur navbar */
                left: 0;
                height: calc(100% - 56px);
                transform: translateX(-100%);
                z-index: 1050;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .overlay {
                display: none;
                position: fixed;
                top: 56px;
                left: 0;
                width: 100%;
                height: calc(100% - 56px);
                background: rgba(0,0,0,0.5);
                z-index: 1040;
            }
            .overlay.show {
                display: block;
            }
        }
    </style>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <!-- Hamburger pour mobile -->
                <button class="navbar-toggler" type="button" id="sidebarToggle" aria-label="Toggle sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Container -->
        <div class="main-container">
            <!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <h4 class="px-3">Data Clinique Center</h4>
                <a href="{{ url('/') }}">🏠 Accueil</a>
                <a href="{{ route('patients.index') }}">👨⚕️ Patients</a>
                <a href="{{ route('medecins.index') }}">🩺 Médecins</a>
                <a href="#">📅 Rendez-vous</a>
                <a href="#">💊 Consultations</a>
                <a href="#">📑 Ordonnances</a>
                <a href="#">💵 Factures</a>
                <a href="#">📊 Statistiques</a>
            </div>

            <!-- Overlay pour mobile -->
            <div class="overlay" id="overlay"></div>

            <!-- Contenu principal -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>
</body>
</html>
