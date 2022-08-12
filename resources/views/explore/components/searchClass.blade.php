<div class="container">

    <div class="row">
        <div class="col-md-12 ml-auto mr-auto">
            <div class="card card-raised card-form-horizontal">
                <div class="title ml-2">
                    <h3 class="mb-1">Tìm kiếm lớp học</h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{route('showClass',$subject->id)}}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="weekday" class="col-form-label">Chọn thứ</label>
                                <select class="form-control drop" id="weekday" name="weekday">
                                    <option disabled selected value="">Chọn thứ</option>
                                    <option value="1">Thứ hai</option>
                                    <option value="2">Thứ ba</option>
                                    <option value="3">Thứ tư</option>
                                    <option value="4">Thứ năm</option>
                                    <option value="5">Thứ sáu</option>
                                    <option value="6">Thứ bảy</option>
                                    <option value="0">Chủ nhật</option>
                                </select>
                                @if ($errors->has('weekday'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('weekday')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="time" class="col-form-label">Chọn ca</label>
                                <select class="form-control" id="time" name="time">
                                    <option disabled selected value="">Chọn ca</option>
                                    <option value="1">17h00 - 19h00</option>
                                    <option value="2">19h00 - 21h00</option>
                                </select>
                                @if ($errors->has('time'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('time')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="teacher_name" class="col-form-label">Tên giáo viên</label>
                                <input type="text" name="teacher_name" class="form-control"
                                    placeholder="Tìm kiếm tên giáo viên...">
                                @if ($errors->has('teacher_name'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('teacher_name')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group mt-2 justify-content-end row">
                            <button type="submit" class="btn btn-primary btn-round btn-block">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>