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
@canany('Customer_list_read')
    <div class="card">
        <div class="card-header">
            <h3>Manage Customers</h3>
        </div>
        <div class="card-body">
            <table class="dt-column-search table datatable table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Pic</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Email</th>
                        <th>Phone</th>
                        @canany(['Customer_list_edit', 'Customer_list_delete'])
                            <th>Action</th>
                        @endcan

                    </tr>

                </thead>
                <tbody>
                    @if ($customers)
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ asset('Backend/assets/images/dummy-profile.png') }}"
                                        class="me-75 bg-light-danger" style="height:35px;width:35px;" /></td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->dob }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->mobileno }}</td>
                                @canany(['Customer_list_edit', 'Customer_list_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $uid=Crypt::encrypt($customer->id); @endphp
                                                        @can('Customer_list_edit')
                                                            <a class="dropdown-item" href="#"><i class="me-1"
                                                                    data-feather="edit"></i><span class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan

                                                        @can('Customer_list_delete')
                                                            <a class="dropdown-item" href="#"
                                                                onclick="event.preventDefault();
                                                    document.getElementById('delete-form-{{ $uid }}').submit();"><i
                                                                    class="me-1" data-feather="trash-2"></i><span
                                                                    class="align-middle">Delete</span>
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                            @can('Customer_list_delete')
                                <form id="delete-form-{{ $uid }}" action="#" method="post"
                                    style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            @endcan
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            {!! $customers->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endcan
@endsection

@section('Script-Area')
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/scripts/tables/table-datatables-advanced.js') }}"></script>
@endsection
