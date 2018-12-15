
  <div class="row  align-items-end  customer-profile-cover">
    <figure class="background"><img src="/css/images/normal.png" alt="Social cover image"> </figure>
    <div class="container mb-2">
      <div class="row  align-items-center p-2">
        <figure class="social-profile-pic"><img src="./css/images/team.png" alt=""></figure>
        <div class="col-sm-16 col-lg-4 col-xl-4  profile-name">
          <h2>Usera Usera </h2>
          <p style="font-size: 14px">membership</p>
        </div>
        <div class="col-16 col-sm-16 col-lg-9 col-xl-9 text-right d-flex">
          <div class="col col-sm-8 col-lg col-xl-8">
          </div>
          <!-- <div class="col col-sm-4 col-lg col-xl-4 ">
            <h4>Expenses</h4>
            <h2>125</h2>
          </div>
          <div class="col col-sm-4 col-lg col-xl-4 ">
            <h4>Invoices</h4>
            <h2>143</h2>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <div class="container">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
     <!--  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Messages</a> </li> -->
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content" ng-controller="adminInfoController" >
      <div class="tab-pane active" id="profile" role="tabpanel" >
        <div class="row">
          <div class="col-sm-16">
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              <h4 class="alert-heading">Welcome!</h4>
              <p>Edit your profile informtion here.</p>
            </div>
          </div>
          <div class="col-sm-16">
            <h3 class="mt-2" >Personal Info</h3>
            <hr>
          </div>
          <form class="col-sm-16">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-lg-8 col-md-8">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="" ng-model="membershipDetails.firstname">
                  </div>
                  <div class="col-lg-8 col-md-8">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-8 col-md-8">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="">
                  </div>
                  <div class="col-lg-8 col-md-8">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" placeholder="" ng-model="membershipDetails.telephone1">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-8 col-md-8">
                    <div class="row">
                      <!-- <div class="col-lg-8">
                        <label>Country</label>
                        <select class="form-control " data-live-search="true" tabindex="-1" aria-hidden="true">
                          <option value="AF">Afghanistan</option>
                          <option value="AX">Åland Islands</option>
                          <option value="AL">Albania</option>
                          <option value="DZ">Algeria</option>
                          <option value="AS">American Samoa</option>
                          <option value="AD">Andorra</option>
                          <option value="AO">Angola</option>
                          <option value="AI">Anguilla</option>
                          <option value="AQ">Antarctica</option>
                          <option value="AG">Antigua and Barbuda</option>
                          <option value="AR">Argentina</option>
                          <option value="AM">Armenia</option>
                          <option value="AW">Aruba</option>
                          <option value="AU">Australia</option>
                          <option value="AT">Austria</option>
                          <option value="AZ">Azerbaijan</option>
                          <option value="BS">Bahamas</option>
                          <option value="BH">Bahrain</option>
                          <option value="BD">Bangladesh</option>
                          <option value="BB">Barbados</option>
                          <option value="BY">Belarus</option>
                          <option value="BE">Belgium</option>
                          <option value="BZ">Belize</option>
                          <option value="BJ">Benin</option>
                          <option value="BM">Bermuda</option>
                          <option value="BT">Bhutan</option>
                          <option value="BO">Bolivia, Plurinational State of</option>
                          <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                          <option value="BA">Bosnia and Herzegovina</option>
                          <option value="BW">Botswana</option>
                          <option value="BV">Bouvet Island</option>
                          <option value="BR">Brazil</option>
                          <option value="IO">British Indian Ocean Territory</option>
                          <option value="BN">Brunei Darussalam</option>
                          <option value="BG">Bulgaria</option>
                          <option value="BF">Burkina Faso</option>
                          <option value="BI">Burundi</option>
                          <option value="KH">Cambodia</option>
                          <option value="CM">Cameroon</option>
                          <option value="CA">Canada</option>
                          <option value="CV">Cape Verde</option>
                          <option value="KY">Cayman Islands</option>
                          <option value="CF">Central African Republic</option>
                          <option value="TD">Chad</option>
                          <option value="CL">Chile</option>
                          <option value="CN">China</option>
                          <option value="CX">Christmas Island</option>
                          <option value="CC">Cocos (Keeling) Islands</option>
                          <option value="CO">Colombia</option>
                          <option value="KM">Comoros</option>
                          <option value="CG">Congo</option>
                          <option value="CD">Congo, the Democratic Republic of the</option>
                          <option value="CK">Cook Islands</option>
                          <option value="CR">Costa Rica</option>
                          <option value="CI">Côte d'Ivoire</option>
                          <option value="HR">Croatia</option>
                          <option value="CU">Cuba</option>
                          <option value="CW">Curaçao</option>
                          <option value="CY">Cyprus</option>
                          <option value="CZ">Czech Republic</option>
                          <option value="DK">Denmark</option>
                          <option value="DJ">Djibouti</option>
                          <option value="DM">Dominica</option>
                          <option value="DO">Dominican Republic</option>
                          <option value="EC">Ecuador</option>
                          <option value="EG">Egypt</option>
                          <option value="SV">El Salvador</option>
                          <option value="GQ">Equatorial Guinea</option>
                          <option value="ER">Eritrea</option>
                          <option value="EE">Estonia</option>
                          <option value="ET">Ethiopia</option>
                          <option value="FK">Falkland Islands (Malvinas)</option>
                          <option value="FO">Faroe Islands</option>
                          <option value="FJ">Fiji</option>
                          <option value="FI">Finland</option>
                          <option value="FR">France</option>
                          <option value="GF">French Guiana</option>
                          <option value="PF">French Polynesia</option>
                          <option value="TF">French Southern Territories</option>
                          <option value="GA">Gabon</option>
                          <option value="GM">Gambia</option>
                          <option value="GE">Georgia</option>
                          <option value="DE">Germany</option>
                          <option value="GH">Ghana</option>
                          <option value="GI">Gibraltar</option>
                          <option value="GR">Greece</option>
                          <option value="GL">Greenland</option>
                          <option value="GD">Grenada</option>
                          <option value="GP">Guadeloupe</option>
                          <option value="GU">Guam</option>
                          <option value="GT">Guatemala</option>
                          <option value="GG">Guernsey</option>
                          <option value="GN">Guinea</option>
                          <option value="GW">Guinea-Bissau</option>
                          <option value="GY">Guyana</option>
                          <option value="HT">Haiti</option>
                          <option value="HM">Heard Island and McDonald Islands</option>
                          <option value="VA">Holy See (Vatican City State)</option>
                          <option value="HN">Honduras</option>
                          <option value="HK">Hong Kong</option>
                          <option value="HU">Hungary</option>
                          <option value="IS">Iceland</option>
                          <option value="IN">India</option>
                          <option value="ID">Indonesia</option>
                          <option value="IR">Iran, Islamic Republic of</option>
                          <option value="IQ">Iraq</option>
                          <option value="IE">Ireland</option>
                          <option value="IM">Isle of Man</option>
                          <option value="IL">Israel</option>
                          <option value="IT">Italy</option>
                          <option value="JM">Jamaica</option>
                          <option value="JP">Japan</option>
                          <option value="JE">Jersey</option>
                          <option value="JO">Jordan</option>
                          <option value="KZ">Kazakhstan</option>
                          <option value="KE">Kenya</option>
                          <option value="KI">Kiribati</option>
                          <option value="KP">Korea, Democratic People's Republic of</option>
                          <option value="KR">Korea, Republic of</option>
                          <option value="KW">Kuwait</option>
                          <option value="KG">Kyrgyzstan</option>
                          <option value="LA">Lao People's Democratic Republic</option>
                          <option value="LV">Latvia</option>
                          <option value="LB">Lebanon</option>
                          <option value="LS">Lesotho</option>
                          <option value="LR">Liberia</option>
                          <option value="LY">Libya</option>
                          <option value="LI">Liechtenstein</option>
                          <option value="LT">Lithuania</option>
                          <option value="LU">Luxembourg</option>
                          <option value="MO">Macao</option>
                          <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                          <option value="MG">Madagascar</option>
                          <option value="MW">Malawi</option>
                          <option value="MY">Malaysia</option>
                          <option value="MV">Maldives</option>
                          <option value="ML">Mali</option>
                          <option value="MT">Malta</option>
                          <option value="MH">Marshall Islands</option>
                          <option value="MQ">Martinique</option>
                          <option value="MR">Mauritania</option>
                          <option value="MU">Mauritius</option>
                          <option value="YT">Mayotte</option>
                          <option value="MX">Mexico</option>
                          <option value="FM">Micronesia, Federated States of</option>
                          <option value="MD">Moldova, Republic of</option>
                          <option value="MC">Monaco</option>
                          <option value="MN">Mongolia</option>
                          <option value="ME">Montenegro</option>
                          <option value="MS">Montserrat</option>
                          <option value="MA">Morocco</option>
                          <option value="MZ">Mozambique</option>
                          <option value="MM">Myanmar</option>
                          <option value="NA">Namibia</option>
                          <option value="NR">Nauru</option>
                          <option value="NP">Nepal</option>
                          <option value="NL">Netherlands</option>
                          <option value="NC">New Caledonia</option>
                          <option value="NZ">New Zealand</option>
                          <option value="NI">Nicaragua</option>
                          <option value="NE">Niger</option>
                          <option value="NG">Nigeria</option>
                          <option value="NU">Niue</option>
                          <option value="NF">Norfolk Island</option>
                          <option value="MP">Northern Mariana Islands</option>
                          <option value="NO">Norway</option>
                          <option value="OM">Oman</option>
                          <option value="PK">Pakistan</option>
                          <option value="PW">Palau</option>
                          <option value="PS">Palestinian Territory, Occupied</option>
                          <option value="PA">Panama</option>
                          <option value="PG">Papua New Guinea</option>
                          <option value="PY">Paraguay</option>
                          <option value="PE">Peru</option>
                          <option value="PH">Philippines</option>
                          <option value="PN">Pitcairn</option>
                          <option value="PL">Poland</option>
                          <option value="PT">Portugal</option>
                          <option value="PR">Puerto Rico</option>
                          <option value="QA">Qatar</option>
                          <option value="RE">Réunion</option>
                          <option value="RO">Romania</option>
                          <option value="RU">Russian Federation</option>
                          <option value="RW">Rwanda</option>
                          <option value="BL">Saint Barthélemy</option>
                          <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                          <option value="KN">Saint Kitts and Nevis</option>
                          <option value="LC">Saint Lucia</option>
                          <option value="MF">Saint Martin (French part)</option>
                          <option value="PM">Saint Pierre and Miquelon</option>
                          <option value="VC">Saint Vincent and the Grenadines</option>
                          <option value="WS">Samoa</option>
                          <option value="SM">San Marino</option>
                          <option value="ST">Sao Tome and Principe</option>
                          <option value="SA">Saudi Arabia</option>
                          <option value="SN">Senegal</option>
                          <option value="RS">Serbia</option>
                          <option value="SC">Seychelles</option>
                          <option value="SL">Sierra Leone</option>
                          <option value="SG">Singapore</option>
                          <option value="SX">Sint Maarten (Dutch part)</option>
                          <option value="SK">Slovakia</option>
                          <option value="SI">Slovenia</option>
                          <option value="SB">Solomon Islands</option>
                          <option value="SO">Somalia</option>
                          <option value="ZA">South Africa</option>
                          <option value="GS">South Georgia and the South Sandwich Islands</option>
                          <option value="SS">South Sudan</option>
                          <option value="ES">Spain</option>
                          <option value="LK">Sri Lanka</option>
                          <option value="SD">Sudan</option>
                          <option value="SR">Suriname</option>
                          <option value="SJ">Svalbard and Jan Mayen</option>
                          <option value="SZ">Swaziland</option>
                          <option value="SE">Sweden</option>
                          <option value="CH">Switzerland</option>
                          <option value="SY">Syrian Arab Republic</option>
                          <option value="TW">Taiwan, Province of China</option>
                          <option value="TJ">Tajikistan</option>
                          <option value="TZ">Tanzania, United Republic of</option>
                          <option value="TH">Thailand</option>
                          <option value="TL">Timor-Leste</option>
                          <option value="TG">Togo</option>
                          <option value="TK">Tokelau</option>
                          <option value="TO">Tonga</option>
                          <option value="TT">Trinidad and Tobago</option>
                          <option value="TN">Tunisia</option>
                          <option value="TR">Turkey</option>
                          <option value="TM">Turkmenistan</option>
                          <option value="TC">Turks and Caicos Islands</option>
                          <option value="TV">Tuvalu</option>
                          <option value="UG">Uganda</option>
                          <option value="UA">Ukraine</option>
                          <option value="AE">United Arab Emirates</option>
                          <option value="GB">United Kingdom</option>
                          <option value="US">United States</option>
                          <option value="UM">United States Minor Outlying Islands</option>
                          <option value="UY">Uruguay</option>
                          <option value="UZ">Uzbekistan</option>
                          <option value="VU">Vanuatu</option>
                          <option value="VE">Venezuela, Bolivarian Republic of</option>
                          <option value="VN">Viet Nam</option>
                          <option value="VG">Virgin Islands, British</option>
                          <option value="VI">Virgin Islands, U.S.</option>
                          <option value="WF">Wallis and Futuna</option>
                          <option value="EH">Western Sahara</option>
                          <option value="YE">Yemen</option>
                          <option value="ZM">Zambia</option>
                          <option value="ZW">Zimbabwe</option>
                        </select>
                      </div> -->
                      <div class="col-lg-8">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8">
                    <div class="row">

                     <!--  <div class="col-lg-8">
                        <label>State/Province</label>
                        <select class="form-control" data-live-search="true" tabindex="-1" aria-hidden="true">
                          <option value="AL">Alabama</option>
                          <option value="AK">Alaska</option>
                          <option value="AZ">Arizona</option>
                          <option value="AR">Arkansas</option>
                          <option value="CA">California</option>
                          <option value="CO">Colorado</option>
                          <option value="CT">Connecticut</option>
                          <option value="DE">Delaware</option>
                          <option value="DC">District Of Columbia</option>
                          <option value="FL">Florida</option>
                          <option value="GA">Georgia</option>
                          <option value="HI">Hawaii</option>
                          <option value="ID">Idaho</option>
                          <option value="IL">Illinois</option>
                          <option value="IN">Indiana</option>
                          <option value="IA">Iowa</option>
                          <option value="KS">Kansas</option>
                          <option value="KY">Kentucky</option>
                          <option value="LA">Louisiana</option>
                          <option value="ME">Maine</option>
                          <option value="MD">Maryland</option>
                          <option value="MA">Massachusetts</option>
                          <option value="MI">Michigan</option>
                          <option value="MN">Minnesota</option>
                          <option value="MS">Mississippi</option>
                          <option value="MO">Missouri</option>
                          <option value="MT">Montana</option>
                          <option value="NE">Nebraska</option>
                          <option value="NV">Nevada</option>
                          <option value="NH">New Hampshire</option>
                          <option value="NJ">New Jersey</option>
                          <option value="NM">New Mexico</option>
                          <option value="NY">New York</option>
                          <option value="NC">North Carolina</option>
                          <option value="ND">North Dakota</option>
                          <option value="OH">Ohio</option>
                          <option value="OK">Oklahoma</option>
                          <option value="OR">Oregon</option>
                          <option value="PA">Pennsylvania</option>
                          <option value="RI">Rhode Island</option>
                          <option value="SC">South Carolina</option>
                          <option value="SD">South Dakota</option>
                          <option value="TN">Tennessee</option>
                          <option value="TX">Texas</option>
                          <option value="UT">Utah</option>
                          <option value="VT">Vermont</option>
                          <option value="VA">Virginia</option>
                          <option value="WA">Washington</option>
                          <option value="WV">West Virginia</option>
                          <option value="WI">Wisconsin</option>
                          <option value="WY">Wyoming</option>
                        </select>
                      </div> -->

                      <div class="col-lg-8">
                        <label>Postal Code</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-8 col-md-8">
                    <label>Bio</label>
                    <textarea class="form-control" placeholder="Type here" rows="4"></textarea>
                  </div>
                </div>

                <!-- div class="form-group row">
                  <div class="col-lg-8 col-md-8">
                    <div class="row">
                      <div class="col-lg-8">
                        <label>Twitter Url</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                      <div class="col-lg-8">
                        <label>Linkedin Url</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                </div> -->

               <!--  <div class="form-group row">
                  <div class="col-lg-8 col-md-8">
                    <div class="row">
                      <div class="col-lg-8">
                        <label>Facebook Url</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                      <div class="col-lg-8">
                        <label>Instargam Url</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                </div> -->

              </div>
              <div class="col-md-4">
                <div class="card ">
                  <div class="card-header ">Announcements</div>
                  <div class="card-block ">
                    <h5 class="text-primary">11 Mrach,</h5>
                    <p>Don't miss out on all the latest news!<br>
                      We've just announced new template in our template series, That will be awesome and number one template very sooner!</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2 row">
              <div class="col-lg-16">
                <hr>
                <button type="button" class="btn btn-primary">Update Profile</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="tab-pane " id="messages" role="tabpanel">
        <div class="alert alert-info" >
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="alert-heading">Latest Events!</h4>
          <p>Latest events would show here.</p>
        </div>
        <div class="row">
          <div class="col-lg-8 col-sm-16">
            <div class="list-unstyled media-list" style="max-height:800px">
              <div class="media active new"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Adminux Welcome </h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media new"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Anchal Sharma<small class="text-danger pull-right"><i class="fa fa-flag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media new"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Maxartkiller <small class="text-success pull-right"><i class="fa fa-flag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
                </div>
              </div>
              <div class="media new"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Adminux Welcome <small class="text-warning pull-right"><i class="fa fa-flag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Anchal Sharma <small class="text-primary pull-right"><i class="fa fa-tag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Maxartkiller <small class="text-danger pull-right"><i class="fa fa-tag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Adminux Welcome </h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Anchal Sharma</h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body"> <span class="mt-0 mb-1">Maxartkiller</span>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col  pb-2 hidden-md-down">
            <div class="col p0" style="max-height:800px; overflow-y:auto">
              <div class="options-mail">
                <ul class="nav nav-pills pull-left">
                  <li class="nav-item">
                    <button class="btn btn-sm btn-link "><i class="fa fa-reply"></i> Reply</button>
                  </li>
                  <li class="nav-item">
                    <button class="btn btn-sm btn-link "><i class="fa fa-reply-all"></i> Reply All</button>
                  </li>
                  <li class="nav-item">
                    <button class="btn btn-sm btn-link "><i class="fa fa-forward"></i> Forward</button>
                  </li>
                  <li class="nav-item">
                    <button class="btn btn-sm btn-link "><i class="fa fa-trash"></i> Delete</button>
                  </li>
                </ul>
                <ul class="nav nav-pills pull-right">
                  <li class="nav-item">
                    <button class="btn btn-sm btn-outline-primary "><i class="fa fa-chevron-left"></i></button>
                  </li>
                  <li class="nav-item">
                    <button class="btn btn-sm btn-outline-primary ml-2"><i class="fa fa-chevron-right"></i></button>
                  </li>
                </ul>
              </div>
              <div class="clearfix"></div>
              <h3 class="mt-2">Mozallo Welcome</h3>
              <div class="list-unstyled comment-list">
                <div class="media "> <span class="message_userpic"><img class="d-flex mr-3" src="./css/images/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">Mozallo<small class="pull-right">2:00 pm, 20 January, 2017</small></h6>
                    <p class="description mb-0">info@mozallo.com </p>
                  </div>
                </div>
              </div>
              <hr>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem <br>
                ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend <br>
                <br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend <br>
                <br>
                Thanks,<br>
                <b>Lucky Sans</b></p>
              <div class="row m-0">
                <figure class="responsive-img col-lg-4 col-md-8"> <a href="./css/images/project_pic3.jpg" rel="gallery-2" class="swipebox" title="My Caption"><img src="./css/images/project_pic3.jpg" alt="post picture"></a> </figure>
                <figure class="responsive-img col-lg-4 col-md-8"> <a href="./css/images/project_pic1.jpg" rel="gallery-2" class="swipebox" title="My Caption"><img src="./css/images/project_pic1.jpg" alt="post picture"></a> </figure>
                <figure class="responsive-img col-lg-4 col-md-8"> <a href="./css/images/project_pic2.jpg" rel="gallery-2" class="swipebox" title="My Caption"><img src="./css/images/project_pic2.jpg" alt="post picture"></a> </figure>
              </div>
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
  <footer class="footer-content ">
    <div class="container ">
      <div class="row align-items-center justify-content-between">
        <div class="col-md-16 col-lg-8 col-xl-8">Copyright <a href="http://trial.mozallo.com/" target="_blank" class="">trial.mozallo.com</a></div>
        <div class="col-md-16 col-lg-8 col-xl-8 text-right"><a href="#" target="_blank" class="">Privacy Policy</a> | <a href="#" target="_blank" class="">Terms of use</a> </div>
      </div>
    </div>
  </footer>