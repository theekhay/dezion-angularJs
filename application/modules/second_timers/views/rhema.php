
<div class="container"  ng-controller="srhemaController" >

    <div class="form-group row" style="margin-top: 30px">
      <div class="col-sm-3 col-sm-offset-6">
        <select  name="search"  class="form-control" ng-model="currentYear" >
        <?php foreach($years as $key => $value): ?>
        <option value="<?= $value?>" ><?= $value ?></option>
      <?php endforeach ?>
        </select>
      </div>

      <div class="col-sm-3">
        <select name="month" class="form-control" ng-model="currentMonth" >
        <?php foreach($months as $month): ?>
          <?php //if($month->value <= $this->date_time->month() ): ?>
            <option value="<?= $month->value ?>" ><?= $month->name; ?></option>
          <?php //endif; ?>  
        <?php endforeach; ?>
        </select>
      </div>

    </div>

    <div class="row">
      <div class="col-sm-16">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Manage Second timers</h5>
          </div>
          <div class="card-block"  >

            <div class="form-group row" >
               <div class="col-sm-4">
                 <input type="text" name="search" ng-model="search"  class="form-control" placeholder="search Second timers" />
               </div>
            </div>

            <table class="table " id="dataTables-example" ng-show ="secondtimers.length >= 1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>UID</th>
                  <th>Fullname</th>
                  <th>Phone number</th>
                  <th>Dob</th>
                  <th>Address</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               
                <tr ng-repeat = "st in secondtimers | filter : search" ng-class="{even: !$even, odd: !$odd}" >
                  <td>{{$index + 1}}</td>
                  <td><i class="fa fa-circle" ng-class="{success : st.prospective == 1, danger : st.prospective == 0}" ></i> {{ st.uid}}</td>
                  <td>{{st.surname + " " + st.firstname}}</td>
                  <td>{{st.telephone1}}</td>
                  <td class="center">{{st.dob}}</td>
                  <td class="center"><span>{{st.address}}</span></td>
                  <td class="center">
                    <a href="javascript:" ng-click="test(st.id)" class=" btn btn-link btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <!-- <a href="#/secondtimer/edit/{{st.id}}"  class="btn btn-link btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
                    <a href="javascript:" class="btn btn-link btn-sm"><i ng-click="delete(st)" class="fa fa-trash" aria-hidden="true"></i></a> 
                  </td>
                </tr>
              </tbody>
            </table>

            <p ng-show ="secondtimers.length < 1">No Second timer record for this month</p>
          </div>
        </div>
      </div>
    </div>
</div>