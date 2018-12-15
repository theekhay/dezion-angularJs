<?php
	defined('BASEPATH') OR exit('No direct script access allowed') ;

	class Cell_members extends MX_Controller {

	

		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn() ;
			$this->load->model('cell_members/mdl_cell_members') ;
		}	



		public function index(){

			$this->getMembers();
		}



		public function add(){

			$this->load->view('addMember') ;
		}



		public function members(){
			$this->load->view("cell_members") ;
		}



		public function getMembers(){

			$cell_id = $this->input->get('cell_id') ;
			$data = $this->mdl_cell_members->all($cell_id)->result() ;
			echo  json_encode($data) ;
		}




		public function member_count($cell_id){

			$count = $this->mdl_cell_members->all($cell_id)->num_rows() ;
			echo  json_encode(['member_count' => $count]) ;
		}



		public function drop(){

			$cell_id = $this->input->get('cell_id')  ;
			$member_id = $this->input->get('member_id')  ;

			try{

				if( empty($cell_id) ){
					throw new Exception("Error: Invalid Cell");
				}

				if(empty($member_id) ){
					throw new Exception("Error: Invalid member");
				}


				if(! $this->mdl_cell_members->removeMember($cell_id, $member_id) ){
					throw new Exception("Error processing request");
				}

				$data['status'] = 'success' ;
					
			}catch(Exception $e){

				$data['status']  = 'error' ;
				$data['message'] = $e->getMessage() ;
			}	

			echo json_encode($data) ;
		}


		public function newMember()
		{
			$cell_id     = $this->input->get('cell_id'); 
			$member_id 	 = $this->input->get('member_id');  
			$date_joined = $this->input->get('date_joined') ; 


			try{

				if( empty($cell_id) ){
					throw new Exception("Error : Invalid Cell ") ;
				}


				if( empty($member_id) ){
					throw new Exception("Error : Invalid Member ");
				}


				$date_joined = (! empty($date_joined) ) ? $date_joined : $this->date_time->now('Y-m-d') ;


				if(! $this->date_time->is_valid($date_joined)  || empty($date_joined) ){
					throw new Exception("Error: Invalid Date", 1);
				}

									
				if( $this->date_time->is_future($date_joined) ){
					throw new Exception("Warning: Date can't be in the future", 1);
				}


				$feedback = $this->mdl_cell_members->exists($member_id) ;


				//check if member is already in a cell.
				if($feedback['status'] == true ){

					$msg = ($feedback['info']->small_group_id == $cell_id ) ? "Notice: Member already belongs to this cell " : "Notice: Member already belongs to another cell" ;

					throw new Exception($msg);
				}


				$cell_data = array('cell_id' => $cell_id, 'member_id' => $member_id, 'date_joined' => $date_joined, 'admin' => $this->session->admin_id ) ;

				if(! $this->mdl_cell_members->addMember($cell_data ) ){
					throw new Exception("Error: Couldn't add member to cell");
				}


				$data['status'] = "success" ;

			}   
			catch(Exception $e){

				$data['status'] = "error" ;
				$data['message'] = $e->getMessage() ;
			} 

			echo json_encode($data) ;
		}	
	
		
	}
?>

 