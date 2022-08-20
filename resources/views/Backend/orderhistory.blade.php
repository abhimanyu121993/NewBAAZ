@extends('layouts.adminLayout')
@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Backend/assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Backend/assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Backend/assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/tables/datatable/datatables.min.css')}}">
@endsection

@section('Content-Area')
    {{-- <div class="card">
        <div class="card-header">
            <h3>Order History</h3>
        </div>
        <div class="card-body">
            <table class="dt-column-search table datatable table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Pic</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>

                    </tr>

                </thead>
                <tbody>
                        <tr>
                            <td>1</td>
                            <td></td>
                            <td>Himanshu Sharma</td>
                            <td>sharmah@gmail.com</td>
                            <td>8896287276</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td></td>
                            <td>DeepaK Chandra</td>
                            <td>deepak@gmail.com</td>
                            <td>643234221</td>
                            <td></td>
                        </tr>

                </tbody>
            </table>

        </div>
        <div class="card-footer">
            {!! $orders->links('pagination::bootstrap-5') !!}
        </div>
    </div> --}}

 <!-- Scroll - horizontal and vertical table -->
 <section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order History</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table nowrap scroll-horizontal-vertical">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Order Id</th>
                                        <th>Name</th>
                                        <th>Slots</th>
                                        <th>Phone</th>
                                        <th>Amount</th>
                                        <th>Order Status</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Status</th>
                                        <th>Ordered at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders)
                                       @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                @php $oid=Crypt::encrypt($order->order_id); @endphp
                                                <td><a href="{{ route('Backend.orderhistory.show', $oid) }}">BAAZ-{{ $order->order_id }}</a></td>
                                                <td>{{ $order->user->name ?? 'BAAZ Customer' }}</td>
                                                <td>{{ $order->slot ?? ''}}</td>
                                                <td>{{ $order->user->mobileno ?? ''}}</td>
                                                <td>{{ $order->total_amount }}</td>
                                                <td>{{ $order->order_status }}</td>
                                                <td>{{ $order->payment_mode }}</td>
                                                <td>{{ $order->payment_status }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                                        <div class="mb-1 breadcrumb-right">
                                                            <div class="dropdown">
                                                                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"><i data-feather="grid"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    @php $oid=Crypt::encrypt($order->id); @endphp
                                                                    <a class="dropdown-item" href="#"
                                                                        onclick="event.preventDefault();
                                                        document.getElementById('delete-form-{{ $oid }}').submit();"><i
                                                                            class="me-1" data-feather="trash-2"></i><span
                                                                            class="align-middle">Delete</span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <form id="delete-form-{{ $oid }}" action="#"
                                            method="post" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
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



@endsection

@section('Script-Area')
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


    <script src="{{ asset('Backend/assets/js/scripts/datatables/datatable.js') }}"></script>

@endsection
