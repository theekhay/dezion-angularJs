<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_roles extends CI_Model {


		protected  $table = 'roles';


		public function __construct(){

			parent::__construct() ;
		}


		/**
		* Adds a new role to the roles table   
		* @param  data {DataType: array, required: true, representation : array of information about the new role  } 
		* Return type : bool.
		*/
		public function new_role($role_data)
		{
			$this->db->insert($this->table, $role_data);
			return ( $this->db->affected_rows() <= 0) ? false : true ;
		}



		/**
		* Returns all active roles
		*/
		public function all()
		{
			$this->db->where('active', true ) ;
			$this->db->where('deleted', false ) ;
			return $this->db->get($this->table );
		}

	}
?>	

 



 