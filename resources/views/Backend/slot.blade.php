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
                    @if (!isset($editslot))
                        Add New Slot
                    @else
                        Update Slot
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form class="needs-validation"
                    action="{{ isset($editslot) ? route('Backend.slot.update', $editslot->id) : route('Backend.slot.store') }}"
                    method='post' enctype="multipart/form-data">
                    @if (isset($editslot))
                        @method('patch')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="timeInput">Slot Name</label>

                            <input type="time" name='name' class="form-control"
                                value="{{ isset($editslot) ? $editslot->name : '' }}" placeholder="Slot Name" aria-label="Name"
                                aria-describedby="basic-addon-name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit"
                                class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editslot) ? 'Update' : 'Add' }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    @endcan

    @can('Slot_read')
        <div class="card">
            <div class="card-header">
                <h3>Manage Slots</h3>
            </div>
            <div class="card-body">
                <table class="datatables-basic table datatable table-responsive">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Slot Name</th>
                            <th>Created at</th>
                            @canany(['Slot_edit', 'Slot_delete'])
                                <th>Action</th>
                            @endcan
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($slots as $slot)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ date("g:iA", strtotime($slot->name)) }}</td>
                                <td>{{ $slot->created_at }}</td>
                                @canany(['Country_edit', 'Country_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $cid=Crypt::encrypt($slot->id); @endphp
                                                        @can('Slot_edit')
                                                            <a class="dropdown-item" href="{{ route('Backend.slot.edit', $cid) }}"><i
                                                                    class="me-1" data-feather="check-square"></i><span
                                                                    class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan
                                                        @can('Slot_delete')
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
                            @can('Slot_delete')
                                <form id="delete-form-{{ $cid }}" action="{{ route('Backend.slot.destroy', $cid) }}"
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
