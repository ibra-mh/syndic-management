@extends('layouts.app')

@section('title', 'Ajouter un Type de Dépense')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ajouter un Type de Dépense</h1>
                <a href="{{ route('expense-types.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('expense-types.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nom_type" class="form-label">Nom du Type</label>
                            <input type="text" name="nom_type" id="nom_type" class="form-control" 
                                   value="{{ old('nom_type') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optionnel)</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                            <a href="{{ route('expense-types.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
