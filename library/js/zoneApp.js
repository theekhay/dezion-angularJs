(function(){
	

	var app = angular.module('zoneApp', []) ;

	app.controller('createZoneController', ["$scope", "zoneService", "ngDialog", function($scope, zs, d){

		$scope.zone = {} ;


		//controls creation of a new zone.
		$scope.create = function(){

			zs.createZone($scope.zone).then(function(response){

				if(response.data.status == 'success'){ 

					$scope.zone = {} ;
					message = "Zone created successfully";
					icon = "fa-check"; 
					
				}else{

					message = response.data.message;
					icon    = "fa-exclamation-triangle";
				} 

				d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
				
			}, function(err){
				d.openConfirm({template : "<i class='fa fa-exclamation-triangle'></i> An error occured while performing this operation.", plain: 'true' }) ;
			})
		}


	}])



	app.controller('manageZoneController', ["$scope", "zoneService", "$routeParams", "communityService", "ngDialog", function($scope, zs, $rs, cs, d){

		$scope.community_id = $rs.community_id ;

		$scope.communityInfo = {} ;

		$scope.zones = [] ;

		var $q_obj = {'community_id' : $scope.community_id } ;

		//get all zones in the given community
		zs.getZones($q_obj).then(function(response){

			$scope.zones = response.data
		})
		

		//get the community info the current zone belongs to.
		cs.communityInfo($q_obj).then(function(response){

			$scope.communityInfo = response.data  ;
		})


		$scope.delete = function(zone){
			
			var zone_obj = {'zone_id' : zone.id };
			var index = $scope.zones.indexOf(zone);
  			

			//open  delete confirmation dialog
			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete this Zone ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	zs.deleteZone(zone_obj).then(function(response){

            		//clear fields on success
				if(response.data.status == 'success'){ 

					message = "Zone has been deleted" ;
					icon    = "fa-check" ;
					$scope.zones.splice(index, 1); 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i>  Error occured while trying to delete this Zone", plain: 'true' }) ;
            	})	
			}, function(){
            		//do nothing
            	})
       	}

		
	}])




	app.factory('zoneService', ["$http", function($http ){

		var zone = {} ;

		zone.getZones = function(communityIdObj){

			return $http({method: 'GET', url : 'zones/getZones', params : communityIdObj }) ;
			
		} ;

		zone.createZone = function(zoneObject){

			return $http({method: 'GET', url : 'zones/newZone', params : zoneObject }) ;
			
		} ;

		zone.zoneInfo = function(zoneObj){

			return $http({method: 'GET', url : 'zones/zoneInfo', params : zoneObj }) ;
			
		} ;

		zone.deleteZone = function(zoneObj){

			return $http({method: 'GET', url : 'zones/drop', params : zoneObj }) ;
			
		}

		return zone ;
	}])


	
})()