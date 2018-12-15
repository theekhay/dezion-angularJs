

<div class="container">
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">Create Zone</h6>
            </div>

            <div class="card-block">

               <form name="createZoneForm" novalidate autocomplete="off" ng-controller="createZoneController" ng-submit="create()" >

                  <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label">Zone Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control"   
                                 type="text" 
                                 placeholder="Zone Name"
                                 id="name" name="name"
                                 ng-model='zone.name' 
                                 required ng-maxlength="30" />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="abbrevation" class="col-sm-4 col-form-label">Zone Abbrevation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Zone Abbrevation" 
                                 id="abbrevation" name="abbrevation" 
                                 ng-model='zone.abbrevation'
                                 required ng-maxlength="6" />
                     </div>
                  </div>


                  <div class="form-group row" ng-controller='manageCommunityController'>
                     <label for="community" class="col-sm-4 col-form-label">Community</label>
                     <div class="col-sm-12">
                        <select  class="custom-select form-control" 
                                 id="community" name="community" 
                                 ng-model='zone.community'
                                 ng-options = "c.id as c.name for c in communities" 
                                 required >
                                 <option value="">Select Community</option>
                        </select>
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="leader" class="col-sm-4 col-form-label">Zonal Leader</label>
                     <div class="col-sm-12">
                       <search-member model-name='zone.leaderName' model-info ="zone.leader" ></search-member>

                     </div>
                  </div>


                  <div class="form-group row">
                     <button type="submit" class="btn btn-outline-primary" ng-disabled="createZoneForm.$invalid" >Create Zone</button>
                  </div>

               </form>   
            </div>
         </div>
      </div>
   </div>
</div>