
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

        $selected_year = $('#year')

        var get_year_months = function($selected_year)
        {
          $year_val = $selected_year.val();
          query_string = "year=" + $year_val ;

          //$this_month =  $month.val() !== null ? $month.val() : <?php echo $this->date_time->this_month(); ?>
          

            $.ajax({
              type : "GET", 
              data: query_string,
              dataType : 'json',
              url : "<?php echo base_url(); ?>date_time/year_months",

              success: function(data){
                $out = "" ;//"<option value='#'>Select Month </option>";
                $.each(data, function(k, v){ //k = key, v = value
                  if(v != $this_month)
                  {
                    $out += "<option value="+ v +"> "+ k +"</option>" ;
                  }
                })

                $('#month option').not('#current').remove() ;
                $month.append($out) ;
              }
            })
        }


        get_year_months($selected_year);

        $selected_year.change(function(){
          get_year_months($selected_year) ;
        })

       


        $(document).on('mouseover', '.table tr', function(){
          $(this).css('background-color', 'rgba(96, 125, 139, 0.21)')
        })

        $(document).on('mouseout', '.table tr', function(){
          $(this).css('background-color', '')
        })

        $('.table tr:odd').css('background-color', 'rgba(96, 125, 139, 0.21)');
      })
    </script>


    <?php
      $months = $this->date_time->months();
      $this_month = $this->date_time->this_month();
      $month_name = $this->date_time->full_month_name();
      $this_year  = $this->date_time->full_year() ;
    ?>


              
<div class="container-fluid">

<div class="row">
    <div class="col-md-12  co-xs-12 col-sm-12">
        <ol class="breadcrumb co-xs-12 col-sm-12">
      <li><a href="<?php echo base_url();?>admin/">Admin</a></li>
      <li class="active">Track First Timers</li>
    </ol>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <?php 
          $this->load->module('templates');
          echo $this->templates->top('First Timers', 'first timers', false);
        ?>

        <div class="row">
          <div class="col-md-2 col-xs-2 col-md-offset-8 col-xs-offset-8">
            <select name="year" id="year" class="form-control">
              <?php 
                $year_list = $this->date_time->year_list(10) ;

                foreach ($year_list as  $year) {
                  echo "<option value='".$year."'>" .$year. "</option>";
                }
              ?> 
            </select>
          </div>

          <div class="col-md-2 col-xs-2">
            <select name="month" id="month" class="form-control" >
              <option id = 'current' value="<?= $this_month; ?>" > <?= $month_name ; ?> </option>
              
            </select>
          </div>
        </div>
        <div id='panel_data'>
          
        </div>
        
      <?php echo $this->templates->top_close();  //close panel ?>

        
    </div>
  </div>        
</div> 
            

