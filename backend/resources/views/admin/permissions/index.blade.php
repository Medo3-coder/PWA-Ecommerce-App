@extends('admin.layouts.app')

@section('title', 'Permissions')

@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Permissions</h5>
                @can('permissions.create')
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">Create Permission</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($permissionGroups as $group => $groupPermissions)
                        <div class="col-md-3">
                            <div class="mb-3">
                                <strong class="d-block mb-2 text-uppercase small">{{ $group }}</strong>
                                <ul class="list-unstyled">
                                    @foreach($groupPermissions as $permission)
                                        <li class="mb-1">
                                            {{ $permission->name }}
                                            <span class="text-muted small">(roles: {{ $permission->roles->pluck('name')->implode(', ') }})</span>
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
@endsection

