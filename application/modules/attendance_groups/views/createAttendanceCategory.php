

<div class="container" ng-controller="">
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">

         <div class="card form-for-card">

            <div class="card-header">
               <h6 class="card-title">{{action}} Attendance</h6>
            </div>

            <div class="card-block" >

               <form name="createAttendanceCategoryForm" novalidate autocomplete="off" ng-submit="createCategory()" >


                   <div class="form-group row">
                     <label for="address" class="col-sm-4 col-form-label">Attendance Type</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Cell Address" 
                                 id="address" name="address" 
                                 ng-model="category.name" 
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
                     <button type="submit" class="btn btn-outline-primary" ng-disabled="createAttendanceCategoryForm.$invalid">{{action}} Cell</button>
                  </div>


               </form>   
            </div>
         </div>
      </div>
   </div>
</div>