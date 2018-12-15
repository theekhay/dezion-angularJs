



	<div class="container" ng-app="districtApp">
		<div class="row">
			<div class="col-sm-16">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Manage Districts</h5>
					</div>
					<div class="card-block" ng-controller = 'manageDistrictController'>

					<div class="form-group row" >
						<div class="col-sm-4">
							<input type="text" name="search" ng-model="search"  class="form-control" placeholder="search Districts" />
						</div>
					</div>

						<table class="table" id="dataTables-example" ng-show="districts.length > 0">
							<thead>
								<tr>
									<th>#</th>
									<th>District Name</th>
									<th>District Abbrevation</th>
									<th>District Pastor</th>
									<th>Date Created</th>
									<!-- <th>No of Communities</th> -->
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat = "district in districts | filter : search" ng-class="{even: !$even, odd: !$odd}" >
									<td>{{$index + 1}}</td>
									<td>{{ district.name }}</td>
									<td>{{ district.abbrevation }}</td>
									<td full-name member-id="district.pastor" ></td>
									<td>{{ district.date_created | date : 'dd MMM, yyyy'}}</td>

									<td class="center">
										<a href="#!/community/communityPage/{{district.id}}" class="btn btn-link btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
										<a href="#!/district/edit/{{district.id}}" class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
										<a href="javascript:" ng-click="delete(district)" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> <!-- #/districts/report/{{district.id}} -->
										<!-- <a href="#" class="btn btn-link btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></a>  -->
									</td>
								</tr>

								
							</tbody>
						</table>

						<p ng-hide ="districts.length > 0">Loading...</p>
					</div>
				</div>
			</div>
		</div>
	</div>


<div class="modal fade terms" >
  <div class="modal-dialog">
    <div class="modal-content">


      <div class="modal-body">
        <p style="font-family: sans-serif;">Notice : You need to agree to ours terms and conditions to sign up.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	