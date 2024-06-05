<?php
  $base_url = base_url();

  $banner_img = $enquiry_banner->banner_img;
  $bgurl = $base_url."uploads/".$banner_img;
  if(!empty($enquiry_banner->banner_img))
  {
       $bgurl = $base_url."uploads/".$enquiry_banner->banner_img;                               
  }else{
       $bgurl =  $base_url."assets/dashboard/img/loginbg.png";          
  }

  // if(!empty($institute[0]->banner))
  // {
  //   $bgurl = $base_url."uploads/".$institute[0]->banner;                               
  // }else{
  //   $bgurl =  $base_url."assets/dashboard/img/loginbg.png";          
  // }
?>
<!DOCTYPE html>
<html lang="en">
<title>Enquire Now for Admission - <?=$institute[0]->institute_name; ?></title>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Enquire now with Our Online Admission Team for Your Seat Booking in <?=$institute[0]->institute_name; ?> Bangalore" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url(); ?>assets/dashboard/img/icon.png" type="image/jpeg" sizes="">
    <title><?php echo $site_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower-components/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/style.css" type="text/css">
</head>

<body>
    <div class="enq-con row" style="background-image : url('<?php echo $bgurl; ?>')">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <div class="right">
                <div class="head">
                    <center>
                        <h4 class="brandh">
                            Admission Open 2024-25
                        </h4>
                    </center>
                </div>
                <div class="logo-con">
                    <img class="instLogo" src="<?php echo $base_url."uploads/".$institute[0]->institute_logo; ?>" width="80px" height="80px">
                    <h5 class="text-capitalize"><?php echo $institute[0]->institute_name; ?></h5>
                </div>
                
                    <form id="studentSignup" method="POST" action="<?php echo $base_url; ?>institute/studentSignup">

                        <div class="alert alert-danger alert-dismissible d-none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <i class="fa fa-times-circle" style='font-size:20px'></i> 
                            <span class='error-msg'></span>
                        </div>

                        <div class="alert alert-success alert-dismissible d-none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <i class="fa fa-check-circle" style='font-size:20px'></i> <span class='success-msg'></span>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                Student Name <span class="ast" style="color:red;"> * </span>
                                <br>
                                <input type="text" name="student_name" placeholder="Full Name" class="form-control Email_Input"  required>
                            </div>
                            <div class="col-md-6">
                                Father Name <span class="ast" style="color:red;"> * </span>
                                <br>
                                <input type="text" name="father" placeholder="Father Name" class="form-control Email_Input"  required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                Email Id
                                <br>
                                <input type="email" name="email" placeholder="Email Address" class="form-control Email_Input" placeholder="Enter your Email Id" >
                            </div>
                            <div class="col-md-6">
                                Phone/Mobile <span class="ast" style="color:red;"> * </span>
                                <br>
                                <input type="number" name="mobile" class="Email_Input form-control" id="mobile" placeholder="10 Digit phone number" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                States<span class="ast" style="color:red;"> * </span>
                                <br>
                                <select name="state" class="state form-control" >
                                  <option value="">Select State</option>
                                  <?php
                                    if(!empty($states))
                                    {
                                    foreach($states as $state)
                                    {
                                  ?>
                                    <option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
                                  <?php
                                    }
                                    }
                                  ?>
                                </select>
                                <input type="hidden" class="state_name" name="state_name" />
                            </div>
                            <div class="col-md-6">
                                City <span class="ast" style="color:red;"> * </span>
                                <br>
                                <select name="city" class="city form-control" >
                                  <option value="">Select City</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                Select Course <span class="ast" style="color:red;"> * </span>
                                <br>
                                <select name="course" class="courses form-control" required>
                                  <option value="">Select Course Interested</option>
                                  <?php
                                    foreach($courses as $course)
                                    {
                                  ?>
                                    <option value="<?php echo $course->course_id; ?>"><?php echo $course->course_name; ?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                                <input type="hidden" class="course_name" name="course_name" />
                            </div>
                            <div class="col-md-6">
                                Select Class <span class="ast" style="color:red;"> * </span>
                                <br>
                                <select name="stream" class="streams form-control" required>
                                  <option value="">Select Class</option>
                                  
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <input type="checkbox" name="agree" class="" required>&nbsp
                                <span>I authorize <b><?=$institute[0]->institute_name; ?></b> to contact me with updates and notifications via voice call, e-mail, sms and whatsapp. This will override the registry on DND/NDNC. *                                </span>
                            </div>
                        </div>

                        <input type="hidden" name="institute_id" class="institute_id" value="<?php echo $institute[0]->institute_id; ?>" />
                        <input type="hidden" name="institute_email" value="<?php echo $institute[0]->institute_email; ?>" />
                        <input type="hidden" name="institute_mobile" value="<?php echo $institute[0]->institute_mobile; ?>" />
                        <input type="hidden" name="institute_name" value="<?php echo $institute[0]->institute_name; ?>" />
                        <input type="hidden" name="payment_link" value="<?php echo $institute[0]->payment_api_key; ?>" />
                        <input type="hidden" name="institute_website" class="institute_website" value="<?php echo $institute[0]->institute_website; ?>" />
                        <input type="hidden" name="institute_address" value="<?php echo $institute[0]->institute_address; ?>" />
                        <input type="hidden" name="state" value="<?php echo $institute[0]->state; ?>" />
                        <input type="hidden" name="institute_logo" value="<?php echo $institute[0]->institute_logo; ?>" />
                        <input type="hidden" name="subdomain" value="<?php echo $institute[0]->subdomain; ?>" />
                        <center>
                            <input type="submit" value="Submit Now" class="login">
                            <i class="fa fa-spinner fa-spin d-none" style="font-size:24px"></i>
                            <br>
                            <!-- <a id="forgot_Password"><h3 class="forgot" >Forgot Password?</h3></a> -->
                        </center>
                    </form>

                    <!-- <div class="brand-info">
                       
                       <p>Privacy Policy | Terms of Use</p>
                       <div class="social-icons">
                           <a href="#"><i class="fa fa-linkedin"></i></a>
                           <a href="#"><i class="fa fa-twitter"></i></a>
                           <a href="#"><i class="fa fa-facebook"></i></a>
                           <a href="#"><i class="fa fa-youtube"></i></a>
                           <a href="#"><i class="fa fa-instagram"></i></a>
                       </div>
                       <p>© ZEQOON TECHNOLOGY PRIVATE LIMITED.</p>
                    </div> -->
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>

 <script>
  //student signup / student online enquiry 
      $("#studentSignup").submit(function(e){
        e.preventDefault();
        var data   = $(this).serialize();
        var action = $(this).attr('action');
        var method = $(this).attr('method');
        
        $.ajax({
         type: method,
         url:action,
         data: data,
         beforeSend: function(){
          $(".enq-btn").html('Please Wait...');
          $(".enq-btn").attr('disabled');
          $(".fa-spin").removeClass('d-none');
        },
         success: function(data){
          $(".enq-btn").html('Enquire Now');
          $(".enq-btn").removeAttr('disabled');
          $(".fa-spin").addClass('d-none');
          $("#studentSignup")[0].reset();
          var data = JSON.parse(data);
          var status = data.status;

          if(status == 'valid-error')
          {
            $(".alert-danger").removeClass('d-none');
            $(".alert-danger .fa-times-circle").addClass('d-none');
            $(".enq-con").css('height','auto');
            $(".alert-danger").append(data.message);
            $(".alert-danger .close").on("click",function(){
                $(".enq-con").css('height','100vh');
            });
          }

          if(status == true)
          {
            var website = $(".institute_website").val();
            $(".alert-success").removeClass('d-none');
            $(".success-msg").html(data.message);
            setTimeout(function(){
                window.location = website;
            },3000);
          } else if(status == false){
            $(".alert-danger").removeClass('d-none');
            $(".error-msg").html(data.errormessage);
            setTimeout(function(){
                $(".alert-danger").addClass('d-none');
            },4000);
          }    
          // if(res != "")
          // {
          //   alert("We have received your query. We will contact you shortly.Thank you.");
          //   window.location = res;
          // }
         }
       });
      });

   </script>

<script>
     $(".courses").on('change',function(){
      var course_id = $(this).val();
      var course_name = $(".courses option:selected").html();
      $(".course_name").val(course_name);
      var institute_id = $(".institute_id").val();
      $(".streams").html("");
      if(course_id != "")
      {
        $.ajax({
          type : 'POST',
          url : '<?=base_url(); ?>institute/getStreamsByCourse',
          data : {
            course_id : course_id,
            institute_id : institute_id
          },
          success : function(res){
            $(".streams").html(res);
          }
        });
      }
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
            if(status == 'valid-error')
            {
                $(".alert-danger").removeClass('d-none');
                $(".alert-danger .fa-times-circle").addClass('d-none');
                $(".alert-danger").append(data.message);
            }
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

<script>
    $(".state").on('change',function(){
        var state_id = $(this).val();
        var state_name = $( ".state option:selected" ).text();
        $(".state_name").val(state_name);
        $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/cityByState',
            data : {
                state_id : state_id,
            },
            success : function(res){
                $(".city").html(res);
            }
        });
    });
</script>

<script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    $(document).on('keydown',function(evtobj) { 
        if (evtobj.ctrlKey && evtobj.shiftKey && evtobj.keyCode == 73)
        {
            return false;
        }

        if (evtobj.ctrlKey && evtobj.keyCode == 85)
        {
            return false;
        }     
        
    });
</script>
        
</body>
</html>