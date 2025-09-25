<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">Modifier l'Appartement</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form action="{{ route('appartements.update', $appartement->id) }}" method="POST" onsubmit="submitModalForm(this); return false;">

        @csrf
        @method('PUT')
        <div class="mb-3" id="tranche-group">
            <label for="tranche_id" class="form-label">
                <i class="fas fa-layer-group"></i> Tranche <span class="text-danger">*</span>
            </label>
            <select name="tranche_id" id="tranche_id" class="form-select" required>
                <option value="">Sélectionnez une tranche</option>
                @foreach($tranches as $tranche)
                    <option value="{{ $tranche->id }}" {{ (old('tranche_id', $appartement->immeuble->tranche_id ?? null) == $tranche->id) ? 'selected' : '' }}>{{ $tranche->nom_tranche }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3" id="immeuble-group" style="display:none;">
            <label for="immeuble_id" class="form-label">
                <i class="fas fa-building"></i> Immeuble <span class="text-danger">*</span>
            </label>
            <select name="immeuble_id" id="immeuble_id" class="form-select @error('immeuble_id') is-invalid @enderror" required>
                <option value="">Sélectionnez un immeuble</option>
                @foreach($immeubles as $immeuble)
                    <option value="{{ $immeuble->id }}" data-tranche="{{ $immeuble->tranche_id }}" {{ (old('immeuble_id', $appartement->immeuble_id) == $immeuble->id) ? 'selected' : '' }}>
                        {{ $immeuble->nom_immeuble }}
                    </option>
                @endforeach
            </select>
            @error('immeuble_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var trancheSelect = document.getElementById('tranche_id');
            var immeubleSelect = document.getElementById('immeuble_id');
            var trancheGroup = document.getElementById('tranche-group');
            var immeubleGroup = document.getElementById('immeuble-group');
            function filterImmeubles() {
                var trancheId = trancheSelect.value;
                Array.from(immeubleSelect.options).forEach(function(opt) {
                    if (!opt.value) return;
                    opt.style.display = (trancheId === '' || opt.getAttribute('data-tranche') === trancheId) ? '' : 'none';
                });
                // If current immeuble doesn't match, reset
                if (immeubleSelect.selectedOptions.length && immeubleSelect.selectedOptions[0].style.display === 'none') {
                    immeubleSelect.value = '';
                }
            }
            trancheSelect.addEventListener('change', function() {
                if (trancheSelect.value) {
                    filterImmeubles();
                    trancheGroup.style.display = 'none';
                    immeubleGroup.style.display = '';
                } else {
                    immeubleGroup.style.display = 'none';
                    trancheGroup.style.display = '';
                }
            });
            // If already selected (edit/old), show immeuble dropdown
            if (trancheSelect.value) {
                filterImmeubles();
                trancheGroup.style.display = 'none';
                immeubleGroup.style.display = '';
            }
        });
        </script>
        <div class="mb-3">
            <label for="numero" class="form-label">
                <i class="fas fa-door-open"></i> Numéro d'Appartement <span class="text-danger">*</span>
            </label>
            <input type="text" name="numero" id="numero" 
                   class="form-control @error('numero') is-invalid @enderror" 
                   value="{{ old('numero', $appartement->numero) }}" 
                   placeholder="Ex: A1, B2, 101, etc." required>
            @error('numero')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="numero" class="form-label">
                <i class="fas fa-door-open"></i> Numéro d'Appartement <span class="text-danger">*</span>
            </label>
            <input type="text" name="numero" id="numero" 
                   class="form-control @error('numero') is-invalid @enderror" 
                   value="{{ old('numero', $appartement->numero) }}" 
                   placeholder="Ex: A1, B2, 101, etc." required>
            @error('numero')
                <div class="invalid-feedback">{{ $message }}</div>
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
