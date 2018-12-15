<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Members extends MX_Controller {


		public $module ;


		/**
		* @param prefix string
		* represents the prefix in the UID for this module. 
		* members are recognized with the MB in their UID.
		*/
		private $prefix = "MB";


		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('members/mdl_members');
			$this->module = strtolower(__CLASS__) ;
		}


		
		public function index()
		{
			$this->main();
		}



		public function main(){

			$this->load->view('all_members') ;
		}



		/**
		* Returns information about a member
		* @param member_id {DataType: int, required: true, representation : member id } 
		* return type - json object
		*/
		public function memberInfo($member_id){

			$info = $this->mdl_members->get_info($member_id) ;
			echo json_encode($info) ;

		}




		public function all_members_data()
		{
			echo json_encode( $this->mdl_members->getMembers()->result() ) ;
		}


		// public function update(){

		// 	if(null !== $this->input->get('member')){

		// 		$member = json_decode($members) ;
		// 		try{

		// 		}
		// 	}
		// }


		/**
		* create a new user and adds user to the database.
		* A unique UID is auto generated and assigned to the user
		*/
		public function register(){

			if(null !== $this->input->get('member') ){

				$member = json_decode( $this->input->get('member') ) ;

				//echo $member ; return ;

				try{

					if( empty($member->firstname) || empty($member->surname) || empty($member->address) || empty($member->telephone1) || empty($member->dob) || empty($member->age_bracket) || empty($member->marital_status) || empty($member->gender) || empty($member->member_status)  ){

						throw new Exception('Important Fields missing');
					}


					if( strtolower( $member->action ) == 'register'){

						$set = (! empty($member->telephone2) ) ? ['telephone1'=> $member->telephone1, 'email' => $member->email, 'telephone2'=> $member->telephone2 ] : ['telephone1'=> $member->telephone1, 'email' => $member->email ] ;	
						
						$feedback = $this->mdl_members->exists($set);

						if( $feedback['status'] ){
							throw new Exception("Member with this ". $feedback['field']. " already exists");
						}

						//Load user identifier module to generate user's UID.
						$this->load->module('uid');
						$member->uid  = $this->uid->generate_id($this->prefix);

						if(empty($member->uid)){

							log_message('ERROR', 'UID NOT RETREIVED.') ; 
							throw new Exception("SYSTEM ERROR! Couldn't generate resource needed to complete this operation." );
						}

						//check if generated uid exists.
						if( $this->mdl_members->id_exists($member->uid) ){
							//log this error (this shows a system failure somewhere)
							//send a message, notifying the admin about this
							log_message('ERROR', 'DUPLICATE SYSTEM UID') ;
							throw new Exception("Error! UID generate error ", 0);
						}

						unset($member->action) ;

						if(! $this->mdl_members->addMember($member) ){
							
							throw new Exception("ERROR: Problem saving member's data. Try again soon." );
						}

					}
					elseif( strtolower( $member->action ) == 'update'){

						$member_id = $member->id ;
						unset($member->id, $member->action) ;

						if(! $this->mdl_members->update($member_id, $member) ){

							throw new Exception("ERROR: Problem saving member's data. Try again soon." );
						}
					}

					$data['status']  = "success" ;
					$data['message'] = "Member registered successful" ;

				}
				catch(Exception $e){

					$data['status']  = 'error' ;
					$data['message'] = $e->getMessage() ;
				}

				echo json_encode($data) ;
			}	
		}



		/**
		* Loads the members registeraton view
		*/
		public function add()
		{
			$data['module'] 		= $this->module ;
			$data['title'] 			= 'add Members' ;
		
			$this->load->view('addMember', $data) ;
		}




		public function this_week_bday()
		{
			$count = array();
			
			$members = $this->mdl_members->getMembers();


			foreach ($members->result() as $member) {

				$bday = $member->dob ;

				if(! empty($bday) && $this->date_time->is_valid($bday) ){

					$day   =  $this->date_time->day($bday) ;
			        $month = $this->date_time->month($bday) ;

			        $this_year   = $this->date_time->year_full();
			        $this_day    = $this->date_time->day() ;
			        $this_month  = $this->date_time->month() ;

			        $full = $this_year ."-". $month. "-". $day;
			        
			        if( $this->date_time->day($full) == $this_day &&  $this->date_time->month($full) == $this_month ){

	                  	$count[] = $this->mdl_members->get_info( $member->id );
	                }
				}
			}

			echo json_encode( $count ); 
		}


		public function test(){

			//var_dump( $this->date_time->dateTest('23-11-16') );
			echo $this->date_time->is_valid('2016-11-20') ;
			//echo $this->date_time->year_full() ;
		}


		public function activate()
		{
			$id = $this->input->get('member_id');

			try{

				if(empty($id)){

					$data['message'] = "Member id not found" ;
					throw new Exception(false) ;
				}


				//check if member id really exists
				if(! $this->mdl_members->id_exists($id) ){

					$data['message'] = "Member id does not exist" ;
					throw new Exception(false) ; 
				}


				if( $this->mdl_members->get_info($id, 'flag') != 'active' ){

					if(! $this->mdl_members->set_active($id) ){
						throw new Exception(false);
						
					} 
				}

			}catch(Exception $e){

				$data['status'] = $e->getMessage() ;
			}			
		}



		public function drop(){

			$member_id = $this->input->get('member_id') ;
			$data['status'] = (! $this->mdl_members->drop($member_id) ) ? 'error' : 'success' ;
			echo json_encode($data) ; 
		}

	}
?>

 