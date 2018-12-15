



<div class="container" ng-controller="manageDepartmentController">
   <div class="row">
      <div class="col-sm-16">

         <div class="card">
            <div class="card-header">
               <h5 class="card-title">Departments in {{teamInfo.name}} </h5>
            </div>

         <div class="card-block">

            <div class="form-group row" >
               <div class="col-sm-4">
                 <input type="text" name="search" ng-model="search"  class="form-control" placeholder="search Team" />
               </div>
            </div>

            <table class="table table-hover table-condensed" id="dataTables-example" ng-show="departments.length > 0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Department Name</th>
                  <th>Abbrevation</th>
                  <th>Department Head</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat = "department in departments | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                  <td>{{$index + 1}}</td>
                  <td>{{department.name}}</td>
                  <td>{{department.abbrevation}}</td>
                  <td full-name member-id="department.head"></td>

                  <td class="center">
                    <a href="#!/smallGroups/smallGroupPage/{{department.id}}" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> 
                    <a href="#!/department/edit/{{department.id}}" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                    <a href="javascript:" ng-click="delete(department)" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                   <!--  <a  href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a> --> 
                  </td>
                </tr>

                
              </tbody>
            </table>

            <p ng-show="departments.length <= 0">No Departments to show...</p>
          </div>
        </div>
      </div>
    </div>
  </div>