@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-4">
        <div class="col-auto">
            <h2>Sections Management</h2>
        </div>
        @if(auth()->user()->isAdmin())
        <div class="col-auto">
            <a href="{{ route('tranches.create') }}" class="btn btn-primary">Add New Section</a>
        </div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Buildings Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tranches as $tranche)
                            <tr>
                                <td>{{ $tranche->id }}</td>
                                <td>{{ $tranche->nom_tranche }}</td>
                                <td>{{ $tranche->immeubles_count ?? $tranche->immeubles->count() }}</td>
                                <td>{{ $tranche->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('tranches.show', $tranche) }}" class="btn btn-sm btn-info">View</a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('tranches.edit', $tranche) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('tranches.destroy', $tranche) }}" method="POST" class="d-inline">
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
        </div>
    </div>
</div>
@endsection
