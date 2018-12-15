<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_api extends CI_Model {


		protected $table = 'administrators' ;


		public function __construct(){
            parent::__construct();
        }

		
		/**
		* validate administrator's existence -  i.e checks to see if the admin exists in the table
		* @param  username {DT: varchar, required: true, representation :  - administraor's username }
		* Return_type: bool
		*/
		public function admin_exists($username)
		{
			$this->db->where('username', $username);
			$query = $this->db->get($this->table);
			return ($query->num_rows() >= 1 ) ? true : false ;
		}





		/**
		* Retreive administrator's id  
		* @param  username {DataType: varchar, required: true, representation : administraor's username }
		* Return_type: int OR NULL if not found.
		*/
		public function get_id($username)
		{
			$this->db->where('username', $username);
			$query = $this->db->get($this->table);
			return ($query->num_rows() >= 1 )  ? $query->row()->id : NULL ;
		}



		/**
		* Retreive administrator's password   
		* @param  admin {DataType: int/varchar, required: true, representation : admin's id or admin username }
		* The @param admin could be either the administrator's username or id as both of them are unique to the admin.
		* Return_type: string OR NULL if not found.
		*/

		public function get_password($admin)
		{
			$this->db->where('id', $admin);
			$this->db->or_where('username', $admin);
			$query = $this->db->get($this->table);
			return ($query->num_rows() >= 1 ) ?  $query->row()->password : NULL ;
		}





		public function all_administrators(){

			$query = $this->db->get($this->table) ;
			return $query ;
		}




		




	}

 