@extends('layouts.app')

@section('title', 'Détails du Type de Dépense')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Détails du Type de Dépense</h1>
                <a href="{{ route('expense-types.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Informations générales</h5>
                    <p><strong>Nom:</strong> {{ $expenseType->nom_type }}</p>
                    <p><strong>Description:</strong> {{ $expenseType->description ?? 'Aucune description' }}</p>
                    <p><strong>Créé le:</strong> {{ $expenseType->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
