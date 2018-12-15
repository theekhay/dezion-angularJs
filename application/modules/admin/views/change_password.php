

<div class="container" ng-app='communityApp'>
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">Change Password</h6>
            </div>

            <div class="card-block" ng-controller='changePasswordController' >

               <form name="updatePasswordForm" ng-submit="changePassword()" novalidate autocomplete="off">

                  <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label">Old Password</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="Password" 
                                 placeholder="enter current Password" 
                                 id="oldPassword" name="oldPassword" 
                                 ng-model ='admin.oldPassword' 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="abbr" class="col-sm-4 col-form-label">New Password</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="Password" placeholder="enter new Password" 
                                 id="newPassword" name="newPassword" 
                                 ng-model ='admin.newPassword' 
                                 required />
                     </div>
                  </div>


                 <div class="form-group row">
                     <label for="abbr" class="col-sm-4 col-form-label">Confirm Password</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="Password" placeholder="Enter new Password again" 
                                 id="newPasswordAgain" name="confirmPassword" 
                                 ng-model ='admin.confirmPassword' 
                                 required />
                     </div>
                  </div>

                  <div class="form-group row">
                     <button type="submit" class="btn btn-outline-primary" ng-disabled="updatePasswordForm.$invalid">Update Password</button>
                  </div>

               </form>   

            </div>
         </div>
      </div>
   </div>
</div>

  