@extends('layout-dashboard-site.master')

@section('content')
<div class="title">
    <h1>Thông tin giáo viên</h1>
</div>
<div class="row">
    @foreach ($teachers as $teacher)
    <div class="col-md-6 col-lg-4">
        <div class="card text-center d-block">
            <div class="card-body">
                <h4 class="mt-0">
                    {{$teacher->name}}
                </h4>
                <p class="text-muted font-13 mb-1
                 mt-2">Giới tính: {{ $teacher->gender ? 'Nam' : "Nữ" }}
                </p>
                <p class="text-muted font-13 mb-1
                 mt-2">Ngày sinh: {{ date_format(date_create($teacher->date_of_birth),'d/m/Y') }}
                </p>
                <p class="text-muted font-13 mb-1
                 mt-2">Số điện thoại: {{ $teacher->phone }}
                </p>
                <form class="show-account" action="{{route('admin.teacher.show', $teacher->id)}}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-primary" data-toggle="modal"
                        data-target="#standard-modal-{{$teacher->id}}" value="Xem thêm" />
                </form>
                <div id="standard-modal-{{$teacher->id}}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="standard-modalLabel">Thông tin giáo viên</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <h4 class="mt-0">
                                    {{$teacher->name}}
                                </h4>
                                <p class="text-muted font-13 mb-1
                                    mt-2">Giới tính: {{ $teacher->gender ? 'Nam' : "Nữ" }}
                                </p>
                                <p class="text-muted font-13 mb-1
                                mt-2">Ngày sinh: {{ date_format(date_create($teacher->date_of_birth),'d/m/Y') }}
                                </p>
                                <p class="text-muted font-13 mb-1
                                    mt-2">Số điện thoại: {{ $teacher->phone }}
                                </p>
                                <div class=" font-13 mb-1 mt-2 row">
                                    <p class='text-muted col-3'>
                                        <span class='created_classes font-weight-bold'></span> lớp cần duyệt
                                    </p>
                                    <p class='text-muted col-3'>
                                        <span class='ongoing_classes font-weight-bold'></span> lớp đang dạy
                                    </p>

                                    <p class="text-muted col-3">
                                        <span class='ended_classes font-weight-bold'></span> lớp hoàn thành
                                    </p>
                                    <p class='text-muted col-3'>
                                        <span class='periods font-weight-bold'></span> tiết hoàn thành
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="active_message"></div>
                                <form class="lock" {{$teacher->active ? '' : 'hidden'}}
                                    action="{{route('admin.teacher.lock', $teacher->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Khoá</button>
                                </form>

                                <form class="unlock" {{$teacher->active ? 'hidden' : ''}}
                                    action="{{route('admin.teacher.unlock', $teacher->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Mở khoá</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </div> <!-- end card-body-->

        </div> <!-- end card-->
    </div>
    @endforeach
</div>
<div class="pagination pagination-rounded mb-0">
    {{$teachers->links()}}
</div>


@endsection

@push('js')
<script>
$('.show-account').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let card = $(this).parent();
    $.ajax({
            url: form.attr('action'),
            type: "POST",
            dataType: 'json',
            data: form.serialize()
        })
        .done(function(data) {
            card.find('span.created_classes').text(data.classes_created);
            card.find('span.ongoing_classes').text(data.classes_on);
            card.find('span.ended_classes').text(data.classes_ended);
            card.find('span.periods').text(data.periods_count);
        });
})

$('.lock').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let div = $(this).parent();
    $.ajax({
        url: form.attr('action'),
        type: "POST",
        dataType: 'json',
        data: form.serialize()
    }).done(function(data) {
        if (data.status) {
            form.attr('hidden', true);
            div.find("form.unlock").attr('hidden', false);
            div.find('div.active_message').text(data.message);

        } else {
            div.find('div.active_message').text(data.message);
        }
    })
})

$('.unlock').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let div = $(this).parent();
    $.ajax({
        url: form.attr('action'),
        type: "POST",
        dataType: 'json',
        data: form.serialize()
    }).done(function(data) {
        if (data.status) {
            form.attr('hidden', true);
            div.find("form.lock").attr('hidden', false);
            div.find('div.active_message').text(data.message);
        } else {
            div.find('div.active_message').text(data.message);
        }
    })
})
</script>
@endpush