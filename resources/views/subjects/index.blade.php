@extends('layout-dashboard-site.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h2 class="page-title-center">Các môn</h2>
        </div>
    </div>
</div>
@if ($errors->any())
<div class="row">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
<div class="row">
    @foreach ($subjects as $subject)
    <div class="col-md-6 col-xl-3">
        <div class="card d-block">
            <div class="card-body">
                <div class="dropdown card-widgets">
                    <a href="#" class="dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
                        <i class="dripicons-dots-3"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="{{ route('admin.subject.edit',$subject) }}" class="dropdown-item"><i
                                class="mdi mdi-pencil mr-1"></i>Sửa</a>

                    </div>
                </div>
                <!-- project title-->
                <h4 class="mt-0">
                    <a href="{{ route('admin.subject.show',$subject) }}" class="text-title">{{$subject->name}}</a>
                </h4>
                @isset ($subject->image_id)
                <img src="{{ 'data:image/png;base64,' . $subject->image()->getResults()->source }}" alt="Ảnh đại diện"
                    class="card-img-top" style="max-height: 250px; width: auto; height:auto; max-width: 100%" />
                @endisset
                <p class="text-muted font-13 mb-3
                 mt-2">Thời lượng: {{$subject->time_duration}} tháng
                </p>
                <a href="{{ route('admin.subject.show',$subject) }}" class="btn btn-primary">Xem thêm</a>
            </div> <!-- end card-body-->

        </div> <!-- end card-->
    </div> <!-- end col -->
    @endforeach
</div>
@endsection