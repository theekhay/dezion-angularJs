(function(){		
	
	var $app = angular.module('dashboardApp', []) ;



	$app.controller('getAdminDetails', ['$scope', 'adminServices', 'memberServices', '$rootScope', function($scope, as, ms, $rs ){

		$rs.admin_global = {} ;

		$scope.username = $rs.username ;

		$rs.member_global = {} ; 

		console.log($rs.loggedIn)


		/**
		* Get Logged in administator details and set them as global variables in rootscope
		* This ensures they are accessible from anywhere within the app.
		*/
		$scope.instantiate = function(){

			//call the admin service to get the admin details
			as.getInfo('usera').then(function(response){

				$rs.admin_global =  response.data ; //make global

				var member_id = response.data.member_id ;

				//get the administrators membership details using the member id
				ms.getInfo(member_id).then(function(response){

					$rs.member_global = response.data ; //make global
				})
			})
		}

		$scope.instantiate() ;

	}])


})()