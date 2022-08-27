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
                @if (!isset($editjobcard))
                    Order Jobcard
                @else
                    Update Order Jobcard
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ route('Backend.orderJobcard') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($modeledit))
                    @method('patch')
                @endif
                @csrf
                <div class="row">

                    <input type="hidden" name="order_id" value="{{$oid}}" />
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Registered Vehicle Number</label>
                        <input type="text" name='regno' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Registered Vehicle Number" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Odometer Reading</label>
                        <input type="text" name='odometer_reading' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Odometer Reading" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Year Of Manufacturing</label>
                        <input type="text" name='manufacturing_year' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Year of manufacturing" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Gender</label>
                        <select class="form-select" name='gender' required>
                        <option selected disabled value="">--Select Gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Mechanic</label>
                        <input type="text" name='mechanic_name' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Mechanic Name" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Arrival Mode</label>
                        <select class="form-select" name='arrival_mode' required>
                        <option selected disabled value="">--Select Arrival Mode--</option>
                            <option value="pickup_drop">Pickup & Drop</option>
                            <option value="walkin">Walkin</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Walkin date</label>
                        <input type="date" name='walkin_date' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}"  />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Walkin Time</label>
                        <input type="time" name='walkin_time' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}"/>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Name</label>
                        <input type="text" name='cust_name' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Customer Name" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Mobile</label>
                        <input type="text" name='cust_phone' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Customer Mobile Number" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Email</label>
                        <input type="text" name='cust_email' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Customer Email" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Address</label>
                        <input type="text" name='cust_address' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Customer Address" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Fuel Level</label>
                        <select class="form-select" name='fuel_level' required>
                        <option selected disabled value="">--Select Fuel Level--</option>
                            <option value="0">0%</option>
                            <option value="10">10%</option>
                            <option value="20">20%</option>
                            <option value="30">30%</option>
                            <option value="40">40%</option>
                            <option value="50">50%</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Floor Mat</label>
                        <input type="text" name='floor_mat' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Floor Mat" />
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Wheel Cap</label>
                        <select class="form-select" name='wheel_cap' required>
                        <option selected disabled value="">--Select Wheel Cap--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Head Rest</label>
                        <select class="form-select" name='head_rest' required>
                        <option selected disabled value="">--Select Head Rest--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Mud Flap</label>
                        <select class="form-select" name='mud_flap' required>
                        <option selected disabled value="">--Select Mud Flap--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Battery Info</label>
                        <select class="select2 form-select" id="select2-basic"  name='battery_id' required>
                        <option selected disabled value="">--Select Battery Type--</option>
                            @foreach ($batterytypes as $battery)
                                <option value="{{$battery->id}}">{{$battery->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Interior Inventry Check</label>
                        <select class="form-select" name='interior_inventory' required>
                        <option selected disabled value="">--Select Inventory--</option>
                            <option value="perfume">Perfume</option>
                            <option value="idol">Idol</option>
                            <option value="fog_lamp">Fog Lamp</option>
                            <option value="usb">USB</option>
                            <option value="lighter">Lighter</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Document</label>
                        <select class="form-select" name='document' required>
                        <option selected disabled value="">--Select Document--</option>
                            <option value="rc">RC</option>
                            <option value="puc">PUC</option>
                            <option value="insurance">Insurance</option>
                            <option value="road_tax">Road Tax</option>
                            <option value="passenger_tax">Passenger Tax</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($modeledit) ? 'Update' : 'Add' }}</button>
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
