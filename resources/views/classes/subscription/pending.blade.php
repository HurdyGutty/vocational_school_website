@extends('layout-dashboard-site.master')

@section('content')
<div class="title my-3">
    <h1>Đơn đăng ký</h1>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-centered mb-0">
                    <thead>
                        <tr>
                            <th>Tên học sinh</th>
                            <th>Lớp học</th>
                            <th>Thời gian đăng ký</th>
                            <th>Ngày bắt đầu học</th>
                            <th>Kiểm tra lịch</th>
                            <th>Chấp thuận</th>
                            <th>Từ chối</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending_classes as $class)
                        <tr>

                            <td>{{$class->students->pluck('name')->first()}}</td>
                            <td>{{$class->name}}</td>
                            <td>{{date_format(date_create($class->subscriptions->pluck('register_time')->first()),"H:i:s d/m/Y")}}
                            </td>
                            <td>{{date_format(date_create($class->date_start),"d/m/Y")}}</td>
                            <td class="text-center">
                                <form class="form_check" action="{{route('admin.class.checkSchedule',
                                    [
                                        'class_id' => $class->id,
                                        'user_id' => $class->students->pluck('id')->first(),
                                        'is_teacher' => 0,
                                        ])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info checking">Kiểm tra lịch</button>
                                </form>
                                <div class="check_schedule row"></div>
                            </td>

                            <td>
                                <form method="POST" action="{{route('admin.class.approveSubscription');}}">
                                    <div>
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" id="class_id" name="class_id" value="{{$class->id}}" />
                                        <input type="hidden" id="student_id" name="student_id"
                                            value="{{$class->students->pluck('id')->first()}}" />
                                        <button type="submit" class="btn btn-info  ">OK</button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.class.deleteSubscription',
                                        ['class_id'=>$class->id,
                                        'student_id'=>$class->students->pluck('id')->first()]) }}" method="POST">
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
                    {{$pending_classes->links()}}
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