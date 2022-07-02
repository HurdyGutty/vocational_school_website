@extends('layout-admin-site.master-login')
@section('content')

<div class="card">

    <!-- Logo -->
    <div class="card-header pt-4 pb-4 text-center bg-primary">
        <a href="#">
            <span><img src="{{asset('assets/images/logo.png')}}" alt="" height="18"></span>
        </a>
    </div>

    <div class="card-body p-4">

        <div class="text-center w-75 m-auto">
            <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign In</h4>
            <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
        </div>

        <form action="{{route('admin.auth.process_login')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="emailaddress">Email address</label>
                <input name="email" class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input name="password" type="password" id="password" class="form-control" placeholder="Enter your password">
                    <div class="input-group-append" data-password="false">
                        <div class="input-group-text">
                            <span class="password-eye"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                </div>
            </div>

            <div class="form-group mb-0 text-center">
                <button class="btn btn-primary" type="submit"> Log In </button>
            </div>

        </form>
    </div>
</div>
@endsection
