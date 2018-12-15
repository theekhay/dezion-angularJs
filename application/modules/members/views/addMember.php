



<div class="container"  ng-controller="memberRegisterationController">
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">

            <div class="card-header">
               <h6 class="card-title">{{action}} Member</h6>
            </div>

            <form name="memberRegisterationForm" ng-submit="registerMember()" novalidate autocomplete="off" >
               <div class="card-block">

                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Surname</label>
                     <div class="col-sm-12">
                     <input   type="text" class="form-control" 
                              id="surname" name="surname" 
                              placeholder="Surname" 
                              ng-model="member.surname"
                              id="surname" required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">First Name</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text"   
                                 id="firstname" name="firstname" 
                                 placeholder="Firstname" 
                                 ng-model="member.firstname" 
                                 id="firstname" 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Middle Name</label>
                     <div class="col-sm-12">
                        <input   type="text" 
                                 id="middlename" name="middlename" 
                                 class="form-control" 
                                 placeholder="Middlename" 
                                 ng-model="member.middlename" />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-date-input" class="col-sm-4 col-form-label">Date-Of-Birth</label>
                     <div class="col-sm-12">
                        <!-- <datepicker date-format="yyyy-MM-dd">
                           <input   type="text" style="background-color: transparent;"
                                    class="form-control " 
                                    placeholder="yyyy/mm/dd" 
                                    id="dob" name="dob" 
                                    ng-model="member.dob" 
                                    required readonly />
                        </datepicker>             -->


                        <datepicker date-format="yyyy-MM-dd" selector="form-control">
                            <div class="input-group">
                                <input class="form-control" placeholder="yyyy-mm-dd" ng-model='member.dob' />
                                <span class="input-group-addon" style="cursor: pointer">
                                <i class="fa fa-lg fa-calendar"></i>
                                </span>
                            </div>
                        </datepicker>


                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Age Bracket</label>
                     <div class="col-sm-12">
                        <select class="custom-select form-control" id="age_bracket" ng-model="member.age_bracket">
                           <option selected="selected" >Select Age Bracket</option>
                           <option value="18-24">18-24</option>
                           <option value="25-30">25-30</option>
                           <option value="30-35">30-35</option>
                        </select>
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Address</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 id="address" name="address" 
                                 placeholder="Address" 
                                 ng-model="member.address" 
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="exampleInputEmail1" class="col-sm-4 col-form-label">E-mail</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="email" 
                                 id="email" aria-describedby="emailHelp" 
                                 placeholder="Email" 
                                 ng-model="member.email"
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Occupation</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" 
                                 id="Occupation" name="occupation" 
                                 placeholder="Occupation" 
                                 ng-model="member.occupation" />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-tel-input" class="col-sm-4 col-form-label">Telephone1</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="number" 
                                 placeholder="Mobile 1" 
                                 id="telephone1" name="telephone1" 
                                 ng-model="member.telephone1"
                                 ng-maxlength = '11'
                                 required />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="telephone2" class="col-sm-4 col-form-label">Telephone2</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="tel" 
                                 placeholder="Mobile 2" 
                                 id="telephone2" name="telephone2" 
                                 ng-maxlength = '11'
                                 ng-model="member.telephone2" />
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Marital Status</label>
                     <div class="col-sm-12">
                        <label class="custom-control custom-radio">
                           <input   id="s" 
                                    name="marital_status" 
                                    type="radio" 
                                    class="custom-control-input" 
                                    ng-model='member.marital_status' 
                                    value="s"
                                    required />
                           <span class="custom-control-indicator"></span> <span class="custom-control-description">Single</span> 
                        </label>

                        <label class="custom-control custom-radio">
                           <input   id="m" 
                                    name="marital_status" 
                                    type="radio" 
                                    class="custom-control-input" 
                                    ng-model='member.marital_status' 
                                    value='m' 
                                    required />
                           <span class="custom-control-indicator"></span> <span class="custom-control-description">Married</span> 
                        </label>
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Gender</label>
                     <div class="col-sm-12">
                        <label class="custom-control custom-radio">
                           <input   id="radio2" 
                                    name="gender" 
                                    ng-model='member.gender' 
                                    type="radio" 
                                    class="custom-control-input" 
                                    value="m" />
                           <span class="custom-control-indicator"></span> <span class="custom-control-description">Male</span> 
                        </label>

                        <label class="custom-control custom-radio">
                           <input  id="radio2" 
                                    name="gender" 
                                    ng-model='member.gender' 
                                    type="radio" 
                                    class="custom-control-input" 
                                    value="f" />
                            <span class="custom-control-indicator"></span> <span class="custom-control-description">Female</span> 
                        </label>
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="example-text-input" class="col-sm-4 col-form-label">Member Status</label>
                     <div class="col-sm-12">
                        <input   class="form-control" 
                                 type="text" id="example-text-input" 
                                 placeholder="example hod, small group Leader,member,pastor" 
                                 ng-model="member.member_status" />
                     </div>
                  </div>

                  <div class="form-group row">
                     <label  class="col-sm-4 "></label>
                     <div class="col-sm-12">
                        <button  type="submit" 
                                 class="btn btn-block btn-outline-primary"
                                 ng-disabled="memberRegisterationForm.$invalid"
                                 >{{action}}
                        </button>
                     </div>
                  </div>

               </div>
            </form>
         </div>
      </div>
   </div>
</div>

   