@extends('layouts.app')

@section('title', 'Gestion des Types de Dépenses')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Types de Dépenses</h1>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('expense-types.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter un Type
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

            <!-- Types Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom du Type</th>
                                    <th>Description</th>
                                    <th>Nombre de Dépenses</th>
                                    <th>Date Création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($expenseTypes as $type)
                                    <tr>
                                        <td>{{ $type->id }}</td>
                                        <td>
                                            <strong>{{ $type->nom_type }}</strong>
                                        </td>
                                        <td>{{ $type->description ?? 'Aucune description' }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $type->depenses_count ?? 0 }} dépenses</span>
                                        </td>
                                        <td>{{ $type->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('expense-types.show', $type) }}" class="btn btn-sm btn-info">Voir</a>
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('expense-types.edit', $type) }}" class="btn btn-sm btn-warning">Modifier</a>
                                                <form action="{{ route('expense-types.destroy', $type) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr? Cette action supprimera le type et toutes les dépenses associées.')">Supprimer</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun type de dépense trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $expenseTypes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
