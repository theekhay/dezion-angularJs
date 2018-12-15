

<div class="container" ng-controller="manageMessageController">
   <div class="row">
      <div class="col-sm-16 col-md-16 col-lg-16">
         <div class="card form-for-card">
            <div class="card-header">
               <h6 class="card-title">Send Message</h6>
            </div>

            <div class="card-block">

               <form name="composeMessage" ng-submit= "sendMessage()" novalidate autocomplete="off" >

                  <div class="form-group row">
                     <label for="recepient" class="col-sm-4 col-form-label">Recepient</label>
                     <div class="col-sm-12">
                         <search-admin model-name="message.sender" model-info="message.recepient" ></search-admin>
    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="subject" class="col-sm-4 col-form-label">Subject</label>
                     <div class="col-sm-12">
                        <input class="form-control" type="text" placeholder="subject" id="subject" ng-model="message.subject" >
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="message" class="col-sm-4 col-form-label">Message</label>
                     <div class="col-sm-12">
                        <textarea class="form-control" type="text" placeholder="message" id="message" ng-model="message.body" required > </textarea>
                     </div>
                  </div>

                  <div class="form-group row">
                     <button type="submit" class="btn btn-outline-primary">Send</button>
                  </div>
               </form>   
            </div>
         </div>
      </div>
   </div>
</div>