@extends('layout.master')
@section('body')

<body class="signup-page">
    @endsection

    @section('content')
    <div class="page-header section-image">
        <div class="page-header-image" style="background-image:url(../assets/img/bg18.jpg)"></div>
        <div class="content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-signup">
                            <div class="card-body">
                                <h4 class="card-title text-center">Register</h4>
                                <!-- <div class="social text-center">
                                    <button class="btn btn-icon btn-round btn-twitter">
                                        <i class="fa fa-twitter"></i>
                                    </button>
                                    <button class="btn btn-icon btn-round btn-dribbble">
                                        <i class="fa fa-dribbble"></i>
                                    </button>
                                    <button class="btn btn-icon btn-round btn-facebook">
                                        <i class="fa fa-facebook"> </i>
                                    </button>
                                    <h5 class="card-description"> or be classical </h5>
                                </div> -->
                                <form class="form" method="" action="">
                                    <div class="form-row">

                                        <div class="input-group col-md-6">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons users_circle-08"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="First Name...">
                                        </div>
                                        <div class="input-group col-md-6">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons users_circle-08"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="First Name...">
                                        </div>

                                    </div>
                                    <div class="form-row align-items-center">
                                        <div class="input-group col_auto">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons text_caps-small"></i>
                                            </span>
                                            <input type="text" placeholder="Last Name..." class="form-control">
                                        </div>
                                        <div class="input-group col_auto">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons ui-1_email-85"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Email...">
                                        </div>
                                    </div>
                                    <!-- If you want to add a checkbox to this form, uncomment this code -->
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox">
                                            <span class="form-check-sign"></span>
                                            I agree to the terms and
                                            <a href="#something">conditions</a>.
                                        </label>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#pablo" class="btn btn-primary btn-round btn-lg">Get Started</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection