(function(){
	

	var app = angular.module('serviceApp', []) ;

	app.controller('createServiceController', ["$scope", "serviceService", "$routeParams", 'ngDialog',  function($scope, ss, $rs, d){

		$scope.service = {} ;

		$scope.service_id = $rs.service_id ; //service id for the service intended to be updated

		$scope.action = "Create";


		//if there's a third parameter in the url, then operation should be an update
		//NB: The create and update operations share the same view and processing controller

		if($scope.service_id != null ){

			$scope.action = "Update"; 

			//populate information for current service.
			ss.serviceInfo($rs).then(function(response){
				
				$scope.service = response.data ;
			})
		}
		

		//creates or updates a service component/category
		//an integer passed to the url as a parameter, determines which operation
		//if parameter exists - its an update else - it a create operation
		$scope.create = function(){

			ss.createService($scope.service).then(function(response){
				
				//clear fields on success
				if(response.data.status == 'success'){ 

					$scope.service = {} ;
					message = "Service Component created succesfully" ;
					icon    = "fa-check" ;

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.openConfirm({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
			}, 
			function(){
            		d.openConfirm({template : "<i class='fa fa-exclamation-triangle '></i>  Error occured while trying to delete this service", plain: 'true' }) ;
            })
		}

	}])





	app.controller('manageServiceController', ["$scope", "serviceService", "ngDialog", function($scope, ss, d){

		$scope.services = [] ;

		ss.getServices().then(function(response){

			$scope.services = response.data ;

		})


		$scope.delete = function(service){
			
			var service_obj = {'service_id' : service.id };
			var index = $scope.services.indexOf(service);
  			

			//open  delete confirmation dialog
			d.open({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete this service Component ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	ss.deleteService(service_obj).then(function(response){

            		//clear fields on success
				if(response.data.status == 'success'){ 

					message = "This service has been deleted" ;
					icon    = "fa-check" ;
					$scope.services.splice(index, 1); 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.openConfirm({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i>  Error occured while trying to delete this service", plain: 'true' }) ;
            	})	
			})
       	}

	
	}])



	// app.controller('servicesReportController', ["$scope", "$routeParams", "servicesService", function($scope, $rs, ds){

	// 	$scope.services_id = $rs.services_id ;

	// 	$scope.myDataSource = {} ;

	// 	$scope.data = [] ;

	// 	$scope.servicesInfo = {} ;


	// 	//populate information for current distrcit.
	// 	ds.servicesInfo($rs).then(function(response){
	// 		$scope.servicesInfo = response ;
	// 	})



	// 	ds.servicesReport($rs).then(function(response){

	// 		$scope.myDataSource = {

	// 			chart : { 
	// 				"caption ": "services Information", 
	// 				"subCaption" 	: "General", 
	// 				"theme" 		: "ocean", 
	// 				"bgColor"	: "#2c3654",
	// 				"bgAlpha"   : "100",
	// 				//"xAxisName"	: "Flavor",
	//         		//"yAxisName"	: "Amount (In USD)",
	//         		//"bgImage"   : "http://upload.wikimedia.org/wikipedia/commons/7/79/Misc_fruit.jpg",
 //        			//"bgImageAlpha": "25",
 //        			//"bgAlpha"   : "50", //sets the transparency of the background
 //        			"canvasBgColor" : "#2c3654", //sets the fill color
 //        			"canvasBgAlpha": "100",

 //        			//font properties
 //        			//"baseFont": "Verdana",
	// 		        //"baseFontSize": "11",
	// 		        "baseFontColor": "#fff",

 //        			//Border Properties

	// 	            "showBorder": "1",
	// 	            "borderColor": "#2c3654",
	// 	            "borderThickness": "4",
	// 	            //"borderAlpha": "100", transparecy of the border
	//         	} ,
	// 			data : response 
	// 		}
	// 	})

	// }])



	app.factory('serviceService', ["$http", function($http ){

		
			var serviceComponents = {} ;

			serviceComponents.getServices = function(){

				return $http({method: 'GET', url : 'services/getServices' }) ;
			};

			serviceComponents.createService = function(serviceObject){

				return $http({method: 'GET', url : 'services/newService', params : serviceObject }) ;
			} ;


			serviceComponents.serviceInfo = function(serviceObj){

				return $http({method: 'GET', url : 'services/serviceInfo', params : serviceObj }) ;
			} ;


			serviceComponents.deleteService = function(serviceObj){

				return $http({method: 'GET', url : 'services/drop', params : serviceObj }) ;
			} ;


		return serviceComponents ;
	}])


	
})()