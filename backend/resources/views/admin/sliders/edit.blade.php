@extends('admin.layouts.app')
@section('title', 'Edit Slider')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Edit Slider</h4>
            <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Back to Sliders</a>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="ajax-form" method="POST" action="{{ route('admin.sliders.update', $slider->id) }}" enctype="multipart/form-data" data-redirect="{{ route('admin.sliders.index') }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @if($slider->image)
                            <img src="{{ asset($slider->image) }}" alt="Current Image" id="showImage" class="img-thumbnail mt-2" width="100">
                        @endif
                        @error('image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $slider->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@include('admin.components.ajax-form-handler')
@endpush
