@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifier l'Appartement</div>
                <div class="card-body">
                    <form action="{{ route('appartements.update', $appartement->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="immeuble_id" class="form-label">Immeuble:</label>
                            <select name="immeuble_id" id="immeuble_id" class="form-select @error('immeuble_id') is-invalid @enderror" required>
                                <option value="">Sélectionner un immeuble</option>
                                @foreach($immeubles as $immeuble)
                                    <option value="{{ $immeuble->id }}" {{ (old('immeuble_id', $appartement->immeuble_id) == $immeuble->id) ? 'selected' : '' }}>
                                        {{ $immeuble->nom_immeuble }} ({{ $immeuble->tranche->nom_tranche ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('immeuble_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nom_app" class="form-label">Nom Appartement:</label>
                            <input type="text" name="nom_app" id="nom_app" 
                                   class="form-control @error('nom_app') is-invalid @enderror" 
                                   value="{{ old('nom_app', $appartement->nom_app) }}" 
                                   placeholder="Ex: A1, B2, etc." required>
                            @error('nom_app')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('appartements.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
