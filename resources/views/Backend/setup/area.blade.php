@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

@section('Content-Area')
    @can('Area_create')
        <div class="card">
            <div class="card-header">
                <h3>
                    @if (!isset($editarea))
                        Add New Area
                    @else
                        Update Area
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form class="needs-validation"
                    action="{{ isset($editarea) ? route('Backend.area.update', $editarea->id) : route('Backend.area.store') }}"
                    method='post' enctype="multipart/form-data">
                    @if (isset($editarea))
                        @method('patch')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="desc">Country Name</label>
                            <select class="select2 form-select" id="select2-basic" name='country_id' required>

                                <option disabled value="">--Select Country--</option>
                                @foreach ($countries as $country)
                                    <option
                                        {{ !isset($editarea) ? '' : ($editarea->zones->countries->id == $country->id ? 'selected' : '') }}
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="desc">Zone Name</label>
                            <select class="select2 form-select" id="select2-basic" name='zone_id' required>

                                <option disabled value="">--Select Zone--</option>
                                @foreach ($zones as $zone)
                                    <option {{ !isset($editarea) ? '' : ($editarea->zones->id == $zone->id ? 'selected' : '') }}
                                        value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">

                            <div class="col-md-6 mb-1">
                                <label class="form-label" for="basic-addon-name">Area Name</label>

                                <input type="text" id="basic-addon-name" name='name' class="form-control"
                                    value="{{ isset($editarea) ? $editarea->name : '' }}" placeholder="Area Name"
                                    aria-label="Name" aria-describedby="basic-addon-name" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editarea) ? 'Update' : 'Add' }}</button>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    @endcan

    @can('Area_read')
        <div class="card">
            <div class="card-header">
                <h3>Manage Area</h3>
            </div>
            <div class="card-body">
                <table class="display nowrap" id="area" style="width:100% !important;">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Country Name</th>
                            <th>Zone Name</th>
                            <th>Area Name</th>
                            <th>Created at</th>
                            @canany(['Area_edit', 'Area_delete'])
                                <th>Action</th>
                            @endcan
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($areas as $area)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $area->zones->countries->name }}</td>
                                <td>{{ $area->zones->name }}</td>
                                <td>{{ $area->name }}</td>
                                <td>{{ $area->created_at }}</td>
                                @canany(['Area_edit', 'Area_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $aid=Crypt::encrypt($area->id); @endphp
                                                        @can('Area_edit')
                                                            <a class="dropdown-item" href="{{ route('Backend.area.edit', $aid) }}"><i
                                                                    class="me-1" data-feather="check-square"></i><span
                                                                    class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan
                                                        @can('Area_delete')
                                                            <a class="dropdown-item" href=""
                                                                onclick="event.preventDefault();document.getElementById('delete-form-{{ $aid }}').submit();"><i
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
                            @can('Area_delete')
                                <form id="delete-form-{{ $aid }}" action="{{ route('Backend.area.destroy', $aid) }}"
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
    <script src="{{ asset('Backend/assets/js/scripts/forms/form-select2.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#area').DataTable({
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
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>
@endsection
