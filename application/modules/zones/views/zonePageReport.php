
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

   var chart = { type: 'column'} //bar, column, spline

    var title = { text: "<?php echo $zone_name; ?> Statistics" }
    var subtitle = { text: "<?php echo "'".$zone_name. "'"; ?> General Statistic Overview" }
    

    var xAxis = {
                  categories: ['number of Cells', 'number of members'] ,
                  title : {text: ' '}
                } ; 

    var yAxis = {
                  title:{text: ' '},
                  plotLines:[{ values: 0, width: 1, color:'#808080'}]
                }

    var tooltip = {
                    valueSuffix: ' '
                  }   

    var legend = {
                   layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0
                  } 
    var series =  <?php echo $comm ;?> 

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

    var title = { text: "<?php echo "'".$zone_name. "'" ?> Monthly membership growth Report" }
    var subtitle = { text: "Showing Report for the Month of Jan 01, <?php echo $current_year; ?> to <?php echo $current_month." ". $current_day.", ". $current_year ;?>" }
    

    var xAxis = {
                  categories: <?php echo $categories ;?> ,
                  title : {text: 'Months'}
                } ; 

    var yAxis = {
                  title:{text: 'Number of new members'},
                  plotLines:[{ values: 0, width: 1, color:'#808080'}]
                }


    var tooltip = {
                    valueSuffix: ' person(s)'
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
    $this->load->model('reports/mdl_reports');
    $zone_avg_membership_growth = $this->mdl_reports->zone_percentage_growth($zone_id);
    $zone_avg_membership_att  = $this->mdl_reports->zone_percentage_attendance($zone_id);
    $zonal_leader = ! empty($zonal_leader) ? $this->mdl_members->get_fullname($zonal_leader) : "Not specified";
  ?> 

  <div class="row">

    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-user fa-3x"></i>
      <p class="cell_leader"> <?php echo "Zonal Leader : ".$zonal_leader; ?></p>                              
    </div>


    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-group fa-3x"></i>
      <p class="cell_leader"> <?php echo "Number Of Members : $members_count"; ?></p>                              
    </div> 


    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-line-chart fa-3x"></i>
      <p class="cell_leader"> <?php echo "Average monthly Growth : $zone_avg_membership_growth% " ?></p>                            
    </div>

    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-calendar-plus-o fa-3x"></i>
      <p class="cell_leader"> <?php echo "Average monthly attendance : $zone_avg_membership_att% "; ?></p>                              
    </div>

  </div>


    <!------------------------------ start Row ------------------------------>

    <div class="row" style="margin-top: 20px">   
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $this->templates->top('General Statistics', false); ?> 

      <div id="chart">
        
      </div>
        <?php echo $this->templates->top_close(); ?>                                 
    </div>

  </div>
  <!------------------------------ End Row ------------------------------>

    
         
  <!------------------------------ start Row ------------------------------>

   <div class="row" style="margin-top: 20px">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <?php echo $this->templates->top('Monthly membership Growth Overview', false); ?>

       <div id="monthly_growth"></div>
      <?php echo $this->templates->top_close(); ?>                            
    </div>
  </div>

  <!------------------------------ end Row ------------------------------>



  <!------------------------------ start Row ------------------------------>

  <div class="row" style="margin-top: 20px">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <?php echo $this->templates->top("Cells in $zone_name zone"); 
        $this->load->model('reports/mdl_reports');
        $this->load->model('cells/mdl_cells');

        $cells = $this->mdl_cells->cells_in_zone($zone_id);
        $count = $cells->num_rows();

      ?>

      
      <?php 
        $out = "";
        if($count >= 1){ 

          $out .= "<table class='table table-bordered'>";
          $out .= "<th >Cell Name</th>";
          $out .= "<th >Cell Leader</th>";
          $out .= "<th >Overall membership growth(%)</th>";
          $out .= "<th >Overall percenrage attendance(%)</th>";

          
          foreach($cells->result() as $cell){
            $cell_leader = $this->mdl_members->get_fullname($cell->cell_leader);

            $overall_avg_percentage_attendance = $this->mdl_reports->overall_average_cell_attendance($cell->id);
            $overall_avg_percentage_growth = $this->mdl_reports->overall_average_cell_growth($cell->id);
            

            $out .= "<tr>";
            $out .= "<td><a href='".base_url()."cells/cell_report/?cell_id=".$cell->id."'>".$cell->name. "</td>";
            $out .= "<td>".$cell_leader. "</td>";
            $out .= "<td>".round($overall_avg_percentage_growth, 3)."</td>";
            $out .= "<td>".round($overall_avg_percentage_attendance, 3). "</td>";
                     
            $out .= "</tr>";

          }
          $out .= "</table>";
        }
        else{

          $out .= "<tr>";
          $out .= "<td> No Cell in this Zone. <a href='".base_url()."cells/createCell/?zone_id=".$zone_id."' class='link'>create Cell</a> </td>";
          $out .= "</tr>";
        }

        echo $out;
      ?>

       <?php echo $this->templates->top_close(); ?>                            
    </div>

  </div> 

  <!------------------------------ End Row ------------------------------>



    
</div> <!-- end container-->