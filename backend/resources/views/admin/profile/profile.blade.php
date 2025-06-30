@extends('admin.layouts.app')
@section('title', 'User Profile')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('content')
    <!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">{{ $user->name }}</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User Profile</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<form id="profileUpdateForm" enctype="multipart/form-data" class="ajax-form">
											<div class="d-flex flex-column align-items-center text-center">
												<img id="profileImagePreview" src="{{ $user->image }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
												<div class="mt-3">
													<h4>{{ $user->name }}</h4>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Username</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<input type="text" class="form-control" name="name" value="{{ $user->name }}">
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Email</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<input type="email" class="form-control" name="email" value="{{ $user->email }}">
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Mobile</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Address</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<input type="text" class="form-control" name="address" value="{{ $user->address }}">
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Country</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<input type="text" class="form-control" name="country" value="{{ $user->country }}">
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">City</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<input type="text" class="form-control" name="city" value="{{ $user->city }}">
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">State</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<input type="text" class="form-control" name="state" value="{{ $user->state }}">
												</div>
											</div>

                                            <div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0">Image</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													<input class="form-control form-control-sm" id="image" type="file" name="image" accept="image/*">
													<img id="showImage" src="{{ $user->image }}" alt="Preview" class="rounded-circle mt-2" width="110">
												</div>
											</div>

											<div class="row">
												<div class="col-sm-3"></div>
												<div class="col-sm-9 text-secondary">
													<button type="submit" class="btn btn-primary px-4">Save Changes</button>
												</div>
											</div>
										</form>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!--end page wrapper -->
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#image").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    })
</script>
<script>
@include('admin.components.ajax-form-handler')
@endpush


