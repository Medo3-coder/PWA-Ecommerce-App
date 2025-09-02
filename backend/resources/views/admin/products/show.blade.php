resources/views/admin/products/show.blade.php
@extends('admin.layouts.app')
@section('title', 'Product Details')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Product Details</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to Products</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Image</label><br>
                            <img src="{{ asset($product->image) }}" alt="Product Image" class="img-fluid" style="max-width: 300px;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <p>{{ $product->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <p>${{ $product->price }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Stock</label>
                            <p>{{ $product->stock }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p>
                                <span class="badge bg-{{ $product->status ? 'success' : 'danger' }}">
                                    {{ $product->status ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <p>{{ $product->description }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Created At</label>
                            <p>{{ $product->created_at->format('F d, Y H:i A') }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Updated At</label>
                            <p>{{ $product->updated_at->format('F d, Y H:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
