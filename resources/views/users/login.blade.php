@extends('layout-landing-site.master')
@section('body')

<body class="login-page">
    @endsection
    @section('content')
    <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url(../assets/img/login.jpg)"></div>
        <div class="content-center">
            <div class="container">
                <div class="col-md-4 content-center">
                    <div class="card card-login card-plain">
                        <form class="form" method="" action="">
                            <div class="card-header text-center">
                                <div class="logo-container">
                                    <img src="../assets/img/now-logo.png" alt="">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="input-group form-group-no-border input-lg">
                                    <span class="input-group-addon">
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Họ tên...">
                                </div>
                                <div class="input-group form-group-no-border input-lg">
                                    <span class="input-group-addon">
                                        <i class="now-ui-icons text_caps-small"></i>
                                    </span>
                                    <input type="password" placeholder="Mật khẩu..." class="form-control">
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#pablo" class="btn btn-primary btn-round btn-lg btn-block">Đăng nhập</a>
                            </div>
                            <div class="pull-center">
                                <h6>
                                    <a href="#pablo" class="link footer-link">Đăng ký</a>
                                </h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
