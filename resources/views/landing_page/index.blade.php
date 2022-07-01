@section('body')

<body class="landing-page">
    @endsection
    @extends('layout-landing-site.master')
    @section('content')
    <div class="wrapper">
        @include('landing_page.header')
        @include('landing_page.about')
        @include('landing_page.classes')
        @include('landing_page.testimonies')
        @include('landing_page.contact')
        @include('layout-landing-site.footer')
    </div>
    @endsection
