

<style type="text/css">
	
	.well-sm{
		text-align: center;
	}
</style>


<!-- <div class="container-fluid"> -->
	<form action="do_upload" method="POST" enctype="multipart/form-data" />
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-xs-10">
				<?php
                  if(isset($message))
                    echo "<div class='well well-sm'>" .$message. "</div>";
                ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 col-md-offset-2">
				<input type="file" name="userfile" size="20" class="form-control" />
			</div>
	
			<div class="col-md-1">
				<input type="submit" value="upload" name="submit" class="btn btn-default" />
			</div>
		</div>

	</form>
<!--</div>


