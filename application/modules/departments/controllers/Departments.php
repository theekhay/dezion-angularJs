<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Departments extends MX_Controller {

		
		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn() ;
			$this->load->model('departments/mdl_departments') ;
		}



		public function index()
		{
			//$this->view();
		}


		/**
		* Loads the create Department view.
		* 
		*/
		public function create()
		{
			$this->load->view('createDepartment');
		}




		/**
		* API for getting Departments 
		* Returns a list of active departments as a json object 
		*
		*/
		public function getDepartments(){

			$team_id = $this->input->get('team_id') ;
			echo json_encode($this->mdl_departments->all($team_id)->result() ) ;
		}




		public function departmentPage()
		{		
			$this->load->view('departmentPage');
		}	



		/**
		* API for getting information about a department.
		* returns info about the specified department id
		*/

		public function departmentInfo(){

			$department_id = $this->input->get('department_id') ;
			$info = $this->mdl_departments->get_info($department_id) ;
			echo json_encode($info) ;
		}
		



		/**
		* API for the creation of a new department
		* 
		*/
		public function newDepartment()
		{

			$name = $this->input->get('name') ;
			$abbr = $this->input->get('abbrevation') ;
			$team = $this->input->get('team') ;
			$head = $this->input->get('head') ;


			try{

				if( empty($name) || empty($abbr) ){
					throw new Exception('Warning: Important fields missing') ; 
				}


				if( empty($team) ){
					throw new Exception('Error: Invalid team') ; 
				}


				$dpt_data = (! empty($head) ) ? ['name' => $name, 'abbrevation' => $abbr, 'head' => $head] : ['name' => $name, 'abbrevation' => $abbr] ;

				$feedback = $this->mdl_departments->exists($dpt_data) ;

				if($feedback['status'] == true ){
					throw new Exception('Error: Department with this '. $feedback['field'].' already exits. Duplicates not allowed') ;
				}


				$dpt_data['date_created'] = $this->date_time->now('Y-m-d') ;
				$dpt_data['created_by']   = $this->session->admin_id ;
				$dpt_data['team_id'] 	  = $team ;


				if(! $this->mdl_departments->createDepartment($dpt_data) ){
					throw new Exception("Error: couldn't create department ") ;
				}

				$data['status']  = "success" ;

			}
			catch(Exception $e){

				$data['status']  = "error" ;
				$data['message'] = $e->getMessage() ;
			}	

			echo json_encode($data) ; 
		}



		public function departmentsInTeam(){

			$team_id = $this->input->get('team_id') ;
			$count = $this->mdl_departments->all($team_id)->num_rows() ;
			echo json_encode(['department_count' => $count ]) ;
		}



		

		/**
		* API for deleting a Department.
		* 
		*/
		public function drop()
		{
			$department_id = $this->input->get('department_id')  ;

			try{

				if( empty($department_id) ){
					throw new Exception("Error: No department selected");
				}


				if(! $this->mdl_departments->drop($department_id) ){
					throw new Exception("Error processing request");
				}

				$data['status'] = 'success' ;
					
			}catch(Exception $e){

				$data['status']  = 'error' ;
				$data['message'] = $e->getMessage() ;
			}	


			echo json_encode($data) ;	
		}


		
	}
?>

 