@extends('layout-dashboard-site.master')
@push('css')
<link href="{{asset('css/now-ui-kit.css?v=1.1.0')}}" rel="stylesheet" />
@endpush
@section('content')
<div class="card-body">
    <h2 class="header-title">Thêm ngành</h4>
        <form>
            <div class="form-group">
                <label for="major_input" class="col-form-label">Tên ngành</label>
                <input type="email" class="form-control" id="major_input" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="subject_tags" class="col-form-label">Tên môn:</label>
                <select multiple data-role="tagsinput" id="subject_tags">
                </select>
            </div>

            <div class="form-group">
                <label for="add_subject">Thêm môn</label>
                <select id="add_subject" multiple class="form-control">
                    @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-0 justify-content-end row">
                <div class="col-12">
                    <button type="submit" class="btn btn-info  ">Sign in</button>
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
    console.log(select_text);
    $('#subject_tags').tagsinput({
        allowDuplicates: false,
        itemValue: 'id',
        itemText: 'name'
    });
    $.each(select_text, function(value, text) {
        $('#subject_tags').tagsinput('add', {
            'id': value,
            'name': text
        });
    });
})
</script>
@endpush