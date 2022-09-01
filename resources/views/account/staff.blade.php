@extends('layout-dashboard-site.master')

@section('content')
<div class="title">
    <h1>Thông tin nhân viên</h1>
</div>
<div class="row">
    @foreach ($staffs as $staff)
    <div class="col-md-6 col-lg-4">
        <div class="card text-center d-block">
            <div class="card-body">
                <h4 class="mt-0">
                    {{$staff->name}}
                </h4>
                <p class="text-muted font-13 mb-1
                 mt-2">Giới tính: {{ $staff->gender ? 'Nam' : "Nữ" }}
                </p>
                <p class="text-muted font-13 mb-1
                 mt-2">Ngày sinh: {{ date_format(date_create($staff->date_of_birth),'d/m/Y') }}
                </p>
                <p class="text-muted font-13 mb-1
                 mt-2">Số điện thoại: {{ $staff->phone }}
                </p>
                <form class="show-account" action="{{route('admin.staff.show', $staff->id)}}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-primary" data-toggle="modal"
                        data-target="#standard-modal-{{$staff->id}}" value="Xem thêm" />
                </form>
                <div id="standard-modal-{{$staff->id}}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="standard-modalLabel">Thông tin nhân viên</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <h4 class="mt-0">
                                    {{$staff->name}}
                                </h4>
                                <p class="text-muted font-13 mb-1
                                    mt-2">Giới tính: {{ $staff->gender ? 'Nam' : "Nữ" }}
                                </p>
                                <p class="text-muted font-13 mb-1
                                mt-2">Ngày sinh: {{ date_format(date_create($staff->date_of_birth),'d/m/Y') }}
                                </p>
                                <p class="text-muted font-13 mb-1
                                    mt-2">Số điện thoại: {{ $staff->phone }}
                                </p>
                                <p class="text-muted font-13 mb-1 mt-2">
                                    Số đơn thành công: <span class='succeeded_subscriptions'></span> đơn trong số <span
                                        class='succeeded_classes'></span> lớp
                                </p>
                                <p class="text-muted font-13 mb-1 mt-2">
                                    Số đơn thất bại: <span class='failed_subscriptions'></span> đơn trong số <span
                                        class='failed_classes'></span> lớp
                                </p>
                            </div>
                            <div class="modal-footer">
                                <div class="active_message"></div>
                                <form class="lock" {{$staff->active ? '' : 'hidden'}}
                                    action="{{route('admin.staff.lock', $staff->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Khoá</button>
                                </form>

                                <form class="unlock" {{$staff->active ? 'hidden' : ''}}
                                    action="{{route('admin.staff.unlock', $staff->id)}}" method="POST">
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
    {{$staffs->links()}}
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
            card.find('span.succeeded_subscriptions').text(data.subscriptions_count);
            card.find('span.succeeded_classes').text(data.success_class_count);
            card.find('span.failed_subscriptions').text(data.failed_subscriptions);
            card.find('span.failed_classes').text(data.failed_classes);
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