@extends('layout-dashboard-site.master')
@push('css')
<link href="{{asset('css/fullcalendar/main.css')}}" rel='stylesheet' />
@endpush
@section('content')
<div class="title">
    <h1>Lịch giảng dạy</h1>
</div>
<div class="row">
    <div class="col-md-3">
        <ul class="list-group mt-5">
            @foreach ($classes as $class)
            <form action="{{route('app.calendar',['class_id' => $class->id])}}" method="POST" id="{{$class->id}}">
                @csrf
                <li class="list-group-item">
                    {{$class->name}}
                </li>
            </form>
            @endforeach
        </ul>
        <div class="pagination pagination-rounded mb-0">
            {{$classes->links()}}
        </div>
    </div>
    <div class="col-md-9" id='calendar'></div>
</div>
@endsection
@push('js')
<script src="{{asset('js/fullcalendar/main.js')}}"></script>
<script src="{{asset('js/fullcalendar/main.min.js')}}"></script>
<script type="module">
let calendar;
let calendarEl = document.getElementById('calendar');
$('.list-group-item').data('is_clicked', false);
document.addEventListener('DOMContentLoaded', function() {
    calendar = new FullCalendar.Calendar(calendarEl, {
        eventSources: [],
        initialView: 'dayGridMonth',
        eventTimeFormat: { // like '7 PM'
            hour: 'numeric',
            minute: '2-digit',
            omitZeroMinute: true,
            meridiem: true
        }
    });
    calendar.render();
    return calendar;
});

$('.list-group-item').css('cursor', 'pointer')
    .click(function(e) {
        e.preventDefault();
        let list = $(this);
        let form = list.parent();
        list.data('is_clicked', !list.data('is_clicked'));
        const clicked = function() {

            list.addClass('list-group-item-primary');
            $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    dataType: 'json',
                    data: form.serialize()
                })
                .done(function(data) {
                    let initialDate = data[0].start;
                    let id = data[0].id;
                    calendar.addEventSource({
                        events: data,
                        id: id,
                        color: 'yellow',
                        textColor: 'black'
                    });
                    calendar.gotoDate(initialDate);
                });

        };
        const unclicked = function() {
            list.removeClass('list-group-item-primary');
            let events = calendar.getEventSourceById(form.attr('id'));
            events.remove();

        }

        if (list.data('is_clicked')) {
            clicked();
        } else {
            unclicked();
        }

    })
</script>
@endpush