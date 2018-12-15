
<style type="text/css">
  
  .tile{
    height: auto;
  }
</style>

<?php
  $this->load->module('date_time');
  $current_month = $this->date_time->this_month_short();
  $current_year  = $this->date_time->full_year();
  $current_day = $this->date_time->this_day();

  $text = "Showing Report for the Month of Jan 01, $current_year to $current_month $current_day, $current_year ";
?>
<script type="text/javascript">
  $(document).ready(function(){

    $chart = $('#chart')

   var chart = { type: 'column'} //bar, column, spline

    var title = { text: "District Report" }
    var subtitle = { text: "District Data Overview" }
    

    var xAxis = {
                  categories: ['number of communities','number of zones','number of cells', 'number of members'] ,
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
    var series = <?php echo $comm_count ;?> 

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

   var chart = { type: 'column'} //bar, column, spline, pie

    var title = { text: "Monthly Districts Mebership Growth" }
    var subtitle = { text: "<?php echo $text ; ?>" }
    

    var xAxis = {
                  categories: <?php echo $categories ;?> ,
                  title : {text: 'Months'}
                } ; 

    var yAxis = {
                  title:{text: 'Number of new members per month'},
                  plotLines:[{ values: 0, width: 1, color:'#808080'}]
                }

    var tooltip = {
                    valueSuffix: ' '
                  }   

    var legend = {
                   layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0
                  } 
    var series = <?php echo $monthly_growth ;?> 

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
</script>



<div class="container">



    <div class="row">
  		<div class="col-md-12 col-sm-12 col-xs-12">
      <?php echo $this->templates->top('General Statistics', false); ?>

			     <div id="chart"></div>
       
        <?php echo $this->templates->top_close(); ?>                          
		  </div>
	 </div>

    
         

   <div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
      <?php echo $this->templates->top('Avg. Monthly Membership Growth', false); ?>

			   <div id="monthly_growth"></div>      

      <?php echo $this->templates->top_close(); ?>
		</div>
	</div> 


  <div class="row" style="margin-top: 20px"> 

      <div class="col-md-12 col-sm-12 col-xs-12">      
        <?php echo $this->templates->top('All Districts Data Overview', false); 

        $this->load->model('reports/mdl_reports');
        $this->load->model('communities/mdl_communities');

          $out ="" ;

          $out .= "<table class='table table-bordered'>";
          $out .= "<th>Name </th>";
          $out .= "<th>District Pastor</th>";
          $out .= "<th>Number of Communities</th>";
          $out .= "<th>Number of Zones</th>";
          $out .= "<th>Number of Cells</th>";
          $out .= "<th>Number of Members</th>";
          $out .= "<th>Overall average % attendance</th>";
          $out .= "<th>Overall average % member growth</th>";
          
          
          $this->load->model('districts/mdl_districts');
          $districts = $this->mdl_districts->all();

          foreach ($districts->result() as $district) {

            $district_pastor = $this->mdl_members->get_fullname($district->district_pastor);
            $out .= "<tr>";
            $out .= "<td><a href='districtPageReport/?district_id=".$district->id."'>".$district->name."</a></td>";
            $out .= "<td>$district_pastor</td>";
            $out .= "<td>". $this->mdl_communities->communities_in_district_count($district->id)."</td>";
            $out .= "<td>". $this->mdl_reports->zones_in_district_count($district->id)."</td>";
            $out .= "<td>". $this->mdl_reports->cells_in_district_count($district->id)."</td>";
            $out .= "<td>". $this->mdl_reports->members_in_district_count($district->id)."</td>";
            $out .= "<td>". $this->mdl_reports->district_percentage_attendance($district->id). "</td>";
            $out .= "<td>". $this->mdl_reports->district_percentage_growth($district->id)."</td>";
            $out .= "</tr>";
          }
           

           $out .= "</table>"; 

           echo $out;
        ?>  

        <?php echo $this->templates->top_close(); ?>                                 
      </div>

  </div>

		
</div><!--close container-->