@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

@section('Content-Area')
    @can('Zone_create')
        <div class="card">
            <div class="card-header">
                <h3>
                    @if (!isset($editrole))
                        Add New Zone
                    @else
                        Update Zone
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form class="needs-validation"
                    action="{{ isset($editzone) ? route('Backend.zone.update', $editzone->id) : route('Backend.zone.store') }}"
                    method='post' enctype="multipart/form-data">
                    @if (isset($editzone))
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
                                        {{ !isset($editzone) ? '' : ($editzone->countries->id == $country->id ? 'selected' : '') }}
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="basic-addon-name">Zone Name</label>

                            <input type="text" id="basic-addon-name" name='name' class="form-control"
                                value="{{ isset($editzone) ? $editzone->name : '' }}" placeholder="Zone Name" aria-label="Name"
                                aria-describedby="basic-addon-name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit"
                                class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editzone) ? 'Update' : 'Add' }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    @endcan

    @can('Zone_read')
        <div class="card">
            <div class="card-header">
                <h3>Manage Zone</h3>
            </div>
            <div class="card-body">
                {{-- <table class="datatables-basic table datatable table-responsive"> --}}
                <table class="display nowrap" id="Zone" style="width:100% !important;">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Country Name</th>
                            <th>Zone Name</th>
                            <th>Created at</th>
                            @canany(['Zone_edit', 'Zone_delete'])
                                <th>Action</th>
                            @endcan
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($zones as $zone)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $zone->countries->name }}</td>
                                <td>{{ $zone->name }}</td>
                                <td>{{ $zone->created_at }}</td>
                                @canany(['Zone_edit', 'Zone_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $zid=Crypt::encrypt($zone->id); @endphp
                                                        @can('Zone_edit')
                                                            <a class="dropdown-item" href="{{ route('Backend.zone.edit', $zid) }}"><i
                                                                    class="me-1" data-feather="check-square"></i><span
                                                                    class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan
                                                        @can('Zone_delete')
                                                            <a class="dropdown-item" href=""
                                                                onclick="event.preventDefault();document.getElementById('delete-form-{{ $zid }}').submit();"><i
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
                            @can('Zone_delete')
                                <form id="delete-form-{{ $zid }}" action="{{ route('Backend.zone.destroy', $zid) }}"
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
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{asset('BackEnd/assets/vendors/js/forms/select/select2.full.min.js')}}"></script> --}}
    <script src="{{ asset('Backend/assets/js/scripts/forms/form-select2.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#Zone').DataTable({
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
