@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')
    <div class="row">
        @foreach ($role as $rl)
            <!--begin::Col-->
            <div class="col-md-6" style="@if (count($role) < 4) style='width:400px !important' @endif">
                <!--begin::Card-->
                <div class="card card-flush h-md-100"
                    style="@if (count($role) < 4) style='width:400px !important' @endif">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            @php
                            $id=Crypt::encrypt($rl->id);
                            @endphp
                            <div class="row">
                                <div class="col-sm-10 float-left">
                                    <h2>{{ $rl->name }}</h2>
                                </div>
                                <div class="col-sm-2 float-right">
                                    <a class="btn btn-info"
                                        href="{{ route('Backend.permission.edit', $id) }}">Edit</a>
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
                            {{ $rl->users_count }}</div>
                        <!--end::Users-->
                        <!--begin::Permissions-->
                        <ul class="list-group list-group-flush">
                            @php
                                $i = 0;
                                $c = count($rl->permissions);
                            @endphp
                            @foreach ($rl->permissions as $per)
                                @if ($i > 4)
                                    @php
                                        $id = Crypt::encrypt($rl->id);
                                    @endphp
                                    <li class="list-group-item">
                                        <span class='me-1'></span>
                                        <a class="btn btn-primary" style="float: right;"
                                            href="{{ route('Backend.viewRole', $id) }}"><em>{{ $c }}
                                                More...</em></a>
                                    </li>
                                @break
                                @else
                                    <li class="list-group-item">
                                        <span class='bullet bg-primary me-1'></span>
                                        {{ $per->name }}
                                    </li>
                                @endif
                                @php $i++; @endphp
                            @endforeach
                        </ul>

                    <!--end::Permissions-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->

                <!--end::Card footer-->
            </div>
            <!--end::Card-->
        </div>

        <!--end::Col-->
    @endforeach
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
