@extends('layout-dashboard-site.master')
@push('css')
<link href="{{asset('css/now-ui-kit.css?v=1.1.0')}}" rel="stylesheet" />
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h2 class="page-title-center">Xem từng ngành</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <h3 class="mt-0">{{$major->name}} <a href="{{ route('admin.major.edit',$major) }}"
                            class="text-muted"><i class="mdi mdi-square-edit-outline ml-2"></i></a> </h3>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <!-- Product image -->
                        <a href="javascript: void(0);" class="text-center d-block mb-4">
                            @isset($major->image_id)
                            <img src="{{ secure_asset($major->image()->getResults()->source) }}" class="img-fluid"
                                style="max-width: 500px;" alt="Product-img">
                            @endisset
                        </a>

                    </div> <!-- end col -->
                    <div class="col-lg-5">
                        <!-- Product title -->
                        <!-- <h3 class="mt-0">{{$major->name}} <a href="{{ route('admin.major.edit',$major) }}"
                                class="text-muted"><i class="mdi mdi-square-edit-outline ml-2"></i></a> </h3> -->
                        <p class="mb-1">Các lớp trong ngành:</p>
                        <p class="font-16">
                        <div class="list-group list-group-flush">
                            @foreach ($subject_arr as $key => $value)
                            <a href="{{ route('admin.subject.show',$key) }}"
                                class="list-group-item list-group-item-info list-group-item-action">
                                {{ $value }}
                            </a>
                            @endforeach
                        </div>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Product description -->
                        <div class="mt-4">
                            <h6 class="font-14">Mô tả:</h6>
                            <p>{{ $major->description}} </p>
                        </div>

                        <!-- Product information -->
                        <div class="mt-4">
                            <div class="row">
                                @isset($major->time_duration)
                                <div class="col-md-6">
                                    <h6 class="font-14">Tổng thời gian:</h6>
                                    <p class="text-sm lh-150">{{$major->time_duration}} tháng</p>
                                </div>
                                @endisset
                                @isset($major->courses)
                                <div class="col-md-6">
                                    <h6 class="font-14">Số môn phải học:</h6>
                                    <p class="text-sm lh-150">{{$major->courses}}</p>
                                </div>
                                @endisset
                            </div>
                        </div>


                    </div> <!-- end col -->
                </div> <!-- end row-->

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
@endsection