(function(){
	

	var app = angular.module('smallGroupApp', []) ;


	app.controller('createGroupController', ["$scope", "groupService", "ngDialog", function($scope, gs, d){

		$scope.group = {} ;
		$scope.action = "Create" ;

		
		//controls creation of a new small group.
		$scope.createGroup = function(){
	
			gs.createGroup($scope.group).then(function(response){

				if(response.data.status == 'success'){ 

					$scope.group = {} ;
					message = "Small Group created successfully";
					icon = "fa-check"; 

				}else{

					message = response.data.message;
					icon    = "fa-exclamation-triangle";
				} 

				d.openConfirm({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;

			},function(){

				d.openConfirm({template : "<i class='fa fa-exclamation-triangle'></i> An error occured while performing this operation.", plain: 'true' }) ;
			})
		}

	}])



	app.controller('managegroupController', ["$scope", "departmentService", "$routeParams", "groupService", "ngDialog", function($scope, ds, $rs, gs, d){

		$scope.department_id = $rs.department_id ; //department id from route 

		$scope.departmentInfo = {} ; //info of the department declared above

		$scope.groups = [] ; //All small groups in the department declared above

		var $q_obj = {'department_id' : $scope.department_id } ;


		//get all small groups in the given department
		gs.getGroups($q_obj).then(function(response){

			console.log(response.data) ;
			$scope.groups = response.data
		})
		

		//get the department info the current small group belongs to.
		ds.departmentInfo($q_obj).then(function(response){

			$scope.departmentInfo = response.data  ;
		})


		$scope.delete = function(group){
			
			var group_obj = {'small_group_id' : group.id };
			var index     = $scope.groups.indexOf(group);
  			

			//open  delete confirmation dialog
			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete this Group ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	gs.deleteGroup(group_obj).then(function(response){

            	//clear fields on success
				if(response.data.status == 'success'){ 

					message = "Group has been deleted" ;
					icon    = "fa-check" ;
					$scope.groups.splice(index, 1); 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i> Oops! An error occured while performing this operation.", plain: 'true' }) ;
            	})	
			},function(){

				//do nothing
			})
       	}

	}])



	app.controller('groupListController', ["$scope", "groupService", function($scope, gs){

		$scope.groups = {} ; //All groups 

		gs.getGroups().then(function(response){

			$scope.groups = response.data ;

			console.log($scope.groups.length) ;
		})
	}])


	//for the dashboard
	app.controller('groupSlideController', ["$scope", "groupService", "$timeout", function($scope, gs, $t){

		$scope.all = {} ; //All groups 

		$scope.current = {} ;

		$scope.currentIndex = 0 ;

		
		gs.getGroups().then(function(response){
			$scope.all = response.data ;
		})

		$scope.slide = function(){

			if($scope.all.length > 1 ){

				groupObj = {'small_group_id' : $scope.all[$scope.currentIndex].id } ;

				gs.groupInfo(groupObj).then(function(response){
					$scope.current = response.data ;
				}) ;

				$scope.currentIndex = ($scope.all.length - 1 == $scope.currentIndex  ) ? 0 : $scope.currentIndex + 1 ;
			}
		}

		setInterval(function(){
			$scope.slide() 
		}, 8000) ;


	}])




	app.factory('groupService', ["$http", "$q", function($http, $q){

		var group = {}

		group.getGroups  = function(departmentIdObj){

			return $http({method: 'GET', url : 'small_groups/getSmallGroups', params : departmentIdObj }) ;
		} ;

		group.createGroup  = function(groupObject){

			return $http({method: 'GET', url : 'small_groups/newSmallGroup', params : groupObject }) ;
		} ;

		group.groupInfo  = function(groupObject){

			return $http({method: 'GET', url : 'small_groups/smallGroupInfo', params : groupObject }) ;
		} ;

		group.deleteGroup  = function(groupObject){

			return $http({method: 'GET', url : 'small_groups/drop', params : groupObject }) ;
		} ;

		return group ;
	}])
	
})()