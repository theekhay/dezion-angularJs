<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_sg_members extends CI_Model {
		

		protected $table = "sg_members" ;


		public function __construct(){
			parent::__construct() ;
		}



		/**
		* This behaves sligthly different from the defined exists function in the parent controller
		* @param member_id {DataType: int, required: true, representation : member id }
		* return type - array ;
		*/

		public function exists( $member_id){

			$this->db->where('member_id', $member_id);			
			$query = $this->db->get($this->table);	

			if($query->num_rows() >= 1){

				$data['status'] = true ;
				$data['info'] = $query->row() ;
			}
			else{

				$data['status'] = false ;
			}

			return $data ;
		}
		
	



		/**
		* Adds a member to a small group
		* @param data {DataType: array, required: true, representation : array of user and small group info }
		* return type - bool ;
		*/

		public function addMember($data){

			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;

		}


		/**
		* get list members in a particular small group
		* if the start date and end date is provided, it returns members in a cell @param group_id that joined the cell,
		* between the start date and the end date. ---> This would especially be used when generating  membership reports.
		*
		* @param group_id {DataType: int, required: true, representation : small group id }
		* @param start_date {DataType: string, required: true, representation : valid date }
		* @param end_date {DataType: string, required: true, representation : valid date }
		* return type - object ;
		*/

		public function all($group_id, $start_date = null, $end_date = null ){

			$this->db->where('small_group_id', $group_id) ;

			if(! empty($start_date) && ! empty($end_date) ){
				$this->db->where("date_joined between '$start_date' and '$end_date' ");
			}

			$query = $this->db->get($this->table);
			return $query;
		}





		/**
		* gets the list of members in a cell that have been confirmed
		* if @param start_date AND @param end_date are provided
		* it only returns people that were confirmed within the stipulated period.
		*/
		public function get_confirmed($cell_id, $start_date = null, $end_date = null)
		{
			$this->db->where('status', True ) ;
			$this->db->where('cell_id', $cell_id);

			if(! empty($start_date) AND ! empty($end_date) ){
				$this->db->where("date_joined between '$start_date' and '$end_date' ");
			}

			$query = $this->db->get($this->table );
			return $query ;
		}





		public function confirmed($member_id)
		{
			$this->db->where('member_id', $member_id);
			$query = $this->db->get($this->table);
			return $query->row()->confirmed ;
		}




		public function get_group($member_id)
		{
			$data = array('member_id' => $member_id ) ;
			$query = $this->db->get_where($this->table, $data) ;
			return $query->row()->small_group_id ;
		}	
		
		
		
		// public function sg_membership_growth_count($sg_id, $start_date, $end_date )
		// {
		// 	$this->db->from($this->table);
		// 	$this->db->where('small_group_id', $sg_id);
		// 	$this->db->where("date_joined between $start_date and $end_date ");
		// 	$query = $this->db->get();
		// 	return $query->num_rows();
		// }	


	}

?>
 