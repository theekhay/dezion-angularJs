<script type="text/javascript">
  $(document).ready(function(){

    $chart = $('#chart')

   var chart = { type: 'bar'} //bar, column, spline

    var title = { text: "CELLS" }
    var subtitle = { text: "CELLS Data Overview" }
    

    var xAxis = {
                  categories: ['number of members'] ,
                  title : {text: ''}
                } ; 

    var yAxis = {
                  title:{text: 'average monthly attendance'},
                  plotLines:[{ values: 0, width: 1, color:'#808080'}]
                }

    var tooltip = {
                    valueSuffix: ' '
                  }   

    var legend = {
                   layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0
                  } 
    var series = <?php echo $member_count ;?> 

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

    var title = { text: "District" }
    var subtitle = { text: "Monthly Mebership Growth" }
    

    var xAxis = {
                  categories: ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec' ] ,
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
           <?php //var_dump($comm_count) ?>
			<div id="chart"></div>
           <?php //echo $this->templates->close_panel(); ?>                          
		</div>
	</div>

    
   <?php 
   $this->load->module('templates/mdl_templates');
   echo $this->templates->open_panel('all Districts');
   $out = "";
   $out .= "<div class='row'>";
   	foreach ($cell_names as $c_name) {
   		
   		$out .= "<div class = 'col-md-6 col-sm-12 col-xs-12'>".$c_name. "</div>";
   		
   	}
   	$out .= "</div'>";

   	echo $out ;
   	echo $this->templates->close_panel();
   	

   //	var_dump($district_names)
   ?>      

   <div class="row">
		<div class="col-md-9 col-sm-12 col-xs-12">
           <?php //var_dump($comm_count) ?>
			<div id="monthly_growth"></div>
           <?php //echo $this->templates->close_panel(); ?>                          
		</div>
	</div>                    
		
</div>