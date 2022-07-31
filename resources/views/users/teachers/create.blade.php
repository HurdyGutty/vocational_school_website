@extends('layout-dashboard-site.master')
@push('css')
<link href="{{asset('css/now-ui-kit.css?v=1.1.0')}}" rel="stylesheet" />
@endpush
@section('content')
<div class="card-body">
    <h2 class="header-title">Thêm ngành</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('app.user.storeClass') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="subject_input" class="col-form-label">Chọn môn</label>
            <select class="form-control" id="subject_input" name="subject">
                <option disabled>Chọn môn</option>
                @foreach($subjects as $id=>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
            @if ($errors->has('subject'))
            <div class="text-danger mt-1">
                {{$errors->first('subject')}}
            </div>
            @endif
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="weekday1" class="col-form-label">Chọn thứ</label>
                <select class="form-control drop" id="weekday1" name="weekday1">
                    <option disabled>Chọn thứ</option>
                    <option value="1">Thứ hai</option>
                    <option value="2">Thứ ba</option>
                    <option value="3">Thứ tư</option>
                    <option value="4">Thứ năm</option>
                    <option value="5">Thứ sáu</option>
                    <option value="6">Thứ bảy</option>
                    <option value="7">Chủ nhật</option>
                </select>
                @if ($errors->has('weekday1'))
                <div class="text-danger mt-1">
                    {{$errors->first('weekday1')}}
                </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="time1" class="col-form-label">Chọn ca</label>
                <select class="form-control" id="time1" name="time1">
                    <option disabled>Chọn ca</option>
                    <option value="1">17h00 - 19h00</option>
                    <option value="2">19h00 - 21h00</option>
                </select>
                @if ($errors->has('time1'))
                <div class="text-danger mt-1">
                    {{$errors->first('time1')}}
                </div>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="weekday2" class="col-form-label">Chọn thứ</label>
                <select class="form-control drop" id="weekday2" name="weekday2">
                    <option disabled>Chọn thứ</option>
                    <option value="1">Thứ hai</option>
                    <option value="2">Thứ ba</option>
                    <option value="3">Thứ tư</option>
                    <option value="4">Thứ năm</option>
                    <option value="5">Thứ sáu</option>
                    <option value="6">Thứ bảy</option>
                    <option value="7">Chủ nhật</option>
                </select>
                @if ($errors->has('weekday2'))
                <div class="text-danger mt-1">
                    {{$errors->first('weekday2')}}
                </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="time2" class="col-form-label">Chọn ca</label>
                <select class="form-control" id="time2" name="time2">
                    <option disabled>Chọn ca</option>
                    <option value="1">17h00 - 19h00</option>
                    <option value="2">19h00 - 21h00</option>
                </select>
                @if ($errors->has('time2'))
                <div class="text-danger mt-1">
                    {{$errors->first('time2')}}
                </div>
                @endif
            </div>
        </div>
        <div class="form-group mb-0 justify-content-end row">
            <div class="col-12">
                <button type="submit" class="btn btn-info">Đăng ký</button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('js')
<script src="{{asset('js/plugins/bootstrap-tagsinput.js')}}"></script>
<script>
var $drops = $('.drop');

$drops.change(function() {
    $drops.find("option").show();
    $drops.each(function(index, el) {
        const val = $(el).val();
        if (val) {
            const $other = $drops.not(this);
            $other.find("option[value=" + $(el).val() + "]").hide();
        }
    });
});
</script>
@endpush