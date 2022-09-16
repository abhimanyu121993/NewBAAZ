@extends('layouts.adminLayout')
@section('Head-Area')
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('BackEnd/assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    @endsection

@section('Content-Area')

    <div class="card">
        <div class="card-header">
            <h3>
            </h3>
        </div>
        <div class="card-body">
            <form class="needs-validation"
                action=""
                method='post' enctype="multipart/form-data" id="add_notification">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="basic-addon-name">Title</label>

                        <input type="text" id="basic-addon-name" name='title' class="form-control"
                            value="" placeholder="Name"
                            aria-label="Name"  required />
                    </div>
                    <div class="col-md-6 mb-1">
                        <label class="form-label" for="body">Notification Body</label>
                        <input type="text" name='body' id="" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <button type="submit"
                        class="btn btn-primary waves-effect waves-float waves-light" id="createCustormBtn">Send Notification</button>
                    </div>

                </div>

            </form>
        </div>
    </div>



    <div class="card">
        <div class="card-header">
            <h3>Custom Notification</h3>
        </div>
        <div class="card-body">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table nowrap scroll-horizontal-vertical">

                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Title</th>
                        <th>Notification body</th>
                        <th>Action</th>
                    </tr>
                </thead>
                  <tbody>

                        <tr>
                            @php $i=1;@endphp
                            @foreach($notif as $Notif)
                            <td>{{ $i++ }}</td>
                            <td>{{$Notif->title}}</td>
                            <td>{{$Notif->body}}</td>

                            <td>
                                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                                    <div class="mb-1 breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end">

                                                 

                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" id="EditNotifBtn"  value="{{$Notif->id}}"><i class="me-1"
                                                        data-feather="edit"></i><span class="align-middle">Edit</span>
                                                    </button>


                                                    
                                                     <a  style="margin-left:15px;"
                        href="javascript:void(0)" 
                        id="delete" 
                        data-url="{{ route('Backend.delete', $Notif->id) }}" 
                        class=""
                        ><i class="me-1" data-feather="trash-2"></i>Delete</a>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>


                        </tr>
                        @endforeach
                </tbody>
            </table>
            </div>
         </div>
        </div>
    </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="Custom_Edit_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="needs-validation"
            method='Post' id="update_custom">
            @csrf
            <input type="hidden" id="edit_custom_id">
            <div class="row">
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="basic-addon-name">Title</label>

                    <input type="text"  name='title' id="Title" class="form-control"
                        value="" placeholder="Name"
                        aria-label="Name"  required />
                </div>
                <div class="col-md-6 mb-1">
                    <label class="form-label" for="body">Notification Body</label>
                     <input type="text" name='body' id="Body" class="form-control"  value="" /> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"
                        class="btn btn-primary waves-effect waves-float waves-light" id="editCustormBtn">Update Notification</button>   
                    </div>                  
                </div>
            </div>
        </form>
        </div>
       
      </div>
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
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on("submit", "#add_notification", function(e) {

        e.preventDefault();
        let add_notification = new FormData($('#add_notification')[0]);
        $("#createCustormBtn").text("Please wait...");
        $.ajax({
            type: "POST",
            url: "/Backend/add-notification",
            data: add_notification,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 400) {
                    var values = '';
                    jQuery.each(response.errors, function(key, value) {
                        values += value + '<br>'
                    });
                    Command: toastr["error"](values)

                    $("#createCustormBtn").text("Send Notification");
               
                      } else if
                      (response.status == 200) {
                       $("#add_notification")[0].reset();
                       Command: toastr["success"](response.message) 
                }
                location.reload();
            }
        });
    });
</script>




<script type="text/javascript">
      
    $(document).ready(function () {
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        /*------------------------------------------
        --------------------------------------------
        When click user on Show Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#delete', function () {
  
          var userURL = $(this).data('url');
          var trObj = $(this);
  
          if(confirm("Are you sure you want to remove this user?") == true){
                $.ajax({
                    url: userURL,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        alert(data.success);
                        trObj.parents("tr").remove();
                    }
                });
          }
  
       });
        
    });
    
</script>






<script>
$(document).on("click", "#EditNotifBtn", function(e) {
    e.preventDefault();
    var edit_id = $(this).val();
    $("#Custom_Edit_Modal").modal("show");
    $.ajax({
        type: "GET",
        url: '/Backend/edit-notification/' + edit_id,
        dataType: "json",
        success: function(data) {
           
            if (data.status == 200) {
                $("#edit_custom_id").val(edit_id);
                $("#Title").val(data.success.title);
                $("#Body").val(data.success.body)
            } else if (response.status == 200) {
                       $("#edit_custom_id")[0].reset();
                     Command: toastr["success"](response.message)         
                   } 
        }
    });
});
</script>
<script>
$(document).on("submit", "#update_custom", function(e) {
    e.preventDefault();
    let update_custom = new FormData($('#update_custom')[0]); 
     $("#editCustormBtn").text("Please wait...");
    var edit_id = $("#edit_custom_id").val();
   
    $.ajax({
        type: "POST",
        url: "/Backend/update-notifation/" + edit_id,
        data: update_custom,
        contentType: false,
        processData: false,
        success: function(response) {
                if (response.status == 400) {
                    var values = '';
                    jQuery.each(response.errors, function(key, value) {
                        values += value + '<br>'
                    });
                    alert(edit_id)
                    Command: toastr["error"](values)

                    $("#editCustormBtn").text("Send Notification");
                   } else if (response.status == 200) {
                       $("#update_custom")[0].reset();
                       Command: toastr["success"](response.message)         
                   }  
                   location.reload();
              
            }
        });
});

</script>