@extends('layouts.app')

@section('title', 'Détails de l\'Immeuble')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Détails de l'Immeuble</h1>
                <div>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('immeubles.edit', $immeuble->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                    @endif
                    <a href="{{ route('immeubles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Informations de l'Immeuble</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom de l'Immeuble</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $immeuble->nom_immeuble }}</strong>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tranche</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <span class="badge bg-info fs-6">{{ $immeuble->tranche->nom_tranche }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nombre d'Appartements</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <span class="badge bg-secondary fs-6">{{ $immeuble->appartements->count() }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date de création</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $immeuble->created_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Dernière modification</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $immeuble->updated_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Actions Rapides</h6>
                        </div>
                        <div class="card-body">
                            @if(auth()->user()->isAdmin())
                                <a href="#" class="btn btn-primary btn-sm mb-2 w-100">
                                    <i class="fas fa-home"></i> Ajouter un Appartement
                                </a>
                                <a href="#" class="btn btn-info btn-sm mb-2 w-100">
                                    <i class="fas fa-chart-bar"></i> Voir les Statistiques
                                </a>
                                <a href="{{ route('immeubles.edit', $immeuble->id) }}" class="btn btn-warning btn-sm mb-2 w-100">
                                    <i class="fas fa-edit"></i> Modifier l'Immeuble
                                </a>
                                <hr>
                                <form method="POST" action="{{ route('immeubles.destroy', $immeuble->id) }}" class="d-inline w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm w-100"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet immeuble ?')"
                                            {{ $immeuble->appartements->count() > 0 ? 'disabled' : '' }}>
                                        <i class="fas fa-trash"></i> Supprimer l'Immeuble
                                    </button>
                                </form>
                                @if($immeuble->appartements->count() > 0)
                                    <small class="text-muted">
                                        Impossible de supprimer : contient des appartements
                                    </small>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Apartments List -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Appartements dans cet Immeuble</h6>
                    @if(auth()->user()->isAdmin())
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Ajouter un Appartement
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($immeuble->appartements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nom de l'Appartement</th>
                                        <th>Garage</th>
                                        <th>Boxe</th>
                                        <th>Date de création</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($immeuble->appartements as $appartement)
                                        <tr>
                                            <td><strong>{{ $appartement->nom_app }}</strong></td>
                                            <td>
                                                @if($appartement->has_garage ?? false)
                                                    <span class="badge bg-success">Oui</span>
                                                @else
                                                    <span class="badge bg-secondary">Non</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($appartement->has_boxe ?? false)
                                                    <span class="badge bg-success">Oui</span>
                                                @else
                                                    <span class="badge bg-secondary">Non</span>
                                                @endif
                                            </td>
                                            <td>{{ $appartement->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="#" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if(auth()->user()->isAdmin())
                                                        <a href="#" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-home fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun appartement dans cet immeuble</h5>
                            <p class="text-muted">Commencez par ajouter le premier appartement à cet immeuble.</p>
                            @if(auth()->user()->isAdmin())
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Ajouter un Appartement
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection