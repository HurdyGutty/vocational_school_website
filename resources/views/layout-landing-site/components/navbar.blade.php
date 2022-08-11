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
            <a class="navbar-brand" href="#pablo" rel="tooltip" title="Designed by Invision. Coded by Creative Tim"
                data-placement="bottom" target="_blank">
                Xem thêm
            </a>
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
                    <a class="nav-link" href="{{route('app.auth.view_login')}}" target="_blank">
                        <i class="now-ui-icons design_app"></i>
                        <p>Đăng ký lớp</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.html" target="_blank">
                        <i class="now-ui-icons design_app"></i>
                        <p>Đăng ký giảng dạy</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary" href="{{route('app.auth.view_login')}}">
                        <p>Đăng nhập</p>
                    </a>
                </li>
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