@extends('admin.layouts.app')
@section('title', 'Section Details')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Section: {{ $section->label }}</h4>
            <div>
                <a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-warning me-2">Edit Section</a>
                <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">Back to Sections</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Section Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label><br>
                            <strong>{{ $section->name }}</strong>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Label</label><br>
                            <strong>{{ $section->label }}</strong>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Products Count</label><br>
                            <span class="badge bg-info">{{ $section->products->count() }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Created</label><br>
                            {{ $section->created_at->format('M d, Y H:i') }}
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Updated</label><br>
                            {{ $section->updated_at->format('M d, Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @if($section->products->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Assigned Products ({{ $section->products->count() }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($section->products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}" width="40" height="40" style="object-fit: cover; border-radius: 5px;">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $product->status === 'published' ? 'success' : 'warning' }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $product->category ? $product->category->name : '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bx bx-package bx-lg text-muted mb-3"></i>
                        <h5>No Products Assigned</h5>
                        <p class="text-muted">This section doesn't have any products assigned yet.</p>
                        <a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-primary">Assign Products</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
