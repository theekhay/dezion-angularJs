(function(){
	
	var $app = angular.module('secondtimersApp', []) ;



	$app.controller('in_week', ['$scope', 'secondtimersService', function($scope, ss ){

		$scope.secondtimers = {} ;

		$scope.list = {} ;

		$scope.limit = 3 ; 

		$scope.begin = 0 ;

		$scope.size = $scope.secondtimers.length ;

		$scope.tmp = {}

		ss.in_week().then(function(response){

			$scope.secondtimers = response.data ;
			$scope.tmp = response.data ;
		})


		$scope.slider = function(){

			$scope.begin = ( $scope.begin >= $scope.secondtimers.length ) ? 0 : $scope.begin + 3 ; 
		}	

		setInterval(function(){

			$scope.slider() ;

		}, 8000) ;

			
	}])


	


	$app.controller('secondtimerRegisterationController', ['$scope', 'firsttimersService', 'filterFilter', 'secondtimersService', 'ngDialog', function($scope, fs, ff, ss, d ){

		$scope.secondtimer  = {} ;

		$scope.search = '' ;

		$scope.searchResult = [];

		$scope.isSelected = false ;

		$scope.currentName = "" ; 

		$scope.filterResult = false ; //this property controls if there was a result from the search


		//get firsttimers
		fs.justFirstTimers().then(function(response){

			$scope.firsttimers = response.data ;
		})



		$scope.$watch('search', function(){

			console.log($scope.filterResult) ;

			if($scope.search.length > 3){

				if($scope.currentName != $scope.search ) $scope.isSelected = false ;   

			}else{

				$scope.filterResult = false ;
				$scope.isSelected = false
			}	
		})


		$scope.searchTest = function(item){

			if($scope.search.length < 4) {

				$scope.filterResult = false ;
				return false ;
				
			}
			else{

				if(	item.firstname.toLowerCase().indexOf($scope.search.toLowerCase() ) != -1 ||
					item.surname.toLowerCase().indexOf($scope.search.toLowerCase() )  != -1 ){

					$scope.filterResult = true ;
					return true ;
					
				}
			}	

			$scope.filterResult = false ;
			return false ;
		}



		$scope.s = function(m){
			
			$query = {'firsttimer_id' : m.id }
			fs.firsttimerInfo($query).then(function(response){


				$scope.secondtimer = response.data ;
				$scope.secondtimer.service_date = null ;
			})

		}	


		/**
		* This fuction is called once a selection is made from the options of firstimers
		* sets the isSelected property to true - this helps the app track changes in selection
		* 
		*/
		$scope.select = function(m){

			name = m.surname + " " + m.firstname ;
		
			$scope.searchResult = [] ;
			$scope.selected = m ;
			$scope.search = name ;
			$scope.isSelected = true;
			$scope.currentName = name ;

			//you should set the currentindex here

			$scope.s(m) ;
		}

		

		/**
		* Regisers a second timer	 
		*/
		$scope.register = function(){

			var secondtimer_obj = {'secondtimer' : $scope.secondtimer } ;

			ss.register(secondtimer_obj).then(function(response){

			//set feedback message and font icon based on message status.
			if(response.data.status == 'success'){

				$scope.secondtimer = {} ;
				$message = "Second timer added succesfully"; 
				$font_icon = "fa fa-check";
				$scope.search = "";

			}else{

				$message   = response.data.message ;
				$font_icon = "fa fa-exclamation-triangle";
			} 

				d.open({template: "<div class='ngdialog-message'><i class='fa "+ $font_icon +"'></i> "+ $message +" </div>", plain: 'true', className: 'ngdialog-theme-default' });

			}, function(){
				d.open({template : 'error processing this request', plain:true}) ;
			})
		}	
			
	}])



	$app.controller('srhemaController', ['$scope', 'secondtimersService', "serviceService", "$rootScope", 'ngDialog', function($scope, ss, svs, $rs, d ){

		$scope.secondtimers  = [] ;

		var curDate = moment()  ;

		$scope.currentMonth = curDate.format('M') ;  //current month

		$scope.currentYear =  curDate.format('YYYY'); //current year

		$scope.selected = {} ;

		$scope.services = {} ;

		$scope.data = {} ;

		//$scope.currentMonth 




		//controls rhema center call update
		$scope.test = function(id) {

			var obj = {'secondtimer_id': id };

			ss.info(obj).then(function(response){
				$rs.testi = response.data;

				if($rs.testi.service_id !== null){

					$service_obj = {'service_id' : $rs.testi.service_id } //service object

					svs.serviceInfo($service_obj).then(function(response){

						console.log(response.data) ;
						$rs.testi.service_id = response.data.name ;
					})
				}
			});

			d.openConfirm({template: "library/demo/partials/rhemaTmpl2.html", className: 'ngdialog-theme-default', width: 700, closeByDocument : false, className: 'ngdialog-theme-default', cache: false 
			}).then(function(){

				//var rhema_obj = angular.toJson($rs.testi.uw);
				var rhema_obj = {'rhema_data' : $rs.testi.uw, 'interests' : $rs.testi.interests, 'id' : $rs.testi.id }
				
				ss.rhemaProcessor(rhema_obj).then(function(response){
					d.open({template: "Successful", plain:true })
				}, function(){
					d.open({template: "Error processing this request", plain:true })
				}) 
			}, function(){

				d.open({template: "Error processing this request", plain:true })
			})
		}




		$scope.process = function(m){

			$scope.selected = m ;
			$scope.testi = m ;
			
			d.open({template: "library/demo/partials/rhemaTmpl2.html", className: 'ngdialog-theme-default', 
					cache : false, width: '40%', height: 400 });
		}



		/*
		* This is how to watch on more than one variable
		* watches for changes on the month and year and updates the view.
		*
		*/		
		$scope.$watchCollection('[currentMonth, currentYear]', function(){

			$scope.populate() ;
		})


		

		$scope.populate = function(){

			var query_obj = {'month' : $scope.currentMonth, 'year' : $scope.currentYear } ;

			ss.getAll(query_obj).then(function(response){

				$scope.secondtimers =  response.data ;
			}) 

		}




		$scope.$watchCollection('[currentMonth, currentYear]', function(){

			$scope.populate() ;
		})



		//delete a Second timer
		$scope.delete = function(st){

			var $st_obj = {'secondtimer_id' : st.id };
			var index = $scope.secondtimers.indexOf(st);
  			


			//open  delete confirmation dialog
			d.openConfirm({template: "<h4 style='color: #9e2852;'>Confirm Delete Action</h4><p>Are you sure you want to delete this Second timer ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default', closeByDocument : false 
            }).then(function(){

            	ss.drop($st_obj).then(function(response){

            		if(response.data.status == 'success'){ 

						message = "Second timer deleted successfully";
						icon = "fa-check"; 
						$scope.secondtimers.splice(index, 1); 
						
					}else{

						message = response.data.message;
						icon    = "fa-exclamation-triangle";
					} 

					d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;  
					     	
            	}, function(){

            		d.openConfirm({template : "<i class='fa fa-exclamation-triangle'></i> An error occured while performing this operation.", plain: 'true' }) ;
            	})
            })
        } 
		
			
	}])


	/**
	* @directive
	* Controls the search for firsttimers.
	* move this to the firttimer module
	*/

	$app.directive('searchFirstTimer', ['filterFilter', 'memberServices', function(fs, ms){

		return{

			restrict : 'AE',
			require : 'ngModel',
			templateUrl : "library/demo/partials/searchFirstTimer.html",
			replace : true,
			controller : 'secondtimerRegisterationController' 
		}
	}])



	$app.factory('secondtimersService', ["$http", "$q", function($http, $q){

		var second_timer = {} ;

			second_timer.register = function(secondtimerObject){

				return $http({method: 'GET', url : 'second_timers/add', params : secondtimerObject }) ;

			} ;

			second_timer.getAll = function(query_obj){

				return $http({method: 'GET', url : 'second_timers/get_secondtimers', params : query_obj }) ;

			} ;

			second_timer.drop = function(secondtimer_obj){

				return $http({method: 'GET', url : 'second_timers/drop', params : secondtimer_obj }) ;

			} ;

			//gets the second timers in the curret week
			second_timer.in_week = function(){

				return $http({method: 'GET', url : 'second_timers/weekSecondTimers'}) ;

			};

			//Gets information about a second timer, given the second timer id 
			second_timer.info = function(secondtimer_obj){

				return $http({method: 'GET', url : 'second_timers/secondtimerInfo', params : secondtimer_obj }) ;
			} ;

			second_timer.rhemaProcessor = function(rhema_obj){

				return $http({method: 'GET', url : 'second_timers/rhema_update', params : rhema_obj }) ;
			} ;

			return second_timer ;
			 
	}])
	
})()