




<div class="container" ng-app ='cellMembersApp' >
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">Add Member</h6>
            </div>

            <div class="card-block" ng-controller="addMemberController" >

               <form name="addMemberForm"  ng-submit="addToCell()" novalidate autocomplete="off" >

                  <div class="form-group row" ng-controller='cellListController'>
                     <label for="cell" class="col-sm-4 col-form-label">Cell</label>
                     <div class="col-sm-12">
                        <select  class="custom-select form-control" 
                                 id="cell" name="cell" 
                                 ng-model='data.cell_id'
                                 ng-options = "c.id as c.name for c in cells " 
                                 required >
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
                           <input name="date_joined" 
                                  id="date_joined" 
                                  ng-model='data.date_joined' 
                                  type="date" class="form-control"
                                  required readonly style="background-color: transparent;" />
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