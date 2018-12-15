<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_messages extends CI_Model {

		protected $table = "internal_messages";


		public function __construct(){

			parent::__construct() ;
		}



		public function userMessages($user_id){

			$query = $this->db->get_where($this->table, ['recepient' => $user_id] ) ;
			return $query ; 
		}



		public function save($data)
		{
			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;

		}



		public function message_with_id($admin_id, $message_id)
		{
			$this->db->where('recepient', $admin_id);
			$this->db->where('id', $message_id);
			$query = $this->db->get($this->table);
			return $query;
		}	



		







		public function recent_msgs($recepient, $limit = null) //$recepient
		{
			$this->db->from($this->table);
			$this->db->where('recepient', $recepient);
			$this->db->where('view_status', 'unread');
			$this->db->order_by('id', 'DESC');	

			if(isset($limit)){
				$this->db->limit($limit);
			}
			

			$query = $this->db->get();
			return $query;
		}




		public function recent($recepient) //$recepient
		{
						
			$query = $this->recent_msgs($recepient);
			return $query->num_rows();
		}






		/*
		| Flag functions start here.
		*/

		public function is_read($id) //returns true if flag is  inactive
		{
			$data = array('id' => $id);
			$this->db->select('view_status');
			$this->db->from($this->table);
			$this->db->where($data);
			$query =  $this->db->get();
			$row = $query->row_array();
			return ($row['view_status'] == 'read') ? true : false ;
		}



		public function flag_as_unread($id) //sets a service status(flag) to inactive. as good as deleted.
		{
			$data = array('view_status' => 'unread');
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;	
		}





		public function flag_as_read($id) //this function should be performed by only top admin.
		{
			$data = array('view_status' => 'read');
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}


		/*
		| Flag functions end here!
		*/




		public function drop_by_id($id)
		{
			$data = array('id' => $id);
			$this->db->delete($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}





		public function get_data_by_id($id, $field)
		{	
			$this->db->from($this->table);
			$this->db->where(array('id'=> $id));
			$query = $this->db->get();
			$row =  $query->row_array();
			return $row[$field];
		}


	}

?>
 