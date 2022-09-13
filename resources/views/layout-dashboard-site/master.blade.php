<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Trang nhân viên</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="">

    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{asset('css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style" />
    @stack('css')
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
        @include('layout-dashboard-site.components.sidebar')
        <div class="content-page">
            <div class="content">
                @include('layout-dashboard-site.components.header')

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                @yield('breadcrumb')
                            </div>
                        </div>
                    </div>
                    <!-- START CONTENT -->
                    @yield('content')
                    <!-- END CONTENT -->
                </div>
            </div>

            @include('layout-dashboard-site.components.footer')

        </div>

    </div>

    @include('layout-dashboard-site.components.rightsidebar')

    <script src="{{asset('js/admin/vendor.min.js')}}"></script>
    <script src="{{asset('js/admin/app.min.js')}}"></script>
    <!-- <script src="{{asset('js/admin/apexcharts.min.js')}}"></script> -->
    <script src="{{asset('js/admin/component.todo.js')}}"></script>
    <script src="{{asset('js/admin/demo.dashboard-crm.js')}}"></script>
    @stack('js')
</body>

</html>