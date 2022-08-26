@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')

@can('Country_create')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($editrole))
                    Add New Country
                @else
                    Update Country
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($editcountry) ? route('Backend.country.update', $editcountry->id) : route('Backend.country.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($editcountry))
                    @method('patch')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Country Name</label>

                        <input type="text" id="basic-addon-name" name='name' class="form-control"
                            value="{{ isset($editcountry) ? $editcountry->name : '' }}" placeholder="Country Name"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editcountry) ? 'Update' : 'Add' }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endcan

@can('Country_read')
<div class="card">
    <div class="card-header">
        <h3>Manage Country</h3>
    </div>
    <div class="card-body">
        <table class="datatables-basic table datatable table-responsive">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Created at</th>
                    @canany(['Country_edit', 'Country_delete'])
                        <th>Action</th>
                    @endcan
                </tr>

            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->created_at }}</td>
                        @canany(['Country_edit', 'Country_delete'])
                        <td>
                            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                <div class="mb-1 breadcrumb-right">
                                    <div class="dropdown">
                                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                            type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i data-feather="grid"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @php $cid=Crypt::encrypt($country->id); @endphp
                                            @can('Country_edit')
                                                <a class="dropdown-item" href="{{ route('Backend.country.edit', $cid) }}"><i
                                                        class="me-1" data-feather="check-square"></i><span
                                                        class="align-middle">Edit</span>
                                                </a>
                                            @endcan
                                            @can('Country_delete')
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
                    @can('Country_delete')
                        <form id="delete-form-{{ $cid }}" action="{{ route('Backend.country.destroy', $cid) }}"
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
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection
