<nav class="navbar navbar-expand-lg bg-white navbar-absolute navbar-transparent">

    <div class="container">
        <div class="dropdown button-dropdown">
            <a href="#pablo" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
                <span class="button-bar"></span>
                <span class="button-bar"></span>
                <span class="button-bar"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-header">Thông tin mở rộng</a>
                <a class="dropdown-item" href="#">Thi thử lý thuyết</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Tin tức</a>
                <a class="dropdown-item" href="#">Liên hệ</a>
            </div>
        </div>
        <div class="navbar-translate">
            <div class="navbar-brand" data-placement="bottom">
                Xem thêm
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" data-nav-image="../img/blurred-image-1.jpg" data-color="orange">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                        <i class="now-ui-icons files_paper" aria-hidden="true"></i>
                        <p>Các ngành học</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../sections.html#headers">
                            <i class="now-ui-icons shopping_box"></i> Lập trình
                        </a>
                        <a class="dropdown-item" href="../sections.html#features">
                            <i class="now-ui-icons ui-2_settings-90"></i> Quản trị mạng
                        </a>
                        <a class="dropdown-item" href="../sections.html#blogs">
                            <i class="now-ui-icons text_align-left"></i> Quản trị hệ thống
                        </a>
                        <a class="dropdown-item" href="../sections.html#teams">
                            <i class="now-ui-icons sport_user-run"></i> Bảo mật
                        </a>
                        <a class="dropdown-item" href="../sections.html#projects">
                            <i class="now-ui-icons education_paper"></i> Và các khóa học khác...
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('explore')}}" target="_blank">
                        <i class="now-ui-icons design_app"></i>
                        <p>Khám phá các môn học</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('app.auth.register')}}" target="_blank">
                        <i class="now-ui-icons design_app"></i>
                        <p>Đăng ký</p>
                    </a>
                </li>
                @if (empty(getAccount()->id))
                <li class="nav-item">
                    <a class="nav-link btn btn-primary" href="{{route('app.auth.view_login')}}">
                        <p>Đăng nhập</p>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-round dropdown-toggle" id="navbarDropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{getName()}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" x-placement="bottom-start"
                            style="position: absolute; transform: translate3d(1px, 48px, 0px); top: 0px; left: 0px; will-change: transform;">
                            @if (getAccount()->is_admin)
                            <a href="#" class="dropdown-item notify-item">
                                @else
                                <a href="{{route('app.user.edit')}}" class="dropdown-item notify-item">
                                    @endif
                                    <i class="mdi mdi-account-circle mr-1"></i>
                                    <span>Tài khoản</span>
                                </a>
                                @if (getAccount()->is_admin)
                                <form action="{{route('admin.auth.logout')}}" method="post">
                                    @else
                                    <form action="{{route('app.auth.logout')}}" method="post">
                                        @endif
                                        @csrf
                                        <a href="" class="dropdown-item notify-item">
                                            <i class="mdi mdi-logout mr-1"></i>
                                            <button class="btn" type="submit"><span>Đăng xuất</span></button>
                                        </a>
                                    </form>


                        </div>
                    </div>
                </li>
                @endif
                <!-- <li class="nav-item">
					<a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
						<i class="fa fa-twitter"></i>
						<p class="hidden-lg-up">Twitter</p>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
						<i class="fa fa-facebook-square"></i>
						<p class="hidden-lg-up">Facebook</p>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
						<i class="fa fa-instagram"></i>
						<p class="hidden-lg-up">Instagram</p>
					</a>
				</li> -->
            </ul>
        </div>
    </div>
</nav>