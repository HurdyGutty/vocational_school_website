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
                                    <option value="1" {{old('weekday') == 1 ? 'selected' : ''}}>Thứ hai</option>
                                    <option value="2" {{old('weekday') == 2 ? 'selected' : ''}}>Thứ ba</option>
                                    <option value="3" {{old('weekday') == 3 ? 'selected' : ''}}>Thứ tư</option>
                                    <option value="4" {{old('weekday') == 4 ? 'selected' : ''}}>Thứ năm</option>
                                    <option value="5" {{old('weekday') == 5 ? 'selected' : ''}}>Thứ sáu</option>
                                    <option value="6" {{old('weekday') == 6 ? 'selected' : ''}}>Thứ bảy</option>
                                    <option value="0" {{old('weekday') == 0 ? 'selected' : ''}}>Chủ nhật</option>
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
                                    <option value="1" {{old('time') == 1 ? 'selected' : ''}}>17h00 - 19h00</option>
                                    <option value="2" {{old('time') == 2 ? 'selected' : ''}}>19h00 - 21h00</option>
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
                                    value="{{old('teacher_name')}}" placeholder="Tìm kiếm tên giáo viên...">
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
                        <div class="form-group mt-2 justify-content-end row">
                            <a href="{{route('showClass',$subject->id)}}" class="btn btn-danger btn-round btn-block">
                                Xoá kết quả tìm kiếm
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>