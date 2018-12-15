<head>
    <style type="text/css">
     

    .row{
        
      padding-bottom: 20px;
    }


      label{
       margin-bottom: 5px;
      font-weight: normal;
      font-size: 13px;
      }

    
      .form-control:focus{
        border-color: black
      }


    </style>
    <script type="text/javascript">
      
      $(document).ready(function(){

        

      })//end document.ready()
    </script>
  </head>

  <?php

    $this->load->model('members/mdl_members');
    $member = $this->mdl_members->all_with_id($member_id);
    $row = $member->row_array();


    $firstname      = $row['firstname'];
    $surname        = $row['surname'];
    $middlename     = $row['middlename'];
    $dob            = $row['dob'];
    $telephone1     = $row['telephone1'];
    $telephone2     = $row['telephone2'];
    $age_bracket    = $row['age_bracket'];
    $address        = $row['address'];
    $email          = $row['email'];
    $marital_status  = $row['marital_status'];
    $gender         = $row['gender'];
    $member_status  = $row['member_status'];
    $occupation     = $row['occupation'];

  ?>

      <form  action= "<?php echo base_url() ?>members/updateInfo/?member_id=<?php echo $member_id ?>" method="POST"  >
        <div class="container-fluid">

        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12 col-sm-12">
                <ol class="breadcrumb">
              <li><a href="<?php echo base_url() ;?>admin/">Admin</a></li>
              <li><a href="<?php echo base_url() ;?>members/">Members</a></li>
              <li class="active">Register Member</li>
            </ol>
            </div>
          </div>


          <div class="col-md-10 col-md-offset-1 col-xs-12 col-sm-12">

          <?php 
          //open panel
            echo $this->templates->top('Update Member Info', 'fa fa-user-plus');
          ?>
              
              <div class="row">
                <div class="col-md-10 col-md-offset-1" id="message">
                  <?php 
                     $m = (isset($message)) ? $message : null;
                     $rc = (isset($report_class)) ? $report_class : null;
                     echo $this->templates->message($m, $rc); 
                     echo $this->templates->flash_message();               
                  ?>
                </div>
              </div>

              <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="surname"><span class='asterik'>*</span>Surname</label>
            </div>
            <div class="col-md-6 col-xs-8">
              <input type="text" name="surname" id="surname" value="<?php echo $surname ;?>" class="form-control" placeholder="Surname" required />
            </div>
          </div>


              <div class="row">
                <div class="col-md-2 col-xs-12">
                  <label for="firstname"><span class='asterik'>*</span>First Name</label>
                </div>
                <div class="col-md-6 col-xs-8" >
                  <input type="text" name="firstname" id="firstname" value="<?php echo $firstname ?>" class="form-control" placeholder="First Name"  required />              
                </div>
              </div>


              <div class="row">
                <div class="col-md-2 col-xs-12">
                  <label for="middlename" >Middle Name</label>
                </div>
                <div class="col-md-6 col-xs-8">
                  <input type="text" name="middlename" id="middlename" value="<?php echo $middlename ?>" class="form-control" placeholder="Middle Name" />             
                </div>
              </div>

          

          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="dob"><span class='asterik'>*</span>Date-Of-Birth</label>
            </div>
            <div class="col-md-6 col-xs-8">
              <input type="date" name="dob" id="dob" value="<?php echo $dob ?>" class="form-control" placeholder="yyyy-mm-dd" " required/>
            </div >
          </div>


          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="age_bracket"><span class='asterik'>*</span>Age Bracket</label>
            </div>
            <div class="col-md-6 col-xs-8">
              <select type="date" name="age_bracket" id="age_bracket" value="<?php echo $age_bracket;?>" class="form-control" required >
              <option value="<?php echo $age_bracket ?>"><?php echo $age_bracket ;?></option>
              <option value="13-18">13-18</option>
              <option value="19-25">19-25</option>
              <option value="26-35">26-35</option>
              <option value="36-45">36-45</option>
              <option value="46-55">46-55</option>
              <option value="56+">56+</option>
              </select>
            </div >
          </div>



          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="address">Address</label>
            </div>
            <div class="col-md-6 col-xs-8">
              <input type="text" name="address" id="address" value="<?php echo $address ?>" class="form-control" placeholder="address"  required />
            </div>
          </div>



          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="email">E-mail</label>
            </div>
            <div class="col-md-6 col-xs-8">
              <input type="email" name="email" id="email"  maxlength="100" value="<?php echo $email ;?>" class="form-control" placeholder="lagbaja@gmal.com" />
            </div>
          </div>


          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="occupation">Occupation</label>
            </div>
            <div class="col-md-6 col-xs-8">
              <input type="text" name="occupation" id="occupation" value="<?php echo $occupation ; ?>" class="form-control" placeholder="occupation" />
            </div>
          </div>



          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="telephone1"><span class='asterik'>*</span>Telephone1</label>
            </div>
            <div class="col-md-6 col-xs-8">  
              <input type="number" maxlength="11" name="telephone1" id="telephone1" value="<?php echo $telephone1 ;?>" class="form-control" placeholder="Telephone 1"  required/>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="telephone2">Telephone2</label>
            </div>
            <div class="col-md-6 col-xs-8">  
              <input type="number" maxlength="11" name="telephone2" id="telephone2" value="<?php echo $telephone2 ;?>" class="form-control" placeholder="Telephone 2" />
            </div>
          </div>


          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="marital_status"><span class='asterik'>*</span>Marital Status</label>
            </div>
          <label class="radio-inline">
            <input type="radio" name = "marital_status" id="marital_staus_s" value="s" <?php if($marital_status == 's' || $marital_status == 'S' ) echo "checked" ;?> /> Single
          </label>
          <label class="radio-inline">
            <input type="radio" name = "marital_status" id="marital_staus_m" value="m" <?php if($marital_status == 'm' || $marital_status == 'M') echo "checked" ;?> /> Married
          </label>
          </div>



          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="marital_status"><span class='asterik'>*</span>Gender</label>
            </div>
          <label class="radio-inline">
            <input type="radio" name = "gender" id="gender_m" value="m" <?php if($gender == 'm' || $gender == 'M' ) echo "checked" ;  ?> /> Male
          </label>
          <label class="radio-inline">
            <input type="radio" name = "gender" id="gender_f" value="f" <?php if($gender == 'f' || $gender == 'F' ) echo "checked" ; ?> /> Female
          </label>
          </div>


          <div class="row">
            <div class="col-md-2 col-xs-12">
              <label for="address"><span class='asterik'>*</span>Member Status</label>
            </div>
            <div class="col-md-6 col-xs-8">
              <input type="text" name="member_status" id="member_status" value="<?php echo $member_status ;?>" class="form-control" placeholder=" example hod, small group Leader, membe, pastor "  required/>
            </div>
          </div>

          <div class="row">
            <div class="col-md-1 col-md-offset-4 col-xs-1">
              <input type="submit" class="btn btn-primary" name="submit" value="Update">
            </div>
          </div>

          <?php echo $this->templates->top_close();  //close panel ?>

            </div>
      </div> 
      </form>   
        
      

        <!-- /page content -->

       