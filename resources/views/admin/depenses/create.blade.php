@extends('layouts.app')

@section('title', 'Ajouter une Dépense')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ajouter une Dépense</h1>
                <a href="{{ route('depenses.index') }}" class="btn btn-secondary">
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
                    <form action="{{ route('depenses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expense_type_id" class="form-label">Type de Dépense</label>
                                    <select name="expense_type_id" id="expense_type_id" class="form-select" required>
                                        <option value="">Choisir un type</option>
                                        @foreach($expenseTypes as $type)
                                            <option value="{{ $type->id }}" {{ old('expense_type_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->nom_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nature_depense" class="form-label">Nature de la Dépense</label>
                                    <input type="text" name="nature_depense" id="nature_depense" class="form-control" 
                                           value="{{ old('nature_depense') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="montant" class="form-label">Montant (DH)</label>
                                    <input type="number" name="montant" id="montant" class="form-control" 
                                           value="{{ old('montant') }}" step="0.01" min="0" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="mois" class="form-label">Mois</label>
                                    <select name="mois" id="mois" class="form-select" required>
                                        <option value="">Choisir un mois</option>
                                        @foreach($months as $num => $name)
                                            <option value="{{ $num }}" {{ old('mois', date('n')) == $num ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="annee" class="form-label">Année</label>
                                    <input type="number" name="annee" id="annee" class="form-control" 
                                           value="{{ old('annee', date('Y')) }}" min="2020" max="{{ date('Y') + 1 }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="detail" class="form-label">Détail (Optionnel)</label>
                            <textarea name="detail" id="detail" class="form-control" rows="3">{{ old('detail') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="facture_image" class="form-label">Image de la Facture (Optionnel)</label>
                            <input type="file" name="facture_image" id="facture_image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Formats acceptés: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                            <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
