(function(){
	

	var app = angular.module('departmentApp', []) ;


	app.controller('createDepartmentController', ["$scope", "departmentService", "ngDialog", "$routeParams", function($scope, ds, d, $rs){

		$scope.department = {} ;
		$scope.action = "Create" ;
		$scope.department_id = $rs.department_id ; 


		if($scope.department_id != null ){

			$scope.action = "Update";

			//populate information for current team.
			ds.departmentInfo($rs).then(function(response){
				//populating the tean head is a problem. Fix it.
				$scope.department = response.data ;
				$scope.department.team = {'test' : response.data.team_id }
				console.log($scope.department);
			})
		}

		$scope.create = function(){

			ds.createDepartment($scope.department).then(function(response){
				
				if(response.data.status == 'success'){ 

					$scope.department = {} ;
					message = "Department created successfully";
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



	app.controller('manageDepartmentController', ["$scope", "teamService", "$routeParams", "departmentService", "ngDialog", function($scope, ts, $rs, ds, d){

		$scope.team_id = $rs.team_id ;

		$scope.teamInfo = {} ;

		$scope.departments = [] ;

		var $q_obj = {'team_id' : $scope.team_id } ;


		ds.getDepartments($q_obj).then(function(response){
			$scope.departments = response.data
		})
		
		
		ts.teamInfo($q_obj).then(function(response){
			$scope.teamInfo = response.data  ;
		})


		$scope.delete = function(department){
			
			var department_obj = {'department_id' : department.id };
			var index 		   = $scope.departments.indexOf(department);
  			

			//open  delete confirmation dialog
			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete this department ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	ds.deleteDepartment(department_obj).then(function(response){

            		//clear fields on success
				if(response.data.status == 'success'){ 

					message = "Department has been deleted" ;
					icon    = "fa-check" ;
					$scope.departments.splice(index, 1); 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i> Oops! An error occured while performing this operation.", plain: 'true' }) ;
            	})	
			}, function(){

				//do nothing
			})
       	}

		

		
	}])



	app.controller('departmentListController', ["$scope", "departmentService", function($scope, ds){

		$scope.departments = {} ;

		ds.getDepartments().then(function(response){

			$scope.departments = response.data
		})
	}])



	//gets the number of departments in a team, given the team id
	app.directive('deptsInTeam', ['departmentService', function(ds){
		return {

			template : "<td>{{count}}</td>",
			restrict: "AE", //use only as an attribute
			replace: true,
			scope: {
				teamId : '=',
			},
			link : function($scope, element, attrs) {

				var $team_obj = {'team_id' : $scope.teamId }
				
				ds.departmentsInTeam($team_obj).then(function(response){
					$scope.count = response.data.department_count;
				})

				
			}
		}
	}])




	app.factory('departmentService', ["$http", "$q", function($http, $q){

		var department = {} ;

		department.getDepartments = function(teamObject){

			return $http({method: 'GET', url : 'departments/getDepartments', params : teamObject }) ;
		} ;

		department.createDepartment = function(departmentObject){

			return $http({method: 'GET', url : 'departments/newDepartment', params : departmentObject }) ;
		} ;

		department.departmentInfo = function(departmentObject){

			return $http({method: 'GET', url : 'departments/departmentInfo', params : departmentObject }) ;
		} ;

		department.deleteDepartment = function(departmentObject){

			return $http({method: 'GET', url : 'departments/drop', params : departmentObject }) ;
		} ;

		department.departmentsInTeam = function(cellObj){

			return $http({method: 'GET', url : 'departments/departmentsInTeam', params : cellObj }) ;
			
		} ;
		
		return department ;
	}])


	
})()