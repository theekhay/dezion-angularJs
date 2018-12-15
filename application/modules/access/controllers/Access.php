<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Access extends MX_Controller {


		public function __construct()
		{
			parent::__construct() ;
			//parent::loggedIn() ;
 			$this->load->model('access/mdl_access') ; 
		}

		
		/**
		* Logs user access 
		* function called if no method of this class is called in the URL parameter
		*/
		public function log()
		{
			$this->load->library('user_agent');

			$user = new stdClass() ; //declare an empty object

			$user->ip 		= $this->input->ip_address() ;
			$user->admin_id = $this->session->admin_id ;
			$user->time = $this->date_time->now('Y-m-d H:i:s');
			$user->browser	= $this->agent->browser() ;

			$this->mdl_access->log_access($user) ;
		}


		public function user_access($admin_id){

		//	$this->Mdl_access->user_accees_log($admin_id) ;
		}




	


		
	}
?>