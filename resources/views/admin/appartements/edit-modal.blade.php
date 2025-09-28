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
        <div class="mb-3">
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
        <div class="mb-3">
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
        <div id="tranche-immeuble-error" class="text-danger mb-2" style="display:none;"></div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var trancheSelect = document.getElementById('tranche_id');
            var immeubleSelect = document.getElementById('immeuble_id');
            var errorDiv = document.getElementById('tranche-immeuble-error');
            var submitBtn = document.querySelector('button[type="submit"]');
            function validateTrancheImmeuble() {
                var trancheId = trancheSelect.value;
                var immeubleOption = immeubleSelect.options[immeubleSelect.selectedIndex];
                var immeubleTranche = immeubleOption ? immeubleOption.getAttribute('data-tranche') : null;
                if (trancheId && immeubleSelect.value && trancheId !== immeubleTranche) {
                    errorDiv.textContent = "Cet immeuble n'appartient pas à cette tranche.";
                    errorDiv.style.display = '';
                    submitBtn.disabled = true;
                } else {
                    errorDiv.textContent = '';
                    errorDiv.style.display = 'none';
                    submitBtn.disabled = false;
                }
            }
            trancheSelect.addEventListener('change', validateTrancheImmeuble);
            immeubleSelect.addEventListener('change', validateTrancheImmeuble);
            validateTrancheImmeuble();
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