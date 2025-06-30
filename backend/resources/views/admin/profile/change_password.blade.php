@extends('admin.layouts.app')
@section('title', 'Change Password')

@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Change Password</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Change Password</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->
		<div class="container">
			<div class="main-body">
				<div class="row justify-content-center">
					<div class="col-lg-6">
						<div class="card">
							<div class="card-body">
								<form class="ajax-form" method="POST" action="{{ route('admin.password.update') }}">
									@csrf
									<div class="mb-3">
										<label for="current_password" class="form-label">Current Password</label>
										<input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
										@error('current_password')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<div class="mb-3">
										<label for="password" class="form-label">New Password</label>
										<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
										@error('password')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<div class="mb-3">
										<label for="password_confirmation" class="form-label">Confirm New Password</label>
										<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
									</div>
									<div class="d-grid">
										<button type="submit" class="btn btn-primary">Update Password</button>
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
	@include('admin.components.ajax-form-handler')
@endpush
