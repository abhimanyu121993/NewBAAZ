@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('Backend/assets/vendors/css/forms/select/select2.min.css')}}">
@endsection

@section('Content-Area')
         <!-- permissions start -->
         <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <h6 class="border-bottom py-1 mb-0 font-medium-2">
                        {{ isset($editpermission) ? 'Edit Permission':'Assign Permission' }}
                    </h6>
                </div>
                <div class="card-body">
                    <form class="needs-validation"
                        action="{{ route('Backend.assignPermission') }}"
                        method='post' enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="desc">Role Name</label>
                            <select class="select2 form-select" id="select2-basic"  name='roleid' required>
            
                            <option selected disabled value="">--Select Role--</option>
                            
                                @foreach ($roles as $role)
                                    <option {{ !isset($editrole) ? '': ($editrole->id == $role->id ? 'selected' : '') }} value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-body px-75">
                            <div class="table-responsive users-view-permission">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Module</th>
                                            <th>Menu</th>
                                            <th>Read</th>
                                            <th>Create</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach ($permissions as $per)
                                        <tr>
                                            <td>{{$per->name}}</td>
                                            <td>
                                                <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox2" class="custom-control-input" name="permissionckbx[]" value="{{$per->name}}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name)?'checked':'') }}>
                                                    <label class="custom-control-label" for="users-checkbox2"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox2" class="custom-control-input" name="permissionckbx[]" value="{{$per->name.'_read'}}" {{$per->name}}" {{$per->name}}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name.'_read')?'checked':'') }} ><label class="custom-control-label" for="users-checkbox2"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox3" name="permissionckbx[]" class="custom-control-input" value="{{$per->name.'_create'}}" {{$per->name.'_create'}}" {{$per->name}}" {{$per->name}}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name.'_create')?'checked':'') }}><label class="custom-control-label" for="users-checkbox3"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox1" class="custom-control-input" name="permissionckbx[]" value="{{$per->name.'_edit'}}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name.'_edit')?'checked':'') }}>
                                                    <label class="custom-control-label" for="users-checkbox1"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox1" class="custom-control-input" name="permissionckbx[]" value="{{$per->name.'_delete'}}" {{ !isset($editrole) ? '' : ($editrole->hasPermissionTo($per->name.'_delete')?'checked':'') }}>
                                                    <label class="custom-control-label" for="users-checkbox1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editpermission) ? 'Update' : 'Add' }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- permissions end -->

    {{-- <div class="card">
        <div class="card-header">
            <h3>Manage Permissions</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Assigned To</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $permission->name }}</td>
                            <td class="badge badge-primary">Admin</td>
                            <td>{{ $permission->created_at }}</td>
                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @php $cid=Crypt::encrypt($permission->id); @endphp
                                                <a class="dropdown-item" href="{{ route('Backend.permission.edit', $cid) }}"><i
                                                        class="me-1" data-feather="check-square"></i><span
                                                        class="align-middle">Edit</span></a>
                                                        <a class="dropdown-item" href=""
                                                        onclick="event.preventDefault();document.getElementById('delete-form-{{ $cid }}').submit();"><i
                                                            class="me-1" data-feather="message-square"></i><span
                                                            class="align-middle">Delete</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <form id="delete-form-{{ $cid }}" action="{{ route('Backend.permission.destroy', $cid) }}"
                            method="post" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}

@endsection


@section('Script-Area')
<script src="{{asset('Backend/assets/js/scripts/forms/form-select2.js')}}"></script>
    {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection
