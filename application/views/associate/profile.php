
<style type="text/css">
    /*.studentActive, .studentActive:hover{
    background: rgba(91, 193, 70, 0.1);
    border-color: #5BC146;
    color: #8A162B;
  }*/
    .studentActive ._sdf_ {
        color: #8A0A28 !important;
    }

    .imgcontent {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 180px;
    }
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent{
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

.details_table tr td{
   font-size:17px;
   padding:7px;
}
.contact_table tr td{
   font-size:17px;
   font-weight:bold;
   padding:7px;
}
.fee-box{
    border:1px solid #ccc;
}
.fee-box th,td{
    padding:7px;
    
}
.title-header{
  background:#8E294F;
  height:70px;
  padding:20px;

}
.front_side_con,.back_side_con{
    width: 80%;
    height:200px;
    border: 1px solid #ccc;
}


</style>

<div id="content" class="flex ">
    <div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-user"></i> PROFILE</h3>
        </span>
      </div>
    </div>

    <div class="page-container" id="page-container">

        <div class="padding">

            <div class="row profile-box shadow-lg" style="padding:20px;background:white">

                <div class="col-md-3">
                    <div class="profile_img_box">
                        <div style="width: 100%; height: auto;">
                            <div class="imgcontent" style="width: 180px;height: auto; text-align: center;">
                              <?php
                                if(isset($profile[0]->agent_photo))
                                {
                              ?>
                                <img class="blah" id="blah" src="<?php echo base_url();?>uploads/<?php echo $profile[0]->agent_photo; ?>" style="width: 100%;">
                              <?php
                                }
                                else{
                                  ?>
                                    <img class="blah" id="blah" src="<?php echo base_url(); ?>assets/dashboard/img/person2.jpg" style="width: 100%;">
                                  <?php
                                }
                              ?>
                                
                            </div>

                            <input type="file" name="image" accept="Images/*" id="expertProfile" hidden="">
                        </div>
                    </div>
                    <center>
                        <h4 class="text-capitalize my-3">
                            <?php
                                echo $profile[0]->agent_name;
                            ?>
                        </h4>
                    </center>
                    <div style="width:70%;margin-left:15%;margin-right:15%">
                        
                        <p>
                            <?php
                                echo "<i class='fa fa-phone'></i> ".$profile[0]->agent_mobile;
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-9">
                <center><h4><u>Profile Details</u></h4></center>
                 <table class="details_table w-100">
                   <tr>
                     <td>Name : </td>
                     <td class="text-capitalize"><?php echo $profile[0]->agent_name; ?></td>
                   </tr>
                   <tr>
                     <td>Address : </td>
                     <td class="text-capitalize"><?php echo $profile[0]->agent_address; ?></td>
                   </tr>
                   <tr>
                     <td>Total Students : </td>
                     <td><?php echo $no_of_students; ?></td>
                   </tr>
                   <tr>
                     <td>Total Sub Associates : </td>
                     <td><?php echo $sub_associates; ?></td>
                   </tr>
                   
                 </table>
                 <hr />

                 <center><h4><u>Course wise Students</u></h4></center>
                 <table id="course_wise_students" class="table-bordered w-100">
                  <tr>
                    <th>Sl.</th>
                    <th>Course Name</th>
                    <th>No. of Students</th>
                  </tr>
                   <?php
                    echo $course_wise_students;
                   ?>
                 </table>

                 <div class="kyc_image_box my-4">
                    <center><h4><u>KYC DETAILS</u></h4></center>
                     <div class="row">
                         <div class="col-md-6 mb-3" style="">
                            <center>
                             <div class="front_side_con">
                                <?php
                                if($profile[0]->id_front != "")
                                {
                                ?>
                                <img src="<?php echo base_url();?>uploads/<?php echo $profile[0]->id_front ?>" id="id_front" style="width:100%;height:100%" />
                                <?php
                                }
                                else{
                                ?>
                                     <img src="<?php echo base_url();?>assets/dashboard/img/upload-img.jpg" id="id_front" style="width:100%;height:100%" />
                                <?php
                                }
                                ?> 
                             </div>
                             
                            </center>
                         </div>
                         <div class="col-md-6">
                            <center>
                             <div class="back_side_con" style="">
                                <?php
                                if($profile[0]->id_back != "")
                                {
                                ?>
                                <img src="<?php echo base_url();?>uploads/<?php echo $profile[0]->id_back; ?>" style="width:100%;height:100%" />
                                <?php
                                }
                                 else{
                                ?>
                                     <img src="<?php echo base_url();?>assets/dashboard/img/upload-img.jpg" id="id_back" style="width:100%;height:100%" />
                                <?php
                                }
                                ?> 
                             </div>
    
                            </center>
                         </div>
                     </div>
                 </div>

                </div>
                
            </div>

        </div>
    </div>
</div>
<!--------------------------------------------------------popup----------------------------------------- -->
<div class="modal Modal_ student_modal" id="packagepopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Package</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="packageform" method="POST" class="_formSubmit" action="<?php echo base_url('institute/add_package'); ?>">
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Total Package(INR)</label>
                            <input id="package" type="number" name="package" class="form-control makeReqin date" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course Duration in Year(s)</label>
                            <input id="course_dur" type="number" name="course_dur" class="form-control makeReqin date" required autocomplete="new">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group package_fields_box">
                            
                        </div>
                    </div>
                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="student_id" id="student_id">
                            <input type="hidden" name="full_name" id="full_name">
                            <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                            <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                            <button type="submit" class=" svebtn" style="float:right">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- / .modal -->

<div class="modal Modal_" id="emailSend_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Email Student</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="email_send_form" class="instituteform" />
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Student Name</label>
                                    <input id="stu_name" type="text" name="stu_name" class="form-control makeReqin" required autocomplete="new">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Student Email</label>
                                    <input id="stu_email" type="email" name="stu_email" class="form-control makeReqin" required autocomplete="new">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Subject</label>
                                    <input id="subject" type="text" name="subject" class="form-control makeReqin" placeholder="Email Subject" required autocomplete="new">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Message</label>
                            <textarea id="message" name="message" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required autocomplete="new" placeholder="" style="height: 108px;"></textarea>
                        </div>
                    </div>
                    
                    
                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="student_id" id="student_HJ">
                            <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                            <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                            <button type="submit" class=" svebtn" style="float:right">Send Email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- / .modal -->

<!--<============
    Delete Popup 
      ============>-->

<div class="modal Modal_" id="DeleteClientPopupMultiple">
    <div class="modal-dialog Modal-width_580">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-body">
                <button type="button" class="close Popup_Delete_icn" data-dismiss="modal">
                    <a class="i-con-h-a"><i class="mr-2 i-con i-con-close"></i></a>
                </button>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 popup_bg_color padding-16">
                    <div class="row">
                        <div class="col-12 Botm_brdr">
                            <h3 id="h3_Delete" class="_fs16_">
                                <a class="i-con-h-a _mhrnclr_">
                                    <i class="mr-2 i-con i-con-bell"><i></i></i>
                                </a>
                                Delete Student.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Student from the dashboard?</p>
                        </div>
                    </div>
                    <form id="multiPleDeleteqw" method="POST" action="<?php echo base_url('admin/deletetaluka'); ?>">
                        <div class="row">
                            <div class="col-12 text-right">
                                <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                                <button type="submit" id="multiPleDelete" class="btn btn-responsive YesDlt-btn">Yes Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal Modal_" id="DeleteClientPopup">
    <div class="modal-dialog Modal-width_580">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-body">
                <button type="button" class="close Popup_Delete_icn" data-dismiss="modal">
                    <a class="i-con-h-a"><i class="mr-2 i-con i-con-close"></i></a>
                </button>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 popup_bg_color padding-16">
                    <div class="row">
                        <div class="col-12 Botm_brdr">
                            <h3 id="h3_Delete" class="_fs16_">
                                <a class="i-con-h-a _mhrnclr_">
                                    <i class="mr-2 i-con i-con-bell"><i></i></i>
                                </a>
                                Delete this Student.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Student from the dashboard?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <form id="singleDeleteIdq" method="POST" action="delete_student">
                                <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                                <input type="hidden" name="taluka_id" id="ehiddenid">
                                <button type="submit" class="btn btn-responsive YesDlt-btn">Yes Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<============
      Delete Popup End
      ============>-->

<div class="modal Modal_" id="kyc_view_modal">
    <div class="modal-dialog Modal-width_580">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-body">
                <button type="button" class="close Popup_Delete_icn" data-dismiss="modal">
                    <a class="i-con-h-a"><i class="mr-2 i-con i-con-close"></i></a>
                </button>
                <img src="" id="kyc_image" />
            </div>
        </div>
    </div>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>
