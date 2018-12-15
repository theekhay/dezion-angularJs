
<div class="container" ng-controller="firsttimersReportController" >

   <div class="row">
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


<!-- <ft-report  type="msspline"  
            width="100%"
            height="400"
            data-format="json" 
            chart="{{attrs}}"
            categories="{{categories}}"
            dataset="{{dataset}}" ></ft-report> -->

   <!--here-->

   <!-- <div class="row">
      <div class="col-sm-16" >
         <div class="card full-screen-container">
            <div class="card-header align-items-start justify-content-between flex">
               <h5 class="card-title  pull-left">Assimilation Statisics<small> {{quarterName}}</small></h5>
               <ul class="nav nav-pills card-header-pills">
                  <li class="nav-item">
                     <button class="btn btn-sm btn-link btn-round" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chevron-down"></i></button>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:" ng-click="updatePeriod('full')">Full Year</a>
                        <a class="dropdown-item" href="javascript:" ng-click="updatePeriod('current')">This Quarter</a>
                        <a class="dropdown-item" href="javascript:" ng-click="updatePeriod('previous')">Last Quarter</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:" ng-click="updatePeriod('1')">1st Quarter</a> 
                        <a class="dropdown-item" href="javascript:" ng-click="updatePeriod('2')">2nd Quarter</a> 
                        <a class="dropdown-item" href="javascript:" ng-click="updatePeriod('3')">3rd Quarter</a> 
                        <a class="dropdown-item" href="javascript:" ng-click="updatePeriod('4')">4th Quarter</a> 
                     </div>
                  </li>

                  <ul class="nav nav-pills card-header-pills pull-right">
                     <li class="nav-item">

                        <button class="btn btn-sm btn-outline-success btn-round"><i class="fa fa-print"></i> <span class="text">Switch View</span></button>
                     </li>
                  </ul>
               </ul> 
          </div>
         <div class="card-block">
               <div  fusioncharts 
                     type="msspline"  
                     width="100%"
                     height="400"
                     chart="{{attrs}}"
                     categories="{{categories}}"
                     dataset="{{assimlated}}"">
                                 
               </div>

               <p style="margin-top: 10px"><label>% Assimilation (This Year) : 19% </label>  <label>% Assimilation (Last Year) : 17.6%</label></p>
               <p></p>
            </div>
        </div>
      </div>
     
    </div> --> 
   
   

  <!--  <div class="row">
      <div class="col-sm-16">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title">Manage District</h5>
            </div>
            <div class="card-block">

               <table class="table " id="dataTables-example" ng-controller="firsttimersReportController" >
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>District Name</th>
                        <th>District Code</th>
                        <th>District Pastor</th>
                        <th>No of Communities</th>
                        <th>No of Zones</th>
                        <th>No of Cells</th>
                        <th>No of Members</th>
                        <th>Overall average attendance</th>
                        <th>Overall average member growth</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat = "community in district" ng-class="{even: !$even, odd: !$odd}" >
                        <td>8</td>
                        <td>Charles</td>
                        <td>008</td>
                        <td>Femi Oyefesse</td>
                        <td>8</td>
                        <td>21</td>
                        <td>21</td>
                        <td>21</td>
                        <td>21</td>
                        <td>21</td>                 
                     </tr>
                  </tbody>
               </table>

               <p ng-hide="communityReport > 1">No data.</p>
            </div>
         </div>
      </div>
   </div>  --> 
</div>

