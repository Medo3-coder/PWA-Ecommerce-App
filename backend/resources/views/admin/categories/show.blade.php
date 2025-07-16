@extends('admin.layouts.app')
@section('title', 'Category Details')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Category Details</h4>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to Categories</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Name</label><br>
                    <strong>{{ $category->name }}</strong>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    <img src="{{ $category->image }}" alt="Category Image" class="img-thumbnail" width="120">
                </div>
                <div class="mb-3">
                    <label class="form-label">Parent</label><br>
                    {{ $category->parent ? $category->parent->name : '-' }}
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label><br>
                    {{ $category->description ?? '-' }}
                </div>
                <div class="mb-3">
                    <label class="form-label">Order</label><br>
                    {{ $category->order ?? '-' }}
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label><br>
                    @if($category->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
