@extends('layouts.app')

@section('title', 'Détails de la Cotisation')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Détails de la Cotisation</h1>
                <a href="{{ route('cotisations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Informations générales</h5>
                    <p><strong>Appartement:</strong> {{ $cotisation->appartement->immeuble->nom_immeuble }} - Apt {{ $cotisation->appartement->numero }}</p>
                    <p><strong>Période:</strong> {{ $cotisation->mois }}/{{ $cotisation->annee }}</p>
                    <p><strong>Montant Total:</strong> {{ number_format($cotisation->total_amount, 2) }} DH</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
