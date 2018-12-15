(function () {
	
	var $app = angular.module('firsttimersApp', []);


	$app.controller('firsttimerRegisterationController', ['$scope', 'firsttimersService', '$routeParams', 'ngDialog', function ($scope, fs, $rs, d ){

		$scope.firsttimer  = {}; 

		$scope.firsttimer_id = $rs.firsttimer_id ; //first timer id for the first timer you want to update

		$scope.action ="Register" ;


		if($scope.firsttimer_id != null ){

			$scope.action = "update" ;

			fs.firsttimerInfo($rs).then(function(response){
				
				$scope.firsttimer = response.data ;
			})
		}
		


		$scope.register = function(){

			fs.registerFirsttimer($scope.firsttimer).then(function(response){

				//set feedback message and font icon based on message status.
				if(response.data.status == 'success'){

					$scope.firsttimer = {} ;
					$message = "Firsttimer added succesfully"; 
					$font_icon = "fa fa-check";

				}else{

					$message   = response.data.message ;
					$font_icon = "fa fa-exclamation-triangle";
				} 

				d.open({template: "<div class='ngdialog-message'><i class='fa "+ $font_icon +"'></i> "+ $message +" </div>", plain: 'true', className: 'ngdialog-theme-default' });

			})
		}	
			
	}])


	$app.controller('rhemaController', ['$scope', 'firsttimersService', 'ngDialog', '$rootScope', "serviceService", function($scope, fs, d, $rs, ss ){

		$scope.firsttimers  = [] ;

		$scope.selected = {} ;

		$scope.services = [] ;

		$scope.data = {} ;

		//$scope.currentMonth 


		//$scope.testi = {} ;

		var curDate = moment()  ;

		$scope.currentMonth = curDate.format('M') ;  //current month

		$scope.currentYear =  curDate.format('YYYY'); //current year

		//$scope.currentMonthName = curDate.format('M') ;  //current month name


		$scope.populate = function() {

			var query_obj = {'month' : $scope.currentMonth, 'year' : $scope.currentYear } ;

			fs.getFirsttimers(query_obj).then(function(response){

				$scope.firsttimers =  response.data ;

			}) 
		}



		$scope.process = function(m){

			$scope.selected = m ;
			$scope.testi = m ;
			

			d.open({template: "library/demo/partials/rhemaTmpl.html", className: 'ngdialog-theme-default', 
					cache : false, width: '40%', height: 400 });
		}


		//delete a first timer
		$scope.delete = function(ft){

			var $ft_obj = {'firsttimer_id' : ft.id };
			var index = $scope.firsttimers.indexOf(ft);
  			

			//open  delete confirmation dialog
			d.openConfirm({template: "<h4 style='color: #9e2852;'>Confirm Delete Action</h4><p>Are you sure you want to delete this first timer ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default', closeByDocument : false 
            }).then(function(){

            	fs.deleteFirsttimer($ft_obj).then(function(response){

            		if(response.data.status == 'success'){ 

						message = "Cell has been deleted" ;
						icon    = "fa-check" ;
						$scope.firsttimers.splice(index, 1); 

					}else{

						message = response.data.message ;
						icon    = "fa-exclamation-triangle";
					}

            		//display feedback based on response from the server
        			d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;        	
            	}, 
            	function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i>  Error occured while trying to delete this FIrst timer", plain: 'true' }) ;
            	})
            }, function(){
            	//do nothing
            })
		}


		$scope.test = function(uid) {

			var obj = {'firsttimer_id': uid };
			fs.firsttimerInfo(obj).then(function(response){
				$rs.testi = response.data ;

				if($rs.testi.service_id !== null){

					$service_obj = {'service_id' : $rs.testi.service_id }
					ss.serviceInfo($service_obj).then(function(response){

						$rs.testi.service_id = response.data.name ;
					})
				}
			});

			d.openConfirm({template: "library/demo/partials/rhemaTmpl.html", className: 'ngdialog-theme-default', width: 700, closeByDocument : false, className: 'ngdialog-theme-default', cache: false 
			}).then(function(){

				//var rhema_obj = angular.toJson($rs.testi.uw);
				var rhema_obj = {'rhema_data' : $rs.testi.uw, 'interests' : $rs.testi.interests, 'id' : $rs.testi.id }
				fs.rhemaProcessor(rhema_obj).then(function(response){
					d.open({template: "Successful", plain:true })
				}, function(){
					d.open({template: "Error processing this request", plain:true })
				}) 
			}, function(){

				//do nothing
			})
		}
		
		
		/*
		* This is how to create create a watch on more than one variable
		* watches for changes on the month and year model and updates the view.
		*
		*/		
		$scope.$watchCollection('[currentMonth, currentYear]', function(){

			$scope.populate() ;
		})
			
	}])



	$app.controller('weekFirstTimers', ['$scope', 'firsttimersService', function($scope, fs ){

		$scope.firsttimers = [] ;

		$scope.list = {} ;

		$scope.limit = 3 ; 

		$scope.begin = 0 ;

		$scope.size = $scope.firsttimers.length ;

		$scope.tmp = {}

		fs.weekFirstTimers().then(function(response){

			$scope.firsttimers = response.data ;
			$scope.tmp = response.data ;
		})


		$scope.slider = function(){

			//if($scope.length > $scope.begin >= $scope.firsttimers.length )

			$scope.begin = ( $scope.begin >= $scope.firsttimers.length ) ? 0 : $scope.begin + 3 ;

			//console.log($scope.begin ) ; 
			//console.log($scope.firsttimers.length ) ; 
			
		}	

		setInterval(function(){

			$scope.slider() ;

		}, 800000) ;

			
	}])



	$app.controller('firsttimersReportController', ["$scope", "firsttimersService", function($scope, fs){

		$scope.myDataSource = {} ;

		$scope.assimilation_stats = {} ;

		$scope.data = [] ;

		//Attributes describe chart properties

		$scope.categories = [] ;

		$scope.dataset = {} ;

		$scope.attrs = {} ;




		var curDate = moment()  ;

		$scope.currentQuarter = curDate.quarter() ; //gets the quarter,defaults to current quarter.

		//selected quarter
		$scope.selectedQuarter =  $scope.currentQuarter ; //binds to the current quarter selection ;

		//first date of the current quarter
		$scope.quarterStart    = moment().quarter( $scope.selectedQuarter ).startOf('quarter').format('YYYY-MM-DD');

		//last date of the current quarter
		$scope.quarterEnd      = moment().quarter( $scope.selectedQuarter ).endOf('quarter').format('YYYY-MM-DD');

		$scope.quarterName = 'Full Year';

		$scope.currentView = 'g' //g for graphical, t for tabular.

		$scope.customSelection = false;



		$scope.toggleCustomSelection = function(){

			$scope.customSelection = ($scope.customSelection == false) ? true : false ;
		}


		/**
		* Updates the current quarter and duration based on user selection from the view 
		*/
		$scope.updatePeriod = function($newDuration){

			switch($newDuration) {

			    case "1":
			       $scope.selectedQuarter = 1
			       $scope.quarterName = "First Quarter";
			        break;

			    case "2":
			        $scope.selectedQuarter = 2
			       	$scope.quarterName = "Second Quarter";
			        break;

			    case "3":
			        $scope.selectedQuarter = 3
			       	$scope.quarterName = "Third Quarter";
			        break;

			    case "4":
			        $scope.selectedQuarter = 4
			       	$scope.quarterName = "Fourth Quarter";
			        break;

			    case "current":
			        $scope.selectedQuarter = $scope.currentQuarter;
			       	$scope.quarterName = "This Quarter";
			        break;

			    case "previous":
			        $scope.selectedQuarter = ($scope.currentQuarter != 1 ) ? $scope.currentQuarter - 1 : 4  ;
			       	$scope.quarterName = "Previous Quarter";
			        break; 

			    case "full":
			        $scope.selectedQuarter = 0 ;
			       	$scope.quarterName = "Full year";
			        break;            

			    default:
        			$scope.selectedQuarter = $scope.currentQuarter;
			       	$scope.quarterName = "Full year";
			}


			$scope.monthlyCount() ;
		}


		/**
		* This simply allows the user to switch between graphical and tabular view of reports.
		* g = graphcal
		* t = tabular
		* The $scope.curretView binds to the view to display either as a graph or as a table
		*/
		$scope.switchView = function(){

			$scope.currrentView  = ( $scope.currrentView == 'g' ) ? 't' : 'g' ;
		}



		$scope.monthlyCount = function(){

			fs.categories($scope.selectedQuarter).then(function(response){

				$scope.categories = response.data ;
				//console.log(response) ;
			})

			fs.FirsttimerMonthlyCount($scope.selectedQuarter).then(function(response){

				$scope.dataset 		= response.data  ;
				$scope.attrs 		=  { 

                    "caption"      : "Monthly First Timers count", 
                    "subCaption"    : "General", 
                    "theme"         : "ocean", 
                    "bgColor"       : "#2c3654",
                    "bgAlpha"       : "100",
                    "xAxisName" 	: "Months",
                    "yAxisName" 	: "Number of firsttimers",
                    "canvasBgColor" : "#2c3654", //sets the fill color
                    "canvasBgAlpha"	: "70", //sets the opacity of the color fill above

                    //font properties
                    "baseFont": "sans-serif",
                    //"baseFontSize": "11",
                    "baseFontColor": "#fff",
                    "showBorder": "1",
                    "borderColor": "#2c3654",
                    "borderThickness": "4",
                    //"borderAlpha": "100", transparecy of the border
                }
			})
		}

		$scope.monthlyCount();

		$scope.assimlated = [] ;

	}])



	/**
	* directive to handle first timers reports
	* Not working yet.fix it  
	* 
	*/
	$app.directive('ftReport', [ 'firsttimersService', function(fs){

		return{

			restrict : 'E',
			require : 'ngModel',
			templateUrl : "library/demo/partials/ft_report.html",
			replace : true,
			controller : 'firsttimersReportController',
			scope : {

				type :"=",  
	            width : "=",
	            height : "=",
	            dataFormat : "=", 
	            chart : "=",
	            categories : "=",
	            dataset : "=" 
			} 
		}
	}])



	


	/**
	* Service module.
	*/
	$app.factory('firsttimersService', ["$http", "$q", function($http, $q){

		
		var first_timer_service  = {} ;

		first_timer_service.registerFirsttimer = function(firsttimerObject){

			return $http({method: 'GET', url : 'first_timers/newFirstTimer', params : firsttimerObject }) ;
		} ;


		first_timer_service.getFirsttimers = function(query_obj){

			return $http({method: 'GET', url : 'first_timers/get_firsttimers', params : query_obj }) ;
		} ;	

		first_timer_service.getAll = function(){

			return $http({method: 'GET', url : 'first_timers/get_all' }) ;
 
		} ;

		//Gets information about a first timer, given the first timer id 
		first_timer_service.firsttimerInfo = function(firsttimer_obj){

			return $http({method: 'GET', url : 'first_timers/firsttimerInfo', params : firsttimer_obj }) ;
		} ;

		//delete a first timer - typically updates the delete field to true(1)
		first_timer_service.deleteFirsttimer = function(firsttimer_obj){

			return $http({method: 'GET', url : 'first_timers/drop', params : firsttimer_obj }) ;
		} ;


		// First timers Report Services Starts here 

		first_timer_service.FirsttimerMonthlyCount = function(quarter){

			return $http({method: 'GET', url : 'first_timers/monthlyCount/' + quarter  }) ;

		} ;


		first_timer_service.assimilation_report = function(quarter){

			return $http({method: 'GET', url : 'first_timers/assimilation_report/'+ quarter }) ;

		} ;


		first_timer_service.categories = function(quarter){

			return $http({method: 'GET', url : 'first_timers/getCat/'+ quarter }) ; 
		} ;


		first_timer_service.rhemaProcessor = function(rhema_obj){

			return $http({method: 'GET', url : 'first_timers/rhema_update', params : rhema_obj }) ;
		} ;


		//gets first timers in the week passed in as a parmeter, default is the current week
		first_timer_service.weekFirstTimers = function(){

			return $http({method: 'GET', url : 'first_timers/weekFirstTimers'}) ;
		} ;


		//gets first timers that are yet to become secondtimers or join any group or cell
		first_timer_service.justFirstTimers = function(){

			return $http({method: 'GET', url : 'first_timers/justFirstTimers'}) ;
		} ;
			  
		
		return first_timer_service ;
	}])
	
})()