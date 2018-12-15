<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_reports extends CI_Model {


		/*
		| District join functions start here
		| This set of functions are to provide district-related information 
		| that spans across multiple tables
		| majorly for report-genaration.
		*/

		public function zones_in_district_count($district_id)
		{
			//$this->db->select_sum($sub_cat);
			$this->db->from('zones');
			$this->db->join('community', "community.id = zones.community_id");
			$this->db->where('community.district_id', $district_id);
			$query = $this->db->get();
			return $query->num_rows();
		}



		public function zones_in_district($district_id)
		{
			$this->db->select('zones.*');
			$this->db->from('zones');
			$this->db->join('community', "community.id = zones.community_id");
			$this->db->where('community.district_id', $district_id);
			$query = $this->db->get();
			return $query ;
			
		}



		public function cells_in_district($district_id)
		{
			$this->db->select('cells.*');
			$this->db->from('cells');
			$this->db->join('zones', "zones.id = cells.zone_id");
			$this->db->join('community', "community.id = zones.community_id");
			$this->db->join('districts', "districts.id = community.district_id");
			$this->db->where('community.district_id', $district_id);
			$query = $this->db->get();
			return $query ;
			
		}



		public function members_in_district($district_id, $start_date = null, $end_date = null)
		{
			$this->db->select('cell_members.*');
			$this->db->from('cell_members');
			$this->db->join('cells', "cells.id = cell_members.cell_id");
			$this->db->join('zones', "zones.id = cells.zone_id");
			$this->db->join('community', "community.id = zones.community_id");
			$this->db->join('districts', "districts.id = community.district_id");
			$this->db->where('community.district_id', $district_id);

			if(! empty($start_date) && ! empty($end_date) ){
				$this->db->where("cell_members.date_joined between '$start_date' and '$end_date' ");
			}

			$query = $this->db->get();
			return $query ;
			
		}
		
		
		
		public function district_percentage_growth($district_id)
		{
			$cells = $this->cells_in_district($district_id);
			$cells_count = $this->cells_in_district_count($district_id);
			$avg = 0;
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();

			if($cells_count >= 1) {

				foreach($cells->result() as $cell)
				{
					$percent_growth = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month()){
							$percent_growth += $this->cell_monthly_percentage_growth($cell->id, $value);
						}	
					}
					$avg += ($percent_growth >= 1 ) ? ($percent_growth / $month_count) : 0 ;
				}
				
				return ($avg >= 1 ) ? round(($avg / $cells_count), 2) : 0 ;
			}else{
				return 0;
			}
		}

		
		
		/*
		|@param $district_id. 
		*/
		public function district_percentage_attendance($district_id) 
		{
			$cells = $this->cells_in_district($district_id);
			$cells_count = $this->cells_in_district_count($district_id);
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month(); //this month here returns an integer representation of the current month.
			$avg = 0;
			
			
			if($cells_count >= 1) {

				foreach($cells->result() as $cell)
				{
					$percent_att = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month()){
							$percent_att += $this->average_monthly_cell_attendance($cell->id, $value);
						}	
					}
					$avg += ($percent_att >= 1 ) ? ($percent_att / $month_count) : 0 ;
				}
				
				return ($avg >= 1 ) ? round(($avg / $cells_count),2) : 0 ;
			}else{
				return 0; 
			}					
		}


		/*
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		|**************************************** END DISTRICT REPORT FUNCTIONS ***************************************|
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		*/
		
		
		
		
		/*
		| Team join functions start here
		| This set of functions are to provide team-related information 
		| that spans across multiple tables
		| majorly for report-genaration.
		*/
		
		
		public function sg_in_team($team_id)
		{
			$this->db->select('small_groups.*');
			$this->db->from('small_groups');
			$this->db->join('departments', "departments.id = small_groups.department_id");
			$this->db->join('teams', "teams.id = departments.team_id");
			$this->db->where('departments.team_id', $team_id);
			$query = $this->db->get();
			return $query ;	
		}
		
		
		
		
		public function sg_in_team_count($team_id)
		{
			//$this->db->select_sum($sub_cat);
			$query = $this->sg_in_team($team_id);
			return $query->num_rows();
		}




		public function members_in_team($team_id, $start_date = null, $end_date = null)
		{
			$this->db->select('sg_members.*');
			$this->db->from('sg_members');
			$this->db->join('small_groups', "small_groups.id = sg_members.small_group_id");
			$this->db->join('departments', "departments.id = small_groups.department_id");
			$this->db->join('teams', "teams.id = departments.team_id");
			$this->db->where('sg_members.flag', 'active');
			$this->db->where('departments.team_id', $team_id);
			
			if(!empty($start_date) && !empty($end_date) ){
				$this->db->where("sg_members.date_joined between '$start_date' and '$end_date' ");
			}
			
			$query = $this->db->get();
			return $query ;
			
		}
		
		
		
		
		
		
		public function members_in_team_x($team_id, $search= null, $limit= null, $offset= null)
		{
			$this->db->select('sg_members.*');
			$this->db->from('sg_members');
			$this->db->join('small_groups', "small_groups.id = sg_members.small_group_id");
			$this->db->join('departments', "departments.id = small_groups.department_id");
			$this->db->join('teams', "teams.id = departments.team_id");
			$this->db->where('sg_members.flag', 'active');
			$this->db->where('departments.team_id', $team_id);
			
			if(isset($search) ){
			
				$this->db->like('small_groups.name', $search);		
			}
			
			if(isset($limit) && isset($offset)){
				$this->db->limit($limit, $offset);
			}
			else if(isset($limit)){
				$this->db->limit($limit);
			}
			else{}

			$query = $this->db->get();
			return $query ;
			
		}
		



		public function members_in_team_count($team_id, $start_date = null, $end_date = null)
		{
			$query = $this->members_in_team($team_id, $start_date, $end_date);
			return $query->num_rows() ;
			
		}
		
		
		
		public function team_percentage_growth($team_id)
		{
			$sgs = $this->sg_in_team($team_id);
			$sg_count = $this->sg_in_team_count($team_id);
			$avg = 0;
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();

			if($sg_count >= 1) {

				foreach($sgs->result() as $sg)
				{
					$percent_growth = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month()){
							$percent_growth += $this->sg_monthly_percentage_growth($sg->id, $value);
						}	
					}
					$avg += ($percent_growth >= 1 ) ? ($percent_growth / $month_count) : 0 ;
				}
				
				return ($avg >= 1 ) ? round(($avg / $sg_count), 2) : 0 ;
			}
			else{
				return 0;
			}		
		}




		public function team_percentage_attendance($team_id) 
		{
			$sgs = $this->sg_in_team($team_id);
			$sg_count = $this->sg_in_team_count($team_id);

			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();
			$avg = 0;
			
			if($sg_count >= 1){

				foreach($sgs->result() as $sg)
				{
					$percent_att = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month() ){
							$percent_att += $this->average_monthly_sg_attendance($sg->id, $value);
						}
						
					}
					$avg += ($percent_att >= 1 ) ? ($percent_att / $month_count) : 0 ;
				}
				
				return ($avg >= 1 ) ? round(($avg / $sg_count), 2) : 0 ;
			}else{
				return 0;
			}		
			
			
		}
		
		
		/*
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		|**************************************** END DISTRICT REPORT FUNCTIONS ***************************************|
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		*/
		
		
		
		
		
		/*
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		|**************************************** BEGIN COMMUNITY REPORT FUNCTIONS ***************************************|
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		*/
		



		public function cells_in_community($community_id)
		{
			$this->db->select('cells.*');
			$this->db->from('cells');
			$this->db->join('zones', "zones.id = cells.zone_id");
			$this->db->join('community', "community.id = zones.community_id");
			$this->db->where('zones.community_id', $community_id);
			$query = $this->db->get();
			return $query ;
			
		}



		public function cells_in_community_count($community_id)
		{
			$query = $this->cells_in_community($community_id);			
			return $query->num_rows() ;
			
		}



		public function members_in_community($community_id, $start_date = null, $end_date = null)
		{
			$this->db->select('cell_members.*');
			$this->db->from('cell_members');
			$this->db->join('cells', "cells.id = cell_members.cell_id");
			$this->db->join('zones', "zones.id = cells.zone_id");
			$this->db->join('community', "community.id = zones.community_id");
			$this->db->where('cell_members.flag', 'active');
			$this->db->where('zones.community_id', $community_id);
			
			if(!empty($start_date) && !empty($end_date) ){
				$this->db->where("cell_members.date_joined between '$start_date' and '$end_date' ");
			}
			
			$query = $this->db->get();
			return $query ;
			
		}



		public function members_in_community_count($community_id, $start_date = null, $end_date = null)
		{
			$query = $this->members_in_community($community_id, $start_date, $end_date);
			return $query->num_rows() ;
			
		}
		
		
		
		public function community_percentage_growth($community_id) 
		{
			$cells = $this->cells_in_community($community_id);
			$cells_count = $this->cells_in_community_count($community_id);
			$avg = 0;
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();

			if($cells_count >= 1) {

				foreach($cells->result() as $cell)
				{
					$percent_growth = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month()){
							$percent_growth += $this->cell_monthly_percentage_growth($cell->id, $value);
						}	
					}
					$avg += ($percent_growth >= 1 ) ? ($percent_growth / $month_count) : 0 ;
				}
				
				return ($avg >= 1 ) ? round(($avg / $cells_count), 2) : 0 ;
			}else{
				return 0;
			}
		}







		public function community_percentage_attendance($community_id) 
		{
			$cells = $this->cells_in_community($community_id);
			$cells_count = $this->cells_in_community_count($community_id);

			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();
			$avg = 0;
			
			if($cells_count >= 1){

				foreach($cells->result() as $cell)
				{
					$percent_att = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month() )
						{
							$percent_att += $this->average_monthly_sg_attendance($cell->id, $value);
						}
						
					}
					$avg += ($percent_att >= 1 ) ? ($percent_att / $month_count) : 0 ;
				}
				return ($avg >= 1 ) ? round(($avg / $cells_count), 2) : 0 ;
			}else{

				return 0;
			}			
		}


		
		
			
		/*
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		|**************************************** BEGIN DEPARTMENT REPORT FUNCTIONS ***************************************|
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		*/
		



		public function sg_in_department($department_id)
		{
			$this->load->model('small_groups/mdl_small_groups');
			$query = $this->mdl_small_groups->sgs_in_department($department_id);
			return $query ;	
		}



		public function sg_in_department_count($department_id)
		{
			$query = $this->sg_in_department($department_id);			
			return $query->num_rows() ;
			
		}



		public function members_in_department($department_id, $start_date = null, $end_date = null)
		{
			$this->db->select('sg_members.*');
			$this->db->from('sg_members');
			$this->db->join('small_groups', "small_groups.id = sg_members.small_group_id");
			$this->db->join('departments', "departments.id = small_groups.department_id");
			$this->db->where('sg_members.flag', 'active');
			$this->db->where('department_id', $department_id);
			
			if(! empty($start_date) && ! empty($end_date) ){
				$this->db->where("sg_members.date_joined between '$start_date' and '$end_date' ");
			}
			
			$query = $this->db->get();
			return $query ;
			
		}



		public function members_in_department_count($department_id, $start_date = null, $end_date = null)
		{
			$query = $this->members_in_department($department_id, $start_date, $end_date);
			return $query->num_rows() ;
			
		}
		
		
		
		public function department_percentage_growth($department_id) //overall membership percentage growth.
		{
			$sgs = $this->sg_in_department($department_id);
			$sg_count = $this->sg_in_department_count($department_id);
			$avg = 0;
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();

			if($sg_count >= 1) {

				foreach($sgs->result() as $sg)
				{
					$percent_growth = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month()){
							$percent_growth += $this->sg_monthly_percentage_growth($sg->id, $value);
						}	
					}
					$avg += ($percent_growth >= 1 ) ? ($percent_growth / $month_count) : 0 ;
				}
				
				return ($avg >= 1 ) ? round(($avg / $sg_count), 2) : 0 ;
			}
			else{
				return 0;
			}
		}




		public function department_percentage_attendance($department_id) 
		{
			$sgs = $this->sg_in_department($department_id);
			$sg_count = $this->sg_in_department_count($department_id);

			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();
			$avg = 0;
			
			if($sg_count >= 1){

				foreach($sgs->result() as $sg)
				{
					$percent_att = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month() ){
							$percent_att += $this->average_monthly_sg_attendance($sg->id, $value);
						}
						
					}
					$avg += ($percent_att >= 1 ) ? ($percent_att / $month_count) : 0 ;
				}
				
				return ($avg >= 1 ) ? round(($avg / $sg_count), 2) : 0 ;
			}else{
				return 0;
			}		
			
			
		}
		
		
		
		/*
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		|**************************************** BEGIN ZONE REPORT FUNCTIONS ***************************************|
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		*/
		
		
		
		
		public function members_in_zone($zone_id, $start_date = null, $end_date = null)
		{
			$this->db->select('cell_members.*');
			$this->db->from('cell_members');
			$this->db->join('cells', "cell_members.cell_id = cells.id");
			$this->db->join('zone', "cells.zone_id = zone.id");
			$this->db->where('cell_members.flag', 'active');
			$this->db->where('zone.id', $zone_id);
 		
			if(! empty($start_date) AND ! empty($end_date) ){
				$this->db->where("cell_members.date_joined between '$start_date' and '$end_date' ");
			}
			
			$query = $this->db->get();
			return $query ;
			
		}



		public function members_in_zone_count($zone_id, $start_date = null, $end_date = null)
		{
			$query = $this->members_in_zone($zone_id, $start_date, $end_date);
			return $query->num_rows() ;
			
		}
		
		
		public function zone_percentage_growth($zone_id)
		{
			$this->load->model('cells/mdl_cells');
		 	$cells = $this->mdl_cells->cells_in_zone($zone_id);
			$cells_count = $this->mdl_cells->cells_in_zone_count($zone_id);
			$avg = 0;
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();

			if($cells_count >= 1) {

				foreach($cells->result() as $cell)
				{
					$percent_growth = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month()){
							$percent_growth += $this->cell_monthly_percentage_growth($cell->id, $value);
						}	
					}
					$avg += ($percent_growth >= 1 ) ? ($percent_growth / $month_count) : 0 ;
				}
				
				return ($avg >= 1 ) ? round(($avg / $cells_count), 2) : 0 ;
			}else{
				return 0;
			}
		}




		public function zone_percentage_attendance($zone_id) 
		{
			$this->load->model('cells/mdl_cells');
		 	$cells = $this->mdl_cells->cells_in_zone($zone_id);
			$cells_count = $this->mdl_cells->cells_in_zone_count($zone_id);

			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();
			$avg = 0;
			
			
			if($cells_count >= 1){
				foreach($cells->result() as $cell)
				{
					$percent_att = 0;
					foreach($months as $key => $value)
					{
						if($value <= $this->date_time->this_month() ){
							$percent_att += $this->average_monthly_cell_attendance($cell->id, $value);
						}
						
					}
					$avg += ($percent_att >= 1 ) ? ($percent_att / $month_count) : 0 ;
				}
				
				return ($avg >= 1 ) ? round(($avg / $cells_count), 2) : 0 ;
			}			
		}




		





		/*
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		|**************************************** BEGIN CELL REPORT FUNCTIONS ***************************************|
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		*/



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
		
		
		
		
		public function overall_average_cell_attendance($cell_id)
		{
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();
			$add = 0;
			
			foreach($months as $key => $value)
			{
				if($value <= $this->date_time->this_month() )
				{
					$add += $this->average_monthly_cell_attendance($cell_id, $value);
				}
			}
			
			return $add / $month_count  ;
		}



		public function overall_average_cell_growth($cell_id)
		{
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();
			$add = 0;
			
			foreach($months as $key => $value)
			{
				if($value <= $this->date_time->this_month() )
				{
					$add += $this->cell_monthly_percentage_growth($cell_id, $value);
				}
			}
			
			return round( ($add / $month_count), 2)  ;
		}





		public function cell_monthly_percentage_growth($cell_id, $month)
		{
			$this->load->model('cell_members/mdl_cell_members');


			$bench_mark_date = '1900-01-01';

			$year = $this->date_time->full_year();

			$prev_month = ($month == '1' || $month == '01') ? '12' : ($month - 1);
			$yr = ($month == '1' || $month == '01') ? ($year - 1 ) : $year;

			$prev_month = str_pad($prev_month, 2, 0, STR_PAD_LEFT);
			$month = str_pad($month, 2, 0, STR_PAD_LEFT);

			$days_in_prev_month = $this->date_time->number_of_days_in_month($prev_month, $yr);
			$days_in_this_month = $this->date_time->number_of_days_in_month($month, $year);

			$end_range = "$yr-$prev_month-$days_in_prev_month";

			$new_start_range = "$year-$month-01";
			$new_end_range 	 = "$year-$month-$days_in_this_month";

			$members_before_now = $this->mdl_cell_members->members_in_cell_count($cell_id, $bench_mark_date, $end_range );
			$new_members 	   = $this->mdl_cell_members->members_in_cell_count($cell_id, $new_start_range, $new_end_range); 

			return ($members_before_now >= 1) ? round((($new_members / $members_before_now) * 100), 2) : 0;
			
		}







		/*
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		|**************************************** END CELL REPORT FUNCTIONS *******************************************|
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		*/




		/*
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		|**************************************** BEGIN Small Group REPORT FUNCTIONS **********************************|
		|**************************************************************************************************************|
		|**************************************************************************************************************|
		*/



		public function average_monthly_sg_attendance($sg_id, $month)
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








		public function overall_average_sg_attendance($sg_id)
		{
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();
			$add = 0;
			
			foreach($months as $key => $value)
			{
				if($value <= $this->date_time->this_month() )
				{
					$add += $this->average_monthly_sg_attendance($sg_id, $value);
				}
			}
			
			return round(($add / $month_count), 2)  ;
		}








		public function overall_average_sg_growth($sg_id)
		{
			$months = $this->date_time->months();
			$month_count = $this->date_time->this_month();
			$add = 0;
			
			foreach($months as $key => $value)
			{
				if($value <= $this->date_time->this_month() )
				{
					$add += $this->sg_monthly_percentage_growth($sg_id, $value);
				}
			}
			
			return round(($add / $month_count), 2)   ;
		}






		public function sg_monthly_percentage_growth($sg_id, $month)
		{
			$this->load->model('sg_members/mdl_sg_members');


			$bench_mark_date = '1900-01-01';

			$year = $this->date_time->full_year();

			$prev_month = ($month == '1' || $month == '01') ? '12' : ($month - 1);
			$yr = ($month == '1' || $month == '01') ? ($year - 1 ) : $year;

			$prev_month = str_pad($prev_month, 2, 0, STR_PAD_LEFT);
			$month = str_pad($month, 2, 0, STR_PAD_LEFT);

			$days_in_prev_month = $this->date_time->number_of_days_in_month($prev_month, $yr);
			$days_in_this_month = $this->date_time->number_of_days_in_month($month, $year);

			$end_range = "$yr-$prev_month-$days_in_prev_month";

			$new_start_range = "$year-$month-01";
			$new_end_range 	 = "$year-$month-$days_in_this_month";

			$members_before_now = $this->mdl_sg_members->members_in_sg_count($sg_id, $bench_mark_date, $end_range );
			$new_members 	   = $this->mdl_sg_members->members_in_sg_count($sg_id, $new_start_range, $new_end_range); 

			return ($members_before_now >= 1) ? round((($new_members / $members_before_now) * 100), 2) : 0;
			
		}








		


	}
?>	

 