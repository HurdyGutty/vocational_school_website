@extends('layout-dashboard-site.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            @if (getAccount()->role)
            <h2 class="page-title-center">Các lớp đã dăng ký</h2>
            @else
            <h2 class="page-title-center">Xem lớp học</h2>
            @endif
        </div>
    </div>
</div>
<!-- @if ($errors->any())
<div class="row">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif -->
<div class="row">
    @foreach ($classes as $class) <div class="col-md-6 col-xl-3">
        <!-- project card -->
        <div class="card d-block">
            <div class="card-body">
                <!-- project title-->
                <h4 class="mt-0">
                    <a href="{{ route('app.user.showClass',$class->id) }}" class="text-title">{{$class->name}}</a>
                </h4>
                @if (!getAccount()->role)
                <p class="text-muted font-13
                 mt-3">Giáo viên: {{ $class->teacher_name }}
                </p>
                @endif
                <p class="text-muted font-13
                 ">Ngày học:
                    {{date_format(date_create($class->schedule_date),'d/m/Y')}}
                </p>
                <p class="text-muted font-13
                 ">Thời gian:
                    {{date_format(date_create($class->start_time),'H\hi') . ' - ' . date_format(date_create($class->end_time),'H\hi')}}
                </p>
                <a href="{{ route('app.user.showClass',$class->id) }}" class="btn btn-primary">Xem thêm</a>
            </div> <!-- end card-body-->

        </div> <!-- end card-->
    </div> <!-- end col -->
    @endforeach
</div>
@endsection