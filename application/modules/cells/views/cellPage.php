
<div class="container">
   <div class="row">
      <div class="col-sm-16">
         <div class="card" ng-controller="manageCellController" >
            <div class="card-header">
               <h5 class="card-title">cells in {{zoneInfo.name}} zone </h5>
            </div>

            <div class="card-block" >
               <table class="table table-hover" id="dataTables-example" ng-hide="cells.length <= 0" >
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Cell Address</th>
                        <th>Cell Leader</th>
                        <th>Cell Name</th>
                        <th>Cell Abrrevation</th>
                        <th>Number of Members</th>
                        <th>Actions</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat = "cell in cells | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                        <td>{{$index + 1}}</td>
                        <td>{{cell.address}}</td>
                        <td full-name member-id="cell.leader" ></td>
                        <td>{{cell.name}}</td>
                        <td>{{cell.abbrevation}}</td>
                        <td members-in-cell cell-id='cell.id'></td>

                        <!-- actions -->
                        <td class="center">
                           <a href="#!/cell/members/{{cell.id}}" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> 
                           <a href="#!/cell/edit/{{cell.id}}" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                           <a href="javascript:" ng-click="delete(cell)" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                          <!--  <a href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a>
 -->                        </td>
                     </tr>
                  </tbody>
               </table>

               <p ng-show="cells.length <= 0" >No Cell in this Zone.</p>

            </div>
         </div>
      </div>
   </div>
</div>