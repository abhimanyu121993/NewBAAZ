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
                    <form class="needs-validation" action="{{ route('Backend.addWorkshopOrder') }}" method='post'>
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}" />
                        <input type="hidden" name="order_no" value="{{ $order->order_id }}" />
                        <input type="hidden" name="workshop_id" value="{{ $order->assigned_workshop }}" />
                        <input type="hidden" name="service_type" value="Service" />
                        <input type="hidden" name="model_id" value="{{ $order->order_details[0]->model_id }}" />
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="desc">Add Order</label>
                                <select class="select2 form-select" id="select2-basic" name='service_id' required>
                                    <option selected disabled value="">--Select Service--</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->service_id }}">{{ $service->service_name }}</option>
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
                    <form class="needs-validation" action="{{ route('Backend.addWorkshopLabour') }}" method='post'>
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}" />
                        <input type="hidden" name="order_no" value="{{ $order->order_id }}" />
                        <input type="hidden" name="workshop_id" value="{{ $order->assigned_workshop }}" />
                        <input type="hidden" name="service_type" value="ServiceCharge" />
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
                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="basic-addon-name">Labour Charge</label>

                                <input type="text" id="basic-addon-name" name='labour_price' class="form-control"
                                        placeholder="Labour Charge" required />
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
                    <form class="needs-validation" action="{{ route('Backend.addWorkshopSpare') }}" method='post'>
                        @csrf
                        <div class="row">
                            <input type="hidden" name="order_id" value="{{ $order->id }}" />
                            <input type="hidden" name="order_no" value="{{ $order->order_id }}" />
                            <input type="hidden" name="workshop_id" value="{{ $order->assigned_workshop }}" />
                            <input type="hidden" name="service_type" value="OtherProduct" />

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
                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="basic-addon-name">Spare Charge</label>

                                <input type="text" id="basic-addon-name" name='spare_price' class="form-control"
                                        placeholder="Spare Charge" required />
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
            <h3>Service Charges</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($serviceDetails)
                        @foreach ($serviceDetails->workshop_order_details as $sd)
                            @if ($sd->type == 'Service')
                                <tr>
                                    <td>{{ $sd->service_charge->name ?? '' }}</td>
                                    <td>{{ $sd->service_charge->price ?? '' }}</td>
                                    @php $sid = Crypt::encrypt($sd->id); @endphp
                                    <td><a href="{{ route('Backend.delService', $sid) }}" class="btn btn-danger"><i
                                                data-feather="trash-2"></i></a></td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center">No data found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <hr />
        <div class="card-header">
            <h3>Labour Charges</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($serviceDetails)
                        @foreach ($serviceDetails->workshop_order_details->where('type', 'ServiceCharge') as $sd)
                            <tr>
                                <td>{{ $sd->labour_charge->name ?? '' }}</td>
                                <td>{{ $sd->amount ?? '' }}</td>
                                @php $sid = Crypt::encrypt($sd->id); @endphp
                                <td><a href="{{ route('Backend.delService', $sid) }}" class="btn btn-danger"><i
                                            data-feather="trash-2"></i></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center">No data found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <hr />
        <div class="card-header">
            <h3>Spare Charges</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($serviceDetails)
                        @foreach ($serviceDetails->workshop_order_details->where('type', 'OtherProduct') as $sd)
                            <tr>
                                <td>{{ $sd->spare_charge->name ?? '' }}</td>
                                <td>{{ $sd->amount ?? '' }}</td>
                                @php $sid = Crypt::encrypt($sd->id); @endphp
                                <td><a href="{{ route('Backend.delService', $sid) }}" class="btn btn-danger"><i
                                            data-feather="trash-2"></i></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center">No data found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <hr />
        <div class="card-body mt-5 pe-5" style="text-align: right;">
            <h3>Total Amount - {{ isset($order->workshop_order->total_amount)?$order->workshop_order->total_amount : 0 }}</h3>
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
