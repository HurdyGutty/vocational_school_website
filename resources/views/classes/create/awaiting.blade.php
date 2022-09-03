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
                            <th class="text-center">Tên giáo viên</th>
                            <th class="text-center">Môn học</th>
                            <th class="text-center">Tên lớp</th>
                            <th class="text-center">Ca</th>
                            <th class="text-center">Kiểm tra lịch</th>
                            <th class="text-center">Chấp thuận</th>
                            <th class="text-center">Từ chối</th>
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
                            <td class="text-center">
                                <form class="form_check" action="{{route('admin.class.checkSchedule',
                                    [
                                        'class_id' => $class->id,
                                        'user_id' => $class->teacher_id,
                                        'is_teacher' => 1,
                                        ])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info checking">Kiểm tra lịch</button>

                                </form>

                                <div class="check_schedule row"></div>
                            </td>

                            <td>
                                <form method="POST" action="{{route('admin.class.accepted');}}" class="form-inline">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" id="class_id" name="class_id" value="{{$class->id}}" />
                                    <label class="sr-only" for="period">Số buổi</label>
                                    <input type="number" id="period" name="period"
                                        class="form-control my-2 mr-sm-2 col-sm-8" placeholder="Số buổi" />
                                    <button type="submit" class="btn btn-primary my-2 col-sm-3 ">Tạo</button>
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
                <div class="pagination pagination-rounded mb-0">
                    {{$awaiting_classes->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$('form.form_check').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let td = $(this).parent();

    $.ajax({
            url: form.attr('action'),
            type: "POST",
            dataType: 'json',
            data: form.serialize()
        })
        .done(function(data) {
            if (data.status) {
                td.find('div.check_schedule').text(data.checked).addClass("text-center");
                form.attr('hidden', true);
            } else {
                td.find('div.check_schedule').text(data.message).addClass("text-center");
                form.attr('hidden', false);
            }
        })
})
</script>
@endpush