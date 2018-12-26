(function () {


    var app = angular.module('loginApp', ["ngDialog", "720kb.tooltips"]);


    // app.config(['tooltipsConfProvider', function configConf(tooltipsConfProvider) {
    //     tooltipsConfProvider.configure({
    //       'smart': true,
    //       'size': 'large',
    //       'speed': 'slow',
    //       'tooltipTemplateUrlCache': true
    //       //etc...
    //     });
    // }])

    app.controller('loginController', ["$scope", "loginService", "$window", "ngDialog", "$rootScope", function ($scope, ls, $window, d, $rs) {

        $scope.user = {};

        $scope.loggedIn = false;


        $scope.login = function () {

            ls.authenticate($scope.user).then(function (response) {

                console.log(response.data);

                if (response.data.status === 'success') {

                    $scope.loggedIn = true; //make this rootscope
                    $rs.loggedIn = true;
                    $rs.username = $scope.user.username;
                    $scope.user = {}; //empty the user object.
                    $window.location.href = 'https://dezion.herokuapp.com/dashboard#!/dashboard'; //redirect to dashboard.
                    //http://dezion.harvestersng.org/dashboard#/dashboard


                } else {

                    $scope.user.password = "";
                    d.open({template: "<h4 style='color: #9e2852;'>Login Error</h4><p>" + response.data.message + "</p>" +
                        "<div>", plain: 'true', className: 'ngdialog-theme-default' })
                }

                

            }, function (err) {
                d.open({template: "<h4 style='color: #9e2852;'>Error processing this request</h4><p>", plain: 'true', className: 'ngdialog-theme-default' })
            })
        }
    }])
    

    app.directive('tooltip', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                $(element).hover(function(){
                    // on mouseenter
                    $(element).tooltip('show');
                }, function(){
                    // on mouseleave
                    $(element).tooltip('hide');
                });
            }
        };
    });


    app.factory('loginService', ["$http", '$q', function ($http, $q) {

        var userService = {} ;

        userService.authenticate = function ( userObject ) {

           return  $http({ method: 'GET', url: 'api/authenticate', params: userObject })

        }

        return userService ;
    
	}])

})()
