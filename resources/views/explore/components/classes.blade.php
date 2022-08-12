<div class="container">
    <div class="title">
        <h3>Các lớp học</h3>
    </div>
    <div class="row">
        @foreach ($classes as $class)
        <div class="col-md-6 col-lg-4">
            <div class="card card-blog card-plain">
                <div class="card-image">
                    <img class="img rounded img-raised" src="assets/img/project13.jpg">
                </div>
                <div class="card-body">
                    <h5 class="category text-warning">
                        <i class="now-ui-icons users_single-02"></i>Giáo viên: {{$class->teacher->name}}
                    </h5>
                    <h4 class="card-title">
                        {{$class->name}}
                    </h4>
                    @if (!empty(getAccount()))
                    <a href="{{route('app.user.registerClass',$class)}}">
                        <button class="btn btn-primary btn-round btn-block">Tham gia</button>
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