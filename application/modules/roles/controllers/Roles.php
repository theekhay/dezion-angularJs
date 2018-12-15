<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Roles extends MX_Controller {

		


		public function __construct()
		{	
			parent::__construct();	
			parent::loggedIn();
			$this->load->model('roles/mdl_roles');
		}


		public function index()
		{
			$this->allRolesView();
		}



		public function createRoleView()
		{		
			$this->load->view('createRole' ) ;
		}



		public function allRolesView()
		{
			 $this->load->view('allRoles' ) ;
		}



		/**
		* Gets information about a role given the role id
		*/

		public function roleInfo(){

			$role_id = $this->input->get('role_id') ;
			$info = $this->mdl_roles->get_info($role_id) ;
			echo json_encode($info) ;
		}


	

		//returns all roles as a json object
		public function getRoles(){

			echo json_encode( $this->mdl_roles->all()->result_array() ) ;		
		}



		public function drop()
		{
			$role_id = $this->input->get('role_id')  ;

			try{

				if( empty($role_id) ){
					throw new Exception("Error: Invalid Role ");
				}


				if(! $this->mdl_roles->drop($role_id) ){
					throw new Exception("Error processing request");
				}

				$data['status'] = 'success' ;
					
			}catch(Exception $e){

				$data['status']  = 'error' ;
				$data['message'] = $e->getMessage() ;
			}	

			echo json_encode($data) ;	
		}


		

		public function newRole()
		{
			$role = $this->input->get('role') ;

			$role = json_decode($role) ;
			
			try{

				if( empty($role->name) || empty($role->abbrevation) ){
					throw new Exception("Important fields missing") ;
				}

				$feedback = $this->mdl_roles->exists( ['name' => $role->name, 'abbrevation' => $role->abbrevation] );

				if( $feedback['status']  ){

					throw new Exception("Role with this ". $feedback['field']. " already exists. Duplicates not allowed");
				}

				$role->date_created = $this->date_time->format(unix_to_human(now() ), 'Y-m-d' ) ;
				$role->created_by   = $this->session->admin_id ;
				$role->abbrevation = strtoupper( $role->abbrevation ) ;


				if(! $this->mdl_roles->new_role($role) ){
					throw new Exception("Error creating role", 1);	
				}

				$data['status'] = 'success' ;
			}
			catch(Exception $e){

				$data['message'] = $e->getMessage() ;
				$data['status'] = 'error' ;

			}

			echo json_encode($data) ;	
		}

	}



	
?>

 