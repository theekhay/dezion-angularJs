<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends MX_Controller {


		private $user ;


		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn() ;

		}



		/**
		* Index function 
		* function called if no method of this class is called in the URL parameter
		*/
		public function index()
		{
			$this->load_dashoard();
		}




		/**
		* This loads the user dashboard based on the curent admin_id session variable
		* The dashboard has features including;
		* messages, user preferences, notifications, resource access etc
		* if permission is enabled, the dashboard is restricted to only the resources the user is allowed to access.  
		* This 
		*/
		public function load_dashoard()
		{
			$data['demo_path'] 			= base_url().'library/demo/admin/' ;
			$data['fontawesome_path'] 	= base_url().'library/font-awesome/css/font-awesome.min.css' ;
			$data['lib_path'] 			= base_url().'library/' ;
			$this->load->view('dashboard', $data) ;
		}



		public function main(){

			$data['demo_path'] 	= base_url().'library/demo/admin/' ;
			$this->load->view('main', $data) ;
		}


	}
?>

 