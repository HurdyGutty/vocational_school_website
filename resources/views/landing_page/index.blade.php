@section('body')

<body class="landing-page">
    @endsection
    @extends('layout.master')
    @section('content')
    <div class="wrapper">
        @include('landing_page.header')
        @include('landing_page.aboutUs')
        @include('landing_page.classes')
        @include('landing_page.testimonies')
        @include('landing_page.contactUs')
        @include('layout.footer')
    </div>
    @endsection