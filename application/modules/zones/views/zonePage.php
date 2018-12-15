

<div class="container">
   <div class="row">
      <div class="col-sm-16">
         <div class="card" ng-controller="manageZoneController">
            <div class="card-header">
               <h5 class="card-title"> Zones in {{communityInfo.name}} community</h5>
            </div>

            <div class="card-block" >
               <table class="table " id="dataTables-example"  ng-hide="zones.length <= 0">

                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Zone Name</th>
                        <th>Zone Abbrevation</th>
                        <!-- <th>Community</th> -->
                        <th>Leader</th>
                        <th>No of Cells</th>
                        <th>Actions</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr ng-repeat = "zone in zones | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                        <td>{{$index + 1}}</td>
                        <td>{{zone.name}}</td>
                        <td>{{zone.abbrevation}}</td>
                        <!-- <td>{{communityInfo.name}}</td> -->
                        <td full-name member-id="zone.leader" ></td>
                        <td cells-in-zone zone-id="zone.id"></td>

                        <td class="center">
                          <a href="#!/cells/cellPage/{{zone.id}}" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> 
                          <a href="javascript:" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                          <a href="javascript:" ng-click="delete(zone)" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                          <!-- <a  href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a> -->
                        </td>
                     </tr>


                
              </tbody>
            </table>

            <p ng-show="zones.length <= 0">No Zone in this Community.</p>

          </div>
        </div>
      </div>
    </div>
  </div>