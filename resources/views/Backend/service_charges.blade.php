@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')
@can('Service_charge_create')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($editservice))
                    Add New Service Charge
                @else
                    Update Service Charge
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($editservice) ? route('Backend.servicecharge.update', $editservice->id) : route('Backend.servicecharge.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($editservice))
                    @method('patch')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Service Charge Name</label>

                        <input type="text" id="basic-addon-name" name='name' class="form-control"
                            value="{{ isset($editservice) ? $editservice->name : '' }}" placeholder="Service Charge Name"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editservice) ? 'Update' : 'Add' }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endcan

@can('Service_charge_read')
    <div class="card">
        <div class="card-header">
            <h3>Manage Service Charges</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Created at</th>
                        @canany(['Service_charge_edit', 'Service_charge_delete'])
                            <th>Action</th>
                        @endcan
                    </tr>

                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->created_at }}</td>
                            @canany(['Service_charge_edit', 'Service_charge_delete'])
                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @php $cid=Crypt::encrypt($service->id); @endphp
                                                @can('Service_charge_edit')
                                                <a class="dropdown-item" href="{{ route('Backend.servicecharge.edit', $cid) }}"><i
                                                        class="me-1" data-feather="check-square"></i><span
                                                        class="align-middle">Edit</span>
                                                </a>
                                                @endcan
                                                @can('Service_charge_delete')
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
                        @can('Service_charge_delete')
                        <form id="delete-form-{{ $cid }}" action="{{ route('Backend.servicecharge.destroy', $cid) }}"
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
