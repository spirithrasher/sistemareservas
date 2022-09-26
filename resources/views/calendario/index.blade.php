@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/core/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/bootstrap/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/timegrid/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/list/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/lightpick/lightpick.css') }}" rel="stylesheet" />
@endsection
    @section('content')
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title text-white">Calendario</h4>
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            defaultDate: '2022-08-12',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,
            select: function(arg) {
                var title = prompt('Event Title:');
                if (title) {
                calendar.addEvent({
                    title: title,
                    start: arg.start,
                    end: arg.end,
                    allDay: arg.allDay
                })
                }
                calendar.unselect()
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: <?php echo $eventos ?> ,
            eventClick: function(arg) {
                if (confirm('delete event?')) {
                arg.event.remove()
                }
            }
            });

            calendar.render();
        });


        // light_datepick
        new Lightpick({
        field: document.getElementById('light_datepick'),
        inline: true,                
        });
            
    </script>




    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/core/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/timegrid/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/interaction/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/list/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/lightpick/lightpick.js') }}"></script>
    <!-- <script src="{{ URL::asset('assets/js/pages/jquery.calendar.js') }}"></script> -->
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    
@endsection