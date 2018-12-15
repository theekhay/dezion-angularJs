<?php
	defined('BASEPATH') OR exit('No direct script access allowed');


	class Messages extends MX_Controller {


		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('messages/mdl_messages') ;	
		}


		/**
		* Load the inbox as the default page
		*/
		public function index()
		{
			$this->inboxView();
		}



		public function inboxView()
		{
			$data['title'] = 'Messages';
			$this->load->view('inbox', $data);
		}



		/**
		* This gets the messges of the current logged in user
		*/
		public function getUserMessages(){

			$messages = $this->mdl_messages->userMessages( $this->session->admin_id ) ;
			echo json_encode( $messages->result() ) ;
		}



		/**
		* Loads the compose message view page
		*/
		public function composeView(){

			$data['title'] = 'Compose';
			$this->load->view('compose', $data);
		}


		/**
		* returns information about a message given the message id
		* @param message_id int
		* @return object/string
		*/
		public function getInfo($message_id){

			$messageData = $this->mdl_messages->get_info($message_id);
			echo json_encode($messageData) ;

		}


		public function display(){

			//this method links to the defined route in test.js
			//function operaton is yet to be defined
		}

		


		/**
		* the recepient would always be the admin id, stored as the session variable admin_id
		*/
		public function send()
		{
			if(null !== $this->input->get('message') ){

				$message = json_decode( $this->input->get('message') ) ;

				try{

					if( empty($message->subject) || empty($message->body) || empty($message->recepient) ){

						throw new Exception("Important fields missing") ;
					}


					if($message->recepient == $this->session->admin_id){
						throw new Exception("Warning: You can't send a message to yourself") ;
					}

					$message->sender = $this->session->admin_id ;
					$message->date_time = $this->date_time->now('Y-d-m H:i:s') ;

					if(! $this->mdl_messages->save($message)){
						throw new Exception("Unable to process your request at this moment") ;
					}

					$data['status'] = "success" ;
				}
				catch(Exception $e){
					$data['message'] = $e->getMessage() ;
					$data['status'] = "error" ;
				}

				echo json_encode($data) ;
			}
		}



		public function recents()
		{
			$this->load->model('admin/mdl_admin');
			$admin_id = $this->mdl_admin->get_id_by_username($this->session->username) ;
			return $this->mdl_messages->recent($admin_id);
		}


		public function current_message()
		{
			$message_id = $this->input->get('message_id');
			$this->load->model('internal_messages/mdl_internal_messages');
              $this->load->model('admin/mdl_admin');
              $admin_id = $this->mdl_admin->get_id_by_username($this->session->username);

              $messages = $this->mdl_internal_messages->message_with_id($admin_id, $message_id);
              foreach ($messages->result() as $message) {
                 echo $this->templates->message_view($message->id, $message->title, $message->body, $message->sender, $message->date_sent, $message->time_sent);
              }

		}



		public function left_message_list()
		{
			$this->load->model('internal_messages/mdl_internal_messages');
			$out = "";

			$search = $this->input->get('search');


              $this->load->model('admin/mdl_admin');
              $admin_id = $this->mdl_admin->get_id_by_username($this->session->username);

              $messages =  $this->mdl_internal_messages->all($admin_id, $search) ;

              $message_count = $messages->num_rows();

              if($message_count >= 1){
                foreach ($messages->result() as $message) {
                  $out .=  $this->templates->mail_list($message->id, $message->sender, $message->time_sent, $message->body);
                }
              }else{
                $out .= "<p class= 'link'><span style='font-size:17px'>Your Notifications would appear here.</span></p>";
              }

              echo $out;
		}


		


		public function mark_as_read() //used in ajax function. shouldnt be used this way in a non-ajax function
		{
			$id = $this->input->get('message_id');

			if(empty($id)){
				//echo false;
				return;
			}

			//check if message id really exists
			if($this->mdl_messages->id_exists($id) == false){
				//echo false;
				return;
			}

			//is message active?
			if($this->mdl_messages->is_read($id) == false){

				 ($this->mdl_messages->flag_as_read($id) == false) ;				
			}					
		}



		public function mark_as_unread()
		{
			$id = $this->input->get('message_id');

			if(empty($id)){
				echo false; return;
			}

			//check if member id really exists
			if($this->mdl_messages->id_exists($id) == false){
				echo false; return; 
			}

			//check if member has already been flagged
			if($this->mdl_messages->is_read($id) == true){

				echo ($this->mdl_messages->flag_as_unread($id) == false) ? false : true ;
			}			
		}


		public function test()
		{
			echo now();			
		}


		


	}
?>

 