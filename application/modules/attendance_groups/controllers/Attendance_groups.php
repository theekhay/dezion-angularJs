<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Attendance_groups extends MX_Controller {


		public function __construct()
		{
			parent::loggedIn();
			$this->load->model('attendance_groups/mdl_attendance_groups');
		}



		public function index()
		{
			$this->createAttendanceView();
		}



		public function createAttendanceView()
		{
			$this->load->view('createAttendanceCategory') ;
		}




		public function mangeAttendancesView()
		{
	
			$this->load->view('allAttendances') ;
		}



		public function attendanceInfo(){

			$attendance_id = $this->input->get('attendance_id') ;
			echo json_encode($this->mdl_attendances->get_info($zone_id) ) ;
		}



		public function create()
		{
			if( null !== $this->input->get('attendance') ){

				$attendance =  $this->input->get('attendance') ;

				$this->load->dbforge();


				if( empty($attendance->name) ||  empty($attendance->target)  || empty($ttendance->abbrevation) ){
					throw new Exception("Important fields missing "  );
					
				}


				$check = $this->mdl_attendance_categories->exists( ['name' => $attendance->name, 'abbrevation' => $attendance->abbrevation] ) ; 

				if( $check['feedback'] ){
					throw new Exception("Attendace with this ". $check['field']. " exists.Duplicates not allowed!");
					
				}


				
				// if($this->form_validation->run() == false){
				// 	$errors = $this->form_validation->error_array();
					
				// 	foreach ($errors as $key => $value) {
				// 		$error[] = $value;
				// 	}
					
				// 	$this->createAttendance($error[0], 'report-error');
				// 	return;										
				// }
			

							
				$att_name = str_replace(' ', '_', trim($code)); //repalces any spaces if there is with an '_'
				$year = $this->date_time->full_year();	
				$db_att_name = "att_".$att_name."_".$year; //append att_ to show its an attendance table



				if($this->create_attendance_table($db_att_name) == false){
					$this->createAttendance('System Error! unable to process resource required to complete this operation.', 'report-error');
					return;
				}
				


				if($this->mdl_tables->table_exists($db_att_name) == true ){

					if($this->model()->add_attendance($name, $code, $abbr, $target, $description) == false){
						$this->mdl_tables->dropTable($db_att_name);
						$this->createAttendance("Oops! Attendance category couldn't be created at the moment. Try again soon", 'report-error');
						return;
					}
				}
				else{
					$this->createAttendance('System Error! Resource required to complete this operation not found. Contact Admin','report-error');
					return;
				}
						

				$data = array('message'=> 'Attendance category created Successfully', 'report_class' => 'report-success');
				$this->session->set_flashdata($data);
				redirect(current_url());					
					
			}else{
				$this->createAttendance();
			}
			
		}





		/*
		|------------------------------------------------------------------------------------|
		|		               function create_attendance_table()							 |
		|------------------------------------------------------------------------------------|
		| @param $table_name ($tbl_name) string. 										     |
		| The $tbl_name param represents the name of the table to be created				 | 
		| This function only does one thing - creates a new instance of an attendance table. |
		| The table would contain the defaault columns(fields) --> id & member_id 			 |
		|------------------------------------------------------------------------------------|
		*/

		public function create_attendance_table($tbl_name)
		{
			//$this->load->model('tables/mdl_tables');

			if( ! $this->db->table_exists($table_name) ){

				$this->dbforge->add_field('id') ;
				$this->dbforge->add_field('member_id varchar(12) not null') ;

				return ( $this->dbforge->create_table($table_name, TRUE) ) ? true : false ;
			}

			return false ;
			
		}






		/**
		|------------------------------------------------------------------------------------|
		|		                   function date_to_column($date)							 |
		|------------------------------------------------------------------------------------|
		| @param $date string.       			 										     |
		| The $date param should be a valid date  											 | 
		| This function converts a valid date to an attendance date column 					 |
		| The function would return a sting in the format 2016_10_01				 		 |
		|------------------------------------------------------------------------------------|
		*/

		public function date_to_column($date)
		{
			$date = trim( $this->date_time->format($date, 'Y-m-d') ) ;

			$search = array('/','-','.') ; //possible date separtors
			return str_replace($search, '_', $date) ;
		}


	}
?>

 