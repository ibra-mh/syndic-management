@extends('layouts.app')

@section('title', 'Détails de la Dépense')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Détails de la Dépense</h1>
                <a href="{{ route('depenses.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Informations générales</h5>
                    <p><strong>Type:</strong> {{ $depense->expenseType->nom_type }}</p>
                    <p><strong>Nature:</strong> {{ $depense->nature_depense }}</p>
                    <p><strong>Montant:</strong> {{ number_format($depense->montant, 2) }} DH</p>
                    <p><strong>Période:</strong> {{ $depense->mois }}/{{ $depense->annee }}</p>
                    @if($depense->detail)
                        <p><strong>Détail:</strong> {{ $depense->detail }}</p>
                    @endif
                    @if($depense->facture_image)
                        <p><strong>Facture:</strong> <a href="{{ asset('storage/' . $depense->facture_image) }}" target="_blank">Voir l'image</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
