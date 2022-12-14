@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

@section('Content-Area')
    @can('Fuel_type_create')
        <div class="card">
            <div class="card-header">
                <h3>
                    @if (!isset($fueltypeedit))
                        Add New Fuel Type
                    @else
                        Edit Fuel Type
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form class="needs-validation"
                    action="{{ isset($fueltypeedit) ? route('Backend.fueltype.update', $fueltypeedit->id) : route('Backend.fueltype.store') }}"
                    method='post' enctype="multipart/form-data">
                    @if (isset($fueltypeedit))
                        @method('patch')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="basic-addon-name">Fuel Type Name</label>

                            <input type="text" id="basic-addon-name" name='name' class="form-control"
                                value="{{ isset($fueltypeedit) ? $fueltypeedit->name : '' }}" placeholder="Fuel Type Name"
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
                                class="btn btn-primary waves-effect waves-float waves-light">{{ isset($fueltypeedit) ? 'Update' : 'Add' }}</button>
                        </div>
                        @if (isset($fueltypeedit))
                            <div class="col-sm-6">
                                <img src="{{ asset($fueltypeedit->image) }}" class="bg-light-info" alt=""
                                    style="height:100px;width:100px;">
                            </div>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    @endcan

    @can('Fuel_type_read')
        <div class="card">
            <div class="card-header">
                <h3>Manage Fuel Type</h3>
            </div>
            <div class="card-body">
                {{-- <table class="datatables-basic table datatable table-responsive"> --}}
                <table class="display nowrap" id="fueltype" style="width:100% !important;">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Fuel Type Name</th>
                            <th>Image</th>
                            @canany(['Fuel_type_edit', 'Fuel_type_delete'])
                                <th>Action</th>
                            @endcan
                        </tr>

                    </thead>
                    <tbody>
                        @php $i=1;@endphp
                        @foreach ($fueltypes as $ft)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $ft->name }}</td>
                                <td><img src="{{ asset($ft->image) }}" class="me-75 bg-light-danger"
                                        style="height:60px;width:100px;" />
                                </td>
                                @canany(['Fuel_type_edit', 'Fuel_type_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $ftid=Crypt::encrypt($ft->id); @endphp
                                                        @can('Fuel_type_edit')
                                                            <a class="dropdown-item"
                                                                href="{{ route('Backend.fueltype.edit', $ftid) }}"><i class="me-1"
                                                                    data-feather="check-square"></i><span
                                                                    class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan
                                                        {{-- @can('Fuel_type_delete')
                                                <a class="dropdown-item" href=""
                                                onclick="event.preventDefault();document.getElementById('delete-form-{{ $ftid }}').submit();"><i
                                                    class="me-1" data-feather="message-square"></i><span
                                                    class="align-middle">Delete</span>
                                                </a>
                                                @endcan --}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                            {{-- @can('Fuel_type_delete')
                        <form id="delete-form-{{ $ftid }}" action="{{ route('Backend.fueltype.destroy', $ftid) }}"
                            method="post" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                        @endcan --}}
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
            $('#fueltype').DataTable({
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
