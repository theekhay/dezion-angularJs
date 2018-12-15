

<div class="container" ng-controller="createRoleController">
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">

         <div class="card form-for-card">

            <div class="card-header">
               <h6 class="card-title">Create Role</h6>
            </div>

            <div class="card-block" >

               <form name="createRoleForm" novalidate autocomplete="off" ng-submit="createRole()" >

                  <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label">Role Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 id="name" name="name" 
                                 placeholder="Role Name" 
                                 ng-maxlength = "50"
                                 ng-model="role.name" required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="abbr" class="col-sm-4 col-form-label">Role Abbrevation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Role Abbrevation" 
                                 id="abbrevation" name="abbrevation" 
                                 ng-maxlength = "6"
                                 ng-model="role.abbrevation" 
                                 required />
                     </div>
                  </div>



                  <div class="form-group row">
                     <label for="abbr" class="col-sm-4 col-form-label">Role Description</label>
                     <div class="col-sm-12">
                        <textarea   class="form-control" 
                                 type="text" 
                                 placeholder="Brief Description" 
                                 id="description" name="description"
                                 ng-model="role.description"></textarea>
                     </div>
                  </div>


                  <div class="form-group row">
                     <button type="submit" class="btn btn-outline-primary" ng-disabled="createRoleForm.$invalid">Create Role</button>
                  </div>


               </form>   
            </div>
         </div>
      </div>
   </div>
</div>