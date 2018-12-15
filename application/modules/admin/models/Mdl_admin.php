<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_admin extends CI_Model {

		public $table = 'administrators';



		public function __construct()
		{
			parent::__construct() ;
		}



		public function newAdmin($data){

			$this->db->insert($this->table, $data) ;
			return ($this->db->affected_rows() <= 0) ?  false : true ;		
		}




		/**
		* Retreives data about the loggedin admin using the admin's id or username   
		* @param  identifier {DataType: int/string, required: true, representation : admin's id or username   }
		* @param  field {DataType: varchar, required: false, representation : valid column in $this->table } 
		* NB: This implementaton overrides the one in the parent class
		* Return_type: string OR array.
		*/

		public function get_info($identifier, $field = null)
		{
			$this->db->where('id', $identifier);
			$this->db->or_where('username', $identifier);
			$query = $this->db->get($this->table);
			return (! empty($field) ) ? $query->row()->$field : $query->row() ;
		}



		public function all( $role_id = null )
		{
			$this->db->where('active', 1) ;

			if(isset( $role_id ) )
				$this->db->where('role_id', $role_id ) ;

			$query = $this->db->get($this->table);
			return $query ;
		}



		public function administrators($role_id = null){

			$sql = "SELECT ad.id as admin_id, ad.username, ad.profile_pic, ad.member_id, ad.role_id, ad.role_id, ad.active, mb.*  From administrators as ad JOIN members as mb ON mb.id = ad.member_id where ad.active = 1" ;

			if(isset($role_id) ) $sql .= " and administrators.role_id = $role_id " ;
			$query = $this->db->query($sql) ;
			return $query ;

		}




		public function is_active($id) //returns true if flag is  inactive
		{
			$data = array('id' => $id);
			$this->db->get_where($this->table, $data);
			$row =  $this->db->get()->row() ;
			return $row->active ;
		}



		public function get_admin_id_by_member_id($member_id)
		{
			$this->db->from($this->table);
			$this->db->where('member_id', $member_id);
			$query = $this->db->get();
			return $query->row()->id;
		}		



		





		
	}
?>	

 