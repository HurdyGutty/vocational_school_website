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
        <div class="form-group">
            <label for="user_name" class="col-form-label">Họ tên</label>
            <input type="text" class="form-control" id="user_name" name="name" value="{{ $subject->name }}">
            @if ($errors->has('name'))
            <div class="text-danger mt-1">
                {{$errors->first('name')}}
            </div>
            @endif
        </div>
        <div class="form-group">
            <label for="description">Thêm mô tả</label>
            <textarea class="form-control" id="description" name="description"
                rows="3">{{$subject->description}}</textarea>
            @if ($errors->has('description'))
            <div class="text-danger mt-1">
                {{$errors->first('description')}}
            </div>
            @endif
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="time_duration">Thời gian</label>
                    <input type="number" id="time_duration" name="time_duration" class="form-control"
                        placeholder="Tháng" value="{{$subject->time_duration}}">
                    @if ($errors->has('time_duration'))
                    <div class="text-danger mt-1">
                        {{$errors->first('time_duration')}}
                    </div>
                    @endif
                </div>
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
                @isset ($subject->image_id)
                <div class="col-md-6">
                    <label>Ảnh cũ</label><br>
                    <img src="{{ 'data:image/png;base64,' . $subject->image()->getResults()->source }}" alt="Ảnh cũ" />
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