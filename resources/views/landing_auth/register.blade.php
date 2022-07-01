@extends('layout-landing-site.master')
@section('body')

<body class="signup-page" style="min-height: 100%">
    @endsection

    @section('content')
    <div class="page-header section-image" style="height: 1000px">
        <div class="page-header-image" style="background-image:url(../assets/img/bg18.jpg)"></div>
        <div class="content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-signup">
                            <div class="card-body">
                                <h4 class="card-title text-center">Đăng ký</h4>
                                <form class="form" method="" action="">
                                    <div class="form-row align-items-center">

                                        <div class="input-group col-md-6">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons users_circle-08"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Họ tên...">
                                        </div>
                                        <div class="input-group col-md-6">
                                            <div class="form-check form-check-radio">
                                                <label>Giới tính: </label>
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gender_box" value="1" checked="">
                                                    <span class="form-check-sign"></span>
                                                    Nam
                                                </label>
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gender_box" value="0">
                                                    <span class="form-check-sign"></span>
                                                    Nữ
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="datepicker-container col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="now-ui-icons ui-1_calendar-60"></i>
                                                </span>
                                                <input type="text" class="form-control datepicker"
                                                    data-datepicker-color="primary" placeholder="Ngày sinh">
                                            </div>
                                        </div>
                                        <div class="input-group col-md-6">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons tech_mobile"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Số điện thoại...">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="input-group col-md-12">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons ui-1_email-85"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Email...">
                                        </div>
                                    </div>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-circle img-raised">
                                            <img src="{{asset('img/placeholder.jpg')}}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised">
                                        </div>
                                        <div>
                                            <span class="btn btn-raised btn-round btn-default btn-file">
                                                <span class="fileinput-new">Add Photo</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="...">
                                            </span>
                                            <br>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                data-dismiss="fileinput"><i class="now-ui-icons ui-1_simple-remove"></i>
                                                Remove</a>
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
    @push('js')
    <script src="./assets/js/plugins/jasny-bootstrap.min.js">
    </script>
    @endpush