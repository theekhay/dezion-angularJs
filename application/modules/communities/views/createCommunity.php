

<div class="container" ng-app='communityApp' ng-controller='createCommunityController'>
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">{{action}} Community</h6>
            </div>

            <div class="card-block"  >

               <form name="createCommunityForm" ng-submit="create()" novalidate autocomplete="off">

                  <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label">Community Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Community Name" 
                                 id="name" name="name" 
                                 ng-maxlength = '50'
                                 ng-model ='community.name' 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="abbr" class="col-sm-4 col-form-label">Community Abbrevation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" placeholder="Community Abbrevation" 
                                 id="abbr" name="abbr" 
                                 ng-model ='community.abbrevation'
                                 ng-maxlength = '6' 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row" ng-controller='manageDistrictController'>
                     <label for="district" class="col-sm-4 col-form-label">Community's District</label>
                     <div class="col-sm-12">
                        <select  class="custom-select form-control" 
                                 id="district" name="district" 
                                 ng-model='community.district'
                                 ng-options = "d.id as d.name for d in districts" 
                                 required >
                                 <option value="">Select District</option>
                        </select>
                     </div>
                  </div>
                  

                  <div class="form-group row">
                     <label for="leader" class="col-sm-4 col-form-label">Community Leader</label>
                     <div class="col-sm-12">
                     <search-member model-name='community.leaderName' model-info ="community.leader" ></search-member>
                     </div>
                  </div>


                  <div class="form-group row">
                    <button type="submit" class="btn btn-outline-primary" ng-disabled="createCommunityForm.$invalid">{{action}} Community</button>
                  </div>

               </form>   

            </div>
         </div>
      </div>
   </div>
</div>

  