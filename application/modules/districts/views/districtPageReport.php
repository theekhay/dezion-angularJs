 

<div class="container">

   <div class="row">
      <div class="col-sm-16">
         <div class="card">

            <div class="card-header">
               <h5 class="card-title  pull-left">General Statistics <small>This Quarter</small></h5>
            </div>

            <div class="card-block">
               <div id="district-general-statistics" class="morris-text-color"></div>
            </div>

            <div class="card-footer"></div>
         </div>
      </div>
   </div>
   
   <div class="row">  

      <div class="col-sm-16" ng-controller="districtReportController">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title  pull-left">Avg. Monthly Assimilation <small>This Quarter </small></h5>
            </div>

            <div class="card-block">
               <div  fusioncharts 
                     type="column2d"  
                     width="100%"
                     height="400"
                     dataFormat="json" 
                     dataSource = "{{myDataSource}}">
                                 
               </div>
            </div>
            <div class="card-footer"></div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-sm-16">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title">Manage District</h5>
            </div>
            <div class="card-block">

               <table class="table " id="dataTables-example" ng-controller="districtReportController" ng-show="communityReport > 1">
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
   </div>  
</div>

