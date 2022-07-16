@extends('layout-dashboard-site.master')
@push('css')
<link href="{{asset('css/now-ui-kit.css?v=1.1.0')}}" rel="stylesheet" />
@endpush
@section('content')
<div class="card-body">
    <h2 class="header-title">Sửa thông tin ngành</h2>
    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif -->
    <form method="POST" action="{{ route('admin.major.update') }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" id="major_id" name="id" value="{{ $major->id }}">
        <div class="form-group">
            <label for="major_name" class="col-form-label">Tên ngành</label>
            <input type="text" class="form-control" id="major_name" name="name" value="{{ $major->name }}">
            @if ($errors->has('name'))
            <div class="text-danger mt-1">
                {{$errors->first('name')}}
            </div>
            @endif
        </div>
        <div class="form-group">
            <label for="subject_tags" class="col-form-label">Tên môn:</label>
            <input type="hidden" class="tagsinput" data-role="tagsinput some_text" name="subjects" data-color="danger"
                id="subject_tags" />
            @if ($errors->has('subjects.*'))
            <div class="text-danger mt-1" id="subjects_error">
                {{$errors->first('subjects.*')}}
            </div>
            @endif
        </div>

        <div class="form-group">
            <label for="add_subject">Thêm môn</label>
            <select id="add_subject" class="form-control">
                <option value="" disabled selected>Hãy chọn môn</option>
                @foreach ($subjects as $subject)
                @if (in_array($subject->id,array_keys($subject_arr)))
                <option value="{{ $subject->id }}" hidden>{{ $subject->name }}</option>
                @continue
                @endif
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Thêm mô tả</label>
            <textarea class="form-control" id="description" name="description"
                rows="3">{{$major->description}}</textarea>
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
                        placeholder="Tháng" value="{{$major->time_duration}}">
                    @if ($errors->has('time_duration'))
                    <div class="text-danger mt-1">
                        {{$errors->first('time_duration')}}
                    </div>
                    @endif
                </div>
                <div class="col">
                    <label for="courses">Số môn cần đạt</label>
                    <input type="number" id="courses" name="courses" class="form-control" placeholder="Môn"
                        value="{{$major->courses}}">
                    @if ($errors->has('courses'))
                    <div class="text-danger mt-1">
                        {{$errors->first('courses')}}
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
                @isset ($major->image_id)
                <div class="col-md-6">
                    <label>Ảnh cũ</label><br>
                    <img src="{{ 'data:image/png;base64,' . $major->image()->getResults()->source }}" alt="Ảnh cũ" />
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
var tags = $('#subject_tags');
var subject_arr = @json($subject_arr);

tags.tagsinput({
    allowDuplicates: false,
    itemValue: 'id',
    itemText: 'label'
});
$(document).ready(function() {
    $('#subject_tags').tagsinput('refresh')
    const keys = Object.keys(subject_arr);
    keys.forEach(function(key) {
        tags.tagsinput('add', {
            'id': key,
            'label': subject_arr[key],
        });
    })
});
$('#add_subject').on('change', function() {
    var select_text = $('#add_subject option:selected');
    tags.tagsinput({
        allowDuplicates: false,
        itemValue: 'id',
        itemText: 'label'
    });
    tags.tagsinput('add', {
        'id': select_text.val(),
        'label': select_text.text()
    });
    select_text.attr("hidden", true);
})
$('#subject_tags').on("beforeItemRemove", function(event) {
    $("#add_subject [value=" + event.item.id + "]").attr("hidden", false);
});
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
        $('#new_img').attr("hidden", false)
    }
}
</script>
@endpush