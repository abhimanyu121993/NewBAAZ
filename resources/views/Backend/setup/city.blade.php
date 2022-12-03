@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection
@endsection

@section('Content-Area')
@can('City_create')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($editcity))
                    Add New City
                @else
                    Update City
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($editcity) ? route('Backend.city.update', $editcity->id) : route('Backend.city.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($editcity))
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
                                    {{ !isset($editcity) ? '' : ($editcity->zone->areas->countries->id == $country->id ? 'selected' : '') }}
                                    value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Zone Name</label>
                        <select class="select2 form-select" id="select2-basic" name='zone_id' required>

                            <option disabled value="">--Select Zone--</option>
                            @foreach ($zones as $zone)
                                <option {{ !isset($editcity) ? '' : ($editcity->zone->id == $zone->id ? 'selected' : '') }}
                                    value="{{ $zone->id }}">{{ $zone->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Area Name</label>
                        <select class="select2 form-select" id="select2-basic" name='area_id' required>

                            <option disabled value="">--Select Area--</option>
                            @foreach ($areas as $area)
                                <option
                                    {{ !isset($editcity) ? '' : ($editcity->areas->id == $area->id ? 'selected' : '') }}
                                    value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">City Name</label>

                        <input type="text" id="basic-addon-name" name='name' class="form-control"
                            value="{{ isset($editcity) ? $editcity->name : '' }}" placeholder="City Name" aria-label="Name"
                            aria-describedby="basic-addon-name" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editcity) ? 'Update' : 'Add' }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endcan

@can('City_read')
    <div class="card">
        <div class="card-header">
            <h3>Manage City</h3>
        </div>
        <div class="card-body">
            <table class="display nowrap" id="city" style="width:100% !important;">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Country Name</th>
                        <th>Zone Name</th>
                        <th>Area Name</th>
                        <th>City Name</th>
                        <th>Created at</th>
                        @canany(['City_edit', 'City_delete'])
                            <th>Action</th>
                        @endcan
                    </tr>

                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $city->zone->countries->name }}</td>
                            <td>{{ $city->zone->name }}</td>
                            <td>{{ $city->area->name }}</td>
                            <td>{{ $city->name }}</td>
                            <td>{{ $city->created_at }}</td>
                            @canany(['City_edit', 'City_delete'])
                                <td>
                                    <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                        <div class="mb-1 breadcrumb-right">
                                            <div class="dropdown">
                                                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i data-feather="grid"></i></button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @php $cid=Crypt::encrypt($city->id); @endphp
                                                    @can('City_edit')
                                                        <a class="dropdown-item" href="{{ route('Backend.city.edit', $cid) }}"><i
                                                                class="me-1" data-feather="check-square"></i><span
                                                                class="align-middle">Edit</span>
                                                        </a>
                                                    @endcan
                                                    @can('City_delete')
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
                        @can('City_delete')
                            <form id="delete-form-{{ $cid }}" action="{{ route('Backend.city.destroy', $cid) }}"
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
        $('#city').DataTable({
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
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                'colvis'
            ]
        });
    });
</script>
@endsection
