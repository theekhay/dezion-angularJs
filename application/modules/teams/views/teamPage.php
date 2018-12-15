


<div class="container" ng-controller="manageTeamsController">
    <div class="row">
      <div class="col-sm-16">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Teams </h5>
          </div>
          <div class="card-block" >

            <div class="form-group row" >
            <div class="col-sm-4">
              <input type="text" name="search" ng-model="search"  class="form-control" placeholder="search Team" />
            </div>
          </div>

            <table class="table table-hover table-condensed" id="dataTables-example" ng-show="teams.length > 0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Team Name</th>
                  <th>Abbrevation</th>
                  <th>Team Head</th>
                  <th>Number of Departments</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat = "team in teams | filter : search" ng-hide="team.deleted == 1" ng-class="{even: !$even, odd: !$odd}" >
                  <td>{{$index + 1 }}</td>
                  <td>{{team.name}}</td>
                  <td>{{team.abbrevation}}</td>
                  <td full-name member-id="team.head" ></td>
                  <td depts-in-team team-id="team.id"></td>

                  <td class="center">
                    <a href="#!/departments/departmentPage/{{team.id}}" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> 
                    <a href="#!/team/edit/{{team.id}}" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                    <a href="javascript:" ng-click="delete(team)" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                    <!-- <a  href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a> --> 
                  </td>
                </tr>

                
              </tbody>
            </table>

            <p ng-show="team.length <= 0">No Teams to show...</p>
          </div>
        </div>
      </div>
    </div>
  </div>