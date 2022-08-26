@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('Backend/assets/vendors/css/forms/select/select2.min.css')}}">
@endsection

@section('Content-Area')
@can('Model_map_create')
    <div class="card">
        <div class="card-header">
            <h3>
                @if (!isset($editmodelmap))
                    Add New Model Map
                @else
                    Update Model Map
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action="{{ isset($editmodelmap) ? route('Backend.modelservicemap.update', $editmodelmap->id) : route('Backend.modelservicemap.store') }}"
                method='post' enctype="multipart/form-data">
                @if (isset($editmodelmap))
                    @method('patch')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Model Name</label>
                        <select class="select2 form-select" id="select2-basic"  name='model_id' required>

                        <option disabled value="">--Select Model--</option>
                            @foreach ($models as $model)
                                <option {{ !isset($editmodelmap) ? '': ($editmodelmap->model->id == $model->id ? 'selected' : '') }} value="{{$model->id}}">{{$model->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Service Name</label>
                        <select class=" form-select" id="select2-basic"  name='service_id' required>

                        <option disabled value="">--Select Service--</option>
                            @foreach ($services as $service)
                                <option {{ !isset($editmodelmap) ? '': ($editmodelmap->service->id == $service->id ? 'selected' : '') }} value="{{$service->id}}">{{$service->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="desc">Fuel Type</label>
                        <select class="form-select" id="select2-basic"  name='fuel_id' required>

                        <option disabled value="">--Select Type--</option>
                            @foreach ($fueltypes as $fuel)
                                <option {{ !isset($editmodelmap) ? '': ($editmodelmap->fuel_type->id == $fuel->id ? 'selected' : '') }} value="{{$fuel->id}}">{{$fuel->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Price</label>

                        <input type="text" id="basic-addon-name" name='price' class="form-control"
                            value="{{ isset($editmodelmap) ? $editmodelmap->price : '' }}" placeholder="Price"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Discount Price</label>

                        <input type="text" id="basic-addon-name" name='dprice' class="form-control"
                            value="{{ isset($editmodelmap) ? $editmodelmap->discounted_price : '' }}" placeholder="Discounted Price"
                            aria-label="Name" aria-describedby="basic-addon-name" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-float waves-light">{{ isset($editmodelmap) ? 'Update' : 'Add' }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endcan

@can('Model_map_read')
    <div class="card">
        <div class="card-header">
            <h3>Manage Model Map</h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Model Name</th>
                        <th>Service Name</th>
                        <th>Fuel Type</th>
                        <th>Price</th>
                        <th>Discounted Price</th>
                        @canany(['Model_map_edit', 'Model_map_delete'])
                            <th>Action</th>
                        @endcan
                    </tr>

                </thead>
                <tbody>
                    @foreach ($modelmaps as $mm)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $mm->model->name }}</td>
                            <td>{{ $mm->service->name }}</td>
                            <td>{{ $mm->fuel_type->name }}</td>
                            <td>{{ $mm->price }}</td>
                            <td>{{ $mm->discounted_price }}</td>
                            @canany(['Model_map_edit', 'Model_map_delete'])
                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @php $cid=Crypt::encrypt($mm->id); @endphp
                                                @can('Model_map_edit')
                                                <a class="dropdown-item" href="{{ route('Backend.modelservicemap.edit', $cid) }}"><i
                                                        class="me-1" data-feather="check-square"></i><span
                                                        class="align-middle">Edit</span>
                                                </a>
                                                @endcan
                                                @can('Model_map_delete')
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
                        @can('Model_map_delete')
                            <form id="delete-form-{{ $cid }}" action="{{ route('Backend.modelservicemap.destroy', $cid) }}"
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
    {{-- <script src="{{asset('BackEnd/assets/js/scripts/forms/form-validation.js')}}"></script> --}}
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{asset('BackEnd/assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('Backend/assets/js/scripts/forms/form-select2.js')}}"></script>
@endsection
