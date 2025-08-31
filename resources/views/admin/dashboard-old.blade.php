@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Sections</h5>
                                    <p class="card-text">Gérer les sections de bâtiments</p>
                                    <a href="{{ route('tranches.index') }}" class="btn btn-primary">Gérer Sections</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Immeubles</h5>
                                    <p class="card-text">Gérer les immeubles et appartements</p>
                                    <a href="{{ route('immeubles.index') }}" class="btn btn-primary">Gérer Immeubles</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Cotisations</h5>
                                    <p class="card-text">Gérer les cotisations mensuelles</p>
                                    <a href="{{ route('cotisations.index') }}" class="btn btn-primary">Gérer Cotisations</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Dépenses</h5>
                                    <p class="card-text">Gérer les dépenses et factures</p>
                                    <a href="{{ route('depenses.index') }}" class="btn btn-primary">Gérer Dépenses</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Types de Dépenses</h5>
                                    <p class="card-text">Configurer les catégories de dépenses</p>
                                    <a href="{{ route('expense-types.index') }}" class="btn btn-secondary">Gérer Types</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Rapports</h5>
                                    <p class="card-text">Générer des rapports financiers</p>
                                    <a href="#" class="btn btn-info">Voir Rapports</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Paramètres</h5>
                                    <p class="card-text">Configuration du système</p>
                                    <a href="#" class="btn btn-warning">Paramètres</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
