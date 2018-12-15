<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Templates extends MX_Controller { 



		public $template_path ;

		public $jquery_path ;		//path to jquery-ui resource

		public $jqui_path 	;		//path to jquery-ui resource

		public $fontawesome_path ;	//path to font-awesome resource

		public $bootstrap_path 	; 	//path to bootstrap  resource

		public $highcharts_path ; 	//path to highcharts  resource

		public $fullcalendar_path ; //path to fullcalendar  resource

		//public $fullcalendar_path ; //path to fullcalendar  resource





		public function __construct()
		{
			parent::__construct() ;

			$this->jquery_path 			= base_url()."library/js/" ;

			$this->jqui_path 			= base_url()."library/jquery-ui/" ;

			$this->fontawesome_path 	= base_url()."library/font-awesome/" ;

			$this->bootstrap_path 		= base_url()."library/bootstrap/" ;

			$this->highcharts_path 		= base_url()."library/highcharts/" ;

			$this->fullcalendar_path 	= base_url()."library/fullcalendar/" ;

			$this->template_path 		= base_url()."library/templates/" ;
		}




		public function admin($data)
		{
			$data['jquery_path'] 		= $this->jquery_path;
			$data['bootstrap_path'] 	= $this->bootstrap_path;
			$data['fontawesome_path'] 	= $this->fontawesome_path;
			$data['s_username']			= $this->session->has_userdata('username') ? $this->session->username : NULL ; 

		 	$this->load->view('admin', $data);
		}



		 public function plain($data)
		 {
		 	$data['jquery_path'] 		= $this->jquery_path;
			$data['bootstrap_path'] 	= $this->bootstrap_path;
			$data['fontawesome_path'] 	= $this->fontawesome_path;
			
		 	$data['s_username'] = $this->session->has_userdata('username') ? $this->session->username : NULL ; 

		 	$this->load->view('plain', $data);
		 }
		 
		  


		/**
		* Controls diplay of system feeback using bootstrap's JS alert support
		* @param message {DataType: varchar, required: true, representation : message to be displayed to the user } 
		* @param type {DataType: varchar, required: false, representation : the message status } 
		* #param type could be of the following values;
		* 0 - Error (default)
		* 1 - Warning
		* 2 - Information 
		* 3 - Success 
		* 
		* Each of this message type are repersented with a different color code and icon
		*/
		public function alerts($message, $code = null ){


			switch ($code) {

				case 0:

					$class = 'alert-danger' ;
					$icon = 'fa-times' ;
					$color = 'red' ;

				break;

				case 1:

					$class = 'alert-warning' ;
					$icon = 'fa-times' ;
					$color = 'red' ;

				break;

				case 2:

					$class = 'alert-info' ;
					$icon = 'fa-info' ;
					$color = 'red' ;

				break;

				case 3:

					$class = 'alert-success' ;
					$icon  = 'fa-check' ;
					$color = 'green' ;

				break;
				
				default:

					$class = 'alert-success' ;
					$icon = 'fa-times' ;
					$color = 'red' ;
					
				break;
			}

			
			$out = "<div class='alert alert-block $class' style='margin-bottom: 20px'>
                  <button type='button' class='close' data-dismiss='alert'>
                    <i class='ace-icon fa fa-times'></i>
                  </button>

                  <i class='ace-icon fa $icon $color'></i>
                  ".$message."
                </div>" ;

            return $out ;
		}




		 



		






				
	} //end class templates

?>

 