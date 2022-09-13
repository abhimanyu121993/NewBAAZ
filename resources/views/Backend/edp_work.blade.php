@extends('layouts.adminLayout')
@section('Head-Area')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Backend/assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Backend/assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Backend/assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/tables/datatable/datatables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('Backend/assets/vendors/css/forms/select/select2.min.css')}}">
@endsection

@section('Content-Area')

@can('Pending_orders_read')
 <!-- Scroll - horizontal and vertical table -->
 <section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order List</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table nowrap scroll-horizontal-vertical">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Date</th>
                                        <th>Order Id</th>
                                        <th>Name</th>
                                        <th>Model</th>
                                        <th>Phone</th>
                                        <th>Jobcard</th>
                                        <th>Invoice</th>
                                        <th>Baaz Invoice</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders)
                                       @foreach ($orders as $order)
                                            <tr>
                                                <td><img src="{{ asset( $order->order_details[0]->model->image ?? '') }}" class="me-75 bg-light-danger"
                                                    style="height:80px;width:150px;" />
                                                </td>
                                                <td>{{ $order->created_at }}</td>
                                                @php $oid=Crypt::encrypt($order->id); @endphp
                                                <td><a href="#">BAAZ-{{ $order->order_id }}</a></td>
                                                <td>{{ $order->user->name ?? 'BAAZ Customer' }}</td>
                                                <td>{{ $order->order_details[0]->model->name ?? ''}}</td>
                                                <td>{{ $order->user->mobileno ?? ''}}</td>
                                                <td><a href="{{ route('Backend.jobcard.edit', $order->order_details[0]->id) }}">View Jobcard</a></td>
                                                <td><a href="{{ route('Backend.invoice', $order->id) }}" target="_blank">View Invoice</a></td>
                                                <td><a href="{{ route('Backend.baazInvoice', $order->id) }}" target="_blank">View Baaz Invoice</a></td>
                                                <td>{{ $order->order_status_detail->name ?? '' }}</td>
                                            </tr>
                                       @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Scroll - horizontal and vertical table -->
@endcan



@endsection

@section('Script-Area')
<script src="{{asset('Backend/assets/js/scripts/forms/form-select2.js')}}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/scripts/tables/table-datatables-advanced.js') }}"></script>



    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('Backend/assets/js/scripts/datatables/datatable.js') }}"></script>
    <script src="{{asset('BackEnd/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('Backend/assets/js/scripts/forms/form-select2.js')}}"></script>
@endsection
