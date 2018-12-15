<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_cell_attendance_manager extends CI_Model {

		public $database1 = 'cell_attended';
		public $database2 = 'cell_absent_reason';



		public function __construct(){
			parent::__construct() ;
		}



		/*
		| FUNCTIONS THAT CHECK IF A USER EXISTS
		*/
		public function member_exist_1($member_id)
		{
			$this->db->select('id');
			$this->db->from($this->database1);
			$this->db->where('member_id', $member_id);			
			$query = $this->db->get();			 
			return ($query->num_rows() == 1 ) ? true : false ;
			
		}




		public function member_exist_2($member_id)
		{
			$this->db->select('id');
			$this->db->from($this->database2);
			$this->db->where('member_id', $member_id);			
			$query = $this->db->get();			 
			return ($query->num_rows() == 1 ) ? true : false ;
			
		}



		public function member_exists($member_id, $tbl)//for general
		{
			$this->db->select('id');
			$this->db->from($tbl);
			$this->db->where('member_id', $member_id);			
			$query = $this->db->get();			 
			return ($query->num_rows() == 1 ) ? true : false ;
			
		}
		/*
		| END MEMBER CHECK FUNCTIONS 
		*/





		/*
		| FUNCTIONS THAT DEAL WITH INSERTING NEW MEMBERS INTO THE TABLES
		*/
		public function insert_member_1($member_id){
			$data = array('member_id' => $member_id);
			$this->db->insert($this->database1, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}


		public function insert_member_2($member_id){
			$data = array('member_id' => $member_id);
			$this->db->insert($this->database2, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}



		public function insert_member($member_id, $tbl){
			$data = array('member_id' => $member_id);
			$this->db->insert($tbl, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}


		/*
		| END MEMBER INSERT FUNCTION HERE!
		*/





		/*
		| START MEMBER INSERT DATA INTO THE TABLES!
		*/
		
		public function cell_absent_reason($member_id, $abs_reason, $date)
		{
			$data = array("$date" => $abs_reason );
			$this->db->where('member_id', $member_id);
			$this->db->update($this->database2, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}




		public function mark($member_id, $attended_status, $date, $tbl)
		{
			$data = array("$date" => $attended_status );
			$this->db->where('member_id', $member_id);
			$this->db->update($tbl, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}

		/*
		| END!
		*/





		//function to check if the attendance for a particular cell or small group has been taken

		public function is_marked_1($date, $member_id){
			$this->load->model('tables/mdl_tables');

			if($this->mdl_tables->column_exists($date) == true){
				$this->db->from($this->database1);
				$this->db->where('member_id', $member_id);
				$query = $this->db->get();
				$row = $query->row_array();
				$data =  $row[$date];
				return ($data == null) ? false : true ;
			}
		}





		public function is_marked_2($date, $member_id){
			$this->load->model('tables/mdl_tables');

			if($this->mdl_tables->column_exists($date) == true){
				$this->db->from($this->database2);
				$this->db->where('member_id', $member_id);
				$query = $this->db->get();
				$row = $query->row_array();
				$data =  $row[$date];
				return ($data == null) ? false : true ;
			}
		}


		
		
		
		/*
		| FUNCTION TO RETURN THE DATE COLUMNS IN A TABLE
		*/
		
		/**
		| returns the list of fields in the attendance table as valid dates. which aslo represents the date the attendance was taken
		| represented in the database in the form 01_10_2016 for(01-10_2016).
		| @param $month an int representaion of a month of the year
		| example. 01 for january, 02 for february, 12 for december
		| used to get date columns that belong to the supplied $month parameter
		*/
		public function attended_cols($month = null)
		{
			$dates = array();
			$this->load->module('date_time');
			$this->load->model('tables/mdl_tables');
			$column_dates = $this->mdl_tables->list_columns_in_table($this->database1);
			
			foreach ($column_dates as $date) {
				$date = str_replace('_', '-', $date);
				if($this->date_time->date_check($date) == true){

					if($month != null) //makes sure month is within the valid range 
					{
						if($month >= 1 && $month <= 12){
							if($this->date_time->this_month($date) == $month)
							{
								$dates[] = $date ;
							}
						}
						else
						{
							return $dates;
						}
						
					}
					else
					{
						$dates[] = $date ;
					}

				} 
			}
			return $dates;
		}
		
		
		
		
		public function abs_reason_cols()
		{
			$this->load->module('date_time');
			$column_dates = $this->mdl_tables->list_columns_in_table($this->database2);
			
			foreach ($column_dates as $date) {
				$date = str_replace('_', '-', $date);
				if($this->date_time->date_check($date) == true){
					$dates[] = $date ;
				} 
			}
			return $dates;
		}
		
		
		/*
		| FUNCTION TO RETURN THE DATE COLUMNS IN A TABLE
		*/
		
		
		
		public function member_att_status($member_id, $date)
		{
			$new_date = str_replace('-', '_', $date);
			$this->db->from($this->database1);
			$this->db->where('member_id', $member_id);
			$query = $this->db->get();
			$row = $query->row_array();
			return $row[$new_date];
		}



		public function member_att_stat($member_id, $date, $tbl)
		{
			$new_date = str_replace('-', '_', $date);
			$this->db->from($tbl);
			$this->db->where('member_id', $member_id);
			$query = $this->db->get();
			$row = $query->row_array();
			return $row[$new_date];
		}

		



		public function member_absent_reason($member_id, $date)
		{
			$new_date = str_replace('-', '_', $date);
			$this->db->from($this->database2);
			$this->db->where('member_id', $member_id);
			$query = $this->db->get();
			$row = $query->row_array();
			return $row[$new_date];
		}


	/*
	end member status report
	*/


	public function member_avg_cell_attendnace($member_id, $month)
	{
		$count = 0 ;
		$dates = $this->attended_cols($month);
		if(! empty($dates))
		{
			$date_count = count($dates);

			foreach ($dates as $date) {
				if($this->member_att_status($member_id, $date) == "1")
					$count += 1;
			}
			return $count / $date_count;
		}
		
	}



	/*
	| This function is used to record members attendance
	| @param $date represents the date for which the attendnace is being taken.
	| the date is converted by replacing (-, /, .) with (_) i.e 01-01-2016 would be 01_01_2016.
	| the coverted date represents the column name in the database specified in @param db
	|
	| @param $db represents the database currently used. it would usually be a concatenation
	| of the word 'att_' with the code represenation of the attendance category being marked for.
	|
	| @param $member_id represents the member id being inserted for.
	*/
	public function is_taken($date, $tbl, $m)
	{
		$this->db->from($tbl);
		$this->db->where('member_id', $m);
		$query = $this->db->get();
		$row = $query->row_array();
		return ($row[$date] == null) ? false : true ;
	}



	}
?>


 