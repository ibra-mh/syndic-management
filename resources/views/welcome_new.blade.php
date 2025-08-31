<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Syndic Pro - Gestion Immobilière</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Figtree', sans-serif;
        }
        
        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .brand-logo {
            font-size: 3rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        
        .btn-custom {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .btn-outline-custom {
            border: 2px solid #667eea;
            color: #667eea;
            background: transparent;
            border-radius: 50px;
            padding: 10px 28px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center min-vh-100">
        <div class="welcome-card p-5 text-center" style="max-width: 800px; width: 90%;">
            <!-- Header -->
            <div class="mb-5">
                <div class="brand-logo fw-bold mb-3">
                    <i class="fas fa-building"></i> Syndic Pro
                </div>
                <h2 class="text-muted mb-4">Plateforme de Gestion Immobilière</h2>
                <p class="lead text-secondary">
                    Solution complète pour la gestion des syndics, immeubles, appartements et finances
                </p>
            </div>

            <!-- Features -->
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h5>Gestion Immeubles</h5>
                    <p class="text-muted">Gérez vos immeubles et appartements facilement</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h5>Finances</h5>
                    <p class="text-muted">Suivi des cotisations et dépenses en temps réel</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5>Reporting</h5>
                    <p class="text-muted">Tableaux de bord et statistiques détaillées</p>
                </div>
            </div>

            <!-- Auth Links -->
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-custom">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-custom">
                            <i class="fas fa-sign-in-alt me-2"></i>Connexion
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-outline-custom">
                                <i class="fas fa-user-plus me-2"></i>Inscription
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Footer -->
            <div class="mt-5 pt-4 border-top">
                <p class="text-muted small mb-0">
                    &copy; {{ date('Y') }} Syndic Pro - Tous droits réservés
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
