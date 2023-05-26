<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('backend/fullcalendar-scheduler/dist/index.global.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          selectable: true,
          initialView: 'resourceTimelineMonth',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
          },
          resources: [
            { id: 1, title: 'Teamlead' },
            { id: 2, title: 'Employee' },
            { id: 3, title: 'Customer' }
          ],
          events: [
            {
              title: 'Event 1',
              start: '2023-05-26',
              end: '2023-05-28',
              resourceId: 'a'
            },
            {
              title: 'Event 2',
              start: '2023-05-27',
              end: '2023-05-29',
              resourceId: 'b'
            },
            {
              title: 'Event 3',
              start: '2023-05-28',
              end: '2023-05-30',
              resourceId: 'c'
            }
          ],
          dateClick: function(info) {
            alert('clicked ' + info.dateStr + ' on resource ' + info.resource.id);
          },
          select: function(info) {
            alert('selected ' + info.startStr + ' to ' + info.endStr + ' on resource ' + info.resource.id);
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

</style>
</head>
<body>

  <div id='calendar' style="padding:5px;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;"></div>

</body>
</html>
