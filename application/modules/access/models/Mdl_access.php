<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_access extends CI_Model {


		protected $table = 'access_log' ;


		public function __construct(){
            parent::__construct();
        }

		
		/**
		* Logs a user access
		* @param $user - currently logged in user.
		* @return bool.
		*/
		public function log_access($user)
		{
			$this->db->insert($this->table, $user);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}

	}
?>	

 