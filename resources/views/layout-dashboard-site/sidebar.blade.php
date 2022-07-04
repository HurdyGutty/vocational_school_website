<div class="left-side-menu mm-show">

    <!-- LOGO -->
<a href="#" class="logo text-center logo-light">
        <span class="logo-lg">
        <img src="#" alt="" height="80">
   </span>
   <span class="logo-sm">
       <img src="#" alt="" height="16">
   </span>
</a>

<!-- LOGO -->
<a href="#" class="logo text-center logo-dark">
  <span class="logo-lg">
   <img src="#" alt="" height="16">
</span>
<span class="logo-sm">
   <img src="#" alt="" height="16">
</span>
</a>

<div class="h-100 mm-active" id="left-side-menu-container" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">

    <!--- Sidemenu -->
    <ul class="metismenu side-nav mm-show">

        <li class="side-nav-title side-nav-item">Tổng quan</li>

        <li class="side-nav-item mm-active">
            <a href="#" class="side-nav-link active">
                <i class="uil-home-alt"></i>
{{--                <span class="badge badge-success float-right">2</span>--}}
                <span> Trang chủ </span>
            </a>
{{--            <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">--}}
{{--                <li>--}}
{{--                    <a href="#">Đối ngoại</a>--}}
{{--                </li>--}}
{{--                <li class="mm-active">--}}
{{--                    <a href="#" class="active">Nội bộ</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
        </li>
        @if (getRole() === \App\Enums\AdminRoles::from(1)->showRole())
        <li class="side-nav-title side-nav-item">Vùng quản lý</li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-store"></i>
                <span> Đơn đăng ký </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level mm-collapse" aria-expanded="false">
                <li>
                    <a href="#">Đơn chờ duyệt</a>
                </li>
                <li>
                    <a href="##">Lịch sử duyệt</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-store"></i>
                <span> Ngành và Môn học </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level mm-collapse" aria-expanded="false">
                <li>
                    <a href="#">Quản lý</a>
                </li>
                <li>
                    <a href="#">Thêm ngành</a>
                </li>
                <li>
                    <a href="#">Thêm môn</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-store"></i>
                <span> Lớp học </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level mm-collapse" aria-expanded="false">
                <li>
                    <a href="#">Quản lý</a>
                </li>
                <li>
                    <a href="#">Thêm</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-shopping-basket"></i>
                <span> Nhân viên </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level mm-collapse" aria-expanded="false">
                <li>
                    <a href="#">Quản lý</a>
                </li>
                <li>
                    <a href="#">Thêm</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-shopping-cart-alt"></i>
                <span> Giáo viên </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level mm-collapse" aria-expanded="false">
                <li>
                    <a href="#">Quản lý</a>
                </li>
                <li>
                    <a href="#">Thêm</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-clipboard-alt"></i>
                <span> Thống kê </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level mm-collapse" aria-expanded="false">
                <li>
                    <a href="apps-tasks.html">Thu nhập</a>
                </li>
                <li>
                    <a href="apps-tasks-details.html">Học sinh</a>
                </li>
                <li>
                    <a href="apps-kanban.html">Số lớp học</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="####" class="side-nav-link">
            <i class="dripicons-gear"></i>
            <span> Cấu hình </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="###" class="side-nav-link">
            <i class="mdi mdi-history"></i>
            <span> Lịch sử hoạt động </span>
            </a>
        </li>
        @endif

        @if (
            getRole() === \App\Enums\AdminRoles::from(1)->showRole() ||
            getRole() === \App\Enums\AdminRoles::from(0)->showRole()
        )
            <li class="side-nav-title side-nav-item mt-1">Vùng dành cho tư vấn viên</li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-comments-alt"></i>
                    <span> Các đơn đăng ký </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-calcualtor"></i>
                    <span> Lịch sử đơn đăng kí </span>
                </a>
            </li>
        @endif

        @if (getRole() === \App\Enums\UserRoles::from(1)->showRole())
        <li class="side-nav-title side-nav-item mt-1">Vùng dành cho giáo viên</li>

        <li class="side-nav-item">
            <a href="#" class="side-nav-link">
                <i class="uil-comments-alt"></i>
                <span> Lớp học </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="#" class="side-nav-link">
            <i class="uil-calcualtor"></i>
            <span> Đăng ký dạy thêm </span>
            </a>
        </li>
        @endif

        @if (getRole() === \App\Enums\UserRoles::from(0)->showRole())
        <li class="side-nav-title side-nav-item mt-1">Vùng dành cho học sinh</li>

        <li class="side-nav-item">
            <a href="#" class="side-nav-link">
                <i class="uil-comments-alt"></i>
                <span> Lớp học </span>
            </a>
        </li>
        @endif


    </ul>
    <div class="clearfix"></div>

</div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1580px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 415px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
<!-- Sidebar -left -->

</div>
