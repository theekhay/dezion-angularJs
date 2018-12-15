<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_settings extends CI_Model {

		protected $table = 'settings' ;




		/**
		* Retreives a particular configuration setting.
		* @param  config {DataType: varchar, required: true, representation : valid config field in $this->table }
		* return type : string or null if not found.
		*/
		public function get_config($config)
		{
			$this->db->select($config);
			$query = $this->db->get($this->table);
			return (null != $query->row()->$config ) ? $query->row()->$config : NULL ;
		}



		/**
		* Updates the value of a particular configuration setting.
		* @param  config_data {DataType: varchar, required: true, representation : array of field => value pair to update }
		* return type : bool
		*/
		public function update_config($config_data)
		{
			if(! is_array($config_data))
				return false ;

			$query = $this->db->update($this->table, $config_data);
			return ( $this->db->affected_rows() <= 0 ) ? false : true ;
		}


	}

 