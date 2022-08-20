@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')
    <!--begin::Col-->
    <div class="col-md-6">
        <!--begin::Card-->
        <div class="card card-flush h-md-100" >
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <div class="row">
                        <div class="col-sm-10 float-left">
                            <h2>{{ $role->name }}</h2>
                        </div>
                        <div class="col-sm-2 float-right">
                            <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>

                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="pt-1 card-body">
                <!--begin::Users-->
                <div class="mb-1 text-gray-600 fw-bolder">Total users with this role:
                    {{ $role->users_count }}</div>
                <!--end::Users-->
                <!--begin::Permissions-->
                <ul class="list-group list-group-flush">
                    @foreach ($role->permissions as $per)
                        <li class="list-group-item">
                            <span class='bullet bg-primary me-1'></span>
                            {{ $per->name }}
                        </li>
                    @endforeach
                </ul>
                <!--end::Permissions-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->

            <!--end::Card footer-->
        </div>
        <!--end::Card-->
    @endsection


    @section('Script-Area')
        {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
        <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
        <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    @endsection
