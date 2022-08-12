@section('body')

<body class="index-page">
    @endsection
    @extends('layout-landing-site.master')
    @section('content')
    <div class="wrapper">
        @include('layout-landing-site.components.navbar')
        @include('explore.components.header')
        @include('explore.components.searchClass')
        @include('explore.components.classes')
    </div>
    @endsection