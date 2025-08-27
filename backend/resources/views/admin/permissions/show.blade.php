@extends('admin.layouts.app')

@section('title', 'Permission Details')

@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Permission: {{ $permission->name }}</h5>
                <div>
                    @can('permissions.edit')
                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
            <div class="card-body">
                <h6>Assigned Roles</h6>
                <p>{{ $permission->roles->pluck('name')->implode(', ') ?: 'None' }}</p>
                <h6>Users</h6>
                <p>{{ $permission->users->pluck('name')->implode(', ') ?: 'None' }}</p>
            </div>
        </div>
    </div>
@endsection


