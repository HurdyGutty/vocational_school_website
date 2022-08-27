@extends('layout-dashboard-site.master')

@section('content')
<div class="title">
    <h1>Các lớp học</h1>
</div>
<div class="row">
    @foreach ($classes as $class)
    <div class="col-md-6 col-xl-3">
        <div class="card d-block">
            <div class="card-body">
                <h4 class="mt-0">
                    <a href="{{ route('admin.class.show',$class) }}" class="text-title">{{$class->name}}</a>
                </h4>
                <p class="text-muted font-13 mb-1
                 mt-2">Môn: {{ $class->subject_name }}
                </p>
                <p class="text-muted font-13 mb-1
                 mt-2">Giáo viên: {{ $class->teacher->name }}
                </p>
                <p class="text-muted font-13 mb-1
                 mt-2">Số lượng sinh viên đã đăng ký: {{ $class->subscriptions_count }}
                </p>
                <p class="text-muted font-13 mb-1
                 mt-2">Tình trạng: {{ App\Enums\ClassStatus::from($class->status)->showRole() }}
                </p>


                <a href="{{ route('admin.class.show',$class) }}" class="btn btn-primary">Xem thêm</a>
            </div> <!-- end card-body-->

        </div> <!-- end card-->
    </div>
    @endforeach
</div>
<div class="pagination pagination-rounded mb-0">
    {{$classes->links()}}
</div>


@endsection

@push('js')
<script src="{{asset('js/plugins/bootstrap-tagsinput.js')}}"></script>
@endpush