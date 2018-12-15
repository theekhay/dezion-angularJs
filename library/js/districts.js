(function(){
	

	var app = angular.module('districtApp', []) ;

	app.controller('createDistrictController', ["$scope", "districtService", "$routeParams", 'ngDialog',  function($scope, ds, $rs, d){

		$scope.district = {} ;

		$scope.district_id = $rs.district_id ; //district id for the district intended to be updated

		$scope.action = "Create";



		if($scope.district_id != null ){

			$scope.action = "Update"; 

			//populate information for current distrcit.
			ds.districtInfo($rs).then(function(response){
				
				$scope.district = response.data ;
			})
		}
		

		$scope.create = function(){

			ds.createDistrict($scope.district).then(function(response){
				
				//clear fields on success
				if(response.data.status == 'success'){ 

					$scope.district = {} ;
					message = "Success" ;
					icon    = "fa-check" ;

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
			})
		}

	}])



	app.controller('manageDistrictController', ["$scope", "districtService", "ngDialog", function($scope, ds, d){

		$scope.districts = [];


		//call the district service to get an array of services
		ds.getDistricts().then(function(response){

			$scope.districts = response.data ;

		})


		$scope.delete = function(district){
			
			var district_obj = {'district_id' : district.id };
			var index = $scope.districts.indexOf(district);
  			

			//open  delete confirmation dialog
			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete this district ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	ds.deleteDistrict(district_obj).then(function(response){

            		//clear fields on success
				if(response.data.status == 'success'){ 

					message = "District has been deleted" ;
					icon    = "fa-check" ;
					$scope.districts.splice(index, 1); 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i>  Error occured while trying to delete this District", plain: 'true' }) ;
            	})	
			})
       	}

	
	}])



	app.controller('districtReportController', ["$scope", "$routeParams", "districtService", function($scope, $rs, ds){

		$scope.district_id = $rs.district_id ;

		$scope.myDataSource = {} ;

		$scope.data = [] ;

		$scope.districtInfo = {} ;


		//populate information for current distrcit.
		ds.districtInfo($rs).then(function(response){
			$scope.districtInfo = response.data ;
		})



		ds.districtReport($rs).then(function(response){

			$scope.myDataSource = {

				chart : { 
					"caption ": "District Information", 
					"subCaption" 	: "General",
					"theme" 		: "ocean", 
					"bgColor"	: "#2c3654",
					"bgAlpha"   : "100",
					//"xAxisName"	: "Flavor",
	        		//"yAxisName"	: "Amount (In USD)",
	        		//"bgImage"   : "http://upload.wikimedia.org/wikipedia/commons/7/79/Misc_fruit.jpg",
        			//"bgImageAlpha": "25",
        			//"bgAlpha"   : "50", //sets the transparency of the background
        			"canvasBgColor" : "#2c3654", //sets the fill color
        			"canvasBgAlpha": "100",

        			//font properties
        			//"baseFont": "Verdana",
			        //"baseFontSize": "11",
			        "baseFontColor": "#fff",

        			//Border Properties

		            "showBorder": "1",
		            "borderColor": "#2c3654",
		            "borderThickness": "4",
		            //"borderAlpha": "100", transparecy of the border
	        	} ,
				data : response.data 
			}
		})

	}])



	app.factory('districtService', ["$http", "$q", function($http, $q){

		var district_service = {} ;

		district_service.getDistricts = function(){

			return	$http({method: 'GET', url : 'districts/getDistricts' }) ;
		} ;

		district_service.createDistrict = function($districtObject){

			return $http({method: 'GET', url : 'districts/newDistrict', params : $districtObject }) ;
		} ;


		district_service.districtInfo = function(districtObj){

			return $http({method: 'GET', url : 'districts/districtInfo', params : districtObj }) ;
		} ;


		district_service.districtReport = function(districtObj){

			return $http({method: 'GET', url : 'districts/districtOverviewReport', params : districtObj }) ;
			
		} ;

		district_service.deleteDistrict = function(districtObj){

			return $http({method: 'GET', url : 'districts/drop', params : districtObj }) ;

		} ;

		return district_service ;

	}])


	
})()