(function(){
	

	var app = angular.module('cellApp', []) ;


	app.controller('createCellController', ["$scope", "cellService", "$routeParams", "ngDialog", function($scope, cs, $rs, d){

		$scope.cell = {} ;

		$scope.action = 'Create';

		$scope.cell_id = $rs.cell_id ;


		if($scope.cell_id != null ){

			$scope.action = "Update";

			//populate information for current cell.
			cs.cellInfo($rs).then(function(response){
				$scope.cell = response.data ;
			})
		}

		//controls creation of a new cells.
		$scope.createCell = function(){

			var cell_data = {'cell' : $scope.cell } ;
	
			cs.createCell(cell_data).then(function(response){
				
				if(response.data.status == 'success'){ 

					$scope.cell = {} ; //empty the form fields
					message = "Cell created successfully";
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



	app.controller('manageCellController', ["$scope", "zoneService", "$routeParams", "cellService", 'ngDialog', function($scope, zs, $rs, cs, d){

		$scope.zone_id = $rs.zone_id ; //zone id from route params

		$scope.zoneInfo = {} ; //info of the zone stated declared above

		$scope.cells = [] ; //All cells in the zone declared above

		var $q_obj = {'zone_id' : $scope.zone_id } ;


		//get all cells in the given zone
		cs.getCells($q_obj).then(function(response){

			$scope.cells = response.data
		})
		

		//get the zone info the current cell belongs to.
		zs.zoneInfo($q_obj).then(function(response){

			$scope.zoneInfo = response.data ;
		})


		/**
		* contols the deleting of a cell
		* @params cell object.
		*/
		$scope.delete = function(cell){
			
			var cell_obj = {'cell_id' : cell.id };
			var index = $scope.cells.indexOf(cell);
  			

			//open  delete confirmation dialog
			//put these in a directive.
			d.openConfirm({template: "<h4 style='color: #6c8bef;'>Confirm Delete Action</h4><p>Are you sure you want to delete this Cell ?</p>" +
                        "<div>" +
                          "<button type='button' class='btn btn-primary' ng-click='closeThisDialog(0)'x >No</button>&nbsp;&nbsp;&nbsp;" +
                          "<button type='button' class='btn btn-primary' ng-click='confirm(1)' >Yes" +
                        "</button></div>", plain: 'true', className: 'ngdialog-theme-default' 
            }).then(function(){

            	cs.deleteCell(cell_obj).then(function(response){

				if(response.data.status == 'success'){ 

					message = "Cell has been deleted" ;
					icon    = "fa-check" ;
					$scope.cells.splice(index, 1); 

				}else{

					message = response.data.message ;
					icon    = "fa-exclamation-triangle";
				}	

				//display feedback based on response from the server
        		d.open({template : "<i class='fa "+ icon + " '></i> " + message, plain: 'true' }) ;
            		          		   
            	}, function(){
            		d.open({template : "<i class='fa fa-exclamation-triangle '></i>  Error occured while trying to delete this Cell", plain: 'true' }) ;
            	})	
			},function(){
				//do nothng
			})
       	}
	}])



	app.controller('cellListController', ["$scope", "cellService", function($scope, cs){

		$scope.cells = [] ; //All cells 

		//get all cells 
		cs.getCells().then(function(response){
			$scope.cells = response.data ;
		})
	}])


	//for the dashboard
	app.controller('cellSlideController', ["$scope", "cellService", "$timeout", function($scope, cs, $t){

		$scope.all = {} ; //All cells 

		$scope.current = {} ; //current display

		$scope.currentIndex = 0 ;

		//get cell list 
		cs.getCells().then(function(response){
			$scope.all = response.data ;
		})

		$scope.slide = function(){

			if($scope.all.length > 1 ){

				cellObj = {'cell_id' : $scope.all[$scope.currentIndex].id } ;

				cs.cellInfo(cellObj).then(function(response){
					$scope.current = response.data ;
				}, function(){

					//do nothing
				}) ;

				$scope.currentIndex = ($scope.all.length - 1 == $scope.currentIndex  ) ? 0 : $scope.currentIndex + 1 ;
			}
		}

		setInterval(function(){
			$scope.slide() ;
		}, 8000) ;


	}])



	//gets the number of cells in a zone
	app.directive('cellsInZone', ['cellService', function(cs){
		return {

			template : "<td>{{count}}</td>", //replace this
			restrict: "AE", 
			replace: true,
			scope: {
				zoneId : '=',
			},
			link : function($scope, element, attrs) {

				var $zone_obj = {'zone_id' : $scope.zoneId }
				
				cs.cellsInZone($zone_obj).then(function(response){
					$scope.count = response.data.cell_count;
				})				
			}
		}
	}])




	app.factory('cellService', ["$http", function($http){

		var cellservice = {} ;


		//get all cells 
		cellservice.getCells = function(zoneIdObj){

			return $http({method: 'GET', url : 'cells/getCells', params : zoneIdObj }) ;
		} ;

		//create a new cell
		cellservice.createCell = function(cellObject){

			return $http({method: 'GET', url : 'cells/newCell', params : cellObject }) ;
		} ;

		//get info about a cell - given the cell id 
		//cell_bj template ---> {'cell_id' : 2}
		cellservice.cellInfo = function(cellObj){

			return $http({method: 'GET', url : 'cells/cellInfo', params : cellObj }) ;

		} ;

		//delete a cell
		cellservice.deleteCell = function(cellObj){

			return $http({method: 'GET', url : 'cells/drop', params : cellObj }) ; 
			
		} ;

		//get the cells in a zone 
		cellservice.cellsInZone = function(cellObj){

			return $http({method: 'GET', url : 'cells/cellsInZone', params : cellObj }) ;
			
		}

		return cellservice ;
		
	}])


	
})()