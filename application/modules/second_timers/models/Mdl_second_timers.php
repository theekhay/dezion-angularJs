<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_second_timers extends CI_Model {

		protected $table = 'second_timers';



		public function __construct(){

			parent::__construct() ;
		}



		public function addSecondTimer($data) 
		{
			if(! is_array($data))
				return false;
						
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}




		public function all($start_date = null, $last_date = null) 
		{
			$this->db->where('deleted', false);

			if( isset($start_date) AND isset($last_date) ){
				$this->db->where("service_date between '$start_date' and '$last_date' ");
			}
			
			$query = $this->db->get($this->table);
			return $query ; 
		}	


		/**
		* Gets the firsttimers that have come a second time
		* For reporting purposes and tracking assimilation
		* @param $start_date
		* @param $end_date
		* @return result object.
		*/
		public function assimilated($start_date = null, $end_date = null){

			$this->db->from($this->table);
			$this->db->join('first_timers', "first_timers.id = $this->table.firsttimer_id");

			if( isset($start_date) && isset($end_date) ){
				$this->db->where("first_timers.service_date between '$start_date' and '$end_date' ");
			}
			
			$query = $this->db->get();
			return $query;
		}
		
	



	

		//returns a second timers full name
		public function get_fullname($id)
		{	
			$this->db->from($this->table);
			$this->db->where(array('id'=> $uid));
			$row = $this->db->get()->row();
			return $row->firstname. " ". $row->surname ;
		}

		



		//get second timers that have bday this week
		//this should be streamlined to second timers that have not been assimilated
		public function this_week_bday()
		{
			$bday_list = array();
			$this->load->module('date_time');
			$secondtimers = $this->all();
			foreach ($secondtimers->result() as $secondtimer) {
				$bday 		= $secondtimer->dob;
		        $bday_day   = $this->date_time->this_day($bday);
		        $bday_month = $this->date_time->this_month($bday);
		        $this_yr   	= $this->date_time->full_year();
		        $full 		= $bday_day ."-". $bday_month. "-". $this_yr;
		        if($this->date_time->this_week($full) == $this->date_time->this_week()){
                  $bday_list[] = $firstimer->uid;
                }
			}
			return $bday_list; 
			
			
		}




	}

	?>

 