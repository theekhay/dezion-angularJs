<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Teams extends MX_Controller {


		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('teams/mdl_teams');
			$this->load->model('reports/mdl_reports');
		}




		public function index()
		{
			$this->view_all();
		}



		/**
		* Loads the create Team view
		*/

		public function create(){	
			$this->load->view('createTeam') ;
			
		}



		/**
		* Returns information about a Team
		* The team id is passed as a query string 
		* return type - json object
		*/
		public function teamInfo(){

			$team_id = $this->input->get('team_id') ;
			$teams = $this->mdl_teams->get_info($team_id) ;
			echo json_encode($teams) ;

		}





		/**
		* Returns a list of active teams as a json object 
		*
		*/

		public function getTeams(){

			echo json_encode($this->mdl_teams->all()->result() ) ;
		}


		
		/**
		* Loads the Team page view
		* This would usually be a list of teams. 
		*
		*/

		public function teamPage()
		{			
			$this->load->view('teamPage');
		}




		// public function report()
		// {
		// 	$this->fail_safe('107');

		// 	$this->load->model('departments/mdl_departments');
		// 	$this->load->model('reports/mdl_reports');
		// 	$all_teams = $this->mdl_teams->all();
		// 	$count = $all_teams->num_rows();

		// 	$months = $this->date_time->months();
		// 	$year = $this->date_time->full_year();
			
		// 	foreach ($all_teams->result() as $team) {
		// 		$mg = array();

		// 		$team_names[] = $team->name;
		// 		$team_codes[] = $team->code;
		// 		$team_heads[] = $team->head;

		// 		$dept_count 	= $this->mdl_departments->dept_in_team_count($team->id);
		// 		//$dptsvc_count 	= $this->mdl_reports->dptsvc_in_team_count($team->id);
		// 		$sg_count 		= $this->mdl_reports->sg_in_team_count($team->id);
		// 		$members_count 	= $this->mdl_reports->members_in_team_count($team->id);


		// 		foreach ($months as $key => $value) {
					
		// 			if($value <= $this->date_time->this_month() ){

		// 				$num_of_days_in_month = $this->date_time->number_of_days_in_month($value, $year);
		// 				$start_date = "$year-$value-01";
		// 				$end_date 	= "$year-$value-$num_of_days_in_month";
		// 				$mg[] = $this->mdl_reports->members_in_team_count($team->id, $start_date, $end_date);
		
		// 			}
					
		// 		}

				


		// 		$number_of_comm[] = array('name'=>$team->name, 'data' => array($dept_count, $sg_count, $members_count) );
		// 		$monthly_growth[] = array('name'=>$team->name, 'data' => $mg );
		// 	}//end main foreach

		// 	foreach ($months as $key => $value) {
		// 		if($value <= $this->date_time->this_month() ){
		// 			$cat[] = $key;
		// 		}
		// 	}

		// 	$data['module'] = $this->module;
		// 	$data['view_file'] = 'teamReport';
		// 	$data['title'] = 'Team Report';

		// 	$data['count'] = $count ;
	
		// 	$data['comm_count'] 	= ! empty($number_of_comm) ? json_encode($number_of_comm) : NULL;
		// 	$data['monthly_growth'] = ! empty($monthly_growth) ?json_encode($monthly_growth) : NULL;
		// 	$data['categories'] 	= json_encode($cat);
			
		// 	$data['add_btn'] 		= false;
		// 	$data['btn_link'] 		= base_url() ."teams/createTeam";
		// 	$data['btn_title'] 		= "create new Team";
		// 	$data['top_data'] 		= "Team Reports";
		// 	$data['icon_class'] 	= 'fa fa-area-chart' ;
		

		// 	echo Modules::run('templates/gen', $data);
		// }







		// public function teamPageReport()
		// {
		// 	$this->fail_safe('107');

		// 	$team_id 	= $this->input->get('team_id');
		// 	$team_name 	= $this->mdl_teams->get_name($team_id);
		// 	$team_code  = $this->mdl_teams->get_code($team_id);
		// 	$team_head 	= $this->mdl_teams->get_data_by_id($team_id, 'head');

		// 	$months = $this->date_time->months();
		// 	$year = $this->date_time->full_year();
		// 	$this->load->model('departments/mdl_departments');

		// 	$dept_count 	= $this->mdl_departments->dept_in_team_count($team_id);
		// 	//$dptsvc_count 	= $this->mdl_reports->dptsvc_in_team_count($team_id);
		// 	$sg_count 		= $this->mdl_reports->sg_in_team_count($team_id);
		// 	$members_count 	= $this->mdl_reports->members_in_team_count($team_id);


		// 	foreach ($months as $key => $value) {
					
		// 		if($value <= $this->date_time->this_month() ){

		// 			$num_of_days_in_month = $this->date_time->number_of_days_in_month($value, $year);
		// 			$start_date = "$year-$value-01";
		// 			$end_date 	= "$year-$value-$num_of_days_in_month";
		// 			$mg[] = $this->mdl_reports->members_in_team_count($team_id, $start_date, $end_date);
	
		// 		}
				
		// 	}


		// 	foreach ($months as $key => $value) {
		// 		if($value <= $this->date_time->this_month() ){
		// 			$cat[] = $key;
		// 		}
		// 	}

		// 	$test[] = $dept_count ;				
		// 	$test[] = $sg_count ;
		// 	$test[] = $members_count ;

		// 	$number_of_comm[] = array('name'=>$team_name, 'data' => $test) ;				
		// 	$monthly_growth[] = array('name'=>$team_name, 'data' => $mg );

		// 	$data['team_id'] 			= $team_id;
		// 	$data['team_head'] 			= $team_head;
		// 	$data['team_name'] 			= $team_name;
		// 	$data['team_code'] 			= $team_code;
		// 	$data['members_count'] 		= $members_count;

		// 	$data['comm'] 				= json_encode($number_of_comm);
		// 	$data['monthly_attendance'] = json_encode($monthly_growth);
		// 	$data['categories'] 		= json_encode($cat);

		// 	$data['module'] = $this->module;
		// 	$data['view_file'] = 'teamPageReport';
		// 	$data['title'] = "$team_name report ";
			
		// 	$data['add_btn'] 		= false;
		// 	$data['btn_link'] 		= base_url() ."districts/createDistrict";
		// 	$data['btn_title'] 		= "create new District";
		// 	$data['top_data'] 		= " $team_name report";
		// 	$data['icon_class'] 	= 'fa fa-area-chart' ;

		// 	echo Modules::run('templates/gen', $data);

		// }


		

		public function newTeam()
		{
			
			$name = $this->input->get('name') ;
			$abbr = $this->input->get('abbrevation') ;
			$head = $this->input->get('head') ;

			try{

				if(empty($name)  OR empty($abbr)){

					throw new Exception("Warning: Important fields missing") ;
				}


				// if(! $this->form_validation->run() ){
				// 	$errors = $this->form_validation->error_array();	
				// 	throw new Exception(reset($errors));										
				// }

				$team_data = (! empty($head) ) ? ['name' => $name, 'abbrevation' => $abbr, 'head' => $head ] : ['name' => $name, 'abbrevation' => $abbr ] ;

				$feedback = $this->mdl_teams->exists($team_data) ; 

				if($feedback['status'] == true ){
					throw new Exception("Team with this ". $feedback['field']." already exists. Duplicates not allowed!") ;
				}

				$team_data ['created_by'] 	= $this->session->admin_id ;
				$team_data ['date_created'] = $this->date_time->format(unix_to_human(now() ), 'Y-m-d' ) ;


				if(! $this->mdl_teams->create($team_data) ){

					throw new Exception("Error: Unable to create team");
				}


				$data['status'] = 'success' ;
			}
			catch(Exception $e)
			{
				$data['message'] = $e->getMessage();
				$data['status'] = 'error' ;
			}			
			
			echo json_encode($data) ;
			
		}



		public function drop()
		{
			$team_id = $this->input->get('team_id')  ;

			try{

				if( empty($team_id) ){
					throw new Exception("no Team selected");
				}


				if(! $this->mdl_teams->drop($team_id) ){
					throw new Exception("Error processing request");
				}

				$data['status'] = 'success' ;
					
			}catch(Exception $e){

				$data['status']  = 'error' ;
				$data['message'] = $e->getMessage() ;
			}	


			echo json_encode($data) ;	
		}

		
	}
	
?>

 