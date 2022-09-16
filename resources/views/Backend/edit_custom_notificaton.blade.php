@extends('layouts.adminLayout')
@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    @endsection

@section('Content-Area')

    <div class="card">
        <div class="card-header">
            <h3>
                Edit Notification
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action=""
                method='Post' action="{{ url('update_notifation')}}/{{$editnotifi->id}}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Title</label>

                        <input type="text" id="basic-addon-name" name='title' class="form-control"
                            value="{{$editnotifi->title}}" placeholder="Name"
                            aria-label="Name"  required />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="body">Notification Body</label>
                         <input type="text" name='body' id="" class="form-control"  value="{{$editnotifi->body}}" /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <button type="submit"
                        class="btn btn-primary waves-effect waves-float waves-light" id="createCustormBtn">Update Notification</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    {{-- <div class="card">
        <div class="card-header">
            <h3>Custom Notification</h3>
        </div>
        <div class="card-body">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table nowrap scroll-horizontal-vertical">

                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Title</th>
                        <th>Nofication body</th>
                         <th>Action</th>
                    </tr>
                </thead>
                  <tbody>

                        <tr>
                        @php $i=1;@endphp
                            @foreach($notif as $Notif)
                            <td>{{ $i++ }}</td>
                            <td>{{$Notif->title}}</td>
                            <td>{{$Notif->body}}</td> 

                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                     <a class="dropdown-item" href=""><i class="me-1"
                                                        data-feather="edit"></i><span class="align-middle">Edit</span>
                                                    </a> 
                                                   
                                                    <a class="dropdown-item" href="#">
                                                        <i
                                                            class="me-1" data-feather="trash-2"></i><span
                                                            class="align-middle">Delete</span>
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                         @endforeach 
                </tbody>
            </table>
            </div>
         </div>
        </div>
    </div> --}}

@endsection


@section('Script-Area')
    {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



