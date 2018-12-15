
<div class="container">
   <div class="row">
      <div class="col-sm-16">
         <div class="card" ng-controller="manageRolesController" >
            <div class="card-header">
               <h5 class="card-title">Manage Roles</h5>
            </div>

            <div class="card-block" >
               <table class="table table-hover" id="dataTables-example" ng-hide="roles.length <= 0" >
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Role Title</th>
                        <th>Role Abbrevation</th>
                        <th>Created By</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat = "role in roles " ng-class="{even: !$even, odd: !$odd}" >

                        <td>{{$index + 1}}</td>
                        <td>{{role.name}}</td>
                        <td>{{role.abbrevation}}</td>
                        <td admin-full-name admin-id="role.created_by" ></td>
                        <td>{{role.date_created}}</td>
                        <td>{{ ( role.active == true  ) ? 'active' : "Not active" }}</td>

                        <!-- actions -->
                        <td class="center">
                           <!-- <a href="#!/cell/members/{{cell.id}}" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> 
                           <a href="#!/cell/edit/{{cell.id}}" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> --> 
                           <a href="javascript:" ng-click="delete(role)" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                          <!--  <a href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a>
 -->                        </td>
                     </tr>
                  </tbody>
               </table>

               <p ng-show="roles.length <= 0" >No Roles to show.</p>

            </div>
         </div>
      </div>
   </div>
</div>