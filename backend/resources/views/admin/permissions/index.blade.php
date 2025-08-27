@extends('admin.layouts.app')

@section('title', 'Permissions')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h4 class="mb-0">Permissions</h4>
            @can('permissions.create')
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Add Permission
            </a>
            @endcan
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach($permissionGroups as $group => $groupPermissions)
                    <div class="col-md-3">
                        <div class="mb-3">
                            <strong class="d-block mb-2 text-uppercase small">{{ $group }}</strong>
                            <ul class="list-unstyled">
                                @foreach($groupPermissions as $permission)
                                <li class="mb-1 d-flex justify-content-between align-items-center">
                                    <span>{{ $permission->name }}</span>
                                    <span class="badge bg-light text-muted">{{ $permission->roles->count() }} roles</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


