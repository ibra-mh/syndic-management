<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">{{ __('app.cotisation.add_cotisation') }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form method="POST" action="{{ route('cotisations.store') }}" 
          onsubmit="submitModalForm(this); return false;">
        @csrf

        <div class="row">
            <!-- Appartement Selection -->
            <div class="col-md-6 mb-3">
                <label for="appartement_id" class="form-label">
                    <i class="fas fa-home"></i> {{ __('app.cotisation.apartment') }} <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('appartement_id') is-invalid @enderror" 
                        id="appartement_id" name="appartement_id" required>
                    <option value="">{{ __('app.cotisation.select_apartment') }}</option>
                    @foreach($appartements as $appartement)
                        <option value="{{ $appartement->id }}" {{ old('appartement_id') == $appartement->id ? 'selected' : '' }}>
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
                    <i class="fas fa-money-bill-wave"></i> {{ __('app.cotisation.amount_apartment') }} ({{ config('syndic.currency.symbol') }}) <span class="text-danger">*</span>
                </label>
                <input type="number" step="0.01" class="form-control @error('montant_appartement') is-invalid @enderror" 
                       id="montant_appartement" name="montant_appartement" 
                       value="{{ old('montant_appartement', $defaultAmounts['appartement']) }}" 
                       placeholder="{{ $defaultAmounts['appartement'] }}" required>
                @error('montant_appartement')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Montant Garage -->
            <div class="col-md-4 mb-3">
                <label for="montant_garage" class="form-label">
                    <i class="fas fa-warehouse"></i> {{ __('app.cotisation.amount_garage') }} ({{ config('syndic.currency.symbol') }})
                </label>
                <input type="number" step="0.01" class="form-control @error('montant_garage') is-invalid @enderror" 
                       id="montant_garage" name="montant_garage" 
                       value="{{ old('montant_garage', $defaultAmounts['garage']) }}" 
                       placeholder="{{ $defaultAmounts['garage'] }}">
                @error('montant_garage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Montant Boxe -->
            <div class="col-md-4 mb-3">
                <label for="montant_boxe" class="form-label">
                    <i class="fas fa-box"></i> {{ __('app.cotisation.amount_boxe') }} ({{ config('syndic.currency.symbol') }})
                </label>
                <input type="number" step="0.01" class="form-control @error('montant_boxe') is-invalid @enderror" 
                       id="montant_boxe" name="montant_boxe" 
                       value="{{ old('montant_boxe', $defaultAmounts['boxe']) }}" 
                       placeholder="{{ $defaultAmounts['boxe'] }}">
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
                    <i class="fas fa-calendar"></i> {{ __('app.cotisation.month') }} <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('mois') is-invalid @enderror" id="mois" name="mois" required>
                    <option value="">{{ __('app.cotisation.select_month') }}</option>
                    @foreach($months as $num => $name)
                        <option value="{{ $num }}" {{ old('mois', date('n')) == $num ? 'selected' : '' }}>{{ $name }}</option>
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
                    <i class="fas fa-calendar"></i> {{ __('app.cotisation.year') }} <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('annee') is-invalid @enderror" id="annee" name="annee" required>
                    <option value="">Sélectionner une année</option>
                    @foreach(range(date('Y')+1, date('Y')-2) as $year)
                        <option value="{{ $year }}" {{ old('annee', date('Y')) == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                @error('annee')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Date de paiement -->
            <div class="col-md-12 mb-3">
                <label for="date_paiement" class="form-label">
                    <i class="fas fa-calendar-check"></i> {{ __('app.cotisation.payment_date') }}
                </label>
                <input type="date" class="form-control @error('date_paiement') is-invalid @enderror" 
                       id="date_paiement" name="date_paiement" value="{{ old('date_paiement') }}">
                <small class="form-text text-muted">{{ __('app.optional') }}</small>
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
                <i class="fas fa-times"></i> {{ __('app.cancel') }}
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ __('app.save') }}
            </button>
        </div>
    </form>
</div>


