<style type="text/css">
  
  .tile{
    height: auto;
  }

  .row{
    margin-bottom: 30px;
  }
</style>

<?php

?>

<script type="text/javascript">


  $(document).ready(function(){

    $review_year = $('#review_year');

    $chart = $('#monthly_growth')

    $year = $review_year.val();

    query_string = 'year=' + $year;
    $.getJSON('<?php echo Base_url() ;?>second_timers/graph', query_string, showGraph)


    function showGraph(data, status){

      if(status = 'success')
      {
        //data = jQuery.trim(data)
        var json = data;
    
        json.chart = data.chart;
        json.title = data.title;
        json.subtitle = data.subtitle;
        json.xAxis = data.xAxis;  
        json.yAxis = data.Axis;
        json.tooltip = data.tooltip;
        json.legend = data.legend;
        json.series = data.series;
        json.backgroundColor = data.backgroundColor;

        $chart.highcharts(json);
      }
      else{
        alerts('ERROR! Server didnt return any data.');
      }
    }



    $review_year.change(function(e){
    $year = $review_year.val();

    query_string = 'year=' + $year;
    $.getJSON('<?php echo Base_url() ;?>second_timers/graph', query_string, showGraph)
    function showGraph(data, status){

      if(status = 'success')
      {
        var json = data;
    
        json.chart = data.chart;
        json.title = data.title;
        json.subtitle = data.subtitle;
        json.xAxis = data.xAxis;  
        json.yAxis = data.Axis;
        json.tooltip = data.tooltip;
        json.legend = data.legend;
        json.series = data.series;
        json.backgroundColor = data.backgroundColor;

        $chart.highcharts(json);
      }
      else{
        alerts('ERROR! Server didnt return any data.');
      }
    }
      
  })

  })
</script>



<div class="container">

<!--
    <div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
      <?php //echo  $this->templates->top("Second Timers Monthly Overview", false) ?>
			<div id="chart">
        
      </div>
      <?php //echo $this->templates->top_close(); ?>                          
		</div>
	</div>
  -->

    
         

   <div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
      <?php echo  $this->templates->top("Second Timers Monthly Growth", false) ?>

      <div class="col-xs-4 col-xs-offset-8 col-md-2 col-md-offset-10">
        <select class="form-control" name="review_year" id="review_year">
          <?php
          $year_list = $this->date_time->year_list(10) ;
          foreach ($year_list as  $year) {
            echo "<option value='".$year."'>" .$year. "</option>";
          }
        ?>
        </select>
      </div>
			<div id="monthly_growth">
        
      </div>
      <?php echo $this->templates->top_close(); ?>                           
		</div>
	</div>

     
               
		
</div><!--close container-->