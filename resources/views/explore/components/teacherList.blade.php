<div class="container">
    <div class="title">
        <h1>Danh sách giáo viên</h1>
    </div>
    @if (!$teachers->first())
    <div class="row">
        <h3 class="mr-4">Không tìm thấy giáo viên</h3>
    </div>
    @endif
    <div class="row">
        @foreach ($teachers as $teacher)
        <div class="col-md-6 col-lg-4">
            <div class="card card-blog">
                <div class="card-image">
                    <img class="img rounded img-raised" src="{{'data:image/png;base64,' . $teacher->image_source}}"
                        alt="Không thể hiện ảnh">
                </div>
                <div class="card-body">
                    <form action="{{route('showTeacher',$teacher->id)}}" method="POST" class="form">
                        <h4 class="card-title">
                            @csrf
                            <a href="" class="show-account" data-toggle="modal"
                                data-target="#standard-modal-{{$teacher->id}}">{{$teacher->name}}</a>
                        </h4>
                    </form>
                    <div class="modal fade" id="standard-modal-{{$teacher->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center flex-column align-items-center">
                                    <img class="img rounded img-raised"
                                        src="{{'data:image/png;base64,' . $teacher->image_source}}"
                                        alt="Không thể hiện ảnh">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                    <h4 class="title title-up">Thông tin giáo viên</h4>
                                </div>
                                <div class="modal-body">
                                    <h4 class="mt-2 mb-0 name text-center">
                                    </h4>
                                    <p class="text-muted font-13 mb-1
                                        mt-0 py-2 info">
                                    </p>
                                    <div class=" font-13 mb-1 mt-0 row">
                                        <p class='text-muted col-6 text-center'>
                                            <span class='classes_count font-weight-bold'></span> lớp
                                        </p>
                                        <p class='text-muted col-6 text-center'>
                                            <span class='students_count font-weight-bold'></span> học sinh
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{$teachers->links()}}
</div>