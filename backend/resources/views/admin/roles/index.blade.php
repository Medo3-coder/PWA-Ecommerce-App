@extends('admin.layouts.app')

@section('title', 'Roles')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h4 class="mb-0">Roles</h4>
            @can('roles.create')
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Add Role
            </a>
            @endcan
        </div>

        <!-- DataTables CSS -->
        <link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin/assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="rolesTable" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $role->permissions->count() }}</span>
                                </td>
                                <td>
                                    <div class="d-flex order-actions">
                                        @can('roles.edit')
                                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-warning me-2"><i class="bx bx-edit"></i></a>
                                        @endcan
                                        @can('roles.view')
                                        <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-sm btn-info me-2"><i class="bx bx-show"></i></a>
                                        @endcan
                                        @can('roles.delete')
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline delete-file-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(function() {
        $('#rolesTable').DataTable({
            pageLength: 10,
            lengthChange: false,
            ordering: true,
            columnDefs: [ { orderable: false, targets: [2] } ]
        });
    });
</script>
@include('admin.components.ajax-delete-file-handler')
@endpush


