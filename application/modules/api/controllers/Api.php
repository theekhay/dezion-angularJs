<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Api extends MX_Controller {

	

		public function __construct()
		{
			parent::__construct() ;
			$this->load->model('api/mdl_api') ; 
			$this->load->library('bcrypt') ;
		}


		
		/**
		* Index function 
		* function called if no method of this class is called in the URL parameter
		*/
		public function index()
		{
			$this->login() ;
		}




		/**
		* Logout function.	 
		* Redirects users to the login page.
		*/
		public function logout()
		{
			$this->session->sess_destroy(); //destroy all current sessions.
			redirect("api/");
		}



		public function login(){

			$data['demo_path'] 	= base_url().'library/demo/admin/' ;
			$data['lib_path']   = base_url().'library/' ;
			$this->load->view('signIn', $data);
		}



		/**
		* function that validates user login
		* input validation should be done on user inputs.
		*/
		public function authenticate()
		{

			$username =  $this->input->get('username');
			$password =  $this->input->get('password');


			try
			{
				//verify if username and password are both filled.
				if( empty($username) OR empty($password) ){
					throw new Exception("Email or Password field empty", 1);
				}

				
				//validate that user exists.
				if(! $this->mdl_api->admin_exists($username) ){
					throw new Exception("ERROR! username not found", 0);
				}
				


				/*
				if(! $this->form_validation->run() ){
					$errors = $this->form_validation->error_array();
					throw new Exception(reset($errors), 0 );										
				}
				*/
				
				

				//get the user id and throw an exception if not found.
				$admin_id = $this->mdl_api->get_id($username) ;

				$admin_details = $this->mdl_api->get_info($admin_id) ;


				//throw an exception if user id is not found or the system couldn't retreive the user id.
				if( empty($admin_id) ){
					throw new Exception("ERROR: Invalid username");
				}


				//verify password match.
				if (! $this->bcrypt->check_password($password, $this->mdl_api->get_password($admin_id) ) ) {
					throw new Exception("Error: Invalid username/password combination" );
				}


				//check if admin status to ensure he's still active
				// if(! $this->mdl_api->active($username) ){");
				// }

				$this->session->set_userdata('logged_in', true) ;

				$this->load->model('roles/mdl_roles') ;

				$role = $this->mdl_roles->get_info( $admin_details->role_id ) ;

				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('admin_id', $admin_id);
				$this->session->set_userdata('member_id', $admin_details->member_id) ;
				$this->session->set_userdata('role_id', $admin_details->role_id) ;

				(! empty($role) ) ? $this->session->set_userdata('role', strtolower( $role->name ) ) : $this->session->set_userdata('role', null ) ;

				$this->load->module('access') ;
				$this->access->log();

				//login session must be active for the modules & models below to work


				//$this->load->model('members/mdl_members') ;

				//get the administrator's membership information using his/her member id retreived from the admin table.
				//the member_id is a secondary key on the admin table linking to the id on the member table  
				//$admin = $this->mdl_members->get_info($this->mdl_api->get_info($username, 'member_id') );

				//$this->session->set_userdata('email', $admin->email);
				//$this->session->set_userdata('email', $admin->email);

				//redirect("dashboard/");	
				$data['status'] = 'success' ;	  
			}
			catch(Exception $e){

				$data['message'] = $e->getMessage();
				$data['status']  = 'error';
			}
			
			echo json_encode($data) ;
		}



		public function user_sessions(){
			var_dump($this->session) ;
		}



		public function test(){

			//$this->config->load('permissions');
			//$x = $this->config->item('user_role_permissions');

			//$perms = var_dump($x['manager']) ;

			//var_dump( $perms['api'] ) ;

			//var_dump($x);
			//var_dump(in_array(3, [1, 3, 5, 9])) ;

			//var_dump (config_item('auth_role') );

			//echo $this->router->fetch_class();
			//echo $this->router->fetch_method();

			//echo $this->router->method();

			//$this->config->set_item('auth_role', '');

			//var_dump( $this->is_controller_allowed() );
			//echo date( 'Y-m-d', strtotime( 'sunday last week' ) );
			//$this->load->model('second_timers/mdl_second_timers') ;
			//var_dump($this->mdl_second_timers->assimilated('2016-12-01', '2017-02-28')->result() ) ;

			//$quarterMonths = json_decode( $this->date_time->getQuarterMonths(1) );
			//var_dump($quarterMonths) ;

			//echo now() ;

			//echo $this->date_time->format('2017.09.09', "Y-m-d") ;

			// $name ="Testimony" ;
			// $name_array = str_split($name);
			// //echo $name_array[-1] ;
			// echo substr($name, -1);
			
			echo $this->date_time->now() ;

		}				    
								




		
	}
?>