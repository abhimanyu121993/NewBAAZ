@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('Backend/assets/vendors/css/forms/select/select2.min.css')}}">
@endsection

@section('Content-Area')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($jobcard))
                    Jobcard
                @else
                    Update Jobcard
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($jobcard) ? route('Backend.jobcard.update', $jobcard->id) : route('Backend.jobcard.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($jobcard))
                    @method('patch')
                @endif
                @csrf
                <div class="row">

                    <input type="hidden" name="order_id" value="{{$oid}}" />
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Registered Vehicle Number</label>
                        <input type="text" name='regno' class="form-control " value="{{ isset($jobcard) ? $jobcard->regno : '' }}" placeholder="Registered Vehicle Number" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Odometer Reading</label>
                        <input type="text" name='odometer_reading' class="form-control " value="{{ isset($jobcard) ? $jobcard->odometer_reading : '' }}" placeholder="Odometer Reading" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Year Of Manufacturing</label>
                        <input type="text" name='manufacturing_year' class="form-control " value="{{ isset($jobcard) ? $jobcard->manufacturing_year : '' }}" placeholder="Year of manufacturing" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Gender</label>
                        <select class="form-select" name='gender' required>
                        <option selected disabled value="">--Select Gender--</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->gender == 'male' ? 'selected' : '') }} value="male">Male</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->gender == 'female' ? 'selected' : '') }} value="female">Female</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Mechanic</label>
                        <input type="text" name='mechanic_name' class="form-control " value="{{ isset($jobcard) ? $jobcard->mechanic_name : '' }}" placeholder="Mechanic Name" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Arrival Mode</label>
                        <select class="form-select" name='arrival_mode' required>
                        <option selected disabled value="">--Select Arrival Mode--</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->arrival_mode == 'pickup_drop' ? 'selected' : '') }} value="pickup_drop">Pickup & Drop</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->arrival_mode == 'walkin' ? 'selected' : '') }} value="walkin">Walkin</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Walkin date</label>
                        <input type="date" name='walkin_date' class="form-control " value="{{ isset($jobcard) ? $jobcard->walkin_date : '' }}"  />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Walkin Time</label>
                        <input type="time" name='walkin_time' class="form-control " value="{{ isset($jobcard) ? $jobcard->walkin_time : '' }}"/>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Name</label>
                        <input type="text" name='cust_name' class="form-control " value="{{ isset($jobcard) ? $jobcard->cust_name : '' }}" placeholder="Customer Name" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Mobile</label>
                        <input type="text" name='cust_phone' class="form-control " value="{{ isset($jobcard) ? $jobcard->cust_phone : '' }}" placeholder="Customer Mobile Number" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Email</label>
                        <input type="text" name='cust_email' class="form-control " value="{{ isset($jobcard) ? $jobcard->cust_email : '' }}" placeholder="Customer Email" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Address</label>
                        <input type="text" name='cust_address' class="form-control " value="{{ isset($jobcard) ? $jobcard->cust_address : '' }}" placeholder="Customer Address" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Fuel Level</label>
                        <select class="form-select" name='fuel_level' required>
                        <option selected disabled value="">--Select Fuel Level--</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->fuel_level == '0' ? 'selected' : '') }} value="0">0%</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->fuel_level == '10' ? 'selected' : '') }} value="10">10%</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->fuel_level == '20' ? 'selected' : '') }} value="20">20%</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->fuel_level == '30' ? 'selected' : '') }} value="30">30%</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->fuel_level == '40' ? 'selected' : '') }} value="40">40%</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->fuel_level == '50' ? 'selected' : '') }} value="50">50%</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Floor Mat</label>
                        <input type="text" name='floor_mat' class="form-control " value="{{ isset($jobcard) ? $jobcard->floor_mat : '' }}" placeholder="Floor Mat" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Wheel Cap</label>
                        <select class="form-select" name='wheel_cap' required>
                        <option selected disabled value="">--Select Wheel Cap--</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->wheel_cap == '0' ? 'selected' : '') }} value="0">0</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->wheel_cap == '1' ? 'selected' : '') }} value="1">1</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->wheel_cap == '2' ? 'selected' : '') }} value="2">2</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->wheel_cap == '3' ? 'selected' : '') }} value="3">3</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->wheel_cap == '4' ? 'selected' : '') }} value="4">4</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Head Rest</label>
                        <select class="form-select" name='head_rest' required>
                        <option selected disabled value="">--Select Head Rest--</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->head_rest == '0' ? 'selected' : '') }} value="0">0</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->head_rest == '1' ? 'selected' : '') }} value="1">1</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->head_rest == '2' ? 'selected' : '') }} value="2">2</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->head_rest == '3' ? 'selected' : '') }} value="3">3</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->head_rest == '4' ? 'selected' : '') }} value="4">4</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Mud Flap</label>
                        <select class="form-select" name='mud_flap' required>
                        <option selected disabled value="">--Select Mud Flap--</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->mud_flap == '0' ? 'selected' : '') }} value="0">0</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->mud_flap == '1' ? 'selected' : '') }} value="1">1</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->mud_flap == '2' ? 'selected' : '') }} value="2">2</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->mud_flap == '3' ? 'selected' : '') }} value="3">3</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->mud_flap == '4' ? 'selected' : '') }} value="4">4</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Battery Info</label>
                        <select class="select2 form-select" id="select2-basic"  name='battery_id' required>
                        <option selected disabled value="">--Select Battery Type--</option>
                            @foreach ($batterytypes as $battery)
                                <option {{ !isset($jobcard) ? '': ($jobcard->battery_id == $battery->id ? 'selected' : '') }} value="{{$battery->id}}">{{$battery->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Interior Inventry Check</label>
                        <select class="form-select" name='interior_inventory' required>
                        <option selected disabled value="">--Select Inventory--</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->interior_inventory == 'perfume' ? 'selected' : '') }} value="perfume">Perfume</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->interior_inventory == 'idol' ? 'selected' : '') }} value="idol">Idol</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->interior_inventory == 'fog_lamp' ? 'selected' : '') }} value="fog_lamp">Fog Lamp</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->interior_inventory == 'usb' ? 'selected' : '') }} value="usb">USB</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->interior_inventory == 'lighter' ? 'selected' : '') }} value="lighter">Lighter</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Document</label>
                        <select class="form-select" name='document' required>
                        <option selected disabled value="">--Select Document--</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->document == 'rc' ? 'selected' : '') }} value="rc">RC</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->document == 'puc' ? 'selected' : '') }} value="puc">PUC</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->document == 'insurance' ? 'selected' : '') }} value="insurance">Insurance</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->document == 'road_tax' ? 'selected' : '') }} value="road_tax">Road Tax</option>
                            <option {{ !isset($jobcard) ? '': ($jobcard->document == 'passenger_tax' ? 'selected' : '') }} value="passenger_tax">Passenger Tax</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($jobcard) ? 'Update' : 'Add' }}</button>
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
    <script src="{{asset('BackEnd/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('Backend/assets/js/scripts/forms/form-select2.js')}}"></script>
@endsection
