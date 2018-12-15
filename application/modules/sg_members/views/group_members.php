
<div class="container">
   <div class="row">
      <div class="col-sm-16">
         <div class="card" ng-controller="groupMembersListController" >
            <div class="card-header">
               <h5 class="card-title">Members in {{groupInfo.name}}  </h5>
            </div>

            <div class="card-block" >
               <table class="table " id="dataTables-example" ng-hide="members.length <= 0" >
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
                        <td>1</td>
                        <td>{{m.member_id}}</td>
                        <td>{{m.date_joined}}</td>
                        <td>{{m.confirmed == 1 ? "confrimed" : "unconfrimed" }}</td>

                        <td class="center"><a href="#" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> <a href="#" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="#" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> <a  href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a> </td>
                     </tr>
                  </tbody>
               </table>

               <p ng-show="members.length <= 0" >No member in this small group.</p>

            </div>
         </div>
      </div>
   </div>
</div>