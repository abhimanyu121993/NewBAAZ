@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('BackEnd/assets/vendors/css/forms/select/select2.min.css')}}">
    <style>
        .ck-editor__editable_inline
        {

            min-height:250px;
        }
    </style>
@endsection

@section('Content-Area')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($serviceedit))
                    Add New Service
                @else
                    Edit Service
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($serviceedit) ? route('Backend.service.update', $serviceedit->id) : route('Backend.service.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($serviceedit))
                    @method('patch')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Category Name</label>
                        <select class="select2 form-select" id="select2-basic"  name='cid' required>
                        @if(isset($serviceedit))
                              <option value='{{$serviceedit->id}}'>{{$serviceedit->category->name}}</option>
                        @else
                        <option selected disabled value="">--Select Category--</option>
                        @endif

                            @foreach ($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">.</div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Service Name</label>
                        <input type="text" name='sname' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->name : '' }}" placeholder="Service name" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Service Price</label>
                        <input type="number" name='sprice' class="form-control " value="{{ isset($serviceedit) ? $serviceedit->price : '' }}" placeholder="Service Price" />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="pic">Image Thumbnail</label>
                        <input type="file" name='pic' id="pic" class="form-control " aria-label="pic"
                            aria-describedby="pic" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <label class="form-label" for="pic">Service Description</label>
                        <textarea class='form-control editor' name="desc" id="editor" cols="300" rows="100">
                            {!! $serviceedit->desc??'' !!}
                        </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($serviceedit) ? 'Edit' : 'Add' }}</button>
                    </div>
                    @if (isset($serviceedit))
                        <div class="col-sm-6">
                            <img src="{{ asset($serviceedit->image) }}" class="bg-light-info" alt="" style="height:100px;width:200px;">
                        </div>
                    @endif
                </div>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Manage Services</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Category Name</th>
                        <th>Service Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    @php $i=1;@endphp
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $service->category->name }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->price }}</td>
                            <td>{!! $service->desc !!}</td>
                            <td><img src="{{ asset( $service->image) }}" class="me-75 bg-light-danger"
                                    style="height:60px;width:150px;" /></td>
                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @php $sid=Crypt::encrypt($service->id); @endphp
                                                <a class="dropdown-item" href="{{ route('Backend.service.edit', $sid) }}"><i
                                                        class="me-1" data-feather="check-square"></i><span
                                                        class="align-middle">Edit</span></a>
                                                        <a class="dropdown-item" href=""
                                                        onclick="event.preventDefault();document.getElementById('delete-form-{{ $sid }}').submit();"><i
                                                            class="me-1" data-feather="message-square"></i><span
                                                            class="align-middle">Delete</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <form id="delete-form-{{ $sid }}" action="{{ route('Backend.service.destroy', $sid) }}"
                            method="post" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $services->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection


@section('Script-Area')
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script type="text/javascript">
        ClassicEditor
        .create( document.querySelector( '.editor' ) )
        .catch( error => {
            console.error( error );
        } );

</script>
    {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{asset('BackEnd/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('BackEnd/assets/js/scripts/forms/form-select2.js')}}"></script>
@endsection
