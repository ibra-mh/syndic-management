@extends('layouts.app')

@section('page-title', 'Gestion des Appartements')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-end align-items-center mb-4">
        <button class="btn btn-primary" onclick="loadModal('{{ route('appartements.create') }}')">
            <i class="fas fa-plus"></i> Nouvel Appartement
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('appartements.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <label for="tranche_id" class="form-label">Tranche:</label>
                        <select name="tranche_id" id="tranche_id" class="form-select">
                            <option value="">Toutes les tranches</option>
                            @foreach($tranches as $tranche)
                                <option value="{{ $tranche->id }}" {{ request('tranche_id') == $tranche->id ? 'selected' : '' }}>
                                    {{ $tranche->nom_tranche }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="immeuble_id" class="form-label">Immeuble:</label>
                        <select name="immeuble_id" id="immeuble_id" class="form-select">
                            <option value="">Tous les immeubles</option>
                            @foreach($immeubles as $immeuble)
                                <option value="{{ $immeuble->id }}" {{ request('immeuble_id') == $immeuble->id ? 'selected' : '' }}>
                                    {{ $immeuble->nom_immeuble }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="nom_app" class="form-label">Nom Appartement:</label>
                        <input type="text" name="nom_app" id="nom_app" class="form-control" value="{{ request('nom_app') }}" placeholder="Rechercher...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-search"></i> Filtrer
                            </button>
                            <a href="{{ route('appartements.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau -->
    <div class="card">
        <div class="card-body">
            @if($appartements->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom Appartement</th>
                                <th>Immeuble</th>
                                <th>Tranche</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appartements as $appartement)
                                <tr>
                                    <td>{{ $appartement->id }}</td>
                                    <td>{{ $appartement->nom_app }}</td>
                                    <td>{{ $appartement->immeuble->nom_immeuble ?? 'N/A' }}</td>
                                    <td>{{ $appartement->immeuble->tranche->nom_tranche ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-info" onclick="loadModal('{{ route('appartements.show', $appartement->id) }}', 'viewModal')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary" onclick="loadModal('{{ route('appartements.edit', $appartement->id) }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ route('appartements.destroy', $appartement->id) }}', 'Supprimer cet appartement ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $appartements->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-door-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Aucun appartement trouvé</p>
                    <button class="btn btn-primary" onclick="loadModal('{{ route('appartements.create') }}')">
                        <i class="fas fa-plus"></i> Ajouter le premier appartement
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
