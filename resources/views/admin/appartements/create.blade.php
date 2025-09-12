<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">Ajouter un Appartement</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form action="{{ route('appartements.store') }}" method="POST" 
          onsubmit="submitModalForm(this); return false;">
        @csrf
        
        <div class="mb-3">
            <label for="immeuble_id" class="form-label">
                <i class="fas fa-building"></i> Immeuble <span class="text-danger">*</span>
            </label>
            <select name="immeuble_id" id="immeuble_id" 
                    class="form-select @error('immeuble_id') is-invalid @enderror" required>
                <option value="">Sélectionner un immeuble</option>
                @foreach($immeubles as $immeuble)
                    <option value="{{ $immeuble->id }}" 
                            {{ (old('immeuble_id', request('immeuble_id')) == $immeuble->id) ? 'selected' : '' }}>
                        {{ $immeuble->nom_immeuble }} ({{ $immeuble->tranche->nom_tranche ?? 'N/A' }})
                    </option>
                @endforeach
            </select>
            @error('immeuble_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nom_app" class="form-label">
                <i class="fas fa-door-open"></i> Numéro d'Appartement <span class="text-danger">*</span>
            </label>
            <input type="text" name="nom_app" id="nom_app" 
                   class="form-control @error('nom_app') is-invalid @enderror" 
                   value="{{ old('nom_app') }}" 
                   placeholder="Ex: A1, B2, 101, etc." required>
            @error('nom_app')
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
