
<link rel="stylesheet" href="<?php echo base_url();?>library/bootstrap/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>library/font-awesome/css/font-awesome.min.css" >
	<style type="text/css">
		
		.mar{
			margin-top: 30px ;
		}


		.line
		{
			border-right-color: white !important;
		    border-top-color: white !important;
		    border-left-color: white !important;
		    border-bottom-color: black !important;
		    height: 44px !important;
		    box-shadow: inset 0 1px 1px rgba(0,0,0,0), 0 0 0px rgba(0,0,0,0) !important ;
		}

		.line:focus {
			border-bottom: 3px solid #28c2d5 !important;
		}


		#error{
			margin-top: 50px;
			text-align: center;
			border-color: red 2px solid !important;
		}

		.well-sm {
		    padding: 9px;
		    border-radius: 3px;
		    border: 3px solid #b2325d;
		    background: #F5F5F5;
		}

		#hrLogin{
		    top: 12px;
		    position: relative;
		   	margin-left: 50%;
		   	

		}

		.panel{
			margin-top: 20%
		}

		.last{
			margin-bottom: 50px
		}

	</style>
	
	<div class="container_fluid">	

		<form method="POST" action="<?= $action ;?>" autoComplete='off'   >

			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
					<div class="panel panel-default">
			  			<div class="panel-body">


							<div class="row mar" id='error'>
				                <div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">                 
				                    <?php 
				                    	if(isset($error))
				                    		echo "<div class='well well-sm'>" .$error. "</div>";

				                    	else if ( null !== $this->session->flashdata('message')  ) {
				                    		echo "<div class='well well-sm'>" .$this->session->flashdata('message') . "</div>";
											 
				                    	}

										else{}
				                     ?>
				                </div>
				            </div>


							<div class="row mar">
								<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
									<input type="text" name="username" id="username" value="<?php if(isset($username)) echo $username; ?>"class="form-control line" placeholder="Enter your username or email">	
								</div>
							</div>


							<div class="row mar">
								<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3 ">
									<input type="submit" name="submit" class="btn btn-info btn-lg btn-block" value="Update">	
								</div>
							</div>

							<div class="row mar">
								<div class="col-md-1 col-md-offset-4 col-xs-2 col-xs-offset-3 ">
									<hr /> 
								</div>

								<div class="col-md-2  col-xs-2  ">
									<span id='hrLogin'> OR </span>  
								</div>	
								
								<div class="col-md-1 col-xs-2">
									<hr /> 
								</div>
							</div>


							<div class="row mar last">
								<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3 ">
									<input type="submit" name="login" class="btn btn-success btn-lg btn-block" value="Sign In">	
								</div>
							</div>
						</div>
					</div>		
				</div>	
			</div>	
		</form>
	</div>