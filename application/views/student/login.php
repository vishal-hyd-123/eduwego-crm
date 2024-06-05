<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Paperless Admission Management System" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url(); ?>assets/dashboard/img/icon.png" type="image/jpeg" sizes="">
    <title><?php echo $site_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower-components/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/style.css" type="text/css">
</head>

<body>
    <div class="login-container">
        <div class="left">

        <div class="one">
            <!-- <img src="img/icon.png" alt="" class="icon"> -->
            <span class="iconh1">EDUWEGO+</span>
            <p class="tag-line">Paperless Admission Management System</p>
            <h4 class="iconh2">Power-up Your Admissions & Fees Management Easily</h4>
        </div>

        <div class="two">
            <img src="<?php echo base_url(); ?>assets/dashboard/img/up.png" alt="" class="up">
            <h5 class="uph">Upto 90% Increase in Admissions Lead Conversions</h5>
            <p class="upp">Respond faster to incoming leads, collaborate with team members, and share prospectus, fees details & applications forms quicker.</p>
        </div>

        <div class="three">
            <img src="<?php echo base_url(); ?>assets/dashboard/img/invest.svg" alt="" class="invest">
            <h5 class="investh">Upto 90x Improvement in Student and Associates Relations</h5>
            <p class="investp">360°-degree view of admission conversations fees, contacts, associates. Team members can access
                history of all customers and provide delightful support.</p>
        </div>

        <div class="four">
            <img src="<?php echo base_url(); ?>assets/dashboard/img/down.png" alt="" class="down">
            <h5 class="downh">90% Reduction in Fees & Support Engine</h5>
            <p class="downp">Now reduce your burden of fee collection with our fee Management and online receipt features with dyanamic calculation features.</p>
        </div>

        </div>
        <div class="right">
            <center><img src="<?php echo base_url(); ?>assets/dashboard/img/loginlogo.png" width="120%" alt="" class="brand"></center>
            <hr>
            <div class="head">
            <center>
                <h3 class="brandh">
                    Welcome Back Student<br>Login to <span class="b-name">Eduwego+</span>
                </h3>
            </center>

            </div>
            
            <div class="alert alert-danger alert-dismissible d-none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <i class="fa fa-times-circle" style='font-size:20px'></i> 
                <span class='error-msg'></span>
            </div>

            <div class="alert alert-success alert-dismissible d-none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <i class="fa fa-check-circle" style='font-size:20px'></i> <span class='success-msg'></span>
            </div>

                <form id="studentLogin">
                    Registered Mobile No. <span class="ast" style="color:red;"> * </span>
                    <br>
                    <input type="number" name="mobile" placeholder="Registered Mobie No." class="Email_Input" required>
                    
                    Password <span class="ast" style="color:red;"> * </span>
                    <br>
                    <input type="password" name="password" class="Email_Input" id="password" placeholder="Enter your password" required>
                    
                    <center>
                        <input type="submit" value="Login" class="login">
                        <i class="fa fa-spinner fa-spin d-none" style="font-size:24px"></i>
                        <br>
                        <a id="forgot_Password"><h3 class="forgot" >Forgot Password?</h3></a>
                    </center>
                </form>
        </div>
    </div>

    <div class="modal Modal_" id="ForgetPassword">
        <div class="modal-dialog" >
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-body">
                  <button type="button" class="close forgotClose" data-dismiss="modal">&times;</button>
                  <div class="frgt_Padd">
                    <div class="row inner-row-ryt-1">
                      <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center Login_Ryt_text _mobileFra">
                         <img class="nextynFavLogo" src="<?php echo base_url(); ?>assets/dashboard/img/loginlogo.png">
                          <p class="" style="margin-bottom: 10px">Reset Password</p>
                          <div id="validation-errorF"></div>
                          <div class="show"></div>
                      </div>                    
                    </div>

                    <div class="alert alert-danger email-danger alert-dismissible d-none">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <i class="fa fa-times-circle" style='font-size:20px'></i> 
                        <span class='error-msg'></span>
                    </div>

                    <div class="alert alert-success email-success alert-dismissible d-none">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <i class="fa fa-check-circle" style='font-size:20px'></i> <span class='success-msg'></span>
                    </div>

                    <form id="resetPassword" method="post" action="associate/agent_forgot_password">
                      <div class="row justify-content-center">
                        <div class="col-12 col-md-11 col-lg-10 text-center Login_Email">
                          <input type="email" name="email" placeholder="Registered Email Address" class="Email_Input" required="">
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-6" style="margin-top: 30px">
                          <input type="submit" value="RESET PASSWORD" class="Login_btn_Input">

                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
     </div>

    <script src="<?php echo base_url(); ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
      $('#studentLogin').submit(function(event){
       event.preventDefault();
    
       $.ajax({
         type : 'POST',
         url : '<?=base_url(); ?>Student/student_login',
         data: $(this).serialize(),
         beforeSend: function(){
          $('.fa-spin').removeClass('d-none');
         },
         success: function(data){
          $('.fa-spin').addClass('d-none');
          var data = JSON.parse(data);
          var status = data.status;

          if(status == true)
          {
            $(".alert-success").removeClass('d-none');
            $(".success-msg").html(data.message);
            setTimeout(function(){
                window.location.href = '<?=base_url(); ?>Student/myProfile';
            },4000);
          } else if(status == false){
            $(".alert-danger").removeClass('d-none');
            $(".error-msg").html(data.errormessage);
            setTimeout(function(){
                $(".alert-danger").addClass('d-none');
            },4000);
          }       
         }
     });

    });

</script>

<script>
    $('#resetPassword').submit(function(event){
       event.preventDefault();
       var data   = $(this).serialize();
       var action = $(this).attr('action');
       var method = $(this).attr('method');
       $.ajax({
         type: method,
         url:action,
         data: data,
         beforeSend: function(){
          $(".Login_btn_Input").val("Please Wait...");
         },
         success: function(data){
            $(".Login_btn_Input").val("RESET PASSWORD");
            var data = JSON.parse(data);
            var status = data.status;

            if(status == true)
            {
                $(".email-success").removeClass('d-none');
                $(".email-success .success-msg").html(data.message);
                setTimeout(function(){
                    $(".email-success").addClass('d-none');
                    $('#ForgetPassword').modal('hide');
                },4000);
            } else if(status == false){
                $(".email-danger").removeClass('d-none');
                $(".email-danger .error-msg").html(data.message);
                setTimeout(function(){
                    $(".email-danger").addClass('d-none');
                },4000);
            }  
        }
     });

    });

    $(document).on('click', '#forgot_Password', function(){
      $('#ForgetPassword').modal('show');
    })

    var getHeight = $('.Login_Ryt').innerHeight();
    $('.imgRad').css('height', getHeight+'px');

</script>
        
</body>
</html>