(function(){
	

	var app = angular.module('serviceRecordApp', []) ;

	app.controller('serviceRecordController', ["$scope", "serviceRecordService", 'ngDialog',  function($scope, ss, d){

		$scope.record = {} ;
		
		$scope.saveRecord = function(){

			var record_object = {'record' : $scope.record }

			ss.newRecord(record_object).then(function(response){
				
				if(response.data.status == 'success'){ 

					$scope.record = {} ;  //clear fields on success
					message = "Service Record created succesfully" ;
					icon    = "fa-check" ;

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle" ;
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
			}, 
			function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i>  Error occured while processing this request", plain: 'true' }) ;
            })
		}

	}])



	//controls report generation for service records
	app.controller('serviceReportController', ["$scope", "$http", function($scope, $http){

		$scope.duration //bind this to the date plugin

		$scope.report_type //this could be either attendance or finanace

		$scope.fetch = function(){



		}


	}])



	app.factory('serviceRecordService', ["$http", function($http ){

			var record = {} ;

			record.newRecord = function(recordObj){

				return $http({method: 'GET', url : 'service_records/record', params : recordObj }) ;
			} ;


			record.info = function(recordObj){

				return $http({method: 'GET', url : 'services/serviceInfo', params : recordObj }) ;
			} ;


			//delete a service record  -  admin rights only 
			record.info = function(recordObj){
				
				return $http({method: 'GET', url : 'services/drop', params : recordObj }) ;
			} ;


			//for reports 
			record.fetch = function(durationObject){
				
				return $http({method: 'GET', url : 'services/report', params : durationObject }) ;
			} ;


		return record ;
	}])


	
})()