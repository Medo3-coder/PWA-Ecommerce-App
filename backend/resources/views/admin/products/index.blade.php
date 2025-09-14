@extends('admin.layouts.app')
@section('title', 'Products')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Products</h4>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
            </div>

            <!-- DataTables CSS -->
            <link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
            <link href="{{ asset('admin/assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />


            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @php($cover = $product->getFirstMediaUrl('cover'))
                                            <img src="{{ $cover ?: asset($product->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 6px;" alt="">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            <span class="badge bg-{{ $product->status === 'published' ? 'success' : ($product->status === 'draft' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-info me-2">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning me-2">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline delete-file-form">
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
        $(document).ready(function() {
            $('#example').DataTable({
                lengthChange: true,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });
        });
    </script>

    @include('admin.components.ajax-delete-file-handler')
@endpush
