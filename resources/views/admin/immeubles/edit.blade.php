@extends('layouts.app')

@section('title', 'Modifier l\'Immeuble')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Modifier l'Immeuble</h1>
                <div>
                    <a href="{{ route('immeubles.show', $immeuble->id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('immeubles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Modifier les informations</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('immeubles.update', $immeuble->id) }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="nom_immeuble" class="form-label">Nom de l'Immeuble <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('nom_immeuble') is-invalid @enderror" 
                                           id="nom_immeuble" 
                                           name="nom_immeuble" 
                                           value="{{ old('nom_immeuble', $immeuble->nom_immeuble) }}" 
                                           required
                                           placeholder="Ex: Immeuble A, Résidence Les Palmiers, etc.">
                                    @error('nom_immeuble')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tranche_id" class="form-label">Tranche <span class="text-danger">*</span></label>
                                    <select class="form-select @error('tranche_id') is-invalid @enderror" 
                                            id="tranche_id" 
                                            name="tranche_id" 
                                            required>
                                        <option value="">Sélectionnez une tranche</option>
                                        @foreach($tranches as $tranche)
                                            <option value="{{ $tranche->id }}" 
                                                    {{ (old('tranche_id', $immeuble->tranche_id) == $tranche->id) ? 'selected' : '' }}>
                                                {{ $tranche->nom_tranche }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tranche_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="alert alert-info">
                                    <small>
                                        <strong>Note:</strong> Cet immeuble contient actuellement 
                                        {{ $immeuble->appartements()->count() }} appartement(s).
                                        @if($immeuble->appartements()->count() > 0)
                                            La modification de la tranche pourrait affecter l'organisation des appartements.
                                        @endif
                                    </small>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('immeubles.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Annuler
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Enregistrer les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection