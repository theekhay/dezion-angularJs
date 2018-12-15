<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Small_groups extends MX_Controller {


		


		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('small_groups/mdl_small_groups');
		}





		public function index()
		{
			//$this->view_all() ;
		}



		public function create(){

			$this->load->view('createSmallGroup') ;
		}




		/**
		* API for getting information about a small group.
		* returns info about the specified group id
		*/

		public function smallGroupInfo(){

			$small_group_id = $this->input->get('small_group_id') ;
			$info = $this->mdl_small_groups->get_info($small_group_id) ;
			echo json_encode($info) ;
		}




		/**
		* API for getting small group 
		* Returns a list of active departments as a json object 
		*
		*/
		public function getSmallGroups(){

			$department_id = $this->input->get('department_id') ;
			echo json_encode($this->mdl_small_groups->all($department_id)->result() ) ;
		}


	


		public function newSmallGroup()
		{
			$name 				= $this->input->get('name') ;
			$abbr 				= $this->input->get('abbrevation') ;
			$leader 			= $this->input->get('leader') ;
			$department 		= $this->input->get('department') ;
		

			try{

				if( empty($name) || empty($abbr) ){
					throw new Exception('Warning : Important fields missing');
				}



				if( empty($department) ) {
					throw new Exception('Error : Invalid department') ;
				}


				$sg_data = ( ! empty($leader) ) ? ['name'=>$name, 'leader'=>$leader, 'abbrevation'=>$abbr] : ['name'=>$name, 'abbrevation'=>$abbr] ;

				$feedback = $this->mdl_small_groups->exists($sg_data) ;

				if($feedback['status'] == true ){
					throw new Exception("Warning: Small Group with this ". $feedback['field']."  already exists. Duplicates not allowed");
					
				}

				$sg_data ['department_id'] 	= $department ;
				$sg_data ['date_created'] 	= $this->date_time->now('Y-m-d') ;
				$sg_data ['created_by'] 	= $this->session->admin_id ;
						
				

				if(! $this->mdl_small_groups->createSmallGroup($sg_data ) ) {
					$this->createSmallGroup("Error creating this group ");
				}


				$data ['status'] = 'success' ;

			}
			catch(Exception $e){

				$data['message'] = $e->getMessage() ;
				$data ['status'] = 'error' ;

			}	

            echo json_encode($data) ;
			
		}



		public function small_group_page()
		{
			$this->load->view('smallGroupPage') ;
		}




	


		public function sg_report()
		{

			
			$small_group_id = $this->input->get('small_group_id');

			if($this->model()->id_exists($small_group_id) == false){
				return;
			}

			$small_group_name 	= $this->model()->get_name($small_group_id);
			$small_group_code 	= $this->model()->get_code($small_group_id);
			$small_group_leader = $this->model()->get_data_by_id($small_group_id, 'small_group_leader');
			$date_created 	= $this->model()->get_data_by_id($small_group_id, 'date_created');

			$months = $this->date_time->months();
			$year = $this->date_time->full_year();
			$this->load->model('sg_members/mdl_sg_members');
			$member_count 	= $this->mdl_sg_members->members_in_sg_count($small_group_id);

			$all_sgs = $this->mdl_sg_members->sg_all($small_group_id);
			$count = $all_sgs->num_rows();

			$sg_members = $this->mdl_sg_members->members_in_sg($small_group_id);
			
			foreach ($sg_members->result() as $member) {
				$members[] = $member->member_id;
			}


			foreach ($months as $key => $value) {
					
				if($value <= $this->date_time->this_month() ){

					$num_of_days_in_month = $this->date_time->number_of_days_in_month($value, $year);
					$start_date = "$year-$value-01";
					$end_date 	= "$year-$value-$num_of_days_in_month";
					$mg[] 		= $this->mdl_sg_members->members_in_sg_count($small_group_id, $start_date, $end_date);
					$avg_att[] 	= $this->average_monthly_sg_attendance($small_group_id, $value);
	
				}
				
			}


			foreach ($months as $key => $value) {
				if($value <= $this->date_time->this_month() )
				{
					$cat[] = $key;
				}
			}

			$monthly_growth[] 			= array('name'=>$small_group_name, 'data' => $mg );
			$monthly_attendance[] 		= array('name'=>$small_group_name, 'data' => $avg_att );

			$data['sg_id'] 				= $small_group_id;
			$data['sg_leader'] 			= $small_group_leader;
			$data['sg_code'] 			= $small_group_code;
			$data['sg_name'] 			= $small_group_name;
			$data['members'] 			= (! empty($members)) ? $members : NULL ;
			$data['member_count'] 		= $member_count;
			$data['monthly_growth'] 	= json_encode($monthly_growth);
			$data['monthly_attendance'] = json_encode($monthly_attendance);
			$data['categories'] 		= json_encode($cat);

			$data['module'] 			= $this->module;
			$data['view_file'] 			= 'smallGroupPageReport';
			$data['title'] 				= "$small_group_name report ";
			
			$data['add_btn'] 			= false;
			$data['btn_link'] 			= base_url() ."districts/createDistrict";
			$data['btn_title'] 			= "create new District";
			$data['top_data'] 			= "<a href='".base_url()."cells/cell_page/?cell_id=$small_group_id'> $small_group_name report</a>";

			$data['icon_class'] = 'fa fa-area-chart' ;

			echo Modules::run('templates/gen', $data);
		}




		/**
		* API for deleting a small group.
		* 
		*/
		public function drop()
		{
			$small_group_id = $this->input->get('small_group_id')  ;

			try{

				if( empty($small_group_id) ){
					throw new Exception("Error: No small group selected");
				}


				if(! $this->mdl_small_groups->drop($small_group_id) ){
					throw new Exception("Error processing request");
				}

				$data['status'] = 'success' ;
					
			}catch(Exception $e){

				$data['status']  = 'error' ;
				$data['message'] = $e->getMessage() ;
			}	


			echo json_encode($data) ;	
		}
		




		public function average_monthly_sg_attendance($sg_id, $month) //not finished with this.
		{
			$memb_avg_monthly_att = 0;
			$this->load->model('sg_members/mdl_sg_members');
			$this->load->model('sg_attendance_management/mdl_sg_attendance_management');
			$sg_members = $this->mdl_sg_members->members_in_sg($sg_id);
			$count = $sg_members->num_rows();

			if($count >= 1){
				foreach ($sg_members->result() as $sg_member) {					
					$memb_avg_monthly_att += $this->mdl_sg_attendance_management->member_avg_attendnace($sg_member->member_id, $month);
				}

				return round ( (($memb_avg_monthly_att / $count)  * 100), 2) ;
			}else{
				return 0;
			}		
		}



		public function test()
		{
			echo $this->average_monthly_sg_attendance('1', '08');
		}


		//$this->load->model


		
	}
?>

 