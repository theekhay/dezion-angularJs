<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cells extends MX_Controller {

		

		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('cells/mdl_cells');
		}




		public function index()
		{
			$this->view_all();
		}



		/**
		* Loads the create cell view.
		*
		*/

		public function create(){

			$this->load->view('createCell');
		}


		/**
		* API for the creation of a new cell.
		*
		*/

		public function newCell()
		{
			$cell = json_decode( $this->input->get('cell') );

			try{

				if( ! isset( $cell->address) ){
					throw new Exception('Warning: Cell address missing') ;
				}

				if( empty($cell->zone_id) ){
					throw new Exception('Error: Invalid zone') ;
				}
				 
				//check for duplicates

				if( isset($cell->name) )  $cell_check['name'] = $cell->name ;
				
				if( isset($cell->abbr) )  $cell_check['abbrevation'] = $cell->abbrevation ; 

				if( isset($leader) ) 	  $cell_check['leader'] = $cell->leader ;
				
				  			
				if (isset($cell_check) ){

					$feedback = $this->mdl_cells->exists($cell_check) ;

					if( $feedback['status'] ){
						throw new Exception("Cell with this " .$feedback['field']. " already exists. Duplicates not allowed");
					}
				}
			
				$cell->created_by 	= $this->session->admin_id ;
				$cell->date_created = $this->date_time->format(unix_to_human(now() ), 'Y-m-d' ) ;

				unset($cell->leaderName) ;

				if(! $this->mdl_cells->createCell($cell) ){
					throw new Exception("Error: unable to create cell.");
				}

				$data['status'] = "success" ;

			}
			catch(Exception $e){
				
				$data['status'] = "error" ;
				$data['message'] = $e->getMessage() ;
			}					
			
			echo json_encode($data) ;
		}



		/**
		* Returns a list of active cells as a json object 
		**/
		public function getCells(){

			$zone_id = $this->input->get('zone_id') ;
			echo json_encode($this->mdl_cells->all($zone_id)->result() ) ;
		}



		/**
		* Loads the manage cells view.
		* A list of cells for the given zone.
		*/
		public function cellPage()
		{					
			$this->load->view('cellPage');
		}



		public function cellInfo(){

			$cell_id = $this->input->get('cell_id') ;
			$info = $this->mdl_cells->get_info($cell_id) ;
			echo json_encode($info) ;
		}




		public function cellsInZone(){

			$zone_id = $this->input->get('zone_id') ;
			$count = $this->mdl_cells->all($zone_id)->num_rows() ;
			echo json_encode(['cell_count' => $count ]) ;
		}




		



		


		public function assimilationReport()
		{
			$cell_id = $this->input->get('cell') ; 	

			$data['years'] = $this->date_time->year_list();
			$data['cell_id'] = $cell_id ;
			$data['view_file']   = 'cellAssimilationReport' ;
			$data['title']  = 'assimilation Report' ;
			$data['cell_name']  = $this->model()->get_name($cell_id) ;
			$data['module'] = $this->module ;

			echo Modules::run('templates/gen', $data);

		}



		public function drop()
		{
			$cell_id = $this->input->get('cell_id')  ;

			try{

				if( empty($cell_id) ){
					throw new Exception("Error: Invalid Cell");
				}


				if(! $this->mdl_cells->drop($cell_id) ){
					throw new Exception("Error processing request");
				}

				$data['status'] = 'success' ;
					
			}catch(Exception $e){

				$data['status']  = 'error' ;
				$data['message'] = $e->getMessage() ;
			}	

			echo json_encode($data) ;	
		}



		public function generateAssimilationReport()
		{
			$get_month = $this->input->get('month') ;
			$get_year  = $this->input->get('year') ;
			$cell_id  = $this->input->get('cell_id') ;

			$this->load->module('cell_members') ;


			//if(empty($cell_id) OR ! $this->model()->id_exists($cell_id))
			//	echo ""; return ;


			$this_month = $this->date_time->this_month() ;
			$this_year = $this->date_time->full_year() ; 

			$month = ! empty($get_month) ? $get_month : $this_month ;
			$year  = ! empty($get_year) ? $get_year : $this_year ;

			$week_list = $this->date_time->week_list($month, $year) ;


			$data['cell_id'] 	= $cell_id ;
			$data['week_list'] 	= $week_list ;
			$data['module'] = $this->module ;
			$data['month'] 		= $month ;
			$data['year'] 		= $year ;
			$data['current_year'] 		= $this->date_time->full_year() ;
			$data['view_file']   = 'loadAssimilationReport' ;

			echo Modules::run('templates/plain', $data);
		}



		public function cell_report()
		{

			
			$cell_id = $this->input->get('cell_id');

			if($this->model()->id_exists($cell_id) == false){
				return;
			}

			$cell_name 		= $this->model()->get_name($cell_id);
			$cell_code 		= $this->model()->get_code($cell_id);
			$cell_leader 	= $this->model()->get_data_by_id($cell_id, 'cell_leader');
			$date_created 	= $this->model()->get_data_by_id($cell_id, 'date_created');

			$months = $this->date_time->months();
			$year = $this->date_time->full_year();
			$this->load->model('cell_members/mdl_cell_members');
			$member_count 	= $this->mdl_cell_members->members_in_cell_count($cell_id);
			$cell_members		= $this->mdl_cell_members->members_in_cell($cell_id);

			foreach ($cell_members->result() as $member) {
				$members[] = $member->member_id;
			}

			$all_cells = $this->mdl_cell_members->cell_all($cell_id);
			$count = $all_cells->num_rows();



			foreach ($months as $key => $value) {
					
				if($value <= $this->date_time->this_month() ){

					$num_of_days_in_month = $this->date_time->number_of_days_in_month($value, $year);
					$start_date = "$year-$value-01";
					$end_date 	= "$year-$value-$num_of_days_in_month";
					$mg[] 		= $this->mdl_cell_members->members_in_cell_count($cell_id, $start_date, $end_date);
					$avg_att[] 	= $this->average_monthly_cell_attendance($cell_id, $value);				
	
				}
				
			}


			foreach ($months as $key => $value) {
				if($value <= $this->date_time->this_month() )
				{
					$cat[] = $key;
				}
			}

			$monthly_growth[] 			= array('name'=>$cell_name, 'data' => $mg );
			$monthly_attendance[] 		= array('name'=>$cell_name, 'data' => $avg_att );

			$data['count'] 				= $count ;
			$data['cell_id'] 			= $cell_id;
			$data['cell_leader'] 		= $cell_leader;
			$data['cell_code'] 			= $cell_code;
			$data['cell_name'] 			= $cell_name;
			$data['member_count'] 		= $member_count;
			$data['members'] 			= (! empty($members)) ? $members : NULL ;
			$data['monthly_growth'] 	= json_encode($monthly_growth);
			$data['monthly_attendance'] = json_encode($monthly_attendance);
			$data['categories'] 			= json_encode($cat);

			$data['module'] 			= $this->module;
			$data['view_file'] 			= 'cellPageReport';
			$data['title'] 				= "$cell_name report ";
			
			$data['add_btn'] 			= false;
			$data['btn_link'] 			= base_url() ."districts/createDistrict";
			$data['btn_title'] 			= "create new District";
			$data['top_data'] 			= "<a href='".base_url()."cells/cell_page/?cell_id=$cell_id'> $cell_name report</a>";
			
			$data['page_name'] 		= "Admin" ;
			$data['name_link'] 		= base_url() ."admin/";

			$data['icon_class'] 	= 'fa fa-area-chart' ;
										
			echo Modules::run('templates/gen', $data);
		}
		

		
	
		
		public function average_monthly_cell_attendance($cell_id, $month)
		{
			$memb_avg_monthly_att = 0;
			$this->load->model('cell_members/mdl_cell_members');
			$this->load->model('cell_attendance_management/mdl_cell_attendance_management');
			$cell_members = $this->mdl_cell_members->members_in_cell($cell_id);
			$count = $cell_members->num_rows();

			if($count >= 1){
				foreach ($cell_members->result() as $cell_member) {					
					$memb_avg_monthly_att += $this->mdl_cell_attendance_management->member_avg_cell_attendnace($cell_member->member_id, $month);
				}

				return round ( (($memb_avg_monthly_att / $count)  * 100), 2) ;
			}else{
				return 0;
			}		
		}



		
		
		
		
		
		




	}
?>

 