<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">Modifier la Cotisation</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form method="POST" action="{{ route('cotisations.update', $cotisation) }}" 
          onsubmit="submitModalForm(this); return false;">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Appartement Selection -->
            <div class="col-md-6 mb-3">
                <label for="appartement_id" class="form-label">
                    <i class="fas fa-home"></i> Appartement <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('appartement_id') is-invalid @enderror" 
                        id="appartement_id" name="appartement_id" required>
                    <option value="">Sélectionner un appartement</option>
                    @foreach($appartements as $appartement)
                        <option value="{{ $appartement->id }}" {{ old('appartement_id', $cotisation->appartement_id) == $appartement->id ? 'selected' : '' }}>
                            {{ $appartement->numero }} - {{ $appartement->immeuble->nom_immeuble ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
                @error('appartement_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Montant Appartement -->
            <div class="col-md-4 mb-3">
                <label for="montant_appartement" class="form-label">
                    <i class="fas fa-money-bill-wave"></i> Montant Appartement (DH) <span class="text-danger">*</span>
                </label>
                <input type="number" step="0.01" class="form-control @error('montant_appartement') is-invalid @enderror" 
                       id="montant_appartement" name="montant_appartement" value="{{ old('montant_appartement', $cotisation->montant_appartement) }}" 
                       placeholder="Ex: 250.00" required>
                @error('montant_appartement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Montant Garage -->
            <div class="col-md-4 mb-3">
                <label for="montant_garage" class="form-label">
                    <i class="fas fa-warehouse"></i> Montant Garage (DH)
                </label>
                <input type="number" step="0.01" class="form-control @error('montant_garage') is-invalid @enderror" 
                       id="montant_garage" name="montant_garage" value="{{ old('montant_garage', $cotisation->montant_garage) }}" 
                       placeholder="Ex: 100.00">
                @error('montant_garage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Montant Boxe -->
            <div class="col-md-4 mb-3">
                <label for="montant_boxe" class="form-label">
                    <i class="fas fa-box"></i> Montant Boxe (DH)
                </label>
                <input type="number" step="0.01" class="form-control @error('montant_boxe') is-invalid @enderror" 
                       id="montant_boxe" name="montant_boxe" value="{{ old('montant_boxe', $cotisation->montant_boxe) }}" 
                       placeholder="Ex: 50.00">
                @error('montant_boxe')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Mois -->
            <div class="col-md-3 mb-3">
                <label for="mois" class="form-label">
                    <i class="fas fa-calendar"></i> Mois <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('mois') is-invalid @enderror" id="mois" name="mois" required>
                    <option value="">Sélectionner un mois</option>
                    @foreach([1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre'] as $num => $name)
                        <option value="{{ $num }}" {{ old('mois', $cotisation->mois) == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('mois')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Année -->
            <div class="col-md-3 mb-3">
                <label for="annee" class="form-label">
                    <i class="fas fa-calendar"></i> Année <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('annee') is-invalid @enderror" id="annee" name="annee" required>
                    <option value="">Sélectionner une année</option>
                    @for($y = date('Y')-1; $y <= date('Y')+2; $y++)
                        <option value="{{ $y }}" {{ old('annee', $cotisation->annee) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                @error('annee')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Status removed -->
        </div>

        <div class="row">
            <!-- Date de paiement -->
            <div class="col-md-12 mb-3">
                <label for="date_paiement" class="form-label">
                    <i class="fas fa-calendar-check"></i> Date de Paiement
                </label>
                <input type="date" class="form-control @error('date_paiement') is-invalid @enderror" 
                       id="date_paiement" name="date_paiement" value="{{ old('date_paiement', $cotisation->date_paiement) }}">
                <small class="form-text text-muted">Laissez vide si pas encore payé</small>
                @error('date_paiement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end mt-3">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                <i class="fas fa-times"></i> Annuler
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Mettre à jour
            </button>
        </div>
    </form>
</div>


