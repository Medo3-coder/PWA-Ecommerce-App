@extends('admin.layouts.app')
@section('title', 'Slider Details')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Slider Details</h4>
            <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Back to Sliders</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    <img src="{{ $slider->image }}" alt="Slider Image" class="img-thumbnail" width="200">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label><br>
                    @if($slider->is_active)
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
