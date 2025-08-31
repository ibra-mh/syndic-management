<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">{{ isset($tranche) ? 'Modifier la Tranche' : 'Créer une Nouvelle Tranche' }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form method="POST" action="{{ isset($tranche) ? route('tranches.update', $tranche) : route('tranches.store') }}" 
          onsubmit="submitModalForm(this); return false;">
        @csrf
        @if(isset($tranche))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nom_tranche" class="form-label">
                <i class="fas fa-layer-group"></i> Nom de la Tranche <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control @error('nom_tranche') is-invalid @enderror" 
                   id="nom_tranche" name="nom_tranche" 
                   value="{{ old('nom_tranche', isset($tranche) ? $tranche->nom_tranche : '') }}" 
                   placeholder="Ex: Secteur A, Zone Nord, etc." required>
            @error('nom_tranche')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">
                <i class="fas fa-info-circle"></i> Description (Optionnel)
            </label>
            <textarea class="form-control" id="description" name="description" rows="3" 
                      placeholder="Description de la tranche...">{{ old('description', isset($tranche) ? $tranche->description : '') }}</textarea>
        </div>
    </form>
</div>

<!-- Modal Footer -->
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        <i class="fas fa-times"></i> Annuler
    </button>
    <button type="submit" form="tranche-form" class="btn btn-primary">
        <i class="fas fa-save"></i> {{ isset($tranche) ? 'Mettre à jour' : 'Créer la Tranche' }}
    </button>
</div>

<script>
// Add form ID for submit button
document.querySelector('form').id = 'tranche-form';
document.querySelector('#tranche-form').onsubmit = function(e) {
    e.preventDefault();
    submitModalForm(this);
};
</script>
