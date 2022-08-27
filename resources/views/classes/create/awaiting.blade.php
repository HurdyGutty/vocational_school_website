@extends('layout-dashboard-site.master')

@section('content')
<div class="title">
    <h1>Đăng ký tạo lớp</h1>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-centered mb-0">
                    <thead>
                        <tr>
                            <th>Tên giáo viên</th>
                            <th>Môn học</th>
                            <th>Tên lớp</th>
                            <th>Ca</th>
                            <th>Kiểm tra lịch</th>
                            <th>Chấp thuận</th>
                            <th>Từ chối</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($awaiting_classes as $class)
                        <tr>

                            <td>{{$class->teacher_name}}</td>
                            <td>{{$class->subject->name}}</td>
                            <td>{{$class->name}}</td>
                            <td>
                                @foreach ($class->timetable as $timetable)
                                <div>{{$timetable}}</div>
                                @endforeach
                            </td>
                            <td>
                                <!-- {{((new App\Services\CheckScheduleService($class->id, $class->teacher_id))->checkTeacher()) ? "Ổn" : "Bị trùng"}} -->
                            </td>

                            <td>
                                <form method="POST" action="{{route('admin.class.accepted');}}" class="form-inline">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" id="class_id" name="class_id" value="{{$class->id}}" />
                                    <label class="sr-only" for="period">Số buổi</label>
                                    <input type="number" id="period" name="period" class="form-control mb-2 mr-sm-2"
                                        placeholder="Số buổi" />
                                    <button type="submit" class="btn btn-primary mb-2  ">Tạo</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.class.denied',['class_id'=>$class->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger  ">
                                        Xoá
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('js/plugins/bootstrap-tagsinput.js')}}"></script>
@endpush