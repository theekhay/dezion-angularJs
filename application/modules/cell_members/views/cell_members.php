
<div class="container">
   <div class="row">
      <div class="col-sm-16">
         <div class="card" ng-controller="cellMembersListController" >
            <div class="card-header">
               <h5 class="card-title">Members in {{cellInfo.name}} cell </h5>
            </div>

            <div class="card-block" >
               <table class="table " id="dataTables-example" ng-show="members.length >= 1" >
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date Joined</th>
                        <th>Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat = "m in members | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                        <td>{{$index + 1}}</td>
                        <td>{{m.name}}</td>
                        <td>{{m.date_joined}}</td>
                        <td>{{m.status}}</td>

                        <td class="center">
                           <!-- <a href="#" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> --> 
                           <!-- <a href="#" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> --> 
                           <a href="javascript:" ng-click='delete()' class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                           <!-- <a  href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a> --> 
                        </td>
                     </tr>
                  </tbody>
               </table>

               <p ng-hide="members.length >= 1" >No Member in this cell.</p>

            </div>
         </div>
      </div>
   </div>
</div>