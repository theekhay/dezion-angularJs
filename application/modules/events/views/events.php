
<head>
  <link rel="stylesheet" href="<?= $demo_path; ?>css/fullcalendar.css" type="text/css">
  <link rel="stylesheet" href="<?= $demo_path; ?>css/fullcalendar.print.css" type="text/css" media='print'>
  <link rel="stylesheet" href="<?= $demo_path; ?>css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="<?= $demo_path; ?>css/dark_blue_adminux.css" type="text/css">
  <link rel="stylesheet" href ="<?= base_url(); ?>library/templates/admin_template/vendors/bootstrap-daterangepicker/daterangepicker.css">

  <script type="text/javascript" src ="<?= base_url(); ?>library/templates/admin_template/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
</head>

<script type="text/javascript">

  $(document).ready(function(){


    function alerts(message, title){
      $('<div></div>').html(message).dialog({
            buttons : {
              "OK" : function() {
                $(this).dialog('close');
              }
            
            },

            'draggable': true,
            'modal' : true,
            'show'  : 'slideDown',
            'hide'  : 'explode',
            'title' : title
          })
    }

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    var calendar = $('#calendar').fullCalendar({
      editable: true,
      header: {

        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
   
      events: "<?= base_url(); ?>events/allEvents",
   
      // Convert the allDay from string to boolean
      eventRender: function(event, element, view) {
        event.allDay =  (event.allDay == 0) ? false : true ;
      },

      selectable: true,
      selectHelper: true,
      select: function(start, end, allDay) {
        var title = prompt('Event Title:');
        
        if (title) {
        var start = moment(start).format('YY/MM/DD');
        var end = moment(end).format('YY/MM/DD');

        $.ajax({
         url: "<?= base_url(); ?>events/newEvent",
         data: 'title='+ title+'&start='+ start + '&end=' + end ,
         type: "POST",
         success: function(json) {
          $message = (json == true ) ? 'Event Created Successfully' : 'Unable to create event at the moment';
          alerts($message, 'status') ;
         }
        });

      calendar.fullCalendar('renderEvent',
      {
       title: title,
       start: start,
       end: end,
       allDay: allDay
     },
     true // make the event "stick"
    );
   }// end if title()
   calendar.fullCalendar('unselect');
   },
   
   editable: true,
   eventDrop: function(event, delta) {
   var start = moment(event.start).format('YYYY/MM/DD');
   var end =  moment(event.end).format('YYYY/MM/DD');
   
   $.ajax({
   url: "<?php echo base_url(); ?>events/updateEvent",
   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
   type: "POST",
   success: function(json) {
      var message = jQuery.parseJSON(json);
      alerts(message.message, 'Event Update status');
   },

   failure: function(json){
      var message = jQuery.parseJSON(json);
      alerts(message.message, 'Event Update status');
   }
   });

   },

   resizable: true,
    eventResize: function(event) {
     var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
     $.ajax({
      url: 'http://localhost:8888/fullcalendar/update_events.php',
      data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
      type: "POST",
      success: function(json) {
      //  var message = jQuery.parseJSON(data);
       //alert(message.message);
      }
     });

  }
   
  });

    $('#date').daterangepicker(function(){

    })

    var test_setInterval = setInterval(function(){

      var calendar = $('#calendar').fullCalendar({

      events: "<?php echo base_url(); ?>events/allEvents",
   
      // Convert the allDay from string to boolean
      eventRender: function(event, element, view) {
        if (event.allDay == 0) {
          event.allDay = false;
        }
        else {
          event.allDay = true;
        }
      }

    })
    }, 10 * 3000)
    
        

  }) // end document.ready()
</script>


  <div class="container mb-4">
    <div class="row">
      <div class="col-sm-16">
        <div id='calendar'></div>
      </div>
    </div>
  </div>
  

<head>

 


  
</head>