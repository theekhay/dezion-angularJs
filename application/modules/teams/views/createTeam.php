

<div class="container" ng-controller="createTeamController" >
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header" >
               <h6 class="card-title">{{action}} Team</h6>
            </div>

            <div class="card-block">

               <form name="createTeamForm" ng-submit="create()" novalidate autocomplete="off">

                  <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label">Team Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Team Name" 
                                 id="name" ng-model="team.name"
                                 ng-maxlength='50' 
                                 required />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="abbrevation" class="col-sm-4 col-form-label">Team Abbrevation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Team Abbrevation" 
                                 id="abbrevation" 
                                 ng-model="team.abbrevation"
                                 ng-maxlength='6' 
                                 required />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="leaderName" class="col-sm-4 col-form-label">Team Head</label>
                     <div class="col-sm-12">
                        <search-member model-name='team.leaderName' model-info ="team.head" ></search-member>
                     </div>
                  </div>

                  <div class="form-group row">
                    <button type="submit" class="btn btn-outline-primary" ng-disabled="createTeamForm.$invalid">{{action}}</button>
                  </div>

               </form>   
            </div>
         </div>
      </div>
   </div>
</div>