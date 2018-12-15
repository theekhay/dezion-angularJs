<div class="container" ng-controller="messageLoadController">
   <div class="row">
      <div class="col-16">
         <div class="card full-screen-container mailbox">
            <div class="card-header align-items-start justify-content-between flex">

              <ul class="nav nav-pills card-header-pills pull-left">

                <li class="nav-item hidden-lg-up">
                  <button class="btn btn-link icon-header m-0 mr-2 pull-right inboxmenu"><span class="fa fa-bars"></span></button>
               </li>

               <!-- <li class="nav-item">
                  <div class="checkbox mt-1 mr-1">
                  <label class="form-check-label text-white"><input type="checkbox" class="form-check-input "><i class="fa fa-check"></i></label>
                  <span class="text">All</span> </div>
               </li> -->

               <!-- <li class="nav-item">
                  <button class="btn btn-outline-primary btn-round ml-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i> <span class="text">More</span></button>
                  <div class="dropdown-menu"> <a class="dropdown-item" href="#">Mark as Read</a> <a class="dropdown-item" href="#">Mark as Unread</a> <a class="dropdown-item" href="#">Move to Spam</a> <a class="dropdown-item" href="#">Move to Trash</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Archive</a> </div>
               </li> -->

              <!-- <li class="nav-item">
                <button class="btn btn-outline-primary btn-round ml-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-flag"></i> <span class="text">Labels</span></button>
                <div class="dropdown-menu"> <a class="dropdown-item  status-success" href="#">Primary</a> <a class="dropdown-item  status-danger" href="#">Important</a> <a class="dropdown-item  status-warning" href="#">Warning</a> <a class="dropdown-item  status-primary" href="#">Minor</a> </div>
              </li> -->

              <li class="nav-item hidden-sm-down">
                <form class="form-inline ml-2  pull-left search-header">
                  <input class="form-control dark-input" type="text" placeholder="Search">
                  <button class="btn btn-link icon-header " type="submit"><span class="fa fa-search"></span></button>
                </form>
              </li>
            </ul>
            <ul class="nav nav-pills card-header-pills pull-right">
              
              <!-- <li class="nav-item">
                <button class="btn btn-sm btn-link btn-round" ><i class="fa fa-refresh"></i></button>
              </li>

              <li class="nav-item">
                <button class="btn btn-sm btn-link btn-round fullscreen-btn"><i class="fa fa-arrows-alt"></i></button>
              </li> -->

            </ul>
          </div>
          <div class="card-block p-0">
            <div class="row m-0">
              <div class="col-sm-5 col-lg-3 mailboxnav ">
                <nav class="nav flex-column ">
                  <div class="nav-item mb-2"><a class="btn btn-danger btn-round btn-block" href="#!/messages/compose">Compose</a></div>
                  <div class="nav-item active"><a class="nav-link active" href="#">Inbox <b>(15)</b></a></div>
                  <div class="nav-item"><a class="nav-link" href="#">Draft <b>(15)</b></a></div>
                  <div class="nav-item"><a class="nav-link" href="#">Outbox <b>(15)</b></a></div>
                  <div class="nav-item"><a class="nav-link" href="#">Spam <b>(10)</b></a></div>
                  <div class="nav-item"><a class="nav-link" href="#">Trash</a></div>
                  <div class="nav-item">
                    <hr>
                  </div>
                  <div class="nav-item  status-success"><a class="nav-link active" href="#">Primary</a></div>
                  <div class="nav-item status-danger"><a class="nav-link" href="#">Important</a></div>
                  <div class="nav-item status-warning"><a class="nav-link" href="#">Warning</a></div>
                  <div class="nav-item status-primary"><a class="nav-link" href="#">Minor</a></div>
                </nav>
              </div>
              <div class="col-md col-lg-6 p-0 maillist"  >
                <div class="list-unstyled media-list" style="max-height:800px"  > 

                  <!-- User messages would be displayed here -->
                  <div ng-repeat="message in messages" ng-click="display(message.id)" ng-show="messages.length > 0" class="media active new"> <span class="message_userpic"><img class="d-flex mr-3" src="./library/demo/admin/css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                    <div class="media-body">
                      <a><h6 class="mt-0 mb-1"> <admin-full-name style="color: #32afaf;" admin-id="message.sender"></admin-full-name> </h6>
                      <p>{{message.date_time | datetime}}</p>
                      <p class="description ">{{message.body | limitTo : 30}} ...</p></a>
                    </div>
                  </div>


                  <!-- <div class="media active new"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                    <div class="media-body">
                      <h6 class="mt-0 mb-1">Adminux Welcome </h6>
                      <p>2:00 pm, 20 January, 2017</p>
                      <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                    </div>
                  </div> -->

                </div>

                <p ng-hide ="messages.length > 0">You Currently dont have any message. </p>
              </div>



             


            <div class="col hidden-md-down  pb-2" style="max-height:800px; overflow-y:auto"  >
                <div class="options-mail">
                  <ul class="nav nav-pills pull-left">
                    <li class="nav-item">
                      <button class="btn btn-sm btn-link " ><i class="fa fa-reply"></i> Reply</button>
                    </li>
                    <li class="nav-item">
                      <button class="btn btn-sm btn-link " ><i class="fa fa-reply-all"></i> Reply All</button>
                    </li>

                    <li class="nav-item">
                      <button class="btn btn-sm btn-link " ><i class="fa fa-trash"></i> Delete</button>
                    </li>
                  </ul>
                  <ul class="nav nav-pills pull-right">
                    <li class="nav-item">
                      <button class="btn btn-sm btn-outline-primary " ><i class="fa fa-chevron-left"></i></button>
                    </li>
                    <li class="nav-item">
                      <button class="btn btn-sm btn-outline-primary ml-2"><i class="fa fa-chevron-right"></i></button>
                    </li>
                  </ul>
                </div>
                <div class="clearfix"></div>
                <h3 class="mt-2">{{message.subject}}</h3>
                <div class="list-unstyled comment-list">
                  <div class="media "> <span class="message_userpic"><img class="d-flex mr-3" src="./library/demo/admin/css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                    <div class="media-body">
                      <h6 class="mt-0 mb-1"> <admin-full-name admin-id='message.sender'></admin-full-name> <small class="pull-right">{{message.date_time}}</small></h6>
                      <!-- <p class="description mb-0">{{message.sender}}</p> -->
                    </div>
                  </div>
                </div>
                <!-- <hr > -->
                <p>{{message.body}}</p>
              
                <br>
                <hr>
                <h2 class="page_subtitles">Quick Reply <small><a href="#" class="pull-right">More options</a></small></h2>
                <textarea class="form-control dark-input" rows="4" placeholder="Write your message here"></textarea>
                <br>
                <button class="btn btn-primary">Send</button>
            </div>





            </div>
          </div>
        </div>
      </div>
    </div>
  </div>