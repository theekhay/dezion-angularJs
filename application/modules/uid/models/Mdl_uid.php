<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_uid extends CI_Model {

		protected $table = 'uid_monitor' ;




		/**
		* checks to see if the current MonthYear (MY) row exists.
		* The MY (monthYear) forms a part of the User Identifiaction Number (UID).
		* The current MY is stored in the db with the max uid generated for that MY.
		* @param $my {DataType: int, required: true, representation : a 4 digit representation of the current month & year i.e 0416, 0417 }
		* return type - bool
		*/
		public function row_MY_exists($my)
		{
			$this->db->from($this->table);
			$this->db->where('month_year', $my);
			$query = $this->db->get();
			return ($query->num_rows() >= 1) ? true : false ;  
		}


		/**
		* creates the current MonthYear (MY) row in $this->table .
		* The MY (monthYear) forms a part of the User Identifiaction Number (UID).
		* @param $my {DataType: int, required: true, representation : a 4 digit representation of the current month & year i.e 0416, 0417 }
		* return type - bool
		*/
		public function create_MY_row($my)
		{
			$data = array('month_year' => $my);
			$this->db->insert($this->table, $data);
			return ( $this->db->affected_rows() <= 0 ) ? false : true ;
		}



		/**
		* Retreives the current MY_max (current highest UID) for the specifed MY (monthYear)
		* @param $my {DataType: int, required: true, representation : a 4 digit representation of the current month & year i.e 0416, 0417  }
		* return type - int
		*/
		public function get_MY_max($my)
		{
			$this->db->from($this->table);
			$this->db->where('month_year', $my);
			$query = $this->db->get();
			return $query->row()->MY_max;
		}



		/**
		* updates the current MY_max (current highest UID) for the specifed MY (monthYear)
		* This hapens when a new user is registered in any of the UID-generating modules.
		* The system updates the MY_max to reflect the change in state of the My_max.
		* @param $MY {DataType: int, required: true, representation : a 4 digit representation of the current month & year i.e 0416, 0417  }
		* @param $max {DataType: int, required: true, representation : the new current highest UID for specifeid MY in @param $MY }
		* return type - bool
		*/
		public function update_MY($MY, $max)
		{
			$data = array('MY_max' => $max);
			$this->db->where('month_year', $MY);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}




	}

?>	

 