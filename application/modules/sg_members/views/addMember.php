

<div class="container"  >
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">Add Member</h6>
            </div>

            <div class="card-block" ng-controller="addMembersController" >

               <form name="addMemberForm"  ng-submit="addToGroup()" novalidate autocomplete="off" >

                  <div class="form-group row" ng-controller='groupListController'>
                     <label for="group" class="col-sm-4 col-form-label">Group</label>
                     <div class="col-sm-12">
                        <select  class="custom-select form-control" 
                                 id="group" name="group" 
                                 ng-model='data.group_id'
                                 ng-options = "g.id as g.name for g in groups " 
                                 required >

                                 <option value="">Select Group</option>
                        </select>
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="leader" class="col-sm-4 col-form-label">Member</label>
                     <div class="col-sm-12">
                       <search-member  model-name='data.leaderName' model-info="data.member_id" ></search-member>

                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="leader" class="col-sm-4 col-form-label">Date Joined</label>
                     <div class="col-sm-12">
                        <datepicker date-format="yyyy-MM-dd">
                           <input   name="date_joined" style="background-color: transparent;"
                                    id="date_joined" 
                                    ng-model='data.date_joined' 
                                    type="date" class="form-control" 
                                    required readonly />
                        </datepicker>

                     </div>
                  </div>


                  <div class="form-group row">
                     <button type="submit" class="btn btn-outline-primary">Add Member</button>
                  </div>

               </form>  

            </div>
         </div>
      </div>
   </div>
</div>