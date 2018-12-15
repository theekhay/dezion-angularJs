<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Services extends MX_Controller {



		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('services/mdl_services') ;
			
		}




		public function index()
		{
			$this->all();
		}



		public function create()
		{				
			$this->load->view('createService');
		}


		
		public function newService()
		{	
			$name = $this->input->get('name');
			$abbr = $this->input->get('abbrevation') ;

			try{

				if( empty($name) OR empty($abbr)){
					throw new Exception("Service name or abbrevation missing");
				}

				$service_data = ['name' => $name, 'abbrevation' => $abbr] ;

				$feedback = $this->mdl_services->exists($service_data) ;

				if($feedback['status'] == true ){
					throw new Exception('Warning: Service with this '. $feedback['field'].' already exits. Duplicates not allowed') ;
				}

				$service_data['date_created'] = $this->date_time->now('Y-m-d') ;
				$service_data['created_by']	  = $this->session->admin_id ;

				// if(! $this->form_validation->run() ){
				// 	$errors = $this->form_validation->error_array();
				// 	throw new Exception(reset($errors), 1);										
				// }


				if( ! $this->mdl_services->createService($service_data) ){
					throw new Exception("oops! Unable to create service component at the moment.", 1);
				}
			
				$data['status']  = "success" ;

			}
			catch(Exception $e)
			{
				$data['status'] = 'error' ;
				$data['message'] = $e->getMessage();
			}

			echo json_encode($data) ;

		}




		/**
		* API for getting Services 
		* Returns a list of active Services as a json object 
		*
		*/
		public function getServices()
		{

			$service_id = $this->input->get('service_id') ;
			echo json_encode($this->mdl_services->all()->result() ) ;
		}



		public function manage()
		{		
			$this->load->view('allServices');
		}





		/**
		* API for getting information about a service.
		* returns info about the specified service id
		*/

		public function serviceInfo(){

			$service_id = $this->input->get('service_id') ;
			$info = $this->mdl_services->get_info($service_id) ;
			echo json_encode($info) ;
		}



		/**
		* API for deleting a Service.
		* 
		*/
		public function drop()
		{
			$service_id = $this->input->get('service_id')  ;

			try{

				if( empty($service_id) ){
					throw new Exception("Error: Invalid Service");
				}


				if(! $this->mdl_services->drop($service_id) ){
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

 