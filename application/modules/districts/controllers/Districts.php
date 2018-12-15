<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Districts extends MX_Controller {



		public function __construct()
		{
			parent::__construct() ;
 			parent::loggedIn();
			$this->load->model('districts/mdl_districts');
			$this->load->model('reports/mdl_reports');
		}	



		public function index()
		{
			$this->manageDistricts();
		}



		/**
		* Loads the create district view
		*/

		public function createDistrict()
		{
			$this->load->view('createDistricts') ;
		}


		/**
		* Loads the manage district view
		*/
		public function manageDistricts()
		{
			$this->load->view('allDistricts') ;
		}



		/**
		* Returns information about a district
		* The district id is passed as a query string 
		* return type - json object
		*/
		public function districtInfo(){

			$district_id = $this->input->get('district_id') ;
			$districts = $this->mdl_districts->get_info($district_id) ;
			echo json_encode($districts) ;

		}


		/**
		* This controls the creation of a new district
		* Information about the district is passed in from angular district object
		* return type - json object
		*/
		public function newDistrict(){

			$name   = $this->input->get('name') ;
			$abbr   = $this->input->get('abbrevation') ;
			$pastor = $this->input->get('pastor') ;

			try{

				if(empty($name) || empty($abbr) ){
					throw new Exception("important fields missing");
				}


				//array of field-values to check for uniqueness.
				if( ! empty ($pastor) ){

					//$pastor = json_decode($pastor) ;
					$districtData = array ('name'=> $name, 'abbrevation' => $abbr, 'pastor' => $pastor ) ; 

				}else{

					$districtData = array ('name'=> $name, 'abbrevation' => $abbr ) ; 
				}	


				//check if any of the values in the $check array already exists.
				$result = $this->mdl_districts->exists($districtData) ;


				//throw exception if any of the field-value declared in $check exists in the db.
				if($result['status'] == true){

					throw new Exception("District with this " .$result['field']. " already exists") ; 
				}

				//array of data to be sent to the database
				$districtData['date_created'] = $this->date_time->now('Y-m-d') ; 
				$districtData['created_by']   = $this->session->admin_id ;

				
				//throw exception if an error occured while creating the district.
				if(! $this->mdl_districts->create( $districtData ) ){
					throw new Exception("Error: unable to create district");
				}

				$data['status']  = "success";
			}
			catch(Exception $e){

				$data['message'] = $e->getMessage() ;
				$data['status']  = "error" ;
			}

			echo json_encode($data) ;
		}


		/**
		* Returns a list of active districts as a json object 
		*/
		public function getDistricts(){

			echo json_encode($this->mdl_districts->all()->result() ) ;
		}
			



		public function district_page()
		{
		
			$district_id   = $this->input->get('district_id');
		 	$district_name = $this->mdl_districts->get_name($district_id);

			$data['module'] 		= $this->module;
			$data['title'] 		= $district_name;
			$data['self_name'] 	= $district_name;
			$data['self_id'] 		= $district_id;
							
			$this->load->view('districtPage', $data) ;
			
		}



		public function report()
		{
			$this->load->view('districtPageReport');
		}



		// public function reportData(){

		// 	$this->load->model('communities/mdl_communities');
		// 	$district_id 	 = 1 ;// $this->input->get('district_id');

		// 	$districtInfo = $this->mdl_districts->get_info($district_id) ;

		// 	//$data['chart'] = array('caption' => )
		

		// 	$district_name  = $districtInfo->name ;
		// 	$district_abbr  = $districtInfo->abbr ;
		// 	$district_pastor = $districtInfo->pastor ;

		// 	$months 		= json_decode( $this->date_time->month_array() );
		// 	$year 		= $this->date_time->year_full();
			
		// 	$comm_count 	= $this->mdl_communities->communities_in_district_count($district_id);
		// 	//$zone_count 	= $this->mdl_reports->zones_in_district_count($district_id);
		// 	//$cell_count 	= $this->mdl_reports->cells_in_district_count($district_id);
		// 	//$members_count = $this->mdl_reports->members_in_district_count($district_id);


		// 	foreach ($months as $month) {

		// 		if($month->value <= $this->date_time->month() ){

		// 			$num_of_days_in_month = $this->date_time->number_of_days_in_month($month->value, $year);
		// 			 $start_date = $year."-". $month->value. "-01";
		// 			 $end_date 	= $year. "-" .$month->value. "-" .$num_of_days_in_month ;
		// 			$mg[] = $this->mdl_reports->members_in_district_count($district_id, $start_date, $end_date);
		// 			$cat[] = $month->name;
		// 		}	
		// 	}


		// 	$test = array($comm_count, 0, 0, 0) ;

		// 	$general[] 					= array('name'=>$district_name, 'data' => $test) ;
		// 	//$avg_monthly_growth[] 	= array('name'=>$district_name, 'data' => $mg );

		// 	//$data['district_id'] 		= $district_id;
		// 	//$data['district_pastor'] 	= $district_pastor;
		// 	//$data['district_name'] 		= $district_name;
		// 	//$data['district_abbr'] 		= $district_abbr;
		// 	//$data['members_count'] 	= $members_count;


		// 	$data['general'] 					= json_encode($general);
		// 	//$data['avg_monthly_growth'] 	= json_encode($avg_monthly_growth);
		// 	//$data['categories'] 				= json_encode($cat);

		// 	echo  json_encode($data) ;
			
		// }





		public function districtOverviewReport(){

			$district_id = $this->input->get('district_id');

			$this->load->model('communities/mdl_communities') ;

			$communities = $this->mdl_communities->all($district_id)->num_rows() ;
			$zones       = $this->mdl_reports->zones_in_district($district_id)->num_rows() ;
			$cells       = $this->mdl_reports->cells_in_district($district_id)->num_rows() ;
			$members     = $this->mdl_reports->members_in_district($district_id)->num_rows() ;

			$data = array(

				array('label' => "Number of Commuities", 'value' => $communities),
				array('label' => "Number of Zones",      'value' => $zones ),
				array('label' => "Number of Cells",      'value' => $cells ),
				array('label' => "Total members",    'value' => $members ),
			)	;

			echo  json_encode($data) ;
			
		}


		

		public function drop()
		{
			$district_id = $this->input->get('district_id')  ;

			try{

				if( empty($district_id) ){
					throw new Exception("no district selected");
				}


				if(! $this->mdl_districts->drop($district_id) ){
					throw new Exception("Error processing request");
				}

				$data['status'] = 'success' ;
					
			}catch(Exception $e){

				$data['status']  = 'error' ;
				$data['message'] = $e->getMessage() ;
			}	


			echo json_encode($data) ;	
		}





		// public function update()
		// {
		// 	$district_id = $this->input->get('district_id')  ;

		// 	if(! $this->mdl_districts->($district_id) ){
		// 		throw new Exception("Errorupdate processing request");
		// 	}

		// 		$data['status'] = 'success' ;
					
		// 	}catch(Exception $e){

		// 		$data['status']  = 'error' ;
		// 		$data['message'] = $e->getMessage() ;
		// 	}	


		// 	echo json_encode($data) ;	
		// }



		public function test(){
			var_dump($this->mdl_districts->status(1)) ;
		}



		
	}
?>

 