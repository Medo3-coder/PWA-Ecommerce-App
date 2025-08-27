@extends('admin.layouts.app')

@section('title', 'Role Details')

@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Role: {{ $role->name }}</h5>
                <div>
                    @can('roles.edit')
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
            <div class="card-body">
                <h6>Permissions</h6>
                <div class="row">
                    @foreach($permissionGroups as $group => $groupPermissions)
                        <div class="col-md-3 mb-3">
                            <strong class="d-block mb-1 text-uppercase small">{{ $group }}</strong>
                            <ul class="list-unstyled mb-0">
                                @foreach($groupPermissions as $permission)
                                    <li>
                                        <span class="badge {{ $role->hasPermissionTo($permission) ? 'bg-success' : 'bg-light text-dark' }}">{{ $permission->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

