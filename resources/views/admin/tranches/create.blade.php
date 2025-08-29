@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($tranche) ? 'Edit Section' : 'Create New Section' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($tranche) ? route('tranches.update', $tranche) : route('tranches.store') }}">
                        @csrf
                        @if(isset($tranche))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="nom_tranche" class="form-label">Section Name</label>
                            <input type="text" class="form-control @error('nom_tranche') is-invalid @enderror" 
                                   id="nom_tranche" name="nom_tranche" 
                                   value="{{ old('nom_tranche', isset($tranche) ? $tranche->nom_tranche : '') }}" required>
                            @error('nom_tranche')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($tranche) ? 'Update Section' : 'Create Section' }}
                            </button>
                            <a href="{{ route('tranches.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
