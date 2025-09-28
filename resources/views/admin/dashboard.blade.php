@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('top-actions')
@unless(isset($isClient) && $isClient)
<button type="button" class="btn btn-primary" onclick="loadModal('{{ route('depenses.create') }}')">
    <i class="fas fa-plus"></i> Nouvelle Dépense
</button>
@endunless
@endsection

@section('content')
<div class="container-fluid">
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
                                                @unless(isset($isClient) && $isClient)
                                                <th>Actions</th>
                                                @endunless
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($depenses as $depense)
                                                <tr>
                                                    <td>{{ $depense->id }}</td>
                                                    <td>{{ $depense->expenseType->nom_type ?? 'N/A' }}</td>
                                                    <td>{{ $depense->annee }}</td>
                                                    <td>{{ $depense->mois }}</td>
                                                    <td>{{ number_format($depense->montant, 2) }} MAD</td>
                                                    <td>{{ Str::limit($depense->detail, 30) }}</td>
                                                    <td>{{ $depense->nature_depense }}</td>
                                                    <td>
                                                        @if($depense->facture_image)
                                                            <a href="{{ asset('storage/' . $depense->facture_image) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                                <i class="fas fa-image"></i> Voir
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Aucune</span>
                                                        @endif
                                                    </td>
                                                    @unless(isset($isClient) && $isClient)
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-sm btn-warning" onclick="loadModal('{{ route('depenses.edit', $depense->id) }}')">
                                                                <i class="fas fa-pen"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('depenses.destroy', $depense->id) }}', 'Supprimer cette dépense ?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    @endunless
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
                                    @unless(isset($isClient) && $isClient)
                                    <button class="btn btn-primary" onclick="loadModal('{{ route('depenses.create') }}')">
                                        <i class="fas fa-plus"></i> Ajouter la première dépense
                                    </button>
                                    @endunless
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
