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

@can('Confirmed_orders_read')
 <!-- Scroll - horizontal and vertical table -->
 <section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Confirmed Orders</h4>
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
                                        <th>Model</th>
                                        <th>Slots</th>
                                        <th>Phone</th>
                                        <th>Order Status</th>
                                        <th>Ordered at</th>
                                        @canany(['Confirmed_orders_edit', 'Confirmed_orders_delete'])
                                            <th>Assigned To</th>
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($pendingorders)
                                       @foreach ($pendingorders as $order)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                @php $oid=Crypt::encrypt($order->id); @endphp
                                                <td><a href="{{ route('Backend.orderhistory.show', $oid) }}">BAAZ-{{ $order->order_id }}</a></td>
                                                <td>{{ $order->user->name ?? 'BAAZ Customer' }}</td>
                                                <td>{{ $order->order_details[0]->model->name ?? ''}}</td>
                                                <td>{{ $order->slot_detail->name ?? ''}}</td>
                                                <td>{{ $order->user->mobileno ?? ''}}</td>
                                                <td>{{ $order->order_status_detail->name ?? '' }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                @canany(['Confirmed_orders_edit', 'Confirmed_orders_delete'])
                                                <form id="allotworkshop" action="{{ route('Backend.allotWorkshop') }}" method="POST">
                                                    @csrf
                                                    <td>
                                                        <input type="hidden" name="oid" value="{{ $order->id ?? '' }}" />
                                                        <select style="width:200px;" class="form-select" name='wid' required>
                                                            <option selected disabled value="">--Select Workshop--</option>
                                                            @foreach ($workshops as $shop)
                                                                <option {{ !isset($order) ? '': ($order->assigned_workshop == $shop->id ? 'selected' : '') }} value="{{$shop->id}}">{{$shop->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn-icon btn btn-primary btn-round btn-sm"
                                                         ><i data-feather="check-circle"></i></button>
                                                    </td>
                                                </form>
                                                @endcan
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
    <script>
        $("#allotworkshop").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(),
                success: function(response) {
                    console.log(response);
                    if (response.status == 200)
                    {
                        alert('Assigned');
                        swal("Good job!","Workshop Assigned successfully!", "success");
                        console.log(response.status);
                    } else
                    {
                        swal("Snap!", "Server Error", "error");
                        console.log(response.status);
                    }
                }
            });
        });

    </script>
@endsection
