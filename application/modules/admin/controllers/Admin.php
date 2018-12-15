<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends MX_Controller {


		public function __construct()
		{
			parent::__construct() ;
			
			$this->load->model('admin/mdl_admin');
			$this->load->library('bcrypt') ;
		}



		public function index()
		{
		
			
		}


		/**
		* Chang Admin Password
		*/
		public function changePassword()
		{
			parent::loggedIn();

			if(! empty( $this->input->get('passwords') ) ) {

				$passwords =  $this->input->get('passwords') ;

				$passwords = json_decode($passwords) ;

				$old_password = $passwords->oldPassword ;
				$new_password = $passwords->newPassword ;
				$confirm_password = $passwords->confirmPassword ;

				try{

					if(empty($old_password) || empty($new_password) || empty($confirm_password) ){

						throw new Exception("Error Processing Request", 1);
					}


					//chack that the old password is same as the one currently in the table
					if (! $this->bcrypt->check_password( $old_password, $this->mdl_admin->get_info($this->session->admin_id, 'password') ) ) {

						throw new Exception("Error: Incorrect value for current password!" );
					}

					//new password and confirm new password must be the same 
					if($new_password !== $confirm_password ){

						throw new Exception("Passwords do not match", 1);
					}

					//hash the password
					$hash = $this->bcrypt->hash_password($new_password) ;

					//update the password
					if(! $this->mdl_admin->update( $this->session->admin_id, ['password' => $hash] ) ){

						throw new Exception("Unable to update your password at this moment", 1);
					}

					$data['status'] = 'success' ;
									}
				catch(Exception $e){

					$data['status'] = 'error' ;
					$data['message'] = $e->getMessage() ;
				}

				echo json_encode($data) ;
			}
			else
			{
				$this->load->view('change_password') ;
			}	
		}



		public function profile()
		{
			parent::loggedIn();
			$this->load->view('profile_page') ;
		}



		/**
		* Returns information about an admin
		* @param admin_id {DataType: int, required: true, representation : admin id } 
		* return type - json object
		*/
		public function adminInfo($admin_identifier){

			parent::loggedIn();
			$info = $this->mdl_admin->get_info($admin_identifier) ;
			echo json_encode($info) ;
		}


		/**
		* returns all administrators
		* @param role_id 
		* If the role is is provided it returms all the administrators in that role.
		*/
		public function all_administrators($role_id = null)
		{
			echo json_encode( $this->mdl_admin->administrators( $role_id )->result() ) ;
		}



		public function org()
		{
			$this->load->view('church_settings') ;
		}




		public function register()
		{
			parent::loggedIn() ;

			if(null !== $this->input->get('admin') ) {

				$admin = json_decode( $this->input->get('admin') ) ;

               	try{

					if( empty($admin->username) || empty($admin->password)  || empty($admin->member_id) || empty($admin->role_id) ) {

						throw new Exception('Important Fields Missing');
					}

					// check for property duplicates

					$feedback = $this->mdl_admin->exists( ['member_id' => $admin->member_id, 'username' => $admin->username ] )  ;

					if( $feedback['status'] ){

						throw new Exception( $feedback['field'] .' already exists. Duplicates not allowed');
					}


					//make sure there can't be more than one administrator
					//make sure the figure passed into the all method as a paramter corresponds to the id for the administrative role.
					//administrtive role id is 4 at this moment

					$this->load->model('roles/mdl_roles') ;

					if( strtolower( $this->mdl_roles->get_info($admin->role_id, 'name') ) == 'administrator' && $this->mdl_admin->all(4)->num_rows() >= 1 ){

						throw new Exception("Warning: You can't have more than one administrator!!!");
					}

					$admin->date_created = $this->date_time->format(unix_to_human(now() ), 'Y-m-d' ) ;
					$admin->created_by   = $this->session->admin_id ;
					$admin->password     = $this->bcrypt->hash_password($admin->password) ;
					$admin->username     = trim($admin->username) ;

					unset($admin->name) ;

					//create admin
					if(! $this->mdl_admin->newAdmin($admin) ){

						throw new Exception("Error: unable to create admin profile at the moment!") ;
					}

					$data['status'] = "success" ;
			
				}	
	           	catch(Exception $e){
	           		
	           		$data['message'] = $e->getMessage() ;
	           		$data['status'] = "error" ;
	           	}

	           	echo json_encode($data) ;
         	}
         	else
         	{

         		$this->load->view('createAdministrator' ) ;
         	}      	
			
		}




		public function manageUsersView()
		{
			$this->load->view('manageAdmin') ;
		}



		public function settings()
		{
			$this->load->view('settings') ;
			
		}




		public function Upload_profile_pics(){

			$this->load->view('upload') ;
		}

	

	   public function do_upload()
       {
        	if(isset($_POST['submit'])) {

                $config['upload_path']          = './library/images/admin_profile_pics/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $config['max_filename']           = 30;
                       

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $message = array('error' => $this->upload->display_errors());                       
                       	$this->Upload_profile_pics($message['error']);
                }
                else
                {	
                	$pic_name = $this->upload->data('file_name');

                	if($this->mdl_admin->updateProfilePicture($pic_name) == true){
                		$message = array('upload_data' => $this->upload->data());
                    	$this->Upload_profile_pics('successful', 'report-success');                  

                	}else{
                		 $this->Upload_profile_pics('problem updating profile picture.', 'report-error');
                	}
        		}
        	}	
        	else
        	{
        		$this->Upload_profile_pics();
        	}       	
    	}





        public function auto_password()
        {
        	$character_array = array_merge(range('a', 'z'), range(0,9), range('A', 'Z'));
        	$length = 10;

        	$passwd = "";
        	for($i = 1; $i <=$length; $i++){
        		$passwd .= $character_array[rand(0, (count($character_array) - 1))];
        	}
        	echo $passwd;
        	
        }




		

		
		public function test()
		{
			var_dump( $this->mdl_admin->administrators()->result() );
		}











		
	}
?>

 