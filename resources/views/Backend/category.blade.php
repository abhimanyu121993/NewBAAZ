@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

@section('Content-Area')
    @can('Category_create')
        <div class="card">
            <div class="card-header">
                <h3>
                    @if (!isset($brandedit))
                        Add New Category
                    @else
                        Edit Category
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form class="needs-validation"
                    action="{{ isset($categoryedit) ? route('Backend.category.update', $categoryedit->id) : route('Backend.category.store') }}"
                    method='post' enctype="multipart/form-data">
                    @if (isset($categoryedit))
                        @method('patch')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="basic-addon-name">Category Name</label>

                            <input type="text" id="basic-addon-name" name='cname' class="form-control"
                                value="{{ isset($categoryedit) ? $categoryedit->name : '' }}" placeholder="Category Name"
                                aria-label="Name" aria-describedby="basic-addon-name" required />
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
                                class="btn btn-primary waves-effect waves-float waves-light">{{ isset($categoryedit) ? 'Edit' : 'Add' }}</button>
                        </div>
                        @if (isset($categoryedit))
                            <div class="col-sm-6">
                                <img src="{{ asset($categoryedit->image) }}" class="bg-light-info" alt=""
                                    style="height:100px;width:200px;">
                            </div>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    @endcan

    @can('Category_read')
        <div class="card">
            <div class="card-header">
                <h3>Manage Category</h3>
            </div>
            <div class="card-body">
                <table class="display nowrap" id="category" style="width:100% !important;">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Image</th>
                            @canany(['Category_edit', 'Category_delete'])
                                <th>Action</th>
                            @endcan
                        </tr>

                    </thead>
                    <tbody>
                        @php $i=1;@endphp
                        @foreach ($category as $cat)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $cat->name }}</td>
                                <td><img src="{{ asset($cat->image) }}" class="me-75 bg-light-danger"
                                        style="height:60px;width:150px;" />
                                </td>
                                @canany(['Category_edit', 'Category_delete'])
                                    <td>
                                        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                            <div class="mb-1 breadcrumb-right">
                                                <div class="dropdown">
                                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i data-feather="grid"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @php $cid=Crypt::encrypt($cat->id); @endphp
                                                        @can('Category_edit')
                                                            <a class="dropdown-item"
                                                                href="{{ route('Backend.category.edit', $cid) }}"><i class="me-1"
                                                                    data-feather="check-square"></i><span
                                                                    class="align-middle">Edit</span>
                                                            </a>
                                                        @endcan
                                                        @can('Category_delete')
                                                            <a class="dropdown-item" href=""
                                                                onclick="event.preventDefault();document.getElementById('delete-form-{{ $cid }}').submit();"><i
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
                            @can('Category_delete')
                                <form id="delete-form-{{ $cid }}" action="{{ route('Backend.category.destroy', $cid) }}"
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
            $('#category').DataTable({
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
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>
@endsection
