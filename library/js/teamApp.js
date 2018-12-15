(function(){
	

	var app = angular.module('teamApp', []) ;



	app.controller('createTeamController', ["$scope", "teamService", "ngDialog", "$routeParams", function($scope, ts, d, $rs){

		$scope.team    = {} ;
		$scope.team_id = $rs.team_id ; 
		$scope.action = "Create";

		if($scope.team_id != null ){

			$scope.action = "Update";

			//populate information for current team.
			ts.teamInfo($rs).then(function(response){
				//populating the tean head is a problem. Fix it.
				$scope.team = response.data ;
			})
		}

		
		$scope.create = function(){

			ts.createTeam($scope.team).then(function(response){
				
				if(response.data.status == 'success'){ 
					$scope.team = {} ;
					message = "Team created successfully";
					icon = "fa-check"; 
				}else{

					message = response.data.message;
					icon    = "fa-exclamation-triangle";
				} 


				d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;

			},function(){

				d.open({template : "<i class='fa fa-exclamation-triangle'></i> An error occured while performing this operation.", plain: 'true' }) ;
			})
		}
	}])



	app.controller('manageTeamsController', ["$scope", "teamService", "ngDialog", function($scope, ts, d){

		$scope.teams = [] ;

		ts.getTeams().then(function(response){

			$scope.teams = response.data ;
		})



		$scope.delete = function(team){
			
			var team_obj = {'team_id' : team.id };
			var index = $scope.teams.indexOf(team);
  			

			//open  delete confirmation dialog
			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete this Team ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	ts.deleteTeam(team_obj).then(function(response){
            		
				if( response.data.status == 'success'){ 

					message = "Team has been deleted" ;
					icon    = "fa-check" ;
					$scope.teams.splice(index, 1); 

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



	app.controller('teamReportController', ["$scope", "$routeParams", "teamService", "$location", function($scope, $rs, ts, $l){

		$scope.team_id = $rs.team_id ;

		$scope.myDataSource = {} ;

		$scope.data = [] ;

		$scope.teamInfo = {} ;

		$scope.communityReport = {} ;

		$l.search({'team_id': $scope.team_id});


		//populate information for current distrcit.
		ts.teamInfo($rs).then(function(response){

			//console.log(response) ;
			$scope.teamInfo = response.data ;
		}, 
		function(err){
			console.log(err) ;
		})



		$prom = ts.teamReport($rs) ;

		$prom.then(function(response){

			$scope.data = response.data ;
		}, 
		function(err){
			console.log(err) ;
		})


		$scope.getChart = function(){

			$scope.myDataSource = {

				chart : { caption : "caption", subCaption : "subcaption", theme : "ocean" } ,
				data : [{"number of comm" : "3"}, {"number of zones" : "8"}, {"number of cells" : "10"}, {"number of members" : "130"}]
				//data : $scope.data 
			}

			
	
		}

		$scope.getChart() ;

		console.log($scope.myDataSource) ;


	}])



	app.factory('teamService', ["$http", "$q", function($http, $q){

		var teams = {} ;

		teams.getTeams = function(){

			return $http({method: 'GET', url : 'teams/getTeams' }) ;
		} ;

		teams.createTeam = function(teamObj){

			return $http({method: 'GET', url : 'teams/newTeam', params : teamObj }) ;
		} ;


		teams.teamInfo = function(teamObj){

			return $http({method: 'GET', url : 'teams/teamInfo', params : teamObj }) ;
		} ;


		teams.teamReport = function(teamObj){

			return $http({method: 'GET', url : 'teams/teamOverviewReport', params : teamObj }) ;
			
		} ;

		teams.deleteTeam = function(teamObj){

			return $http({method: 'GET', url : 'teams/drop', params : teamObj }) ;
		}


		return teams ;
	}])


	
})()