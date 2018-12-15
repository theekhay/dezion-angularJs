(function(){
	

	var app = angular.module('communityApp', []) ;

	app.controller('createCommunityController', ["$scope", "communityService", "ngDialog", "$routeParams", function($scope, cs, d, $rs){

		$scope.community = {} ;
		$scope.action  = "Create";


		$scope.community_id = $rs.community_id ; 


		if($scope.community_id != null ){

			$scope.action = "Update";

			//populate information for current community.
			cs.communityInfo($rs).then(function(response){

				$scope.community = response.data ;
			})
		}

		//controls the creation of a new community
		$scope.create = function(){

			cs.createCommunity($scope.community).then(function(response){

				if(response.data.status == 'success'){ 

					$scope.community = {} ;
					message = "Community created successfully";
					icon = "fa-check"; 

				}else{

					message = response.data.message;
					icon    = "fa-exclamation-triangle";
				} 


				d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
				
			},function(){

				d.open({template : "<i class='fa fa-exclamation-triangle'></i> An error occured while performing this operation.", plain: 'true' }) ;
			})
		}
	}])



	app.controller('manageCommunityController', ["$scope", "communityService", "$routeParams", "districtService", "ngDialog", function($scope, cs, $rs, ds ,d){

		$scope.district_id = $rs.district_id ;

		$scope.districtInfo = {} ;

		$scope.communities = [] ;

		var $q_obj = {'district_id' : $scope.district_id } ;



		cs.getcommunities($q_obj).then(function(response){

			$scope.communities = response.data
		})
		

		
		ds.districtInfo($q_obj).then(function(response){

			$scope.districtInfo = response.data  ;
		})
		


		$scope.delete = function(community){
			
			var community_obj = {'community_id' : community.id };
			var index = $scope.communities.indexOf(community);
  			

			//open  delete confirmation dialog
			d.open({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete this Community ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	cs.deleteCommunity(community_obj).then(function(response){

            		//clear fields on success
				if(response.data.status == 'success'){ 

					message = "Community has been deleted" ;
					icon    = "fa-check" ;
					$scope.communities.splice(index, 1); 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i>  Error occured while trying to delete this Community", plain: 'true' }) ;
            	})	
			})
       	}


		$scope.test = function(){
			alert("test") ;
		}
		
	}])




	app.factory('communityService', ["$http", "$q", function($http, $q){

		var community = {} ;

			community.getcommunities = function(districtIdObj){

				return $http({method: 'GET', url : 'communities/getcommunities', params : districtIdObj }) ;
			} ;

			community.createCommunity = function(communityObject){

				return $http({method: 'GET', url : 'communities/newCommunity', params : communityObject }) ;	
			} ;

			community.communityInfo = function(communityObj){

				return $http({method: 'GET', url : 'communities/communityInfo', params : communityObj }) ;
			} ;


			community.deleteCommunity = function(communityObj){

				return $http({method: 'GET', url : 'communities/drop', params : communityObj }) ;
				
			} ;

		return community ;
	}])


	
})()