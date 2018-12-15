<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ;?>library/templates/admin_template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo base_url() ;?>library/templates/admin_template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- jquery ui -->
    <link rel="stylesheet" href="<?php echo base_url();?>library/jquery-ui/jquery-ui.min.css" >

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ;?>library/templates/admin_template/css/custom.css" rel="stylesheet">

     <script src="<?php echo base_url() ;?>library/templates/admin_template/vendors/jquery/dist/jquery.min.js"></script>
     <script src="<?php echo base_url() ;?>library/templates/admin_template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url(); ?>library/jquery-ui/jquery-ui.min.js"></script>

     <style type="text/css">
      .main_container .top_nav {
        display: block;
            margin-left: 0px
      }


      .row{
        margin-bottom: 30px;
      }

      body{
        
        background-color: rgba(42, 63, 84, 0.04);
      }

      .fa-cog{
            padding-top: 12px;
      }


      h2{
        margin-bottom: 50px;
      }


      .fa-toggle-off, .fa-toggle-on{
        font-size: 27px;
        padding-left: 30px;
      }

      .fa-toggle-on{
        color: green
      }
     </style>
  </head>

  <body class="nav-md">
    <div class="container body">

      <div class="main_container">

        <!-- top navigation -->
        <!--
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
            <span class="fa fa-cog fa-2x"> <label>Settings</label></span>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php //echo base_url() ;?>library/templates/admin_template/images/user.png" alt=""><?php //echo $this->session->username; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Manage Account</a>
                    </li>

                    <li><a href= "<?php //echo base_url();?>admin/changePassword"><i class="fa fa-flag-o pull-right"></i> Change Password</a>
                    </li>
                                        
                    <li><a href= "<?php //echo base_url();?>login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>

        </div>

        -->
        <!-- /top navigation -->


        <!-- page content -->
        <div class="row">
        <div class="col-md-10 col-md-offset-1">

        <!-- top tiles -->
          <div class="row tile_count">
            
            <div id='load_content'>
              <?php         
                $this->load->view($module."/".$view_file);
              ?>
            </div>
          </div>
          <!-- /top tiles -->
          <br />
        </div>
        <!-- /page content -->

        </div>
        </div>

          

        
      
    </div>

    <!-- jQuery -->
   
    <!-- Bootstrap -->
    
   


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url() ;?>library/templates/admin_template/js/custom.js"></script>



  </body>
</html>