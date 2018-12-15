 <?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sg_members extends MX_Controller {


		public function __construct()
		{
			parent::__construct();
			parent::loggedIn();
			$this->load->model('sg_members/mdl_sg_members') ;
		}	




		public function index()
		{
			$this->addMember();
		}


		/**
		* Loads the view to add member to a small group
		*
		*/
		public function addMember(){
			
			$this->load->view('addMember') ;
		}


		/**
		* Loads the view that shows members in a small group 
		*
		*/
		public function members(){
			$this->load->view("group_members") ;
		}


		/**
		* Returns the list of members in a small group
		* if no small group is selected it shows all members 
		*
		*/

		public function get_members(){

			$small_group_id = $this->input->get('small_group_id') ;
			echo json_encode($this->mdl_sg_members->all($small_group_id)->result() ) ;
		}




		public function newMember()
		{
			try{

				$group_id  		= $this->input->get('group_id') ;
				$member_id   	= $this->input->get('member_id') ;
				$date_joined   	= $this->input->get('date_joined') ; 
				
				

				if( empty($group_id)  ){
					throw new Exception("Error: invalid Small group");
				}



				if( empty($member_id) ){
						throw new Exception("Error: invalid member");
				}


				$date_joined = (! empty($date_joined) ) ? $date_joined : $this->date_time->now('Y-m-d') ;


				if(! $this->date_time->is_valid($date_joined)  || empty($date_joined) ){
					throw new Exception("Error: Invalid Date", 1);
				}

									
				if( $this->date_time->is_future($date_joined) ){
					throw new Exception("Warning: Date can't be in the future", 1);
				}


				$feedback = $this->mdl_sg_members->exists($member_id) ;

				//check if member is already in a small group.
				if($feedback['status'] == true ){

					$msg = ($feedback['info']->small_group_id == $group_id ) ? "Notice: Member already belongs to this group " : "Notice: Member already belongs to another group" ;

					throw new Exception($msg);
				}
				

				$sg_data  = array('small_group_id' => $group_id, 'member_id' => $member_id, 'date_joined' => $date_joined, 'admin' => "admin" ) ;


				if( ! $this->mdl_sg_members->addMember($sg_data) ){
					throw new Exception("Error: unable to add member to this group.");
				}

				$data ['status'] = "success" ;					
					
			}
			catch(Exception $e){

				$data ['status']  = "error" ;
				$data ['message'] = $e->getMessage() ;
			}


			echo json_encode($data) ;
			
		}


		
	}
?>

 