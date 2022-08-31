@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('BackEnd/assets/vendors/css/forms/select/select2.min.css')}}">
@endsection

@section('Content-Area')
@can('Model_create')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($brandedit))
                    Add New Model
                @else
                    Edit Model
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($modeledit) ? route('Backend.model.update', $modeledit->id) : route('Backend.model.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($modeledit))
                    @method('patch')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Brand Name</label>
                        <select class="select2 form-select" id="select2-basic"  name='bid' required>
                        @if(isset($modeledit))
                              <option value='{{$modeledit->id ?? ''}}'>{{$modeledit->brand->name ?? ''}}</option>
                        @else
                        <option selected disabled value="">--Select Brand--</option>
                        @endif

                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">.</div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Model Name</label>
                        <input type="text" name='mname' class="form-control " value="{{ isset($modeledit) ? $modeledit->name : '' }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Image Thumbnail</label>
                        <input type="file" name='pic' id="pic" class="form-control " aria-label="pic"
                            aria-describedby="pic" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($modeledit) ? 'Edit' : 'Add' }}</button>
                    </div>
                    @if (isset($modeledit))
                        <div class="col-sm-6">
                            <img src="{{ asset($modeledit->image) }}" class="bg-light-info" alt="" style="height:100px;width:200px;">
                        </div>
                    @endif
                </div>

            </form>
        </div>
    </div>
@endcan

@can('Model_read')
    <div class="card">
        <div class="card-header">
            <h3>Manage Models</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Image</th>
                        <th>Model Name</th>
                        @canany(['Model_edit', 'Model_delete'])
                            <th>Action</th>
                        @endcan
                    </tr>

                </thead>
                <tbody>
                    @php $i=1;@endphp
                    @foreach ($models as $md)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <img src="{{ asset($md->image) }}" class="me-75 bg-light-danger"
                                style="height:80px;width:150px;" />
                            </td>
                            <td>{{ $md->name }}</td>
                            @canany(['Model_edit', 'Model_delete'])
                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div>

                                        </div>
                                            @php $mid=Crypt::encrypt($md->id); @endphp
                                            @can('Model_edit')
                                            {{-- <a class="dropdown-item" href="{{ route('Backend.modelservicemap.show', $mid) }}"><i
                                                    class="me-1" data-feather="edit"></i><span
                                                    class="align-middle">Edit</span>
                                            </a> --}}
                                            <a href="{{ route('Backend.modelservicemap.show', $mid) }}" class="btn-icon btn btn-primary btn-round btn-sm"
                                                type="button"><i data-feather="edit"></i></a>
                                            @endcan
                                        {{-- <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @php $mid=Crypt::encrypt($md->id); @endphp
                                                @can('Model_edit')
                                                <a class="dropdown-item" href="{{ route('Backend.modelservicemap.show', $mid) }}"><i
                                                        class="me-1" data-feather="edit"></i><span
                                                        class="align-middle">Edit</span>
                                                </a>
                                                @endcan
                                                @can('Model_delete')
                                                <a class="dropdown-item" href=""
                                                onclick="event.preventDefault();document.getElementById('delete-form-{{ $mid }}').submit();"><i
                                                    class="me-1" data-feather="message-square"></i><span
                                                    class="align-middle">Delete</span>
                                                </a>
                                                @endcan
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </td>
                            @endcan
                        </tr>
                        @can('Model_delete')
                        <form id="delete-form-{{ $mid }}" action="{{ route('Backend.model.destroy', $mid) }}"
                            method="post" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                        @endcan
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $models->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endcan

@endsection


@section('Script-Area')
    {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{asset('BackEnd/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('BackEnd/assets/js/scripts/forms/form-select2.js')}}"></script>
@endsection
