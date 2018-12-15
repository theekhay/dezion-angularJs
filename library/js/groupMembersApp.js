(function(){
	

	var app = angular.module('groupMembersApp', []) ;
	

	app.controller('addMembersController', ["$scope", "groupService", "groupMembersService", function($scope, cs, gms){

		$scope.data = {} ;

		$scope.feedback = {} ;

		$scope.addToGroup = function(){
	
			gms.addMember($scope.data).then(function(response){

				if(response.status == 'success') { $scope.data = {} }
				console.log(response) ;	
			})
		}
	}])

	app.controller('groupMembersListController', ["$scope", "groupService", "groupMembersService", "$routeParams", function($scope, gs, gms, $rs){

		$scope.small_group_id = $rs.small_group_id ; //small group id from route params

		$scope.groupInfo = {} ;

		$scope.members = {} ;

		var $q_obj = {'small_group_id' : $scope.small_group_id } ;


		gms.getMembers($q_obj).then(function(response){

			$scope.members = response
		})


		//get info about the small group.
		gs.groupInfo($q_obj).then(function(response){

			$scope.groupInfo = response  ;
		})
			
		
	}])



	



	app.factory('groupMembersService', ["$http", "$q", function($http, $q){

		return{

			getMembers : function(groupIdObj){

				var deffered = $q.defer() ;

				$http({method: 'GET', url : 'sg_members/get_members', params : groupIdObj }).

				success(function(data, status, headers, config){
					deffered.resolve(data);
				}).

				error(function(data, status, headers, config){
					deffered.reject(status);
				})

				return deffered.promise ;
			},

			addMember : function(memberbject){

				var deffered = $q.defer() ;

				$http({method: 'GET', url : 'sg_members/newMember', params : memberbject }).

				success(function(data, status, headers, config){
					deffered.resolve(data);
				}).

				error(function(data, status, headers, config){
					deffered.reject(status);
				})

				return deffered.promise ;
			},

			dropMember : function(memberbject){

				var deffered = $q.defer() ;

				$http({method: 'GET', url : 'sg_members/drop', params : memberbject }).

				success(function(data, status, headers, config){
					deffered.resolve(data);
				}).

				error(function(data, status, headers, config){
					deffered.reject(status);
				})

				return deffered.promise ;
			}
		}
	}])


	
})()