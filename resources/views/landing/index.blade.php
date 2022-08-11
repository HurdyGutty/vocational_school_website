@section('body')

<body class="landing-page">
    @endsection
    @extends('layout-landing-site.master')
    @section('content')
    <div class="wrapper">
        @include('landing.header')
        @include('landing.about')
        @include('landing.classes')
        @include('landing.testimonies')
        @include('landing.contact')
        @include('layout-landing-site.components.footer')
    </div>
    @endsection