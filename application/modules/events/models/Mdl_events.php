<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mdl_events extends CI_Model {

		protected $table = "events";



		public function __construct(){
			
			parent::__construct();
		}



		public function all()
		{
			$this->db->order_by('id');
			return $this->db->get($this->table);
		}






		public function createEvent($title, $start, $end = null)
		{

			if(isset($end)){
				$all_day = false;
			}else{
				$all_day = true;
			}

			$data = array(
							'title' 	=> $title,
							'start' 	=> $start,
							'end' 		=> $end,
							'all_day' 	=> $all_day
							
						);

			$this->db->insert($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}






		public function week_events()
		{
			$data = array();
			$this->load->module('date_time');
			$events = $this->all();
			
			$this_week = $this->date_time->this_week();
			foreach ($events->result() as $event) {
				if( $this->date_time->this_week($event->start) == $this_week){
					$data['title'] = $event->title;
					$data['time'] 	= $event->start;
				} 
				return $data ;//$data;
			}
		}






		public function updateEvent($id, $start, $end)
		{
			$data = array('start' => $start, 'end' => $end);
			$this->db->where('id', $id); 
			$this->db->update($this->table, $data);
			return ($this->db->affected_rows() <= 0) ? false : true ;
		}
	}
?>	

 