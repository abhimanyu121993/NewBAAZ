@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

@section('Content-Area')
    @can('Home_slider_create')
        <div class="card">
            <div class="card-header">
                <h3>
                    @if (!isset($slideredit))
                        Add New Slider
                    @else
                        Edit Slider
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form class="needs-validation"
                    action="{{ isset($slideredit) ? route('Backend.homeslider.update', $slideredit->id) : route('Backend.homeslider.store') }}"
                    method='post' enctype="multipart/form-data">
                    @if (isset($slideredit))
                        @method('patch')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="desc">Category Name</label>
                            <select class="select2 form-select" id="select2-basic" name='category_id' required>
                                <option selected disabled value="">--Select Category--</option>
                                @foreach ($categories as $category)
                                    <option
                                        {{ !isset($slideredit) ? '' : ($slideredit->category_id == $category->id ? 'selected' : '') }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="pic">Image Thumbnail</label>
                            <input type="file" name='pic' id="pic" class="form-control " aria-label="pic"
                                aria-describedby="pic" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit"
                                class="btn btn-primary waves-effect waves-float waves-light">{{ isset($slideredit) ? 'Update' : 'Add' }}</button>
                        </div>
                        @if (isset($slideredit))
                            <div class="col-sm-6">
                                <img src="{{ asset($slideredit->image) }}" class="bg-light-info" alt=""
                                    style="height:100px;width:200px;">
                            </div>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    @endcan

    @can('Home_slider_read')
        <div class="card">
            <div class="card-header">
                <h3>Manage Sliders</h3>
            </div>
            <div class="card-body">
                <table class="display nowrap" id="slider" style="width:100% !important;">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Image</th>
                            <th>Category Name</th>
                            @canany(['Home_slider_edit', 'Home_slider_delete'])
                                <th>Action</th>
                            @endcan
                        </tr>

                    </thead>
                    <tbody>
                        @php $i=1;@endphp
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <img src="{{ asset($slider->image) }}" class="me-75 bg-light-danger"
                                        style="height:60px;width:150px;" />
                                </td>
                                <td>{{ $slider->category->name ?? '' }}</td>
                                @canany(['Home_slider_edit', 'Home_slider_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $sid=Crypt::encrypt($slider->id); @endphp
                                                        @can('Home_slider_edit')
                                                            <a class="dropdown-item"
                                                                href="{{ route('Backend.homeslider.edit', $sid) }}"><i class="me-1"
                                                                    data-feather="check-square"></i><span
                                                                    class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan
                                                        @can('Home_slider_delete')
                                                            <a class="dropdown-item" href=""
                                                                onclick="event.preventDefault();document.getElementById('delete-form-{{ $sid }}').submit();"><i
                                                                    class="me-1" data-feather="message-square"></i><span
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
                            @can('Home_slider_delete')
                                <form id="delete-form-{{ $sid }}"
                                    action="{{ route('Backend.homeslider.destroy', $sid) }}" method="post" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            @endcan
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endcan
@endsection


@section('Script-Area')
    {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
    {{-- <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $('#slider').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 2]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 2]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>
@endsection
