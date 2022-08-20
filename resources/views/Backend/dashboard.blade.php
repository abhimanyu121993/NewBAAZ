@extends('layouts.adminLayout')
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/pages/dashboard-analytics.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/pages/card-analytics.css') }}">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/charts/apexcharts.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('Backend/assets/vendors/css/extensions/tether-theme-arrows.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/vendors/css/extensions/tether.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('Backend/assets/vendors/css/extensions/shepherd-theme-default.css') }}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/bootstrap-extended.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/colors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/components.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/themes/dark-layout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/themes/semi-dark-layout.css') }}">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/core/menu/menu-types/vertical-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/core/colors/palette-gradient.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/plugins/tour/tour.css') }}">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/css/style.css') }}">
<!-- END: Custom CSS-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('Content-Area')
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-users fa-2x text-primary" aria-hidden="true"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1 mb-25">{{ $user }}  </h2>
                        <p class="mb-0">Users</p>
                    </div>
                    <div class="card-content">
                        <div id="subscribe-gain-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-warning p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-snowflake-o fa-2x text-info" aria-hidden="true"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1 mb-25"> {{ $brand }} </h2>
                        <p class="mb-0">Brands</p>
                    </div>
                    <div class="card-content">
                        <div id="orders-received-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-modx fa-2x text-success" aria-hidden="true"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1 mb-25"> {{ $model }} </h2>
                        <p class="mb-0">Models</p>
                    </div>
                    <div class="card-content">
                        <div id="subscribe-gain-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-warning p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-pie-chart fa-2x text-danger" aria-hidden="true"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1 mb-25"> {{ $order }}</h2>
                        <p class="mb-0">Orders Received</p>
                    </div>
                    <div class="card-content">
                        <div id="orders-received-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('Backend/assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
@endsection
