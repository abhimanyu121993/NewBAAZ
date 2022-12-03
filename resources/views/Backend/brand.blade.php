@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

@section('Content-Area')
    @can('Brand_create')
        <div class="card">
            <div class="card-header">
                <h3>
                    @if (!isset($brandedit))
                        Add New Brand
                    @else
                        Update Brand
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form class="needs-validation"
                    action="{{ isset($brandedit) ? route('Backend.brand.update', $brandedit->id) : route('Backend.brand.store') }}"
                    method='post' enctype="multipart/form-data">
                    @if (isset($brandedit))
                        @method('patch')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="basic-addon-name">Brand Name</label>

                            <input type="text" id="basic-addon-name" name='bname' class="form-control"
                                value="{{ isset($brandedit) ? $brandedit->name : '' }}" placeholder="brand Name"
                                aria-label="Name" aria-describedby="basic-addon-name" required />
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="pic">Image Thumbnail</label>
                            <input type="file" name='pic' id="pic" class="form-control " aria-label="pic"
                                aria-describedby="pic" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit"
                                class="btn btn-primary waves-effect waves-float waves-light">{{ isset($brandedit) ? 'Update' : 'Add' }}</button>
                        </div>
                        @if (isset($brandedit))
                            <div class="col-sm-6">
                                <img src="{{ asset($brandedit->image) }}" class="bg-light-info" alt=""
                                    style="height:100px;width:200px;">
                            </div>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    @endcan

    @can('Brand_read')
        <div class="card">
            <div class="card-header">
                <h3>Manage Brands</h3>
            </div>
            <div class="card-body">
                {{-- <table class="datatables-basic table datatable table-responsive"> --}}
                <table class="display nowrap" id="brand" style="width:100% !important;">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Image</th>
                            @canany(['Brand_edit', 'Brand_delete'])
                                <th>Action</th>
                            @endcan

                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($brands as $bd)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $bd->name }}</td>
                                <td><img src="{{ asset($bd->image) }}" class="me-75 bg-light-danger"
                                        style="height:60px;width:150px;" />
                                </td>
                                @canany(['Brand_edit', 'Brand_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $bid=Crypt::encrypt($bd->id); @endphp
                                                        @can('Brand_edit')
                                                            <a class="dropdown-item" href="{{ route('Backend.brand.edit', $bid) }}"><i
                                                                    class="me-1" data-feather="check-square"></i><span
                                                                    class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan

                                                        @can('Brand_delete')
                                                            <a class="dropdown-item" href=""
                                                                onclick="event.preventDefault();document.getElementById('delete-form-{{ $bid }}').submit();"><i
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
                            @can('Brand_delete')
                                <form id="delete-form-{{ $bid }}" action="{{ route('Backend.brand.destroy', $bid) }}"
                                    method="post" style="display: none;">
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
            $('#brand').DataTable({
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
                            columns: [1]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [1]
                        }
                    },
                    'colvis'
                ]
            });

        });
    </script>
@endsection
