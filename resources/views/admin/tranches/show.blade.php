@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Section Details: {{ $tranche->nom_tranche }}</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('tranches.index') }}" class="btn btn-secondary">Back to List</a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('tranches.edit', $tranche) }}" class="btn btn-warning">Edit Section</a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Section Information</h5>
                    <p><strong>Name:</strong> {{ $tranche->nom_tranche }}</p>
                    <p><strong>Created:</strong> {{ $tranche->created_at->format('Y-m-d') }}</p>
                    <p><strong>Last Updated:</strong> {{ $tranche->updated_at->format('Y-m-d') }}</p>
                    <p><strong>Total Buildings:</strong> {{ $tranche->immeubles->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Buildings in this Section</h5>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('immeubles.create', ['tranche_id' => $tranche->id]) }}" class="btn btn-primary btn-sm">Add Building</a>
                    @endif
                </div>
                <div class="card-body">
                    @if($tranche->immeubles->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Apartments</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tranche->immeubles as $immeuble)
                                        <tr>
                                            <td>{{ $immeuble->nom_immeuble }}</td>
                                            <td>{{ $immeuble->appartements_count ?? $immeuble->appartements->count() }}</td>
                                            <td>
                                                <a href="{{ route('immeubles.show', $immeuble) }}" class="btn btn-sm btn-info">View</a>
                                                @if(auth()->user()->isAdmin())
                                                    <a href="{{ route('immeubles.edit', $immeuble) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('immeubles.destroy', $immeuble) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No buildings added to this section yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
