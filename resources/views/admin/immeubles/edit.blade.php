<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">Modifier l'Immeuble</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form method="POST" action="{{ route('immeubles.update', $immeuble) }}" 
          onsubmit="submitModalForm(this); return false;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_immeuble" class="form-label">
                <i class="fas fa-building"></i> Nom de l'Immeuble <span class="text-danger">*</span>
            </label>
            <input type="text" 
                   class="form-control @error('nom_immeuble') is-invalid @enderror" 
                   id="nom_immeuble" 
                   name="nom_immeuble" 
                   value="{{ old('nom_immeuble', $immeuble->nom_immeuble) }}" 
                   required
                   placeholder="Ex: Immeuble A, Bâtiment 1, etc.">
            @error('nom_immeuble')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tranche_id" class="form-label">
                <i class="fas fa-layer-group"></i> Tranche <span class="text-danger">*</span>
            </label>
            <select class="form-control @error('tranche_id') is-invalid @enderror" 
                    id="tranche_id" 
                    name="tranche_id" 
                    required>
                <option value="">Sélectionner une tranche</option>
                @foreach($tranches as $tranche)
                    <option value="{{ $tranche->id }}" {{ old('tranche_id', $immeuble->tranche_id) == $tranche->id ? 'selected' : '' }}>
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