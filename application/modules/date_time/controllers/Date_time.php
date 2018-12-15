<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Date_time extends MX_Controller {

		public $format ;

		private $time_zone ;


		public function __construct(String $date = null, String $format = null)
		{
			parent::__construct() ;
			$this->load->model('settings/mdl_settings') ;
			$this->time_zone = $this->mdl_settings->get_config('time_zone') ;
		}


		public function current_time_zone(){

			return $this->time_zone ;
		}


		/**
		* creates a new date object 
		* if a date is not provided, it uses the current date.
		* @param date {DataType: varchar, required: false, representation : valid date } 
		* @return object
		*/
		public function d_obj( $date = NULL ){

			$dt_obj = (isset($date) ) ? new DateTime( $date, new DateTimeZone($this->time_zone) ) : new DateTime() ;
			return (null !== $this->time_zone) ? $dt_obj->setTimezone(new DateTimeZone( $this->time_zone ) ) : $dt_obj  ;
		}



		/**
		* Returns the current date time values 
		* if a format is not provided, it returns in the format of YY-MM-DD HH:MM
		* @param format {DataType: varchar, required: false, representation : valid php date-time format e.g Y-M-d, m-d-y etc. }
		* Format accepts any of the native php date time formats. 
		* @return String
		*/
		public function now($format = 'Y-m-d H:i' )
		{
			$day = $this->d_obj() ;  
			return  $day->format($format) ;			
		}

	
		/**
		* Returns the current day in a date
		* if a date is not provided, it uses the current time.
		* @param date {DataType: varchar, required: false, representation : valid date } 
		* @return Int
		*/
		public function day($date = NULL){

			$day = $this->d_obj($date) ; 
			return $day->format('d');			
		}




		/**
		* Returns the current time in a date
		* if a time stamp is not provided, it returns the current time in HH:MM format.
		* @param date {DataType: varchar, required: false, representation : valid time stamp } 
		* @return String
		*/
		public function time($date = NULL){
			
			$time =  $this->d_obj($date) ; 
			return $time->format("H:i");			
		}

		

		/**
		* Returns the numeric representation of a week from a given date
		* i.e the week number between 1 & 52 a date falls into  
		* if a date is not provided, it returns the current week.
		* @param date { DataType: varchar, required: false, representation : valid date } 
		* @return type : int
		*/

		public function week($date = null){

			$week = $this->d_obj($date) ; 
			return $week->format("W");	
		}
		



		/**
		* Returns the numeric representation of the month from a given date 
		* e.g january - 01, february - 02, march - 03 etc.
		* if a date is not provided, it returns the current month.
		* @param date {DataType: varchar, required: false, representation : valid date } 
		* return type : int
		*/
		public function month($date = NULL){

			$month = $this->d_obj($date) ;
			return $month->format("m");
		}




		/**
		* Returns the abbreviated representation of the month from a given date 
		* e.g Jan, Feb, Mar, APr etc.
		* if a date is not provided, it returns the current month.
		* @param date {DataType: varchar, required: false, representation : valid date } 
		* return type : String
		*/
		public function month_abbr($date = NULL){
			
			$month = $this->d_obj($date) ;
			return $month->format("M");
			
		}




		/**
		* Returns the full representation of the month from a given date 
		* e.g January, February, March, APril, May etc.
		* if a date is not provided, it returns the current month.
		* @param date { DataType: varchar, required: false, representation : valid date } 
		* return type : String
		*/
		public function month_full($date = NULL)
		{
			$month = $this->d_obj($date) ; 
			return $month->format("F");
			
		}





		/**
		* Returns the full representation of the month from a given number 
		* e.g January, February, March, April, May etc.
		* The number provided would usually be the numeric representation of the month
		* i.e 1 for january , 12 for december etc.
		* @param month_int_rep { DataType: varchar, required: false, representation : Integer representaion of the month }
		* @param month_format { DataType: char, required: false, representation : Format you want the month represented }
		* Default @param month_format is 'F' ;  other valid format are;
		* M - for a short form of the month e.g Jan, Mar etc
		* m - for a numeric representation of the month. 
		* return type : String
		*/
		public function month_with_number($month_int_rep, $month_format = 'F')
		{
			if($month_int_rep < 1 || $month_int_rep > 12 )
				return NULL ;

			$month = $this->d_obj("2017-$month_int_rep-01") ; 
			return $month->format($month_format) ;
		}





		/**
		* Returns a 2-digit representation of the year from a given date
		* if a date is not provided, it returns a 2-digit numeric representation of the current year.
		* @param date { DataType: varchar, required: false, representation : valid date } 
		* return type : int ;
		*/
		public function year($date = NULL)
		{
			$year = $this->d_obj($date) ; 
			return $year->format("y");
		}




		/**
		* Returns a 4-digit representation of the year from a given date.
		* If a date is not provided, it returns a 4-digit numeric representation of the current year.
		* @param date { DataType: varchar, required: false, representation : valid date } 
		* return type : int ;
		*/
		public function year_full($date = NULL)
		{
			$year = $this->d_obj($date) ;  
			return $year->format("Y");
			
		}




		/**
		* Returns a 4-digit representation of the previous year. 
		* return type : int ;
		*/
		public function last_year_full(){

			return $this->year_full() - 1;	
		}




		/**
		* Returns a 2-digit representation of the previous year. 
		* return type : int ;
		*/
		public function last_year_abbr()
		{
			return $this->year() - 1;
			
		}



		/**
		* Returns the week number of the previous week from a given date.
		* If no date is provided, it uses the current date. 
		* @param date { DataType: varchar, required: false, representation : valid date }
		* return type : int ;
		*/
		public function last_week($date = null)
		{				
			$l_wk = isset($date) ? strtotime("-1 week +1 day", strtotime($date)) : strtotime("-1 week +1 day", strtotime( $this->now("Y-m-d"))) ;
			return $this->week(unix_to_human($l_wk ) ) ;
		}




		/**
		* Returns the numeric representation of the  month. 
		* return type : int ;
		*/
		public function last_month()
		{			
			$this_month  = $this->month();
			$last_month = ($this_month == 01 || $this_month == 1) ? 12 : $this_month - 1 ;
			return str_pad($last_month, 2, 0, STR_PAD_LEFT);						 		
		}



		/**
		* Formats a Date
		* Returns the numeric representation of the  month.
		* @param date { DataType: varchar, required: true, representation : valid date }
		* @param format { DataType: varchar, required: true, representation : valid php date format } 
		* return type : valid date string ;
		*/
		public function format($date, $format)
		{

			$date = str_replace( ['.'], '-', $date) ;
			$dt = $this->d_obj($date) ; 
			return $dt->format($format);
		}





		/**
		* returns an associative array of months and their numeric value between 1 & 12.
		* return type : Array ;
		*/
		public function month_array()
		{
			$months = array(
							array('name' => 'January',  'value' => '01', 'abbr' => 'jan' ),
							array('name' => 'February', 'value' => '02', 'abbr' => 'feb' ),
							array('name' => 'March', 	'value' => '03', 'abbr' => 'mar' ),
							array('name' => 'April', 	'value' => '04', 'abbr' => 'apr' ),
							array('name' => 'May', 		'value' => '05', 'abbr' => 'may' ),
							array('name' => 'June', 	'value' => '06', 'abbr' => 'jun' ),
							array('name' => 'July', 	'value' => '07', 'abbr' => 'jul' ),
							array('name' => 'August', 	'value' => '08', 'abbr' => 'aug' ),
							array('name' => 'September','value' => '09', 'abbr' => 'sep' ),
							array('name' => 'October',  'value' => '10', 'abbr' => 'oct' ),
							array('name' => 'November', 'value' => '11', 'abbr' => 'nov' ),
							array('name' => 'December', 'value' => '12', 'abbr' => 'dec' )
						);

			return json_encode($months);	
		}



		/**
		* returns an associative array of months and their numeric value between 1 & 12.
		* return type : Array ;
		*/
		public function months($slice = null)
		{
			$months = array('01'=>'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June',
						'07' => 'July', '08'=> 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');

			return (isset($slice) ) ? json_encode( array_slice($months, 0, $slice, true) ) : json_encode($months) ;	
				
				
		}




		/**
		* returns a list of years from the current year backwards for a given period as defined in @param offset
		* @param offset {dataType: int, reuired: false, representation: how many years back from the current year should be returned}
		* return type : Array ;
		*/
		public function year_list($offset = 10, $year = null)
		{
			$year 	= isset($year) ? $year : $this->year_full();
			
			for($i= 0; $i <= $offset; $i++) 
          	{  	
               $yr = $year - $i ; 
               $year_list[] = $yr ;  
          	}

          	if($this->input->is_ajax_request()) { echo json_encode( $year_list ) ; }else{ return json_encode( $year_list) ; } ;	
		}



		public function is_valid($date)
		{
			$a = DateTime::createFromFormat('Y-m-d', $date);
			$b = DateTime::createFromFormat('d-m-Y', $date);
			$c = DateTime::createFromFormat('y-m-d', $date);
			$d = DateTime::createFromFormat('d-m-y', $date);

			$aa = $a && $a->format('Y-m-d') === $date ;
			$bb = $b && $b->format('d-m-Y') === $date ;
			$cc = $c && $c->format('y-m-d') === $date ;
			$dd = $d && $d->format('d-m-y') === $date ;

			return ($aa == true || $bb == true || $cc == true || $dd == true ) ? true : false ;
		}



		/**
		* Returns the number of days in a given month and year
		* if a year is not provided the current year is used
		* @param date { month: int, required: true, representation : month number }
		* @param format { year: int, required: false, representation : year } 
		* return type : int ;
		*/
		public function last_day($month, $year = null)
		{
			$year = isset($year) ? $year : $this->year_full() ;
			return  date('t', mktime(0, 0, 0, $month, 1, $year) );
		}




		public function is_future($date1)
		{
			$date = $this->format($date1, 'Y-m-d');
			$now  = $this->now('Y-m-d') ;
			
			return ($date > $now) ? true : false ;	
					
		}



		function getQuarterMonths($quarter){

    		switch($quarter) {

		        case 1:  $months = array('01'=>'January', '02'=>'February', '03'=>'March'); break ;
		        case 2:  $months = array('04'=>'April', '05'=>'May', '06'=>'June'); break ;
		        case 3:  $months = array('07'=>'July', '08'=>'August', '09'=>'September'); break ;
		        case 4:  $months = array('10'=>'October', '11'=>'November', '12'=>'December'); break ;
		        default : $months = $this->months();
    		}

    		return json_encode($months) ;
		}




		public function test()
		{
			//echo (! $this->is_valid("2017-07-06") ) ? "invalid date" : "valid date" ;
			//echo $this->date_time->months( ) ;

			$date = "2010-01-01" ;
			$dat = strtotime("$date -1 year");
			echo  date('Y-m-d', $dat);
		}
		
	
		
	}
?>

 