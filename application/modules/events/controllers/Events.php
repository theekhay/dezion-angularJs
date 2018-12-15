<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Events extends MX_Controller {


		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('events/mdl_events');
		}



		public function index()
		{
			$this->event();
		}



		public function event($message = null)
		{
			$data['module'] = 'events';
			$data['title'] = 'Events';
			$data['demo_path'] = base_url().'library/demo/admin/';
			$this->load->view('events', $data) ;
		}



		/**
		* Returns a list of events 
		* For use in the view
		* @return object
		*/
		public function getEvents(){

			echo json_encode($this->mdl_events->all()->result() ) ;
		}




		public function allEvents()
		{
			$meta_data = array();
			$data = array();
			$events = $this->mdl_events->all();

			foreach ($events->result() as $event) {
				 $event_array[] = array( 
				'id' => $event->id,
				'title' => $event->title,
				'start' => $event->start,
				'end' => $event->end,
				'all_day' => $event->all_day
				);

			}

			echo json_encode($event_array);
		}




		public function newEvent()
		{
			$title 	= $this->input->post('title') ;
			$start 	= $this->input->post('start') 		;
			$end 	=  $this->input->post('end') 			;
			$all_day =  $this->input->post('all_day') ;


			// if($title == false || $start == false)
			// 	echo false; //load a view with an error message.
			// 	return ;
		
			echo (! $this->mdl_events->createEvent($title, $start, $end) ) ? false : true ;

			exit ;
		}




		public function week_events()
		{
			$data = array();		
			$events = $this->mdl_events->all();
			
			$this_week = $this->date_time->week();
			foreach ($events->result() as $event) {
				if( $this->date_time->this_week($event->start) == $this_week){
					$data['title'] = $event->title;
					$data['time'] 	= $event->start;
				} 
				var_dump($data) ;//$data;
			}


		}




		public function updateEvent()
		{
			
			$start 	=  $this->input->post('start') ;
			$end 	= $this->input->post('end') ;
			$eid 	=  $this->input->post('id') ;
				
			if($this->mdl_events->updateEvent($eid, $start, $end) == true)
			{
				$data['message'] = "Event updated successfully. Event has been moved to ". $this->date_time->format($start, 'Y-m-d') ;
			}
			else
			{
				$data['message'] = "coudn't update event at the moment";
			}

			echo json_encode($data);

		}



		public function test()
		{
			echo uniqid('hicc/gbd/1016/0902');
		}
					

	}
?>

 