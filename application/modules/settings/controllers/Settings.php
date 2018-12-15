<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Settings extends MX_Controller {




		public function __construct()
		{
			//sparent::__construct() ;
			$this->load->model('settings/mdl_settings') ;
		}



		public function test(){

			$config_data = array('time_zone' => "West African Time UTC +1:00", 'org_name' => 'HICC');
			echo $this->mdl_settings->update_config($config_data) ;
		}

		
	}
?>

 