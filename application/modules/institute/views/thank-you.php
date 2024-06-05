<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Thank You</title>
      <meta name="description" content="Responsive, Bootstrap, BS4" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <!-- style -->
     
      <link rel="manifest" href="<?php echo base_url(); ?>assets/dashboard/favicon/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="assets/dashboard/favicon/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">

      <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet"> -->


      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/i-con.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/theme.css" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower-components/DataTables/DataTables/css/dataTables.bootstrap4.min.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower-components/datepicker/dist/datepicker.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/style.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/util.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/expert.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower-components/jquery-nice-select/css/nice-select.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dashboard/libs/line-awesome/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vanilla-notify/vanilla-notify.css" type="text/css" />
     
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


      <style>.error-message {position: absolute;font-size: 12px;color: red;left: 15px;}
      .box-shadows
      {
       box-shadow: 0px 0px 11px rgba(0, 0, 0, 0.25);
      }
    </style>
    <script type="text/javascript">
      var sendToAll = [];
    </script>
   </head>
   <body>
     <div class="thankYou">
       <div class="row justify-content-center">
         <div class="col-11 col-md-5">
           <div class="_bwsdw_">
             <h2>Thanks for filling out our form!</h2>
             <p>Please goto Online Payment Page and Pay Rs <?=$admission_fee; ?>/- to confirm your admission. In the meantime, you can print this form by clicking on below button.</p>
             <a href="<?php echo $payment_link; ?>" class="btn _fs14_ bg-primary i-con-h-a edit-bttn" target="_blank" style="color: #fff">Pay Now</a>
             <a href="<?php echo base_url().'institute/print_app_form/'.base64_encode($institute_id).'/'.base64_encode($last_id) ?>" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn" target="_blank" style="color: #fff">Print Form</a>
           </div>
         </div>
       </div>
     </div>
     <script src="<?php echo base_url(); ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script> 
  <script src="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower-components/datepicker/dist/datepicker.min.js"></script>
 
  <script type="text/javascript">
     window.base_url = '<?php echo base_url(); ?>';
  </script> 
  <!-- Bootstrap -->
  <script src="<?php echo base_url(); ?>assets/dashboard/libs/datatables/media/js/jquery.dataTables.min.js"></script>
  
  <script src="<?php echo base_url(); ?>assets/dashboard/libs/pace-progress/pace.min.js"></script>
  <!-- <script src="<?php //echo base_url(); ?>assets/dashboard/libs/pjax/pjax.js"></script> -->
  <!-- <script src="<?php //echo base_url(); ?>assets/dashboard/js/ajax.js"></script> -->
  <!-- lazyload plugin -->
  <script src="<?php echo base_url(); ?>assets/dashboard/js/lazyload.config.js"></script>
  <script type="text/javascript">
  </script>
  <script src="<?php echo base_url(); ?>assets/dashboard/js/lazyload.js"></script>
  <script src="<?php echo base_url(); ?>assets/dashboard/js/plugin.js"></script>
  <!-- theme -->
  <script src="<?php echo base_url(); ?>assets/dashboard/js/theme.js"></script>
  <!-- endbuild -->
  <script src="<?php echo base_url(); ?>assets/vanilla-notify/vanilla-notify.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/main.js"></script>
  
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

  <!-- datatable cdn link -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  -->
 <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.7/highcharts.js"></script>
 -->



  <script type="text/javascript">
    // if (uri_Segment == 'dashboard') {
    //   my_Calendar();

  </script>
   </body>
   </html>