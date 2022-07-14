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
    <form method="POST" action="{{ route('admin.major.store') }}">
        @csrf
        <div class="form-group">
            <label for="major_input" class="col-form-label">Tên ngành</label>
            <input type="text" class="form-control" id="major_input" name="name" placeholder="Tên ngành">
        </div>
        <div class="form-group">
            <label for="subject_tags" class="col-form-label">Tên môn:</label>
            <input type="hidden" class="tagsinput" data-role="tagsinput some_text" name="subjects" data-color="danger"
                id="subject_tags" />
        </div>

        <div class="form-group">
            <label for="add_subject">Thêm môn</label>
            <select id="add_subject" class="form-control">
                @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Thêm mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="time_duration">Thời gian</label>
                    <input type="number" id="time_duration" name="time_duration" class="form-control"
                        placeholder="Tháng">
                </div>
                <div class="col">
                    <label for="courses">Số môn cần đạt</label>
                    <input type="number" id="courses" name="courses" class="form-control" placeholder="Môn">
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
$('#add_subject').on('change', function() {
    var select_text = $('#add_subject option:selected');
    var tags = $('#subject_tags');
    tags.tagsinput({
        allowDuplicates: false,
        itemValue: 'id',
        itemText: 'text'
    });
    console.log(select_text.text());
    tags.tagsinput('add', {
        'id': select_text.val(),
        'text': select_text.text()
    });
})
</script>
@endpush