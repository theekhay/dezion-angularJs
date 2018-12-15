
<div class="container">
   <div class="row">
      <div class="col-sm-16">
         <div class="card" ng-controller="manageAdminController" >
            <div class="card-header">
               <h5 class="card-title">Manage Users </h5>
            </div>

            <div class="card-block" >
               <table class="table table-hover" id="dataTables-example" ng-hide="administrators.length <= 0" >
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Role</th>
                        
                        <th>Actions</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat = "admin in administrators | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                        <td>{{ $index + 1 }}</td>
                        <td full-name member-id="admin.member_id" ></td>
                        <td role-name role-id="admin.role_id"></td>
                        

                        <!-- actions -->
                        <td class="center">
                           <a href="javascript:" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> 
                           <a href="javascript:" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                           <a href="javascript:" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                     </tr>
                  </tbody>
               </table>

               <p ng-show="administrators.length <= 0" >No User created yet.</p>

            </div>
         </div>
      </div>
   </div>
</div>