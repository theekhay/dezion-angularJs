(function(){		
	
	var $app = angular.module('members', []) ;

	//controller used in the search-member directive
	$app.controller('membersSearchController', ['$scope', 'memberServices', 'filterFilter', function($scope, ms, fs ){

		//array of members' object
		$scope.members  = [] ;  

		//bound to the scope calling it, it is what is seen in the input box (i.e what the user is typing )
		$scope.modelName = "" ; 

		//holds the member id afer a user has been selected
		$scope.modelInfo = "" ; 

		//holds the search result during a search 
		$scope.searchResult = [] ;

		// holds info about the current member selected
		$scope.selected = {} 

		//bool- this denotes if there is a current active selection
		$scope.isSelected = false ;

		//fullname of the active selection (if a member has been selected)
		$scope.currentName = "" ; 

		$scope.searchFound = false ;


		$scope.$watch('modelName', function(){

			if( typeof $scope.modelName != 'undefined' && $scope.modelName.length > 3 ){

				$scope.selected = {} ;
				console.log($scope.searchFound) ;
				//$scope.searchResult =  fs($scope.members,  {'firstname' : $scope.modelName}, {'surname' : $scope.modelName } ) ;

				//This 'if block {}' is a check against when the user makes a change in the input field after making a selction and tries to submit
				//resets the isSelcted to false - to denote no active selection
				//resets the modelInfo to empty, to override its current value from the previous selection.
				if($scope.currentName != $scope.modelName ) {

					$scope.searchFound = false ;
					$scope.isSelected = false ;
					$scope.modelInfo = "" ;
				} 

			}else{

				$scope.searchFound = false ;
				$scope.searchResult = [] ;
				$scope.modelInfo = "" ;
			}
		})


		$scope.searchTest = function(item){

			if( typeof $scope.modelName == 'undefined' || $scope.modelName.length < 4) {

				$scope.searchFound = false ;
				return false ;
			}
			else{

				if(	item.firstname.toLowerCase().indexOf($scope.modelName.toLowerCase() ) != -1 ||
					item.surname.toLowerCase().indexOf($scope.modelName.toLowerCase() )  != -1  ||
					item.telephone1.toLowerCase().indexOf($scope.modelName.toLowerCase() )  != -1 
				){
					$scope.searchFound = true ;
					return true ;
				}
			}	

			$scope.searchFound = false ;
			return false ;
		}
		
	
		ms.getMembers().then(function(response){

			$scope.members =  response.data ;
		})


		$scope.selectMember = function(m){

			name = m.surname + " " + m.firstname ;
			$scope.searchResult = [] ; //hides the name dropdown
			$scope.selected 	= m ; 	   //holds the details of the current selection
			$scope.modelName 	= name ;  //populates the input field with the name
			$scope.modelInfo 	= m.id ;  //sets the member id
			$scope.isSelected 	= true;  //sets the isSelected property to -true--
			$scope.currentName 	= name ; 

		}
			
	}])




	$app.controller('memberListController', ['$scope', 'memberServices', 'filterFilter', "ngDialog", function($scope, ms, fs, d ){

		$scope.members  = [] ; 

		$scope.search = "" ;

		$scope.limit = 20 ;

		$scope.searchFound = false ;

		$scope.searchText = "" ;


		ms.getMembers().then(function(response){

			$scope.members =  response.data ;
		})


		/**
		* controls the deletion of a member
		* @privilege-users - Membership 
		*/
		$scope.delete = function(member){
			
			var member_obj = {'member_id' : member.id };
			var index 	   = $scope.members.indexOf(member);
  			

			//open  delete confirmation dialog

			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to remove " + member.surname + " " + member.firstname+" from the membership database ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 

            }).then(function(){

            	ms.delete(member_obj).then(function(response){

				if(response.data.status == 'success'){ 

					message = "Member has been deleted" ;
					icon    = "fa-check" ;

					$scope.members.splice(index, 1); //remove the row from the view 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.openConfirm({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i> Oops! An error occured while performing this operation.", plain: 'true' }) ;
            	})	
			})
       	}



		   $scope.$watch('searchText', function(){
			
				if( typeof $scope.searchText != 'undefined' && $scope.searchText.length > 3 ){

					console.log($scope.members.length);
				}
					
			}) 



		$scope.searchTest = function(item){
			
			if( typeof $scope.searchText != 'undefined' || $scope.searchText.length > 3) {
				
				if(	item.firstname.toLowerCase().indexOf($scope.searchText.toLowerCase() ) != -1 ||
					item.surname.toLowerCase().indexOf($scope.searchText.toLowerCase() )  != -1  ||
					item.telephone1.toLowerCase().indexOf($scope.searchText.toLowerCase() )  != -1 ||
					item.uid.toLowerCase().indexOf($scope.searchText.toLowerCase() )  != -1 
				){
					$scope.limit = 1000 ;
					$scope.searchFound = true ;
					return true ;

				}else{
					$scope.searchFound = false ;
				}
			}else{
				$scope.limit = 20 ;
				$scope.searchFound = false ;
			}
		}	
			
	}])

	


	$app.controller('memberInfoController', ['$scope', 'memberServices', function($scope, ms ){

		$scope.member  = [] ; 

		$scope.getInfo = function(member_id){

			ms.getInfo(member_id).then(function(response){

				$scope.member =  response.data ;
			})
		}

		
	}])




	$app.controller('memberRegisterationController', ['$scope', 'memberServices', "ngDialog", "$routeParams", function($scope, ms, d, $rs){

		$scope.member = {} ;
		$scope.member_id = $rs.member_id ; 
		$scope.action  = "Register";



		//check if it is an edit or a create
		if($scope.member_id != null ){

			$scope.action = "Update";

			//populate information for current Member.
			ms.getInfo($scope.member_id).then(function(response){
				$scope.member = response.data ;
				$scope.member.telephone1 = parseInt(response.data.telephone1)
			})
		}


		$scope.updateMember = function(){
			console.log('working') ;
		}



		$scope.registerMember = function(){

			$scope.member.action = $scope.action ;

			member_obj = {'member' : $scope.member} ;

			ms.registerMember(member_obj).then( function(response){

				if(response.data.status == 'success'){ 

					$scope.member = {} ;
					message = ($scope.action == 'Register') ? "Member created successfully" : "Member updated successfully";
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
	}])




	$app.controller('birthdayController', ['$scope', 'memberServices', function($scope, ms){

		$scope.birthdays = {} ;

		ms.getBirthdays().then(function(response){

			$scope.birthdays = response.data ; 

		},function(err){

			//do someething
		})
	}])



	$app.directive('searchMember', ['filterFilter', 'memberServices', function(fs, ms){

		return{
			restrict : 'AE',
			require : 'ngModel',
			templateUrl : "library/demo/partials/searchView.html",
			replace : true,
			controller : 'membersSearchController',
			scope : {

				modelInfo : '=',
				modelName : '=' 
			} 
		}
	}])
	

	$app.directive('fullName', ['memberServices', function(ms){

		return {

			template : "<td>{{fullname}}</td>",
			restrict: "AE", //use only as an attribute or element
			replace: true,
			scope: {
				memberId : '=',
			},
			link : function($scope, element, attrs) {
				
				ms.getInfo($scope.memberId).then(function(response){

					var full_name = (typeof response.data != 'object') ? ' ' : response.data.firstname + " " + response.data.surname ;
					$scope.fullname = full_name ;
				})
			}
		}
	}])	


	/**
	* member service  
	*/
	$app.factory('memberServices', ["$http", "$q", function($http, $q){

		var member = {} ;
				
		member.getMembers = function(){

			return $http({method: 'GET', url : 'members/all_members_data'}) ;
		} ;


		member.registerMember = function(memberDataObject){

			return $http({method: 'GET', url : 'members/register', params : memberDataObject }) ;
	
		} ;


		member.getBirthdays = function(){

			return $http({method: 'GET', url : 'members/this_week_bday' }) ;
		} ;


		member.getInfo = function(member_id){

			return $http({method: 'GET', url : 'members/memberInfo/' + member_id }) ;
		} ;


		member.delete = function(memberObj){

			return $http({method: 'GET', url : 'members/drop/', params : memberObj }) ;
		} ;

		return member ;
		
	}])

})()