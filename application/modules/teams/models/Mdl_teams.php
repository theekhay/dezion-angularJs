<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_teams extends CI_Model {

		protected $table = "teams";

	
		/**
		* Creates a new team
		* @param id  {DataType: array, required: true, representation : an associative array of the team's information}
		*
		*/
		public function create($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}



		/**
		* Returns the lis of active teams as an object.
		*
		*/

		public function all()
		{
			$this->db->where('active', TRUE ) ;
			$this->db->where('deleted', FALSE ) ; 
			$query = $this->db->get($this->table);
			return $query;
		}


			
		/**
		* Returns the active status of a team
		* @param id  {DataType: int, required: true, representation : team id}
		*/

		public function active($id)
		{
			$data = array('id' => $id);
			$query = $this->db->get_where($this->table, $data);
			$row = $query->row();
			return $row->active  ;
		}


		/**
		* Sets a team active status to true
		* @param id  {DataType: int, required: true, representation : team id}
		*/

		public function activate($id) 
		{
			$data = array('active' => TRUE);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;	
		}



		/**
		* Sets a team active status to false
		* @param id  {DataType: int, required: true, representation : team id}
		*/

		public function deactivate($id)
		{
			$data = array('active' => FALSE);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}




	}

	?>

 