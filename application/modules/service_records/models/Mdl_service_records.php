<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_service_records extends CI_Model {


		protected $table = 'service_records';

 
		public function __construct(){

			parent::__construct() ;
		}



		/**
		* Stores Data related to a service 
		* @param data 
		* it takes in an array as a paramter, where the array keys represent fields,
		* and the array values represnt database entry values;
		*/

		public function newServiceRecord($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}



		public function all()
		{
			//$this->db->where('active', TRUE) ;
			//$this->db->where('deleted', false) ;
			return $this->db->get($this->table);
		}


		public function generateReort($start, $end){
			
			$this->db->where("service_date between $start and $end ") ;
			return $this->db->get($this->table);
		}

	}
?>	

 