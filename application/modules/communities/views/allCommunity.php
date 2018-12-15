
    <style type="text/css">

      label{        
        font-weight: normal;
      }

      .row{
        margin-bottom: 20px;
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

    
     $rcc         = $('#records_per_page');
     $panel_search    = $('#panel_search');


    //normal

    var $rcc_val = $rcc.val()
    query_string = "limit=" + $rcc_val; 
    $.get("<?php echo base_url(); ?>communities/all_communities_ajax", query_string, panel_data);

    // end normal

    //keyup
    $panel_search.keyup(function(){

      var $rcc_val = $rcc.val()
      query_string = "limit=" + $rcc_val  ; 

      
      if($panel_search.val() !== null && $panel_search.val() != "" ){
        var $panel_search_val = $panel_search.val();
        query_string += "&search=" + $panel_search_val ;
      }

      $.get("<?php echo base_url(); ?>communities/all_communities_ajax", query_string, panel_data);
      

    })//end keyup


    //change
    $rcc.change(function(){
      var $rcc_val = $rcc.val()
      query_string = "limit=" + $rcc_val; 

      if($panel_search.val() !== null && $panel_search.val() != "" ){
        var $panel_search_val = $panel_search.val();
        query_string += "&search=" + $panel_search_val ;
      }

      $.get("<?php echo base_url(); ?>communities/all_communities_ajax", query_string, panel_data);

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
      $.get("<?php echo base_url(); ?>communities/all_communities_ajax", query_string, panel_data)
      
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
      $.get("<?php echo base_url(); ?>communities/all_communities_ajax", query_string, panel_data)
      
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
      $.get("<?php echo base_url(); ?>communities/all_communities_ajax", query_string, panel_data)
      
    })//end nav_next



        $(document).on('click', '.fa-trash', function(e){
          e.preventDefault();
          id = $(this).attr('value');
          name = $(this).attr('name');
          query_string = 'community_id=' + id;

            $('<div><div>').html("are you sure you want to delete '" + name + "' community ?").dialog({
            buttons : {
              "sure" : function() {
                $.get("<?php echo base_url()?>communities/make_inactive", query_string, feedback);
                $(this).dialog('close');

                function feedback(data){
                  if(data == false)
                    message = "Error executing this operation.";
                  else if(data == true){
                    $('#tr_'+ id).remove();
                    message = "community successfully deleted";
                  }                    
                   else
                    message = 'Fatal Error! conatct admin!'

                  alerts(message, 'Community Delete status');
                  
                }
              
            },
              "Cancel" : function() {
              // code executed when "Cancel" button is clicked
                e.preventDefault();
                $(this).dialog('close');

              }
            },
            'draggable': false,
            'modal': true,
            'show': 'slideDown',
            'hide' : 'slideUp',
            'title': 'Delete Community'
          })

        })


        $(document).on('mouseover', '.table tr', function(){
          $(this).css('background-color', 'rgba(96, 125, 139, 0.21)')
        })

        $(document).on('mouseout', '.table tr', function(){
          $(this).css('background-color', '')
        })

        $('.table tr:odd').css('background-color', 'rgba(96, 125, 139, 0.21);');
      })
    </script>


              
<div class="container-fluid">

  <div class="row">
        <div class="col-md-10 col-md-offset-1 co-xs-12 col-sm-12">
          <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ;?>admin">Admin</a></li>
        <li><a href="<?php echo base_url() ;?>districts">Districts</a></li>
        <li class="active">All Communities</li>
        </ol>
        </div>
      </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

      <?php 
          $this->load->module('templates');

          echo $this->templates->adv_top('communities', 'communities', false);
        ?>
        <div id='panel_data'>
          
        </div>
        
      <?php echo $this->templates->top_close();  //close panel ?>

        
    </div>
  </div>        
</div> 
            

