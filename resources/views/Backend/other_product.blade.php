@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')
    @can('Other_product_create')
        <div class="card">
            <div class="card-header">
                <h3>
                    @if (!isset($editproduct))
                        Add Add-on Product
                    @else
                        Update Add-on Product
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form class="needs-validation"
                    action="{{ isset($editproduct) ? route('Backend.otherproduct.update', $editproduct->id) : route('Backend.otherproduct.store') }}"
                    method='post' enctype="multipart/form-data">
                    @if (isset($editproduct))
                        @method('patch')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="basic-addon-name">Add-on Product Name</label>

                            <input type="text" id="basic-addon-name" name='name' class="form-control"
                                value="{{ isset($editproduct) ? $editproduct->name : '' }}" placeholder="Add-on Product Name"
                                aria-label="Name" aria-describedby="basic-addon-name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit"
                                class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editproduct) ? 'Update' : 'Add' }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    @endcan

    @can('Other_product_read')
        <div class="card">
            <div class="card-header">
                <h3>Manage Add-on Product</h3>
            </div>
            <div class="card-body">
                {{-- <table class="datatables-basic table datatable table-responsive"> --}}
                <table class="display nowrap" id="other_product" style="width:100% !important;">

                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Created at</th>
                            @canany(['Other_product_edit', 'Other_product_delete'])
                                <th>Action</th>
                            @endcan
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->created_at }}</td>
                                @canany(['Other_product_edit', 'Other_product_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $cid=Crypt::encrypt($product->id); @endphp
                                                        @can('Other_product_edit')
                                                            <a class="dropdown-item"
                                                                href="{{ route('Backend.otherproduct.edit', $cid) }}"><i class="me-1"
                                                                    data-feather="check-square"></i><span
                                                                    class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan
                                                        @can('Other_product_delete')
                                                            <a class="dropdown-item" href=""
                                                                onclick="event.preventDefault();document.getElementById('delete-form-{{ $cid }}').submit();"><i
                                                                    class="me-1" data-feather="message-square"></i><span
                                                                    class="align-middle">Delete</span>
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                            @can('Other_product_delete')
                                <form id="delete-form-{{ $cid }}"
                                    action="{{ route('Backend.otherproduct.destroy', $cid) }}" method="post"
                                    style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            @endcan
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endcan

@endsection


@section('Script-Area')
    {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
    {{-- <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $('#other_product').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>
@endsection
