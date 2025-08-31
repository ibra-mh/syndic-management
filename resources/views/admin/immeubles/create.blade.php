@extends('layouts.app')

@section('title', 'Ajouter un Immeuble')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ajouter un Immeuble</h1>
                <a href="{{ route('immeubles.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Informations de l'Immeuble</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('immeubles.store') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="nom_immeuble" class="form-label">Nom de l'Immeuble <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('nom_immeuble') is-invalid @enderror" 
                                           id="nom_immeuble" 
                                           name="nom_immeuble" 
                                           value="{{ old('nom_immeuble') }}" 
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
                                                    {{ old('tranche_id') == $tranche->id ? 'selected' : '' }}>
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

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('immeubles.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Annuler
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Enregistrer l'Immeuble
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