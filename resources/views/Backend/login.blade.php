@extends('layouts.app')

@section('content')
  <!-- BEGIN: Content-->
  <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-basic px-2">
                <div class="auth-inner my-2">
                    <!-- Login basic -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="index.html" class="brand-logo">
                                <img class="" alt="logo" height="100" width="200" src="{{ asset('upload/bazz_logo.png') }}">
                    {{-- <h2 class="brand-text" style="color: #fca40b;">BAAZ</h2> --}}

                </a>
                            </a>

                            <h4 class="card-title mb-1 text-center">Welcome to Baaz Admin! 👋</h4>

                            <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-1">
                                    <label for="login-email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="login-email" name="email" placeholder="xxx@xx.xx" aria-describedby="login-email" tabindex="1" value="" required autocomplete="email" autofocus />
                                </div>

                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Password</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" required autocomplete="current-password" aria-describedby="login-password" />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember_me" id="remember-me" tabindex="3" />
                                        <label class="form-check-label" for="remember-me">Remember Me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    Login
                                </button>
                                @foreach ($errors->all() as $error)
                               <span class="text-danger text-center">{{ $error }}</span>
                             @endforeach
                            </form>


                        </div>
                    </div>
                    <!-- /Login basic -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
