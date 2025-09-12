@extends('layouts.admin')

@section('page-title', 'Ajouter une Tranche')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-layer-group"></i> {{ isset($tranche) ? 'Modifier la Tranche' : 'Ajouter une Tranche' }}
                    </h6>
                </div>
                <div class="card-body">
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

                    <form method="POST" action="{{ isset($tranche) ? route('tranches.update', $tranche) : route('tranches.store') }}">
                        @csrf
                        @if(isset($tranche))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="nom_tranche" class="form-label">
                                <i class="fas fa-layer-group"></i> Nom de la Tranche <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nom_tranche') is-invalid @enderror" 
                                   id="nom_tranche" 
                                   name="nom_tranche" 
                                   value="{{ old('nom_tranche', isset($tranche) ? $tranche->nom_tranche : '') }}" 
                                   placeholder="Ex: Secteur A, Zone Nord, etc." 
                                   required>
                            @error('nom_tranche')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-info-circle"></i> Description (Optionnel)
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Description de la tranche...">{{ old('description', isset($tranche) ? $tranche->description : '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ isset($tranche) ? 'Mettre à jour' : 'Créer la Tranche' }}
                            </button>
                            <a href="{{ route('tranches.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
