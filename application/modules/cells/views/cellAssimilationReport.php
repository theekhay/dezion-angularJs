<script type="text/javascript">
	
	$(document).ready(function(){

		$year = $('#year');
		$month = $('#month');

		$year_val  = $year.val() ;
		$month_val = $month.val() ;


		$month.change( function()
		{
			$query_string = 'year=' + $year_val + '&month=' + $month.val() + '&cell_id=' + <?= $cell_id ;?> ;
			$.get("<?= base_url()?>cells/generateAssimilationReport", $query_string, showData)
			function showData(data){
				$('#data').html(data);
			}
		})


		var get_year_months = function($selected_year)
	    {
	    	$year_val = $selected_year.val();
	    	query_string = "year=" + $year_val ;

	    	$this_month = <?php echo $this->date_time->this_month(); ?>
	      

	      	$.ajax({
		        type : "GET", 
		        data: query_string,
		        dataType : 'json',
		        url : "<?php echo base_url(); ?>date_time/year_months",

		        success: function(data){
		        	$out = "" ;//"<option value='#'>Select Month </option>";
		        	$.each(data, function(k, v){ //k = key, v = value
		        			$out += "<option value="+ v +"> "+ k +"</option>" ;
		        	})

		        	$('#month option').not('#current').remove() ;
		        	$month.append($out) ;
		        }
	      	})
	    }

	    $year.change(function(){
	    	get_year_months($(this)) ;
	    })
		
		
	})
</script>


<div class="container">

	<div class="row">
      <div class="col-md-10 col-md-offset-1 col-xs-12 col-sm-12">
          <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ;?>admin/">Dashboard</a></li>
        <li><a href="<?php echo base_url() ;?>distrcts/">Distrcts</a></li>
        <li><a href="<?php echo base_url() ;?>community/">Communities</a></li>
        <li><a href="<?php echo base_url() ;?>zones/">Zones</a></li>
        <li><a href="<?php echo base_url() ;?>cells/">Cells</a></li>
        <li class="active">Assimilation Reports</li>
      </ol>
      </div>
    </div>

	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
			
			<?= $this->templates->top("$cell_name Cell Assimilation Report", false)?>

				<div class="row">

					<div class="col-md-2 col-md-offset-8 col-xs-3 col-xs-offset-6">
						<select class="form-control" name="year" id="year">
							<option value="">Select Year</option>
							<?php foreach($years as $year): ?>
							<option value="<?= $year?>"><?= $year?></option>
						<?php endforeach;?>

						</select>
					</div>

					<div class="col-md-2 col-xs-3">
						<select class="form-control" name="month" id="month">
							<option value="" id="current">Select Month</option>
							
						</select>
					</div>

				</div>


				<div class="row" id="data">
					
				</div>			
					

			<?= $this->templates->top_close()?>
		</div>
	</div>
</div>