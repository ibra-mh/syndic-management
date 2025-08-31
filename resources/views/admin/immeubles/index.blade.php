@extends('layouts.app')

@section('page-title', 'Gestion des Immeubles')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end align-items-center mb-4">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('immeubles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter un Immeuble
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

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des Immeubles</h6>
                </div>
                <div class="card-body">
                    @if($immeubles->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom de l'Immeuble</th>
                                        <th>Tranche</th>
                                        <th>Nombre d'Appartements</th>
                                        <th>Date de Création</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($immeubles as $immeuble)
                                        <tr>
                                            <td>{{ $immeuble->id }}</td>
                                            <td>
                                                <strong>{{ $immeuble->nom_immeuble }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $immeuble->tranche->nom_tranche }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $immeuble->appartements_count ?? $immeuble->appartements->count() }}
                                                </span>
                                            </td>
                                            <td>{{ $immeuble->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('immeubles.show', $immeuble->id) }}" 
                                                       class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if(auth()->user()->isAdmin())
                                                        <a href="{{ route('immeubles.edit', $immeuble->id) }}" 
                                                           class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form method="POST" 
                                                              action="{{ route('immeubles.destroy', $immeuble->id) }}" 
                                                              class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet immeuble ?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            {{ $immeubles->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-building fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun immeuble trouvé</h5>
                            <p class="text-muted">Commencez par ajouter votre premier immeuble.</p>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('immeubles.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Ajouter un Immeuble
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