<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class First_timers extends MX_Controller {



		/**
		* @param prefix string
		* represents the prefix in the UID for this module. 
		*/
		public $prefix = "FT" ;


		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('first_timers/mdl_first_timers');
		}



		public function index()
		{
			$this->viewAll();
		}



		public function weekFirstTimers(){

			$start = $this->date_time->format(unix_to_human(strtotime( "last sunday" ) ) , 'Y-m-d' );
			$end   = $this->date_time->format(unix_to_human(strtotime( "this saturday" ) ) , 'Y-m-d' );

			$firsttimers = $this->mdl_first_timers->all($start, $end)->result() ;
			echo json_encode($firsttimers);
		}


		/**
		* For reports
		* Used by fusion charts to display number offirst timers in each month.
		*/
		public function monthlyCount($quarter = null){

			$months = ( ! empty($quarter) ) ?  $this->date_time->getQuarterMonths($quarter) : $this->date_time->months($this->date_time->month() ) ;

			$months = json_decode($months) ;
			$current_month = $this->date_time->month() ;
			$current_year = $this->date_time->year_full() ;
			$last_year    = $this->date_time->last_year_full() ;

			$data = array() ;

			foreach ($months as $key => $value) {
				
				$start_date = date("Y-$key-01");
				$end_date = date('Y-m-t', strtotime($start_date) ) ;

				$start_date_ly = date("$last_year-$key-01"); // strtotime("$start_date -1 year"); //returns a unix timestamp
				$end_date_ly = date('Y-m-t', strtotime($start_date_ly) ) ;; // returns a unix timestamp

				$data[] = array('value'=> $this->mdl_first_timers->all($start_date, $end_date)->num_rows() ) ;
				$data2[] = array('value'=> $this->mdl_first_timers->all($start_date_ly, $end_date_ly)->num_rows() ) ;
				
			}

		
			$dataset = array('seriesname' => "Quarter $quarter($current_year)", 'data' => $data) ; 
			$dataset2 = array('seriesname' => "Quarter $quarter($last_year)", 'data' => $data2 );
			$d[] = $dataset;
			$d[] = $dataset2;

			echo json_encode($d) ;
			 
		}



		public function assimilation_report($quarter = null){

			$this->load->model('second_timers/mdl_second_timers') ;

			$months = ( ! empty($quarter) ) ?  $this->date_time->getQuarterMonths($quarter) : $this->date_time->months($this->date_time->month() ) ;

			$months = json_decode($months) ;
			$current_month = $this->date_time->month() ;
			$current_year = $this->date_time->year_full() ;
			$last_year    = $this->date_time->last_year_full() ;


			foreach ($months as $key => $value) {
				
				$start_date = date("Y-$key-01");
				$end_date   = date('Y-m-t',strtotime($start_date)) ; 
				$in_secondtimers = $this->mdl_second_timers->assimilated($start_date, $end_date)->num_rows() ;

				$start_date_ly = date("$last_year-$key-01") ; 
				$end_date_ly = date('Y-m-t', strtotime($start_date_ly) ) ;
				$in_secondtimers_ly = $this->mdl_second_timers->assimilated($start_date_ly, $end_date_ly)->num_rows() ;


				$data[] = array('value' => $in_secondtimers ) ;
				$data2[] = array('value' => $in_secondtimers_ly ) ;

			}

			$dataset = array('seriesname' => "Quarter $quarter($current_year)", 'data' => $data) ; 
			$dataset2 = array('seriesname' => "Quarter $quarter($last_year)", 'data' => $data2 );
			$d[] = $dataset;
			$d[] = $dataset2;

				
			echo json_encode($d)  ;
		}


		/**
		* Returns the months used for the 'category' key in fusion charts
		* @param $quarter - represents a quarter of the year (1 - 4) .
		* if a $quarter isn't provided, it returns all the month from the start of the year to the current month
		*/
		public function getCat($quarter = null){

			//$this->date_time->month();
			$months = (! empty($quarter) ) ?  $this->date_time->getQuarterMonths($quarter) : $this->date_time->months( $this->date_time->month() )  ;

			 $months = json_decode($months) ;

			foreach ($months as $key => $value) {
				$categories[] = array('label' => $value ) ;
			}
		
			$category[] = array('category' => $categories);	
			echo json_encode($category) ;

		}


		/**
		* Loads the first timers report page
		*/
		public function report(){
			$this->load->view("firsttimers_report") ;
		}


		public function register()
		{
			$this->load->view('addFirstTimer');
		}



		public function newFirstTimer()
		{
			$service_date 	= $this->input->get('service_date');
			$firstname 		= $this->input->get('firstname');
			$surname   		= $this->input->get('surname');
			$middlename 	= $this->input->get('middlename');
			$telephone1 	= $this->input->get('telephone1');
			$telephone2 	= $this->input->get('telephone2');
			$dob 			= $this->input->get('dob');
			$gender 		= $this->input->get('gender');
			$email 			= $this->input->get('email');
			$address 		= $this->input->get('address');
			$age_bracket 	= $this->input->get('age_bracket');
			$occupation 	= $this->input->get('occupation');			
			$discovery 		= $this->input->get('discovery');
			$next_step 		= $this->input->get('next_step');


			//echo $service_date = $this->date_time->format($service_date, 'Y-m-d'); return ;


			try{

				if(empty($service_date) || empty($firstname) || empty($surname) || empty($dob) || empty($address) || empty($telephone1) || empty($age_bracket) ){

					throw new Exception('Warning: Fill required fields');
				}


				if(! $this->date_time->is_valid($service_date) ){
					throw new Exception("Warning: Invalid Service date") ;
				}


				if ($this->date_time->is_future($service_date)  ){
					throw new Exception('Warning: Date cannot be in the future');
				}



				if(! $this->date_time->is_valid($dob) ){
					throw new Exception("Warning: Invalid dob") ;
				}


				
				// if ($this->date_time->biggerDate($dob)  != $dob){
				// 	$this->record('Oops! incorrect date of birth format', 'report-error');
				// 	return;
				// }
				
				// if($this->form_validation->run() == false){
				// 	$errors = $this->form_validation->error_array();
					
				// 	foreach ($errors as $key => $value) {
				// 		$error[] = $value;
				// 	}
					
				// 	 $this->record($error[0], 'report-error');
				// 	return;										
				// }
				

				$check = array('telephone1' => $telephone1, 'email' => $email ) ;

				if(isset($telephone2) ){
					$check['telephone2'] = $telephone2 ;
				}


				$feedback = $this->mdl_first_timers->exists($check) ;

				if($feedback['status'] == true ){
					throw new Exception("Warning: Duplicate record for " .$feedback['field']. " field.");
				}


				$this->load->module('uid');
				$uid  = $this->uid->generate_id($this->prefix);

				if(empty($uid) ){
					throw new Exception("Error generating UID");
				}


				$uid_check = array('uid' => $uid ) ;

				$uid_feedback = $this->mdl_first_timers->exists($uid_check) ;

				if($uid_feedback['status'] == true ){
					throw new Exception("Error: UID not unique. ") ;
				}
					

				//$data['service_type'] 	= $service_type ;
				$data['uid']			= $uid;
				$data['service_date'] 	= $service_date ;
				$data['firstname'] 		= $firstname ;
				$data['surname'] 		= $surname ;
				$data['middlename'] 	= $middlename ;
				$data['telephone1'] 	= $telephone1 ;
				$data['telephone2'] 	= $telephone2 ;
				$data['dob'] 			= $dob ;;
				$data['gender'] 		= $gender ;
				$data['email'] 			= $email ;
				$data['address'] 		= $address ;				
				$data['age_bracket'] 	= $age_bracket ;
				$data['occupation'] 	= $occupation ;					
				$data['discovery'] 		= $discovery ;
				$data['next_step'] 		= $next_step ;


				if(! $this->mdl_first_timers->register($data) ){
					throw new Exception("Error registering first timer.") ;
				}

				$send['status'] = 'success' ;
			}
			catch(Exception $e){

				$send['status'] = 'error' ;
				$send['message'] = $e->getMessage() ;
			}	
			
			echo json_encode($send) ;			
		}



		/**
		* Loads the first timer management page for first timers.
		*
		*/
		public function rhema(){

			$months = json_decode( $this->date_time->month_array() ) ;
			$years  = json_decode( $this->date_time->year_list() ) ;
			$data['months'] = $months ;
			$data['years'] = $years ;
			$this->load->view('rhema', $data) ;
		}


		/**
		* Processes Data from rhema	 
		*/
		public function rhema_update(){

			$rhema_data = $this->input->get('rhema_data');
			$interests  = $this->input->get('interests');
			$id  		= $this->input->get('id');

			$rhema_data = json_decode($rhema_data) ;
			$interests  = json_decode($interests) ;
			$id 		= json_decode($id) ;
			$message 	= "" ;

			if(! empty($rhema_data)){

				//if the first timer was called successfully
				if($rhema_data->call_status === 1){

					$rhema_data->call_date  = $this->date_time->now('Y-m-d') ;
					$rhema_data->call_agent = $this->session->admin_id ;

					if( empty( $rhema_data->service_id ) ){

						$message += "<li>Warning: Coudn't find service attended by first timer</li>" ;
						
					}

					if(isset($rhema_data->prospective) ){

						//if first timer is prospective
						if($rhema_data->prospective == 1){

							if(isset( $interests->toCell ) && $interests->toCell == true){
								//send message to person in charge of assigning people to cells
								$message += "<li>District Leader has been notified of first timer willing to join a cell</li>" ;
							}
						

							//if the first timer shows willingness in joining a department
							if( isset($interests->toDepartment) && $interests->toDepartment == true){

								//get personnel in charge of assigning people to departments
								//load the message that informs about willingness to join a deprtment 
								//send message to person in charge of assigning people to department

								//give admin feedback of notification
								$message += "<li>Team head has been notified of first timer willing to join a department</li>" ;

								//if the firsttimer indicates interest in a particular department
								if(! empty ( $interests->department ) ){

									//copy department leader of interested individual
									$message += "<li>HOD of ".$interests->department." has been notified of first timer willing to join the department.</li>" ;
								}
							}
						}
						elseif($rhema_data->prospective == 2){ //if first timer is undecided
							//add him/her to the undecided pool
						}
					}
				}else{

					if( ! empty( $rhema_data->service_id ) ){
						
						//update the service attended by the first timers

						
					}
				}

			}

			
			if(! $this->mdl_first_timers->update($id, $rhema_data) ){
				$message += "<li>Error updating firsttimers information</li>";
				$data['status'] = 'error' ;
			}

			$data['message'] = $message ;

			echo json_encode($data);
		}



		public function get_firsttimers(){
		

		 	$get_month = $this->input->get('month') ;
		 	$get_year  = $this->input->get('year') ;

			$this_month = $this->date_time->month();
			$this_year  = $this->date_time->year_full() ;

			$month = (! empty($get_month) ) ? $get_month : $this_month ;
			$year  = (! empty($get_year)  ) ? $get_year  : $this_year ;

			
			$last_day   = $this->date_time->last_day($month, $year);

			$start_date =  nice_date("$year-$month-01", "Y-m-d") ;  
			
			$last_date  = nice_date("$year-$month-$last_day", "Y-m-d") ; 

			$first_timers = $this->mdl_first_timers->all($start_date, $last_date)->result() ;

			echo json_encode($first_timers) ;
		}



		public function get_all(){

			$first_timers = $this->mdl_first_timers->all()->result() ;
			echo json_encode($first_timers) ;
		}



		//verfies if first timer has come a second time
		public function in_secondtimers(){

			$firsttimer_id = $this->input->get("firsttimer_id") ;

			if( ($firsttimer_id)){

				$this->load->model('second_timers/mdl_second_timers') ;
				$this->load->module('uid') ;

				$second_timer_uid = $this->uid->switch_prefix( $this->mdl_first_timers->get_info($firsttimer_id, 'uid' ) );

				//get the second timer details with the uid.


				$check = ['id' => $second_timer_id ] ;
				$feeback = $this->mdl_second_timers->exists($check) ;

				echo (! $feedback) ? false : true ;
			}
		}




		public function in_small_group(){

			$firsttimer_id = $this->input->get("firsttimer_id") ;

			if( ($firsttimer_id)){

				$this->load->model('cells/mdl_cells') ;
				$this->load->module('uid') ;

				$second_timer_uid = $this->uid->switch_prefix( $this->mdl_first_timers->get_info($firsttimer_uid, 'uid' ) ) ;


				$check = ['uid' => $second_timer_uid ] ;
				$feeback = $this->mdl_second_timers->exists($check) ;

				echo (! $feedback) ? false : true ;
			}
		}



		//returns info about a first 
		public function firsttimerInfo(){

			$firsttimer_id = $this->input->get('firsttimer_id') ;
			$info =  $this->mdl_first_timers->get_info($firsttimer_id) ;
			echo json_encode($info) ;
		}



		public function drop(){

			$firsttimer_id = $this->input->get('firsttimer_id') ;
			$data['status'] = (! $this->mdl_first_timers->drop($firsttimer_id) ) ? 'error' : 'success' ;
			echo json_encode($data) ; 
		}



		/**
		* This gets the firstimers that are not yet second timers
		* Or that are not in the second timers table
		* @param start_date
		* @param end_date
		*/
		public function justFirstTimers(){

			echo json_encode( $this->mdl_first_timers->firsttimers_only()->result() ) ;
		}


		// public function test(){

		// 	var_dump($this->mdl_first_timers->firsttimers_only()->result()) ;
		// }




		


		
		









		
		
		
		



		// public function admin_graph()
		// {
		// 	$this->fail_safe('000');

		// 	$this->load->model('reports/mdl_reports');
		// 	$this->load->module('members') ;
	
		// 	//$months 	  	= $this->date_time->months();
		// 	$current_year 	= $this->date_time->full_year();
		// 	$current_month 	= $this->date_time->this_month();
		// 	$month_abbr 	= $this->date_time->this_month_short();
		// 	$current_day 	= $this->date_time->this_day();

		// 	$get_year  	= $this->input->get('year');
		// 	$get_month  = $this->input->get('month');
		// 	$chart_type  = $this->input->get('type');

		// 	$year 		= isset($get_year) ? $get_year 	:  $current_year ;
		// 	$month 		= isset($get_month) ? $get_month : $current_month ;
		// 	$month_name = $this->date_time->get_month_name($month) ;
		// 	$chart_type = isset($chart_type) ? $chart_type : 'column' ;

			

		// 	$week_list = $this->date_time->week_list($month, $year) ;

		// 	foreach ($week_list as $week) {

		// 		$in_cell = 0;
		// 		$in_sg = 0 ;
		// 		$all_total = 0 ;
		// 		$total_in_sg = 0 ;
		// 		//$in_sg_count = 0;

				
		// 		if($year == $current_year){


		// 			if($week <= $this->date_time->this_week() ){

		// 				$week_start = $this->date_time->week_start_within_month($week, $month, $year);
		//                 $week_end   = $this->date_time->week_end_within_month($week, $month, $year);
		//                 $cat[] = $week_start." to ".$week_end ;

  //               		$all = $this->mdl_first_timers->all($week_start, $week_end);
  //               		$all_count = $all->num_rows() ;
	 //                	$all_total += $all_count ;


		//                 foreach ($all->result() as $first_timer) {

		//                   $uid = $first_timer->uid ;
		//                   $sg_status = $this->members->get_small_group($uid) ;

		        
		//                   if(isset($sg_status['cell']) )
		//                   {
		//                     $in_cell ++ ;
		//                   }


		//                   if(isset($sg_status['sg']) )
		//                   {
		//                     $in_sg++ ;  
		//                   }

		//                 }

		// 				$prospective_count[] = $this->mdl_first_timers->number_of_prospective_this_week($week_start, $week_end);
		// 				$in_cell_count[] = $in_cell;
		// 				$in_sg_count[] = $in_sg;
		// 				$all_ft[] = $all_count ;

						
		
		// 			}
		// 		}

		// 		else if($year != $current_year && $year < $current_year)
		// 		{

		// 			$week_start = $this->date_time->week_start_within_month($week, $month, $year);
	 //                $week_end   = $this->date_time->week_end_within_month($week, $month, $year);
	 //                $cat[] = $week_start." to ".$week_end ;

  //           		$all = $this->mdl_first_timers->all($week_start, $week_end);
	 //                $all_count = $all->num_rows() ;
	 //                $all_total += $all_count ;

	 //                foreach ($all->result() as $first_timer) {

	 //                  $uid = $first_timer->uid ;
	 //                  $sg_status = $this->members->get_small_group($uid) ;

	 //                  if($sg_status['exists'] == true)
	 //                  {
	 //                   // $in_sg_count += 1 ; 
	 //                   // $total_in_sg += $in_sg_count ; 
	 //                  }

	 //                  if(isset($sg_status['cell']) )
	 //                  {
	 //                    $in_cell ++ ;
	 //                  }


	 //                  if(isset($sg_status['sg']) )
	 //                  {
	 //                    $in_sg++ ;  
	 //                  }

	 //                }

		// 				$prospective_count[] = $this->mdl_first_timers->number_of_prospective_this_week($week_start, $week_end);
		// 				$in_cell_count[] = $in_cell;
		// 				$in_sg_count[] = $in_sg;
		// 				$all_ft[] = $all_count ;		
			
		// 		}

		// 		else
		// 		{

		// 		}
		// 	}


			
		// 	if($year < $this->date_time->full_year())
		// 	{
		// 		$subtitle = "showing Reports for $month_name 01 - ". $this->date_time->number_of_days_in_month($month, $year). ", $year";
		// 	}
		// 	else if($year == $this->date_time->full_year() )
		// 	{
		// 		$subtitle = "showing Reports for $month_name 01 - ". $this->date_time->this_day(). ", $year";
		// 	}
		// 	else
		// 	{

		// 	}


		// 	$number_of_comm[] = array('name'=>"First timers in Cell", 'data' => $in_cell_count );
		// 	$number_of_comm[] = array('name'=>"First timers in small_groups", 'data' => $in_sg_count );
		// 	$number_of_comm[] = array('name'=>"prospective", 'data' => $prospective_count );
		// 	$number_of_comm[] = array('name'=>"All First timers", 'data' => $all_ft );
			

			
		// 	$chart['chart'] = array('type' =>  $chart_type);
		// 	$chart['title'] = array('text' => 'First Timers Month Report');
		// 	$chart['subtitle'] = array('text' => $subtitle);
		// 	$chart['xAxis'] = array('categories' => $cat, 'title'=> array('text' => 'Weeks') );
		// 	$chart['yAxis'] = array('title' => array('text' => 'Number of new first timers per month'), 'plotLines' => array('values'=>0, 'width' => 1, 'color' => '#808080'));
		// 	$chart['tooltip'] = array('valueSuffix' => '');
		// 	$chart['legend'] = array('layout'=>'vertical', 'align'=>'right', 'verticalAlign'=>'middle', 'borderWidth'=> 0,);
		// 	$chart['series'] = $number_of_comm;
		// 	$chart['backgroundColor'] = array('backgroundColor' => '#78909C') ;

		// 	echo json_encode($chart);
		
		// }


		
		// public function report()
		// {
		// 	$this->fail_safe('057');

		// 	$data['module'] 	= $this->module;
		// 	$data['view_file'] 	= 'first_timers_report';
		// 	$data['title'] 		= 'First Timer Reports';
		// 	$data['add_btn'] 	= false;
		// 	$data['btn_link'] 	= base_url() ."first_timers/";
		// 	$data['btn_title'] 	= "create new Team";
		// 	$data['top_data'] 	= "First Timers Reports";
		// 	echo Modules::run('templates/admin', $data);
		// }


		
		
		
		


		
		





		// public function addComment()
		// {
		// 	$comment = $this->input->get('comment');
		// 	$first_timer_id = $this->input->get('first_timer_id');

		// 	if(! empty($comment))
		// 	{
		// 		if($this->mdl_first_timers->addComment($comment, $first_timer_id) == false)
		// 		{
		// 			echo false; return;
		// 		}else{
		// 			echo true ;
		// 		}
		// 	}
		// }





		// public function all_prospective_firsttimers_ajax()
		// {
		// 	$limit = $this->input->get('limit');
		// 	$offset = $this->input->get('offset');
		// 	$search = $this->input->get('search');

		// 	$this_month = $this->date_time->this_month();
		// 	$this_year = $this->date_time->full_year();
		// 	$total_days = $this->date_time->number_of_days_in_month($this_month, $this_year);

		// 	$start_date_range = $this_year."-".$this_month."-01"; // first day of the month 
		// 	$last_date_range = $this_year."-".$this_month."-".$total_days; //last day of the month


		// 	$all_results =  $this->mdl_first_timers->all_prospective($start_date_range, $last_date_range);
		// 	$all = $all_results->num_rows();
			
		// 	$search_result = $this->mdl_first_timers->all_prospective($start_date_range, $last_date_range, $search, $limit, $offset);
		// 	$num = $search_result->num_rows();

		// 	$search_no_limit = $this->mdl_first_timers->all_prospective($start_date_range, $last_date_range, $search);
		// 	$no_limit = $search_no_limit->num_rows();
			 
		// 	$out = "";

		// 	if($all >= 1){
		// 	 	$out  .= "<table class='table'>";
		// 		$out .= "<th>S/N </th>";
		// 		$out .= "<th>Firstname </th>";
		// 		$out .= "<th>Surname </th>";
		// 		$out .= "<th>Dob</th>";
		// 		$out .= "<th>Telephone1</th>";
		// 		$out .= "<th>Address</th>";
		// 		$out .= "<th>Occupation</th>";

		// 		if($this->permissions->has_perm('061') == true){
		// 			$out .= "<th>Comment</i></th>";
		// 		}
				
		// 		$out .= "<th>actions</th>";
				
								
		// 		if($num >= 1){

		// 		$count = $offset + 1;
		// 		foreach($search_result->result() as $first_timer)
		// 		{	
		// 			$dob = $this->date_time->this_month_short($first_timer->dob).'-'.$this->date_time->this_day($first_timer->dob) ;

		// 			$out .= "<tr id ='tr_". $first_timer->uid ."'>";
		// 			$out .= "<td>" .$count.									"</td>";
		// 			$out .= "<td>" .$first_timer->firstname.				"</td>";
		// 			$out .= "<td>" .$first_timer->surname.					"</td>";
		// 			$out .= "<td>" .$dob.									"</td>";
		// 			$out .= "<td>" .$first_timer->telephone1.				"</td>";
		// 			$out .= "<td class='m_address'>" .$first_timer->address."</td>";
		// 			$out .= "<td>" .$first_timer->occupation.				"</td>";

		// 			if($this->permissions->has_perm('061') == true){
		// 				$out .= "<td>" .$first_timer->comment.				"</td>";
		// 			}
					
		// 			$out .= "<td id='actions'>";

		// 			$btn_id = $first_timer->uid;
		// 			$full_name = $first_timer->surname." ".$first_timer->firstname ;
		// 			$comment_title = "add a comment based on your assessment of $full_name" ;

		// 			$out .= $this->templates->btn('#', '060', 'fa fa-comment-o', $btn_id, $full_name, $comment_title); 
					 
		// 			//$out .= $this->templates->btn('members/edit', '041', 'fa fa-edit', $btn_id, $full_name, 'edit details'); 

		// 			$out .= "</td>";
		// 			$out .= "</tr>";
		// 			$count++;
		// 		}//end foreach

		// 		$out  .= "</table>";

		// 		//to control the entry count

		// 		$out .= $this->templates->result_count($search, $offset, $limit, $no_limit, $all); 
		// 		$out  .= "<table id='nav_tb'>";
		// 		$out .= "<tr>";
		// 		$out .= $this->templates->nav($search, $offset, $limit, $no_limit, $all); 
		// 		$out .= "</tr>";			
		// 		$out  .= "</table>";

		// 		}//if num is not null
		// 		else{
		// 			$out  .= "<table>";
		// 		 	$out .= "<tr>";
		// 		 	$out .= "<td>No Records for your search</td>";
		// 		 	$out .= "</tr>";
		// 		 	$out  .= "</table>";
		// 		 }
		// 	}else{
		// 		$out .= "No first timer this week.";
		// 	}	 	
			
		// 	echo $out;			
		// }




	

 	
 	// 		//rhema call
		// 	if( isset($data['rhema_call']) && $data['rhema_call'] != 'false' )
		// 	{
		// 		$ft_data ['rhemaCall'] = 'true';
		// 		$ft_data['call_agent'] = $this->session->admin_id ;
		// 		$ft_data['date_called'] = $this->date_time->now('Y-m-d') ;
		// 	}


		// 	//prospect_status
		// 	if( isset($data['prospect_status']) && $data['prospect_status'] != 'unknown' )
		// 	{
		// 		$ft_data ['prospective'] = ($data['prospect_status'] == 'prospective') ?  'true' : 'false';
		// 	}

		// 	//if visitor is prospective, assign to an intercator and update the assignToIntercator Field.
		// 	if($data['prospect_status'] == 'prospective')
		// 	{
		// 		$this->load->module('interactors') ;
		// 		if(! $this->mdl_interactors->is_assigned($ft_id) ){
		// 			if($this->interactors->assignVisitor($ft_id) ){
		// 				$ft_data ['assignedToInteractor'] = 'true';
		// 			}	
		// 		}	
		// 	}


		// 	/*
		// 	//willing to meet
		// 	if(isset($data['wtm']))
		// 	{
		// 		$interactors_data['wtm'] = $data['wtm'];

		// 		if(isset($data['wtm_value']) && $data['wtm_value'] != null )
		// 			$interactors_data['wtm_value'] =  $data['wtm_value'] ;
		// 	}


			
		// 	//met with interactor
		// 	if(isset($data['mwi']))
		// 	{
		// 		$interactors_data['mwi'] = $data['mwi'];

		// 		if($data['mwi'] == 'true')
		// 		{
		// 			$ft_data['metWithInteractor'] = 'true' ;
		// 		}

		// 		if(isset($data['mwi_value']) && $data['mwi_value'] != null)
		// 			$interactors_data['mwi_value'] =  $data['mwi_value'] ;

		// 	}


		// 	//willing to come again.
		// 	if(isset($data['wtca']) )
		// 	{
		// 		$interactors_data['wtca'] = $data['wtca'];

		// 		if(isset($data['wtca_value']) && $data['wtca_value'] != null)
		// 			$interactors_data['wtca_value'] =  $data['wtca_value'] ;
		// 	}
		// 	*/
			

		// 	//cell data
		// 	$this->load->model('admin/mdl_admin');
		// 	$this->load->module('message_category');
		// 	$this->load->module('internal_messages');

		// 	$message['uid'] 		 = $ft_id;
		// 	$message['name'] 		 = $this->mdl_first_timers->get_fullname($ft_id);  
		// 	$message['phone_number'] = $this->mdl_first_timers->get_data_by_id($ft_id, 'telephone1');
		// 	$message['address'] 	 = $this->mdl_first_timers->get_data_by_id($ft_id, 'address');

		// 	if(isset($data['cell']) && $data['cell'] != '#' ) {

		// 		$ft_data['toSmallGroup'] = 'true';
		// 		$this->load->model('cells/mdl_cells');
				
		// 		$cell_id 			= $data['cell'];
		// 		$cell_leader 		= $this->mdl_cells->get_data_by_id($cell_id, 'cell_leader') ;
		// 		$leader_admin_id	= $this->mdl_admin->get_admin_id_by_member_id($cell_leader);
				
		// 		$message['pastor'] 	= $leader_admin_id;
		// 		$message['type']	= 'Cell';

		// 		$body = $this->message_category->newMemberNotification($message);
		// 		$this->internal_messages->send("Notification of First timer assigned to your Cell.", $body, 'Dezion', $leader_admin_id);
				
		// 	}



		// 	else if( isset( $data['department'] ) && $data['department'] != '#' )
		// 	{
		// 		$this->load->model('departments/mdl_departments');
		// 		$ft_data['toSmallGroup'] = 'true';
				
		// 		$department_id 		= $data['department'];
		// 		$department_head 	= $this->mdl_departments->get_data_by_id($department_id, 'head') ;
		// 		$head_admin_id		= $this->mdl_admin->get_admin_id_by_member_id($department_head);
				
		// 		$message['pastor'] 		 = $head_admin_id;
		// 		$message['type']		 = 'Department';

		// 		$body = $this->message_category->newMemberNotification($message);
		// 		$this->internal_messages->send("Notification of First timer assigned to your Department.", $body, 'Dezion', $head_admin_id);
		// 		//send notification to department head
		// 	}



		// 	else if(isset($data['course']) && $data['course'] != '#' )
		// 	{
		// 		//put in sysetm pool.
		// 		//$this->load->model('system_pools/mdl_system_pools');
		// 		//$this->mdl_system_pools->add($school_id, $first_timer_id);
		// 	}
		// 	else{

		// 	}


		// 	if(isset($data['comment']) )
		// 	{		
		// 		$comment = $data['comment'];
		// 		$comment = trim($comment);

		// 		if(! empty($comment))
		// 		{
		// 			$comment_data['comment'] 	= $comment;
		// 			$comment_data['comment_by']  = $this->session->admin_id;
		// 			$comment_data['uid']  		= $ft_id;
		// 			$comment_data['date']  		= $this->date_time->now('Y-m-d') ;
		// 		}		
		// 	}			

			

			

			
		// 	$this->db->trans_start();

		// 	if(! empty($ft_data))
		// 	{
		// 		$this->mdl_first_timers->do_update($ft_id, $ft_data);
		// 	}


		// 	/*
		// 	if(! empty($interactors_data))
		// 	{
		// 		$this->load->model('interactors/mdl_interactors');

		// 		$interactor_id = $this->session->admin_id;

		// 		if($this->mdl_interactors->is_found($interactor_id, $ft_id) )
		// 		{
		// 			$this->mdl_interactors->updateDetails($ft_id, $interactor_id, $interactors_data) ;
		// 		}
		// 		else{

		// 			$interactors_data['uid'] 			= $ft_id ;
		// 			$interactors_data['interactor_id']  = $interactor_id ;
		// 			$this->mdl_interactors->saveDetails($interactors_data) ;
		// 		}
		// 	}
		// 	*/

		// 	if(! empty($comment_data))
		// 	{
		// 		$this->load->model('comments/mdl_comments');
		// 		$this->mdl_comments->saveCommentArray($comment_data);
		// 	}

		// 	$this->db->trans_complete();

		// 	if ($this->db->trans_status() === FALSE)
		// 	{
		// 	     echo "Error. Error Processing Request. Try again later.";
		// 	     return;
		// 	}
			
		// 	echo "Entry successful";


		// }





		// public function is_being_assessed()
		// {
		// 	$id = $this->input->get('ft_id');

		// 	if(empty($id)){
		// 		echo false;
		// 		return;
		// 	}


		// 	if($this->mdl_first_timers->id_exists($id) == false){
		// 		echo false;
		// 		return;
		// 	}


		// 	echo ($this->mdl_first_timers->get_data_by_id($id, 'locked') == 'true' ) ? true : false ;

		// }




		// public function flag_as_being_assessed()
		// {
		// 	$id = $this->input->get('ft_id');

		// 	if(empty($id)){
		// 		echo false;
		// 		return;
		// 	}


		// 	if($this->mdl_first_timers->id_exists($id) == false){
		// 		echo false;
		// 		return;
		// 	}


		// 	echo ($this->mdl_first_timers->update($id, 'locked', 'true' ) == true ) ? true : false ;
		// }




		// public function flag_as_not_assessed()
		// {
		// 	$id = $this->input->get('ft_id');

		// 	if(empty($id)){
		// 		echo false;
		// 		return;
		// 	}


		// 	if($this->mdl_first_timers->id_exists($id) == false){
		// 		echo false;
		// 		return;
		// 	}


		// 	echo ($this->mdl_first_timers->update($id, 'locked', 'false' ) == true ) ? true : false ;
		// }




		// public function flag_as_unknown() //used in ajax function. shouldnt be used this way in a non-ajax function
		// {
		// 	$id = $this->input->get('id');

		// 	if(empty($id)){
		// 		echo false;
		// 		return;
		// 	}

		// 	//check if member id really exists
		// 	if($this->mdl_first_timers->id_exists($id) == false){
		// 		echo false;
		// 		return;
		// 	}

		// 	//is member active?
		// 	if($this->mdl_first_timers->prospect_status($id) != 'unknown'){

		// 		echo ($this->mdl_first_timers->set_to_unknown($id) == false) ? false : true ;				
		// 	}					
		// }


		// /*
		// | FLAG FUNCTONS
		// | FLAG FUNCTIONS END HERE
		// */




		// public function ajax_manage()
		// {
		// 	$get_year  = $this->input->post('year');
		// 	$get_month = $this->input->post('month');

		// 	$year  = isset($get_year) ? $get_year   : $this->date_time->full_year();
		// 	$month = isset($get_month) ? $get_month : $this->date_time->this_month();

		// 	$months = $this->date_time->months();
  //           $this->load->module('members') ;

  //           $week_list = $this->date_time->week_list($month, $year) ; // week list is an array

           
  //           $count = 1 ;
  //           $all_total = 0;
  //           $Prospective_total = 0 ;
  //           $called_total = 0;
  //           $called_total = 0;
  //           $total_in_sg = 0 ;
            
  //           $out  = "<table class='table table-bordered'>";
  //           $out .= "<th>Weeks</th>" ;
	 //        $out .= "<th>Duration</th>";
	 //        $out .= "<th>Number Of First timers</th>" ; 
	 //        $out .= "<th>Number of Prospective</th>" ;
	 //        $out .= "<th>Number of successful calls</th>" ;
	 //        $out .= "<th>Number in Small Groups</th>" ;

	 //      	if($year == $this->date_time->full_year() )
  //     		{
	 //            foreach ($week_list as $week) 
	 //            {
  //             		$in_sg_count = 0;

  //     				if($week <= $this->date_time->this_week())
	 //              	{
		//                 $out .=  "<tr>" ;
		//                 $out .= "<td>Week $count</td>" ;

		//                 $count++ ;
		//                 $dates = $this->date_time->week_dates($week, $year);

		//                 $week_start = $this->date_time->week_start_within_month($week, $month, $year);
		//                 $week_end   = $this->date_time->week_end_within_month($week, $month, $year);
		                    
		//                 $all = $this->mdl_first_timers->all($week_start, $week_end);
		//                 $all_count = $all->num_rows() ;
		//                 $all_total += $all_count ;

		//                 foreach ($all->result() as $first_timer)
		//                 {
		//                   $uid = $first_timer->uid ;
		//                   $sg_status = $this->members->get_small_group($uid) ;
		//                   if($sg_status['exists'] == true)
		//                   {
		//                     $in_sg_count++ ; 
		//                     $total_in_sg += $in_sg_count ; 
		//                   }
		//                 }

		//                 $Prospective = $this->mdl_first_timers->all_prospective($week_start, $week_end) ;
		//                 $Prospective_count = $Prospective->num_rows() ; 
		//                 $Prospective_total += $Prospective_count ;

		//                 $called= $this->mdl_first_timers->called_ft_details($week_start, $week_end);
		//                 $called_count = $called->num_rows() ;
		//                 $called_total += $called_count ;

		//                 $weeK_start_format = $this->date_time->format($week_start, 'M-d');
		//                 $weeK_end_format = $this->date_time->format($week_end, 'M-d');

		//                 $out .= "<td>".$weeK_start_format. " to ". $weeK_end_format. "</td>" ;
		//                 $out .= "<td>".$all_count."</td>" ;
		//                 $out .= "<td>".$Prospective_count."</td>" ;
		//                 $out .= "<td>".$called_count."</td>" ;
		//                 $out .= "<td>".$in_sg_count. "</td>" ;

		//                 $out .= "</tr>";
		//             }		
  //     			}
  //     		}		
     			
  // 			else
  // 			{
  // 				foreach ($week_list as $week) 
  //           	{
  //             		$in_sg_count = 0;

      				
	 //                $out .=  "<tr>" ;
	 //                $out .= "<td>Week $count</td>" ;

	 //                $count++ ;
	 //                $dates = $this->date_time->week_dates($week, $year);

	 //                $week_start = $this->date_time->week_start_within_month($week, $month, $year);
	 //                $week_end   = $this->date_time->week_end_within_month($week, $month, $year);
	                    
	 //                $all = $this->mdl_first_timers->all($week_start, $week_end);
	 //                $all_count = $all->num_rows() ;
	 //                $all_total += $all_count ;

	 //                foreach ($all->result() as $first_timer)
	 //                {
	 //                  $uid = $first_timer->uid ;
	 //                  $sg_status = $this->members->get_small_group($uid) ;
	 //                  if($sg_status['exists'] == true)
	 //                  {
	 //                    $in_sg_count++ ; 
	 //                    $total_in_sg += $in_sg_count ; 
	 //                  }
	 //                }

	 //                $Prospective = $this->mdl_first_timers->all_prospective($week_start, $week_end) ;
	 //                $Prospective_count = $Prospective->num_rows() ; 
	 //                $Prospective_total += $Prospective_count ;

	 //                $called= $this->mdl_first_timers->called_ft_details($week_start, $week_end);
	 //                $called_count = $called->num_rows() ;
	 //                $called_total += $called_count ;

	 //                $weeK_start_format = $this->date_time->format($week_start, 'M-d');
	 //                $weeK_end_format = $this->date_time->format($week_end, 'M-d');

	 //                $out .= "<td>".$weeK_start_format. " to ". $weeK_end_format. "</td>" ;
	 //                $out .= "<td>".$all_count."</td>" ;
	 //                $out .= "<td>".$Prospective_count."</td>" ;
	 //                $out .= "<td>".$called_count."</td>" ;
	 //                $out .= "<td>".$in_sg_count. "</td>" ;

	 //                $out .= "</tr>";
	            
  // 				}
  // 			}	
  			



                

                
                
            
                 

            

  //           $out .= "<tr>";
  //           $out .= "<td> </td>";
  //           $out .= "<td> Total</td>";
  //           $out .= "<td>".$all_total."</td>";
  //           $out .= "<td>".$Prospective_total."</td>";
  //           $out .= "<td>".$called_total."</td>";
  //           $out .= "<td>".$total_in_sg."</td>";
  //           $out .= "</tr>";

  //           $out .= '</table>' ;

  //           echo $out ;
		// }



		// public function visitors_data()
		// {
		// 	$get_year  = $this->input->post('year');
		// 	$get_month = $this->input->post('month');
		// 	$this->load->module('members') ;

		// 	$year  = isset($get_year) ? $get_year : $this->date_time->full_year();
		// 	$month = isset($get_month) ? $get_month :$this->date_time->this_month();
		// 	$total_days = $this->date_time->number_of_days_in_month($month, $year);

		// 	$start_date_range = $year."-".$month."-01"; // first day of the month 
		// 	$last_date_range = $year."-".$month."-".$total_days; //last day of the month


		// 	$all =  $this->mdl_first_timers->all($start_date_range, $last_date_range);
		// 	$all_count = $all->num_rows();

            

  //           $count = 1 ;

            

  //           if($all_count >= 1)
  //           {

  //           	$out  = "<table class='table table-bordered'>";
	 //            $out .= "<th>#</th>" ;
		//         $out .= "<th>UID</th>";
		//         $out .= "<th>Name</th>" ;
		//         $out .= "<th>First Time</th>" ;
		//         $out .= "<th>Next Step</th>" ; 
		//         $out .= "<th>Cell</th>" ;
		//         $out .= "<th>Department</th>" ;		        
		//         $out .= "<th>Enrollments</th>" ;


		//         foreach ($all->result() as $ft) {


		//         	$fullname = $this->mdl_first_timers->get_fullname($ft->uid);
		//         	$sg_status = $this->members->get_small_group($ft->uid) ;

		//         	if($sg_status['exists'] == true)
		//         	{
		//         		$cell = isset($sg_status['cell']) ? $sg_status['cell'] : '-' ;
		//         		$dept  = isset($sg_status['sg']) ? $sg_status['department'] : '-' ;
		//         	}else{
		//         		$cell = 'not assigned' ;
		//         		$dept = 'not assigned' ;
		//         	}

		        	
		//         	$out .=  "<tr>" ;

		//         	$out .= "<td>".$count++. "</td>" ;
	 //                $out .= "<td>".$ft->uid."</td>" ;
	 //                $out .= "<td>".$fullname."</td>" ;
	 //                $out .= "<td>".$ft->service_date."</td>" ;
	 //                $out .= "<td>".$ft->next_step."</td>" ;
	 //                $out .= "<td>".$cell."</td>" ;
	 //                $out .= "<td>".$dept. "</td>" ;
	 //                $out .= "<td>none</td>" ;

	 //                $out .=  "</tr>" ;
		//         }

		//         $out  .= "</table'>";

  //           }
  //           else
  //           {
  //           	$out = 'No first timer recorded in this month yet.' ;
  //           }
            	 
  //           echo $out ;
            
		// }






		
		
	



		
		




		
	}
?>

 