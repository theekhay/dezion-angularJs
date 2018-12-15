

<div class="container" ng-controller="AdminRegisterationController">
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">

         <div class="card form-for-card">

            <div class="card-header">
               <h6 class="card-title">Create new user</h6>
            </div>

            <div class="card-block" >

               <form name="createAdminForm" novalidate autocomplete="off" ng-submit="register()" >

                  <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label">Admin Name</label>
                     <div class="col-sm-12">
                        <search-member model-name='admin.name' model-info ="admin.member_id" ></search-member>
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="abbr" class="col-sm-4 col-form-label">Username</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Create username" 
                                 id="username" name="username" 
                                 ng-model="admin.username" 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row" ng-controller='manageRolesController'>
                     <label for="example-text-input" class="col-sm-4 col-form-label">Select Role</label>
                     <div class="col-sm-12">
                        <select  class="custom-select form-control" 
                                id="zone" name="zone" 
                                ng-model='admin.role_id'
                                ng-options = "z.id as z.name for z in roles" 
                                required >
                                <option value="">Select Role</option>
                        </select>
                     </div>
                  </div>


                   

                  <div class="form-group row" ng-controller='manageRolesController'>
                     <label for="example-text-input" class="col-sm-4 col-form-label">Generate Password</label>
                     <div class="col-sm-12">
                        <div class="input-group">
                          <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" ng-model='admin.password' readonly required style="background: transparent;">
                          <span class="input-group-addon" id="basic-addon2"><i ng-click="generatePassword()" title="Click to generate password" class="fa fa-barcode"></i></span>
                        </div>
                      </div>
                  </div>


                  <div class="form-group row">
                     <button type="submit" class="btn btn-outline-primary" ng-disabled="createAdminForm.$invalid">Create User</button>
                  </div>


               </form>   
            </div>
         </div>
      </div>
   </div>
</div>