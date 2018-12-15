

<div class="container" ng-app="districtApp" ng-controller = "createDistrictController" > 
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">{{action}} District</h6>
            </div>
            <div class="card-block"  >
               <form name="createDistrictForm" ng-submit="create()" novalidate autocomplete="off" >

                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">District Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" placeholder="District Name" 
                                 id="name" 
                                 ng-model="district.name" 
                                 ng-maxlength="50"
                                 required />
                     </div>
                  </div> 

                  <div class="form-group row">
                    <label for="example-text-input" class="col-sm-4 col-form-label">Abbreviation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="District Abbreviation" 
                                 id="abbr" name="abbr" 
                                 ng-model="district.abbrevation"
                                 ng-maxlength = '6' 
                                 required />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">District Pastor</label>
                     <div class="col-sm-12">
                        <search-member model-name='district.leaderName' model-info ="district.pastor" ></search-member>
                     </div>
                  </div>

                  <div class="form-group row">
                     <button type="submit" class="btn btn-outline-primary" ng-disabled="createDistrictForm.$invalid">{{action}}</button>
                  </div>

               </form>   
            </div>
         </div>
      </div>
   </div>
</div>
