@extends('admin.layouts.app')
@section('title', 'Edit Section')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!-- Header Section -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="page-title mb-1">Edit Section</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.sections.index') }}">Sections</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.sections.show', $section->id) }}" class="btn btn-outline-info">
                    <i class="bx bx-show me-1"></i>View Details
                </a>
                <a href="{{ route('admin.sections.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back me-1"></i>Back to List
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bx bx-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Section Information Card -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-edit-alt me-2"></i>
                            <h5 class="card-title mb-0">Section Information</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form class="ajax-form" method="POST" action="{{ route('admin.sections.update', $section->id) }}" data-redirect="{{ route('admin.sections.index') }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="bx bx-hash me-1 text-primary"></i>Section Name
                                </label>
                                <input type="text"
                                       class="form-control form-control-lg @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $section->name) }}"
                                       placeholder="e.g., featured, new_arrival"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-error-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="bx bx-info-circle me-1"></i>
                                    Unique identifier for the section (used in code)
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="label" class="form-label fw-semibold">
                                    <i class="bx bx-label me-1 text-primary"></i>Display Label
                                </label>
                                <input type="text"
                                       class="form-control form-control-lg @error('label') is-invalid @enderror"
                                       id="label"
                                       name="label"
                                       value="{{ old('label', $section->label) }}"
                                       placeholder="e.g., Featured Products, New Arrivals"
                                       required>
                                @error('label')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-error-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="bx bx-info-circle me-1"></i>
                                    Human-readable label (displayed to users)
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bx bx-save me-2"></i>Update Section
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Section Stats Card -->
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0">
                            <i class="bx bx-stats me-2"></i>Section Statistics
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="border-end">
                                    <h3 class="text-primary mb-1">{{ $section->products->count() }}</h3>
                                    <small class="text-muted">Products</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <h3 class="text-success mb-1">{{ $section->created_at->diffForHumans() }}</h3>
                                <small class="text-muted">Created</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Management Card -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bx bx-package me-2"></i>
                                <h5 class="card-title mb-0">Manage Products</h5>
                            </div>
                            <span class="badge bg-light text-dark">{{ $section->products->count() }} assigned</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form class="ajax-form" method="POST" action="{{ route('admin.sections.assign-products', $section->id) }}">
                            @csrf

                            <div class="mb-4">
                                <label for="product_ids" class="form-label fw-semibold">
                                    <i class="bx bx-list-check me-1 text-success"></i>Select Products
                                </label>
                                <div class="position-relative">
                                    <select class="form-select form-select-lg @error('product_ids') is-invalid @enderror"
                                            id="product_ids"
                                            name="product_ids[]"
                                            multiple
                                            size="8"
                                            style="border-radius: 8px;">
                                        @foreach($allProducts as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $section->products->contains($product->id) ? 'selected' : '' }}
                                                class="py-2">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" width="20" height="20" class="me-2">
                                                    {{ $product->name }} - ${{ number_format($product->price, 2) }}
                                                </div>
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_ids')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-error-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-text mt-2">
                                    <i class="bx bx-help-circle me-1"></i>
                                    Hold <kbd>Ctrl</kbd> (or <kbd>Cmd</kbd> on Mac) to select multiple products
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bx bx-sync me-2"></i>Update Product Assignment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Current Products Preview -->
                @if($section->products->count() > 0)
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0">
                            <i class="bx bx-list-ul me-2"></i>Currently Assigned Products
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Product</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th class="text-end pe-3">Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($section->products->take(5) as $product)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $product->image }}"
                                                     alt="{{ $product->name }}"
                                                     width="32"
                                                     height="32"
                                                     style="object-fit: cover; border-radius: 4px;"
                                                     class="me-3">
                                                <div>
                                                    <div class="fw-semibold">{{ Str::limit($product->name, 25) }}</div>
                                                    <small class="text-muted">ID: {{ $product->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-success">${{ number_format($product->price, 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $product->status === 'published' ? 'success' : 'warning' }} badge-sm">
                                                <i class="bx bx-{{ $product->status === 'published' ? 'check' : 'time' }} me-1"></i>
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-3">
                                            <small class="text-muted">{{ $product->category ? $product->category->name : 'Uncategorized' }}</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($section->products->count() > 5)
                        <div class="card-footer bg-light text-center">
                            <small class="text-muted">
                                Showing 5 of {{ $section->products->count() }} products
                            </small>
                        </div>
                        @endif
                    </div>
                </div>
                @else
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body text-center py-5">
                        <i class="bx bx-package bx-lg text-muted mb-3"></i>
                        <h6 class="text-muted">No Products Assigned</h6>
                        <p class="text-muted mb-0">Select products from the dropdown above to assign them to this section.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-control-lg, .form-select-lg {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-control-lg:focus, .form-select-lg:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
        padding: 1rem 1.5rem;
    }

    .btn-lg {
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }

    .table th {
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
    }

    .page-header .breadcrumb {
        background: transparent;
        margin-bottom: 0;
    }

    .page-header .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
    }

    .page-header .breadcrumb-item.active {
        color: white;
    }
</style>
@endpush

@include('admin.components.ajax-form-handler')
