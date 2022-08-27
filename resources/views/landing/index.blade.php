@section('body')

<body class="landing-page">
    @endsection
    @extends('layout-landing-site.master')
    @section('content')
    <div class="wrapper">
        @include('layout-landing-site.components.navbar')
        @include('landing.components.header')
        @include('landing.components.about')
        @include('landing.components.classes')
        @include('landing.components.testimonies')
        @include('landing.components.contact')
        @include('layout-landing-site.components.footer')
    </div>
    @endsection