<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">Modifier la Dépense</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form action="{{ route('depenses.update', $depense) }}" method="POST" enctype="multipart/form-data" onsubmit="submitModalForm(this); return false;">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="expense_type_id" class="form-label">
                        <i class="fas fa-tags"></i> Type de Dépense <span class="text-danger">*</span>
                    </label>
                    <select name="expense_type_id" id="expense_type_id" class="form-select @error('expense_type_id') is-invalid @enderror" required>
                        <option value="">Choisir un type</option>
                        @foreach($expenseTypes as $type)
                            <option value="{{ $type->id }}" {{ old('expense_type_id', $depense->expense_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->nom_type }}
                            </option>
                        @endforeach
                    </select>
                    @error('expense_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nature_depense" class="form-label">
                        <i class="fas fa-file-alt"></i> Nature de la Dépense <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="nature_depense" id="nature_depense" class="form-control @error('nature_depense') is-invalid @enderror" value="{{ old('nature_depense', $depense->nature_depense) }}" required placeholder="Ex: Réparation ascenseur, Nettoyage...">
                    @error('nature_depense')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="montant" class="form-label">
                        <i class="fas fa-coins"></i> Montant (DH) <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="montant" id="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant', $depense->montant) }}" step="0.01" min="0" required placeholder="0.00">
                    @error('montant')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="mois" class="form-label">
                        <i class="fas fa-calendar"></i> Mois <span class="text-danger">*</span>
                    </label>
                    <select name="mois" id="mois" class="form-select @error('mois') is-invalid @enderror" required>
                        <option value="">Choisir un mois</option>
                        @foreach($months as $num => $name)
                            <option value="{{ $num }}" {{ old('mois', $depense->mois) == $num ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('mois')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="annee" class="form-label">
                        <i class="fas fa-calendar-alt"></i> Année <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="annee" id="annee" class="form-control @error('annee') is-invalid @enderror" value="{{ old('annee', $depense->annee) }}" min="2020" max="{{ date('Y') + 1 }}" required>
                    @error('annee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="detail" class="form-label">
                <i class="fas fa-comment"></i> Détail (Optionnel)
            </label>
            <textarea name="detail" id="detail" class="form-control @error('detail') is-invalid @enderror" rows="3" placeholder="Détails supplémentaires...">{{ old('detail', $depense->detail) }}</textarea>
            @error('detail')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="facture_image" class="form-label">
                <i class="fas fa-image"></i> Image de la Facture (Optionnel)
            </label>
            <input type="file" name="facture_image" id="facture_image" class="form-control @error('facture_image') is-invalid @enderror" accept="image/*">
            <small class="form-text text-muted">Formats acceptés: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
            @if($depense->facture_image)
                <div class="mt-2">
                    <a href="{{ asset('storage/' . $depense->facture_image) }}" target="_blank">Voir l'image actuelle</a>
                </div>
            @endif
            @error('facture_image')
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
