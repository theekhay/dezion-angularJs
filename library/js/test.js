

(function(){

	//,"eventsApp"

	var app = angular.module('test', ["ngRoute", "members", "districtApp", "communityApp", "firsttimersApp", "zoneApp", 
										"cellApp", "cellMembersApp", "ng-fusioncharts", "teamApp", "departmentApp", "smallGroupApp",
										"groupMembersApp", "secondtimersApp", "ngDialog", "720kb.datepicker", "720kb.tooltips", "serviceApp","eventsApp", "adminApp",
										"dashboardApp", "roleApp", "serviceRecordApp", "messageApp" ])
	.config(["$routeProvider", function($routeProvider){

		$routeProvider.when('/dashboard', {templateUrl : "dashboard/" })
		.when('/roles', { templateUrl : "roles"})

		.when('/admin/changePassword', { templateUrl : "admin/changePassword"})
		.when('/admin/profile', { templateUrl : "admin/profile"})
		.when('/admin/create', { templateUrl : "admin/register"})
		.when('/users/manageUsers', { templateUrl : "admin/manageUsersView"})


		.when('/role/create', { templateUrl : "roles/createRoleView"})
		.when('/roles/manage', { templateUrl : "roles/allRolesView"})

		.when('/members', { templateUrl : "members"}) 
		.when('/members/add', { templateUrl : "members/add"})
		.when('/member/edit/:member_id', { templateUrl : "members/add"})

		.when('/dashboard', { templateUrl : "dashboard/main"})
		.when('/events', { templateUrl : "events"})


		.when('/districts/create', { templateUrl : "districts/createDistrict", title : "create District"})
		.when('/districts/manage', { templateUrl : "districts/"})
		.when('/districts/report/:district_id', { templateUrl : "districts/report/" })
		.when('/district/edit/:district_id', { templateUrl : "districts/createDistrict" })


		.when('/community/create', { templateUrl : "communities/createCommunity" })
		.when('/community/communityPage/:district_id', { templateUrl : "communities/communityPage", controller  : "manageCommunityController" })
		.when('/community/edit/:community_id', { templateUrl : "communities/createCommunity" })


		.when('/messages', { templateUrl : "messages/"})
		.when('/message/message_id', { templateUrl : "messages/display"})
		.when('/messages/compose', { templateUrl : "messages/composeView"})
		.when('/messages/inbox', { templateUrl : "messages/inboxView"})

		.when('/firsttimer/add', { templateUrl : "first_timers/register"})
		.when('/firsttimer/edit/:firsttimer_id', { templateUrl : "first_timers/register"})
		.when('/firsttimers/report', { templateUrl : "first_timers/report"})


		.when('/secondtimers/add', { templateUrl : "second_timers/register"})
		.when('/secondtimers/rhema', { templateUrl : "second_timers/rhema"})
		.when('/secondtimers/report', { templateUrl : "second_timers/report"})
		// .when('/secondtimer/edit/:secondtimer_id', { templateUrl : "second_timers/register"})

		
		.when('/zone/create', { templateUrl : "zones/create"})
		.when('/zone/zonePage/:community_id', { templateUrl : "zones/zonePage"})


		.when('/cells/create', { templateUrl : "cells/create"})
		.when('/cell/edit/:cell_id', { templateUrl : "cells/create"})
		.when('/cells/cellPage/:zone_id', { templateUrl : "cells/cellPage"})


		.when('/teams/create', { templateUrl : "teams/create"})
		.when('/teams/', { templateUrl : "teams/teamPage"})
		.when('/team/edit/:team_id', { templateUrl : "teams/create" })


		.when('/department/create', { templateUrl : "departments/create"})
		.when('/departments/departmentPage', { templateUrl : "departments/departmentPage"})
		.when('/departments/departmentPage/:team_id', { templateUrl : "departments/departmentPage"})
		.when('/department/edit/:department_id', { templateUrl : "departments/create"})


		.when('/smallGroup/create', { templateUrl : "small_groups/create"})
		.when('/smallGroups/smallGroupPage', { templateUrl : "small_groups/small_group_page"})
		.when('/smallGroups/smallGroupPage/:department_id', { templateUrl : "small_groups/small_group_page"})


		.when('/group/members/add', { templateUrl : "sg_members/addMember"})
		.when('/group/members/:small_group_id', { templateUrl : "sg_members/members"})
		

		.when('/cell/members/add', { templateUrl : "cell_members/add"})
		.when('/cell/members/:cell_id', { templateUrl : "cell_members/members"})
		.when('/cell/members', { templateUrl : "cell_members/members"})

		.when('/cell/attendance', { templateUrl : "cell_attendance_manager/"})


		.when('/rhemacenter/firsttimers', { templateUrl : "first_timers/rhema"})


		.when('/service/create', { templateUrl : "services/create", title : "create Service"})
		.when('/service/edit/:service_id', { templateUrl: "services/create", title : "create Service"})
		.when('/service/manage/', { templateUrl: "services/manage", title : "create Service"})

		.when('/service/records/create', { templateUrl: "service_records/"})

		.when('/attendance/group/create', { templateUrl: "attendance_groups/createAttendanceView" })

		//.otherwise({ redirectTo  : 'dashboard'})
	}]) ;


	/**
	* jquery tab plugin
	* This is how you use a transform a jquery plugin into an angularJS directive
	* 
	*/
	app.directive('jTabs', function() {
	    return {
	        restrict: 'A',
	        link: function(scope, elm, attrs) {
	            var jqueryElm = $(elm[0]);
	            $(jqueryElm).tabs()
	        }
	    };
	})

	app.filter('datetime', function($filter){
		return function(input){
		  if(input == null){ return ""; } 
	
		  var _date = $filter('date')(new Date(input),'medium');         
		  return _date.toUpperCase();
		};
	});


})() ;

