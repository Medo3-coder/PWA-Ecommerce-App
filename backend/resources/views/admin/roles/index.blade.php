@extends('admin.layouts.app')

@section('title', 'Roles')

@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Roles</h5>
                @can('roles.create')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create Role</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <small>{{ $role->permissions->pluck('name')->implode(', ') }}</small>
                                </td>
                                <td>
                                    @can('roles.view')
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.roles.show', $role) }}">View</a>
                                    @endcan
                                    @can('roles.edit')
                                        <a class="btn btn-sm btn-warning" href="{{ route('admin.roles.edit', $role) }}">Edit</a>
                                    @endcan
                                    @can('roles.delete')
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete role?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

