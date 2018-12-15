<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php 
      $this->load->module('templates');
      $this->load->module('permissions');
      $this->load->model('admin/mdl_admin');
      $this->load->module('internal_messages');
      $ppic = $this->mdl_admin->getProfilePicture() ;
      $src = (isset($ppic)) ? "library/images/admin_profile_pics/$ppic" : "library/images/admin_profile_pics/user.png" ;
      $page = (isset($page_name)) ? $page_name : "";
      $name_link = (isset($name_link)) ? $name_link : "";
      $rm = $this->internal_messages->recents();
      $recent_messages = ($rm <=0) ? "" : $rm ;

     ?>

    <title><?php if(isset($title)) echo "Dezion | $title"; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ;?>library/templates/admin_template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo base_url() ;?>library/templates/admin_template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- jquery ui -->
    <link rel="stylesheet" href="<?php echo base_url();?>library/jquery-ui/jquery-ui.min.css" >

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ;?>library/templates/admin_template/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url() ;?>library/css/app.css" rel="stylesheet">
    <style type="text/css">

      
    </style>



     <script src="<?php echo base_url() ;?>library/templates/admin_template/vendors/jquery/dist/jquery.min.js"></script>
     <script src="<?php echo base_url() ;?>library/templates/admin_template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url(); ?>library/jquery-ui/jquery-ui.min.js"></script>

     <script type="text/javascript">
       $(document).ready(function(){

          $srp = $('#small_roles_panels');
          $chevron_down = $('#small_roles_panels .fa-chevron-down');
          $chevron_up = $('#small_roles_panels .fa-chevron-up');


          $($chevron_up, $chevron_down).click(function(e){
            $(this).toggleClass('fa-chevron-down');
            $(this).toggleClass('fa-chevron-up');
        })






       })
     </script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

                <div class="col-md-3 left_col"><!-- controls the width left dark  panel -->
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url() ?>admin/" class="site_title"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?php echo base_url(). $src ;?>" alt="..." class="img-circle profile_img img-responsive">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->username; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">


                <!-- Service Settings -->
                  <?php
                    $cat_module = 'service';
                    $this->templates->cat_open('Service Settings', 'fa fa-diamond', $cat_module );
                    $this->templates->link('services','addService', 'Create New Service', '092'); //092
                    $this->templates->link('servoff','link', 'Link Service to Finance', '096'); //096
                    $this->templates->link('services','all', 'Manage Services', '093'); //093
                    $this->templates->cat_close($cat_module);
                  ?>




                  <!-- Offering Settings -->
                  <?php
                    $cat_module = 'finance'; //this module should be changed to "offering"
                    $this->templates->cat_open('Income Settings', 'fa fa-ils', $cat_module );
                    $this->templates->link('finances','addIncomeCategory', 'Create Income Category', '048');
                    $this->templates->link('finances','allFinances', 'Manage Income Categories', '049');
                    $this->templates->cat_close($cat_module);
                  ?>



                  <!-- Expenses Settings -->
                  <?php
                    $cat_module = 'expense';
                    $this->templates->cat_open('Expenses Settings', 'fa fa-exchange', $cat_module );
                    $this->templates->link('expenses','newExpense', 'Create Expense Category', '043'); //43
                    $this->templates->link('expenses','', 'Manage Expense Categories', '044'); //44
                    $this->templates->cat_close($cat_module);
                  ?>




                  <!-- Department Settings -->
                  <?php
                  /*
                    $cat_module = '000';
                    $this->templates->cat_open('Department Settings', 'fa fa-building', $cat_module );
                    $this->templates->link('department','addDepartment', 'Create New Department', '000');
                    $this->templates->link('department','view_all', 'Manage Departments', '000');
                    $this->templates->cat_close($cat_module);
                    */
                  ?>


                  <!-- notification Settings -->
                  <?php
                  /*
                    $cat_module = '000';
                    $this->templates->cat_open('Emails&Sms Settings', 'fa fa-envelope', $cat_module );
                    $this->templates->link('notification','sms', 'Sms Module settings', '000');
                    $this->templates->link('notification','mail', 'Email module Settings', '000');
                    $this->templates->cat_close($cat_module);
                    */
                  ?>


                  <!-- Organization Settings -->
                  <?php
                  /*
                    $cat_module = '000';
                    $this->templates->cat_open('Organization', 'fa fa-globe', $cat_module );
                    $this->templates->link('admin','org', 'Organization Settings', '000');
                    $this->templates->cat_close($cat_module);
                    */
                  ?>


                  <!-- roles Settings -->
                  <?php
                    $cat_module = 'admin';
                    $this->templates->cat_open('Role Management', 'fa fa-dot-circle-o', $cat_module );
                    $this->templates->link('roles','role', 'Create New Role', '004'); //004
                    $this->templates->link('roles','allRoles', 'Manage Roles', '005'); //005
                    $this->templates->cat_close($cat_module);
                  ?>



                   <!-- admin roles Settings -->
                  <?php
                    $cat_module = 'admin';
                    $this->templates->cat_open('manage Admin', 'fa fa-user', $cat_module );
                    $this->templates->link('admin_roles','newAdminRole', 'Assign Role to Admin', '115'); //115
                    $this->templates->link('admin_roles','', 'Manage Admin Roles', '116'); //116
                    $this->templates->link('admin','createNewAdmin', 'Create New Admin', '001'); //001
                    $this->templates->link('admin','manageAdmin', 'Manage Adminstrators', '002'); //002
                    $this->templates->cat_close($cat_module);
                  ?>


                  <?php  

                    $out = "";
              
                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "<li><a><i class='fa fa-gg-circle'></i> Districts <span class='fa fa-chevron-down'></span></a>

                                <ul class='nav child_menu'>
                                  <li><a href='".base_url()."districts/createDistrict'>Create District</a></li>
                                  <li><a href='".base_url()."districts/'>Manage District</a></li>
                                  <li><a href='".base_url()."districts/report'>District Report</a></li>";
                    }


                    if($this->permissions->has_perm('000') == true ) {

                    $out .= "<li><a><i class='fa fa-gg-circle'></i> Communities<span class='fa fa-chevron-down'></span></a>
                                <ul class='nav child_menu'>
                                  <li class='sub_menu'><a href='".base_url()."communities/createCommunity'>Create Communities</a>
                                  </li>
                                  <li><a href='".base_url()."communities/'>Manage Communities</a>
                                  </li>";
                    }


                    if($this->permissions->has_perm('000') == true ) {
                    $out .= "<li><a><i class='fa fa-gg-circle '></i> Zones <span class='fa fa-chevron-down'></span></a>
                                    <ul class='nav child_menu'>
                                      <li class='sub_menu'><a href='".base_url()."zones/createZone'>Create Zone</a>
                                      </li>
                                      <li><a href='".base_url()."zones/'>Manage Zones</a>
                                      </li>";
                    }


                    if($this->permissions->has_perm('000') == true ) {

                    $out .= "<li><a><i class='fa fa-gg-circle'></i> Cells <span class='fa fa-chevron-down'></span></a>
                                        <ul class='nav child_menu'>
                                          <li class='sub_menu'><a href='".base_url()."cells/createCell' >Create Cell</a>
                                          </li>
                                          <li><a href='".base_url()."cells/'>Manage Cells</a>
                                          </li>";
                    }
                  

                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "</ul>
                              </li>";
                    }

                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "</ul>
                              </li>";
                    }

                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "</ul>
                              </li>";
                    }

                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "</ul>
                              </li>";
                    }


                    echo $out ;
                        

              ?>


              <?php  

                    $out = "";
              
                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "<li><a><i class='fa fa-shield'></i> Teams <span class='fa fa-chevron-down'></span></a>

                                <ul class='nav child_menu'>
                                  <li><a href='".base_url()."teams/createTeam'>Create Team</a></li>
                                  <li><a href='".base_url()."teams/'>Manage Team</a></li>
                                  <li><a href='".base_url()."teams/report'>Team Report</a></li>";
                    }


                    if($this->permissions->has_perm('000') == true ) {

                    $out .= "<li><a><i class='fa fa-shield'></i> Departments <span class='fa fa-chevron-down'></span></a>
                                <ul class='nav child_menu'>
                                  <li class='sub_menu'><a href='".base_url()."departments/createDepartment'>Create Department</a>
                                  </li>
                                  <li><a href='".base_url()."departments/'>Manage Departments</a>
                                  </li>";
                    }




                    if($this->permissions->has_perm('000') == true ) {

                    $out .= "<li><a><i class='fa fa-shield'></i> Small Groups <span class='fa fa-chevron-down'></span></a>
                                        <ul class='nav child_menu'>
                                          <li class='sub_menu'><a href='".base_url()."small_groups/createSmallGroup'>Create Small Group</a>
                                          </li>
                                          <li><a href='".base_url()."small_groups/'>Manage Small Groups</a>
                                          </li>";
                    }
                  

                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "</ul>
                              </li>";
                    }

                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "</ul>
                              </li>";
                    }

                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "</ul>
                              </li>";
                    }


                    echo $out ;
                        

              ?>



                  <!-- first_timers -->
                  <?php
                    $cat_module = 'first_timers';
                    $this->templates->cat_open('First Timers', 'fa fa-user-plus', $cat_module);
                    $this->templates->link('first_timers','', 'Manage First Timers', '054'); //054
                    $this->templates->link('first_timers','record', 'Register First Timer', '053'); //053
                     $this->templates->link('first_timers','interactors', 'Interactors', '058');
                     $this->templates->link('first_timers','track', ' Track First Timers', '057'); //057
                     $this->templates->link('first_timers','report', 'First Timers Reports', '057'); //057
                    $this->templates->cat_close($cat_module);
                  ?>



                  <!-- second_timers -->
                  <?php
                    $cat_module = 'second_timers';
                    $this->templates->cat_open('Second Timers', 'fa fa-history', $cat_module);
                    $this->templates->link('second_timers','', 'manage Second Timers', '083'); //086
                    $this->templates->link('second_timers','record', 'Register Second Timer', '082'); //082
                    $this->templates->cat_close($cat_module);
                  ?>


                  <!-- attendance_management -->
                  <?php
                    $cat_module = 'attendance_management';
                    $this->templates->cat_open('Attendance', 'fa fa-calendar-plus-o', $cat_module);
                     $this->templates->link('attendances','', ' Manage Attendance Categories', '011');
                    $this->templates->link('attendances','create', ' Create Attendance Category', '012');
                    $this->templates->link('cell_attendance_management','', ' Cell Attendance', '009');
                    $this->templates->link('sg_attendance_management','', ' Small Group Attendance', '007');
                    $this->templates->cat_close($cat_module);
                  ?>
          
          
                  <!-- pools -->
                  <?php
                    $cat_module = 'pools';
                    $this->templates->cat_open('Pools', 'fa fa-circle-o-notch', $cat_module);
                    $this->templates->link('pools','createPool', ' Create Pool', '074');
                    $this->templates->link('pools','', ' Manage Pools', '075'); // manage pools
                    $this->templates->link('pool_members','record', 'Add Member', '078'); //078
                     $this->templates->link('pool_members',' ', 'Manage Pool Data', '079'); //079
                    $this->templates->cat_close($cat_module);
                  ?>


                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url() ;?>library/templates/admin_template/images/user.png" alt=""><?php echo $this->session->username; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Manage Account</a>
                    </li>

                    <li><a href= "<?php echo base_url();?>admin/changePassword"><i class="fa fa-flag-o pull-right"></i> Change Password</a>
                    </li>
                                        
                    <li><a href= "<?php echo base_url();?>login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </li>
                  </ul>
                </li>



                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green"><?php echo $recent_messages ;?></span>
                  </a>

                  <ul id='menu1' class='dropdown-menu list-unstyled msg_list' role='menu'>



                  <?php

                    $this->load->model('internal_messages/mdl_internal_messages');
                    
                    $admin_id = $this->mdl_admin->get_id_by_username($this->session->username);
                   // echo $admin_id; 
                    $query = $this->mdl_internal_messages->recent_msgs($admin_id, '4');
                    
                    if($query->num_rows() >= 1){
                      
                      foreach($query->result() as $msg){

                        $sender = $msg->sender;
                        $message = $msg->body;
                        $time_sent = $msg->date_sent. " ". $msg->time_sent;
                      
                        $time_diff = $this->date_time->time_diff($time_sent);

                        echo $this->templates->top_message_list($sender, $time_diff, $message);
                      }
                    
                    }
                    else{
                      echo "<p style='margin-top:20px; font-size:20px; margin-left:30px'> No Recent Notification </p>";
                    }
                    ?>

                    <li>
                      <div class='text-center'>
                        <a href='<?php echo base_url() ;?>internal_messages/'>
                          <strong>See All Alerts</strong>
                          <i class='fa fa-angle-right'></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>



              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">

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

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered by Mozallo Technologies</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
   
    <!-- Bootstrap -->
    
   


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url() ;?>library/templates/admin_template/js/custom.js"></script>



  </body>
</html>