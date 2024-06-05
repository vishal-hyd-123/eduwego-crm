<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title><?php echo $site_title; ?></title>
      <meta name="description" content="Responsive, Bootstrap, BS4" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <!-- style -->
     
      <link rel="manifest" href="<?php echo base_url(); ?>assets/dashboard/favicon/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="assets/dashboard/favicon/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">
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

      <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

      <script src="<?php echo base_url(); ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
      

    <style>
      .error-message 
      {
        position: absolute;
        font-size: 12px;
        color: red;
        left: 15px;
      }

      .box-shadows
      {
       box-shadow: 0px 0px 11px rgba(0, 0, 0, 0.25);
      }

      .notice-con{
        position: relative;
      }

      .notice-number{
        min-width: 20px;
        padding: 2px;
        border: 1px solid #ccc;
        background-color: #8b152b;
        text-align: center;
        color: white;
        font-size: 12px;
        border-radius: 20px;
        position: absolute;
        top: -10px;
        left: 7px;
      }
.one_line{
            background-color: #17639D !important;
            width: 100% !important;
            height: 10px;
        }
    </style>
    <script type="text/javascript">
      var sendToAll = [];
    </script>
   </head>
  
   <body class="layout-column">
       <div class="one_line"></div>
    <header id="header" class="page-header bg-white box-shadows animate fadeInDown sticky" data-class="bg-white">
         <div class="navbar navbar-expand-lg">
            <!-- btn to toggle sidenav on small screen -->
            <a class="d-lg-none i-con-h-a px-1" data-toggle="modal" data-target="#aside">
            <i class="i-con i-con-menu text-muted"></i>
            </a>
            <!-- brand -->
            <a href="" class="navbar-brand">
                <?php 
                if($_SESSION['is_institute_in'])
                {
                    if($_SESSION['institute_logo'])
                    {
                    ?>
                      <img src="<?php echo base_url(); ?>uploads/<?=$_SESSION['institute_logo']; ?>">  
                    <?php
                    }
                }
                ?>

                <?php 
                if($_SESSION['is_student_in'])
                {
                    if($_SESSION['institute_logo'])
                    {
                    ?>
                      <img src="<?php echo base_url(); ?>uploads/<?=$_SESSION['institute_logo']; ?>">  
                    <?php
                    }
                }
                ?>

                <?php 
                if($_SESSION['is_super_in'])
                {
                ?>
                  <img src="<?php echo base_url(); ?>assets/dashboard/img/loginlogo.png">  
                <?php
                }
                ?>

                <?php 
                if($_SESSION['is_staff_in'])
                {
                    $institute_id = $_SESSION['institute_id'];
                    $inst_logo = $this->db->query("SELECT institute_logo FROM institute WHERE institute_id = '".$institute_id."' ")->row();
                    $institute_logo = $inst_logo->institute_logo;
                ?>
                  <img src="<?=base_url(); ?>uploads/<?=$institute_logo; ?>">  
                <?php
                }
                ?>
                
            </a>
            <a href="" class="navbar-brand">
                <?php 
                if(isset($_SESSION['agent_id']))
                {
                    $institute_id = $_SESSION['institute_id'];
                    $instLogo = $this->db->query("SELECT institute_logo FROM institute WHERE institute_id = '".$institute_id."' ")->row();
                    $institute_logo = $instLogo->institute_logo;
                ?>
                  <img src="<?php echo base_url(); ?>uploads/<?=$institute_logo; ?>">  
                <?php
                }
                ?>
            </a>
            <!-- / brand -->
           
            <ul class="nav navbar-menu order-1 order-lg-2">
                <li class="nav-item dropdown notice-con mr-3">
                    <a target="_blank" href="https://wa.aisensy.com/modXgI" class="btn" style="background:#16649E;color:white">Subscription Renewal</a>
                </li>
               <?php  
               if($this->session->userdata('is_institute_in'))
               {
                $institute_id = $_SESSION['institute_id'];
                $notices = $this->db->query("SELECT * FROM notifications WHERE institute_id = '".$institute_id."' AND status = '0' ")->result();
                $total_notice = count($notices);
               ?>
                <li class="nav-item dropdown notice-con mr-3">
                    <a href="<?=base_url(); ?>institute/notifications"> 
                     <img src="<?php echo base_url(); ?>assets/dashboard/img/bellicon.png">
                     <div class="notice-number"><?=$total_notice; ?></div>
                    </a>
                </li>
                <?php
                } 
                ?>

               <?php  
                   if($this->session->userdata('is_staff_in'))
                   {
                    $emp_id = $_SESSION['employee_id'];
                    $notices = $this->db->query("SELECT * FROM notifications WHERE staff_id = '".$emp_id."' AND status = '0' ")->result();
                   $total_notice = count($notices);
                   ?>
                    <li class="nav-item dropdown notice-con mr-3">
                        <a href="<?=base_url(); ?>institute/notifications"> 
                         <img src="<?php echo base_url(); ?>assets/dashboard/img/bellicon.png">
                         <div class="notice-number"><?=$total_notice; ?></div>
                        </a>
                    </li>
                    <?php
                    } 
                ?>

                <li class="nav-item dropdown">
                  <a href="javascript:void(0);" data-toggle="dropdown" class="nav-link customDropDown d-flex align-items-center py-0 px-lg-0 px-2 text-color" aria-expanded="false">
                  <span class=" mx-2 d-none l-h-1x d-lg-block text-right">
                  <small class="text-fade d-block mb-1 _welcomeMsg_ _fntwss_ _greyClr_" style="margin-bottom: 3px"><?php echo @$_SESSION['name'];?></small>             
                  </span>
                  <span class="avatar w-36">
                    <?php
                    if($_SESSION['is_institute_in'])
                    {
                      if (@$_SESSION['institute_logo'] != "" && @$_SESSION['institute_logo'] !=Null) {
    
                      ?>
                        <img src="<?php echo base_url().'/uploads/'.$_SESSION['institute_logo']; ?>" alt="avatar">
                     <?php
                      }
                    }else if($_SESSION['emp_photo']){
                      ?>
                        <img src="<?php echo base_url().'/uploads/'.$_SESSION['emp_photo']; ?>" alt="Employee Image">
                     <?php
                      }else{
                        ?>
                        <img src="<?php echo base_url(); ?>assets/dashboard/img/institutelogin.png" alt="avatar">
                        <?php
                      }
                     ?>
                  </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right w pt-0 mt-3 animate fadeIn _prfleDrp_ settings-menu">
                     <a class="dropdown-item _jsdw_ _fntwss_ _cmmnHvr_  _greyClr_" href="<?=base_url(); ?>institute/profile">
                     <span><i class="la la-user"></i> Profile</span>
                     </a>
                     <?php
                     if($this->session->userdata('is_institute_in') || $this->session->userdata('is_staff_in'))
                     {
                     ?>
                      <a class="dropdown-item _jsdw_ _fntwss_ _cmmnHvr_ _greyClr_" href="<?php echo base_url('institute/change_password'); ?>">
                        <span><i class="la la-lock"></i> Change Password</span>
                      </a>
                    <?php
                     }
                     ?>

                    <?php
                     if($this->session->userdata('is_student_in'))
                     {
                     ?>
                      <a class="dropdown-item _jsdw_ _fntwss_ _cmmnHvr_ _greyClr_" href="<?php echo base_url('student/change_password'); ?>">
                        <span><i class="la la-lock"></i> Change Password</span>
                      </a>
                    <?php
                     }
                     ?>

                     <?php
                     if($this->session->userdata('is_super_in') || $this->session->userdata('is_admin_in'))
                     {
                     ?>
                      <a class="dropdown-item _jsdw_ _fntwss_ _cmmnHvr_ _greyClr_" href="<?php echo base_url('admin/change_password'); ?>">
                        <span><i class="la la-lock"></i> Change Password</span>
                      </a>
                    <?php
                     }
                     ?>

                    <?php
                     if($this->session->userdata('is_agent_in'))
                     {
                     ?>
                      <a class="dropdown-item _jsdw_ _fntwss_ _cmmnHvr_ _greyClr_" href="<?php echo base_url('associate/change_password'); ?>">
                        <span><i class="la la-lock"></i> Change Password</span>
                      </a>
                    <?php
                     }
                     ?>

                      <a class="dropdown-item _jsdw_ _fntwss_ _cmmnHvr_ _greyClr_" id="signout" href="<?php echo base_url('institute/logout'); ?>" >
                     <span><i class="la la-sign-out"></i> Logout</span>
                     </a>
                  </div>
               </li>
               
            </ul>
         </div>
      </header>
      <div class="modal Modal_" id="logoutConfirmPopup">
        <div class="modal-dialog Modal-width_580">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-body">
                    <button type="button" class="close Popup_Delete_icn" data-dismiss="modal">
                      <a class="i-con-h-a"><i class="mr-2 i-con i-con-close"></i></a>
                    </button>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 popup_bg_color padding-16" id="">
                      <div id="">
                        <div class="row">
                            <div class="col-12 Botm_brdr">
                                <h3 id="h3_Delete" class="_fs16_">
                                 <a class="i-con-h-a _mhrnclr_">
                                    <i class="mr-2 i-con i-con-bell"><i></i></i>
                                 </a>Alert</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-t-20">
                                <span id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">Do you want to logout?</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">Stay</span>
                                <a style="color: #fff" href="<?php echo base_url('admin/logout'); ?>" class="btn btn-responsive YesDlt-btn">Logout</a>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
</body>
</html>