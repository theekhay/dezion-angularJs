

<div class="container" ng-controller='createDepartmentController'>
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">{{action}} Department</h6>
            </div>

            <div class="card-block"  >

               <form name="createDepartmentForm" ng-submit="create()" novalidate autocomplete="off">

                  <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label">Department Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Department Name" 
                                 id="name" name="name" 
                                 ng-maxlength = '50' maxlength="50" 
                                 ng-model ='department.name' 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="abbrevation" class="col-sm-4 col-form-label">Department Abbrevation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" placeholder="Department Abbrevation" 
                                 id="abbrevation" name="abbrevation" 
                                 ng-model ='department.abbrevation'
                                 ng-maxlength = '6' maxlength="6" 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row" ng-controller='manageTeamsController'>
                     <label for="team" class="col-sm-4 col-form-label">Select Team</label>
                     <div class="col-sm-12">
                        <select  class="custom-select form-control" 
                                 id="team" name="team" 
                                 ng-model='department.team'
                                 ng-options = "t.id as t.name for t in teams" 
                                 required >

                                 <option value="">Select Team</option>
                        </select>
                     </div>
                  </div>
                  

                  <div class="form-group row">
                     <label for="head" class="col-sm-4 col-form-label">Department Head</label>
                     <div class="col-sm-12">
                     <search-member model-name='department.leaderName' model-info ="department.head" ></search-member>
                     </div>
                  </div>


                  <div class="form-group row">
                    <button type="submit" class="btn btn-outline-primary" ng-disabled="createDepartmentForm.$invalid" >{{action}}</button>
                  </div>

               </form>   

            </div>
         </div>
      </div>
   </div>
</div>

  