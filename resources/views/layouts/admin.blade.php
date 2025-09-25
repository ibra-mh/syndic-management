<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Syndic Pro - Gestion Immobilière')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- Custom styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Modern Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            width: 250px;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            border-right: none;
            overflow-y: auto;
        }

        .sidebar * {
            background: transparent !important;
        }

        .sidebar .position-sticky {
            padding: 20px 0;
            background: transparent !important;
        }

        /* Sidebar Headers */
        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7) !important;
            padding: 0 1.5rem;
            margin: 1.5rem 0 0.5rem 0;
        }

        .sidebar-heading:first-child {
            margin-top: 0;
        }

        /* App Brand */
        .sidebar-brand {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }

        .sidebar-brand small {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
        }

        /* Navigation Links */
        .sidebar .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            padding: 12px 24px;
            margin: 2px 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
            background: none;
            text-align: left;
            width: calc(100% - 16px);
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .sidebar .nav-link i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }

        /* Action Buttons */
        .sidebar .btn-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .sidebar .btn-link:hover {
            color: #fff;
        }

        .sidebar .text-danger {
            color: #ff6b6b !important;
        }

        .sidebar .text-danger:hover {
            color: #ff5252 !important;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            background: #f8f9fc;
            width: calc(100% - 250px);
            position: relative;
        }

        /* Top Bar */
        .top-bar {
            background: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e3e6f0;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .page-title {
            margin: 0;
            color: #5a5c69;
            font-weight: 600;
        }

        /* Content Area */
        .content-area {
            padding: 2rem;
        }

        /* Modern Cards */
        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
            border: none;
            border-radius: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.25rem 2rem 0 rgba(58, 59, 69, 0.25) !important;
        }

        /* Responsive Design */
        @media (max-width: 767.98px) {
            .sidebar {
                top: 0;
                width: 100%;
                height: auto;
                position: relative;
                background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        /* Scrollbar Styling for Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <!-- Sidebar for Admin -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h4><i class="fas fa-building"></i> Syndic Pro</h4>
            <small>Gestion Immobilière</small>
        </div>
        
        <div class="position-sticky">
            <h6 class="sidebar-heading">
                <span>GESTION SYNDIC</span>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tranches.*') ? 'active' : '' }}" href="{{ route('tranches.index') }}">
                        <i class="fas fa-layer-group"></i> Tranches
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('buildings.*') ? 'active' : '' }}" href="{{ route('buildings.index') }}">
                        <i class="fas fa-city"></i> Immeubles
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('appartements.*') ? 'active' : '' }}" href="{{ route('appartements.index') }}">
                        <i class="fas fa-door-open"></i> Appartements
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cotisations.*') ? 'active' : '' }}" href="{{ route('cotisations.index') }}">
                        <i class="fas fa-money-bill-wave"></i> Cotisations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('depenses.*') ? 'active' : '' }}" href="{{ route('depenses.index') }}">
                        <i class="fas fa-receipt"></i> Dépenses
                    </a>
                </li>
                @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('expense-types.*') ? 'active' : '' }}" href="{{ route('expense-types.index') }}">
                        <i class="fas fa-tags"></i> Types de Dépenses
                    </a>
                </li>
                @endif
            </ul>

            @if(auth()->user()->isAdmin())
            <h6 class="sidebar-heading">
                <span>Actions Rapides</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <button class="nav-link btn btn-link text-start" onclick="loadModal('{{ route('depenses.create') }}')">
                        <i class="fas fa-plus"></i> Ajouter Dépense
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-link text-start" onclick="loadModal('{{ route('expense-types.create') }}')">
                        <i class="fas fa-plus"></i> Nouveau Type
                    </button>
                </li>
            @endif
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-start text-danger">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            <div class="d-flex align-items-center">
                <span class="text-muted me-3">Bonjour, {{ Auth::user()->name }}</span>
                <div class="btn-group">
                    @yield('top-actions')
                </div>
            </div>
        </div>
        
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <!-- Modals génériques -->
    <!-- Modal pour ajouter/éditer -->
    <div class="modal fade" id="formModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="formModalContent">
                    <!-- Le contenu sera chargé ici -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour voir les détails -->
    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="viewModalContent">
                    <!-- Le contenu sera chargé ici -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Scripts pour les modals -->
    <script>
        // Fonction pour charger le contenu dans un modal
        function loadModal(url, modalId = 'formModal') {
            console.log('Loading modal from URL:', url);
            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.text();
                })
                .then(html => {
                    console.log('Received HTML length:', html.length);
                    document.getElementById(modalId + 'Content').innerHTML = html;
                    const modal = new bootstrap.Modal(document.getElementById(modalId));
                    modal.show();
                })
                .catch(error => {
                    console.error('Erreur lors du chargement du modal:', error);
                    alert('Erreur lors du chargement du formulaire: ' + error.message);
                });
        }

        // Fonction pour soumettre un formulaire via AJAX
        function submitModalForm(form, modalId = 'formModal') {
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.redirected || response.ok) {
                    // Fermer le modal et recharger la page
                    bootstrap.Modal.getInstance(document.getElementById(modalId)).hide();
                    window.location.reload();
                } else {
                    return response.text().then(text => {
                        document.getElementById(modalId + 'Content').innerHTML = text;
                    });
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de la soumission du formulaire');
            });
        }

        // Fonction pour supprimer un élément
        function confirmDelete(url, message = 'Êtes-vous sûr de vouloir supprimer cet élément ?') {
            if (confirm(message)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
