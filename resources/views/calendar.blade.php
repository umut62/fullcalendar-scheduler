<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.css">

    <script src="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('backend/fullcalendar-scheduler/dist/index.global.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    <script>
        $(document).ready(function() {
          var calendarEl = document.getElementById('calendar');

          var formHtml = `<form class="ui form" style="display: none;">
            <div class="field">
                <label>Event Name</label>
                <input type="text" name="event-name" placeholder="Enter event name">
              </div>
              <div class="field">
                <label>Date</label>
                <input type="text" id="datepicker">
              </div>
              <div class="field">
                <label>Location</label>
                <input type="text" name="event-location" placeholder="Enter event location">
              </div>
              <div class="field">
                <label>Description</label>
                <textarea name="event-description" rows="2"></textarea>
              </div>
              <button class="ui button" type="submit">Create Event</button>
          </form>`;

          $('.card').html(formHtml);

          $( function() {
            $( "#datepicker" ).datepicker();
          } );

          var calendar = new FullCalendar.Calendar(calendarEl, {
            selectable: true,
            initialView: 'resourceTimelineMonth',
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'resourceTimelineMonth,timeGridDay'
            },
            resources: [
                { id: 'a', title: 'Room A' },
                { id: 'b', title: 'Room B' },
                { id: 'c', title: 'Room C' }
              ],
            select: function(info) {
              $("#dialog").dialog({
                autoOpen: false,
                height: 480,
                width: 580,
                modal: true,
                title: 'Service schedule'
              });

              $("#dialog").dialog("open");

              $('.ui-dialog-titlebar-close').html('X')

              // Seçim yapıldığında formu görüntüle
              $('.card form').show();
            }
          });

          calendar.render();
        });
    </script>








    </body>

</html>

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
</style>
</head>

<body>



    <div id="dialog" title="Termin Calender" class="card"></div>

    <div id='calendar'></div>

</body>

</html>
