@extends('layout-dashboard-site.master')
@push('css')
<link href="{{asset('css/now-ui-kit.css?v=1.1.0')}}" rel="stylesheet" />
@endpush
@section('content')
<div class="card-body">
    <h2 class="header-title">Cập nhật thông tin</h2>
    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif -->
    <form method="POST" action="{{ route('app.user.update') }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="user_name" class="col-form-label">Họ tên</label>
                <input type="text" class="form-control" id="user_name" name="name" value="{{ $user->name }}">
                @if ($errors->has('name'))
                <div class="text-danger mt-1">
                    {{$errors->first('name')}}
                </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label mr-1" for="gender">Giới tính</label>
                <br>
                <div class="form-check form-check-inline" id="gender">
                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="1"
                        {{ ($user->gender === 1) ? "checked" : "" }}>
                    <label class="form-check-label" for="gender1">
                        Nam
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="0"
                        {{ ($user->gender === 0) ? "checked" : "" }}>
                    <label class="form-check-label" for="gender2">
                        Nữ
                    </label>
                </div>
                @if ($errors->has('gender'))
                <div class="text-danger mt-1">
                    {{$errors->first('gender')}}
                </div>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date_of_birth">Ngày sinh</label>
                <input class="form-control" id="date_of_birth" type="date" name="date_of_birth"
                    value="{{ $user->date_of_birth }}">
                @if ($errors->has('date_of_birth'))
                <div class="text-danger mt-1">
                    {{$errors->first('date_of_birth')}}
                </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="number">Số điện thoại</label>
                <input type="number" id="number" name="phone" class="form-control" value="{{$user->phone}}">
                @if ($errors->has('phone'))
                <div class="text-danger mt-1">
                    {{$errors->first('phone')}}
                </div>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="imgInp" name="image" value="">
                <label class="custom-file-label" for="imgInp">Chọn ảnh</label>
            </div>
            @if ($errors->has('image'))
            <div class="text-danger mt-1">
                {{$errors->first('image')}}
            </div>
            @endif
            <div class="row">
                @isset ($user->image_id)
                <div class="col-md-6">
                    <label>Ảnh cũ</label><br>
                    <img src="{{ 'data:image/png;base64,' . $user->image()->getResults()->source }}" alt="Ảnh cũ" />
                </div>
                @endisset
                <div class="col-md-6" id="new_img" hidden="true">
                    <label>Ảnh mới</label><br>
                    <img id="blah" src="#" alt="Ảnh mới" />
                </div>
            </div>
        </div>
        <div class="form-group mb-0 justify-content-end row">
            <div class="col-12">
                <button type="submit" class="btn btn-info  ">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('js')
<script src="{{asset('js/plugins/bootstrap-tagsinput.js')}}"></script>
<script>
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
        $('#new_img').attr("hidden", false)
    }
}
</script>
@endpush