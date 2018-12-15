<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="theme-color" content="#317EFB"/>
		<meta name="keywords" content="dezion, management, church, members, services, attendance, lightweight, application, solution "/>
		<meta name="description" content="Deizon is a Lightweight management solution that helps both growing and established organizations
		manage smoothly the day-to-day operations of the organization">
		<meta name="author" content="">
		<link rel="icon" href="<?= $demo_path; ?>css/images/favicon.png"> 

		<title>Dezion - <?= isset($title) ? $title : "" ?></title>

		<!-- ngDialog -->
		<link rel="stylesheet" href="<?= $lib_path; ?>js/ng-dialog/css/ngDialog.min.css">
		<link rel="stylesheet" href="<?= $lib_path; ?>js/ng-dialog/css/ngDialog-theme-default.min.css">

		<!-- Datepicker -->
		<link rel="stylesheet" href="<?= $lib_path; ?>js/ng-datepicker/dist/angular-datepicker.min.css">

		<!-- Fontwesome -->
		<link rel="stylesheet" href="<?= $fontawesome_path ?>">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="<?= $demo_path; ?>css/bootstrap.css" type="text/css"> 
		<!-- <link rel="stylesheet" href="css/bootstrap4.css" type="text/css"> -->

		<link rel="stylesheet" href="<?= $demo_path; ?>css/responsive.dataTables.min.css" type="text/css">
		<link rel="stylesheet" href="<?= $demo_path; ?>css/jquery-jvectormap-2.0.3.css" type="text/css">
		<link rel="stylesheet" href="<?= $demo_path; ?>css/tweaked-tables-forms-buttons.css" type="text/css">
		<link rel="stylesheet" href="<?= $demo_path; ?>css/dark_blue_adminux.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="<?= $lib_path ;?>demo/admin/css/custom-ui-widget.css"> 

		<!-- ng Animation -->
		<link rel="stylesheet" href="<?= $lib_path; ?>ngAnimate/css/ng-animation.css" type="text/css">

		 <!-- jquery ui -->
         <link rel="stylesheet" href="<?= base_url();?>library/jquery-ui/jquery-ui.min.css" >

        <style type="text/css">
         
			.form-control:focus {
			    color: #009688 !important;
			    border-color: #dfe6fc !important;
			    background-color: transparent;
			}

			.card-title{
				color: #F4511E !important;
    			font-weight: 300 !important ;
			}

			#member_suggest{
	        background-color: rgba(174, 146, 146, 0.12);
	        color: black;
	        font-size: 16px;
	        overflow: auto;
	        max-height: 200px;
	         text-align: center;
	      }

	      textarea{
	      	resize: none;
	      	max-height: 380px ;
	      }

	      tr td a.btn.btn-link.btn-sm {
			   background: #3d5293 !important;
			   color: #eaecf0 !important;
			}

			.form-group.row .btn-outline-primary {
    			background-color: transparent !important;
    		}

    		.danger{
    			color: #EC407A ;
    		}

    		.success{
    			color: #AED581 ;
    		}

    		.card-block{
    			overflow: auto;
    		}

    		.ngdialog.ngdialog-theme-default .ngdialog-content{
    			margin-top: 10px;
    			/*text-align: center*/;
    		}

    		.my-tabs, .ui-tabs .ui-tabs-nav{
    			background: rgb(37, 45, 71) !important ;
    		}

    	
	 
	
        </style>

        <!-- <base href="<?= base_url() ?>" /> -->

	</head>

	<body class="rounded menuclose menuclose-right" data-ng-app="test">
	 
	 <!-- INSERT HEADER PARTIAL HERE -->
		<header class="navbar-fixed">
		  	<nav class="navbar navbar-toggleable-md navbar-inverse bg-faded">

		    	<div class="sidebar-left"> <a class="navbar-brand" href="<?= $demo_path; ?>index.html">
		    		<span class="fa fa-ravelry"></span> <span class="hidden-sm-down">Dezzion</span> </a>
		      		<button class="btn btn-link icon-header mr-sm-2 pull-right menu-collapse" ><span class="fa fa-bars"></span></button>
		    	</div>

		    	<form class="form-inline mr-sm-2  pull-left search-header hidden-md-down">
		      		<input class="form-control " type="text" placeholder="Search" id="search_header">
		      		<button class="btn btn-link icon-header " type="submit"><span class="fa fa-search"></span></button>
		    	</form>

		    	<div class="d-flex mr-auto"> &nbsp;</div>
		    		<ul class="navbar-nav content-right">
		      			<li class="v-devider"></li>
		      			<li class="nav-item active">
		        			<button class="btn btn-link icon-header "  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        				<span class="fa fa-envelope-o"></span> <span class="badge-number bg-success"></span>
		        			</button>

		        			<!-- message controller should be here -->
		        			<div class="dropdown-menu message-container">
		          				<div class="list-unstyled"> 
			          				<a href="#!/messages" class="media"> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>	css/images/user-header.png" alt="Generic user image"></span>
			            				<div class="media-body">
			              					<h6 class="mt-0 mb-1">Admin</h6>
			              					Test Message.
			              				</div>
			            			</a>

						             
						        </div>
		        			</div>
		      			</li>

		      			<li class="nav-item">
		        			<button class="btn btn-link icon-header badgeCircle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-bell-o"></span><span class="badge-number bg-danger"></span></button>
	        				<div class="dropdown-menu message-container">
	          					<div class="list-unstyled">
						            <div class="media"> <span class="alert-block bg-primary"><span class="fa fa-bullhorn"></span>
						            	</span>
						              	<div class="media-body"><b>1 day ago</b> Hurray!!! Dezion has gone live
						              	</div>
						            </div>

						           <!--  <div class="media"> <span class="alert-block bg-warning"><span class="fa fa-bell-o"></span></span>
						              <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
						            </div> -->

	          					</div>
	        				</div>
		      			</li>


				      	<!-- <li class="nav-item hidden-xs-down">
				        	<button class="btn btn-link icon-header " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-th"></span> </button>
				        	<div class="dropdown-menu message-container box-links">
				          		<div class="list-unstyled"> <a href="<?= $demo_path; ?>index.html" class="media"> <span class="quick-block "><span class="fa fa-bullhorn"></span></span> </a> <a href="<?= $demo_path; ?>index.html" class="media"> <span class="quick-block "><span class="fa fa-bell-o"></span></span> </a> <a href="<?= $demo_path; ?>index.html" class="media"> <span class="quick-block "><span class="fa fa-calendar"></span></span> </a> <a href="<?= $demo_path; ?>index.html" class="media"> <span class="quick-block "><span class="fa fa-id-card"></span></span> </a> <a href="<?= $demo_path; ?>index.html" class="media"> <span class="quick-block "><span class="fa fa-handshake-o"></span></span> </a> <a href="<?= $demo_path; ?>index.html" class="media"> <span class="quick-block "><span class="fa fa-camera-retro"></span></span> </a> <a href="<?= $demo_path; ?>index.html" class="media"> <span class="quick-block "><span class="fa fa-flask"></span></span> </a> <a href="<?= $demo_path; ?>index.html" class="media"> <span class="quick-block "><span class="fa fa-plane"></span></span> </a> <a href="<?= $demo_path; ?>index.html" class="media"> <span class="quick-block "><span class="fa fa-pie-chart"></span></span> </a> </div>
				        	</div>
				      </li> -->
		      <li class="v-devider"></li>
		      <li class="nav-item "> <a class="btn btn-link icon-header menu-collapse-right" href="#"><span class="fa fa-podcast"></span> </a> </li>
		    </ul>
		    <div class="sidebar-right pull-right " ng-controller="getAdminDetails">
		      <ul class="navbar-nav  justify-content-end">
		        <li class="nav-item">
		          <button class="btn-link btn userprofile"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="userpic"><img src="<?= $demo_path; ?>css/images/user-header.png" alt="user pic"></span> <span class="text"><?= $this->session->username ; ?></span></button>
		          <div class="dropdown-menu"> <a class="dropdown-item" href="#!/admin/profile">Profile</a> <a class="dropdown-item" href="#!/admin/changePassword">Change Password</a>
		            <div class="dropdown-divider"></div>
		            <a class="dropdown-item" href="#">Setting</a>
		            <a class="dropdown-item" href="<?= base_url() ?>api/logout">Logout</a>
		             </div>
		        </li>
		      </ul>
		    </div>
		  </nav>
		</header>


		<!-- INSERT LEFT SIDEBAR HERE -->
		<div class="sidebar-left">
		  <div class="user-menu-items">
		    <div class="list-unstyled btn-group">
		      <button class="media btn btn-link dropdown-toggle"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>css/images/user-header.png" alt="Generic user image"></span>
		      <span class="media-body"> <span class="mt-0 mb-1"><?= $this->session->username ; ?></span>
		        <span>Gbagada, NG</span> </span>
		      </button>
		      <div class="dropdown-menu"> <a class="dropdown-item" href="#!/admin/profile">Profile</a> <a class="dropdown-item" href="#!/messages">Mailbox</a>
		    </div>
		    </div>
		  </div>
		  <br>
		  <ul class="nav flex-column in" id="side-menu">
		    <li class="nav-item "> <a href="#!/dashboard" class="nav-link">Dashboard</a>
		    </li>
		    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Manage Members<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="nav-item"><a  href="#!/members" class="nav-link ">Manage Members</a></li>
		          <li class="in nav-item"><a  href="#!/members/add" class="nav-link ">Member Registration</a></li>
		        
		      </ul>
		    </li>
		    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Manage Service<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="nav-item"><a class="nav-link" href="#!/service/records/create">New Service Record</a></li>
		        <li class="in nav-item"><a  href="#!/service/create" class="nav-link ">New Service Category</a></li>
		        <li class="nav-item"><a  href="#!/service/manage" class="nav-link ">Manage Service Category</a></li>
		      </ul>
		    </li>

		   <!--  <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Manage Expenses<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="nav-item"><a class="nav-link" href="new_expense_record.html">New Expense Record</a></li>
		        <li class="in nav-item"><a  href="new_expense_category.html" class="nav-link ">Create Expense Category</a></li>
		        <li class="nav-item"><a  href="manage_expense_category.html" class="nav-link ">Manage Expense Category</a></li>
		        <li class="nav-item"><a  href="expense_report.html" class="nav-link ">View Expense Category</a></li>
		      </ul>
		    </li>

		  <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Income Settings<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="nav-item"><a class="nav-link" href="create_income.html">Create Income Category</a></li>
		        <li class="in nav-item"><a  href="manage_income.html" class="nav-link ">Manage Income Category</a></li>
		      </ul>
		    </li> -->   


		        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Manage Events<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="nav-item"><a class="nav-link" href="#!/events">View Calendar</a></li>
		      </ul>
		    </li>

		      <!-- <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Messages & Sms<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="in nav-item"><a  href="#/messages/" class="nav-link ">Mailbox</a></li>
		        <li class="in nav-item"><a  href="#/messages/compose" class="nav-link ">Send Message</a></li>
		         <li class="nav-item"><a  href="<?= $demo_path; ?>new_message_category.html" class="nav-link ">Create Message Category</a></li>
		      </ul>
		    </li> -->

		    <!--settings-->
		    <!-- <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">General Settings<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>customer_profile.html">Customer Profile</a></li>
		      </ul>
		    </li> -->

		    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Districts<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="in nav-item"><a  href="#!/districts/create" class="nav-link ">Create District</a></li>
		          <li class="nav-item"><a  href="#!/districts/manage" class="nav-link ">Manage Districts</a></li>
		          <li class="nav-item"><a href="javascript:void(0)" class="menudropdown nav-link">Communities<i class="fa fa-angle-down "></i></a>
		        <ul class="nav flex-column nav-second-level">
		              <li class="in nav-item"><a  href="#!/community/create" class="nav-link ">Create communities</a></li>
		              <!-- <li class="nav-item"><a  href="<?= $demo_path; ?>manage_communities.html" class="nav-link ">Manage communities</a></li> -->
		            <li class="nav-item"><a href="javascript:void(0)" class="menudropdown nav-link">Zones<i class="fa fa-angle-down "></i></a>
		               <ul class="nav flex-column nav-second-level">
		                <li class="in nav-item"><a  href="#!/zone/create" class="nav-link ">Create zone</a></li>
		                <!-- <li class="nav-item"><a  href="manage_zones.html" class="nav-link ">Manage zones</a></li> -->
		              <li class="nav-item"><a href="javascript:void(0)" class="menudropdown nav-link">Cells<i class="fa fa-angle-down "></i></a>
		                 <ul class="nav flex-column nav-second-level">
		                    <li class="in nav-item"><a  href="#!/cells/create" class="nav-link ">Create cells</a></li>
		                   <!--  <li class="nav-item"><a  href="<?= $demo_path; ?>manage_cells.html" class="nav-link ">Manage cells</a></li> -->
		                    <li class="in nav-item"><a  href="#!/cell/members/add" class="nav-link ">Add Member</a></li>
		                </ul>
		              </li>
		              </ul>
		            </li>
		            </ul>
		          </li>
		        </ul>
		      </li>
		      <!-- Teams -->
		    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Teams<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="in nav-item"><a class="nav-link" href="#!/teams/create">Create Team</a></li>
		        <li class="nav-item"><a class="nav-link" href="#!/teams/">Manage Teams</a></li>

		        <!-- Departments -->
		        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Departments<i class="fa fa-angle-down "></i></a>
		          <ul class="nav flex-column nav-second-level">
		            <li class="in nav-item"><a class="nav-link" href="#!/department/create">Create Department</a></li>
		           <!--  <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>manage_departments.html">Manage Departments</a></li> -->
		          </ul>
		        </li>

		         <!-- Small Groups -->
		        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Small Groups<i class="fa fa-angle-down "></i></a>
		          <ul class="nav flex-column nav-second-level">
		            <li class="in nav-item"><a class="nav-link" href="#!/smallGroup/create">Create Small Group</a></li>
		            <!-- <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>manage_small_groups.html">Manage Small Group</a></li> -->
		            <li class="in nav-item"><a  href="#!/group/members/add" class="nav-link ">Add Member</a></li>
		          </ul>
		        </li>
		      </ul>
		    </li>

		    <!--First Timers-->
		    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">First Timers<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="in nav-item"><a  href="#!/rhemacenter/firsttimers" class="nav-link">Rhema Center</a></li>
		        <li class="nav-item"><a  href="#!/firsttimer/add" class="nav-link ">Register First Timer</a></li>
		      <!--   <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>manage_first_timers.html">Manage First Timers</a></li> -->
		       <!--  <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>track_first_timer_reports.html">Track First Timers</a></li> -->
		        <li class="nav-item"><a class="nav-link" href="#!/firsttimers/report">First Timers Reports</a></li>
		      </ul>
		    </li>

		    <!--Second Timers-->
		    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Second Timers<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="nav-item"><a  href="#!/secondtimers/add" class="nav-link ">Register Second Timer</a></li>
		        <li class="in nav-item"><a  href="#!/secondtimers/rhema" class="nav-link ">Manage Second Timers</a></li>
		        <li class="nav-item"><a class="nav-link" href="#!/secondtimers/report">Second Timers Reports</a></li>
		      </ul>
		    </li>

		    <!-- Roles -->

		    <?php if( $this->session->role == 'administrator' ): ?>

		    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Role Management<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="nav-item"><a  href="#!/role/create" class="nav-link ">Create Role</a></li>
		        <li class="in nav-item"><a  href="#!/roles/manage" class="nav-link ">Manage Roles</a></li>
		      </ul>
		    </li>

			<?php endif ; ?>


		    <!-- Admin management -->

		    <?php if( $this->session->role == 'administrator' ): ?>

		    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Admin Management<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="nav-item"><a  href="#!/admin/create" class="nav-link ">Create User</a></li>
		        <li class="in nav-item"><a  href="#!/users/manageUsers" class="nav-link ">Manage Users</a></li>
		      </ul>
		    </li>
		    
		    <?php endif ; ?>

		    <!-- ATTENDANCE -->
		    <!-- <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Attendance<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="in nav-item"><a  href="<?= $demo_path; ?>manage_attendance.html" class="nav-link ">Manage Attendance Categories</a></li>
		        <li class="nav-item"><a  href="<?= $demo_path; ?>create_attendance_category.html" class="nav-link ">Create Attendance Categories</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>cell_attendance.html">Call Attendance</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>small_group_attendance.html">Small Group Attendance</a></li>
		      </ul>
		    </li> -->

		    <!-- POOLS -->
		    <!-- <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Pools<i class="fa fa-angle-down "></i></a>

		       <ul class="nav flex-column nav-second-level">
		        <li class="in nav-item"><a  href="<?= $demo_path; ?>create_pool.html" class="nav-link ">Create Pool</a></li>
		        <li class="nav-item"><a  href="<?= $demo_path; ?>manage_pools.html" class="nav-link ">Manage Pools</a></li>
		        <li class="nav-item"><a class="nav-link" href="#/member">Add Member</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>manage_pools.html">Manage Pool Data</a></li>
		      </ul>
		    </li> -->

		    <!-- <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Schools & Levels<i class="fa fa-angle-down "></i></a>
		      <ul class="nav flex-column nav-second-level">
		        <li class="in nav-item"><a  href="<?= $demo_path; ?>manage_schools.html" class="nav-link ">Manage Schools</a></li>
		        <li class="nav-item"><a  href="<?= $demo_path; ?>create_school.html" class="nav-link ">Create School</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>create_new_class.html">Create Levels</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>link_attendance.html">Link Attendance</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>register_student.html">Register Student</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>manage_sessions.html">Manage School Sessions</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>create_session.html">Create New Session</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>create_school_attendance.html">Create School Attendance</a></li>
		        <li class="nav-item"><a class="nav-link" href="<?= $demo_path; ?>upload_scores.html">Upload Scores</a></li>
		      </ul>
		    </li> -->

		</div>

		<div class="wrapper-content">

			<div ng-view></div>

			<footer class="footer-content ">
	      	<div class="container ">
	         	<div class="row align-items-center justify-content-between">
	            	<div class="col-md-16 col-lg-8 col-xl-8">Copyright <a href="trial.mozallo.com/" target="_blank" >trial.mozallo.com</a></div>
	            	<div class="col-md-16 col-lg-8 col-xl-8 text-right"><a href="#!" target="_blank" class="">Privacy Policy</a> | <a href="#!" target="_blank" class="">Terms of use</a> </div>
	         	</div>
	      	</div>
	   	</footer>
		</div>




		<!-- INSERT SEARCH BLOCK PARTIAL HERE  -->
		<div class="search-block">
		  <button class="close-btn btn btn-link"><span class="fa fa-times"></span></button>
		    <div class="container">
		      <div class="row">
		        <form class="form-inline pull-left search-block-form">
		          <input class="form-control " type="text" placeholder="Search..." value="Adminux by Mozallo " autofocus>
		          <button class="btn btn-link icon-header " type="submit"><span class="fa fa-search"></span></button>
		        </form>
		      </div>
		      <div class="row">
		        <div class="col ">
		          <ul class="nav flex-column ">
		            <li class="title-nav">Search result</li>
		            <li class=""><br>
		            </li>
		            <li class="nav-item">
		              <div class="list-unstyled search-list"> <a href="#" class="media">
		                <div class="media-body">
		                  <h6 class="mt-0 mb-1">Beautiful admin template ever</h6>
		                  http://www.Mozallo.in <br>
		                  <p class="description">Bootstrape 4 based creatively hand crafter admin tempolate never seen before. #1 template in UI design and experience it provides.</p>
		                </div>
		                </a> <a href="#" class="media">
		                <div class="media-body">
		                  <h6 class="mt-0 mb-1">Beautiful admin template ever</h6>
		                  http://www.Mozallo.in <br>
		                  <p class="description">Bootstrape 4 based creatively hand crafter admin tempolate never seen before. #1 template in UI design and experience it provides.</p>
		                </div>
		                </a> <a href="#" class="media">
		                <div class="media-body">
		                  <h6 class="mt-0 mb-1">Beautiful admin template ever</h6>
		                  http://www.Mozallo.in <br>
		                  <p class="description">Bootstrape 4 based creatively hand crafter admin tempolate never seen before. #1 template in UI design and experience it provides.</p>
		                </div>
		                </a> </div>
		            </li>
		          </ul>
		        </div>
		        <br>
		      </div>
		      <div class="row">
		        <div class="col "> <br>
		          <nav aria-label="Page navigation example">
		            <ul class="pagination justify-content-center">
		              <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> <span class="sr-only">Previous</span> </a> </li>
		              <li class="page-item active"><a class="page-link" href="#">1</a></li>
		              <li class="page-item"><a class="page-link" href="#">2</a></li>
		              <li class="page-item"><a class="page-link" href="#">3</a></li>
		              <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> <span class="sr-only">Next</span> </a> </li>
		            </ul>
		          </nav>
		          <hr>
		          <br>
		        </div>
		      </div>
		      <div class="row">
		        <div class="col-md-16 col-lg-16 col-xl-8">
		          <div class="card full-screen-container">
		            <div class="card-header align-items-start justify-content-between flex">
		              <h5 class="card-title  pull-left">Popular People</h5>
		            </div>
		            <div class="card-block">
		              <div class="list-unstyled member-list row">
		                <div class="col-lg col-sm-8 col-xs-16 ">
		                  <div class="media flex-column "> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
		                    <div class="media-body">
		                      <h6 class="mt-0 mb-1">Astha Smith</h6>
		                      New Jersey, UK
		                      <p class="description">This is awesome product and, I am very happy</p>
		                    </div>
		                    <div class="overlay align-items-center">
		                      <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
		                      <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
		                    </div>
		                  </div>
		                </div>
		                <div class="col-lg col-sm-8 col-xs-16 ">
		                  <div class="media flex-column "> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
		                    <div class="media-body">
		                      <h6 class="mt-0 mb-1">Rahul Akshay </h6>
		                      New Jersey, UK
		                      <p class="description">This is awesome product and, I am very happy</p>
		                    </div>
		                    <div class="overlay align-items-center">
		                      <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
		                      <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
		                    </div>
		                  </div>
		                </div>
		                <div class="col-lg col-sm-8 col-xs-16 ">
		                  <div class="media flex-column "> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
		                    <div class="media-body">
		                      <h6 class="mt-0 mb-1">Rocky Jolly</h6>
		                      New Jersey, UK
		                      <p class="description">This is awesome product and, I am very happy</p>
		                    </div>
		                    <div class="overlay align-items-center">
		                      <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
		                      <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		          </div>
		        </div>
		        <div class="col-md-16 col-lg-16 col-xl-8">
		          <div class="card full-screen-container">
		            <div class="card-header align-items-start justify-content-between flex">
		              <h5 class="card-title  pull-left">Popular Project</h5>
		            </div>
		            <div class="card-block">
		              <div class="list-unstyled project-list row">
		                <div class="col-md-16 col-lg-8 col-xl-8">
		                  <div class="media flex-column "> <span class="projectpic"><img src="<?= $demo_path; ?>css/images/project_pic.jpg" alt="Generic user image"> <span class="user-status bg-success "></span></span>
		                    <div class="overlay ">
		                      <label class="ribbon left danger"><span>Mozallo</span></label>
		                      <h6 class="mt-0 mb-1">Website Design</h6>
		                      2017 <br>
		                      <br>
		                      <a href="#" class="btn btn-outline-white btn-round "><i class="fa fa-eye"></i>View </a> </div>
		                  </div>
		                </div>
		                <div class="col-md-16 col-lg-8 col-xl-8">
		                  <div class="media flex-column "> <span class="projectpic"><img src="<?= $demo_path; ?>css/images/project_pic.jpg" alt="Generic user image"> <span class="user-status bg-success "></span></span>
		                    <div class="overlay ">
		                      <label class="ribbon left danger"><span>Mozallo</span></label>
		                      <h6 class="mt-0 mb-1">Website Design</h6>
		                      2017 <br>
		                      <br>
		                      <a href="#" class="btn btn-outline-white btn-round "><i class="fa fa-eye"></i>View </a> </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		</div>



		<!-- INSERT RIGHT SIDEBAR -->
		<div class="sidebar-right">
		  <ul class="nav flex-column " >
		    <li class="nav-item text-center">
		      <div class="progressprofile">
		        <div class="progress_profile " data-value="0.65"  data-size="140"  data-thickness="4"  data-animation-start-value="0" data-reverse="false" ></div>
		        <div class="user-details">
		          <figure><img src="<?= $demo_path; ?>css/images/user-header.png" alt="complete profile"></figure>
		          <h5>65%</h5>
		          <p class="">Assimilated</p>
		        </div>
		        <div class="clearfix"></div>
		      </div>
		      <div class="meeting-subject text-center col ">Quick link to manage <br>
		        Second Timers</div>
		      <div class="nav-link"><a href="#!/secondtimers/rhema" class="btn btn-outline-primary btn-round mr-sm-2">View Second Timers <i class="fa fa-chevron-right"></i></a></div>
		    </li>
		  </ul>
		  <hr>
		  <!-- <ul class="nav flex-column " >
		    <li class="title-nav">New Friend Request</li>
		    <li class="nav-item">
		      <div class="list-unstyled media-list">
		        <div class="media"> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>css/images/user-header.png" alt="Generic user image"></span>
		          <div class="media-body">
		            <h6 class="mt-0 mb-1">Dhananjay Chauhan</h6>
		            New Jersey, UK</div>
		          <div class="overlay align-items-end">
		            <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
		            <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
		          </div>
		        </div>
		        <div class="media"> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>css/images/user-header.png" alt="Generic user image"><span class="user-status bg-success "></span></span>
		          <div class="media-body">
		            <h6 class="mt-0 mb-1">Astha Smith</h6>
		            Ahemedabad, IN</div>
		          <div class="overlay align-items-end">
		            <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
		            <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
		          </div>
		        </div>
		      </div>
		    </li>
		  </ul> -->
		  <hr>
		  <!-- <ul class="nav flex-column " >
		    <li class="title-nav">New Event Request</li>
		    <li class="nav-item">
		      <div class="list-unstyled media-list"> <a href="#" class="media">
		        <div class="media-body">
		          <h6 class="mt-0 mb-1">20 February, 2017</h6>
		          New Jersey, UK <br>
		          <p class="description">Musical night festival seasons, Drama and comedy cultural famil</p>
		        </div>
		        </a> <a href="#" class="media">
		        <div class="media-body">
		          <h6 class="mt-0 mb-1">20 February, 2017</h6>
		          New Jersey, UK <br>
		          <p class="description">Musical night festival seasons, Drama and comedy cultural famil</p>
		          <p class="description"> <span>Privately invited by:</span> <span class="invites-by"><img src="<?= $demo_path; ?>css/images/user-header.png" alt="complete profile"> <span class="user-status bg-success "></span></span> <span class="invites-by"><img src="<?= $demo_path; ?>css/images/user-header.png" alt="complete profile"></span> <span class="invites-by"><img src="<?= $demo_path; ?>css/images/user-header.png" alt="complete profile"></span> </p>
		        </div>
		        </a> </div>
		    </li>
		  </ul> -->
		  <hr>

		  <!-- <ul class="nav flex-column " >
		    <li class="title-nav">Last Message</li>
		    <li class="nav-item">
		      <div class="list-unstyled media-list">
		        <div class="media"> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>css/images/user-header.png" alt="Generic user image"></span>
		          <div class="media-body">
		            <h6 class="mt-0 mb-1">Rahul Akshay</h6>
		            2:00 pm, 20 January, 2017 <br>
		            <p class="description">Hi! Are you ready for Musical night festival seasons, Drama and comedy cultural family show.</p>
		            <button class="btn btn-outline-primary btn-round mr-sm-2"><i class="fa fa-reply"></i> Reply</button>
		            <button class="btn btn-outline-danger btn-round ">Close</button>
		          </div>
		        </div>
		      </div>
		      <div class="nav-link"></div>
		    </li>
		  </ul> -->
		  <hr>
		  <br>
		  <br>
		</div>


		<script src="<?= $demo_path; ?>js/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/tether.min.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/responsive-fit-for-ie10.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/circle-progress.min.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/jquery.sparkline.min.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/jquery-jvectormap.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>

		<script src="<?= $demo_path; ?>js/Chart.bundle.min.js" type="text/javascript"></script>
		<!-- <script src="js/chart-js-data.js" type="text/javascript"></script> -->

		<script src="<?= $demo_path; ?>js/jquery.spincrement.min.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/utils.js" type="text/javascript"></script>

		<script src="<?= $demo_path; ?>js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/dataTables.bootstrap4.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/dataTables.responsive.min.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/admin.js" type="text/javascript"></script>
		
		<!-- <script src="./js/dashboard.js" type="text/javascript"></script> -->



		<script src="<?= $demo_path; ?>js/circle-progress.min.js" type="text/javascript"></script>
		<script src='<?= $demo_path; ?>js/moment.min.js'></script> 
		<script src='<?= $demo_path; ?>js/fullcalendar.min.js'></script>
  		<script src='<?= $demo_path; ?>js/calendar.js'></script>
  		<script src="<?= base_url(); ?>library/highcharts/js/highcharts.js" type="text/javascript"></script>
  	
		
		<!-- <script src="js/dashboard.js" type="text/javascript"></script> -->

		<!-- Angular js --> 
        <script src="<?= base_url();?>library/js/angular.min.js" ></script>
        <script src="<?= base_url();?>library/js/angular-route.js" ></script>
        

    	<!-- fusion charts -->

    	<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
		<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
		<!-- <script type="text/javascript"></script> -->

    	<script src="<?= base_url();?>library/js/fusioncharts.js" ></script>
    	<script src="<?= base_url();?>library/js/fusioncharts.charts.js" ></script>
    	<script src="<?= base_url();?>library/js/angular-fusioncharts.min.js" ></script>
    	<script src="<?= base_url();?>library/js/fusioncharts.theme.ocean.js" ></script>


    	<!-- ng Dialog module -->
    	<script src="<?= $lib_path; ?>js/ng-dialog/js/ngDialog.min.js"></script>

    	<!-- Date picker module  -->
    	<script src="<?= $lib_path; ?>js/ng-datepicker/dist/angular-datepicker.min.js"></script>


    	<!-- ng animation -->
    	<script src="<?= $lib_path; ?>ngAnimate/js/angular-animate.min.js"></script>

			<!-- ng tooltips -->	
			<script src="<?= $lib_path; ?>js/ng-tooltips/dist/angular-tooltips.min.js"></script>


    	<!-- Custom App Modules -->

    	<!-- main module -->
        <script src="<?= base_url();?>library/js/test.js" ></script>

        <script src="<?= base_url();?>library/js/members.js" ></script>

        <script src="<?= base_url();?>library/js/districts.js" ></script>
        <script src="<?= base_url();?>library/js/communityApp.js" ></script>
        <script src="<?= base_url();?>library/js/zoneApp.js" ></script>
        <script src="<?= base_url();?>library/js/cellApp.js" ></script>
        <script src="<?= base_url();?>library/js/cellMembersApp.js" ></script>

        <script src="<?= base_url();?>library/js/teamApp.js" ></script>
        <script src="<?= base_url();?>library/js/departmentApp.js" ></script>
        <script src="<?= base_url();?>library/js/smallGroupApp.js" ></script>
        <script src="<?= base_url();?>library/js/groupMembersApp.js" ></script>

        <!--admin app -->
        <script src="<?= base_url();?>library/js/adminApp.js" ></script>

        <!--Role app -->
        <script src="<?= base_url();?>library/js/roleApp.js" ></script>

        <script src="<?= base_url();?>library/js/dashboardApp.js" ></script>

        <script src="<?= base_url();?>library/js/eventsApp.js" ></script> 

        <script src="<?= base_url();?>library/js/serviceRecordApp.js" ></script>
        
        

        <script src="<?= base_url();?>library/js/first_timers.js" ></script>
        <script src="<?= base_url();?>library/js/secondTimersApp.js" ></script>
        <script src="<?= base_url();?>library/js/serviceApp.js" ></script>
				<script src="<?= base_url();?>library/js/messageApp.js" ></script>

        <!-- jquery ui -->
        <script type="text/javascript" src="<?php echo base_url(); ?>library/jquery-ui/jquery-ui.min.js"></script>
	</body>
</html>