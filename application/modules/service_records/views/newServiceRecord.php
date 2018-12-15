


<div class="wrapper-content"  ng-controller="serviceRecordController" >
   <div j-tabs id="tabs" class="my-tabs" > <!-- class="service-tabs" -->
      <ul>
         <li><a href="#tabs-1">Service</a></li>
         <li><a href="#tabs-2">Attendance</a></li>
      </ul>

      <form name="serviceRecordForm" novalidate autocomplete="off" ng-submit="saveRecord()" >
    <div  id="tabs-1">
      <h6 class="card-title tabbed-title">Service Details</h6>
       <div class="container">
        <div class="row">
          <div class="col-sm-16 col-md-16 col-lg-16 tabbed-space">

            <div class="form-group row">
              <label for="example-date-input" class="col-sm-4 col-form-label">Service Date</label>
              <div class="col-sm-12">
                <datepicker date-format="yyyy-MM-dd">
                          <input   class="form-control" 
                                   type="text" placeholder="yyyy-mm-dd" 
                                   id="service_date" 
                                   ng-model='record.service_date'
                                   required readonly style="background-color: transparent;" />
                        </datepicker>
              </div>
            </div>

            <div class="form-group row" ng-controller='manageServiceController' >
              <label for="example-text-input" class="col-sm-4 col-form-label">Service</label>
              <div class="col-sm-12">
                <select  class="custom-select form-control" 
                                id="service_id" name="service_id" 
                                ng-model='record.service_id'
                                ng-options = "z.id as z.name for z in services" 
                                required >
                                <option value="">Select Service</option>
                        </select>
              </div>
            </div>

            <!-- <div class="form-group row">
              <label for="example-text-input" class="col-sm-4 col-form-label">Minister</label>
              <div class="col-sm-4 col-xs-4">
                <select class="custom-select form-control" id="example-text-input">
                  <option selected>title</option>
                  <option value="1">Pst</option>
                  <option value="2">Rev</option>
                  <option value="3">Mr</option>
                  <option value="3">Mrs</option>
                  <option value="3">Evan</option>
                </select>
              </div>
               <div class="col-sm-8 col-xs-8 ">
                <input class="form-control" type="text" placeholder="ministry" id="example-text-input">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-4 col-form-label">Bible Text</label>
              <div class="col-sm-12">
                <input class="form-control" type="text" placeholder="bible texts" id="example-text-input">
              </div>
            </div> -->


          </div>
         </div>
        </div>
      </div>

    <!-- div id="tabs-2">
      <h6 class="card-title tabbed-title">Offering</h6>
      <div class="container">
        <div class="row">
          <div class="col-sm-16 col-md-16 col-lg-16 tabbed-space">
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-4 col-form-label">Select Service</label>
              <div class="col-sm-12">
                <select class="custom-select form-control" id="example-text-input">
                  <option selected>Sunday First Service</option>
                  <option value="1">Sunday Second Service</option>
                  <option value="2">Sunday Third Service</option>
                  <option value="3">Sunday Fourth Service</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->


    <div id="tabs-2">
     <h6 class="card-title tabbed-title">Service Attendance</h6>
      <div class="container">
        <div class="row">
          <div class="col-sm-16 col-md-16 col-lg-16 tabbed-space">
            <div class= "centered-form">
              <div class="form-group row">
                <div class="col-12">
                  <input class="form-control" type="number" placeholder="Adult Male" id="example-number-input" ng-model="record.adult_male">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-12">
                  <input class="form-control" type="number" placeholder="Adult Female" id="example-number-input" ng-model="record.adult_female" >
                </div>
              </div>
             <div class="form-group row">
                <div class="col-12">
                  <input class="form-control" type="number" placeholder="Children Male" id="example-number-input" ng-model="record.children_male" >
                </div>
              </div>
              <div class="form-group row">
                <div class="col-12">
                  <input class="form-control" type="text" placeholder="Children Female" id="example-number-input" ng-model="record.children_female">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <button type="submit" class="btn btn-outline-primary"  >Submit</button>
            </div>

          </div>
        </div>
      </div>
    </div>

  </form>
</div>
<!-- </div>