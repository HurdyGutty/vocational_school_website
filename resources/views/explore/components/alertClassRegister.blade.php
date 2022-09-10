@if (session()->has('classRegistered'))
<div class="alert alert-danger" role="alert">
    <div class="container">
        <div class="alert-icon">
            <i class="now-ui-icons objects_support-17"></i>
        </div>
        <strong>Lỗi!!!</strong>
        {{session('classRegistered')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="now-ui-icons ui-1_simple-remove"></i>
            </span>
        </button>
    </div>
</div>
@endif