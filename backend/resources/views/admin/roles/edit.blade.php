@extends('admin.layouts.app')

@section('title', 'Edit Role')

@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Edit Role</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}" required>
                        @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            @php $rolePerms = $role->permissions->pluck('id')->toArray(); @endphp
                            @foreach($permissionGroups as $group => $groupPermissions)
                                <div class="col-md-3 mb-2">
                                    <strong class="d-block mb-1 text-uppercase small">{{ $group }}</strong>
                                    @foreach($groupPermissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}" {{ in_array($permission->id, $rolePerms) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection

