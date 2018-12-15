<script>

  $(document).ready(function(){
      delete_icon = $('.fa-trash') ;

      delete_icon.bind('click', function(){
          alert( "here" ) ;
      })
  })
</script>


<div class="container" ng-controller="manageCommunityController">
    <div class="row">
      <div class="col-sm-16">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">communities in {{districtInfo.name}} distrcit</h5>
          </div>
          <div class="card-block" >
            <table class="table table-hover table-condensed" id="dataTables-example" ng-show="communities.length > 0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Community Name</th>
                  <th>Abbrevation</th>
                  <th>Community Leader</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat = "community in communities | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                  <td>{{$index + 1}}</td>
                  <td>{{community.name}}</td>
                  <td>{{community.abbrevation}}</td>
                  <td full-name member-id="community.leader" ></td>

                  <td class="center">
                    <a href="#!/zone/zonePage/{{community.id}}" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a> 
                    <a href="#!/community/edit/{{community.id}}" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                    <a href="javascript:" ng-click="delete(community)" class="btn btn-link btn-sm"><i  class="fa fa-trash" aria-hidden="true"></i></a> 
                    <!-- <a  href="#" class=" btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a> --> 
                    </td>
                </tr>

                
              </tbody>
            </table>

            <p ng-show="communities.length <= 0">No Communities to show...</p>
          </div>
        </div>
      </div>
    </div>
  </div>