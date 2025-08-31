@extends('layouts.admin')

@section('page-title', 'Gestion des Tranches')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end mb-4">
        @if(auth()->user()->isAdmin())
        <div class="col-auto">
            <button class="btn btn-primary" onclick="loadModal('{{ route('tranches.create') }}')">
                <i class="fas fa-plus"></i> Ajouter Nouvelle Tranche
            </button>
        </div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Liste des Tranches</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Nombre d'Immeubles</th>
                            <th>Créé le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tranches as $tranche)
                            <tr>
                                <td>{{ $tranche->id }}</td>
                                <td><strong>{{ $tranche->nom_tranche }}</strong></td>
                                <td>
                                    <span class="badge bg-info">{{ $tranche->immeubles_count ?? $tranche->immeubles->count() }}</span>
                                </td>
                                <td>{{ $tranche->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="loadModal('{{ route('tranches.show', $tranche) }}', 'viewModal')">
                                        <i class="fas fa-eye"></i> Voir
                                    </button>
                                    @if(auth()->user()->isAdmin())
                                        <button class="btn btn-sm btn-warning" onclick="loadModal('{{ route('tranches.edit', $tranche) }}')">
                                            <i class="fas fa-edit"></i> Modifier
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('tranches.destroy', $tranche) }}', 'Êtes-vous sûr de vouloir supprimer cette tranche ?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>Aucune tranche trouvée.</p>
                                    @if(auth()->user()->isAdmin())
                                        <button class="btn btn-primary" onclick="loadModal('{{ route('tranches.create') }}')">
                                            <i class="fas fa-plus"></i> Créer la première tranche
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($tranches) && method_exists($tranches, 'links'))
            <div class="card-footer">
                {{ $tranches->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
