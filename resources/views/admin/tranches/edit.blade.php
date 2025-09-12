<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">Modifier la Tranche</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form method="POST" action="{{ route('tranches.update', $tranche) }}" 
          onsubmit="submitModalForm(this); return false;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_tranche" class="form-label">
                <i class="fas fa-layer-group"></i> Nom de la Tranche <span class="text-danger">*</span>
            </label>
            <input type="text" 
                   class="form-control @error('nom_tranche') is-invalid @enderror" 
                   id="nom_tranche" 
                   name="nom_tranche" 
                   value="{{ old('nom_tranche', $tranche->nom_tranche) }}" 
                   required
                   placeholder="Ex: Tranche A, Secteur 1, etc.">
            @error('nom_tranche')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">
                <i class="fas fa-align-left"></i> Description
            </label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2" placeholder="Description facultative">{{ old('description', $tranche->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">
                <i class="fas fa-toggle-on"></i> Statut <span class="text-danger">*</span>
            </label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="actif" {{ old('status', $tranche->status) == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ old('status', $tranche->status) == 'inactif' ? 'selected' : '' }}>Inactif</option>
            </select>
            @error('status')
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
