<!DOCTYPE html>
<html>
<head>
    <title>Mozallo -</title>

    	<link href="<?= base_url() ;?>library/templates/admin_template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- jquery ui -->
         <link rel="stylesheet" href="<?= base_url();?>library/jquery-ui/jquery-ui.min.css" >

    	<!-- jquery -->
        <script src="<?= $jquery_path ;?>jquery-2.1.4.min.js"></script>

        <!-- jquery ui -->
        <script type="text/javascript" src="<?php echo base_url(); ?>library/jquery-ui/jquery-ui.min.js"></script>

         

        <!-- Angular js -->
        <script src="<?= base_url();?>library/js/angular.min.js" ></script>

        <script src="<?= base_url();?>library/js/angular-route.js" ></script>

        <script src="<?= base_url();?>library/js/test.js" ></script>

    	<!--<script src="<?php // base_url() ;?>library/templates/admin_template/vendors/jquery/dist/jquery.min.js"></script> -->
        <script src="<?= base_url() ;?>library/templates/admin_template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    </head>
    <body>     

	<div id='load_content'>
      <?php         
        $this->load->view($module."/".$view_file);
      ?>
    </div>

  </body>
</html>  