@extends('layout-dashboard-site.master')
@push('css')
<link href="{{asset('css/now-ui-kit.css?v=1.1.0')}}" rel="stylesheet" />
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h2 class="page-title-center">{{$class_info->name}}</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-5">
        @if(!getAccount()->role)
        <div class="card text-center">

            <div class="card-body">
                <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-lg img-thumbnail"
                    alt="profile-image">

                <h4 class="mb-0 mt-2">{{$class_info->teacher->name}}</h4>
                <p class="text-muted font-14">Giáo viên môn {{ $class_info->subject->name }}</p>
            </div> <!-- end card-body -->

        </div> <!-- end card -->
        @endif
        <!-- Messages-->
        <div class="card">
            <div class="card-body">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach($class_info->schedules as $schedule)
                    <a class="nav-link active show my-1" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                        role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="mdi mdi-home-variant d-md-none d-block"></i>
                        <span class="d-none d-md-block">Buổi {{$schedule->period}}:
                            {{date_format(date_create($schedule->date),"d/m/Y")}}</span>
                    </a>
                    @endforeach
                </div> <!-- end col-->
            </div> <!-- end card-body-->
        </div> <!-- end card-->

    </div> <!-- end col-->

    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                    <li class="nav-item">
                        <a href="#bai_giang" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                            Bài giảng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#bai_tap" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                            Bài tập
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="bai_giang">

                        <h5 class="text-uppercase"><i class="mdi mdi-briefcase mr-1"></i>
                            Buổi 1: Làm quen</h5>

                        <div class="timeline-alt pb-0">
                            <div class="timeline-item">
                                <i class="mdi mdi-circle bg-info-lighten text-info timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <h5 class="mt-0 mb-1">Video</h5>
                                    <iframe src="https://player.vimeo.com/video/87993762" class="img-fluid border-0"
                                        height="auto" width="100%"></iframe>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <i class="mdi mdi-circle bg-primary-lighten text-primary timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <h5 class="mt-0 mb-1">Nội dung</h5>
                                    <textarea class="form-control" id="example-textarea" rows="5">If several languages coalesce, the grammar
                                        of the resulting language is more simple and regular than that of
                                        the individual languages. The new common language will be more
                                        simple and regular than the existing European languages.</textarea>
                                </div>
                            </div>



                        </div>
                        <!-- end timeline -->

                    </div> <!-- end tab-pane -->
                    <!-- end about me section content -->

                    <div class="tab-pane show" id="bai_tap">
                        <!-- Story Box-->
                        <div class="border border-light rounded p-2 mb-3">
                            <p>Làm quen với các khái niệm có trong video</p>
                        </div>
                    </div>
                    <!-- end timeline content-->

                </div> <!-- end tab-content -->
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>

@endsection