<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Service_records extends MX_Controller {


		
		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('service_records/mdl_service_records') ;
		}




		public function index()
		{
			$this->recordView() ;
		}





		public function recordView()
		{
			$this->load->view("newServiceRecord");
		}


		public function record(){

			if(null !== $this->input->get('record') ){

				$record = json_decode( $this->input->get('record') ) ;

				try{

					if( $this->date_time->is_future($record->service_date) ){
						throw new Exception("Warning: Service date cannot be in the future", 1);
						
					}

					if(! $this->date_time->is_valid($record->service_date) ){
						throw new Exception("Error: Invalid Service Date", 1);
						
					}


					$record->service_ref = now() ;
					$record->created_by  = $this->session->admin_id ;
					$record->date_created = $this->date_time->now('Y-m-d') ;



					if(! $this->mdl_service_records->newServiceRecord($record) ){

						throw new Exception("Error processing this request", 1);
					}


					$data['status']  = "success" ;
				}
				catch(Exception $e)
				{
					$data['message'] = $e->getMessage() ;
					$data['status']  = "error" ;
				}


				echo json_encode($data) ;
				
			}
		}


		public function fetch($duraion){

			if(! empty($duraion) ){

				$start = $duration.start ;
				$end = $durtion.end ;

				try{
					if(! $date_time->id_valid($start) || ! $date_time->id_valid($start ))
					{
						throw new exception("invlid date");
					}
				}
				catch(Exception $e){

					$data['error'] = $e.getMessage();
				}
				
			}

		}


		public function report($query){

			if(! empty($query)){

				$report = json_decode($query);

				try{

					$type  = isset($report->type) ? $query->type : null ;
					$start = isset($report->duration->start) ? $query->duration->start : null ;
					$end   = isset($report->duration->end) ? $query->duration->end : null ;	
					
					
				}
				catch(Excetion $e){

					$data['message'] = $e->getMessage() ;
					$data['status']  = "error" ;
				}
			}
		}





		


		


		

		
	}
?>

 