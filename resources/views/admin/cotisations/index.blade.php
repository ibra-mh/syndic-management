@extends('layouts.admin')

@section('page-title', 'Gestion des Cotisations')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end align-items-center mb-4">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('cotisations.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter une Cotisation
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
                    <form method="GET" action="{{ route('cotisations.index') }}">
                        <div class="row">
                            <div class="col-md-3">
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
                            <div class="col-md-3">
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
                            <div class="col-md-4">
                                <label for="appartement_id" class="form-label">Appartement</label>
                                <select name="appartement_id" id="appartement_id" class="form-select">
                                    <option value="">Tous les appartements</option>
                                    @foreach($appartements as $appartement)
                                        <option value="{{ $appartement->id }}" {{ request('appartement_id') == $appartement->id ? 'selected' : '' }}>
                                            {{ $appartement->immeuble->nom_immeuble }} - Apt {{ $appartement->numero }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                    <a href="{{ route('cotisations.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cotisations Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Appartement</th>
                                    <th>Mois/Année</th>
                                    <th>Montant Apt</th>
                                    <th>Montant Garage</th>
                                    <th>Montant Boxe</th>
                                    <th>Total</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cotisations as $cotisation)
                                    <tr>
                                        <td>
                                            <strong>{{ $cotisation->appartement->immeuble->nom_immeuble }}</strong><br>
                                            <small class="text-muted">Apt {{ $cotisation->appartement->numero }} ({{ $cotisation->appartement->immeuble->tranche->nom_tranche }})</small>
                                        </td>
                                        <td>
                                            {{ $months[$cotisation->mois] }} {{ $cotisation->annee }}
                                        </td>
                                        <td>{{ number_format($cotisation->montant_appartement, 2) }} DH</td>
                                        <td>{{ number_format($cotisation->montant_garage, 2) }} DH</td>
                                        <td>{{ number_format($cotisation->montant_boxe, 2) }} DH</td>
                                        <td><strong>{{ number_format($cotisation->total_amount, 2) }} DH</strong></td>
                                        <td>
                                            <span class="badge bg-{{ $cotisation->status_color }}">
                                                {{ $cotisation->status_text }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('cotisations.show', $cotisation) }}" class="btn btn-sm btn-info">Voir</a>
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('cotisations.edit', $cotisation) }}" class="btn btn-sm btn-warning">Modifier</a>
                                                <form action="{{ route('cotisations.destroy', $cotisation) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Aucune cotisation trouvée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $cotisations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
