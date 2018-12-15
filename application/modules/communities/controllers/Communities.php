<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Communities extends MX_Controller {



		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('communities/mdl_communities');
			$this->load->model('members/mdl_members');
		}



		public function index()
		{
			$this->view();
		}



		/**
		* Loads the create commuity view.
		* 
		*/
		public function createCommunity()
		{
			$data['title'] = "Create Community";
			$this->load->view('createCommunity', $data);	
		}



		/**
		* API for the creation of a new community
		* 
		*/
		public function newCommunity()
		{
			$name 		= $this->input->get('name') ;
			$abbr 		= $this->input->get('abbrevation') ;
			$leader 	= $this->input->get('leader') ;
			$district 	= $this->input->get('district') ;


			try{
				
				if(empty($name) || empty($abbr) ){

					throw new Exception("Warning: Important fields missing");
				}


				if( empty($district) ){
					
					throw new Exception("Error: Invalid district");
				}

				//data to check for uniqueness
				$cdata  = ! empty($leader) ? ['name' => $name, 'abbrevation'=> $abbr, 'leader' => $leader] : ['name' => $name, 'abbrevation'=> $abbr] ;

				$feedback = $this->mdl_communities->exists($cdata) ;

				if($feedback['status'] ){
					throw new Exception("Community with this ". $feedback['field']. " already exists. Duplicates not allowed" );
					
				}	

				$cdata['date_created'] 	= $this->date_time->now('Y-m-d') ; 
				$cdata['created_by'] 	= $this->session->admin_id ;
				$cdata['district_id'] 	= $district ;


				if(! $this->mdl_communities->create($cdata) ){
					throw new Exception("Error: couldn't create Community at the moment");
				}
				
				$data['status'] = 'success' ; 
			}
			catch(Exception $e){

				$data['status'] = 'error' ;
				$data['message'] = $e->getMessage() ;
			}		
			
			echo json_encode($data) ;

		}
		

		/**
		* Loads the community view
		* This would usually be a list of community in a particular distrcit. 
		*/
		public function communityPage()
		{
			$this->load->view('communityPage') ;
		}

		


		/**
		* API for getting active communities.
		* Gets a list of active communities
		* if the distrcit id is specified, it gets the list of commuities in that district 
		*/
		public function getCOmmunities(){

			$district_id = $this->input->get('district_id') ;
			$communities = $this->mdl_communities->all($district_id) ;
			echo json_encode($communities->result() ) ;

		}


		/**
		* API for getting information about a community.
		* returns info about the specified community id
		*/
		public function communityInfo(){

			$community_id = $this->input->get('community_id') ;
			$communities = $this->mdl_communities->get_info($community_id) ;
			echo json_encode($communities) ;

		}	



		public function drop()
		{
			$community_id = $this->input->get('community_id')  ;

			try{

				if( empty($community_id) ){
					throw new Exception("Error: Invalid community");
				}


				if(! $this->mdl_communities->drop($community_id) ){
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

 