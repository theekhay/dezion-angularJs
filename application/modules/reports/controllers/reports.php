<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Reports extends MX_Controller {

		public $model  = 'mdl_reports'; 
		public $module = 'reports';



		public function __construct()
		{
			parent::loggedIn();
			$this->load->model('reports/mdl_reports');
			$this->load->model('cells/mdl_cells');
			$this->load->model('cell_members/mdl_cell_members');
			//$this->load->model('tables/mdl_tables');
		} 



		public function index()
		{
			$this->report();
		}




		public function report()
		{
			$data['module'] 		= $this->module;
			$data['view_file'] 		= 'reportPage';
			$data['title'] 			= 'first timer record';
			
			echo Modules::run('templates/general', $data);
		}



		/*
		| THE SET OF FUNCTIONS BELOW WOULD CONTROL DATA GATHERING FOR THE CELL MODULE
		| THIS WOULD AID IN CENTRALIZED REPORT GENERATION AND QUICK INFORMATION GATHERING
		| @THEEKHAY! 
		*/

		public function total_number_of_cells()
		{			
			$cells = $this->mdl_cells->all();
			echo $cells->num_rows();
		}



		public function cell_membership_strength()
		{
			$cell_id = $this->input->get('cell_id');
			echo $this->mdl_cell_members->members_in_cell_count($cell_id);
		}



		public function total_number_of_cells_in_a_zone()
		{	
			$zone_id = $this->input->get('zone_id');		
			$cells = $this->mdl_cells->zone_all($zone_id);
			echo $cells->num_rows();
		}



		public function cell_members_attendance_report($cell_id, $range = null)
		{
			$members = array();
			//$cell_id = $this->input->get('cell_id');
			$cell_members = $this->mdl_cell_members->cell_all($cell_id);

			foreach ($cell_members->result() as $member) {
				$members[] = $member->member_id;
			}

			$column_dates = $this->mdl_tables->list_columns_in_table('attended');
			
			foreach ($column_dates as $date) {
				if($this->date_time->date_check($date) == true){
					$dates[] = $date ;
				} 
			}
			$out = "";

			$out .= "<table>" ;	
			foreach ($members as $m) {
				$firstname = $this->mdl_members->get_data_by_id($m, 'firstname');
				$surname = $this->mdl_members->get_data_by_id($m, 'surname');
				$full_name = $firstname. " ". $surname ;
				$out .= "<tr>";
				$out .= "<td>$full_name</td>";
				foreach ($dates as  $d) {

					//$sql = "select $d from attended where members_id = $m ";
					$this->db->from('attended');
					$this->db->where('member_id', $m);
					$query = $this->db->get();
					$row = $query->row_array();
					$ans1 =  $row[$d];
					$out1 = ($ans1 == 1) ? 'present' : 'absent';
					$out .= "<td>$out1</td>";

					$this->db->from('served');
					$this->db->where('member_id', $m);
					$query = $this->db->get();
					$row = $query->row_array();
					$ans2 =  $row[$d];
					$out2 = ($ans2 == 1) ? 'Yes' : 'No';
					$out .= "<td>$out2</td>";


					if($ans1 != 1)
					{
						$this->db->from('absent_reason');
						$this->db->where('member_id', $m);
						$query = $this->db->get();
						$row = $query->row_array();
						$ans3 =  $row[$d];

						$out .= "<td>$ans3</td>";
					}else{
						$out .= "<td> </td>";
					}	








					$out .= "<td style='width:20px; background:#607D8B'></td>";
				}
				$out .= "</tr>";
			}
			$out .= "</table>" ;	

			echo $out ;
			
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






		/*
		| END FUNCTIONS THAT CONTROL REPORT GENERATION FOR THE CELL MODULE
		| @THEEKHAY! 
		*/


		public function test()
		{
			$this->load->model('reports/mdl_reports');
			echo $all = $this->mdl_reports->cell_monthly_percentage_growth('1', '9');
		
			
			
			/*
			foreach ($cells->result() as $cell) {
				echo $cell->member_id. "<br>";
			}
			*/
			

			//var_dump($zo);
		}

		
	}
?>

 