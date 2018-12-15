<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_districts extends CI_Model {


		protected $table = "districts";


		public function __construct(){
			parent::__construct() ;
		}


		public function checks(){
			return $this->test() ;
		}



		/**
		* checks to see if a value exists in this->table for a particular field
		* @param $set {DataType: array, required: true, representation : an array of field-value pair to check }
		* return type - array
		*/
		public function exists($data){

			if(is_array($data) ){

				foreach ($data as $field => $value) {

					$this->db->where($field, $value);
					$query = $this->db->get($this->table);

					if( $query->num_rows() >= 1){

						$data['status'] = TRUE ;
						$data['field']  = $field ;
						
						return $data ;
					} 
				}	

				return $data['status'] = FALSE ;
			}
		}



		/**
		* Adds a new district to this->table ;
		* @param $data {DataType: array, required: true, representation : information about the district }
		* return type - bool
		*/

		public function create($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}




		/**
		* Retreives all active distrcits. ;
		* return type - object
		*/
		public function all()
		{
			$this->db->where('active', TRUE);
			$this->db->where('deleted', FALSE);
			$query = $this->db->get($this->table);
			return $query;
		}




		/**
		* Deletes a district 
		* @param $id {DataType: int, required: true, representation :  district id }
		* return type - object
		*/
		// public function drop($id)
		// {
		// 	$data = array('id' => $id);
		// 	$this->db->delete($this->table, $data);
		// 	return ($this->db->affected_rows() <= 0) ? false : true ;
		// }


	
		



		/**
		* Retreives any information about a district from $this->table   
		* @param  id {DataType: int, required: true, representation : district id  }
		* @param  field {DataType: varchar, required: false, representation : valid column in $this->table } 
		* Return_type: string OR array.
		*/
		public function get_info($id, $field = null)
		{
			$this->db->where('id', $id);
			$query = $this->db->get($this->table);
			return (! empty($field) ) ? $query->row()->$field : $query->row() ;
		}




		public function status($id)
		{
			$data = array('id' => $id);
			$query = $this->db->get_where($this->table, $data);
			return $query->row()->active ;
		}



		public function activate($id) 
		{
			$data = array('active' => TRUE);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;	
		}





		public function deactivate($id)
		{
			$data = array('active' => FALSE);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}

	
	}

	?>

 