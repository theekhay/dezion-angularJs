(function(){
	

	var app = angular.module('cellMembersApp', []) ;
	

	app.controller('addMemberController', ["$scope", "cellService", "cellMembersService", function($scope, cs, cms){

		//$scope.memberInfo = {} ;

		$scope.feedback = {} ;

		$scope.data = {} ;

		
		$scope.addToCell = function(){
	
			cms.addMember($scope.data).then(function(response){

				if(response.data.status == 'success') { $scope.data = {} }
			})
			
		}
	}])  





	app.controller('cellMembersListController', ["$scope", "cellService", "$routeParams", "cellMembersService", "ngDialog", function($scope, cs, $rs, cms, d){

		$scope.cell_id = $rs.cell_id ; //cell id from route params

		$scope.cellInfo = {} ; //info of the cell declared above

		$scope.members = [] ; //members of the cell 

		var $q_obj = {'cell_id' : $scope.cell_id } ;


		//get all cells in the given zone
		cms.getMembers($q_obj).then(function(response){
			$scope.members = response.data
		})
		

		//get the current cell info
		cs.cellInfo($q_obj).then(function(response){

			$scope.cellInfo = response.data  ;
		})


		$scope.delete = function(member){
			
			var member_obj = {'member_id' : 3, 'cell_id' : $scope.cell_id };
			var index = $scope.members.indexOf(member);
  			

			//open  delete confirmation dialog
			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to Remove this member from this cell ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	cms.dropMember(member_obj).then(function(response){

            		//clear fields on success
				if(response.data.status == 'success'){ 

					message = "Member has been removed from this cell" ;
					icon    = "fa-check" ;
					$scope.members.splice(index, 1); 

				}else{

					message = response.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i>  Error occured while trying to perform this operation", plain: 'true' }) ;
            	})	
			}, function(){

				//do nothing
			})
       	}
	}])





	//gets the number of members in a cells 
	app.directive('membersInCell', ['cellMembersService', function(cms){
		return {

			template : "<td>{{count}}</td>",
			restrict: "AE", //use only as an attribute
			replace: true,
			scope: {
				cellId : '=',
			},
			link : function($scope, element, attrs) {
				
				cms.memberCount($scope.cellId).then(function(response){
					
					$scope.count = response.data.member_count;
				})
			}
		}
	}])





	app.factory('cellMembersService', ["$http", "$q", function($http, $q){

		var cell = {} ;

			cell.getMembers = function(cellIdObj){

				return $http({method: 'GET', url : 'cell_members/getMembers', params : cellIdObj }) ;
			} ;

			cell.addMember = function(memberObject){

				return $http({method: 'GET', url : 'cell_members/newMember', params : memberObject }) ;
			} ;

			cell.dropMember = function(memberObject){

				return $http({method: 'GET', url : 'cell_members/drop', params : memberObject }) ;
			} ;


			cell.memberCount = function(cell_id){

				return $http({method: 'GET', url : 'cell_members/member_count/' + cell_id }) ;
			} ;

		return cell ;
	}])


	
})()