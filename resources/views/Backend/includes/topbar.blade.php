@role('Superadmin')
@php $rolecolor='#78244C'; @endphp
@elserole('Country Admin')
@php $rolecolor='#A64AC9'; @endphp
@elserole('Zonal Head')
@php $rolecolor='#29648A'; @endphp
@elserole('Area Head')
@php $rolecolor='#C2ABE2'; @endphp
@elserole('City Head')
@php $rolecolor='#5CDB95'; @endphp
@elserole('RM')
@php $rolecolor='#950740';@endphp
@elserole('Workshop')
@php $rolecolor='#832858';@endphp
@else
@php $rolecolor='#157DEC';@endphp
@endrole

<nav
    class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content" style="background-color: @php echo $rolecolor @endphp;">

        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag"
                    href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="flag-icon flag-icon-us"></i><span class="selected-language" style="color: whitesmoke;">English</span></a>

            </li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                        data-feather="moon" ></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
                        data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Search Baaz services " tabindex="-1"
                        data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>

            <li class="nav-item dropdown dropdown-notification me-25" ><a style="color: whitesmoke;" class="nav-link" href="#"
                    data-bs-toggle="dropdown" ><i class="ficon" data-feather="bell" feather feather-moon ficon></i><span
                        class="badge rounded-pill bg-danger badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header" >
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto" >Notifications</h4>
                            <div class="badge rounded-pill badge-light-primary">2 New</div>
                        </div>
                    </li>

                    <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Read all
                            notifications</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" style="color: whitesmoke;">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ Auth::user()->name ?? 'Baaz' }}</span>
                        <span class="user-status">{{ Auth::user()->roles[0]->name ?? 'User' }}</span>
                    </div>
                    <span class="avatar">
                        <img class="round" alt="avatar" height="40" width="40" src="{{ asset(Auth::user()->pic) }}">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user"><a class="dropdown-item"
                        href="#"><i class="me-50" data-feather="user"></i> Profile</a><a
                        class="dropdown-item" href="#"><i class="me-50" data-feather="mail"></i> Inbox</a><a
                        class="dropdown-item" href="app-todo.html"><i class="me-50"
                            data-feather="check-square"></i> Task</a><a class="dropdown-item" href="#"><i
                            class="me-50" data-feather="message-square"></i> Chats</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="me-50"
                            data-feather="settings"></i> Settings</a>
                    <form method="POST" action='{{ route('Backend.logout') }}' id="my_form">
                        @csrf
                        <a class="dropdown-item" onclick="document.getElementById('my_form').submit();"><i
                                class="me-50" data-feather="power"></i> Logout</a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
