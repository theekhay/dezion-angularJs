

<div class="container">
    <div class="row">

        <div class="col-md-8 col-lg-8 col-xl-4">
            <div class="activity-block success">
                <div class="media">
                    <div class="media-body" ng-controller='memberListController'>
                        <h5><span class="spincreament">{{members.length}}</span></h5>
                        <p>Total Members</p>
                    </div>
                    <i class="fa fa-users"></i> 
                </div>
                <br>

           <!--  <div class="media">
            <div class="media-body"><span class="progress-heading">Monthly progress</span></div>
            <span><span class="dynamicsparkline">Loading..</span> </span> </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"><span class="trackerball"></span></div>
            </div>
          </div> -->
          <i class="bg-icon text-center fa fa-users"></i> </div>
      </div>



      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block danger">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament">Workers</span></h5>
              <p>No workers yet</p>
            </div>
            <i class="fa fa-users"></i> </div>
          <br>
         <!--  <div class="media">
            <div class="media-body"><span class="progress-heading">Monthly progress</span></div>
            <span><span class="dynamicsparkline">Loading..</span> </span> </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="trackerball"></span></div>
            </div>
          </div> -->
          <i class="bg-icon text-center fa fa-users"></i> </div>
      </div>


      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block warning">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament">Connect Groups</span></h5>
              <p>No small Group</p>
            </div>
            <i class="fa fa-cart-arrow-down"></i> </div>
          <br>
         <!--  <div class="media">
            <div class="media-body"><span class="progress-heading">Monthly progress</span></div>
            <span><span class="dynamicsparkline">Loading..</span> </span> </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"><span class="trackerball"></span></div>
            </div>
          </div> -->
          <i class="bg-icon text-center fa fa-users"></i> </div>
      </div>



      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block primary">
          <div class="media">
            <div class="media-body" ng-controller="cellSlideController" >
              <h5><span class="spincreament" id="animate">Cells</span></h5>
              <p>{{current.name}}</p>
            </div>
            <i class="fa fa-comments"></i> </div>
          <br>
         <!--  <div class="media">
            <div class="media-body"><span class="progress-heading">Monthly progress</span></div>
            <span><span class="dynamicsparkline">Loading..</span> </span> </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="trackerball"></span></div>
            </div>
          </div> -->
          <i class="bg-icon text-center fa fa-comments"></i> </div>
      </div>


    </div>

    <!-- 2nd row Information TIles -->

    <!--
    <div class="row">
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block">
          <div class="media">
            <div class="media-body">
              <h5>$ <span class="spincreament">72548</span></h5>
              <p> Total Expenses</p>
            </div>
            <i class="fa fa-cubes"></i> </div>
          <br>
          <div class="media">
            <div class="media-body"><span class="progress-heading">Monthly progress</span></div>
            <span><span class="dynamicsparkline">Loading..</span> </span> </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"><span class="trackerball"></span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament">72548</span><span class="badge badge-danger ml-2 "><i class="fa fa-caret-down"></i></span></h5>
              <p>pending workers</p>
            </div>
            <i class="fa fa-users"></i> </div>
          <br>
          <div class="media">
            <div class="media-body"><span class="progress-heading">Monthly progress</span></div>
            <span><span class="dynamicsparkline">Loading..</span> </span> </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="trackerball"></span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament">2548</span><span class="badge badge-success ml-2 "><i class="fa fa-caret-up"></i></span></h5>
              <p>invoice issued</p>
            </div>
            <i class="fa fa-cart-arrow-down"></i> </div>
          <br>
          <div class="media">
            <div class="media-body"><span class="progress-heading">Monthly progress</span></div>
            <span><span class="dynamicsparkline">Loading..</span> </span> </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"><span class="trackerball"></span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament">1548</span></h5>
              <p>accepted emails</p>
            </div>
            <i class="fa fa-comments"></i> </div>
          <br>
          <div class="media">
            <div class="media-body"><span class="progress-heading">Monthly progress</span></div>
            <span><span class="dynamicsparkline">Loading..</span> </span> </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="trackerball"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    -->

<div class="row" >
      <div class="col-md-16 col-lg-16 col-xl-8">
        <div class="card full-screen-container" ng-controller='weekFirstTimers'>
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">First Timers <small>This Week</small></h5>
            <ul class="nav nav-pills card-header-pills pull-right">
        
            </ul>
          </div>
          <div class="card-block">
            <div class="list-unstyled member-list row">

              <div class="col-lg col-sm-8 col-xs-16 " ng-repeat="ft in firsttimers | limitTo : limit : begin" >
                <div class="media flex-column "> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">{{ft.surname}} {{ft.firstname}}</h6>
                    {{$ft.address}}
                    <p class="description">{{ft.next_step}}</p>
                  </div>
                  <div class="overlay align-items-center">
                    <!-- <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
                    <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button> -->
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>

       <div class="col-md-16 col-lg-16 col-xl-8">
        <div class="card full-screen-container" ng-controller='in_week'>
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Second Timers <small>This Week</small></h5>
            <ul class="nav nav-pills card-header-pills pull-right">
        
            </ul>
          </div>
          <div class="card-block">
            <div class="list-unstyled member-list row">

              <div class="col-lg col-sm-8 col-xs-16 " ng-repeat="st in secondtimers | limitTo: limit" >
                <div class="media flex-column "> <span class="message_userpic"><img class="d-flex mr-3" src="<?= $demo_path; ?>css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">{{st.surname}} {{st.firstname}}</h6>
                    {{st.address}}
                    <p class="description">{{st.next_step}}</p>
                  </div>
                  <div class="overlay align-items-center">
                    <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
                    <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" ng-controller="firsttimersReportController" >
      <div class="col-sm-16">
         <div class="card">

            <div class="card-header">
               <h5 class="card-title  pull-left">Monthly Count<small> {{quarterName}}</small></h5>
               <ul class="nav nav-pills card-header-pills">
                  <li class="nav-item">
                     <button class="btn btn-sm btn-link btn-round" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chevron-down"></i></button>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:" 
                           ng-class="{disabled: customSelection}"
                           ng-click="customSelection || updatePeriod('full')">Full Year</a>

                        <a class="dropdown-item" href="javascript:" 
                           ng-class="{disabled: customSelection}" 
                           ng-click="customSelection || updatePeriod('current')">This Quarter</a>

                        <a class="dropdown-item" href="javascript:" 
                           ng-class="{disabled: customSelection}" 
                           ng-click="customSelection || updatePeriod('previous')">Last Quarter</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="javascript:" 
                           ng-class="{disabled: customSelection}" 
                           ng-click="customSelection || updatePeriod('1')">1st Quarter</a> 

                        <a class="dropdown-item" href="javascript:" 
                           ng-class="{disabled: customSelection}" 
                           ng-click="customSelection || updatePeriod('2')">2nd Quarter</a> 

                        <a class="dropdown-item" href="javascript:" 
                           ng-class="{disabled: customSelection}" 
                           ng-click="customSelection || updatePeriod('3')">3rd Quarter</a> 

                        <a class="dropdown-item" href="javascript:" 
                           ng-class="{disabled: customSelection}" 
                           ng-click="customSelection || updatePeriod('4')">4th Quarter</a> 

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:" ng-class="{disabled: true}" >custom Query</a>

                     </div>&nbsp;
                  </li>

                  <ul class="nav nav-pills card-header-pills pull-right">

                     <li class="nav-item"><datepicker date-format="yyyy-MM-dd" ng-show="customSelection" >
                           <input   class="form-control" 
                                   type="date" placeholder="start date" 
                                   id="service_date" 
                                   ng-model='custom_select.start_date'
                                   required readonly style="background-color: transparent;" />
                        </datepicker></li>&nbsp;

                     <li class="nav-item"><datepicker date-format="yyyy-MM-dd" ng-show="customSelection">
                           <input   class="form-control" 
                                   type="date" placeholder="end date" 
                                   id="service_date" 
                                   ng-model='custom_select.end_date'
                                   required readonly style="background-color: transparent;" />
                        </datepicker></li>
                     <li class="nav-item">
                        <button title="toggle between graphical and tabular view" class="btn btn-sm btn-outline-success btn-round"><i class="fa fa-print"></i> <span class="text" ng-click='switchView()'>Switch View</span></button>
                     </li>
                  </ul>
               </ul>
            </div>

            <div class="card-block">
                <div  fusioncharts 
                     type="msspline"  
                     width="100%"
                     height="400"
                     dataFormat="json" 
                     chart="{{attrs}}"
                     categories="{{categories}}"
                     dataset="{{dataset}}">
                                 
               </div>
            </div>

            <div class="card-footer"></div>
         </div>
      </div>
   </div>


    <div class="row">
      <div class="col-md-16 col-lg-8 col-xl-8">
        <div class="card full-screen-container" style="max-height: 400px !important; min-height: 400px !important" >
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Activity <small>This Week</small></h5>
            <ul class="nav nav-pills card-header-pills pull-right">
              
            </ul>
          </div>
           <div class="card-block">
              <div class="list-unstyled comment-list timeline" >
                <div class="media">
                  <div class="indication text-success"><i class="fa fa-dot-circle-o"></i></div>
                  <div class="media-body">
                    <h6 class="mb-1">Hurray!!! Dezion goes live today <small> - Admin</small></h6>
                    11min ago </div>
                </div>

                <!-- <div class="media">
                  <div class="indication text-warning"><i class="fa fa-dot-circle-o"></i></div>
                  <div class="media-body">
                    <h6 class="mb-1">Today’s top 50 international songs we all love once in life <small> - Trinity ever trends</small></h6>
                    11min ago </div>
                </div>
                <div class="media">
                  <div class="indication text-success"><i class="fa fa-dot-circle-o"></i></div>
                  <div class="media-body">
                    <h6 class="mb-1">Resolving error done in main server port<small> - jUnction center, NJ</small></h6>
                    11min ago </div>
                </div> -->

                <div class="media">
                  <div class="indication text-warning"><i class="fa fa-dot-circle-o"></i></div>
                  <div class="media-body">
                    <h6 class="mb-1">Application updates coming soon <small> - Admin</small></h6>
                    11min ago </div>
                </div>
              </div>
          </div>
          <!-- <div class="card-footer text-center"> <a href="#" >View all...</a> </div> -->
        </div>
    </div>


      <div class="col-md-16 col-lg-8 col-xl-8">
        <div class="card full-screen-container" ng-controller="eventListController" style="max-height: 400px !important; min-height: 400px !important" >
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Upcoming Events</h5>
            <ul class="nav nav-pills card-header-pills pull-right">
              <!-- <li class="nav-item">
                <button class="btn btn-sm btn-outline-success btn-round"><i class="fa fa-save"></i> <span class="text">Save</span></button>
              </li>
              <li class="nav-item">
                <button class="btn btn-sm btn-link btn-round fullscreen-btn"><i class="fa fa-arrows-alt"></i></button>
              </li>
              <li class="nav-item">
                <button class="btn btn-sm btn-link btn-round" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chevron-down"></i></button>
                <div class="dropdown-menu"> <a class="dropdown-item" href="#"><i class="fa fa-calendar mr-2"></i>Quarter 1</a> <a class="dropdown-item" href="#"><i class="fa fa-calendar mr-2"></i>Quarter 2</a> <a class="dropdown-item" href="#"><i class="fa fa-calendar mr-2"></i>Quarter 3</a> <a class="dropdown-item" href="#"><i class="fa fa-calendar mr-2"></i>Quarter 4</a> </div>
              </li> -->
            </ul>
          </div>

          <!-- EVENTS TAB -->
          <div class="card-block" >
            <div class="list-unstyled comment-list" style="height:400px;">

              <div ng-repeat="ev in events" class="media"> <span class="form-check" >
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input">
                  <i class="fa fa-check"></i></label>
                </span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">{{ev.title}}<small class="pull-right"></small></h6>
                  {{ev.start}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    

    <div class="row" ng-app='members'>
      <div class="col-sm-16">
        <div class="card" >
          <div class="card-header">
            <h5 class="card-title">Upcoming Birthdays<small> Today</small></h5>
          </div>
          <div class="card-block" ng-controller="birthdayController">

            <table class="table " id="dataTables-example" ng-show="birthdays.length > 0">
              <thead>
                <tr>
                  <th>Name  </th>
                  <th>Email</th>
                  <th>Phone</th>
                </tr>
              </thead>
              <tbody>

                <tr ng-repeat= "birthday in birthdays" ng-class="{even: !$even, odd: !$odd}" >
                  
                  <td>{{birthday.surname + " " + birthday.firstname}}</td>
                  <td>{{birthday.email}}</td>
                  <td>{{birthday.telephone1}}</td>
                </tr>
      
              </tbody>
            </table>
            
            <p ng-hide="birthdays.length > 0">Loading...</p>
          </div>
        </div>
      </div>
    </div>

  </div>
 