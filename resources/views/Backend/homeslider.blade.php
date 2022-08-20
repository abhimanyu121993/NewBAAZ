@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($brandedit))
                    Add New Slider
                @else
                    Edit Slider
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($slideredit) ? route('Backend.homeslider.update', $slideredit->id) : route('Backend.homeslider.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($slideredit))
                    @method('patch')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Slider Link</label>

                        <input type="text" id="basic-addon-name" name='link' class="form-control"
                            value="{{ isset($slideredit) ? $slideredit->link : '' }}" placeholder="Enter Link"
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
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($slideredit) ? 'Update' : 'Add' }}</button>
                    </div>
                    @if (isset($slideredit))
                        <div class="col-sm-6">
                            <img src="{{asset($slideredit->image) }}" class="bg-light-info" alt="" style="height:100px;width:200px;">
                        </div>
                    @endif
                </div>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Manage Sliders</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Image</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    @php $i=1;@endphp
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <img src="{{ asset( $slider->image) }}" class="me-75 bg-light-danger"
                                    style="height:60px;width:150px;" />
                            </td>
                            <td>{{ $slider->link }}</td>
                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @php $sid=Crypt::encrypt($slider->id); @endphp
                                                <a class="dropdown-item" href="{{ route('Backend.homeslider.edit', $sid) }}"><i
                                                        class="me-1" data-feather="check-square"></i><span
                                                        class="align-middle">Edit</span></a>
                                                        <a class="dropdown-item" href=""
                                                        onclick="event.preventDefault();document.getElementById('delete-form-{{ $sid }}').submit();"><i
                                                            class="me-1" data-feather="message-square"></i><span
                                                            class="align-middle">Delete</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <form id="delete-form-{{ $sid }}" action="{{ route('Backend.homeslider.destroy', $sid) }}"
                            method="post" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('Script-Area')
    {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection
