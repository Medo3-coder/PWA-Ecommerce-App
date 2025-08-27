@extends('admin.layouts.app')
@section('title', 'Create Section')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h4 class="mb-0">Create New Section</h4>
            <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back to Sections
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form class="ajax-form" method="POST" action="{{ route('admin.sections.store') }}" data-redirect="{{ route('admin.sections.index') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Section Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <small class="form-text text-muted">Unique identifier for the section (e.g., featured, new_arrival)</small>
                    </div>

                    <div class="mb-3">
                        <label for="label" class="form-label">Display Label</label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ old('label') }}" required>
                        @error('label')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <small class="form-text text-muted">Human-readable label (e.g., Featured Products, New Arrivals)</small>
                    </div>

                    <div class="d-grid d-sm-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Create Section
                        </button>
                        <a href="{{ route('admin.sections.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@include('admin.components.ajax-form-handler')
