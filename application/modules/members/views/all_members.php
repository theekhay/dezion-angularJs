



<div class="container" ng-app="members">
   <div class="row  align-items-center justify-content-between"></div>
   	<!-- <div class="row">
      	<div class="col-16">
        		<div class="card full-screen-container">
          		<div class="card-header align-items-start justify-content-between flex">
            		<h5 class="card-title  pull-left">First Time Members <small>This Week</small></h5>
          		</div>

          		<div class="card-block">
            		<div class="list-unstyled member-list row">

              		<div class="col-lg-4 col-sm-8 col-xs-16 ">
                		<div class="media flex-column "> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/team.png"

                			alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  		<div class="media-body">
                    			<h6 class="mt-0 mb-1">Astha Smith</h6>
                    				New Jersey, UK
                    			<p class="description">This is awesome product and, I am very happy</p>
                  		</div>

                  		<div class="overlay align-items-center">
                    			<button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
                    			<button class="btn btn-danger btn-round "><i class="fa fa-close"></i></button>
                  		</div>
                		</div>
              </div>
              <div class="col-lg-4 col-sm-8 col-xs-16 ">
                <div class="media flex-column "> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/team.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">Rahul Akshay </h6>
                    New Jersey, UK
                    <p class="description">This is awesome product and, I am very happy</p>
                  </div>
                  <div class="overlay align-items-center">
                    <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
                    <button class="btn btn-danger btn-round "><i class="fa fa-close"></i></button>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-sm-8 col-xs-16 ">
                <div class="media flex-column "> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/team.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">Rocky Jolly</h6>
                    New Jersey, UK
                    <p class="description">This is awesome product and, I am very happy</p>
                  </div>
                  <div class="overlay align-items-center">
                    <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
                    <button class="btn btn-danger btn-round "><i class="fa fa-close"></i></button>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-sm-8 col-xs-16 ">
                <div class="media flex-column "> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/team.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">Astha Smith</h6>
                    New Jersey, UK
                    <p class="description">This is awesome product and, I am very happy</p>
                  </div>
                  <div class="overlay align-items-center">
                    <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
                    <button class="btn btn-danger btn-round "><i class="fa fa-close"></i></button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div> -->
    <div class="row" >
      <div class="col-sm-16">
        <div class="card">
          	<div class="card-header">
            <h5 class="card-title">Manage Members</h5>
          </div>

          <div class="card-block" ng-controller="memberListController" >

          	<div class="form-group row" >
      			<div class="col-sm-4">
         			<input type="text" name="search" ng-model="searchText"  class="form-control" placeholder="search member" />
         		</div>
         	</div>

            <table class="table table-hover" id="dataTables-example-members" ng-show='members.length > 1'  >
              <thead>
                <tr>
                  <th>#</th>
                  <th>UID </th>
                  <th>Name </th>
                  <th>Email</th>
                  <th>Telephone1</th>
                  <th>Address</th>
                 <!--  <th>Marital Status</th>
                  <th>Dob</th> -->
                  <th>Actions</>
                </tr>
              </thead>
              <tbody>

                <tr  ng-repeat="member in members | filter: searchTest | limitTo : 50 "  ng-class="{even: !$even, odd: !$odd}">
                  <td>{{$index + 1}}</td>
                  <td> {{member.uid }} </td>	
                  <td> {{member.firstname + " " + member.surname }} </td>
                  <td> {{member.email }} </td>
                  <td> {{member.telephone1}} </td>
                  <td> {{member.address}} </td>
                  <!-- <td> {{member.marital_status}} </td>
                  <td> {{member.dob | date : 'dd, MMM'}} </td> -->

                  <td class="center">

                    <!-- This link should take you to a member info page, tht would display allinfoo-->
                    <!-- <a href="#" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> --> 
                    <a href="#!/member/edit/{{member.id}}" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                    <a href="javascript:" ng-click="delete(member)" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                  </td>
                </tr>

              </tbody>
            </table>
            
            <p ng-show="members.length < 1">Loading...</p>

            <!-- <p ng-hide="searchText.length &gt; 3 && searchFound == false"> No result for your search </p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  