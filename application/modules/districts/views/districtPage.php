

<div class="container" ng-app="communityApp">
   <div class="row">
      <div class="col-sm-16">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title">Communities in {{community.district.name}} Districts</h5>
            </div>

               <div class="card-block" ng-controller = 'manageCommunityController'>

               <div class="form-group row" >
                  <div class="col-sm-4">
                    <input type="text" name="search" ng-model="search"  class="form-control" placeholder="search " />
                  </div>
               </div>

               <table class="table " id="dataTables-example">

                  <thead>
                     <tr>
                        <th>S/N</th>
                        <th>Community Name</th>
                        <th>Community Abbrevation</th>
                        <th>Community Leader</th>
                        <th>Date Created</th>
                        <!-- <th>No of Communities</th> -->
                        <th>Actions</th>
                     </tr>
                  </thead>

                  <tbody ng-init="count=0">
                     <tr ng-repeat = "community in district | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                        <td>{{count + 1 }}</td>
                        <td>{{ community.name }}</td>
                        <td>{{ community.abbr }}</td>
                        <td>{{ community.leader }}</td>
                        <td>{{ community.date_created | date : 'dd MMM, yyyy'}}</td>

                        <td class="center">
                          <a href="#/communities/report/{{community.id}}" class="btn btn-link btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="#" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                          <a href="#" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                          <!-- <a href="#" class="btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a>  -->
                        </td>
                     </tr> 
                  </tbody>
               </table>
               
            </div>
         </div>
      </div>
   </div>
</div>

  