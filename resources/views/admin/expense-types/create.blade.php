<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">Ajouter un Type de Dépense</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form action="{{ route('expense-types.store') }}" method="POST" 
          onsubmit="submitModalForm(this); return false;">
        @csrf
        
        <div class="mb-3">
            <label for="nom_type" class="form-label">
                <i class="fas fa-tag"></i> Nom du Type <span class="text-danger">*</span>
            </label>
            <input type="text" name="nom_type" id="nom_type" 
                   class="form-control @error('nom_type') is-invalid @enderror" 
                   value="{{ old('nom_type') }}" required
                   placeholder="Ex: Maintenance, Nettoyage, Réparations...">
            @error('nom_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">
                <i class="fas fa-file-alt"></i> Description (Optionnel)
            </label>
            <textarea name="description" id="description" 
                      class="form-control @error('description') is-invalid @enderror" rows="3" 
                      placeholder="Description du type de dépense...">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end mt-3">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                <i class="fas fa-times"></i> Annuler
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Ajouter
            </button>
        </div>
    </form>
</div>
