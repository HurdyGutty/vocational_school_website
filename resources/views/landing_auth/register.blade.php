@extends('layout-landing-site.master')
@section('body')

<body class="signup-page">
    @endsection

    @section('content')
    <div class="page-header section-image" style="height: 200px; ">
        <div class="page-header-image" style="background-image:url(../assets/img/bg18.jpg)"></div>
        <div class="content-center" style="height:inherit; max-height: inherit;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-signup">
                            <div class="card-body">
                                <h4 class="card-title text-center">Đăng ký</h4>
                                @if (!empty($createError))
                                <div class="alert alert-danger">
                                    {{$createError}}
                                </div>
                                @endif
                                @if (!empty($createSuccess))
                                <div class="alert alert-success">
                                    {{$createSuccess}}
                                </div>
                                @endif
                                <form class="form" method="POST" action="{{route('app.auth.process_register')}}"
                                    enctype='multipart/form-data'>
                                    <div class="form-row align-items-center">

                                        <div class="input-group col-md-6">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons users_circle-08"></i>
                                            </span>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Họ tên (bắt buộc)">
                                            @if ($errors->has('name'))
                                            <div class="text-danger mt-1">
                                                {{$errors->first('name')}}
                                            </div>
                                            @endif
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
                                            @if ($errors->has('gender'))
                                            <div class="text-danger mt-1">
                                                {{$errors->first('gender')}}
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="datepicker-container col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="now-ui-icons ui-1_calendar-60"></i>
                                                </span>
                                                <input type="text" class="form-control datepicker" name="date_of_birth"
                                                    data-datepicker-color="primary" placeholder="Ngày sinh (bắt buộc)">
                                            </div>
                                            @if ($errors->has('date_of_birth'))
                                            <div class="text-danger mt-1">
                                                {{$errors->first('date_of_birth')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="input-group col-md-6">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons tech_mobile"></i>
                                            </span>
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="Số điện thoại...">
                                            @if ($errors->has('phone'))
                                            <div class="text-danger mt-1">
                                                {{$errors->first('phone')}}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="input-group col-md-12">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons ui-1_email-85"></i>
                                            </span>
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Email (bắt buộc)">
                                        </div>
                                        @if ($errors->has('email'))
                                        <div class="text-danger mt-1">
                                            {{$errors->first('email')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-row">
                                        <div class="input-group col-md-6">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons design-2_ruler-pencil"></i>
                                            </span>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Mật khẩu (bắt buộc)">
                                            @if ($errors->has('password'))
                                            <div class="text-danger mt-1">
                                                {{$errors->first('password')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="input-group col-md-6">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons design-2_ruler-pencil"></i>
                                            </span>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="Lặp lại mật khẩu">
                                            @if ($errors->has('password_confirmation'))
                                            <div class="text-danger mt-1">
                                                {{$errors->first('password_confirmation')}}
                                            </div>
                                            @endif
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
                                                <input type="file" name="image">
                                            </span>
                                            <br>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                data-dismiss="fileinput"><i class="now-ui-icons ui-1_simple-remove"></i>
                                                Remove</a>
                                            @if ($errors->has('image'))
                                            <div class="text-danger mt-1">
                                                {{$errors->first('image')}}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="teacher_role">
                                            <span class="form-check-sign"></span>
                                            Đăng ký làm giảng viên.
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
    <script src="{{asset('js/plugins/jasny-bootstrap.min.js')}}">
    </script>
    @endpush