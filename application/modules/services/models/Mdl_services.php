<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_services extends CI_Model {

		protected $table = 'services'; //services



		public function __construct(){
			parent::__construct() ;
		}


	
		public function createService($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;

		}




		public function all($status = 1)
		{
			$this->db->where('active', true );
			$this->db->where('deleted', FALSE );
			$query = $this->db->get($this->table);
			return $query;
		}
	}	




	 	
	
	?>

 