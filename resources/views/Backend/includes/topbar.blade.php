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
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    
                    <a class="dropdown-item"
                        href="{{ route('Backend.authuser.show', Auth::user()->id) }}">
                        <i class="me-50" data-feather="user"></i> Profile
                    </a>
                    <a class="dropdown-item"
                        href="{{ route('Backend.authuser.show', Auth::user()->id) }}">
                        <i class="me-50" data-feather="user"></i> Change Password
                    </a>
                    
                    <form method="POST" action='{{ route('Backend.logout') }}' id="my_form">
                        @csrf
                        <a class="dropdown-item" onclick="document.getElementById('my_form').submit();"><i
                                class="me-50" data-feather="power"></i> Logout
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
