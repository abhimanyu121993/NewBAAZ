@extends('layouts.adminLayout')
@section('Head-Area')
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('Backend/assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('Backend/assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('Backend/assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection

@section('Content-Area')
    <div class="card">
        <div class="card-header">
            <h3>Order Details</h3>
        </div>
        <div class="card-body">
            <table class="dt-column-search table datatable table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Service Image</th>
                        <th>Service type</th>
                        <th>Service price</th>
                    </tr>

                </thead>
                <tbody>
                    @if($orderDetails)
                        @foreach ($orderDetails->order_details as $orderd )
                        <tr>
                            <td><img src="{{asset($orderd->servicetype->image ?? '')}}" class="me-75 bg-light-danger"
                                style="height:35px;width:35px;" /></td>
                            <td>{{ $orderd->servicetype->name ?? '' }}</td>
                            <td>{{ $orderd->servicetype->price ?? '' }}</td>
                        </tr>
                        @role('Superadmin|Workshop')
                        <tr>
                            @if ($order->jobcard)
                                @if ($order->jobcard->status == 1)
                                    <td><a href="{{ route('Backend.orderServiceDetail', $order->id) }}" class="btn btn-success">Service</a></td>
                                @endif
                            @endif

                            <td><a href="{{ route('Backend.jobcard.edit', $order->id) }}" class="btn btn-primary">Job Card</a></td>
                        </tr>
                        @endrole
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center">Service not available for this order</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>

@endsection

@section('Script-Area')
<script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
<script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>


@endsection
