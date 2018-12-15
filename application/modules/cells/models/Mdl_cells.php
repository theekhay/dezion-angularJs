<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_cells extends CI_Model {
		

		protected $table = "cells" ;


		public function __construct(){

			parent::__construct() ;
		}

		/**
		* returns all the active cells in $this->table
		* If a zone id is provided it returns only cells in that zone ;
		* @param $zone_id {DataType: int, required: false, representation : zone id }
		* return type - array
		*/

		public function all($zone_id = null)
		{
			$this->db->where('active', TRUE) ;
			$this->db->where('deleted', FALSE) ;

			if(isset($zone_id))  $this->db->where('zone_id', $zone_id) ;

			$query = $this->db->get($this->table);
			return $query ;
		}




		/**
		* creates a new cell
		* @param $data {DataType: array, required: true, representation : an array of field-value pair representing the cell data }
		* return type - bool
		*/

		public function createCell($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}



		/**
		* Returns the current status of a cell
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
 