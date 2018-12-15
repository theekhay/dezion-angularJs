(function(){
	

	var app = angular.module('roleApp', []) ;


	app.controller('createRoleController', ["$scope", "roleService", "$routeParams", "ngDialog", function($scope, rs, $rp, d){

		$scope.role = {} ;
		$scope.action = 'Create';
		$scope.role_id = $rp.role_id ;


		if($scope.role_id != null ){

			$scope.action = "Update";

			//populate information for current role.

			rs.info($rp).then(function(response){

				$scope.role = response.data ;
			})
		}

		//controls creation of a new Roles.
		$scope.createRole = function(){

			$role_obj = {'role' : $scope.role}
	
			rs.create($role_obj).then(function(response){
				
				if(response.data.status == 'success'){ 

					$scope.role = {} ;
					message = "Role created successfully";
					icon = "fa-check"; 
					
				}else{

					message = response.data.message;
					icon    = "fa-exclamation-triangle";
				} 

				d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true', className: 'ngdialog-theme-default' }) ;

			},function(){

				d.open({template : "<i class='fa fa-exclamation-triangle'></i> An error occured while performing this operation.", plain: 'true' }) ;
			})
			
		}
	}])



	app.controller('manageRolesController', ["$scope", "roleService", 'ngDialog', function($scope, rs, d){


		$scope.roles = [] ; //All Roles 


		//get all roles
		rs.getRoles().then(function(response){

			$scope.roles = response.data ;
		})
		


		/**
		* contols the deleting of a role
		* @params cell object.
		*/
		$scope.delete = function(role){
			
			var role_obj = {'role_id' : role.id };
			var index = $scope.roles.indexOf(role);
  			

			//open  delete confirmation dialog
			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete this Role ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	rs.drop(role_obj).then(function(response){

				if(response.data.status == 'success'){ 

					message = "Role has been deleted" ;
					icon    = "fa-check" ;
					$scope.roles.splice(index, 1); 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i> Error occured while trying to delete this Role", plain: 'true' }) ;
            	})	
			},function(){
				
				//do nothng
			})
       	}
	}])





	app.directive('roleName', ['roleService', function(rs){

		return {

			template : "<td>{{roleName}}</td>",
			restrict: "AE", //use only as an attribute
			replace: true,
			scope: {
				roleId : '=',
			},
			link : function($scope, element, attrs) {
				
				var $role_obj = {'role_id' : $scope.roleId } ;

				rs.info( $role_obj ).then(function(response){

					$scope.roleName = (typeof  response.data != 'object') ? ' ' : response.data.name ;
				})
			}
		}
	}])


	




	app.factory('roleService', ["$http", function($http){

		var role = {} ;

		role.getRoles = function(){

			return $http({method: 'GET', url : 'roles/getRoles' }) ;
		} ;


		role.create = function(roleObject){

			return $http({method: 'GET', url : 'roles/newRole', params : roleObject }) ;
		} ;


		role.info = function(roleObject){

			return $http({method: 'GET', url : 'roles/roleInfo', params : roleObject }) ;

		} ;

		role.drop = function(roleObject){

			return $http({method: 'GET', url : 'roles/drop', params : roleObject }) ; 
			
		} ;

		return role ;
		
	}])


	
})()