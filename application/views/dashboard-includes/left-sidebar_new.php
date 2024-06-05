<?php
    $session = $this->session->userdata($data);
?>
<script type="text/javascript">
    uri_Segment = '<?php echo $this->uri->segment(1); ?>';
    var staff_session = "<?php $staff=$this->session->userdata($data); if($staff['is_staff_in'] == true){echo "staff";} ?>";
</script>
<style>
    .msg-circle{
        width:20px;
        height:20px;
        border-radius:50%;
        background:blue;
        color:white;
        text-align:center;
        font-size:10px;
    }
</style>
<div id="main" class="layout-row flex">
    <!-- ############ LAYOUT START-->
    <!-- ############ Aside START-->
    <div id="aside" class="page-sidenav no-shrink  nav-expand  animate fadeInLeft fade folded" aria-hidden="true">
        <div class="sidenav h-100 modal-dialog bg-white box-shadow">
            <!-- sidenav top -->
            <!-- Flex nav content -->
            <div class="flex scrollable hover">
                <div class="nav-border b-primary" data-nav="">
                    <?php
                    if($session['is_institute_in'] == true)
                    {
                        $institute_id = $_SESSION['institute_id'];
                        $menus = $this->db->query("SELECT * FROM menus WHERE institute_id = '".$institute_id."' ")->row();
                    ?>
                    <ul class="nav bg" id="accordion">
                        <li class="nav-header hidden-folded">
                            <span class="_fwg500_ _fs12_">Welcome</span>
                        </li>
                        <li class="<?php if($menus->dashboard != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url('institute/dashboard'); ?>" class="i-con-h-a _cmmnsdHvr_ lftBar dashboardActive">
                                <span class="nav-icon">
                                    <i class="i-con i-con-home _fntwss_ _greyClr_ _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Dashboard</span>
                            </a>
                        </li>
                        <li class="<?php if($menus->inbox != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url('institute/inbox'); ?>" class="i-con-h-a _cmmnsdHvr_ lftBar dashboardActive">
                                <span class="nav-icon">
                                    <i class="i-con i-con-mail _fntwss_ _greyClr_ _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_ d-flex">Inbox
                        
                                </span>
                            </a>
                        </li>
                        <li class="<?php if($menus->search != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url('institute/search'); ?>" class="i-con-h-a _cmmnsdHvr_ lftBar dashboardActive">
                                <span class="nav-icon">
                                    <i class="i-con i-con-search _fntwss_ _greyClr_ _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Search</span>
                            </a>
                        </li>
                        <li class="<?php if($menu == 'leads'){echo 'active';} ?> ">
                            <a href="<?php echo base_url('institute/leads_page'); ?>" class="i-con-h-a _cmmnsdHvr_ lftBar dashboardActive">
                                <span class="nav-icon">
                                    <i class="fa fa-check-square-o _fntwss_ _greyClr_ _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Online Leads</span>
                            </a>
                        </li>
                        <li class="<?php if($menus->students != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url(); ?>institute/student" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                                <span class="nav-icon">
                                    <i class="i-con i-con-users _fntwss_ _greyClr_ _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Students</span>
                            </a>
                        </li>
                        <li class="questionTour" class="<?php if($menus->admission != 'on'){echo 'd-none';} ?>">
                            <a class="collapsed card-link i-con-h-a _cmmnsdHvr_ lftBar" data-toggle="collapse" href="#questions">
                                <span class="nav-icon">
                                    <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Admission</span>
                                <!-- <span class="nav-caret"></span> -->
                            </a>
                            <ul id="questions" class="collapse" data-parent="#questions" style="margin-left: 19px;">
                                <li>
                                    <a href="<?php echo base_url('institute/enquiry'); ?>" class="i-con-h-a _cmmnsdHvr_ enquiryActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Enquiry</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo base_url(); ?>institute/courses" class="i-con-h-a _cmmnsdHvr_ cursesActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Courses</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('institute/online_enquiries'); ?>" class="i-con-h-a _cmmnsdHvr_ OadmActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Online Admission</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="<?php if($menus->associates != 'on'){echo 'd-none';} ?>">
                            <a href="agent" class="i-con-h-a _cmmnsdHvr_ lftBar  agentActive" data-toggle="collapse" data-target="#agent">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-layer _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_ ">Associates</span>
                                <span class="nav-badge">
                                    <!-- <b class="badge badge-sm badge-pill bg-danger">12</b> -->
                                </span>
                            </a>
                            <ul id="agent" class="collapse" style="margin-left: 19px;">
                                <li>
                                    <a href="<?php echo base_url('institute/agent'); ?>" class="i-con-h-a _cmmnsdHvr_ agentActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Associates</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>institute/subagent" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Sub Associates</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('institute/payments/2'); ?>" class="i-con-h-a _cmmnsdHvr_ paymentsActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Payments</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php if($menus->assos_req != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url(); ?>institute/agent_requests" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Associate Requests</span>
                            </a>
                        </li>
                        <li class="<?php if($menus->institutes != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url(); ?>institute/our_institutes" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <i class="fa fa-university _fntwss_ _blckClr_ nwFntSt _sdf_"></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Our Institutions</span>
                            </a>
                        </li>
                        <li class="<?php if($menus->fee_mgmt != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url(); ?>institute/fee_management" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <!-- <i class="i-con i-con-circle _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="fa fa-inr _fntwss_ _blckClr_ nwFntSt _sdf_"></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Fee Management</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="<?php echo base_url(); ?>institute/banner" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <i class="fa fa-image _fntwss_ _blckClr_ nwFntSt _sdf_"></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Banner Management</span>
                            </a>
                        </li> -->
                        <li class="<?php if($menus->vendor != 'on'){echo 'd-none';} ?>">
                            <a href="javascript:void(0);" class="i-con-h-a _cmmnsdHvr_ lftBar _cmmnsdHvr_ cropActive" data-toggle="collapse" data-target="#Vendor">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <!-- <i class="i-con i-con-table"><i></i></i> -->
                                    <i class="i-con i-con-grid _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Vendor Management</span>
                            </a>
                            <ul id="Vendor" class="collapse" style="margin-left: 19px;">
                                <li>
                                    <a href="<?php echo base_url('vendor'); ?>" class="i-con-h-a _cmmnsdHvr_ vendorActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Add Vendor</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("payments/1"); ?>" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Add Payment</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Print Voucher</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php if($menus->stream != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url(); ?>institute/stream" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-circle _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Stream/Trade</span>
                            </a>
                        </li>
                        <li style="display: none;">
                            <a href="cheque" class="i-con-h-a _cmmnsdHvr_ chequeActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-page _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Print Cheque</span>
                            </a>
                        </li>
                        <li class="<?php if($menus->staff != 'on'){echo 'd-none';} ?>">
                            <a href="javascript:void(0);" class="i-con-h-a _cmmnsdHvr_ discountActive" data-toggle="collapse" data-target="#Staff">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-page _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Staff & Faculties</span>
                            </a>
                            <ul id="Staff" class="collapse" style="margin-left: 19px;">
                                <li>
                                    <a href="<?php echo base_url('institute/staff'); ?>" class="i-con-h-a _cmmnsdHvr_ salesReportActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Add Staff</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('institute/payments/3'); ?>" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Payments</span>
                                    </a>
                                </li>
                                <!-- <li>
                          <a href="javascript:void(0);" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                            <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Voucher</span>
                          </a>
                        </li> -->
                            </ul>
                        </li>
                        <li class="<?php if($menus->reports != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url(); ?>institute/reports" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <!-- <i class="i-con i-con-circle _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="fa fa-file _fntwss_  nwFntSt _sdf_"></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Reports</span>
                            </a>
                        </li>
                        <li class="<?php if($menus->sms != 'on'){echo 'd-none';} ?>">
                            <a href="<?php echo base_url();?>institute/send_sms" class="i-con-h-a _cmmnsdHvr_ smsActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-table _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Send SMS / Send Email</span>
                            </a>
                        </li>

                        <!-- <li>
                            <a href="<?php echo base_url('institute/sendMail'); ?>" class="i-con-h-a _cmmnsdHvr_ mailActive">
                                <span class="nav-icon">
                                    <i class="i-con i-con-mail _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Send Email</span>
                            </a>
                        </li> -->
                        <!--  -->
                        <li class="<?php if($menus->social_media != 'on'){echo 'd-none';} ?>">
                            <a href="social" class="i-con-h-a _cmmnsdHvr_ lftBar  socialActive" data-toggle="collapse" data-target="#social">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-layer _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_ ">Social Media</span>
                                <span class="nav-badge">
                                    <!-- <b class="badge badge-sm badge-pill bg-danger">12</b> -->
                                </span>
                            </a>
                            <ul id="social" class="collapse" style="margin-left: 19px;">
                                <li>
                                    <a href="<?php echo $_SESSION['my_ivr_link']; ?>" class="i-con-h-a _cmmnsdHvr_ IVRActive" target="_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My IVR</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION['facebook_link']; ?>" class="i-con-h-a _cmmnsdHvr_ fbActive" target = "_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION['google_business_link']; ?>" class="i-con-h-a _cmmnsdHvr_ googleActive" target = "_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My Google Business</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION['twitter_link']; ?>" class="i-con-h-a _cmmnsdHvr_" target = "_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My Twitter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION['instagram_link']; ?>" class="i-con-h-a _cmmnsdHvr_" target = "_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My Instagram</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <?php
                    }
                    ?>

                    <?php
                    if($session['is_staff_in'] == true)
                    {
                    ?>
                    <ul class="nav bg" id="accordion">
                        <li class="nav-header hidden-folded">
                            <span class="_fwg500_ _fs12_">Welcome</span>
                        </li>
                        <!-- <li>
                            <a href="<?php echo base_url('institute/dashboard'); ?>" class="i-con-h-a _cmmnsdHvr_ lftBar dashboardActive">
                                <span class="nav-icon">
                                    <i class="i-con i-con-home _fntwss_ _greyClr_ _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Dashboard</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="<?php echo base_url('institute/search'); ?>" class="i-con-h-a _cmmnsdHvr_ lftBar dashboardActive">
                                <span class="nav-icon">
                                    <i class="i-con i-con-search _fntwss_ _greyClr_ _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Search</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('institute/announcement'); ?>" class="i-con-h-a _cmmnsdHvr_ lftBar dashboardActive">
                                <span class="nav-icon">
                                    <i class="i-con i-con-search _fntwss_ _greyClr_ _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Notices</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('institute/leads_page'); ?>" class="i-con-h-a _cmmnsdHvr_ lftBar dashboardActive">
                                <span class="nav-icon">
                                    <i class="fa fa-check-square-o _fntwss_ _greyClr_ _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Online Leads</span>
                            </a>
                        </li>
                        <li class="questionTour">
                            <a class="collapsed card-link i-con-h-a _cmmnsdHvr_ lftBar" data-toggle="collapse" href="#questions">
                                <span class="nav-icon">
                                    <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Admission</span>
                                <!-- <span class="nav-caret"></span> -->
                            </a>
                            <ul id="questions" class="collapse" data-parent="#questions" style="margin-left: 19px;">
                                <li>
                                    <a href="<?php echo base_url('institute/enquiry'); ?>" class="i-con-h-a _cmmnsdHvr_ enquiryActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Enquiry</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>institute/student" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Students</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>institute/courses" class="i-con-h-a _cmmnsdHvr_ cursesActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Courses</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('institute/online_enquiries'); ?>" class="i-con-h-a _cmmnsdHvr_ OadmActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Online Admission</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="agent" class="i-con-h-a _cmmnsdHvr_ lftBar  agentActive" data-toggle="collapse" data-target="#agent">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-layer _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_ ">Associates</span>
                                <span class="nav-badge">
                                    <!-- <b class="badge badge-sm badge-pill bg-danger">12</b> -->
                                </span>
                            </a>
                            <ul id="agent" class="collapse" style="margin-left: 19px;">
                                <li>
                                    <a href="<?php echo base_url('institute/agent'); ?>" class="i-con-h-a _cmmnsdHvr_ agentActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Associates</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>institute/subagent" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Sub Associates</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('institute/payments/2'); ?>" class="i-con-h-a _cmmnsdHvr_ paymentsActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Payments</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>institute/our_institutes" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <i class="fa fa-university _fntwss_ _blckClr_ nwFntSt _sdf_"></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Our Institutions</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>institute/fee_management" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <!-- <i class="i-con i-con-circle _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="fa fa-inr _fntwss_ _blckClr_ nwFntSt _sdf_"></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Fee Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="i-con-h-a _cmmnsdHvr_ lftBar _cmmnsdHvr_ cropActive" data-toggle="collapse" data-target="#Vendor">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <!-- <i class="i-con i-con-table"><i></i></i> -->
                                    <i class="i-con i-con-grid _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Vendor Management</span>
                            </a>
                            <ul id="Vendor" class="collapse" style="margin-left: 19px;">
                                <li>
                                    <a href="<?php echo base_url('vendor'); ?>" class="i-con-h-a _cmmnsdHvr_ vendorActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Add Vendor</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("payments/1"); ?>" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Add Payment</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="i-con-h-a _cmmnsdHvr_ ordrCnfrmRprtActive">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Print Voucher</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>institute/stream" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-circle _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Stream/Trade</span>
                            </a>
                        </li>
                        <li style="display: none;">
                            <a href="cheque" class="i-con-h-a _cmmnsdHvr_ chequeActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-page _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Print Cheque</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo base_url(); ?>institute/reports" class="i-con-h-a _cmmnsdHvr_ varietiesActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <!-- <i class="i-con i-con-circle _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="fa fa-file _fntwss_  nwFntSt _sdf_"></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>institute/send_sms" class="i-con-h-a _cmmnsdHvr_ smsActive">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-table _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">Send SMS / Send Email</span>
                            </a>
                        </li>
                        
                        <!--  -->
                        <li>
                            <a href="social" class="i-con-h-a _cmmnsdHvr_ lftBar  socialActive" data-toggle="collapse" data-target="#social">
                                <span class="nav-icon">
                                    <!-- <i class="i-con i-con-users _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i> -->
                                    <i class="i-con i-con-layer _fntwss_ _blckClr_ nwFntSt _sdf_"><i></i></i>
                                </span>
                                <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_ ">Social Media</span>
                                <span class="nav-badge">
                                    <!-- <b class="badge badge-sm badge-pill bg-danger">12</b> -->
                                </span>
                            </a>
                            <ul id="social" class="collapse" style="margin-left: 19px;">
                                <li>
                                    <a href="<?php echo $_SESSION['my_ivr_link']; ?>" class="i-con-h-a _cmmnsdHvr_ IVRActive" target="_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My IVR</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION['facebook_link']; ?>" class="i-con-h-a _cmmnsdHvr_ fbActive" target = "_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION['google_business_link']; ?>" class="i-con-h-a _cmmnsdHvr_ googleActive" target = "_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My Google Business</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION['twitter_link']; ?>" class="i-con-h-a _cmmnsdHvr_" target = "_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My Twitter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION['instagram_link']; ?>" class="i-con-h-a _cmmnsdHvr_" target = "_blank">
                                        <span class="nav-text _fntwss_ _blckClr_ nwFntSt _sdf_">My Instagram</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- sidenav bottom -->
            <div class="no-shrink ">
                <div class="text-sm p-3 b-t">
                    <div class="hidden-folded text-sm">
                        <div class="mt-1">
                            <a href="javascript:void(0);" class="text-muted">Version 1.0</a>
                        </div>
                        <!-- <div class="text-muted"><small class="text-muted">&copy; Copyright 2019, Marquis</small></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ############ Aside END-->