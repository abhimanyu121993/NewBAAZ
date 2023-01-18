


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
