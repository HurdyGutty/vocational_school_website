<div class="container">
    <div class="title">
        <h1>Các môn học trong các ngành</h1>
    </div>
    @if (!$majors->first())
    <div class="row">
        <h3 class="mr-4">Không tìm thấy môn học nào phù hợp với bạn</h3>
    </div>
    @endif
    @foreach ($majors as $major_name => $value)
    <div class="row">
        <div class="title col-12 mb-3 text-primary">
            <h2>Ngành: {{$major_name}}</h2>
        </div>
        @foreach ($value as $subject)
        <div class="col-md-6 col-lg-4">
            <div class="card card-blog">
                <div class="card-image">
                    <img class="img rounded img-raised" src="{{'data:image/png;base64,' . $subject->image_source}}"
                        alt="Không thể hiện ảnh">
                </div>
                <div class="card-body">
                    <h5 class="category text-warning">
                        <i class="now-ui-icons business_bulb-63"></i> {{$subject->classes_count}} lớp đã mở
                    </h5>
                    <h4 class="card-title">
                        <a href="{{route('showClass',$subject->subject_id)}}">Môn: {{$subject->subject_name}}</a>
                    </h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach

</div>