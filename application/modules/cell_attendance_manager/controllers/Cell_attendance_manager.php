<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cell_attendance_manager extends MX_Controller {


		public function __construct()
		{
			parent::loggedIn() ;
			$this->load->model('cell_attendance_manager/mdl_Cell_attendance_manager') ;
			//$this->load->module('attendances') ;

		}


		public function index()
		{
			$this->markAttendanceView();
	
		}



		public function markAttendanceView()
		{
			$this->load->view('cellAttendanceSheet') ;
		}



		public function commit_attendance()
		{

			if( null !== $this->input->post('submit') ){

				$attendance = json_decode( $this->input->get('attendance') ) ;

				try{

					if(empty($attendance->cell_id)){
						throw new Exception("Error: Invalid cell") ;
					}

					$this->load->model('cell_members/mdl_cell_members');
					$cell_members = $this->mdl_cell_members->all($attendance->cell_id)->result() ;

					if( empty($attendance->date) ){
						throw new Exception('Warning: missing date ') ; 
					}
	
					if( is_future($attendance->date) ){
						throw new Exception('Warning: Date cannot be in the future') ;
					}
	
					if(is_valid($attendance->date) ){
						throw new Exception('Warning: Invalid date') ;
					}

					$this->load->dbforge() ;
					$this->load->model('attendances/mdl_attendances') ;

					$date 	 = $attendance->date ; 
					$cell_id = $attendance->cell_id ;

					foreach ($cell_members as $cell_member) {
						$members[] =  $cell_member->member_id ;
					}
				
				}
				catch(Exception $e){

					$data['message'] = $e->getMessage();
					$data['status']  = 'error' ;
				}

			
				

				


				// this member insertion check only controls for the absent reason tables.
				if(! empty($members) )
				{
					foreach ($members as $m)
					{
						if(! $this->model()->member_exist_2($m) )
						{
							$this->model()->insert_member_2($m);
						}							
					}
				}


				/*
				if($this->mdl_tables->column_exists('cell_absent_reason', "$new_date") == false){
					$fields = array(
				        			"$new_date" => array('type' => 'varchar', 'constraint' => 10)
								);
					if($this->dbforge->add_column("cell_absent_reason", $fields) == false){
						$this->markAttendance('System Error! unable to create resource to accomodate this attendance', 'report-error');
						return;
					}
				}
				*/


				//convert date to column - this is what is stored in the db as a column
				$new_date = $this->attendances->date_to_column($date);

				//get the list of attendance linked to cells.
				$attendances = $this->mdl_attendances->all('cell');				

				if(! empty($members))
				{
					foreach ($attendances->result() as $att) {

						$att_code = $att->code;
						$year = $this->date_time->full_year();
						$table = "att_". $att->code. "_" .$year  ; //get the table to insert into.


						//create table if table doesnt exist.
						if(! $this->attendances->create_attendance_table($table) ){
							$this->markAttendance('System Error! unable to process resource required to complete this operation.', 'report-error');
							return;
						}



						//create the date as a column if the date column doesnt exist.
						if($this->mdl_tables->column_exists($table, $new_date) == false)
						{

							$fields = array( $new_date => array('type' => 'varchar', 'constraint' => 10) );

							if($this->mdl_tables->add_column($table, $fields) == false){
								$this->markAttendance('System Error! unable to create resource to process this attendance', 'report-error');
								return;
							}	
						}

						foreach ($members as $m) 
						{
					
							$stat_name = $m.'_'. $att_code ; //get the checkboxname

							//check to see if member was marked present or absent (i.e if form was checked);
							//1 represents present and 0 represents absent.								
							$att_cat_stat = ($this->input->post($stat_name) != NULL) ?  '1' : '0' ;
								

							//insert member if member uid doesnt exist in the database.
							if(! $this->model()->member_exists($m, $table) ){
								$this->model()->insert_member($m, $table); 
							}
			

							//insert data into the table specified in @table
							if(! $this->mdl_cell_attendance_management->is_taken($new_date, $table, $m ) ){
								$this->model()->mark($m, $att_cat_stat, $new_date, $table);
							}	
						}//end for each for members

					}//end foreach for attendance

					//$abs_reason = ($this->input->post($m) != NULL) ?  $this->input->post($m) : '0' ;
					//$this->model()->mark($m, $abs_reason, $new_date, 'cell_absent_reason');
				}

				$data = array('message'=> 'Attendance record for this cell successful', 'report_class' => 'report-success');
				$this->session->set_flashdata($data);
				redirect(current_url());

		
			}//end submit
			else{
				$this->markAttendance();
			}	
		}//end function




	}	
	
?>

 