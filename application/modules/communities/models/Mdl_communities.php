<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_communities extends CI_Model {
		

		protected $table = "community";


		public function construct(){
			parent::__construct() ;
		}


		/**
		* creates a new community
		* @param $data {DataType: array, required: true, representation : an array of field-value pair representing the community data }
		* return type - bool
		*/

		public function create($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;

		}



		/**
		* returns all the community in $this->table
		* If a district id is provided it returns only commuites in that district ;
		* @param $district_id {DataType: int, required: false, representation : district id }
		* return type - array
		*/

		public function all($district_id = null)
		{
			$this->db->where('active', TRUE) ;

			if(isset($district_id)) 
				$this->db->where('district_id', $district_id) ;

			$query = $this->db->get($this->table);
			return $query ;
		}



		/**
		* returns all the number of communities in a given district.
		* @param $district_id {DataType: int, required: true, representation : district id }
		* return type - int
		*/

		public function communities_in_district_count($district_id)
		{
			return $this->all()->num_rows() ;		

		}



		/**
		* Returns the active status of a community
		* @param $id {DataType: int, required: true, representation : community id }
		* return type - bool
		*/

		public function status($id) 
		{
			$data = array('id' => $id);
			$query = $this->db->get_where($this->table, $data);
			return  $query->row()->active  ;
		}




		/**
		* sets a community active status to true.
		* @param $id {DataType: int, required: false, representation : community id }
		* return type - bool
		*/

		public function activate($id) //sets a service status(flag) to inactive. as good as deleted.
		{
			$data = array('active' => FALSe);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;	
		}




		/**
		* sets a community active status to false.
		* @param $id {DataType: int, required: true, representation : community id }
		* return type - bool
		*/

		public function deactivate($id) 
		{
			$data = array('active' => FALSe);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}


	}

?>
 