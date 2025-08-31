<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">Ajouter Type de Dépense</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form id="expenseTypeForm" action="{{ route('expense-types.store') }}" method="POST" onsubmit="event.preventDefault(); submitModalForm(this, 'formModal');">
        @csrf
        
        <div class="mb-3">
            <label for="type_name" class="form-label">Nouveau Type:</label>
            <input type="text" name="type_name" id="type_name" 
                   class="form-control @error('type_name') is-invalid @enderror" 
                   value="{{ old('type_name') }}" 
                   placeholder="Ex: Électricité, Jardinage, etc." 
                   required>
            @error('type_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Ajouter
            </button>
        </div>
    </form>
</div>
