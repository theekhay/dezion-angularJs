(function(){
	

	var app = angular.module('eventsApp', []) ;

	app.controller('eventListController', ["$scope", "eventService", "$rootScope",  function($scope, es, $rs){

		$scope.events = [] ;
		
		 $scope.getEvents = function(){

		 	es.getEvents().then(function(response){

		 		$scope.events = response.data ;

		 	},function(){

		 		//error retreiveing event list
		 	})
		 } 


		 $scope.getEvents() ;

	}])



	app.factory('eventService', ["$http", "$q", function($http, $q){

		var events = [];

		events.getEvents = function(){

			return $http({method: 'GET', url : 'events/getEvents' }) ;
		} ;


		events.createEvent = function($districtObject){

			return $http({method: 'GET', url : 'events/newEvent', params : $districtObject }) ;

		} ;

		return events ;
	}])


	
})()