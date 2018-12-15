

<div class="container" ng-controller='createGroupController' >
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">{{action}} Small Group</h6>
            </div>

            <div class="card-block"  >

               <form name="creategroupForm" ng-submit="createGroup()" novalidate autocomplete="off" >

                  <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label">Group Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Group Name" 
                                 id="name" name="name" 
                                 ng-maxlength = '50'
                                 ng-model ='group.name' 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="abbr" class="col-sm-4 col-form-label">Group Abbrevation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" placeholder="Group Abbrevation" 
                                 id="abbr" name="abbr" 
                                 ng-model ='group.abbrevation'
                                 ng-maxlength = '6' maxlength="6" 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row" ng-controller='departmentListController'>
                     <label for="department" class="col-sm-4 col-form-label">Select department</label>
                     <div class="col-sm-12">
                        <select  class="custom-select form-control" 
                                 id="department" name="district" 
                                 ng-model='group.department'
                                 ng-options = "d.id as d.name for d in departments" 
                                 required >

                                 <option value="">Select Department</option>
                        </select>
                     </div>
                  </div>
                  

                  <div class="form-group row">
                     <label for="leader" class="col-sm-4 col-form-label">Group Leader</label>
                     <div class="col-sm-12">
                     <search-member model-name='group.leaderName' model-info ="group.leader" ></search-member>
                     </div>
                  </div>


                  <div class="form-group row">
                    <button type="submit" class="btn btn-outline-primary" ng-disabled="creategroupForm.$invalid" >{{action}}</button>
                  </div>

               </form>   

            </div>
         </div>
      </div>
   </div>
</div>

  