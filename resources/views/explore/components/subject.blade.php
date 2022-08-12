<div class="container">
    <div class="title">
        <h3>Môn học</h3>
    </div>
    <div class="row">
        @foreach ($subjects as $subject)
        <div class="col-md-6 col-lg-4">
            <div class="card card-blog card-plain">
                <div class="card-image">
                    <img class="img rounded img-raised" src="assets/img/project13.jpg">
                </div>
                <div class="card-body">
                    <h5 class="category text-warning">
                        <i class="now-ui-icons business_bulb-63"></i> {{$subject->classes_count}} lớp đã mở
                    </h5>
                    <h4 class="card-title">
                        <a href="{{route('showClass',$subject)}}">{{$subject->name}}</a>
                    </h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row d-flex justify-content-center"> {{ $subjects->links() }} </div>
</div>