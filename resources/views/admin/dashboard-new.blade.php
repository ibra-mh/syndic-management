@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>GESTION SYNDIC</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tranches.index') }}">
                            <i class="fas fa-layer-group"></i> Tranches
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('immeubles.index') }}">
                            <i class="fas fa-building"></i> Immeubles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('appartements.index') }}">
                            <i class="fas fa-door-open"></i> Appartements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cotisations.index') }}">
                            <i class="fas fa-money-bill-wave"></i> Cotisations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('depenses.index') }}">
                            <i class="fas fa-receipt"></i> Dépenses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('expense-types.index') }}">
                            <i class="fas fa-tags"></i> Types de Dépenses
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
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

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard Syndic</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-primary" onclick="loadModal('{{ route('depenses.create') }}')">
                            <i class="fas fa-plus"></i> Nouvelle Dépense
                        </button>
                    </div>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total des Cotisations
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($totalCotisations ?? 0, 2) }} MAD
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Dépenses
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($totalDepenses ?? 0, 2) }} MAD
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-receipt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Solde
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format(($totalCotisations ?? 0) - ($totalDepenses ?? 0), 2) }} MAD
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-balance-scale fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Appartements
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalAppartements ?? 0 }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-door-open fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtres et tableau des dépenses -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Consulter les Dépenses</h6>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Filtrer par type: {{ request('type_filter') ? ucfirst(request('type_filter')) : 'Tous les types' }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">Tous les types</a></li>
                                    @if(isset($expenseTypes))
                                        @foreach($expenseTypes as $type)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('dashboard', ['type_filter' => $type->id]) }}">
                                                    {{ $type->type_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(isset($depenses) && $depenses->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Type de Dépense</th>
                                                <th>Année</th>
                                                <th>Mois</th>
                                                <th>Montant</th>
                                                <th>Détail</th>
                                                <th>Nature de Dépense</th>
                                                <th>Facture/Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($depenses as $depense)
                                                <tr>
                                                    <td>{{ $depense->id }}</td>
                                                    <td>{{ $depense->expenseType->type_name ?? 'N/A' }}</td>
                                                    <td>{{ $depense->annee }}</td>
                                                    <td>{{ $depense->mois }}</td>
                                                    <td>{{ number_format($depense->montant, 2) }} MAD</td>
                                                    <td>{{ Str::limit($depense->detail, 30) }}</td>
                                                    <td>
                                                        <span class="badge bg-info">{{ ucfirst($depense->nature_expense) }}</span>
                                                    </td>
                                                    <td>
                                                        @if($depense->facture_image)
                                                            <button class="btn btn-sm btn-outline-info" onclick="loadModal('{{ route('depenses.show', $depense->id) }}', 'viewModal')">
                                                                Voir
                                                            </button>
                                                        @else
                                                            <span class="text-muted">Aucune</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-sm btn-outline-primary" onclick="loadModal('{{ route('depenses.edit', $depense->id) }}')">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ route('depenses.destroy', $depense->id) }}', 'Supprimer cette dépense ?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if(isset($totalDepensesFiltered))
                                    <div class="alert alert-info mt-3">
                                        <strong>Total des dépenses filtrées :</strong> {{ number_format($totalDepensesFiltered, 2) }} MAD
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aucune dépense trouvée</p>
                                    <button class="btn btn-primary" onclick="loadModal('{{ route('depenses.create') }}')">
                                        <i class="fas fa-plus"></i> Ajouter la première dépense
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.sidebar {
    position: fixed;
    top: 56px;
    bottom: 0;
    left: 0;
    z-index: 100;
    padding: 48px 0 0;
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

.sidebar-sticky {
    position: relative;
    top: 0;
    height: calc(100vh - 48px);
    padding-top: .5rem;
    overflow-x: hidden;
    overflow-y: auto;
}

.sidebar .nav-link {
    font-weight: 500;
    color: #333;
}

.sidebar .nav-link:hover {
    color: #007bff;
}

.sidebar .nav-link.active {
    color: #007bff;
}

.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

@media (max-width: 767.98px) {
    .sidebar {
        top: 0;
        position: relative;
    }
}
</style>
@endsection
