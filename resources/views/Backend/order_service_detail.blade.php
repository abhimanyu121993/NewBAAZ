@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('Content-Area')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" action="#" method='post'>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="desc">Add Order</label>
                                <select class="select2 form-select" id="select2-basic" name='service_id' required>
                                    <option selected disabled value="">--Select Service--</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-float waves-light">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" action="#" method='post'>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="desc">Add Labour</label>
                                <select class="select2 form-select" id="select2-basic" name='labour_id' required>
                                    <option selected disabled value="">--Select Labour--</option>
                                    @foreach ($serviceCharges as $serviceCharge)
                                        <option value="{{ $serviceCharge->id }}">{{ $serviceCharge->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-float waves-light">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" action="#" method='post'>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="desc">Add Spare</label>
                                <select class="select2 form-select" id="select2-basic" name='spare_id' required>
                                    <option selected disabled value="">--Select Spare--</option>
                                    @foreach ($otherProducts as $otherProduct)
                                        <option value="{{ $otherProduct->id }}">{{ $otherProduct->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-float waves-light">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Order Details</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>MRP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Minor Car Service</td>
                        <td>5000</td>
                        <td><a class="btn btn-danger">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr/>
        <div class="card-header">
            <h3>Labour Details</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>MRP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Minor Car Service</td>
                        <td>1</td>
                        <td>5000</td>
                        <td><a class="btn btn-danger">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr/>
        <div class="card-header">
            <h3>Spare Details</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>MRP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Minor Car Service</td>
                        <td>1</td>
                        <td>5000</td>
                        <td><a class="btn btn-danger">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr/>
        <div class="card-body mt-5 pe-5" style="text-align: right;">
           <h3>Total Amount - 500</h3>
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
    <script src="{{ asset('BackEnd/assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/scripts/forms/form-select2.js') }}"></script>
@endsection
