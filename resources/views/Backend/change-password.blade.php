@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')

    <div class="card">
        <div class="card-header">
            <h3>
                Change Password
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ route('Backend.authuser.updatePassword') }}"
                method='post' enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Current Password</label>

                        <input type="text" id="basic-addon-name" name='current_password' class="form-control"
                            value="" placeholder="Current Password" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">New Password</label>

                        <input type="text" id="basic-addon-name" name='new_password' class="form-control"
                            value="" placeholder="New Password" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Confirm New Password</label>

                        <input type="text" id="basic-addon-name" name='cnew_password' class="form-control"
                            value="" placeholder="Confirm New Password" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">Update</button>
                    </div>
                </div>

            </form>
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
