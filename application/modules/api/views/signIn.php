<!DOCTYPE html>
<html >
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width">
      <title>Dezion - login</title>
  
  
      <!-- <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'> -->
      <link rel="stylesheet" href="<?= base_url() ?>library/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?= $demo_path; ?>css/bootstrap.css" type="text/css"> 
      <link rel="stylesheet" href="<?= base_url() ?>library/demo/css/style.css"> 

      <!-- tooltips css -->
      <link href="<?= $lib_path; ?>js/ng-tooltips/dist/angular-tooltips.min.css" />

      <!-- ngDialog -->
      <link rel="stylesheet" href="<?= base_url(); ?>library/js/ng-dialog/css/ngDialog.min.css">
      <link rel="stylesheet" href="<?= base_url(); ?>library/js/ng-dialog/css/ngDialog-theme-default.min.css">

      <style>

        .field-icon{
          position: fixed;
          top: 39px;
        }

        .field-icon2{
        position: fixed;
        top: 25px;
        }
      </style>
   </head>

   <body ng-app='loginApp' >

      <div class="body-overlay"> 
         <div class="login-wrap">
            <div class="login-html">
               <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
               <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

               
               
        
               <div class="login-form">
                  <div class="sign-in-htm">

                  <div class="group">
                <i class="fa fa-info-circle fa-2x" tooltip title="Username : admin Password: admin" data-toggle="tooltip" data-placement="top" aria-hidden="true" style="color: beige;"></i>
              </div>
                     <form name="loginForm"  ng-controller='loginController' ng-submit='login()' autocomplete="off" novalidate >

                      
                     

                        <div class="group">
                           <i class="fa fa-user field-icon" aria-hidden="true"></i>
                           <input   id="user"
                                    type="text" 
                                    class="input" 
                                    placeholder="Username"
                                    ng-model="user.username"
                                    required />
                        </div>

                        <div class="group">
                           <i class="fa fa-lock field-icon2" aria-hidden="true"></i>
                           <input   id="pass" 
                                    type="password" 
                                    class="input" 
                                    data-type="password" 
                                    placeholder="Password"
                                    ng-model='user.password'
                                    required />
                        </div>

                        <div class="group">
                           <input type="submit" class="button" value="Sign In">
                        </div>

                     </form>   

                     <div class="hr"></div>
                     <div class="foot-lnk" id="tab-2" type="radio" name="tab" class="sign-up">
                        <label for="tab-2" class="tab foot-lnk">Forgot Password?</label>
                     </div>

                  </div>

                  <div class="sign-up-htm">

                     <div class="group">
                        <i class="fa fa-user " aria-hidden="true"></i>
                        <input id="user" type="text" class="input" placeholder="Username">
                     </div>

                     <div class="group">
                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                        <input id="pass" type="password" class="input" data-type="password" placeholder="Last Password">
                     </div>

                     <div class="group">

                        <input type="submit" class="button" value="Reset Password">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> 
   </body>

    <script src="<?= base_url();?>library/js/angular.min.js" ></script>

    <script src="<?= $demo_path; ?>js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="<?= $demo_path; ?>js/tether.min.js" type="text/javascript"></script>
		<script src="<?= $demo_path; ?>js/bootstrap.min.js" type="text/javascript"></script>

   <!-- ng tooltips -->	
   <script src="<?= $lib_path; ?>js/ng-tooltips/dist/angular-tooltips.min.js"></script>

    <!-- ng Dialog module -->
    <script src="<?= base_url() ?>library/js/ng-dialog/js/ngDialog.min.js"></script>

   <script type="text/javascript" src='<?= base_url() ?>library/js/loginApp.js'></script>
</html>


