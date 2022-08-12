@section('body')

<body class="index-page">
    @endsection
    @extends('layout-landing-site.master')
    @section('content')
    <div class="wrapper">
        @include('layout-landing-site.components.navbar')
        @include('explore.components.search')
        @include('explore.components.subject')
    </div>
    @endsection