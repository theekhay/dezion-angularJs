<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_small_groups extends CI_Model {



		protected $table = "small_groups";



		public function __construct(){
			parent::__construct() ;
		}



		public function createSmallGroup($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0 ) ? false : true ;
		}


		
		public function all( $department_id = null )
		{
			$this->db->where('active', TRUE) ;
			$this->db->where('deleted', FALSE) ;

			if(isset($department_id)) 
				$this->db->where('department_id', $department_id) ;

			$query = $this->db->get($this->table);
			return $query ;
		}


	}

?>	

 