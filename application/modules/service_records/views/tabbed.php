<!DOCTYPE html>
<html>
  <head>
    <title>Main Page</title>
    <link rel="stylesheet" href="<?php echo base_url();?>library/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo base_url();?>library/font-awesome/css/font-awesome.min.css" >
    <link rel="stylesheet" href="<?php echo base_url();?>library/jquery-ui/jquery-ui.min.css" >
    <style type="text/css">

    .row{
      margin-bottom: 20px;
    }

    #tabb label{
      font-family: Arial;
      font-size: 16px;
      font-weight: 300;
    }

    h2{
      padding-bottom :  50px;
    }

    ul.ui-tabs-nav.ui-helper-reset.ui-helper-clearfix.ui-widget-header.ui-corner-all{
     /* background-color: #4CAF50; */
    }

    #number_of_visitors{
      padding-bottom: 30px;
    }

    .fa{
      padding-left: 3px;
      
    }

    #offering .col-sm-1{
      width: 2% ;
    }

    #offering .col-sm-2{
      width: 11% ;
    }

    #offering .row{
       margin-bottom: 20px;
    }

    #offering input{
      /*visibility: hidden;*/
      width: 150px;
        height: 33px
    }

    #attendance .col-sm-1{
      width: 10.33333333%
    }

    #visitors .col-sm-2{
      width: 14.66666667%;
    }

    #visitor_count_row{
      width: 6.33333%;
        padding-right: 3px;;
    }

    #reg_head{
      margin-top: 70px;
    }

    #test .row{
      margin-bottom: 30px;
    }

    #submit_all{
      margin-top: 40px;
    }

    .fa-cog{
      float: right;
        font-size: 23px;
        padding-right: 10px;
        padding-top: 5px;
    }

    </style>
    <script type="text/javascript" src="<?php echo base_url(); ?>library/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>library/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>library/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript">
      
      $(document).ready(function(){

        //the following code controls the service tab
        //hides the custom input, until custom is chosen from the service dropdown
        //when the custom option is selected, the custom input shows and the servoce input is faded!
        $('#custom_service').hide();

        $('#service_main').change(function(){

          if($(this).val() == 'custom'){
            $('#custom_service').show()
            $('#main_service').css('opacity', 0.2);
          }else{
            $('#custom_service').hide();
            $('#main_service').css('opacity', '');
          }



          service_code = $(this).val();
          
          query_string = "";
          $.get('<?php echo base_url(); ?>servoff/tabbed_offerings/' + service_code, query_string, show_offerings);

          function show_offerings(data){
            $('#ajax_offering').html(data);
          }
          
          //alert(service_id);

          //alert( $('input[id="_sunday_service"]').attr('name'));
        })




        //uses jQuery ui to contol the tabs!
        $('#tabb').tabs({
          'show' : 'slideDown',
          'hide' : 'slideUp'
        });

        //$('#date').click(function(){
        //  $(this).datepicker();
        //})


        //code to toggle the plus and minus sign

        $('#offering input').hide();

        $('.fa-minus, .fa-plus').click(function(){
          $(this).toggleClass('fa-minus');
          $(this).toggleClass('fa-plus');
          var fa_id = $(this).attr('id');
          var j = '#_'+fa_id
          $(j).toggle()         
        })


        //the code below works for the visitor registeration part
        //identified by an id of 'attendance'

        
          
          //alert(t)
          $('#reg_head').hide()

          $('button[id="submit_visitor_count"]').click(function(e){

            e.preventDefault();
            
            
            var number = $('#visitor_count').val();
            var count = 1;
            if(number >=1){
              $(this).attr('disabled', true);
              
              $('#reg_head').show()
              do{
                var t = "<div class='row' id='" + count + "'>"
                t += "<div class='col-md-3 col-md-offset-2'>"
                t += "<input name='visitor_name[]' id='visitor_name' type='text' maxlength='40' class='form-control' required/>"
                t += "</div>"
                t += "<div class='col-md-2'>"
                t += "<input name='visitor_phone[]' id='visitor_phone' type='number' maxlength='11' class='form-control' required/>"
                t += "</div>"
                t += "<div class='col-md-4'>"
                t += "<input name='visitor_address[]' id='visitor_address' type='text' maxlength='100' class='form-control' required/>"
                t += "</div><a href='#' ><i id='" + count + "' class='fa fa-times fa-1x'</i></a></div>"

                $('#test').append(t);
                count++;            
              }while(count <= number);
            }else{
              $('#reg_head').hide()

            }                             
          })

          $('#test .fa-times').click(function(e){
            e.preventDefault()
            //fa_times_id = $(this).val();
            //$('div#'+ fa_times_id + '.row').hide();
            //alert(fa_times_id)
            alert('clicked')
          })


          /*
          $('#visitors .fa').click(function(e){
            e.preventDefault();
            alert('clicked');
          })
          */

          $('#submit_all').click(function(e){
            if( $('#service_main').val() == '#'){
              e.preventDefault();

              $('<div><div>').html('please select a service type in the Service tab!').dialog({
                buttons : {
                  "OK" : function() {
                    $(this).dialog('close');
                  }
                
                },

                'draggable': true,
                'modal' : true,
                'show'  : 'slideDown',
                'hide'  : 'explode',
                'title' : 'service select error'
              })
            }


            var dt = $('#date').val();
            query_string = "";
            $.get('<?php echo base_url(); ?>report/date_check_ajax/' + dt, query_string, invalid_date_alert);

            function invalid_date_alert(data){
              if(data == 'false'){
                e.preventDefault();
                $('<div><div>').html('invalid date. please ensure you follow the date format!').dialog({
                buttons : {
                  "OK" : function() {
                    $(this).dialog('close');
                  }
                
                },

                'draggable': true,
                'modal' : true,
                'show'  : 'slideDown',
                'hide'  : 'explode',
                'title' : 'Invalid Date Error'
              })
              } 
            }
          })
      })

    </script>

  </head>

  <body>
  <p>Admin | Service</p>
    <div class="container-fluid">
      <div id='tabb'>
        <form method="POST" action="newService">
          <ul>
            <li><a href="#service">Service</a></li>
            <li><a href="#offering">Offering</a></li>
            <li><a href="#attendance">Attendance</a></li>
            <li><a href="#visitors">Visitors</a></li>           
          </ul>

          <!================= service section ======================>

          <div  id='service'>
            <h2> service </h2>

            <div class="row">
              <div class="col-md-1 col-md-offset-2 "><label>Date</label></div>
              <div class="col-md-4">
                <input type="date" name="date" placeholder="YYYY/MM/DD" id="date" class="form-control required">
              </div>
            </div>

            <div class="row" id="main_service">
              <div class="col-sm-1 col-md-offset-2 "><label>Service</label></div>
              <div class="col-md-4">
                <select name="service_main" id="service_main" class="form-control">
                  <option value="#"> select Service Type </option>
                  <?php
                    $this->load->model('services/Mdl_services');
                    $query = $this->Mdl_services->all_service();
                    foreach($query->result() as $service){
                      echo "<option id=".$service->id."' 'name='".$service->code."' value='".$service->code."'>$service->name</option>";
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="row" id="custom_service">
              <div class="col-md-1 col-md-offset-2 "><label>Custom</label></div>
              <div class="col-md-4">
                <input type="text" maxlength="50" name="service_custom" id="service_custom" class="form-control required">
              </div>
            </div>

            <div class="row" id="custom_service">
              <div class="col-md-1 col-md-offset-2 "><label>Minister</label></div>
              <div class="col-md-1 ">
                <select class="form-control">
                  <option>title</option>
                  <option>Pst.</option>
                  <option>Rev.</option>
                  <option>Mr</option>
                  <option>Mrs</option>
                  <option>Evan.</option>
                </select>
              </div>
              <div class="col-md-3a">
                <input type="text" maxlength="50" name="minister " id="minister"  placeholder="minister's name" class="form-control" required >
              </div>
            </div>

            <div class="row" id="custom_service">
              <div class="col-md-1 col-md-offset-2 "><label>Bible Text</label></div>
              <div class="col-md-3">
                <input type="text" maxlength="50"name="bible_texts" placeholder="bible texts" id="bible_texts" class="form-control" required>
              </div>
            </div>                    
          </div><!-- end service section -->

          <!========================= Offering section ===============-->

          <div id='offering'>

            <h2> Offering </h2>
            <div id="ajax_offering">
              <p> No service Selected Yet. </p>
            </div>                    
          </div><!-- end offering section -->

          <!========================= Attendance section ===============-->

          <div id='attendance'>

            <h2> Attendance </h2>

            <div class="row">
              
              <div class="col-md-3 col-md-offset-3">
                <input name="adult_male" placeholder="Adult male" type="number" id="adult_male" class="form-control">
              </div>
            </div>

            <div class="row">
              
              <div class="col-md-3 col-md-offset-3">
                <input name="adult_female" placeholder="Adult female" type="number" id="adult_female" class="form-control">
              </div>
            </div>

            <div class="row">
              
              <div class="col-md-3 col-md-offset-3">
                <input name="children_male" placeholder="Children male" type="number" id="children_male" class="form-control">
              </div>
            </div>

            <div class="row">
              
              <div class="col-md-3 col-md-offset-3">
                <input name="children_female" placeholder="Chldren Female" type="number" id="children_female" class="form-control">
              </div>
            </div>
          </div><!-- end attendance section -->

          <!========================= Visitors section ===============-->

          <div id='visitors'>

            <h2> Visitors </h2>
            <div class="row">
              <div class="col-sm-2 col-md-offset-2"><label>Number of Visitors</label></div>
              <div class="col-sm-2">
                <input name="visitor_count" id="visitor_count" type="number" maxlength="2" class="form-control" />
              </div>
              <div class="col-sm-1" id='visitor_count_row'>
                <button id="submit_visitor_count" class="btn btn-default" value="register" >register</button>
              </div>
            </div>


            <!================= visitor's registeration form shows here ==============>

            <div id="test">
              <div class="row" id='reg_head'>
                <div class="col-md-3 col-md-offset-2"><label>Visitor's Name</label></div>
                <div class="col-md-2 "><label>Mobile Number</label></div>
                <div class="col-md-4 "><label>Address</label></div>
              </div>
            </div>  

            <div class="row">
              <div class="col-md-1 col-md-offset-6">
                <input type="submit" value="submit" class="btn btn-default" id="submit_all" name="submit" >
              </div>
            </div>  
          </div><!-- end visitors section -->
        </form>
      </div><!-- end tabb -->
    </div><!-- end container-fluid -->
  </body>
</html>   
