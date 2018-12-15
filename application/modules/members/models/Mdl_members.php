<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_members extends CI_Model {

		protected $table = 'members';




		public function __construct(){
			parent::__construct() ;
		}



		/**
		* Adds a new member to $this->table.
		* @param $set {DataType: array, required: true, representation : an array of member details to be registered. }
		* return type - bool.
		*/
		public function addMember($data) 
		{
			$this->db->insert($this->table, $data);
			return ( $this->db->affected_rows() <= 0) ? false : true ;
		}



		/**
		* Retreives members list from $this->table ;
		* return type - array/object .
		*/
		public function getMembers(){

			$this->db->where('active', TRUE) ;
			$this->db->where('deleted', FALSE) ;
			$query = $this->db->get($this->table) ;
			return $query ;
		}




		public function get_birthdays($start, $end){

			$this->db->where("dob between '$start' and  '$end' ") ;
			$query = $this->db->get($this->table) ;
			return $query ;

		}



		



	}

 