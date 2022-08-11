<div class="container">
    <div class="title">
        <h3>Môn học</h3>
    </div>
    <div class="row">
        @foreach ($classes as $class)
        <div class="col-md-6 col-lg-4">
            <div class="card card-blog card-plain">
                <div class="card-image">
                    <img class="img rounded img-raised" src="assets/img/project13.jpg">
                </div>
                <div class="card-body">
                    <h6 class="category text-warning">
                        <i class="now-ui-icons business_bulb-63"></i> Focus
                    </h6>
                    <h5 class="card-title">
                        <a href="#nuk">{{$class->name}}</a>
                    </h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row d-flex justify-content-center"> {{ $classes->links() }} </div>
</div>