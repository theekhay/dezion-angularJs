<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_attendance_groups extends CI_Model {


		protected $table = "attendance_groups" ;


		public function __construct(){

			parent::__construct() ;
		}
		


		public function create( $data )
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0 ) ? false : true ;
		}




		public function all($category = 'both')
		{
			$this->db->where('active', true) ;
			$this->db->where('category', $category);
			$query = $this->db->get($this->table) ;
			return $query ;
		}


		/**
		* Returns the current status of a cateory
		* @param $id {DataType: int, required: true, representation : cell id }
		* return type - bool
		*/

		public function status($id) 
		{
			$data = array('id' => $id);
			$query = $this->db->get_where($this->table, $data);
			return  $query->row()->status  ;
		}


	}

?>	

 