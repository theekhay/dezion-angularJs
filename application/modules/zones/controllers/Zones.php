<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Zones extends MX_Controller {




		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('zones/mdl_zones');
			$this->load->model('reports/mdl_reports');
		}





		public function index()
		{
			$this->view_all();
		}



		/**
		* API for getting zones 
		* Returns a list of active zones as a json object 
		*
		*/
		public function getzones(){

			$community_id = $this->input->get('community_id') ;
			echo json_encode($this->mdl_zones->all($community_id)->result() ) ;
		}




		/**
		* Loads the create zone view.
		* 
		*/

		public function create()
		{						
			$this->load->view('createZone');	
		}



		/**
		* Loads the Zone page view
		* This would usually be a list of zones in a particular community. 
		*
		*/

		public function zonePage()
		{			
			$this->load->view('zonePage');
		}



		/**
		* API for the creation of a new community
		* 
		*/
		public function newZone()
		{
			$name 				= $this->input->get('name') ;
			$abbr 				= $this->input->get('abbrevation') ;
			$leader      		= $this->input->get('leader') ;
			$community 			= $this->input->get('community') ;

		
			try{

				if(empty($name) || empty($abbr) ){
					throw new Exception("Warning : Important Fields Missing");
				}


				if( empty($community) ){
					throw new Exception('Error : Invalid Community');
				}


				//array of field-values to check for uniqueness.
				if( ! empty($leader) ){

					$zone_data = array ('name'=> $name, 'abbrevation' => $abbr, 'leader' => $leader ) ;
					
				}else{

					$zone_data = array ('name'=> $name, 'abbrevation' => $abbr ) ;
				}


				//check if any of the values in the $check array already exists.
				$result = $this->mdl_zones->exists($zone_data) ;


				//throw exception if any of the field-value declared in $check exists in the db.
				if($result['status'] == true ){

					throw new Exception("Zone with this " .$result['field']. " already exists.") ; 
				}

				$zone_data [ 'community_id'] = $community ; 
				$zone_data ['date_created'] = $this->date_time->now('Y-m-d') ;
				$zone_data [ 'created_by'] 	= $this->session->admin_id; 


				if(! $this->mdl_zones->createZone($zone_data) ){
					throw new Exception("Error: unable to create zone" ) ;
				}	


				$data['status'] = "success" ;


			}
			catch(Exception $e){

				$data['status']  = 'error' ;
				$data['message'] = $e->getMessage() ; 
			}


			echo json_encode($data) ;

		}	



		/**
		* API for getting information about a zone.
		* returns info about the specified zone id
		*/

		public function zoneInfo(){

			$zone_id = $this->input->get('zone_id') ;
			$info = $this->mdl_zones->get_info($zone_id) ;
			echo json_encode($info) ;
		}
			



		public function zonePageReport()
		{
			

			$zone_id 	 = $this->input->get('zone_id');
			if($this->mdl_zones->id_exists($zone_id) == false)
			{
				return;
			}
			$zone_name 		= $this->mdl_zones->get_name($zone_id);
			$zone_code 		= $this->mdl_zones->get_code($zone_id);
			$zonal_leader 	= $this->mdl_zones->get_data_by_id($zone_id, 'zonal_leader');

			$months = $this->date_time->months();
			$year = $this->date_time->full_year();
			$this->load->model('cells/mdl_cells');
			$this->load->model('reports/mdl_reports');

			$cell_count 	= $this->mdl_cells->cells_in_zone_count($zone_id);
			$members_count 	= $this->mdl_reports->members_in_zone_count($zone_id);


			foreach ($months as $key => $value) {
					
				if($value <= $this->date_time->this_month() ){

					$num_of_days_in_month = $this->date_time->number_of_days_in_month($value, $year);
					$start_date = "$year-$value-01";
					$end_date 	= "$year-$value-$num_of_days_in_month";
					$mg[] = $this->mdl_reports->members_in_zone_count($zone_id, $start_date, $end_date);
	
				}
				
			}


			foreach ($months as $key => $value) {
				if($value <= $this->date_time->this_month() ){
					$cat[] = $key;
				}
			}

				
			$test[] = $cell_count ;
			$test[] = $members_count ;

			$number_of_comm[] 			= array('name'=>$zone_name, 'data' => $test) ;
			$monthly_growth[] 			= array('name'=>$zone_name, 'data' => $mg );

			$data['zone_id'] 			= $zone_id;
			$data['zonal_leader'] 		= $zonal_leader;
			$data['zone_name'] 			= $zone_name;
			$data['zone_code'] 			= $zone_code;
			$data['members_count'] 		= $members_count;


			$data['comm'] 				= json_encode($number_of_comm);
			$data['monthly_attendance'] = json_encode($monthly_growth);
			$data['categories'] 		= json_encode($cat);

			$data['module'] 			= $this->module;
			$data['view_file'] 			= 'zonePageReport';
			$data['title'] 				= "$zone_name zone report ";
			
			$data['add_btn'] 		= false;
			$data['btn_link'] 		= base_url() ."zones/createZone";
			$data['btn_title'] 		= "#";
			$data['top_data'] 		=  "$zone_name zone report";

			$data['page_name'] 		= "Zones" ;
			$data['name_link'] 		= base_url() ."zones/";

			$data['icon_class'] 	= 'fa fa-pie-chart' ;
										
			echo Modules::run('templates/gen', $data);


		}




		
		/**
		* API for deleting a zone. 
		*/
		public function drop()
		{
			$zone_id = $this->input->get('zone_id')  ;

			try{

				if( empty($zone_id) ){
					throw new Exception("Error: Invalid zone ");
				}


				if(! $this->mdl_zones->drop($zone_id) ){
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

 