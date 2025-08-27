@extends('admin.layouts.app')
@section('title', 'Sections')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h4 class="mb-0">Sections</h4>
            <a href="{{ route('admin.sections.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Add Section
            </a>
        </div>
        @include('admin.components.flash-messages')

        <!-- DataTables CSS -->
        <link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin/assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="sectionsTable" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                {{-- <th>Name</th> --}}
                                <th>Label</th>
                                <th>Products Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sections as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                {{-- <td>{{ $section->name }}</td> --}}
                                <td>{{ $section->label }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $section->products_count }}</span>
                                </td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-sm btn-warning me-2">
                                            <i class="bx bx-edit"></i>
                                        </a>

                                        <a href="{{ route('admin.sections.show', $section->id) }}" class="btn btn-sm btn-info me-2">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <form action="{{ route('admin.sections.destroy', $section->id) }}" method="POST" class="d-inline delete-file-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
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
        $('#sectionsTable').DataTable({
            pageLength: 10,
            lengthChange: false,
            ordering: true,
            columnDefs: [
                { orderable: false, targets: [3] }
            ]
        });
    });
    </script>
@include('admin.components.ajax-delete-file-handler')
@endpush
