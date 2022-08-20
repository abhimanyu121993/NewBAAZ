{{-- @role('Superadmin')
@php
    echo 'hello';
@endphp
@php $rolecolor='blue'; @endphp
@elserole('Country Admin') 
@php $rolecolor=''; @endphp 
@elserole('Zonal Head') 
@php $rolecolor=''; @endphp 
@elserole('Area Head') 
@php $rolecolor=''; @endphp 
@elserole('City Head') 
@php $rolecolor=''; @endphp 
@elserole('RM') 
@php $rolecolor='';@endphp
@endrole --}}

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow"
    style="background-color: @php  $rolecolor @endphp;" data-scroll-to-active="true">
    <div class="navbar-header" style="background-color: @php  $rolecolor @endphp;">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand p-0" href="#">
                    <img class="" alt="logo" height="40" width="60"
                        src="{{ asset('upload/bazz_logo.png') }}">
                    <h2 class="brand-text" style="color: #fca40b;">BAAZ</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    {{-- <div class="shadow-bottom"></div> --}}
    <div class="main-menu-content" style="background-color: @php  $rolecolor @endphp;">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('Backend.dashboard') }}"><i
                        data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Dashboard</span></a>
            </li>

            @canany(['Brand', 'Model', 'Fuel_type'])
                <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" data-feather="slack" class="feather feather-folder-minus">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                            <line x1="9" y1="14" x2="15" y2="14"></line>
                        </svg><span class="menu-title text-truncate" data-i18n="Invoice">Car</span></a>
                    <ul class="menu-content">
                        @can('Brand')
                            <li>
                                <a class="d-flex align-items-center" href="{{ route('Backend.brand.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">Car Brand</span>
                                </a>
                            </li>
                        @endcan

                        @can('Model')
                            <li><a class="d-flex align-items-center" href="{{ route('Backend.model.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">Car Model</span></a>
                            </li>
                        @endcan

                        @can('Fuel_type')
                            <li><a class="d-flex align-items-center" href="{{ route('Backend.fueltype.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">Car Fuel Type</span></a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @canany(['Category', 'Services'])
                <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-folder-minus">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                            <line x1="9" y1="14" x2="15" y2="14"></line>
                        </svg><span class="menu-title text-truncate" data-i18n="Invoice">Category/Services</span></a>
                    <ul class="menu-content">

                        @can('Category')
                            <li><a class="d-flex align-items-center" href="{{ route('Backend.category.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">Category</span></a>
                            </li>
                        @endcan

                        @can('Services')
                            <li><a class="d-flex align-items-center" href="{{ route('Backend.service.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">Services</span></a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('Customer_list')
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('Backend.customerList') }}"><i
                            data-feather="users"></i><span class="menu-title text-truncate"
                            data-i18n="User List">Customer
                            List</span></a>
                </li>
            @endcan

            @can('Home_slider')
                <li class="nav-item"><a class="d-flex align-items-center"
                        href="{{ route('Backend.homeslider.index') }}"><i data-feather="sliders"></i><span
                            class="menu-title text-truncate" data-i18n="User List">Home Slider</span></a>
                </li>
            @endcan

            @canany(['Pending_orders', 'Confirmed_orders', 'Order_history'])
                <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-folder-minus">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                            <line x1="9" y1="14" x2="15" y2="14"></line>
                        </svg><span class="menu-title text-truncate" data-i18n="Invoice">Orders</span></a>
                    <ul class="menu-content">

                        @can('Pending_orders')
                            <li class="nav-item"><a class="d-flex align-items-center"
                                    href="{{ route('Backend.pendingOrders') }}"><i data-feather="file-text"></i><span
                                        class="menu-title text-truncate" data-i18n="User List">Pending Orders</span></a>
                            </li>
                        @endcan

                        @can('Confirmed_orders')
                            <li class="nav-item"><a class="d-flex align-items-center"
                                    href="{{ route('Backend.confirmedOrders') }}"><i data-feather="file-text"></i><span
                                        class="menu-title text-truncate" data-i18n="User List">Confirmed Orders</span></a>
                            </li>
                        @endcan

                        @can('Order_history')
                            <li class="nav-item"><a class="d-flex align-items-center"
                                    href="{{ route('Backend.orderhistory.index') }}"><i data-feather="file-text"></i><span
                                        class="menu-title text-truncate" data-i18n="User List">Order History</span></a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcanany

            @canany(['Workshop', 'Employee', 'Country', 'Zone', 'Area', 'City'])
                <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-folder-minus">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                            <line x1="9" y1="14" x2="15" y2="14"></line>
                        </svg><span class="menu-title text-truncate" data-i18n="Invoice">Business Setup</span></a>
                    <ul class="menu-content">

                        @can('Workshop')
                            <li class="nav-item"><a class="d-flex align-items-center"
                                    href="{{ route('Backend.workshop.index') }}"><i data-feather="file-text"></i><span
                                        class="menu-title text-truncate" data-i18n="User List">Workshop</span></a>
                            </li>
                        @endcan

                        @can('Employee')
                            <li><a class="d-flex align-items-center" href="{{ route('Backend.authuser.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">Employee</span></a>
                            </li>
                        @endcan

                        @can('Country')
                            <li><a class="d-flex align-items-center" href="{{ route('Backend.country.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">Country</span></a>
                            </li>
                        @endcan

                        @can('Zone')
                            <li><a class="d-flex align-items-center" href="{{ route('Backend.zone.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">Zone</span></a>
                            </li>
                        @endcan

                        @can('Area')
                            <li><a class="d-flex align-items-center" href="{{ route('Backend.area.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">Area</span></a>
                            </li>
                        @endcan

                        @can('City')
                            <li><a class="d-flex align-items-center" href="{{ route('Backend.city.index') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg><span class="menu-item text-truncate" data-i18n="List">City</span></a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcanany

            @can('Role_Permission')
                <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-folder-minus">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                            <line x1="9" y1="14" x2="15" y2="14"></line>
                        </svg><span class="menu-title text-truncate" data-i18n="Invoice">Roles/Permission</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{ route('Backend.role.index') }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg><span class="menu-item text-truncate" data-i18n="List">Roles</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{ route('Backend.permission.index') }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg><span class="menu-item text-truncate" data-i18n="List">Permissions</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{ route('Backend.userPermission') }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg><span class="menu-item text-truncate" data-i18n="List">Assign Permission</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{ route('Backend.roleHasPermission') }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg><span class="menu-item text-truncate" data-i18n="List">Role Has
                                    Permission</span></a>
                        </li>

                    </ul>
                </li>
            @endcan

        </ul>
    </div>
</div>
