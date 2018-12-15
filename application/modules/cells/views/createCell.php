

<div class="container" ng-controller="createCellController">
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">

         <div class="card form-for-card">
         
            <div class="card-header">
               <h6 class="card-title">{{action}} Cell</h6>
            </div>

            <div class="card-block" >
               <form name="createCellForm" novalidate autocomplete="off" ng-submit="createCell()" >

                  <div class="form-group row" ng-controller='manageZoneController'>
                     <label for="example-text-input" class="col-sm-4 col-form-label">Zone</label>
                     <div class="col-sm-12">
                        <select  class="custom-select form-control"
                                id="zone" name="zone" 
                                ng-model='cell.zone_id'
                                ng-options = "z.id as z.name for z in zones" 
                                required >
                                <option value="">Select Zone</option>
                        </select>
                     </div>
                  </div>


                   <div class="form-group row">
                     <label for="address" class="col-sm-4 col-form-label">Cell Address</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Cell Address" 
                                 id="address" name="address" 
                                 ng-model="cell.address" 
                                 required />
                     </div>
                  </div>


                   <div class="form-group row">
                     <label for="city" class="col-sm-4 col-form-label">City</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="City" 
                                 id="city" name="city"
                                 ng-model="cell.city" 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Cell Leader</label>
                     <div class="col-sm-12">
                        <search-member model-name='cell.leaderName' model-info ="cell.leader" ></search-member>
                     </div>
                  </div>

                  <br />

                  <hr>
                  
                  <br />
                  <!-- <h5>Other Informations</h5> -->

                   <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label">Cell Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 id="name" name="name" 
                                 placeholder="Cell Name" 
                                 ng-maxlength = "50"
                                 ng-model="cell.name" />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="abbr" class="col-sm-4 col-form-label">Cell Abbrevation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Cell Abbrevation" 
                                 id="abbrevation" name="abbrevation" 
                                 ng-maxlength = "6"
                                 ng-model="cell.abbrevation" />
                     </div>
                  </div>




                  <div class="form-group row">
                     <button type="submit" class="btn btn-outline-primary" ng-disabled="createCellForm.$invalid">{{action}} Cell</button>
                  </div>


               </form>   
            </div>
         </div>
      </div>
   </div>
</div>