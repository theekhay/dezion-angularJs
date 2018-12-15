
<style type="text/css">
  
  .cell-info{
    height: 100px;
   /* background-color: #607D8B; */
    border-right : 3px solid #7fc5bf;
   /* margin-left: 10px; */
    /*margin-right: 10px; */
    text-align: center;
    padding-top: 8px;
    margin-top: 30px;
  }

  .cell-info .fa{
    font-size: 4em;
    color: #00bcd4;
  }

  .cell_leader{
    color: #546E7A;
    padding-top: 5px;
    font-family: verdana;
  }

  .fixed_height_320{
    height: inherit !important;
  }

  #custom_months, #custom_months1, #custom_months2 {
    visibility: hidden;
  }

  .search_row{
    margin-bottom: 5px !important;
  }
</style>

<?php
  
  $this->load->module('date_time');
  $current_month = $this->date_time->this_month_short();
  $current_year  = $this->date_time->full_year();
  $current_day = $this->date_time->this_day();
?>

<script type="text/javascript">
  $(document).ready(function(){

    $chart = $('#chart')

   var chart = { type: 'spline'} //bar, column, spline

    var title = { text: "<?php echo $sg_name; ?> Monthly Membership Growth Report" }
    var subtitle = { text: "Showing Report for the Month of Jan 1 to <?php echo $current_month." ". $current_day.", ". $current_year ;?>" }
    

    var xAxis = {
                  categories: <?php echo $categories ; ?> ,
                  title : {text: 'Months'}
                } ; 

    var yAxis = {
                  title:{text: 'number of new members'},
                  plotLines:[{ values: 0, width: 1, color:'#808080'}]
                }

    var tooltip = {
                    valueSuffix: ' '
                  }   

    var legend = {
                   layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0
                  } 
    var series =  <?php echo $monthly_growth ;?> 

    var backgroundColor  = { backgroundColor:'#78909C'};            

    var json = {};
    
    json.chart = chart;
    json.title = title;
    json.subtitle = subtitle;
    json.xAxis = xAxis;  
    json.yAxis = yAxis;
    json.tooltip = tooltip;
    json.legend = legend;
    json.series = series;
    json.backgroundColor = backgroundColor;

    $chart.highcharts(json);
  })



  $(document).ready(function(){

    $chart = $('#monthly_growth')

   var chart = { type: 'spline'} //bar, column, spline, pie

    var title = { text: "<?php echo "'".$sg_name. "'" ?> Small Group Monthly Meeting Attendance Report" }
    var subtitle = { text: "Showing Report for the Month of Jan 1 to <?php echo $current_month." ". $current_day.", ". $current_year ;?>" }
    

    var xAxis = {
                  categories: <?php echo $categories ; ?> ,
                  title : {text: 'Months'}
                } ; 

    var yAxis = {
                  title:{text: 'Attendance Percentage'},
                  plotLines:[{ values: 0, width: 1, color:'#808080'}]
                }

    var tooltip = {
                    valueSuffix: ' %'
                  }   

    var legend = {
                   layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0
                  } 
    var series = <?php echo $monthly_attendance ;?> 

    var backgroundColor  = { backgroundColor:'#78909C'};            

    var json = {};
    
    json.chart = chart;
    json.title = title;
    json.subtitle = subtitle;
    json.xAxis = xAxis;  
    json.yAxis = yAxis;
    json.tooltip = tooltip;
    json.legend = legend;
    json.series = series;
    json.backgroundColor = backgroundColor;

    $chart.highcharts(json);


    $mmg_overview = $('#mmg_overview');
    $custom_months = $('#custom_months');

     $mmg_overview1 = $('#mmg_overview1');
    $custom_months1 = $('#custom_months1');

    $mmg_overview2 = $('#mmg_overview2');
    $custom_months2 = $('#custom_months2');

    $mmg_overview.change(function(){
      if($(this).val() == 'custom_month'){

        $custom_months.css('visibility', 'visible')
      }else{
        $custom_months.css('visibility', 'hidden')
      }
    })


    $mmg_overview1.change(function(){
      if($(this).val() == 'custom_month'){

        $custom_months1.css('visibility', 'visible')
      }else{
        $custom_months1.css('visibility', 'hidden')
      }
    })


    $mmg_overview2.change(function(){
      if($(this).val() == 'custom_month'){

        $custom_months2.css('visibility', 'visible')
      }else{
        $custom_months2.css('visibility', 'hidden')
      }
    })




  })
</script>



<div class="container">

<?php 
  $this->load->module('small_groups');
  $this->load->module('date_time');
  $this->load->model('reports/mdl_reports');
  $avg_monthly_att = $this->mdl_reports->overall_average_sg_attendance($sg_id);
  $avg_monthly_growth = $this->mdl_reports->overall_average_sg_growth($sg_id); 
  $small_grp_leader = isset($sg_leader) ? $this->mdl_members->get_fullname($sg_leader) : 'Not assigned';

  ?>


<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-user fa-3x"></i>
      <p class="cell_leader"> <?php echo "Small Group Leader : ". $small_grp_leader; ?></p>                              
    </div>


    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-group fa-3x"></i>
      <p class="cell_leader"> <?php echo "Number Of Members : $member_count"; ?></p>                              
    </div> 


    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-line-chart fa-3x"></i>
      <p class="cell_leader"> <?php echo "Average monthly Growth : ".round($avg_monthly_growth). "%"; ?></p>                              
    </div>

    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-calendar-plus-o fa-3x"></i>
      <p class="cell_leader"> <?php echo "Average monthly attendance : " . round($avg_monthly_att, 3). "%" ?></p>                              
    </div>
 


  </div>



    <div class="row" style="margin-top: 20px">   
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $this->templates->top('Monthly membership Growth Overview', false); ?>     
        <div id="chart">
          
        </div>
        <?php echo $this->templates->top_close(); ?>                                 
    </div>
  </div>

    
         

  <div class="row" style="margin-top: 20px">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <?php echo $this->templates->top('test'); ?>

       <div id="monthly_growth">
         
       </div>
      <?php echo $this->templates->top_close(); ?>                            
    </div>
  </div>



  <div class="row" style="margin-top: 20px">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <?php echo $this->templates->top('Monthly Group Members Attendance Report');  
        $this->load->model('members/mdl_members');
      ?>

      <div class='row'>
      <div class="col-md-2 col-sm-3 col-xs-3 p_right ">
        <select class='form-control search_row' id='mmg_overview2'>
          <option value="#">Range</option>
          <option value="this_month">This month</option>
          <option value="last_month">Last Month</option>
          <option value="custom_month">Custom Month</option>
        </select>

        <br />

        <select  name="start_date" title="start date" class="form-control search_row" id="custom_months2" >
        <?php 
        echo $this->date_time->ajax_months(); 
        ?>
      </select>
      </div>
      </div>

      
      <?php 
      $out = "";
      if(! empty($members)){ 

        $out .= "<table class='table table-bordered'>";
        $out .= "<th >Names</th>";

        $this->load->model('sg_attendance_management/mdl_sg_attendance_management');
        $att_dates = $this->mdl_sg_attendance_management->attended_cols();
        foreach ($att_dates as $date) {
          if($this->date_time->this_month($date) == $this->date_time->this_month()  )
          {
            $out .= "<th >$date</th>";
          }
        }

        foreach($members as $member){

          $firstname = $this->mdl_members->get_data_by_id($member, 'firstname');
          $surname   = $this->mdl_members->get_data_by_id($member, 'surname');
          $out .= "<tr>";
          $out .= "<td>".$firstname. " ". $surname. "</td>";

          foreach ($att_dates as $d) {

            if($this->date_time->this_month($d) == $this->date_time->this_month()  )
            {
              $att_stat = $this->mdl_sg_attendance_management->member_att_status($member, $d);

              if($att_stat == '1'){
                $ans = 'present';
              }
              else if($att_stat == '0'){
                $ans = 'absent';
              } 
                
              else if ($att_stat == null){
                $ans = 'not marked';
              }
              else{
                $ans = 'error';
              }
        
              $out .= "<td>".$ans. "</td>";
            }
          }
                     
          $out .= "</tr>";

        }
      }else{
        $out .= "<tr>";
        $out .= "<td> No Member in This Small Group. <a href='".base_url()."sg_members/addMember/?small_group_id=".$sg_id."' class='link'>Add Member</td>";
        $out .= "</tr>";
      }

      echo $out;
        ?>

        </table>

       <?php echo $this->templates->top_close(); ?>                            
    </div>

  </div> 



    
</div> <!-- enc container-->