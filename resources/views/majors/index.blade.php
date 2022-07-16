@extends('layout-dashboard-site.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h2 class="page-title-center">Các ngành</h2>
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
    @foreach ($subject_major as $major) <div class="col-md-6 col-xl-3">
        <!-- project card -->
        <div class="card d-block">
            <div class="card-body">
                <div class="dropdown card-widgets">
                    <a href="#" class="dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
                        <i class="dripicons-dots-3"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="{{ route('admin.major.edit',['major' => $major->id]) }}" class="dropdown-item"><i
                                class="mdi mdi-pencil mr-1"></i>Sửa</a>
                        <!-- item-->
                        <form action="{{ route('admin.major.delete',$major) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button href="" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i>Xoá</button>
                        </form>
                    </div>
                </div>
                <!-- project title-->
                <h4 class="mt-0">
                    <a href="{{ route('admin.major.show',$major) }}" class="text-title">{{$major->name}}</a>
                </h4>
                @isset ($major->image_id)
                <img src="{{ 'data:image/png;base64,' . $major->image()->getResults()->source }}" alt="Ảnh đại diện"
                    class="card-img-top" style="max-height: 250px; width: auto; height:auto; max-width: 100%" />
                @endisset
                <p class="text-muted font-13 mb-3
                 mt-2">{{implode(", ",$major->subject_name)}}
                    <!-- <a
                        href="javascript:void(0);" class="font-weight-bold text-muted">view
                        more</a> -->
                </p>
                <a href="{{ route('admin.major.show',$major) }}" class="btn btn-primary">Xem thêm</a>
            </div> <!-- end card-body-->

        </div> <!-- end card-->
    </div> <!-- end col -->
    @endforeach
</div>
@endsection