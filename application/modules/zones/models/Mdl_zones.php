<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_zones extends CI_Model {


		protected $table = "zones";


		public function __construct(){

			parent::__construct() ;
		}




		public function createZone($data){

			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;

		}




		public function zones_in_comm_count($community_id)
		{
			$data = array('community_id' => $community_id);
			$query = $this->db->get_where($this->table, $data);
			return $query->num_rows();		

		}

	

		public function all($community_id = null)
		{
			$this->db->where('active', TRUE);
			$this->db->where('deleted', FALSE );

			
			if(isset($community_id) )   $this->db->where('community_id', $community_id )  ;
			$query = $this->db->get($this->table);
			return $query;
		}




		

		public function status($id) //returns true if flag is  inactive
		{
			$data = array('id' => $id);
			$query = $this->db->get_where($this->table, $data);
			return $query->row()->active ;
		}



		/**
		* sets a zone active status to true.
		* @param $id {DataType: int, required: false, representation : community id }
		* return type - bool
		*/

		public function activate($id) 
		{
			$data = array('active' => FALSe);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;	
		}




		/**
		* sets a zone active status to false.
		* @param $id {DataType: int, required: true, representation : zone id }
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
 