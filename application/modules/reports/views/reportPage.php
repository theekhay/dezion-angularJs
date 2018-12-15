<style type="text/css">
	
	.report-box{
		min-height: 170px !important;
		max-height: 170px !important;
		padding: 6px;
		margin-right: 8px;
		
		/* color: #2b23234d; */
		background: rgba(0, 0, 0, 0.65);
    	color: white;
    	
	}

	.test{
		background-image: url("<?php echo base_url(); ?>library/images/wp6.jpg");
		padding-right: 0px;
		margin-right: 8px;
		border: 2px solid #607d8b;
	}


	.report-box a{
		color: white
	}


	.test:hover{
		border: 3px solid #bdbdbd;
		/* background-color: #4DB6AC; */
		background-color: black;
		color: white;
	}

	.report-box .main-heading
	{
		font-family: verdana;
		font-size: 20px;
		color: #2b23234d
	}


	.report-box .mini-heading
	{
		font-style: verdana;
		font-size: 12px;
		color: white;
		padding-top: 110px;
	}

	.cool-green{
		background-color:  #4a9a9a;
	}

	.cool-grey{
		background-color: #607d8b;
	}

	.cool-blue{
		background-color: #00bcd4;
	}

	.main-icon{
		color: #EC407A;
		font-size: 15px;

	}

	.fade{
		background-color: transparent;
	}

	.mini-right{
		float: right;
		padding-top: 95px;
		color: white;
		font-size : 20px
	}



	.mini-left{
		float: left;
		padding-top: 100px;
		padding-bottom: 5px;
		color: white;
		font-size : 20px
	}

	.mini-center{
		text-align: center;
		padding-left: 200px;
    	max-width: 10px;

	}


	.report-layer{
		background-color: #eeeeee;		
		color: white
	}

	.report-cell{
		padding: 10px 10px;
		background-color: #4DB6AC;
		border-top-right-radius: 100px;
		border-bottom-right-radius: 100px;
		width : 100px;

	}

	.main-slide{
		text-align: center;
	}

	.main-slide .fa{
		font-size: 15px
	}

	.main-slide p{
		margin: 10 0 0px !important;
	}

	.slide-data{
		width: 50px;
	}

	p{
		padding: 0 0 0px;
	}

</style>
<script type="text/javascript">
	
	$(document).ready(function(){


		function test()
		{
			$.get("<?php echo base_url(); ?>reports/get_district", query_string, showDistricts);
			function showDistricts(data)
			{
				$('#district_slide').html(data)
			}
		}
	})
</script>


<div class="container-fluid">

	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 report-layer ">	
			<div class="report-cell">
				REPORTS
			</div>				
		</div>
	</div>

	<div class="row">

		<div class="col-lg-6 col-md-4 col-sm-12 col-xs-12 test ">	
		<div class="report-box">
			<span class="main-heading"> Districts </span><i class='fa fa-user fa-2x main-icon' title="number of districts"></i>
		</div>			
			
		</div>


		<div class="col-lg-2 col-md-4 col-sm-12 col-xs-12 test ">
			<div class="report-box">
			
			</div>
		</div>

		<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 test">
			<div class="report-box">
			
			</div>
		</div>
	</div>





	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 test ">
			<div class="report-box">
				<span class="main-heading"> Members </span><i class='fa fa-user fa-2x main-icon' title="number of districts"></i>
				<p><i class='fa fa-map-signs fa-1x mini-heading' title="number of districts">12</i></p>
			</div>			
		</div>


		<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 test">
			<div class="report-box">
				<span class="main-heading"> Zones </span><i class='fa fa-fire fa-2x main-icon'></i>
			</div>
		</div >

		<div class="col-lg-5 col-md-4 col-sm-12 col-xs-12 test ">
			<div class="report-box">
				<span class="main-heading"> Communities </span><i class='fa fa-users fa-2x main-icon'></i>
			</div>	
		</div>
	</div>




	<div class="row">
		<div class="col-lg-6 col-md-4 col-sm-12 col-xs-12 test ">
			<div class="report-box">
				<span class="main-heading"> Teams </span><i class='fa fa-tint fa-2x main-icon'></i>
				<p><i class='fa fa-map-signs fa-2x mini-heading' title="number of districts">12</i></p>
			</div>
		</div>


		<div class="col-lg-2 col-md-4 col-sm-12 col-xs-12 test">
			<div class="report-box">
				<span class="main-heading">  </span>
			</div>	
		</div >

		<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 test">
			<div class="report-box">
				<span class="main-heading"> Departments </span><i class='fa fa-building fa-2x main-icon' title="number of districts"></i>
			</div>
		</div>
	</div>



</div>