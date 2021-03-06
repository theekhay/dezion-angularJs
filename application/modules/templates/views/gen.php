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
	  <script type="text/javascript" src="<?php echo base_url(); ?>library/highcharts/js/highcharts.js"></script>

     <script type="text/javascript">
       $(document).ready(function(){


        function alerts(message, title){
          $('<div></div>').html(message).dialog({
                buttons : {
                  "OK" : function() {
                    $(this).dialog('close');
                  }
                
                },

                'draggable': true,
                'modal' : true,
                'show'  : 'slideDown',
                'hide'  : 'explode',
                'title' : title
              })
        }
        
        

          $('.date').datepicker({dateFormat: 'yy-mm-dd', changeYear : true, showMonth : true });

          $('.dob').datepicker({dateFormat: 'mm-dd', showMonth : true });

          $('.dob').focus(function(){
            $(this).datepicker({ dateFormat: 'mm-dd', showMonth : true });
          })

          $('.side-menu li a').mouseover(function(){
            $(this).css('color', 'black');
          })

          $('.side-menu li a').mouseout(function(){
            $(this).css('color', 'white');
          })


          $(document).on("mouseover", '.ttip', function(){
              $(this).tooltip();
          })


          function check(){

            $input = $('input');
            $input.each(function(e){
              $parentRow = $(this).closest($row);
              $parentExc = $parentRow.find($exc);

              if($('.row .exc').length >= 1 ){
                $('.row .exc').remove();
              }
            })
          }


          function error_process($selector, $title = null)
          {
            var $parentRow = $selector.closest($row)
            $parentRow.append($error_mark);
            $parentRow.find($('.exc')).addClass('ttip')
            $parentRow.find($('.exc')).attr('title', $title);
          }


          function removeExc($selector)
          {
            if($selector.val() != "#" && $selector.val() != null && $selector.val() != "" ){
               $selector.closest($row).find($('.exc')).remove()
            }
          }


          /*
          * function to make jQuery UI dialog box responive
          * should be replicated across all major templates.
          */
          function fluidDialog() {

            var $visible = $(".ui-dialog:visible");
            // each open dialog
            $visible.each(function () {
                var $this = $(this);
                var dialog = $this.find(".ui-dialog-content").data("ui-dialog");
                // if fluid option == true
                if (dialog.options.fluid) {
                    var wWidth = $(window).width();
                    // check window width against dialog width
                    if (wWidth < (parseInt(dialog.options.maxWidth) + 50))  {
                        // keep dialog from filling entire screen
                        $this.css("max-width", "90%");
                    } else {
                        // fix maxWidth bug
                        $this.css("max-width", dialog.options.maxWidth + "px");
                    }
                    //reposition dialog
                    dialog.option("position", dialog.options.position);
                }
            });
          }



          $(window).resize(function(){
            fluidDialog();
          })


          $(document).on('dialogOpen', ".ui-dialog", function(event, ui){
            fluidDialog();
          })




          name_search = function(name, $target_input){

          if(name.length >= 4){

              $.ajax({
                type : "GET", 
                data: 'name=' + name, 
                url : "<?php echo base_url(); ?>members/member_search",
                timeout : 30000 , //30 secs.

                success: function(data){

                  $('#member_suggest').html(data);

                  $('#member_suggest a').click(function(e){
                    e.preventDefault() ;
                    var fullname = $(this).attr('name')
                    $target_input.val(fullname);
                    $('#member_suggest').html('')
                  })
                }, 

                error: function(x, t, m){

                  (t === 'timeout') ? alerts("Request Timed Out. Check your connection and try again", 'Feedback') : alerts("ERROR! Problem processing Request", 'message');
                },

                beforeSend : function()
                {
                  showSpinner.addClass('fa-spin');
                  showSpinner.addClass('fa-2x');
                  showSpinner.addClass('fa-spinner');
                }, 
                complete : function()
                {
                  showSpinner.removeClass('fa-spin');
                  showSpinner.removeClass('fa-spinner');
                } 
            }) //end ajax.
          }
        }
        

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

                  <!-- Members -->
                  <?php
                    $cat_module = 'members';
                    $this->templates->cat_open('Manage Members', 'fa fa-group',$cat_module );
                    $this->templates->link('members','add_member', 'Member registeration', '064'); //064
                    $this->templates->link('members','all_members', 'Manage Members', '065'); //065
                    $this->templates->cat_close($cat_module);
                  ?>



                  <!-- Services -->
                  <?php
                    $cat_module = 'service';
                    $this->templates->cat_open('Manage Services', 'fa fa-diamond', $cat_module);
                    $this->templates->link('service','newServiceRecord', 'New Sevice Record', '088'); //088
                    $this->templates->link('services','addService', 'New Sevice Category', '092'); //092
                    $this->templates->link('services','all', 'Manage Sevice Category', '093'); //093
                    $this->templates->cat_close($cat_module);
                  ?>
                  
            

                  <!-- Expenses -->
                  <?php
                    $cat_module = 'expense';
                    $this->templates->cat_open('Manage Expenses', 'fa fa-exchange', $cat_module);
                    $this->templates->link('expense','new_expense', 'New Expense Record', '113'); //113
                    $this->templates->link('expenses','newExpense', 'Create Expense Category', '043'); //043
                    $this->templates->link('expenses','allExpenses', 'Manage Expense Category', '044'); //044
                    $this->templates->link('expense','report', 'View Expense Reports', '047'); //047
                    $this->templates->cat_close($cat_module);
                  ?>

                  


                  <!--  Workers -->
                  <?php
                  /*
                    $cat_module = 'workers';
                    $this->templates->cat_open('Manage Workers', 'fa fa-street-view', $cat_module);
                    $this->templates->link('workers','addWorker', 'Register New Worker', '008');
                    $this->templates->link('workers','allWorkers', 'View Workers', '019');
                    $this->templates->cat_close($cat_module);
                    */
                  ?>


                  <!-- Events -->
                  <?php
                    $cat_module = 'events';
                    $this->templates->cat_open('Manage Events', 'fa fa-crosshairs', $cat_module);
                    $this->templates->link('events','event', 'View Calendar', '039'); //039
                    $this->templates->cat_close($cat_module);
                  ?>


                  <!-- notification -->
                  <?php
                    $cat_module = 'notification';
                    $this->templates->cat_open('Emails & Sms', 'fa fa-envelope', $cat_module);
                    $this->templates->link('notification','sms', 'Send Messages', '073'); //073
                    $this->templates->link('notification','mail', 'Send emails', '073'); //073
                    $this->templates->cat_close($cat_module);
                  ?>



                  <!-- Report & Statistics -->
                  <?php
                  /*
                    $cat_module = 'reports';
                    $this->templates->cat_open('Report Generation', 'fa fa-bar-chart-o', $cat_module);
                    $this->templates->link('report','all', 'Generate Reports', '028');
                    $this->templates->cat_close($cat_module);
                    */
                  ?>



                  <?php
                  /*
                    $cat_module = 'departments';
                    $this->templates->cat_open('Departments', 'fa fa-gg-circle', $cat_module );
                    $this->templates->link('departments','createDepartment', 'Create Department', '028');
                    $this->templates->link('departments','', 'Manage Department', '029');
                    $this->templates->link('departments','report', 'Groups', '001');
                    $this->templates->cat_close($cat_module);
                    */
                  ?>



            
                  <!-- General Settings -->
                  <?php

                    $cat_module = '000';
                    $this->templates->cat_open('General Settings', 'fa fa-gear', $cat_module);
                    $this->templates->link('admin','settings', 'General Settings', '000');
                    $this->templates->cat_close($cat_module);
                  ?>




                  




                  <?php  

                    $out = "";
              
                    if($this->permissions->has_perm('000') == true ) {

                      $out .= "<li><a><i class='fa fa-gg-circle'></i> Districts <span class='fa fa-chevron-down'></span></a>

                                <ul class='nav child_menu'>
                                  <li><a href='".base_url()."districts/createDistrict'>Create District</a></li>
                                  <li><a href='".base_url()."districts/'>Manage Districts</a></li>
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
                                  <li><a href='".base_url()."teams/'>Manage Teams</a></li>
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
                    $this->templates->link('first_timers','', 'Rhema Centre', '054'); //054
                    $this->templates->link('first_timers','record', 'Register First Timer', '053'); //053
                     $this->templates->link('first_timers','manage', 'Manage First Timers', '058');
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
                    $this->templates->link('second_timers','report', 'Second Timers Reports', 'xxx'); //057
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



                   <?php
                    $cat_module = 'schools';
                    $this->templates->cat_open('Schools & Levels', 'fa fa-institution', $cat_module);
                    $this->templates->link('schools','', ' Manage Schools', 'xxx');
                    $this->templates->link('schools','createSchool', 'Create School', 'xxx'); 
                    $this->templates->link('levels','', 'Create Levels', 'xxx'); //079
                    $this->templates->link('school_level_attendance','linkAttendance', 'Link Attendance', 'xxx'); //079
                    $this->templates->link('students','registerStudent', 'Register Student', 'xxx'); //078
                    $this->templates->link('school_sessions','manageSessions', 'Manage School Sessions', 'xxx'); //079
                    $this->templates->link('school_sessions','addSession', 'Create new session', 'xxx'); //079
                    $this->templates->link('school_attendance','create', 'Create School Attendance', 'xxx'); //079
                    $this->templates->link('school_level_attendance','linkAttendance', 'Link Attendance', 'xxx'); //079
                    $this->templates->link('student_marks','recordScores', 'Upload Scores', 'xxx'); //079
                    $this->templates->cat_close($cat_module);
                  ?>

                

                  <!-- help and support -->
                  <?php
                  /*
                    $cat_module = 'settings';
                    $this->templates->cat_open('Help & Support', 'fa fa-question-circle-o', $cat_module);
                    $this->templates->link('admin','settings', 'Report Error', '029');
                    $this->templates->cat_close($cat_module);
                    */
                  ?>

                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top"   title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
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
                   
                    <li><a href= "<?php echo base_url();?>Admin/changePassword"><i class="fa fa-flag-o pull-right"></i> Change Password</a>
                    </li>

                    <li><a href= "<?php echo base_url();?>Admin/Upload_profile_pics"><i class="fa fa-flag-o pull-right"></i> Edit profile Pics</a>
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
               if(isset($top_data)) {
                  $out ="";
                  $out .= "<div class='row' id='domain_top_row'>";
                  $out .= "<div class='col-md-4 col-sm-8 col-xs-8'> <span class='domain'>" .$top_data. "</span> <i class='fa $icon_class fa-2x'></i></div>";
                  
                  echo $out;

                }
             ?> 
              
                           
          <div class='col-md-1 col-md-offset-7 col-xs-1 col-xs-offset-1 col-sm-1 col-sm-offset-2 add_domain'>
              <?php
                $link = "";
               if(isset($add_btn)){
                  if($add_btn == true)
                  {
                    $link .= "<a href='".$btn_link."'><i class='fa fa-plus-square fa-3x' title='". $btn_title. "'></i></a>";
                  }
                }
                echo $link;

              ?>                                                               
              </div>
               
              </div>
              <?php         
                $this->load->view($module."/".$view_file);
              ?>
            </div>

          <!-- /top tiles -->
          <br />
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered by Mozallo Technolgies</a>
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

<div id="ajax_loader" style="position: fixed; top:50%" class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-6">
      <i class="fa fa-spin fa fa-spinner hidden" style="font-size: 50px;"></i>
    </div>

