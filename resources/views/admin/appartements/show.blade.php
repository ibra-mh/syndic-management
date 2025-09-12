@extends('layouts.admin')

@section('page-title', 'Détails de l\'Appartement')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Détails de l'Appartement
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informations de base</h5>
                            <p><strong>ID:</strong> {{ $appartement->id }}</p>
                            <p><strong>Nom:</strong> {{ $appartement->numero }}</p>
                            <p><strong>Immeuble:</strong> {{ $appartement->immeuble->nom_immeuble ?? 'N/A' }}</p>
                            <p><strong>Tranche:</strong> {{ $appartement->immeuble->tranche->nom_tranche ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Statistiques</h5>
                            <p><strong>Cotisations:</strong> {{ $appartement->cotisations->count() }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('appartements.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                        <div>
                            <a href="{{ route('appartements.edit', $appartement->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
