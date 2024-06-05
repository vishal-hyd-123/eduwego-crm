<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <div class="demo-container">
        <div class="left" style="padding: 50px 68px;">

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

            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo base_url(); ?>assets/dashboard/img/up.png" alt="" class="up">
                    <h6 class="uph">100% Institutes Onboarded</h6>
                </div>
                <div class="col-md-6">
                    <img src="<?php echo base_url(); ?>assets/dashboard/img/up.png" alt="" class="up">
                    <h6 class="uph">6000+ Students Enrolled</h6>
                </div>
            </div>

            <div class="two">
                <p class="upp">AN ISO 9001:2015 CERTIFIED CRM | AN ISO 2700:2015 CERTIFIED CRM</p>
            </div>


            <div class="row mt-4">
                <div class="col-md-3 text-center">
                    <img src="<?php echo base_url(); ?>assets/dashboard/img/secure_logo_bg.png" alt="" class="" width="120px">
                </div>
                <div class="col-md-3 text-center">
                    <img src="<?php echo base_url(); ?>assets/dashboard/img/best_seller_bg.png" alt="" class="" width="120px">
                </div>
                <div class="col-md-3 text-center">
                    <img src="<?php echo base_url(); ?>assets/dashboard/img/trusted_logo.png" alt="" class="" width="120px">
                </div>
            </div>

        </div>
        <div class="right">
                <center><img src="<?php echo base_url(); ?>assets/dashboard/img/loginlogo.png" width="120%" alt="" class="brand"></center>
                <hr>
            <div class="head">
            <center>
                <h3 class="brandh">
                    BOOK YOUR DEMO NOW
                </h3>
            </center>

            </div>
            
                <form id="demoRequest">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            Institute Name <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="text" name="institute_name" class="form-control Email_Input" required>
                        </div>

                        <div class="col-md-6 form-group">
                            Institute Website <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="website" name="website" class="Email_Input form-control">
                        </div>

                        <div class="col-md-6 form-group">
                            Your Name <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="text" name="uname" class="form-control Email_Input" required>
                        </div>

                        <div class="col-md-6 form-group">
                            Your Designation <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="text" name="udesignation" class="form-control Email_Input" required>
                        </div>

                        <div class="col-md-6 form-group">
                            Email <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="email" name="uemail" class="form-control Email_Input" required>
                        </div>

                        <div class="col-md-6 form-group">
                            Phone Number <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="number" name="uphone" class="form-control Email_Input" required>
                        </div>

                        <div class="col-md-6 form-group">
                            Date of Demo
                            <br>
                            <input type="date" name="demo_date" class="form-control Email_Input">
                        </div>

                        <div class="col-md-6 form-group">
                            Time of Demo
                            <br>
                            <input type="time" name="demo_time" class="form-control Email_Input">
                        </div>

                        <div class="col-md-6 form-group">
                            Preffered time to call <span class="ast" style="color:red;"> * </span>
                            <br>
                            <select class="form-control" name="time_to_call">
                                <option value="8AM - 10AM">8AM - 10AM</option>
                                <option value="10AM - 12.00">10AM - 12.00</option>
                                <option value="12.00 - 4PM">12.00 - 4PM</option>
                                <option value="4PM - 8PM">4PM - 8PM</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            Preffered Language <span class="ast" style="color:red;"> * </span>
                            <br>
                            <select class="form-control" name="language" required>
                                <option value="">Select Language</option>
                                <option value="English">English</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Bengali">Bengali</option>
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            Institute Full Address <span class="ast" style="color:red;"> * </span>
                            <br>
                            <textarea class="form-control" name="address"></textarea>
                        </div>

                        <div class="col-12 form-group d-flex">
                            <input type="checkbox" name="agree" required /> 
                            <label class="mt-2 ml-2" style="font-size:17px">I agree to the <a href="">Terms of use</a> and <a href="">Privacy Policy</a></label> <span class="ast" style="color:red;"> * </span>
                        </div>

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

                   <div class="form-group text-center">
                        <input type="submit" value="Request A Demo" class="login form-control">
                        <i class="fa fa-spinner fa-spin d-none" style="font-size:24px"></i>
                        <br>
                    </div>
                    
                </form>

                <div class="brand-info">
                   <div class="social-icons">
                       <a href="#"><i class="fa fa-linkedin"></i></a>
                       <a href="https://twitter.com/eduwego"><i class="fa fa-twitter"></i></a>
                       <a href="https://www.facebook.com/eduwego"><i class="fa fa-facebook"></i></a>
                       <a href="https://www.youtube.com/channel/UCp51eKXrpaozytRzbPY-aig"><i class="fa fa-youtube"></i></a>
                       <a href="#"><i class="fa fa-instagram"></i></a>
                   </div>
                   <p>© ZEQOON TECHNOLOGY PRIVATE LIMITED.</p>
                </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
      $('#demoRequest').submit(function(event){
       event.preventDefault();
       var data   = $(this).serialize();
       $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/saveDemoForm',
            data: data,
            beforeSend: function(){
              $('.fa-spin').removeClass('d-none');
            },
            success: function(data){
              $('.fa-spin').addClass('d-none');
              var data = JSON.parse(data);
              var status = data.status;

              if(status == true)
              {
                $('#demoRequest')[0].reset();
                $(".alert-success").removeClass('d-none');
                $(".success-msg").html(data.message);
                setTimeout(function(){
                   $(".alert-success").addClass('d-none');
                   window.location = 'https://apps.eduwego.in';
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