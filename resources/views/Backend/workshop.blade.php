@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($editworkshop))
                    Add New Worksop
                @else
                    Edit Workshop Details
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($editworkshop) ? route('Backend.workshop.update', $editworkshop->id) : route('Backend.workshop.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($editworkshop))
                    @method('patch')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Workshop Name</label>

                        <input type="text" id="basic-addon-name" name='name' class="form-control"
                            value="{{ isset($editworkshop) ? $editworkshop->name : '' }}" placeholder="Enter workshop name"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Phone</label>

                        <input type="number" id="basic-addon-name" name='phone' class="form-control"
                            value="{{ isset($editworkshop) ? $editworkshop->phone : '' }}" placeholder="Enter Phone number"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Email</label>

                        <input type="text" id="basic-addon-name" name='email' class="form-control"
                            value="{{ isset($editworkshop) ? $editworkshop->email : '' }}" placeholder="Enter email"
                            aria-label="email" aria-describedby="basic-addon-name" required />
                    </div>
                    @if (!isset($editworkshop))
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Password</label>
                        <input type="text" id="basic-addon-name" name='password' class="form-control"
                            value="{{ isset($editworkshop) ? $editworkshop->password : '' }}" placeholder="Enter password"
                            aria-label="password" aria-describedby="basic-addon-name" required />
                    </div>
                    @endif
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Owner Name</label>

                        <input type="text" id="basic-addon-name" name='owner_name' class="form-control"
                            value="{{ isset($editworkshop) ? $editworkshop->owner_name : '' }}" placeholder="Enter owner name"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">GST</label>

                        <input type="number" id="basic-addon-name" name='gst' class="form-control"
                            value="{{ isset($editworkshop) ? $editworkshop->gst : '' }}" placeholder="Enter GST No"
                            aria-label="gst" aria-describedby="basic-addon-name" required />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Image Thumbnail</label>
                        <input type="file" name='pic' id="pic" class="form-control " aria-label="pic"
                            aria-describedby="pic" />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="gstpic">Upload GST</label>
                        <input type="file" name='gstpic' id="gstpic" class="form-control " aria-label="gstpic"
                            aria-describedby="gstpic" />
                    </div>
                </div>
                @if (isset($editworkshop))
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <img src="{{asset($editworkshop->pic) }}" class="bg-light-info" alt="" style="height:100px;width:100px;">
                        </div>
                        <div class="col-sm-4">
                            <img src="{{asset($editworkshop->gstpic) }}" class="bg-light-info" alt="" style="height:100px;width:100px;">
                        </div>
                    </div>
                    @endif
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editworkshop) ? 'Update' : 'Add' }}</button>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Manage Workshops</h3>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Workshop Image</th>
                        <th>Workshop GST</th>
                        <th>Owner Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>GST</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($workshops as $workshop)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $workshop->name }}</td>
                            <td>
                                <img src="{{ asset( $workshop->pic) }}" class="me-75 bg-light-danger"
                                    style="height:60px;width:60px;" />
                            </td>
                            <td>
                                <img src="{{ asset( $workshop->gstpic) }}" class="me-75 bg-light-danger"
                                    style="height:60px;width:60px;" />
                            </td>
                            <td>{{ $workshop->owner_name }}</td>
                            <td>{{ $workshop->phone }}</td>
                            <td>{{ $workshop->email }}</td>
                            <td>{{ $workshop->gst }}</td>
                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @php $eid=Crypt::encrypt($workshop->id); @endphp
                                                <a class="dropdown-item" href="{{ route('Backend.workshop.edit', $eid) }}"><i
                                                        class="me-1" data-feather="check-square"></i><span
                                                        class="align-middle">Edit</span></a>
                                                        <a class="dropdown-item" href=""
                                                        onclick="event.preventDefault();document.getElementById('delete-form-{{ $eid }}').submit();"><i
                                                            class="me-1" data-feather="message-square"></i><span
                                                            class="align-middle">Delete</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <form id="delete-form-{{ $eid }}" action="{{ route('Backend.workshop.destroy', $eid) }}"
                            method="post" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endforeach

                </tbody>
            </table>
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
@endsection
