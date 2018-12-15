


<div class="container" ng-controller="firsttimerRegisterationController" >
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">{{action}} First Timers</h6>
            </div>

            <div class="card-block">

               <form name="createFirsttimerForm" ng-submit="register()" novalidate autocomplete="off">

                  <div class="form-group row">
                     <label for="service_date" class="col-sm-4 col-form-label">Service Date</label>
                     <div class="col-sm-12">
                        <datepicker date-format="yyyy-MM-dd">
                          <input   class="form-control" 
                                   type="text" placeholder="yyyy-mm-dd" 
                                   id="service_date" 
                                   ng-model='firsttimer.service_date'
                                   required readonly style="background-color: transparent;" />
                        </datepicker>
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="surname" class="col-sm-4 col-form-label">Surname</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" placeholder="Surname" 
                                 id="surname" 
                                 ng-model="firsttimer.surname" 
                                 ng-required  />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="firstname" class="col-sm-4 col-form-label">First Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" placeholder="firstname" 
                                 id="firstname" 
                                 ng-model="firsttimer.firstname"
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="middlename" class="col-sm-4 col-form-label">Middle Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" placeholder="middlename" 
                                 id="middlename" name="middlename" 
                                 ng-model="firsttimer.middlename" />
                     </div>
                  </div>

                  
                  <div class="form-group row">
                     <label for="dob" class="col-sm-4 col-form-label">Date-Of-Birth</label>
                     <div class="col-sm-12">
                        <datepicker date-format="yyyy-MM-dd">
                          <input   class="form-control" style="background-color: transparent;" 
                                   type="text" 
                                   placeholder="yyyy-mm-dd" 
                                   id="dob" name="dob" 
                                   ng-model="firsttimer.dob"
                                   required readonly />
                        <datepicker>          
                     </div>
                  </div>
                   


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Age Bracket</label>
                     <div class="col-sm-12">
                        <select class="custom-select form-control" id="example-text-input"  ng-model="firsttimer.age_bracket">
                           <option selected>Select Age Bracket</option>
                           <option value="18-24">18-24</option>
                           <option value="25-30">25-30</option>
                           <option value="3">30-35</option>
                        </select>
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="address" class="col-sm-4 col-form-label">Address</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 placeholder="Address" 
                                 id="address" name="address" 
                                 ng-model="firsttimer.address" required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="email" 
                                 id="email"  name="email" 
                                 aria-describedby="emailHelp" 
                                 placeholder="Enter email"  
                                 ng-model="firsttimer.email" required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="occupation" class="col-sm-4 col-form-label">Occupation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 id="occupation" name="occupation" 
                                 placeholder="Occupation" 
                                 ng-model="firsttimer.occupation" />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="telephone1" class="col-sm-4 col-form-label">Telephone1</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="tel" placeholder="Telephone 1" 
                                 id="telephone1" name="telephone1" 
                                 ng-model="firsttimer.telephone1" 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Gender</label>
                     <div class="col-sm-12">
                        <label class="custom-control custom-radio">
                          <input id="radio2" name="gender" type="radio" class="custom-control-input" ng-model="firsttimer.gender" value= "m" />
                          <span class="custom-control-indicator"></span> <span class="custom-control-description">Male</span> </label>
                          <label class="custom-control custom-radio">
                            <input id="radio2" name="gender" type="radio" class="custom-control-input" ng-model="firsttimer.gender" value= "f" />
                            <span class="custom-control-indicator"></span> <span class="custom-control-description">Female</span></label>
                        </div>
                    </div>


                  <div class="form-group row"">
                    <label for="example-text-input" class="col-sm-4 col-form-label">How did you find harvesters</label>
                    <div class="col-sm-12">
                      <select class="custom-select form-control" id="example-text-input" ng-model="firsttimer.discovery">
                        <option selected value ="">How did you find harvesters</option>
                        <option value="Fliers">Fliers</option>
                        <option value="BillBoards">Billboards</option>
                        <option value="Social Media">Social Media</option>
                        <option value="Television">Television</option>
                        <option value="Family & Friends">Family & Friends</option>
                        <option value="others">Others</option>
                      </select>
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="example-text-input" class="col-sm-4 col-form-label">My Decision Today</label>
                    <div class="col-sm-12">
                      <select class="custom-select form-control" id="example-text-input" ng-model="firsttimer.next_step" >
                        <option selected>Select One of the Steps</option>
                        <option value="Commit my life to Christ">Commit my life to Christ</option>
                        <option value="Get Counselled by A Leader">Get Counselled by A Leader</option>
                        <option value="Serve">Serve</option>
                        <option value="Join a Cell">Join a Cell</option>
                        <option value="Join a Group">Join a Group</option>
                        <option value="Lead a Group">Lead a Group</option>
                        <option value="Volunteer House For Group">Volunteer House For Group</option>
                        <option value="Attend a course/event/meeting">Attend a course/event/meeting</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <button type="submit" class="btn btn-outline-primary" ng-disabled="createFirsttimerForm.$invalid" >{{action}}</button>
                  </div>

               </form>
          </div>
        </div>
      </div>
    </div>
  </div>