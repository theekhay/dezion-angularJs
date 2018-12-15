



<div class="container" ng-controller="managegroupController"> 
   <div class="row">
      <div class="col-sm-16">

         <div class="card">

            <div class="card-header">
               <h5 class="card-title">Groups in {{departmentInfo.name}} </h5>
            </div>

            <div class="card-block" >

               <div class="form-group row" >
                  <div class="col-sm-4">
                    <input type="text" name="search" ng-model="search"  class="form-control" placeholder="search Groups" />
                  </div>

                  <!-- <div class="col-sm-offset-4 col-sm-4 pull-right">
                    <button type="button" class="btn btn-outline-primary" >Create Group</button>
                  </div> -->

               </div>

               <table class="table table-hover table-condensed" id="dataTables-example" ng-show="groups.length > 0">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Group Name</th>
                        <th>Abbrevation</th>
                        <th>Group Head</th>
                         <th>Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat = "group in groups | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                        <td>{{$index + 1}}</td>
                        <td>{{group.name}}</td>
                        <td>{{group.abbrevation}}</td>
                        <td full-name member-id="group.leader"></td>
                        <td>{{group.status}}</td>

                        <td class="center">
                           <a href="#!/group/members/{{group.id}}" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> 
                           <a href="#!/group/edit/{{group.id}}" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                           <a href="javascript:" ng-click="delete(group)" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                           <!-- <a  href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a> --> 
                        </td>

                     </tr> 
                  </tbody>
               </table>

            <p ng-show="groups.length <= 0">No Group to show...</p>
            </div>
         </div>
      </div>
   </div>
</div>