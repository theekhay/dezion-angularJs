

        

              

<div class="container" ng-app="ServiceApp" ng-controller = "createServiceController" > 
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">{{action}} Service</h6>
            </div>
            <div class="card-block"  >
               <form name="createServiceForm" ng-submit="create()" novalidate autocomplete="off" >

                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Service Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" placeholder="Service Name" 
                                 id="name" 
                                 ng-model="service.name" 
                                 ng-maxlength="100"
                                 required />
                     </div>
                  </div> 

                  <div class="form-group row">
                    <label for="example-text-input" class="col-sm-4 col-form-label">Abbreviation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Service Abbreviation" 
                                 id="abbr" name="abbr" 
                                 ng-model="service.abbrevation"
                                 ng-maxlength = '6' 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row" ng-show="action =='Update'">
                    <label for="example-text-input" class="col-sm-4 col-form-label">Date Created</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                  style="background-color: transparent;"
                                  ng-model="service.date_created"
                                 readonly />
                     </div>
                  </div>

              

                  <div class="form-group row">
                     <button type="submit" class="btn btn-outline-primary" ng-disabled="createServiceForm.$invalid">{{action}}</button>
                  </div>

               </form>   
            </div>
         </div>
      </div>
   </div>
</div>

                
