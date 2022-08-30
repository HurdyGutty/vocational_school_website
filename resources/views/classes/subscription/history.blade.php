@extends('layout-dashboard-site.master')

@section('content')
<div class="title my-3">
    <h1>Đơn đã xử lý</h1>
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
                            @if (getAccount()->is_admin && getAccount()->role == 1)
                            <th>Người xử lý đơn</th>
                            <th>Tình trạng</th>
                            <th>Khôi phục</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptions as $subscription)
                        <tr>

                            <td>{{$subscription->student->name}}</td>
                            <td>{{$subscription->class->name}}</td>
                            <td>{{date_format(date_create($subscription->register_time),"H:i:s d/m/Y")}}
                            </td>
                            <td>{{date_format(date_create($subscription->class->date_start),"d/m/Y")}}</td>

                            @if (getAccount()->is_admin && getAccount()->role == 1)
                            <td>{{$subscription->admin->name}}
                            </td>
                            <td>
                                {{(empty($subscription->deleted_at)) ? "Đã duyệt" : "Đã huỷ"}}
                            </td>

                            <td>
                                <form method="POST" action="{{route('admin.class.restoreSubscription');}}">
                                    <div>
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" id="class_id" name="class_id"
                                            value="{{$subscription->class->id}}" />
                                        <input type="hidden" id="student_id" name="student_id"
                                            value="{{$subscription->student->id}}" />
                                        <button type="submit" class="btn btn-info  ">OK</button>
                                    </div>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination pagination-rounded mb-0">
                    {{$subscriptions->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('js/plugins/bootstrap-tagsinput.js')}}"></script>
@endpush