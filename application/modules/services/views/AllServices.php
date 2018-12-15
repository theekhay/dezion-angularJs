



<div class="container" ng-controller="manageServiceController">
   <div class="row">
      <div class="col-sm-16">

         <div class="card">
            <div class="card-header">
               <h5 class="card-title">Services</h5>
            </div>

         <div class="card-block" >

            <div class="form-group row" >
               <div class="col-sm-4">
                 <input type="text" name="search" ng-model="search"  class="form-control" placeholder="search Services" />
               </div>
            </div>

            <table class="table table-hover table-condensed" id="dataTables-example" ng-show="services.length > 0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Service Name</th>
                  <th>Abbrevation</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat = "service in services | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                  <td>{{$index + 1}}</td>
                  <td>{{service.name}}</td>
                  <td>{{service.abbrevation}}</td>

                  <td class="center">
                    <a href="#/smallGroups/smallGroupPage/{{department.id}}" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> 
                    <a href="#/service/edit/{{service.id}}" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                    <a href="javascript:" ng-click="delete(service)" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                   <!--  <a  href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a> --> 
                  </td>
                </tr>

                
              </tbody>
            </table>

            <p ng-show="services.length <= 0">No Service component to show... <a href="#/service/create">Create here</a> </p>
          </div>
        </div>
      </div>
    </div>
  </div>