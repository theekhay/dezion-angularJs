(function(){		
	
	var $app = angular.module('adminApp', []) ;



	//controller used in the search-member directive
	$app.controller('adminSearchController', ['$scope', 'adminServices', function($scope, as ){

		//array of administrators
		$scope.administrators  = [] ; 
		
		// bound to the scope calling it, it is what is seen in the input box (i.e what the user is typing )
		$scope.modelName = "" ; 

		//holds the admin id afer a user has been selected i.e when $scope.isSelected is true
		$scope.modelInfo = "" ;   

		// holds info about the current member selected
		$scope.selected = {} ; 

		//bool value that denotes if there is a current active selection
		$scope.isSelected = false ; 

		//fullname of the current admin selection
		//also used to track when there is a change in the modelName 
		//when a user makes a selection modelName == currentName
		//once there is a change in the search box - currentName != modelName again
		$scope.currentName = "" ; 

		$scope.searchFound = false ; 


		$scope.$watch('modelName', function(){

			if( typeof $scope.modelName != 'undefined' && $scope.modelName.length > 3 ){

				$scope.selected = {} ;

				//This if block is a check against when the user makes a change in the input field after making a selction and tries to submit
				//resets the isSelcted to false - to denote n active selection
				//resets the modelIfo to empty, to override its current value from the previous selection.
				if($scope.currentName != $scope.modelName ) {

					$scope.searchFound = false ;
					$scope.isSelected = false ;
					$scope.modelInfo = "" ;
				} 

			}else{
				$scope.searchFound = false ;
				$scope.modelInfo = "" ;
			}
		})
		
		
		//populate the administrators - this is an array of objects
		as.getAdmins().then(function(response){

			$scope.administrators =  response.data ;
			console.log($scope.administrators);

		})



		//search function used in the view
		$scope.searchTest = function(item){
			
			if( typeof $scope.modelName == 'undefined' || $scope.modelName.length < 4) {

				$scope.searchFound = false ;
				return false ;
			}
			else{

				if(	item.firstname.toLowerCase().indexOf($scope.modelName.toLowerCase() ) != -1 ||
					item.surname.toLowerCase().indexOf($scope.modelName.toLowerCase() )  != -1 ||  
					item.username.toLowerCase().indexOf($scope.modelName.toLowerCase() ) != -1 
				){
					$scope.searchFound = true ;
					return true ;
					 
				}
			}	

			$scope.searchFound = false ;
			return false ;
		}

		//Actions upon selecting an admin from the dropdown
		$scope.selectAdmin = function(a){

			name = a.surname + " " + a.firstname ;
			$scope.selected 	= a ; 	   //holds the details of the current selection
			$scope.modelName 	= name ;  //populates the input field with the name
			$scope.modelInfo 	= a.admin_id ;  //sets the admin id
			$scope.isSelected 	= true;  //sets the isSelected property to -true--
			$scope.currentName 	= name ; 

		}
			
	}])


	$app.controller('manageAdminController', ['$scope', 'adminServices', "ngDialog", function($scope, as, d ){

		$scope.administrators  = [] ; 

		$scope.searchResult = [] ;

		$scope.search = "" ;

		$scope.limit = 20 ;


		as.getAdmins().then(function(response){

			$scope.administrators =  response.data ;
			$scope.searchResult =  response.data ;
		})


		/**
		* controls the deletion of an administrators
		* @privilege-users - Membership 
		*/
		$scope.delete = function(admin){
			
			var admin_obj = {'admin_id' : admin.id };
			var index 	   = $scope.searchResult.indexOf(admin);
  			

			//open  delete confirmation dialog

			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete administrator  ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 

            }).then(function(){

            	as.drop(admin_obj).then(function(response){

				if(response.data.status == 'success'){ 

					message = "Administrator has been deleted" ;
					icon    = "fa-check" ;

					$scope.searchResult.splice(index, 1); //remove the row from the view 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i> Oops! An error occured while performing this operation.", plain: 'true' }) ;
            	})	
			})
       	}



	// 	$scope.$watch('search', function(){

	// 		if($scope.search.length > 3){

	// 			$scope.limit = 1000 ;
	// 			//console.log($scope.search) ;
	// 			$scope.searchResult =  fs($scope.members,  {'firstname' : $scope.search}, {'surname' : $scope.search } ) ;
	// 			console.log($scope.searchResult) ;

	// 		}else{

	// 			$scope.limit = 20 ;
	// 			$scope.searchResult = $scope.members ;
	// 		}
	// 	})
			
	 }])




	$app.controller('changePasswordController', ['$scope', 'adminServices', 'ngDialog', function($scope, as, d ){

		$scope.admin = {} ;

		$scope.changePassword = function(){

			var passwordObj = {'passwords' : $scope.admin}

			as.changePassword(passwordObj).then( function(response){

				if(response.data.status == 'success'){

						$scope.admin = {} ;
						$message = "password changed succesfully"; 
						$font_icon = "fa fa-check";
					
					}else{

						$message   = response.data.message ;
						$font_icon = "fa fa-exclamation-triangle";
					} 

					d.open({template: "<div class='ngdialog-message'><i class='fa "+ $font_icon +"'></i> "+ $message +" </div>", plain: 'true'});

			}, function(){

				d.open({template : 'error processing this request', plain:true}) ;

			})
		}
	}])



	$app.controller('AdminRegisterationController', ['$scope', 'adminServices', "ngDialog", function($scope, as, d){

		$scope.admin = {} ;
		 
	
		$scope.register = function(){

			$admin_obj = {'admin' : $scope.admin } ;

			as.create($admin_obj).then( function(response){

				if(response.data.status == 'success'){ 

					$scope.admin = {} ;
					message = "User added successfully";
					icon = "fa-check"; 

				}
				else{

					message = response.data.message;
					icon    = "fa-exclamation-triangle";
				} 

				d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
					
				},function(){

					d.open({template : "<i class='fa fa-exclamation-triangle'></i> An error occured while performing this operation.", plain: 'true' }) ;
			})	 	
		}


		$scope.generatePassword = function(){

			$scope.admin.password = "XC10#3mu89V@!7"
		}
	}])



	//get the full name of an administrtor
	$app.directive('adminFullName', ['adminServices', 'memberServices', function(as, ms){

		return {

			template : "<td>{{fullname}}</td>",
			restrict: "AE", 
			replace: true,
			scope: {
				adminId : '=',
			},

			link : function($scope, element, attrs) {

				//get the admin details from the admin id passed into the scope
				as.getInfo($scope.adminId).then(function(response){

					//get the member_id property
					var member_id = response.data.member_id ;

					//use the member_id property to get the member details.
					ms.getInfo( member_id ).then(function(response){

						var full_name = (typeof  response.data != 'object') ? ' ' : response.data.firstname + " " + response.data.surname ;
						$scope.fullname = full_name ;
					})
				})
			}
		}
	}])
	
	
	$app.directive('adminFullNameO', ['adminServices', 'memberServices', function(as, ms){
		
				return {
		
					template : "<span>{{fullname}}</span>",
					restrict: "AE", 
					replace: true,
					scope: {
						adminId : '=',
					},
		
					link : function($scope, element, attrs) {
		
						//get the admin details from the admin id passed into the scope
						as.getInfo($scope.adminId).then(function(response){
		
							//get the member_id property
							var member_id = response.data.member_id ;
		
							//use the member_id property to get the member details.
							ms.getInfo( member_id ).then(function(response){
		
								var full_name = (typeof  response.data != 'object') ? ' ' : response.data.firstname + " " + response.data.surname ;
								$scope.fullname = full_name ;
							})
						})
					}
				}
			}])


	$app.directive('searchAdmin', ['filterFilter', 'adminServices', function(fs, as){
		
		return{

			restrict : 'AE',
			require : 'ngModel',
			templateUrl : "library/demo/partials/searchAdmin.html",
			replace : true,
			controller : 'adminSearchController',
			scope : {

				modelInfo : '=',
				modelName : '=' 
			} 
		}
	}])




	
	$app.factory('adminServices', ["$http", function($http){

		var admin = {} ;
				
		admin.getAdmins = function(){

			return $http({method: 'GET', url : 'admin/all_administrators' }) ;
		} ;


		admin.create = function(adminObject){

			return $http({method: 'GET', url : 'admin/register', params : adminObject }) ;
	
		} ;


		admin.getInfo = function(admin_id){

			return $http({method: 'GET', url : 'admin/adminInfo/' + admin_id }) ;
		} ;


		admin.drop = function(adminObj){

			return $http({method: 'GET', url : 'admin/drop/', params : adminObj }) ;
		} ;


		admin.changePassword = function(passwordObj){

			return $http({method: 'GET', url : 'admin/changePassword', params : passwordObj }) ;
		} ;

		return admin ;
		
	}])

})()