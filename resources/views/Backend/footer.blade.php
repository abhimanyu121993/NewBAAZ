@extends('layouts.backEnd.adminLayout')

@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('Content-Area')
    <div class="card">
        {{-- {{$footerer}} --}}
        <div class="card-header">
            <h3>Footer</h3>
        </div>
        <div class="card-body">
            <form class="needs-validation" action="{{ route('Backendfooter.store') }}" method='post'
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="flag">Select Type</label>

                        <select class="select2 form-select" id="flag" name='flag' required>
                            <option value="" selected disable>--Select Footer Type--</option>
                            <option value="right">Right</option>
                            <option value="middle">Middle</option>
                            <option value="left">Left</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-1" id="title">
                        <label class="form-label" for="title">File</label>
                        <input type="file" name='file' class="form-control " placeholder="File" value=""
                            aria-label="title" aria-describedby="title" />
                    </div>
                </div>
                <div id="desc" class="col-md-6 mb-2">
                    <label class="form-label" for="shoplink">Description</label></label>

                    <textarea id="desc" name="desc" class="form-control" placeholder="Short Description" value=""
                        aria-label="desc" aria-describedby="desc" rows="5" cols="10">
                    </textarea>
                </div>
                <div class="col-md-6 mb-1" id="fblink">
                    <label class="form-label" for="pic">Links</label>

                    <input type="text" name='fb' class="form-control " placeholder="Facebook Link">
                </div>

                <div class="col-md-6 mb-1" id="twlink">
                    <label class="form-label" for="pic2">Twiter Links</label>
                    <input type="text" name='twit' class="form-control " placeholder="Twiter Link" aria-label="pic2"
                        aria-describedby="pic2" />
                    {{-- <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">.</div> --}}
                </div>
                <div id="ldnlink" class="col-md-6 mb-1">
                    <label class="form-label" for="desc">Linkdine Links</label>
                    <input type="text" name='linkd' class="form-control " placeholder="Linkdine Link" aria-label="pic2"
                        aria-describedby="pic2" />
                </div>

                <div class="col-md-6 mb-1" id="instalink">
                    <label class="form-label" for="pic2">instagram Links</label>
                    <input type="text" name='insta' class="form-control " placeholder="Instagram Link"
                        aria-label="pic2" aria-describedby="pic2" />
                    {{-- <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">.</div> --}}
                </div>
                <div class="col-md-6 mb-1" id="ytlink">
                    <label class="form-label" for="pic2">Youtube Links</label>
                    <input type="text" name='print' class="form-control " placeholder="Youtube Link" aria-label="pic2"
                        aria-describedby="pic2" />
                    {{-- <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">.</div> --}}
                </div>
                <div class="col-md-6 mb-1" id="supportemail">
                    <label class="form-label" for="pic2">Support</label>
                    <input type="text" name='support' class="form-control " placeholder="Contact for support"
                        aria-label="pic2" aria-describedby="pic2" />
                    {{-- <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">.</div> --}}
                </div>
                <div class="col-md-6 mb-1" id="supportnum">
                    <label class="form-label" for="pic2">Contact number</label>
                    <input type="text" name='number' class="form-control " placeholder="Add number"
                        aria-label="pic2" aria-describedby="pic2" />
                    {{-- <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">.</div> --}}
                </div>
                <div class="col-md-6 mb-1" id="address">
                    <label class="form-label" for="pic2">Location</label>
                    <input type="text" name='location' class="form-control " placeholder="Add Location"
                        aria-label="pic2" aria-describedby="pic2" />
                    {{-- <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">.</div> --}}
                </div>
                <div class="col-md-6 mb-1" id="quicklink">
                    <label class="form-label" for="pic2">Quick Link</label>
                    <input type="text" name='quick' class="form-control " placeholder="Quick Link"
                        aria-label="pic2" aria-describedby="pic2" />
                    {{-- <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">.</div> --}}
                </div>
                <div class="col-md-6 mb-1" id="account">
                    <label class="form-label" for="pic2">My Account</label>
                    <input type="text" name='myact' class="form-control " placeholder="My Account"
                        aria-label="pic2" aria-describedby="pic2" />
                    {{-- <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">.</div> --}}
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Add
                            New</button>
                    </div>

                    {{-- <div class="col-sm-6">
                        <img src="{{asset('upload/banner/')}}" class="bg-light-info" alt="" style="height:100px;width:100px;">
                    </div> --}}

                </div>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Footer Data</h3>
            </h3>
        </div>
        <div class="card-body">
            <table class="datatables-basic table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>file</th>
                        <th>Description</th>
                        <th>Facebook link</th>
                        <th>Twiter Link</th>
                        <th>Instagram link</th>
                        <th>You tube link</th>
                        <th>Support</th>
                        <th>Number</th>
                        <th>Location</th>
                        <th>Link</th>
                        <th>Account</th>
                        <th>More Options</th>
                    </tr>

                </thead>
                <tbody>
                    @if ($footer)
                        @foreach ($footer as $foot)
                            @php $i=1;@endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <img src="{{ asset('upload/footer/' . isset($foot->file) ? $foot->file : '') }}"
                                        class="me-75 bg-light-danger" style="height:35px;width:35px;" />
                                </td>
                                <td>{{ $foot->desc }}</td>
                                <td>{{ $foot->fb }}</td>
                                <td>{{ $foot->twit }}</td>
                                <td>{{ $foot->insta }}</td>
                                <td>{{ $foot->print }}</td>
                                <td>{{ $foot->support }}</td>
                                <td>{{ $foot->number }}</td>
                                <td>{{ $foot->location }}</td>
                                <td>{{ $foot->quick }}</td>
                                <td>{{ $foot->myact }}</td>

                                <td>
                                    <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                        <div class="mb-1 breadcrumb-right">
                                            <div class="dropdown">
                                                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i data-feather="grid"></i></button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @php $fid=Crypt::encrypt($foot->id); @endphp
                                                    <form
                                                        action="{{ isset($foot) ? route('Backendfooter.update', $fid) : route('Backendfooter.create') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @if (isset($foot))
                                                            @method('PATCH')
                                                        @endif
                                                        <a class="dropdown-item"
                                                            href="{{ route('Backendfooter.edit', $fid) }}"><i
                                                                class="me-1" data-feather="check-square"></i><span
                                                                class="align-middle">Edit</span></a>
                                                        <a class="dropdown-item" href=""
                                                            onclick="event.preventDefault();document.getElementById('delete-form-{{ $fid }}').submit();"><i
                                                                class="me-1" data-feather="message-square"></i><span
                                                                class="align-middle">Delete</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </form>
                            <form id="delete-form-{{ $fid }}" action="{{ route('Backendfooter.destroy', $fid) }}"
                                method="post" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('Script-Area')
    <script>
        $(document).ready(function() {
            $("#flag").change(function() {
                $('#title').hide();
                $('#desc').hide();
                $('#fblink').hide();
                $('#twlink').hide();
                $('#ldnlink').hide();
                $('#instalink').hide();
                $('#ytlink').hide();
                $('#supportemail').hide();
                $('#supportnum').hide();
                $('#address').hide();
                $('#quicklink').hide();
                $('#account').hide();
                $(this).find("option:selected").each(function() {
                    var optionValue = $(this).attr("value");
                    // alert(optionValue);
                    if (optionValue == 'right') {
                        $('#title').show();
                        $('#desc').show();
                        $('#fblink').show();
                        $('#twlink').show();
                        $('#ldnlink').show();
                        $('#instalink').show();
                        $('#ytlink').show();
                    } else if (optionValue == 'middle') {
                        $('#supportemail').show();
                        $('#supportnum').show();
                        $('#address').show();
                    } else if (optionValue == 'left') {
                        $('#quicklink').show();
                        $('#account').show();
                    }
                });
            }).change();
        });
    </script>

    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/scripts/tables/table-datatables-advanced.js') }}"></script>
@endsection
