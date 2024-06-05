<?php
  $base_url = base_url();
  // $arr = explode('.',$url);
  // $http = $arr[0];
  // $http_arr = explode('//',$http);
  // $http = $http_arr[0];
  
  // $host = $arr[1];
  
  // $uri = $_SERVER['REQUEST_URI'];
  // $uri_arr = explode('/',$uri);
  // $website = $uri_arr[1];
  // $base_url = $http."//".$host."".$website."/";
  if(!empty($institute[0]->banner))
  {
       $bgurl = $base_url."uploads/".$institute[0]->banner;                               
  }else{
       $bgurl =  $base_url."assets/dashboard/img/loginbg.png";          
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Sign Up Form</title>
    <meta name="description" content="Responsive, Bootstrap, BS4" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- style -->
    <!-- build:css <?php //echo $base_url; ?>assets/dashboard/css/site.min.css -->
    
    <!-- <link rel="manifest" href="<?php echo $base_url; ?>assets/dashboard/favicon/manifest.json"> -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/dashboard/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/bower-components/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/dashboard/css/i-con.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/dashboard/css/theme.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/dashboard/css/style.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/dashboard/libs/line-awesome/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- vanilla notify -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/vanilla-notify/vanilla-notify.css" type="text/css" />
    <!-- endbuild -->
    <style> .error-message {font-size: 12px;color: red;float: left;} 
    body{
            padding-bottom: 0;
        }
    .bg_img 
    {
      background-image: url('<?php echo $bgurl; ?>');
      background-position: center;
      background-repeat: no-repeat;
      width: 100%;
      min-height: 107vh;
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
    .instLogo{
      width:80px;
      height:80px;
    }
    .contentDiv
    {
        position: absolute;
        top: 34%;
        left: 5%;
        right: 5%;
        /*text-align: center;*/
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 9;
    }
    #studentSignup input,select{
      width: 100%;
      height: 35px;
      margin-bottom:7px;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding-left: 5px;
    }
    .instNameDiv{
      text-align: left;
      padding-top: 30px;
      padding-left: 0;
    }
  @media only screen and (max-width: 768px){
  .mobile_view_img{
    display: none;
  }
  .instNameDiv{
    text-align: center;
  }
}
  </style>
  </head>
  
  <body>
    <section class="bg_img">
      <div class="container-fluid Login_container">
        <div class="topBottomMargin">
          
          <div id="LogIn-Inner" class="row justify-content-center">
            <div class="col-12 col-lg-6 mobile_view_img">
              <div class="loginimgDiv"style="position: relative;" > 
                <?php  
                  if(!empty($institute[0]->banner))
                  {
                    ?>
                    <!-- <img class="imgRad" src="<?php echo $base_url; ?>uploads/<?=$institute[0]->banner; ?>" style="width: 100%;"> -->

                    <?php                    
                  }else{
                    ?>
                    <img class="imgRad" src="<?php echo $base_url; ?>assets/dashboard/img/loginimg.png" style="width: 100%;">
                    <?php
                  }
                ?>
                
                
              </div>
              <div class="contentDiv" >
                <h5 class="text-white">Welcome to</h5>
                <h1 class="text-white">Eduwego+</h1>
                <h4 class="text-white">Paperless Admission Management System</h4>
              </div>
              <div class="overlayDiv">
                
              </div>
            </div>
            <div class="col-12 col-lg-6" style="">
              <div class="Login_Ryt" style="">

                <div class="alert alert-danger alert-dismissible d-none">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <i class="fa fa-times-circle" style='font-size:20px'></i> 
                  <span class='error-msg'></span>
                </div>

                <div class="alert alert-success alert-dismissible d-none">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <i class="fa fa-check-circle" style='font-size:20px'></i> <span class='success-msg'></span>
                </div>

                <form id="studentSignup" method="POST" action="<?php echo $base_url; ?>institute/studentSignup">
                  <input type="hidden" name="timezone" id="timeZone">
                    <div class="row inner-row-ryt-1 mb-3">
                        <div class="col-md-3">
                          <center><img class="instLogo" src="<?php echo $base_url."uploads/".$institute[0]->institute_logo; ?>"></center>
                        </div>
                        <div class="col-md-9 instNameDiv ">
                            <h4><?php echo $institute[0]->institute_name; ?></h4>
                            <!-- <div class="borderDiv"></div> -->
                        </div>                  
                    </div>
                    <hr />
                    <div class="row justify-content-center">
                      <!-- <center><h5>Enquiry Form</h5> -->
                      <div class="col-12 col-md-11 col-lg-10 text-center ">
                        <input type="text" name="student_name" placeholder="Student Name" class="" required="" />
                        <span class="text-danger"><?php echo form_error('student_name'); ?></span>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-11 col-lg-10 text-center ">
                        <input type="text" name="father" placeholder="Father Name" class="" required="">
                        <span class="text-danger"><?php echo form_error('father'); ?></span>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-11 col-lg-10 text-center ">
                        <input type="eamil" name="email" placeholder="Email Address" class="" required="">
                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-11 col-lg-10 text-center ">
                        <input type="number" name="mobile" placeholder="Phone / Mobile Number" class="" required="">
                        <span class="text-danger"><?php echo form_error('mobile'); ?></span>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-11 col-lg-10 text-center ">
                        <select name="course" class="courses" required>
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
                        <input type="hidden" name="course_name" class="course_name" value="" />
                        <span class="text-danger"><?php echo form_error('course'); ?></span>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-11 col-lg-10 text-center ">
                        <select name="stream" class="streams" required>
                          <option value="">Select Stream</option>
                          
                        </select>
                        <span class="text-danger"><?php echo form_error('stream'); ?></span>
                      </div>
                    </div>
                    <div class="row justify-content-center">
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
                      <div class="col-12 col-md-11 col-lg-10"style="padding-top: 20px">

                       <button type="submit" class="loginbtn enq-btn">Enquire Now</button><i class="fa fa-spinner fa-spin d-none text-success" style="font-size:27px"></i>

                      </div>
                    
                    </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="sdssdf">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <p class="copyright_Text">© <?php echo date("Y"); ?> ZEQOON TECHNOLOGY PRIVATE LIMITED.</p>
          </div>
          
        </div>
      </div> -->
    </section>
    
<script src="<?php echo $base_url; ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo $base_url; ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo $base_url; ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ajax page -->
<script type="text/javascript">
  // uri_Segment = '<?php //echo $this->uri->segment(1); ?>';
</script>
<script src="<?php echo $base_url; ?>assets/dashboard/libs/pace-progress/pace.min.js"></script>
<!-- lazyload plugin -->
<script src="<?php echo $base_url; ?>assets/dashboard/js/lazyload.config.js"></script>
<script src="<?php echo $base_url; ?>assets/dashboard/js/lazyload.js"></script>
<script src="<?php echo $base_url; ?>assets/dashboard/js/plugin.js"></script>
<script type="text/javascript">window.base_url="<?php echo $base_url; ?>"</script>
<!-- theme -->
<script type="text/javascript" src="<?php echo $base_url; ?>assets/bower-components/DataTables/DataTables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>assets/dashboard/js/theme.js"></script>
<!-- vanilla notify -->
<script src="<?php echo $base_url; ?>assets/vanilla-notify/vanilla-notify.js"></script>
<!-- User Signup Functions -->
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
 </body>
</html>

    