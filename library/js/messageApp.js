(function(){
	

	var app = angular.module('messageApp', []) ;



	app.controller('messageLoadController', ["$scope", "messageService", "ngDialog", "$routeParams", function($scope, ms, d, $rs){

		$scope.messages = [] ;

		$scope.currentSelection = null ;
		
		$scope.message = {} ;


		//auto populate messages for the current logged in user.
		$scope.load = function(){

			ms.userMessages().then(function(response){

				$scope.messages = response.data ; 

			},function(){

				d.open({template : "Message retreive error. Retry in 10 seconds", plain: 'true' }) ;
			})
		}


		$scope.display = function(message_id){
			
			$scope.currentSelection = message_id ;
		}


		//set a watch on currentSelection
		$scope.$watch('currentSelection', function(){
			
			ms.getMessage($scope.currentSelection).then(function(response){
				
				$scope.message = response.data ;
				
			}, function(){

				//log error ||
				//show user error message 
			})
				
		})

		$scope.load();
	}])


	app.controller('manageMessageController', ["$scope", "messageService", "ngDialog", function($scope, ms, d){

		$scope.message = {} ;

		$scope.MAX_MESSAGE_COUNT = 1000 ; //inbox becomes too full, alert user to delete some messages


		//Send a message
		$scope.sendMessage = function(){

			msg_obj = {'message' : $scope.message} ;

			ms.send( msg_obj ).then(function(response){

				if(response.data.status =='success'){

					$scope.message = {} ;
					message = "Message sent" ;
					icon = "fa-check";

				}else{
					message = response.data.message
					icon    = "fa-exclamation-triangle";
				}

				d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;


			}, function(){
				//handles error
			})
		}

		//delete a message
		//messages deleted are kept in trash until after 30 days
		$scope.drop = function(message_id){

			var message_obj = {message_id : message_id } ;

			//call the message service that handles deleting of messages
			ms.drop(message_obj).then(function(){
				
				d.open({template: "Message has been deleted", plain: true })

			}, function(){
				d.open({ template : "Error occured while deleteing this message", plain: true })
				
			})
		}
	}])





	app.factory('messageService', ["$http", function($http){

		var message = {} ;


		message.send = function(message_obj){

			return $http({method: 'GET', url : 'messages/send',  params : message_obj }) ;
		} ;

		/*
		* Gets all messages for the currently logged in user from the server 
		*/
		message.userMessages = function(){

			return $http({method: 'GET', url : 'messages/getUserMessages' }) ;
		} ;

		/*
		* get details about a particular message, given the message id
		* @param message_obj example {message_id : 1} 
		*/	
		message.getMessage = function(message_id){

			return $http({method: 'GET', url : 'messages/getInfo/' + message_id }) ;
		} ;


		message.drop = function(message_obj){

			return $http({method: 'GET', url : 'messages/drop', params : message_obj }) ;
		} 

		return message ;
	}])


	
})()