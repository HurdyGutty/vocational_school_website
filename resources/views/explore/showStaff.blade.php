@section('body')

<body class="index-page">
    @endsection
    @extends('layout-landing-site.master')
    @section('content')
    <div class="wrapper">
        @include('layout-landing-site.components.navbar')
        @include('explore.components.searchName')
        @include('explore.components.staffList')
    </div>
    @endsection
    @push('js')
    <script>
    $('.show-account').click(function(e) {
        e.preventDefault();
        let form = $('form.form');
        let card = $('div.card-body');
        $.ajax({
                url: form.attr('action'),
                type: "POST",
                dataType: 'json',
                data: form.serialize()
            })
            .done(function(data) {
                console.log(data);
                console.log(data.birth_year);
                card.find('h4.name').text(data.name);
                card.find('p.info').text((data.gender == 1 ? 'Nam' : 'Nữ') + ', ' + (new Date()
                    .getFullYear() - data.birth_year) + ' tuổi');
                card.find('span.students_count').text(data.student_count ?? 0);
            });
    })
    </script>
    @endpush