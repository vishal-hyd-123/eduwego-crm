<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?php echo $site_title; ?></title>
    <meta name="description" content="Responsive, Bootstrap, BS4" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- style -->
    <!-- build:css <?php //echo base_url(); ?>assets/dashboard/css/site.min.css -->
    
    <link rel="manifest" href="<?php echo base_url(); ?>assets/dashboard/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/dashboard/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower-components/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/i-con.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/theme.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/style.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/libs/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- vanilla notify -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vanilla-notify/vanilla-notify.css" type="text/css" />
    <!-- endbuild -->
    <style> .error-message {font-size: 12px;color: red;float: left;} 
    body{
            padding-bottom: 0;
        }
    .bg_img 
    {
      background-image: url('<?php echo base_url(); ?>assets/dashboard/img/loginbg.png');
      background-position: center;
    background-repeat: no-repeat;
    width: 100%;
    min-height: 100vh;
    background-size: cover;
    background-attachment: fixed;
    overflow-x: hidden;
    }
    .borderDiv
    {
      border: 1px solid #0000004f;
      margin: 25px 0px;
    }
    .textbrwn
    {
     
      color:  #8A162B;
    }
    .loginbtn
    {
      float: right;
      background: #8A162B;
      color: white;
      padding: 8px 40px 8px 38px;
      border-radius: 7px;
      cursor: pointer;
    }

    .contentDiv
    {
         position: absolute;
        top: 34%;
        text-align: center;
        left: 13%;
        z-index: 9;
    }
@media only screen and (max-width: 768px){
  .mobile_view_img{
    display: none;
  }
}
  </style>
  </head>
  
  <body>
    sdfdgdfgdfhfg
    <section class="bg_img">
      <div class="container-fluid Login_container">
        <div class="topBottomMargin">
          <!-- <div class="text-center" style="padding-top: 50px">
          </div> -->
          <div id="LogIn-Inner" class="row justify-content-center">
            <div class="col-12 col-lg-6 mobile_view_img">
              <div class="loginimgDiv"style="position: relative;" > 
                <img class="imgRad" src="<?php echo base_url(); ?>assets/dashboard/img/loginimg.png" style="width: 100%;">
              </div>
              <div class="contentDiv" >
                <h5 class="text-white">Welcome to</h5>
                <h1 class="text-white">Eduwego+</h1>
                <h4 class="text-white">Paperless Admission Management System</h4>
              </div>
              <div class="overlayDiv">
                
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="Login_Ryt">
                <form id="staffLogin">
                    <div class="row inner-row-ryt-1">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center Login_Ryt_text _mobileFra">
                           <img class="nextynFavLogo" src="<?php echo base_url(); ?>assets/dashboard/img/loginlogo.png">
                            <div class="borderDiv"></div>
                            <h1 class="pt-10" style="font-size: 28px; font-weight: 600">Welcome Back!</h1>
                            <h4>SignIn to <span class="textbrwn">EduweGo+</span></h4>
                        </div>                  
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-11 col-lg-10 text-center Login_Email">
                        <input type="number" name="mobile" placeholder="10 digit mibile number" class="Email_Input" required="">
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-11 col-lg-10 text-center Login_Pass">
                        <input type="password" name="password" placeholder="Password" class="Email_Input" required="">
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-11 col-lg-10"style="padding-top: 20px">
                        <label class="form-check-label" style="margin-left: 21px;">

                       <input class="form-check-input" type="checkbox" name="remember">Remember me
                      </label>
                      <span class="loadingMyprofile" style="top: 27px; right: -4%"><img src="assets/dashboard/img/loading7.gif"></span>
                       <button type="submit" class="loginbtn">Login</button>
                      
                      </div>
                      <a class="mt15 _greyClr_ _fwg500_ _fs16_" href="javascript:void(0);" id="forgot_Password">Forgot Password?</a>
                    </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="sdssdf">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <p class="copyright_Text">© <?php echo date("Y"); ?> ZEQOON TECHNOLOGY PRIVATE LIMITED.</p>
          </div>
          
        </div>
      </div>
    </section>
    <!-- <!======================
          Forget Password Popup
               ===================--> 
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
                    <form id="resetPassword" method="post" action="staff/staff_forgot_password">
                      <div class="row justify-content-center">
                        <div class="col-12 col-md-11 col-lg-10 text-center Login_Email">
                          <input type="email" name="email" placeholder="Registered Email Address" class="Email_Input" required="">
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-6" style="margin-top: 30px">
                          <span class="loadingMyprofile" style="top: 7px; right: -9%"><img src="assets/dashboard/img/loading7.gif"></span><input type="submit" value="SUBMIT" class="Login_btn_Input">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
     </div>
    <!-- <!======================
            Forget Password Popup End
              ======================> -->


   
<script src="<?php echo base_url(); ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ajax page -->
<script type="text/javascript">
  // uri_Segment = '<?php //echo $this->uri->segment(1); ?>';
</script>
<script src="<?php echo base_url(); ?>assets/dashboard/libs/pace-progress/pace.min.js"></script>
<!-- lazyload plugin -->
<script src="<?php echo base_url(); ?>assets/dashboard/js/lazyload.config.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/lazyload.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/plugin.js"></script>
<script type="text/javascript">window.base_url="<?php echo base_url(); ?>"</script>
<!-- theme -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower-components/DataTables/DataTables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/js/theme.js"></script>
<!-- vanilla notify -->
<script src="<?php echo base_url(); ?>assets/vanilla-notify/vanilla-notify.js"></script>
<!-- User Signup Functions -->
 <script>
      $('#staffLogin').submit(function(event){
       event.preventDefault();
       $.ajax({
         type: "POST",
         url: window.base_url+"institute/staffLogin",
         data: $(this).serialize(),
         beforeSend: function(){
          $('.loadingMyprofile').show();
          $(':submit').attr('disabled','disabled');
         },
         success: function(data){
          $('.loadingImage').hide();
          $(':submit').removeAttr('disabled');
             var data = JSON.parse(data);
              console.log(data);
              if(data.status == false){
                  $( ".error-message" ).remove();
                  if(data.errormessage){
                    vNotify.error({text:data.errormessage, title:'Error!'});
                  }
                   data1   = JSON.parse(data.message);
                  $('form :input').each(function(){                          
                    var elementName = $(this).attr('name');        
                    var message = data1[elementName];
                    if(message){
                      var element = $('<span>' + message + '</span>')
                                    .attr({
                                        'class' : 'error-message'
                                    });
                      $(this).after(element);
                      $(element).fadeIn();
                    }
                  }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                   setTimeout(function(){
                      window.location.href = '<?php echo base_url(); ?>Staff/search';
                   }, 1000); 
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }
       });
     });


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
          $('.loadingMyprofile').show();
          $(':submit').attr('disabled','disabled');
         },
         success: function(data){
          $('.loadingMyprofile').hide();
          // $(':submit').removeAttr('disabled');
             var data = JSON.parse(data);
              if(data.status == false){
                alert(data.message);
              }
              if(data.status == true){
                  alert(data.message);
              }
              if(data.notfound == true){
                  alert(data.errormessage);
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }
       });
     });


    $(document).on('click', '#forgot_Password', function(){
      $('#ForgetPassword').modal('show');
    })

    var getHeight = $('.Login_Ryt').innerHeight()
    $('.imgRad').css('height', getHeight+'px');
   </script>
</body>
</html>

    