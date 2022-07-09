@extends('layout-dashboard-site.master')
@push('css')
<link href="{{asset('css/now-ui-kit.css?v=1.1.0')}}" rel="stylesheet" />
@endpush
@section('content')
<div class="card-body">
    <h2 class="header-title">Sửa thông tin ngành</h4>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('admin.major.update') }}">
            @method('PUT')
            @csrf
            <input type="hidden" id="major_id" name="id" value="{{ $major->id }}">
            <div class="form-group">
                <label for="major_name" class="col-form-label">Tên ngành</label>
                <input type="text" class="form-control" id="major_name" name="name" value="{{ $major->name }}">
            </div>
            <div class="form-group">
                <label for="subject_tags" class="col-form-label">Tên môn:</label>
                <input type="hidden" class="tagsinput" data-role="tagsinput some_text" name="subjects"
                    data-color="danger" id="subject_tags" />
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
</script>
@endpush