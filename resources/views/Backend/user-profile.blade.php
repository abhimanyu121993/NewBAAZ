@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')

    <div class="card">
        <div class="card-header">
            <h3>
                User Profile
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($editproduct) ? route('Backend.otherproduct.update', $editproduct->id) : route('Backend.otherproduct.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($editproduct))
                    @method('patch')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-1">
                        <img src="{{ asset('upload/bazz_logo.png') }}" class="me-75 bg-light-danger"
                            style="height:100px;width:150px;" />
                    </div>
                    <div class="col-md-4 mb-1 justify-content-start">
                        <h3>{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="col-md-4 mb-1 justify-content-start">
                        Role : <h3>{{ Auth::user()->roles[0]->name }}</h3>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Employee Id</label>

                        <input type="text" id="basic-addon-name" name='empid' class="form-control"
                            value="{{ Auth::user()->empid }}" placeholder="Employee Id" disabled required />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Name</label>

                        <input type="text" id="basic-addon-name" name='name' class="form-control"
                            value="{{ Auth::user()->name }}" placeholder="Name"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Email</label>

                        <input type="email" id="basic-addon-name" name='email' class="form-control"
                            value="{{ Auth::user()->email }}" placeholder="Email"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
                    </div>
                    
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Phone</label>

                        <input type="text" id="basic-addon-name" name='phone' class="form-control"
                            value="{{ Auth::user()->mobileno }}" placeholder="Phone"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
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
