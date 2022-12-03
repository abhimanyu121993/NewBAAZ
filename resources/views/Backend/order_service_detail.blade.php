@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
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
                                <label class="form-label" for="desc">Add Services</label>
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
                                <label class="form-label" for="desc">Add Labour Work</label>
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
                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="basic-addon-name">Labour Quantity</label>
                                <br />
                                <button type="button" id="sub" class="sub btn-sm btn-info">-</button>
                                <input type="number" name="labour_quantity" value="1" min="1" max="100" />
                                <button type="button" id="add" class="add btn-sm btn-info">+</button>
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
                                <label class="form-label" for="desc">Add Spare Work</label>
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
                            <div class="col-md-12 mb-1">
                                <label class="form-label" for="basic-addon-name">Spare Quantity</label>
                                <br />
                                <button type="button" id="sub" class="sub btn-sm btn-info">-</button>
                                <input type="number" name="spare_quantity" value="1" min="1"
                                    max="100" />
                                <button type="button" id="add" class="add btn-sm btn-info">+</button>
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
            {{-- <table class="datatables-basic table datatable table-responsive"> --}}
            <table class="display nowrap" id="order_service_detail" style="width:100% !important;">
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
                                    <td>{{ App\Models\Service::getServicePriceById($sd->service_charge->id, $order->order_details[0]->model_id)[0] }}
                                    </td>
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
            <table class="display nowrap" id="labour_charges" style="width:100% !important;">
                {{-- <table class="datatables-basic table datatable table-responsive"> --}}
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($serviceDetails)
                        @foreach ($serviceDetails->workshop_order_details->where('type', 'ServiceCharge') as $sd)
                            <tr>
                                <td>{{ $sd->labour_charge->name ?? '' }}</td>
                                <td id="labour_charge">{{ $sd->amount ?? '' }}</td>
                                <td> {{ $sd->quantity }} </td>
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
            <table class="display nowrap" id="spare_charges" style="width:100% !important;">
                {{-- <table class="datatables-basic table datatable table-responsive"> --}}
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($serviceDetails)
                        @foreach ($serviceDetails->workshop_order_details->where('type', 'OtherProduct') as $sd)
                            <tr>
                                <td>{{ $sd->spare_charge->name ?? '' }}</td>
                                <td id="spare_charge">{{ $sd->amount ?? '' }}</td>
                                <td> {{ $sd->quantity }} </td>
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
        <div class="card-body">
            <form class="form-control" action="{{ route('Backend.updateOrderRemark') }}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="order_id" value="{{ $order->id }}" />
                    <div class="col-md-10 mb-1">
                        <label class="form-label" for="basic-addon-name">Remark</label>
                        <textarea name='remark' class="form-control" placeholder="Remark">{{ isset($order) ? $order->remark : '' }}</textarea>
                    </div>
                    <div class="col-sm-2 mt-4">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($order->remark) ? 'Update' : 'Add' }}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body mt-5 pe-5" style="text-align: right;">
            <h3>Total Amount - {{ isset($order->workshop_order->total_amount) ? $order->workshop_order->total_amount : 0 }}
            </h3>
        </div>
    </div>
@endsection


@section('Script-Area')
    {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
    {{-- <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script> --}}
    <script src="{{ asset('BackEnd/assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/scripts/forms/form-select2.js') }}"></script>

    <script>
        $('.add').click(function() {
            if ($(this).prev().val() < 100) {
                $(this).prev().val(+$(this).prev().val() + 1);

            }
        });
        $('.sub').click(function() {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#order_service_detail').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#labour_charges').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#spare_charges').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection
