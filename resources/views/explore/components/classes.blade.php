<div class="container">
    <div class="title">
        <h3>Các lớp học</h3>
    </div>
    @include('explore.components.alertClassRegister')
    <div class="row">
        @if (empty($classes))
        <h3>Không tìm thấy lớp</h3>
        @endif
        @foreach ($classes as $class)
        <div class="col-md-6 col-lg-4">
            <div class="card card-blog card-plain">
                <div class="card-image">
                    <img class="img rounded img-raised" src="assets/img/project13.jpg">
                </div>
                <div class="card-body">
                    <form class="form" action="{{route('showTeacher', $class->teacher_id)}}" method="POST">
                        <h5 class="category text-warning">
                            <i class="now-ui-icons users_single-02"></i>

                            @csrf
                            <a class="show-account text-warning" href="" data-toggle="modal"
                                data-target="#standard-modal-{{$class->teacher_id}}">
                                Giáo viên: {{$class->teacher_name}}
                            </a>

                        </h5>
                    </form>
                    <div class="modal fade" id="standard-modal-{{$class->teacher_id}}" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center">
                                    <img class="img rounded img-raised"
                                        src="{{'data:image/png;base64,' . $class->image_source}}"
                                        alt="Không thể hiện ảnh">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <h4 class="title title-up">Thông tin giáo viên</h4>
                                </div>
                                <div class="modal-body">
                                    <h4 class="mt-2 mb-0 name text-center">
                                    </h4>
                                    <p class="text-muted font-13 mb-1
                                        mt-0 py-2 info">
                                    </p>
                                    <div class=" font-13 mb-1 mt-0 row">
                                        <p class='text-muted col-6 text-center'>
                                            <span class='classes_count font-weight-bold'></span> lớp
                                        </p>
                                        <p class='text-muted col-6 text-center'>
                                            <span class='students_count font-weight-bold'></span> học sinh
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title">
                        {{$class->classes_name}}
                    </h4>
                    @if (!empty(getAccount()))
                    <a href="{{route('app.user.registerClass',['class' => $class->class_id])}}">
                        <div class="btn-primary btn-round btn-block text-center">Tham gia</div>
                    </a>
                    @else
                    <a href="{{route('app.auth.view_login')}}">
                        <button class="btn btn-primary btn-round btn-block">Đăng nhập</button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>