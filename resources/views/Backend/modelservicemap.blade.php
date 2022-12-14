@extends('layouts.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Backend/assets/vendors/css/tables/datatable/datatables.min.css') }}">
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
                        <input type="hidden" value="{{ $model_id }}" name="model_id" />
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="desc">Service Name</label>
                            <select class="select2 form-select" id="select2-basic" name='service_id' required>

                                <option selected disabled value="">--Select Service--</option>
                                @foreach ($services as $service)
                                    <option
                                        {{ !isset($editmodelmap) ? '' : ($editmodelmap->service->id == $service->id ? 'selected' : '') }}
                                        value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="desc">Fuel Type</label>
                            <select class="form-select" id="select2-basic" name='fuel_id' required>

                                <option selected disabled value="">--Select Type--</option>
                                @foreach ($fueltypes as $fuel)
                                    <option
                                        {{ !isset($editmodelmap) ? '' : ($editmodelmap->fuel_type->id == $fuel->id ? 'selected' : '') }}
                                        value="{{ $fuel->id ?? '' }}">{{ $fuel->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="basic-addon-name">Price</label>

                            <input type="number" name='price' class="form-control"
                                value="{{ isset($editmodelmap) ? $editmodelmap->price : '' }}" placeholder="Price"
                                aria-label="Name" aria-describedby="basic-addon-name" required />
                        </div>


                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="basic-addon-name">Percentage</label>
                            <input type="number" max="100" name='percent' class="form-control"
                                value="{{ isset($editmodelmap) ? $editmodelmap->percent : '' }}" placeholder="Percentage"
                                aria-label="Name" aria-describedby="basic-addon-name" required />
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="basic-addon-name">Discount Price</label>

                            <input type="number" id="discounted_price" name='discounted_price' class="form-control"
                                value="{{ isset($editmodelmap) ? $editmodelmap->discounted_price : '' }}"
                                placeholder="Discounted Price" aria-label="Name" aria-describedby="basic-addon-name" required />
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


        <!-- Button trigger modal -->
        <!-- Modal -->
    @endcan

    @can('Model_map_read')
        <!-- Zero configuration table -->
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manage Model Map</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">

                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Model Name</th>
                                                <th>Service Name</th>
                                                <th>Fuel Type</th>
                                                <th>Price</th>
                                                <th>Discounted Price </th>
                                                <th>Percentage</th>
                                                @canany(['Model_map_edit', 'Model_map_delete'])
                                                    <th>Action</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($modelmaps)
                                                @foreach ($modelmaps as $mm)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $mm->model->name ?? '' }}</td>
                                                        <td>{{ $mm->service->name ?? '' }}</td>
                                                        <td>{{ $mm->fuel_type->name ?? '' }}</td>
                                                        <td>{{ $mm->price ?? '' }}</td>
                                                        <td>{{ $mm->discounted_price ?? '' }}</td>
                                                        <td>{{ $mm->percent ?? '' }}%</td>


                                                        @canany(['Model_map_edit', 'Model_map_delete'])
                                                            <td>
                                                                <div
                                                                    class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                                                    <div class="mb-1 breadcrumb-right">
                                                                        <div class="dropdown">
                                                                            <button
                                                                                class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                                                type="button" data-bs-toggle="dropdown"
                                                                                aria-haspopup="true" aria-expanded="false"><i
                                                                                    data-feather="grid"></i></button>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                @php $cid=Crypt::encrypt($mm->id); @endphp
                                                                                @can('Model_map_edit')
                                                                                    {{-- <a class="dropdown-item"
                                                                                        href="{{ route('Backend.modelservicemap.edit', $cid) }}"><i
                                                                                            class="me-1"
                                                                                            data-feather="check-square"></i><span
                                                                                            class="align-middle">Edit</span>
                                                                                    </a> --}}
                                                                                    <a class="dropdown-item"
                                                                                        data-id="{{ $cid }}" id="EditmodelBtn"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#exampleModal">
                                                                                        <i class="me-1" data-feather="edit"></i>
                                                                                        Edit
                                                                                    </a>
                                                                                @endcan
                                                                                @can('Model_map_delete')
                                                                                    <a class="dropdown-item" href=""
                                                                                        onclick="event.preventDefault();document.getElementById('delete-form-{{ $cid }}').submit();">
                                                                                        <i class="me-1"
                                                                                            data-feather="trash-2"></i><span
                                                                                            class="align-middle">Delete</span>
                                                                                    </a>
                                                                                    <form id="delete-form-{{ $cid }}"
                                                                                        action="{{ route('Backend.modelservicemap.destroy', $cid) }}"
                                                                                        method="post" style="display: none;">
                                                                                        @method('DELETE')
                                                                                        @csrf
                                                                                    </form>
                                                                                @endcan
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endcan
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="100%" class="text-center">Model map not available for this
                                                        model</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Zero configuration table -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $mm->service->name ?? '' }}</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="Car_Edit_Modal">
                        <form class="needs-validation" method='Post' id="update_model">
                            @csrf
                            <input type="hidden" id="edit_model_id">


                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="form-label" for="basic-addon-name">Price</label>

                                    <input type="number" name='price' id="Price" class="form-control"
                                        placeholder="Name" aria-label="Name" required />
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label" for="basic-addon-name">Percentage</label>

                                    <input type="number" name='percent' id="Percent" class="form-control"
                                        placeholder="Name" aria-label="Name" required />
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label" for="body">Discount Price</label>
                                    <input type="number" name='discounted_price' id="Discounted_price" class="form-control"
                                        required />
                                </div>
                            </div>
                            <div class="modal-body" id="Car_Edit_Modal">
                                <form class="needs-validation" method='Post' id="update_model">
                                    @csrf
                                    <input type="hidden" id="edit_model_id">

                                    <div class="row">
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="basic-addon-name">Price</label>

                                            <input type="number" name='price' id="Price" class="form-control"
                                                placeholder="Price" aria-label="Name" required />
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="basic-addon-name">Percentage</label>

                                            <input type="number" name='percent' id="Percent" class="form-control"
                                                placeholder="Percentage" aria-label="Name" required />
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="body">Discount Price</label>
                                            <input type="number" name='discounted_price' id="Discounted_price"
                                                placeholder="Discounted Price"class="form-control" required />
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-1 text-center">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    id="editmodelBtn">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
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
        {{-- <script src="{{asset('BackEnd/assets/vendors/js/forms/select/select2.full.min.js')}}"></script> --}}
        <script src="{{ asset('Backend/assets/js/scripts/forms/form-select2.js') }}"></script>


        {{-- <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/scripts/datatables/datatable.js') }}"></script> --}}


        <script>
            const priceInput = document.getElementById('Price');
            const discounted_priceInput = document.getElementById('Discounted_price');
            const percentInput = document.getElementById('Percent');

            priceInput.addEventListener('change', updateValuePrice);
            discounted_priceInput.addEventListener('change', updateValueDiscounted_price);
            percentInput.addEventListener('change', updateValuePercent);

            let price = priceInput.value
            let discounted_price = discounted_priceInput.value
            let percent = 0

            function updateValuePrice(e) {
                price = e.target.value;
                console.log(e.target.value)
            }

            function updateValueDiscounted_price(e) {
                discounted_price = e.target.value;
                console.log(e.target.value)

            }

            function updateValuePercent(e) {
                price = priceInput.value;
                percent = e.target.value;
                discounted_priceInput.value = price - (price * percent / 100);
            }
        </script>

        <script>
            $(document).on("click", "#EditmodelBtn", function(e) {
                e.preventDefault();
                var edit_id = $(this).attr('data-id');
                $("#exampleModal").modal("show");
                $.ajax({
                    type: "GET",
                    url: '/Backend/edit-model/' + edit_id,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 200) {
                            $("#edit_model_id").val(edit_id);
                            $("#Price").val(data.success.price);
                            $("#Percent").val(data.success.percent);
                            $("#Discounted_price").val(data.success.discounted_price);
                            $("#exampleModalLabel").text('Model Name - ' + data.success.model.name);
                        } else if (response.status == 200) {
                            $("#edit_model_id")[0].reset();
                            Command: toastr["success"](response.message)
                        }
                    }
                });
            });
        </script>
        <script>
            $(document).on("submit", "#update_model", function(e) {
                e.preventDefault();
                let update_model = new FormData($('#update_model')[0]);
                $("#editmodelBtn").text("Please wait...");
                var edit_id = $("#edit_model_id").val();

                $.ajax({
                    type: "POST",
                    url: "/Backend/update-model/" + edit_id,
                    data: update_model,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 400) {
                            var values = '';
                            jQuery.each(response.errors, function(key, value) {
                                values += value + '<br>'
                            });

                            Command: toastr["error"](values)

                            $("#editmodelBtn").text("Car Update Model");
                        } else if (response.status == 200) {
                            $("#update_model")[0].reset();
                            Command: toastr["success"](response.message)
                        }
                        location.reload();

                    }
                });
            });
        </script>
    @endsection
