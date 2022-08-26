@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')
@can('Battery_type_create')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($batteryedit))
                    Add New Battery Type
                @else
                    Update Battery Type
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($batteryedit) ? route('Backend.batterytype.update', $batteryedit->id) : route('Backend.batterytype.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($batteryedit))
                    @method('patch')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Battery Type Name</label>

                        <input type="text" id="basic-addon-name" name='name' class="form-control"
                            value="{{ isset($batteryedit) ? $batteryedit->name : '' }}" placeholder="Battery Type Name"
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
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($batteryedit) ? 'Update' : 'Add' }}</button>
                    </div>
                    @if (isset($batteryedit))
                        <div class="col-sm-6">
                            <img src="{{asset($batteryedit->image) }}" class="bg-light-info" alt="" style="height:100px;width:200px;">
                        </div>
                    @endif
                </div>

            </form>
        </div>
    </div>
@endcan

@can('Battery_type_read')
    <div class="card">
        <div class="card-header">
            <h3>Manage Battery Type</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Image</th>
                        @canany(['Battery_type_edit', 'Battery_type_delete'])
                            <th>Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($batterytypes as $battery)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $battery->name }}</td>
                            <td><img src="{{ asset( $battery->image) }}" class="me-75 bg-light-danger"
                                    style="height:60px;width:150px;" />
                            </td>
                            @canany(['Battery_type_edit', 'Battery_type_delete'])
                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @php $bid=Crypt::encrypt($battery->id); @endphp
                                                @can('Battery_type_edit')
                                                    <a class="dropdown-item" href="{{ route('Backend.batterytype.edit', $bid) }}"><i
                                                        class="me-1" data-feather="check-square"></i><span
                                                        class="align-middle">Edit</span>
                                                    </a>
                                                @endcan

                                                @can('Battery_type_delete')
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
                        @can('Battery_type_delete')
                        <form id="delete-form-{{ $bid }}" action="{{ route('Backend.batterytype.destroy', $bid) }}"
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
