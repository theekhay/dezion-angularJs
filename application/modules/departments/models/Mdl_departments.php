<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_departments extends CI_Model {


		protected $table = "departments" ;


		public function __construct(){
			parent::__construct() ;
		}


		public function createDepartment($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;

		}



		public function all($team_id = null)
		{
			$this->db->where('active', TRUE) ;
			$this->db->where('deleted', FALSE) ;

			if( isset($team_id) ) 
				$this->db->where('team_id', $team_id) ;

			$query = $this->db->get($this->table);
			return $query ;
		}





		


	}

?>
 