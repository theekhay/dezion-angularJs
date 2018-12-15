    <style type="text/css">

      label{        
        font-weight: normal;
      }

      .row{
        margin-bottom: 20px;
      }

      .panel-body .table tr:nth-child(odd){
        background-color: rgba(96, 125, 139, 0.21);
      }

      .panel-body .fa-check {
        padding-right: 0px !important ;
        padding-left: 2px !important; 
        padding-top: 1px !important;
      }

      .panel-body .fa-exclamation{
        padding-right: 8px !important ;
        padding-left: 7px !important ;
      }
      


    </style>
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



        function panel_data(data){
	      $('#panel_data').html(data);
	    }

    
     $rcc         	= $('#records_per_page');
     $panel_search  = $('#panel_search');
     $month         = $('#month');
     $year          = $('#year');
     showSpinner  = $('#showSpinner');



      var get_members = function()
      {
        var $rcc_val   = $rcc.val() ;
        var $month_val = $month.val() ;
        var $year_val  = $year.val() ;

        var modal = $('<div>').dialog({modal:true});
        modal.dialog('widget').hide();

        query_string = "limit=" + $rcc_val + '&month=' + $month_val + '&year=' + $year_val ; 


        if($panel_search.val() !== null && $panel_search.val() != "" ){
          var $panel_search_val = $panel_search.val();
          query_string += "&search=" + $panel_search_val ;
        }

        $.ajax({
          type : "GET", 
          data: query_string, //data here is a JSON encoded data. it should be json_decoded in the server script.
          url : "<?php echo base_url(); ?>second_timers/all_secondtimers_ajax",

          success: function(data){
            panel_data(data) ;
          }, 

          error: function(x, t, m){

            if(t === 'timeout')
            {
              alerts("Request Timed Out. Check your connection and try again", 'message');
            }
            else
            {
              alerts("ERROR! Problem processing Request", 'message')
            }
          },

          beforeSend : function()
          {
            
            $('#ajax_loader').show();
            $('#ajax_loader i').removeClass('hidden') ;
            
            
          }, 
          complete : function()
          {
            modal.dialog('close');
            $('#ajax_loader').hide();
            
          }
        })

      }// end get_members.


      var get_members_for_search = function()
      {
        var $rcc_val = $rcc.val() ;
        var $month_val = $month.val() ;
        var $year_val = $year.val() ;

        query_string = "limit=" + $rcc_val + '&month=' + $month_val + '&year=' + $year_val ; 


        if($panel_search.val() !== null && $panel_search.val() != "" ){
          var $panel_search_val = $panel_search.val();
          query_string += "&search=" + $panel_search_val ;
        }

        $.ajax({
          type : "GET", 
          data: query_string,
          url : "<?php echo base_url(); ?>second_timers/all_secondtimers_ajax",

          success: function(data){
            panel_data(data) ;
          }, 

          error: function(x, t, m){

            if(t === 'timeout')
            {
              alerts("Request Timed Out. Check your connection and try again", 'message');
            }
            else
            {
              alerts("ERROR! Problem processing Request", 'message')
            }
          },

          beforeSend : function()
          {
            showSpinner.addClass('fa-spin');
            showSpinner.addClass('fa-2x');
            showSpinner.addClass('fa-spinner');
          }, 
          complete : function()
          {
            showSpinner.removeClass('fa-spin');
            showSpinner.removeClass('fa-spinner');
          }

        })

      }// end get_members.


      var get_members_for_nav = function($selector)
      {
        var modal = $('<div>').dialog({modal:true});
        modal.dialog('widget').hide()

        var $offset     = $selector.attr('value');
        var $rcc_val    = $rcc.val();
        var $month_val  = $month.val()
        var $year_val   = $month.val()

        query_string = "limit=" + $rcc_val + '&offset=' + $offset + '&month=' + $month_val + '&year=' + $year_val;  

        if($panel_search.val() !== null && $panel_search.val() != "" ){
          var $panel_search_val = $panel_search.val();
          query_string += "&search=" + $panel_search_val ;
        }


        if($panel_search.val() !== null && $panel_search.val() != "" ){
          var $panel_search_val = $panel_search.val();
          query_string += "&search=" + $panel_search_val ;
        }

        $.ajax({
          type : "GET", 
          data: query_string, 
          url : "<?php echo base_url(); ?>second_timers/all_secondtimers_ajax",

          success: function(data){
            panel_data(data) ;
          }, 

          error: function(x, t, m){

            if(t === 'timeout')
            {
              alerts("Request Timed Out. Check your connection and try again", 'message');
            }
          },

            beforeSend : function()
            {
              
              $('#ajax_loader').show();
              $('#ajax_loader i').removeClass('hidden') ;
              
              
            }, 
            complete : function()
            {
              modal.dialog('close');
              $('#ajax_loader').hide();
              
            }

        })

      }// end get_members.

      var get_year_months = function($selected_year, $target)
      {
        $year_val = $selected_year.val();
        query_string = "&year=" + $year_val ;

        $this_month = <?php echo $this->date_time->this_month(); ?>
        

          $.ajax({
            type : "GET", 
            data: query_string,
            dataType : 'json',
            url : "<?php echo base_url(); ?>date_time/year_months",

            success: function(data){
              $out = "" ; //"<option value='#'>Select Month </option>";
              $.each(data, function(k, v){ //k = key, v = value
                
                  $out += "<option value="+ v +"> "+ k +"</option>" ;
                
              })

             
              $target.html($out) ;
            }
          })
      }

   
      get_members() ;

   
      $panel_search.keyup(function(){
        get_members_for_search() ;
      })


      $rcc.change(function(){
        get_members() ;
      })

      get_year_months($year, $month) ;

      $year.change(function(){
        get_year_months($(this), $month) ;
      })


      $month.change(function(){
        get_members() ;
      })


    $(document).on('click', '.nav_limit a', function(e){
      e.preventDefault();
      get_members_for_nav( $(this) ) ; 
    })//end nav_limit


    // for the previous button
    $(document).on('click', '.nav_prev a', function(e){
      e.preventDefault();
      get_members_for_nav( $(this) ) ;  
    })//end nav_previous


    // for the next button
    $(document).on('click', '.nav_next a', function(e){
      e.preventDefault();
      get_members_for_nav( $(this) ) ;
    })//end nav_next



    var page = "<?php echo base_url(); ?>second_timers/rhemas";
   
    $(document).on('click', '.fa-adjust', function(e){
        e.preventDefault();

        $st_id = $(this).attr('value');
        query_string = 'st_id=' + $st_id;

        $.get("<?php echo base_url(); ?>second_timers/is_being_assessed", query_string, assessment_status)
       function assessment_status(data){

        if(data == true) {
          alerts('Second Timer is currently being processed by another Agent. Kindly move on to another First Timer', 'message');
          return;
        }
        else
        {
          $.get("<?php echo base_url(); ?>second_timers/flag_as_being_assessed", query_string);
          $(function ()    {
            $('<div>').dialog({

            modal: true,
            draggable: true,
            resizable: true,
            open: function ()
            {
                $(this).load(page, query_string);
            }, 

            create: function( event, ui ) {
              // Set maxWidth
              $(this).css("maxWidth", "660px");
            },

            close : function(){
              $(this).empty();
             $.get("<?php echo base_url(); ?>second_timers/flag_as_not_assessed", query_string);
            }, 


            height: 800,
            width: 'auto',
            title: 'Second Timers Management ',
            maxWidth: 600,
            fluid: true,

            buttons : {
              "save" : function(){

                $rhema_call_row      = $('#rhema_call_row');           //row that holds the call checkbox;
                $select_service_row  = $('#select_service_row');   //row that holds the select service row.
                $gender_row          = $('#gender_row') ;

                $cell_select         = $('#cell_select');
                $department_select   = $('#department_select');
                $course_select       = $('#course_select');

                $next_step_row       = $('#next_step_row')
                $data = {};

                $data['st_id']        = $st_id ;

                 

                 if($next_step_row.length > 0 ){ //row that holds the list of next steps. shows if firsttimer next step is empty
                    $next_step =  $('#next_step').val(); //service attended
                    $data['next_step'] = $next_step ;
                  }


                  if($select_service_row.length > 0 ){ //row that holds the list of services. if row is empty, that means service has alreday been selected.
                    $service =  $('#service').val(); //service attended
                    

                    if($('#service').prop('disabled') == false)
                    {
                      if($service == '#' || $service == null){
                        alerts('Please select the service attended by the second timer', 'missing service detail');
                        return;
                      }
                      else{
                        $data['service'] = $service ;
                      }
                    }                   
                  }

                  if($rhema_call_row.length > 0 ){
                    $ck =  $('#first_call').prop('checked') //aprreciation call
                    if($ck == true)
                      $data['rhema_call'] = 'true';
                    else
                      $data['rhema_call'] = 'false';
                  }



                  if($gender_row.length > 0)
                  {
                    $gender =  $('input[name=gender]:checked').val() // gender
                    $data['gender'] = $gender;
                  }


                  if($cell_select.length > 0)
                  {
                    $cell = $('#cell').val();
                    $data['cell'] = $cell;
                  }

                  if($department_select.length > 0)
                  {
                    $department = $('#department').val();
                    $data['department'] = $department ;
                  }

                  if($course_select.length > 0)
                  {
                    $course = $('#course').val();
                    $data['course'] =  $course ;
                  }


                  if($comment_row.length > 0)
                  {
                    $comment = $('#comment').val();

                    if($comment != "" && comment != null)
                    {
                      $data['comment'] =  $comment ;
                    }
                    
                  }



                 
                 $.ajax({
                      type : "POST", 
                      data: 'info=' + JSON.stringify($data), //data here is a JSON encoded data. it should be json_decoded in the server script.
                      url : "<?php echo base_url(); ?>second_timers/process",

                      success: function(data){
                        alerts(data, 'message');
                        //close the dialog box here.
                      }, 

                      error: function(){
                        alerts("ERROR! There seems to be an error with the request.", 'message');
                      } 
                  })
              },
              "Cancel" : function(){
                $.get("<?php echo base_url(); ?>second_timers/flag_as_not_assessed", query_string);
                $(this).dialog('close');
              } 

            } //end button
        });
    });
        }
        
       }// end assessment_status


       $('#purpose').tooltip();

      })// end on click for fa-edit


    $(document).on('mouseover', '.table tr', function(){
          $(this).css('background-color', 'rgba(96, 125, 139, 0.21)')
        })

        $(document).on('mouseout', '.table tr', function(){
          $(this).css('background-color', '')
        })

        $('.table tr:odd').css('background-color', 'rgba(96, 125, 139, 0.21)');
         

   })


        
    </script>


              
<div class="container-fluid">

	<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ;?>admin">Admin</a></li>
      <li class="active">Manage Second Timers</li>
    </ol>
    </div>
  </div>

  <?php
      $months = $this->date_time->months();
      $this_month = $this->date_time->this_month();
      $month_name = $this->date_time->full_month_name();
    ?>


  <div class="row">

    <div class="col-xs-4 col-xs-offset-64 col-md-2 col-md-offset-8">
      <select name="year" id="year" class="form-control" >
        <?php
          $year_list = $this->date_time->year_list(10) ;
          foreach ($year_list as  $year) {
            echo "<option value='".$year."'>" .$year. "</option>";
          }
        ?>
      </select>
    </div>

    <div class="col-xs-4 col-md-2 ">
      <select name="month" id="month" class="form-control" >
        <option value="<?php echo $this_month; ?>" > <?php echo $month_name ; ?> </option>
        </select>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <?php echo $this->templates->adv_top('Second Timers', 'second timers', false); ?>
      
        <div id='panel_data'>
          
        </div>
        
      <?php echo $this->templates->top_close();  //close panel ?>       
    </div>
  </div>        
</div> 


            

