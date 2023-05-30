<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/jquery-datetimepicker/build/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/toastr/build/toastr.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('backend/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('backend/toastr/build/toastr.min.js') }}"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            margin: 50px auto;
        }


        .ui-dialog .ui-dialog-titlebar-close {
            position: absolute;
            right: .3em;
            top: 50%;
            width: 20px;
            margin: -10px 0 0 0;
            padding: 1px;
            height: 20px;
            outline-style: none;
        }

        .fc-license-message {
            display: none
        }

        .fc-day-today {
            background-color: whitesmoke;
        }

        tr {
            width: 150px;
        }
    </style>
</head>

<body>
    @if (session()->has('success'))
        <script>
            toastr.success('{{ session()->get('success') }}')

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
    @endif

    <div id="dialog" title="Termin Calender" class="card"
        style="box-shadow: rgba(22, 22, 22, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
    </div>

    <div id='calendar'
        style="box-shadow: rgba(26, 26, 128, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
    </div>

    <script src="{{ asset('backend/jquery-clock-timepicker/jquery-clock-timepicker.min.js') }}"></script>
    <script src="{{ asset('backend/fullcalendar-scheduler/dist/index.global.js') }}"></script>

    <script>
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');

            var formHtml = `<form action="{{ route('events.store') }}"
                                     method="POST"
                                    class="ui form"
                                    style="padding:15px;display: none;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
                  @csrf
                <div class="field">
                <label>Event Title</label>
                <input type="text" name="title" placeholder="Enter event title">
              </div>
              <div class="field">
                <label>Start Datetime</label>
                <input class="time" id="start-datepicker" type="text" name="start"/>
              </div>
              <div class="field">
                <label>End Datetime</label>
                <input class="time" id="end-datepicker" type="text" name="end"/>
              </div>
              <div class="field">
                <label>Description</label>
                <textarea name="description" rows="2" id="editor"></textarea>
              </div>
              <button class="ui button" type="submit" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">Create Event</button>
          </form>`;


            $('.card').html(formHtml);

            $(function() {
                $("#start-datepicker").datetimepicker();
                $("#end-datepicker").datetimepicker();
            });

            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'Europe/Berlin',
                locale: 'de',
                slotDuration: '00:30:00', // Increase the slot duration to 1 hour
                slotLabelInterval: '01:00:00', // Increase the interval to 1 hour
                dayHeaderFormat: {
                    weekday: 'long'
                },
                slotMinTime: '07:00:00',
                slotMaxTime: '24:00:00',
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                selectable: true,
                editable: true,
                initialView: 'resourceTimeline',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                resources: [{
                        id: 'a',
                        title: 'Room A',
                        selectable: false,
                        eventColor: 'green',
                        children: [{
                                id: 1,
                                title: 'Room D1',
                                selectable: true
                            },
                            {
                                id: 2,
                                title: 'Room D2',
                                selectable: true
                            }
                        ]
                    },

                    {
                        id: 'b',
                        title: 'Room B',
                        selectable: false,
                        eventColor: 'blue',
                        children: [{
                                id: 3,
                                title: 'Room E1',
                                selectable: true
                            },
                            {
                                id: 4,
                                title: 'Room E2',
                                selectable: true
                            }
                        ]
                    },

                    {
                        id: 5,
                        title: 'Room C',
                        eventColor: 'orrange'
                    }
                ],
                events: [
                    @foreach ($events as $event)
                        {
                            title: '{{ $event->title }} - {{ \Carbon\Carbon::parse($event->start)->timezone('Europe/Berlin')->format('Y-m-d H:i:s') }} - {{ \Carbon\Carbon::parse($event->end)->timezone('Europe/Berlin')->format('Y-m-d H:i:s') }}',
                            start: '{{ \Carbon\Carbon::parse($event->start)->timezone('Europe/Berlin')->format('Y-m-d H:i:s') }}',
                            end: '{{ \Carbon\Carbon::parse($event->end)->timezone('Europe/Berlin')->format('Y-m-d H:i:s') }}',
                            resourceId: '{{ $event->id }}',
                            backgroundColor: 'green'

                        },
                    @endforeach
                ],
                views: {
                    listWeek: {
                        buttonText: 'Display list'
                    },
                    dayGridMonth: {
                        buttonText: 'Display monthly'
                    },
                    timeGridDay: {
                        buttonText: 'Schedule day'
                    },
                    timeGridWeek: {
                        buttonText: 'Schedule weekly'
                    },
                },

                select: function(info) {
                    $("#dialog").dialog({
                        autoOpen: false,
                        height: 480,
                        width: 680,
                        modal: true,
                        title: 'Service schedule'
                    });

                    $("#dialog").dialog("open");
                    $('.ui-dialog-titlebar-close').html('X')
                    $('.card form').show();
                }
            });

            calendar.render();

        });
    </script>

</body>

</html>
