<!-- Modal Header -->
<div class="modal-header">
    <h5 class="modal-title">
        <i class="fas fa-layer-group"></i> Détails de la Tranche: {{ $tranche->nom_tranche }}
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal Body -->
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title text-primary">
                        <i class="fas fa-info-circle"></i> Informations Générales
                    </h6>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><strong>Nom:</strong></td>
                            <td>{{ $tranche->nom_tranche }}</td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td>{{ $tranche->description ?? 'Non spécifiée' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Créé le:</strong></td>
                            <td>{{ $tranche->created_at->format('d/m/Y à H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Modifié le:</strong></td>
                            <td>{{ $tranche->updated_at->format('d/m/Y à H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Immeubles:</strong></td>
                            <td><span class="badge bg-info">{{ $tranche->immeubles->count() }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-primary">
                        <i class="fas fa-building"></i> Immeubles de cette Tranche
                    </h6>
                    @if(auth()->user()->isAdmin())
                        <button class="btn btn-primary btn-sm" onclick="loadModal('{{ route('immeubles.create', ['tranche_id' => $tranche->id]) }}')">
                            <i class="fas fa-plus"></i> Ajouter Immeuble
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    @if($tranche->immeubles->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Appartements</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tranche->immeubles as $immeuble)
                                        <tr>
                                            <td><strong>{{ $immeuble->nom_immeuble }}</strong></td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $immeuble->appartements_count ?? $immeuble->appartements->count() }}</span>
                                            </td>
                                            <td>
                                                @if(auth()->user()->isAdmin())
                                                    <button class="btn btn-sm btn-warning" onclick="loadModal('{{ route('immeubles.edit', $immeuble) }}')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('immeubles.destroy', $immeuble) }}', 'Supprimer cet immeuble ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-building fa-2x mb-2"></i>
                            <p>Aucun immeuble dans cette tranche.</p>
                            @if(auth()->user()->isAdmin())
                                <button class="btn btn-primary btn-sm" onclick="loadModal('{{ route('immeubles.create', ['tranche_id' => $tranche->id]) }}')">
                                    <i class="fas fa-plus"></i> Ajouter le premier immeuble
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Footer -->
<div class="modal-footer">
    @if(auth()->user()->isAdmin())
        <button type="button" class="btn btn-warning" onclick="loadModal('{{ route('tranches.edit', $tranche) }}')">
            <i class="fas fa-edit"></i> Modifier la Tranche
        </button>
    @endif
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        <i class="fas fa-times"></i> Fermer
    </button>
</div>
