@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

@section('Content-Area')
    @can('Footer_slider_create')
        <div class="card">
            <div class="card-header">
                <h3>
                    @if (!isset($footerslideredit))
                        Add New Footer Slider
                    @else
                        Edit Footer Slider
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form class="needs-validation"
                    action="{{ isset($footerslideredit) ? route('Backend.slider.update', $footerslideredit->id) : route('Backend.slider.store') }}"
                    method='post' enctype="multipart/form-data">
                    @if (isset($footerslideredit))
                        @method('patch')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="desc">Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ isset($footerslideredit) ? $footerslideredit->title : '' }}">
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
                                class="btn btn-primary waves-effect waves-float waves-light">{{ isset($footerslideredit) ? 'Update' : 'Add' }}</button>
                        </div>
                        @if (isset($footerslideredit))
                            <div class="col-sm-6">
                                <img src="{{ asset($footerslideredit->image) }}" class="bg-light-info" alt=""
                                    style="height:100px;width:200px;">
                            </div>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    @endcan

    @can('Footer_slider_read')
        <div class="card">
            <div class="card-header">
                <h3>Manage Footer Sliders</h3>
            </div>
            <div class="card-body">
                <table class="display nowrap" id="Footerslider" style="width:100% !important;">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Image</th>
                            <th>Title</th>
                            @canany(['Footer_slider_edit', 'Footer_slider_delete'])
                                <th>Action</th>
                            @endcan
                        </tr>

                    </thead>
                    <tbody>
                        @php $i=1;@endphp
                        @foreach ($footersliders as $footersliders)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <img src="{{ asset($footersliders->image) }}" class="me-75 bg-light-danger"
                                        style="height:60px;width:150px;" />
                                </td>
                                <td>{{ $footersliders->title ?? '' }}</td>
                                @canany(['Footer_slider_edit', 'Footer_slider_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $sid=Crypt::encrypt($footersliders->id); @endphp
                                                        @can('Footer_slider_edit')
                                                            <a class="dropdown-item" href="{{ route('Backend.slider.edit', $sid) }}"><i
                                                                    class="me-1" data-feather="check-square"></i><span
                                                                    class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan
                                                        @can('Footer_slider_delete')
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
                            @can('Footer_slider_delete')
                                <form id="delete-form-{{ $sid }}" action="{{ route('Backend.slider.destroy', $sid) }}"
                                    method="post" style="display: none;">
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
    <script>
        $(document).ready(function() {
            $('#Footerslider').DataTable({
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
