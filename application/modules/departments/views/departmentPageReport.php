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

    var title = { text: "<?php echo $department_name; ?> Report" }
    var subtitle = { text: "Showing General Information about <?php echo $department_name; ?>" }
    

    var xAxis = {
                  categories: ['number of Small Groups', 'number of members'] ,
                  title : {text: ''}
                } ; 

    var yAxis = {
                  title:{text: ''},
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

    var title = { text: "<?php echo "'".$department_name. "'" ?> Monthly membership Growth Overview" }
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
    $dept_avg_membership_growth = $this->mdl_reports->department_percentage_growth($department_id);
    $dept_avg_membership_att  = $this->mdl_reports->department_percentage_attendance($department_id);
    $department_head = ! empty($department_head) ? $this->mdl_members->get_fullname($department_head) : "Not specified";
  ?>

<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-user fa-3x"></i>
      <p class="cell_leader"> <?php echo "Head Of Department : ".$department_head; ?></p>                              
    </div>


    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-group fa-3x"></i>
      <p class="cell_leader"> <?php echo "Number Of Membes : $members_count"; ?></p>                              
    </div> 


    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-line-chart fa-3x"></i>
      <p class="cell_leader"> <?php echo "Avg. Membership growth : $dept_avg_membership_growth% "; ?></p>                              
    </div>

    <div class="col-md-3 col-sm-12 col-xs-6 cell-info">
      <i class="fa fa-calendar-plus-o fa-3x"></i>
      <p class="cell_leader"> <?php echo "Average monthly attendance : $dept_avg_membership_att% "; ?></p>                              
    </div>
 


  </div>


    <!------------------------------ start Row ------------------------------>

    <div class="row" style="margin-top: 20px">   
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $this->templates->top('Genaral Statistics', false); ?>
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
       <div id="monthly_growth">
         
       </div>
      <?php echo $this->templates->top_close(); ?>                            
    </div>
  </div>

  <!------------------------------ end Row ------------------------------>



  <!------------------------------ start Row ------------------------------>

  <div class="row" style="margin-top: 20px">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <?php echo $this->templates->top("small Groups in $department_name", false); 
        $this->load->model('reports/mdl_reports');
        $this->load->model('small_groups/mdl_small_groups');

        $small_groups = $this->mdl_reports->sg_in_department($department_id);
        $count = $small_groups->num_rows();

      ?>

      
      <?php 
        $out = "";
        if($count >= 1){ 

          $out .= "<table class='table table-bordered'>";
          $out .= "<th >Small Group Name</th>";
          $out .= "<th >Small Group Leader</th>";
          $out .= "<th >Avg. percentage attendance</th>";
          $out .= "<th >Avg. percentage growth</th>";

          
          foreach($small_groups->result() as $sg){

            $leader = $this->mdl_members->get_fullname($sg->small_group_leader);
            $percenage_growth  = $this->mdl_reports->overall_average_sg_growth($sg->id);
            $percenage_att  = $this->mdl_reports->overall_average_sg_attendance($sg->id);

            $out .= "<tr>";
            $out .= "<td><a href='".base_url()."small_groups/sg_report/?small_group_id=".$sg->id."'>".$sg->name. "</td>";
            $out .= "<td>".$leader. "</td>";
            $out .= "<td>".$percenage_att. "</td>";
            $out .= "<td>".$percenage_growth. "</td>";
                     
            $out .= "</tr>";

          }
          $out .= "</table>";
        }
        else{

          $out .= "<tr>";
          $out .= "<td> No Small Group in this department. <a href='".base_url()."small_groups/createSmallGroup' class='link'>create Small Group</a> </td>";
          $out .= "</tr>";
        }

        echo $out;
      ?>

       <?php echo $this->templates->top_close(); ?>                            
    </div>

  </div> 

  <!------------------------------ End Row ------------------------------>



    
</div> <!-- end container-->