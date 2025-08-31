@extends('layouts.app')

@section('title', 'Ajouter une Cotisation')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ajouter une Cotisation</h1>
                <a href="{{ route('cotisations.index') }}" class="btn btn-secondary">
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
                    <form action="{{ route('cotisations.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tranche_id" class="form-label">Section</label>
                                    <select name="tranche_id" id="tranche_id" class="form-select" required>
                                        <option value="">Choisir une section</option>
                                        @foreach($tranches as $tranche)
                                            <option value="{{ $tranche->id }}" {{ old('tranche_id') == $tranche->id ? 'selected' : '' }}>
                                                {{ $tranche->nom_tranche }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="immeuble_id" class="form-label">Immeuble</label>
                                    <select name="immeuble_id" id="immeuble_id" class="form-select" required>
                                        <option value="">Choisir un immeuble</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="appartement_id" class="form-label">Appartement</label>
                                    <select name="appartement_id" id="appartement_id" class="form-select" required>
                                        <option value="">Choisir un appartement</option>
                                        @foreach($appartements as $appartement)
                                            <option value="{{ $appartement->id }}" {{ old('appartement_id') == $appartement->id ? 'selected' : '' }}>
                                                {{ $appartement->immeuble->nom_immeuble }} - Apt {{ $appartement->numero }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="mois" class="form-label">Mois</label>
                                    <select name="mois" id="mois" class="form-select" required>
                                        <option value="">Choisir un mois</option>
                                        @foreach($months as $num => $name)
                                            <option value="{{ $num }}" {{ old('mois') == $num ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="annee" class="form-label">Année</label>
                                    <input type="number" name="annee" id="annee" class="form-control" 
                                           value="{{ old('annee', date('Y')) }}" min="2020" max="{{ date('Y') + 1 }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="montant_appartement" class="form-label">Montant Appartement (DH)</label>
                                    <input type="number" name="montant_appartement" id="montant_appartement" class="form-control" 
                                           value="{{ old('montant_appartement') }}" step="0.01" min="0" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="montant_garage" class="form-label">Montant Garage (DH)</label>
                                    <input type="number" name="montant_garage" id="montant_garage" class="form-control" 
                                           value="{{ old('montant_garage', 0) }}" step="0.01" min="0">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="montant_boxe" class="form-label">Montant Boxe (DH)</label>
                                    <input type="number" name="montant_boxe" id="montant_boxe" class="form-control" 
                                           value="{{ old('montant_boxe', 0) }}" step="0.01" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                            <a href="{{ route('cotisations.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('tranche_id').addEventListener('change', function() {
    const trancheId = this.value;
    const immeubleSelect = document.getElementById('immeuble_id');
    
    immeubleSelect.innerHTML = '<option value="">Choisir un immeuble</option>';
    
    if (trancheId) {
        fetch(`/admin/ajax/immeubles-by-tranche?tranche_id=${trancheId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(immeuble => {
                    const option = document.createElement('option');
                    option.value = immeuble.id;
                    option.textContent = immeuble.nom_immeuble;
                    immeubleSelect.appendChild(option);
                });
            });
    }
});

document.getElementById('immeuble_id').addEventListener('change', function() {
    const immeubleId = this.value;
    const appartementSelect = document.getElementById('appartement_id');
    
    appartementSelect.innerHTML = '<option value="">Choisir un appartement</option>';
    
    if (immeubleId) {
        fetch(`/admin/ajax/appartements-by-immeuble?immeuble_id=${immeubleId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(appartement => {
                    const option = document.createElement('option');
                    option.value = appartement.id;
                    option.textContent = `Apt ${appartement.numero} (Étage ${appartement.etage})`;
                    appartementSelect.appendChild(option);
                });
            });
    }
});
</script>
@endsection
