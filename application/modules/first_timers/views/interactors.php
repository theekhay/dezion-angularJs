
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

      #comment{
        resize: none;
        height: 70px;
        width: 250px;
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
                'height': 'auto',
                'width' : 400,
                'show'  : 'slideDown',
                'hide'  : 'explode',
                'title' : title
              })
        }



        function panel_data(data){
	      $('#panel_data').html(data);
	    }

    
     $rcc         	= $('#records_per_page');
     $panel_search    = $('#panel_search');


      


    //normal

    var $rcc_val = $rcc.val()
    query_string = "limit=" + $rcc_val; 
    $.get("<?php echo base_url(); ?>first_timers/all_prospective_firsttimers_ajax", query_string, panel_data);

    // end normal

    //keyup
    $panel_search.keyup(function(){

      var $rcc_val = $rcc.val()
      query_string = "limit=" + $rcc_val  ; 

      
      if($panel_search.val() !== null && $panel_search.val() != "" ){
        var $panel_search_val = $panel_search.val();
        query_string += "&search=" + $panel_search_val ;
      }

      $.get("<?php echo base_url(); ?>first_timers/all_prospective_firsttimers_ajax", query_string, panel_data);
      

    })//end keyup


    //change
    $rcc.change(function(){
      var $rcc_val = $rcc.val()
      query_string = "limit=" + $rcc_val; 

      if($panel_search.val() !== null && $panel_search.val() != "" ){
        var $panel_search_val = $panel_search.val();
        query_string += "&search=" + $panel_search_val ;
      }

      $.get("<?php echo base_url(); ?>first_timers/all_prospective_firsttimers_ajax", query_string, panel_data);

    })
    //end change


    $(document).on('click', '.nav_limit a', function(e){
      e.preventDefault();

      var $offset = $(this).attr('value');
      var $rcc_val = $rcc.val()
      query_string = "limit=" + $rcc_val + '&offset=' + $offset;  

      if($panel_search.val() !== null && $panel_search.val() != "" ){
        var $panel_search_val = $panel_search.val();
        query_string += "&search=" + $panel_search_val ;
      }
      $.get("<?php echo base_url(); ?>first_timers/all_prospective_firsttimers_ajax", query_string, panel_data)
      
    })//end nav_limit




    // for the previous button
    $(document).on('click', '.nav_prev a', function(e){
      e.preventDefault();

      var $offset = $(this).attr('value');
      var $rcc_val = $rcc.val()
      query_string = "limit=" + $rcc_val + '&offset=' + $offset; 

      if($panel_search.val() !== null && $panel_search.val() != "" ){
        var $panel_search_val = $panel_search.val();
        query_string += "&search=" + $panel_search_val ;
      }
      $.get("<?php echo base_url(); ?>first_timers/all_prospective_firsttimers_ajax", query_string, panel_data)
      
    })//end nav_previous




    // for the next button
    $(document).on('click', '.nav_next a', function(e){
      e.preventDefault();
      
      var $offset = $(this).attr('value');
      var $rcc_val = $rcc.val()
      query_string = "limit=" + $rcc_val + '&offset=' + $offset;  

      if($panel_search.val() !== null && $panel_search.val() != "" ){
        var $panel_search_val = $panel_search.val();
        query_string += "&search=" + $panel_search_val ;
      }
      $.get("<?php echo base_url(); ?>first_timers/all_prospective_firsttimers_ajax", query_string, panel_data)
      
    })//end nav_next 


        $(document).on('mouseover', '.table tr', function(){
          $(this).css('background-color', 'rgba(96, 125, 139, 0.21)')
        })

        $(document).on('mouseout', '.table tr', function(){
          $(this).css('background-color', '')
        })

        $('.table tr:odd').css('background-color', 'rgba(96, 125, 139, 0.21)');

        var $in = "<textarea class='form-control' placeholder='enter your comment' name='comment' id='comment' ></textarea>"


        $(document).on('click','.fa-comment-o', function(e){
          e.preventDefault();
          $first_timer_id = $(this).attr('value');

          $('#ft_form').dialog({
                buttons : {
                  "Save" : function() {
                    $(this).dialog('close');
                    $comment = $('#comment').val();   

                    if($comment == " " || $comment == null){
                      return;
                    }else{                
                    query_string = "comment=" + $comment + '&first_timer_id=' + $first_timer_id  ;
                    
                     $.get("<?php echo base_url(); ?>first_timers/addComment", query_string, comment_status)


                     function comment_status(data){
                        if(data == true)
                          $message = 'Comment added successfully'
                        else if (data == false)
                          $message = 'Oops! comment couldnt be added at the moment. ';
                        else
                          $messge = 'Error carrying out this operation'

                        alerts($message, 'comment commit status');
                     }
                   }
                   
                    
                   
                    
                  },

                  "Cancel" : function(){
                    $(this).dialog('close');
                  }
                
                },

                'resizable': true,
                'width' : 600,
                'height': 400, 
                'draggable': true,
                'modal' : true,
                'show'  : 'slideDown',
                'hide'  : 'explode',
                'title' : "First timers Interactors form"
              })

          $('#purpose').mouseover(function(){
            $(this).tooltip();
        })

        })


        

      })
    </script>


              
<div class="container-fluid">

	<div class="row">
		<div class="col-md-12 co-xs-12 col-sm-12">
			<ol class="breadcrumb">
		  <li><a href="<?php echo base_url()?>admin/"><?php echo "Admin" ;?></a></li>
		  <li><a href="first_timers/"><?php echo "First-timers" ;?></a></li>
		  <li class="active"><?php echo "Interactors"  ;?></li>
		</ol>
		</div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <?php 
          echo $this->templates->adv_top('First Timers',  'first timers', false);
        ?>
        <div id='panel_data'>
          
        </div>
        
      <?php echo $this->templates->top_close(); ?>

        
    </div>
  </div>        
</div> 



<form id='ft_form'>
<a href='#' class="link" id='purpose' title="This helps track and monitor the progress of first timers. NOTE: checking the boxes show a confirmation of the associated process"><i class="fa fa-info-circle fa-2x"></i></a>

<pre>
<p>FIRST TIME : 2016/09/31</p>
<p>SERVICE    : Second Sevice</p>
<p>STATUS     : Prospective</p>
<p>Comment    : shows interest in joining a small group.</p>

</pre>

  <div class="form-inline">
   Agreed to meet? <input type="checkbox" name="" class="form-control">

    Met with Visitor? <input type="checkbox" name="" class="form-control">

    Willing to come a second time? <input type="checkbox" name="" class="form-control">
  </div>

  <textarea name="comment" placeholder="comment by <?php echo $this->session->username. " - ". $this->date_time->now() ; ?>">
    
  </textarea> <i class="fa fa-plus-circle fa-2x" title="add new comment"></i>

  
</form>
            

