<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">Ajouter Dépense</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <form id="depenseForm" action="{{ route('depenses.store') }}" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); submitModalForm(this, 'formModal');">
        @csrf
        
        <div class="row">
            <!-- Type de Dépense -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="expense_type_id" class="form-label">Type de Dépense:</label>
                    <select name="expense_type_id" id="expense_type_id" class="form-select @error('expense_type_id') is-invalid @enderror" required>
                        <option value="">Sélectionner un type</option>
                        @foreach($expenseTypes as $type)
                            <option value="{{ $type->id }}" {{ old('expense_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->type_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('expense_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Année -->
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="annee" class="form-label">Année:</label>
                    <select name="annee" id="annee" class="form-select @error('annee') is-invalid @enderror" required>
                        @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                            <option value="{{ $year }}" {{ old('annee', date('Y')) == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                    @error('annee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Mois -->
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="mois" class="form-label">Mois:</label>
                    <select name="mois" id="mois" class="form-select @error('mois') is-invalid @enderror" required>
                        @php
                            $months = [
                                1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
                                5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
                                9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
                            ];
                        @endphp
                        @foreach($months as $num => $name)
                            <option value="{{ $num }}" {{ old('mois', date('n')) == $num ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('mois')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Montant -->
        <div class="mb-3">
            <label for="montant" class="form-label">Montant (MAD):</label>
            <input type="number" step="0.01" min="0" name="montant" id="montant" 
                   class="form-control @error('montant') is-invalid @enderror" 
                   value="{{ old('montant') }}" required>
            @error('montant')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Détails -->
        <div class="mb-3">
            <label for="detail" class="form-label">Détails:</label>
            <textarea name="detail" id="detail" rows="3" 
                      class="form-control @error('detail') is-invalid @enderror" 
                      placeholder="Description de la dépense...">{{ old('detail') }}</textarea>
            @error('detail')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nature de Dépense -->
        <div class="mb-3">
            <label for="nature_expense" class="form-label">Nature de Dépense:</label>
            <select name="nature_expense" id="nature_expense" class="form-select @error('nature_expense') is-invalid @enderror">
                <option value="">Sélectionner la nature</option>
                <option value="ordinaire" {{ old('nature_expense') == 'ordinaire' ? 'selected' : '' }}>Ordinaire</option>
                <option value="extraordinaire" {{ old('nature_expense') == 'extraordinaire' ? 'selected' : '' }}>Extraordinaire</option>
                <option value="urgence" {{ old('nature_expense') == 'urgence' ? 'selected' : '' }}>Urgence</option>
            </select>
            @error('nature_expense')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image de la Facture -->
        <div class="mb-3">
            <label for="facture_image" class="form-label">Image de la Facture:</label>
            <input type="file" name="facture_image" id="facture_image" 
                   class="form-control @error('facture_image') is-invalid @enderror" 
                   accept="image/*">
            @error('facture_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Formats acceptés: JPG, PNG, GIF. Taille max: 2MB</div>
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
