<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_first_timers extends CI_Model {

		protected $table = 'first_timers' ;


		public function __construct(){
			
			parent::__construct() ;
		}



		/**
		* adds a new firsttimer .
		* @param $set {DataType: array, required: true, representation : associative array of firsttimer's information }
		* return type - bool
		*/

		public function register($data) 
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}





		public function all($start_date = null, $last_date = null)
		{
			$this->db->where('deleted', false);
			if(isset($start_date) && isset($last_date)){
				
				$this->db->where("service_date between '$start_date' and '$last_date' ");
			}
			
			$query = $this->db->get($this->table);
			return $query ; 
		}



		/**
		* This gets the firstimers that are not yet second timers
		* Or that are not in the second timers table
		* @param start_date
		* @param end_date
		*/
		public function firsttimers_only($start_date = null, $last_date = null)
		{
			$sql = "SELECT * from $this->table  where not exists(Select * from second_timers where first_timers.id = second_timers.firsttimer_id)" ; 
			$query = $this->db->query($sql);
			return $query ; 
		}



		



		/*
		* First timers check functions start here.
		* 
		*
		*/

		// public function is_called($uid) //returns true if visitor has been called
		// {
		// 	$data = array('uid' => $uid);
		// 	$this->db->from($this->table);
		// 	$this->db->where($data);
		// 	$query =  $this->db->get();
		// 	$row = $query->row_array();
		// 	return ($row['rhemaCall'] == 'true') ? true : false ;
		// }




		// public function is_prospective($uid) //returns true if visitor was flagged prospective
		// {
		// 	$data = array('uid' => $uid);
		// 	$this->db->from($this->table);
		// 	$this->db->where($data);
		// 	$query =  $this->db->get();
		// 	$row = $query->row_array();
		// 	return ($row['prospective'] == 'true') ? true : false ;
		// }




		// public function prospect_status($uid) //returns true if visitor was flagged prospective
		// {
		// 	$data = array('uid' => $uid);
		// 	$this->db->from($this->table);
		// 	$this->db->where($data);
		// 	$query =  $this->db->get();
		// 	$row = $query->row_array();
		// 	return $row['prospective'] ;
		// }





		// public function set_to_prospective($uid) //this function should be performed by the call center people
		// {
		// 	$data = array('prospective' => 'true');
		// 	$this->db->where('uid', $uid);
		// 	$this->db->update($this->table, $data);
		// 	return ($this->db->affected_rows() <= 0) ? false : true ;
		// }



		// public function set_to_called($uid) //sets a service status(flag) to inactive. as good as deleted.
		// {
		// 	$data = array('rhemaCall' => 'true', 'call_agent' => $this->session->username);
		// 	$this->db->where('uid', $uid);
		// 	$this->db->update($this->table, $data);
		// 	return ($this->db->affected_rows() <= 0) ? false : true ;	
		// }




		public function set_to_moved($id) //sets a service status(flag) to inactive. as good as deleted.
		{
			$data = array('moved' => 'true');
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;	
		}






		public function set_to_not_called($id) //sets a service status(flag) to inactive. as good as deleted.
		{
			$data = array('rhemaCall' => 'false', 'call_agent' => NULL);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;	
		}




		public function set_to_not_prospective($id) //sets a service status(flag) to inactive. as good as deleted.
		{
			$data = array('prospective' => 'false');
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;	
		}




		public function set_to_unknown($id) //sets a service status(flag) to inactive. as good as deleted.
		{
			$data = array('prospective' => 'unknown');
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;	
		}


		/*
		| Flag functions end here!
		*/			
	




		



		public function all_prospective($start_date_range, $last_date_range)
		{
			

			$this->db->where('prospective', 'true');
			$this->db->where("service_date between '$start_date_range' and '$last_date_range' ") ;			
			$query = $this->db->get($this->table);
			return $query ; 
		}



		// public function all_moved() 
		// {
		// 	$this->db->where('moved', 'true') ;			
		// 	$query = $this->db->get($this->table);
		// 	return $query ; 
		// }








		//number_of_called_visitors renamed to called_ft_details
		// public function called_ft_details($start_date_range, $end_date_range) //there should be a default range here
		// {
		// 	$this->db->from($this->table);
		// 	$this->db->where(array('rhemaCall'=> 'true'));
		// 	$this->db->where("service_date between '$start_date_range' and '$end_date_range' ") ;
		// 	$query = $this->db->get();
		// 	return $query;
		// }


		// public function number_of_not_called_this_week($start_date_range, $end_date_range) 
		// {
		// 	$sql = "select * from $this->table where rhemaCall = 'false' and service_date between '$start_date_range' and '$end_date_range' ";
		// 	$query =  $this->db->query($sql);
		// 	return $query->num_rows();
		// }



		// public function number_of_called_this_week($start_date_range, $end_date_range) //there should be a default range here
		// {
		// 	$sql = "select * from $this->table where rhemaCall = 'true' and service_date between '$start_date_range' and '$end_date_range' ";
		// 	$query =  $this->db->query($sql);
		// 	return $query->num_rows();
		// }



		// public function number_of_prospective_this_week($start_date_range, $end_date_range) //there should be a default range here
		// {
		// 	$sql = "select * from $this->table where prospective = 'true' and service_date between '$start_date_range' and '$end_date_range' ";
		// 	$query =  $this->db->query($sql);
		// 	return $query->num_rows();
		// }



		// public function number_of_visitors_this_weeek($start_date_range, $end_date_range) //there should be a default range here
		// {
		// 	$sql = "select * from $this->table where prospective = 'false' and service_date between '$start_date_range' and '$end_date_range' ";
		// 	$query =  $this->db->query($sql);
		// 	return $query->num_rows();
		// }



		// public function number_of_unknown_this_week($start_date_range, $end_date_range) //there should be a default range here
		// {
		// 	$sql = "SELECT * from $this->table where prospective = 'unknown' and service_date between '$start_date_range' and '$end_date_range' ";
		// 	$query =  $this->db->query($sql);
		// 	return $query->num_rows();
		// }





		// public function total_number_of_firsttimers($start_date_range, $end_date_range) //there should be a default range here, default should be a week
		// {
		// 	$sql = "select count(uid) from $this->table where flag = 'active' ";
		// 	$query =  $this->db->query($sql);
		// 	foreach ($query->row_array() as $total) {
		// 		return $total;
		// 	}
		// }


		// //this is for first Timers search
		// public function getName($name, $prospective = false)
		// {
		// 	$sql = "select * from $this->table where firstname like '%$name%' or surname like '%$name%' ";
		// 	if($prospective == true){
		// 		$sql .=   "and prospective = 'true' ";
		// 	}

		// 	$query =  $this->db->query($sql);
		// 	return $query;

		// }//this function should be tested thoroughly. and this comment should be removed after testing



		//gets the list of first timers that havent been moved to any small group

		// public function get_unmoved($match)
		// {
			
		// 	$this->db->where('moved', 'false') ;
		// 	$this->db->where('toDistrictOrTeam', 'false') ;
		// 	$this->db->where('toSmallGroup', 'false') ;
		// 	$this->db->like('firstname', $match);

		// 	$this->db->or_where('moved', 'false') ;
		// 	$this->db->where('toDistrictOrTeam', 'false') ;
		// 	$this->db->where('toSmallGroup', 'false') ;
		// 	$this->db->like('surname', $match) ;

		// 	$this->db->or_where('moved', 'false') ;
		// 	$this->db->where('toDistrictOrTeam', 'false') ;
		// 	$this->db->where('toSmallGroup', 'false') ;
		// 	$this->db->like('telephone1', $match) ;

		// 	$query = $this->db->get($this->table) ;
		// 	return $query ;
		// }



		//this is for first Timers search
		// public function getNameWithoutMoved($name, $moved = false)
		// {
		// 	$sql = "select * from $this->table where firstname like '%$name%' ";

		// 	if($moved == true)
		// 	{
		// 		$sql .= "and moved = 'false' ";
		// 	}

		// 	$sql .= " or surname like '%$name%' ";
		// 	if($moved == true)
		// 	{
		// 		$sql .= "and moved = 'false' ";
		// 	}

		// 	$sql .= " or telephone1 like '%$name%' "; // contemplating removing the wild card around telephone1s
		// 	if($moved == true)
		// 	{
		// 		$sql .= "and moved = 'false' ";
		// 	}


		// 	$query =  $this->db->query($sql);
		// 	return $query;

		// }//this function should be tested thoroughly. and this comment should be removed after testing




	



		public function this_week_bday()
		{
			$bday_list = array();
			$this->load->module('date_time');
			$firstimers = $this->all();
			foreach ($firstimers->result() as $firstimer) {
				$bday 		= $firstimer->dob;
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


		public function get_fullname($uid)
		{	
			$data = array('uid' => $uid) ;
			$query = $this->db->get_where($this->table, $data);
			$row =  $query->row();
			return $row->firstname. " ". $row->surname;
		}




	}

	?>



 