<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_cell_members extends CI_Model {


		protected $table = "cell_members" ;



		public function __construct(){
			parent::__construct() ;
		}


		/**
		* This behaves sligthly different from the defined exists function in the parent controller
		* @param member_id {DataType: int, required: true, representation : member id }
		* return type - array ;
		*/

		public function exists( $member_id)
		{
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
		* Adds a member to a cell
		* @param data {DataType: array, required: true, representation : array of user and cell info }
		* return type - bool ;
		*/

		public function addMember($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}


		/**
		* get members from this table
		* if a cell id is provided, it returns members in that cell
		* if the start date and end date is provided, it returns members in a cell @param cell_id that joined the cell,
		* between the start date and the end date. ---> This would especially be used when generating  membership reports.
		*
		* @param cell_id {DataType: int, required: true, representation : cell id }
		* @param start_date {DataType: string, required: true, representation :valid date }
		* @param end_date {DataType: string, required: true, representation : valid date }
		* return type - object ;
		*/

		public function all($cell_id, $start_date = null, $end_date = null )
		{
			$this->db->where('cell_id', $cell_id) ;

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
		* return type = object
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



		public function get_cell($member_id)
		{
			$data = array('member_id' => $member_id ) ;
			$query = $this->db->get_where($this->table, $data) ;
			return  $query->row()->cell_id ;
		}



		/**
		* Overrides the drop method in the parent method class
		* Removes a member from a cell
		* @param cell_id
		* @param member_id
		* @NTS : only the member id is needed really. Cell members are supposed to belong to only one cell per time
		*/
		public function removeMember($cell_id, $member_id)
		{
			$data  = array('cell_id' => $cell_id , 'member_id'=> $member_id);
			$this->db->delete($this->table, $data) ;
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}


	
		

	}

?>
 