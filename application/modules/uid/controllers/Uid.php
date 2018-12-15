<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/*
	|--------------------------------------------------------------------------------------------------- 
	|	Uid
	|---------------------------------------------------------------------------------------------------
	* This class controls the generation of unique user identification number for the whole application
	* It controls the user ID for modules including :
	* 
	* First timer
	* Second timer
	* Pools
	* Members
	*
	* This module ensures a consistent unique identifier across modules that are listed above
	* A synchronized UID system.
	* This allows users to be tracable across multiple tables and allows portability of IDs across tables
	* i.e when a first timer becomes a second timer, his/her ID goes with him/her to that table.
	* User IDs would usually be between 12 characters long
	* And would be in the format XX/XXXX/XXXX .
	* The first part denotes the user category e.g first timer (FT), second timer (ST) etc.
	* And would be represented by a prefix
	*
	* FT - first timers
	* ST - Second Timers
	* PL - Pools
	* MB - Members
	*
	* The second part of the user ID represents a 4 digits MonthYear (MY) representation of the current date
	* eg 1016 for 10-2016. 
	*
	* The last part of the User ID represents an incrementsl 4 digit code starting from 0001 upwards.
	* 
	*
	* The Second and last part of the UID combined gives a unique identification to every member in the system.
	* The final Output of the UID would look like 
	* FT/1016/0130 OR ST/1116/0013 OR MB/0117/0009 
	*
	* IMPORTANT NOTE : if an import is done on any of the UID-generating modules, the max UID from the imported data 
	* should be set in the db to prevent UID generation conflicts/errors. 
	*/



	class Uid extends MX_Controller {

		public $prefix_list = array('FT', 'ft', 'ST', 'st', 'MB', 'mb' , 'PL', 'pl') ;


		/**
		* @var current_MY int 
		* Represents the second part of the UID 
		* Would usually be a 4-digit numeric code
		* e.g 1016
		*/
		public $current_MY 	;




		public function __construct()
		{
			parent::__construct() ;
			parent::loggedIn();
			$this->load->model('uid/mdl_uid');

			//initialize the default (MY) MonthYear (to be used when generating UIDs)
			$this->current_MY(); 

			//creates the current MY row if it doesn't exist in $this->table 
			$this->create_MY();
		}




		/**
		* generates a unique Id for a new user.
		* IDs are generated just once within the system for a user 
		* And are not assigned again even if the user gets deleted.
		* UIDs are also maintainable across multiple tables with only the UID prefix changing to reflect change in the user's 
		* current status. i.f from first timer to member -> FT to MB.
		* @param prefix {DataType: string, required: false, representation : valid system prefix. }
		*/

		public function generate_id($prefix = null)
		{
			$current_max = $this->mdl_uid->get_MY_max($this->current_MY);
			$new_max =  $current_max + 1;
			
			if ($this->mdl_uid->update_MY($this->current_MY, $new_max)){
				$new_max = str_pad($new_max, 4, 0, STR_PAD_LEFT);  
				return isset($prefix) ? $prefix ."/". $this->current_MY ."/". $new_max : $this->current_MY ."/". $new_max ;
			}
		}




		/**
		* Used by the constructor 
		* Initializes the current MY (MonthYear) to be used by the UID generator.
		* The MY is usually the numeric representaion of the month combined with a 2 digit representation of the year
		* i.e 1016 for (xx-10-2016), 0116 for (xx-01-2016), 1217 for (xx-12-2017).
		* The MY forms part of the User Identifier (UID)
		* return type : void ;
		*/
		public function current_MY()
		{

			$cMY = $this->date_time->month().$this->date_time->year();
			$this->current_MY = $cMY;
		}



		/*
		* Used by the constructor 
		* Ensures the Month-Year needed by the UID generator is always available.
		* It checks to see if the MY-row already exists, and creates it if it doesn't.
		* return type : void ; 
		*/
		public function create_MY()
		{
			if(! $this->mdl_uid->row_MY_exists($this->current_MY) ){

				$this->mdl_uid->create_MY_row($this->current_MY);
			}
		}




		/**
		* Removes the prefix from a UID i.e the part before the first '/'
		* @param $set {DataType: string, required: true, representation : a valid UID } 
		* and returns the rest of the UID
		* i.e FT/1016/0909 would become 1016/0909.
		* return type : String ;
		**/
		public function stripPrefix($uid)
		{
			$uid_length = strlen($uid);

			if( substr_count($uid, '/') != 2 )
				return NULL ;

			$pos = stripos($uid, '/');
			return substr($uid, $pos + 1);
		}




		/**
		* @param UID varchar 
		* returns the prefix from the provided UID
		* prefixes are short code that represent the users current membership status in the organization
		* FT - First timer
		* ST - Second timer
		* MB - Member
		* PL - Pool
		* return type : String ;
		**/
		public function getPrefix($uid)
		{
			if( substr_count($uid, '/') != 2)
				return NULL;

			$pos = stripos($uid, '/');
			$uid_array = str_split($uid);
			return substr($uid, 0, $pos);
			
		}



		/**
		* @param uid string - user identifier
		* @param new_prefix sting - valid UID prefix - List of valid prefixes are represented in the prefix_list attribute
		*
		* This function simply changes the prefix of a UID to another
		* useful when tracking a user through different databases.
		* eg FT/1212/2009 to ST/1212/2009 ---> the prefix here was changed from FT to ST to show a movement from first timer to second timer.
		* return type : String ;
		*/
		public function switch_prefix($uid , $new_prefix )
		{

			if( substr_count($uid, '/') < 2)
				return;

			if( ! in_array($new_prefix, $this->prefix_list) )
				return;

			$stripped_uid = $this->stripPrefix($uid) ;

			return $new_prefix."/".$stripped_uid ;

		}





		/**
		* Validates a UID 
		* @param $uid {DataType: String, required: true, representation : The UID to validate. }
		* return type : bool ;
		*/
		public function validate_uid($uid)
		{

			$uid_length = strlen($uid);
			$uid_array  = str_split($uid) ;
			$seprator_count  = substr_count($uid, '/') ;

			if($uid_length < 9 || $uid_length > 12)
				return false ;

			if($seprator_count < 1 || $seprator_count > 2 )
				return false ;

			if( $seprator_count == 1 && $uid_length != 9 )
				return false ;

			if( $seprator_count == 2 && $uid_length != 12)
				return false ;

			if($uid_array[0] == '/')
				return false ;

			return true ;
		}





		/**
		* Validates a prefix 
		* @param $uid {DataType: String, required: true, representation : The prefix to validate. }
		* return type : bool ;
		*/
		public function validate_prefix($uid)
		{
		
			$prefix = $this->getPrefix($uid) ;

			if(! empty($prefix) ){

				return (in_array($prefix, $this->prefix_list) ) ? true : false  ;
			}
			
			
			return false ;
			
		}




		public function test()
		{
			//echo $this->getPrefix('ST/1018/0909', 'ft') ;
			//echo $this->validate_uid('1018/0993')  ? 'true' : 'false' ;
			echo $this->validate_prefix('ST/1018/0993')  ;
		}
		
	}
?>

 