<!-- BEGIN: Vendor JS-->
<script src="{{asset('Backend/assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('Backend/assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('Backend/assets/vendors/js/extensions/toastr.min.js')}}"></script>
<!-- END: Page Vendor JS-->

   <!-- BEGIN: Theme JS-->
   <script src="{{asset('Backend/assets/js/core/app-menu.js')}}"></script>
   <script src="{{asset('Backend/assets/js/core/app.js')}}"></script>
   <script src="{{asset('Backend/assets/js/scripts/components.js')}}"></script>
   <!-- END: Theme JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('Backend/assets/js/core/app-menu.min.js')}}"></script>
<script src="{{asset('Backend/assets/js/core/app.min.js')}}"></script>
<script src="{{asset('Backend/assets/js/scripts/customizer.min.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('Backend/assets/js/scripts/pages/dashboard-ecommerce.min.js')}}"></script>
<!-- END: Page JS-->
<script src="{{asset('Backend/assets/vendors/js/file-uploaders/dropzone.min.js')}}"></script>
<script src="{{asset('Backend/assets/js/scripts/forms/form-file-uploader.js')}}"></script>


<!--Toaster Js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<!--Sweet alert-->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
    });

</script>
