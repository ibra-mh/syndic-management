@extends('layouts.admin')

@section('page-title', 'Gestion des Immeubles')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end mb-4">
        <div class="col-auto">
            <button class="btn btn-primary" onclick="loadModal('{{ route('buildings.create') }}')">
                <i class="fas fa-plus"></i> Ajouter un Immeuble
            </button>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Liste des Immeubles</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>Nom</th>
                            <th>Tranche</th>
                            <th>Créé le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($buildings as $building)
                            <tr>
                                {{-- <td>{{ $building->id }}</td> --}}
                                <td><strong>{{ $building->nom_immeuble }}</strong></td>
                                <td>{{ $building->tranche->nom_tranche ?? '-' }}</td>
                                <td>{{ $building->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" onclick="loadModal('{{ route('buildings.edit', $building) }}')">
                                        <i class="fas fa-edit"></i> Modifier
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('buildings.destroy', $building) }}', 'Êtes-vous sûr de vouloir supprimer cet immeuble ?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>Aucun immeuble trouvé.</p>
                                    <button class="btn btn-primary" onclick="loadModal('{{ route('buildings.create') }}')">
                                        <i class="fas fa-plus"></i> Ajouter le premier immeuble
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(isset($buildings) && method_exists($buildings, 'links'))
            <div class="card-footer">
                {{ $buildings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
