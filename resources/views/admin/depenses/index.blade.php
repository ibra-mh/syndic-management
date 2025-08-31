@extends('layouts.app')

@section('page-title', 'Gestion des Dépenses')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end align-items-center mb-4">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('depenses.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter une Dépense
                    </a>
                @endif
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Filtres</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('depenses.index') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="annee" class="form-label">Année</label>
                                <select name="annee" id="annee" class="form-select">
                                    <option value="">Toutes les années</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ request('annee') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="mois" class="form-label">Mois</label>
                                <select name="mois" id="mois" class="form-select">
                                    <option value="">Tous les mois</option>
                                    @foreach($months as $num => $name)
                                        <option value="{{ $num }}" {{ request('mois') == $num ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="expense_type_id" class="form-label">Type de Dépense</label>
                                <select name="expense_type_id" id="expense_type_id" class="form-select">
                                    <option value="">Tous les types</option>
                                    @foreach($expenseTypes as $type)
                                        <option value="{{ $type->id }}" {{ request('expense_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->nom_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="nature_depense" class="form-label">Nature</label>
                                <input type="text" name="nature_depense" id="nature_depense" class="form-control" 
                                       value="{{ request('nature_depense') }}" placeholder="Rechercher...">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                    <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Dépenses Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Nature</th>
                                    <th>Mois/Année</th>
                                    <th>Montant</th>
                                    <th>Facture</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($depenses as $depense)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $depense->expenseType->nom_type }}</span>
                                        </td>
                                        <td>{{ $depense->nature_depense }}</td>
                                        <td>{{ $months[$depense->mois] }} {{ $depense->annee }}</td>
                                        <td><strong>{{ number_format($depense->montant, 2) }} DH</strong></td>
                                        <td>
                                            @if($depense->facture_image)
                                                <a href="{{ asset('storage/' . $depense->facture_image) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-image"></i> Voir
                                                </a>
                                            @else
                                                <span class="text-muted">Aucune</span>
                                            @endif
                                        </td>
                                        <td>{{ $depense->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('depenses.show', $depense) }}" class="btn btn-sm btn-info">Voir</a>
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('depenses.edit', $depense) }}" class="btn btn-sm btn-warning">Modifier</a>
                                                <form action="{{ route('depenses.destroy', $depense) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Aucune dépense trouvée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $depenses->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
