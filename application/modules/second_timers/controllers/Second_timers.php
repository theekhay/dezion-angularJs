<?php
	defined('BASEPATH') OR exit('No direct script access allowed');


	class Second_timers extends MX_Controller {

		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('second_timers/mdl_second_timers');
			$this->load->module('uid');
			$this->load->module('first_timers');
		}



		/**
		* @param prefix string
		* represents the prefix in the UID for this module. 
		*/
		public $prefix = "ST";



		public function index()
		{
			$this->viewAll();
		}



		public function weekSecondTimers(){

			$start = $this->date_time->format(unix_to_human(strtotime( "last sunday" ) ) , 'Y-m-d' );
			$end   = $this->date_time->format(unix_to_human(strtotime( "this saturday" ) ) , 'Y-m-d' );

			$secondtimers = $this->mdl_second_timers->all($start, $end)->result() ;
			echo json_encode($secondtimers);
		}



		public function register()
		{
			$this->load->view('addSecondTimer');
		}




		/**
		* Loads the Second timer management page for first timers.
		*
		*/
		public function rhema(){

			$months = json_decode( $this->date_time->month_array() ) ;
			$years  = json_decode( $this->date_time->year_list() ) ;
			$data['months'] = $months ;
			$data['years'] = $years ;
			$this->load->view('rhema', $data) ;
		}



		//returns info about a second timer 
		public function secondtimerInfo(){

			$secondtimer_id = $this->input->get('secondtimer_id') ;
			$info =  $this->mdl_second_timers->get_info($secondtimer_id) ;
			echo json_encode($info) ;
		}










	

		public function add(){

			$secondtimer = $this->input->get('secondtimer') ;
			$secondtimer = json_decode($secondtimer) ;

			//NB: The object returned contain details from this first time, this second timer came
			try{

				if(empty($secondtimer) ){
					throw new Exception("Warning: NO data");
					
				}


				$data['uid'] 		= $this->uid->switch_prefix( $secondtimer->uid, $this->prefix ) ;
				$data['firstname'] 	= trim($secondtimer->firstname) ;
				$data['surname'] 	= trim($secondtimer->surname) ;
				$data['middlename'] = trim($secondtimer->middlename) ;
				$data['dob'] 		= $secondtimer->dob ;
				$data['email'] 		= $secondtimer->email ;
				$data['telephone1'] = $secondtimer->telephone1 ;
				$data['telephone2'] = $secondtimer->telephone2 ;
				$data['address'] 	= $secondtimer->address ;
				$data['gender'] 	= $secondtimer->gender ;
				//$data['marital_status'] = $secondtimer->marital_status ;
				$data['age_bracket'] = $secondtimer->age_bracket ;
				$data['next_step'] 	 = $secondtimer->next_step ;
				$data['discovery'] 	= $secondtimer->discovery ;
				$data['service_date'] = $secondtimer->service_date ;
				$data['occupation'] = $secondtimer->occupation ;
				$data['firsttimer_id'] = $secondtimer->id ;



				$check = array('uid' => $data['uid'], 'email' => $secondtimer->email, 'telephone1' => $secondtimer->telephone1 ) ;

				if( isset($telephone2) ){
					$check['telephone2'] = $secondtimer->telephone2 ;
				}


				$feedback = $this->mdl_second_timers->exists($check) ;

				if($feedback['status'] ){
					throw new Exception("Warning: Duplicate record for " .$feedback['field']. " field.");
				}


				if( empty($secondtimer->service_date) ){
					throw new Exception("Error: Inavld Service date");
					
				}

				if(! $this->date_time->is_valid( $secondtimer->service_date) ){
					throw new Exception("Warning: Invalid Service date") ;
				}


				if ($this->date_time->is_future($secondtimer->service_date)  ){
					throw new Exception('Warning: Service date cannot be in the future');
				}


				if(! $this->date_time->is_valid($secondtimer->dob) ){
					throw new Exception("Warning: Invalid dob") ;
				}


				if( ! $this->mdl_second_timers->addSecondTimer($data) ){
					throw new Exception("Problem registering this second timer");
					
				}

				$response['status']  = 'success' ;

			}
			catch(Exception $e){

				$response['message'] = $e->getMessage() ;
				$response['status']  = 'error' ;
			}	


			echo json_encode($response) ;

		}



		public function get_secondtimers(){
		

		 	$get_month = $this->input->get('month') ;
		 	$get_year  = $this->input->get('year') ;

			$this_month = $this->date_time->month();
			$this_year  = $this->date_time->year_full() ;

			$month = (! empty($get_month) ) ? $get_month : $this_month ;
			$year  = (! empty($get_year)  ) ? $get_year  : $this_year ;

			
			$last_day   = $this->date_time->last_day($month, $year);

			$start_date =  nice_date("$year-$month-01", "Y-m-d") ;  
			
			$last_date  = nice_date("$year-$month-$last_day", "Y-m-d") ; 

			$second_timers = $this->mdl_second_timers->all($start_date, $last_date)->result() ;

			echo json_encode($second_timers) ;
		}






		public function drop(){

			$secondtimer_id = $this->input->get('secondtimer_id') ;
			$data['status'] = (! $this->mdl_second_timers->drop($secondtimer_id) ) ? 'error' : 'success' ;
			echo json_encode($data) ; 
		}




		public function get_first_time($st_id)
		{
			$this->load->module('uid');
			$this->load->module('first_timers');

			$st_id =  $this->uid->stripPrefix($st_id) ;
			$ft_id = $this->first_timers->prefix.'/'.$st_id ;

			return  $this->mdl_first_timers->get_data_by_id($ft_id, 'service_date' );
		}


	
		
	}
?>

 