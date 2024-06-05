<div id="content" class="flex ">
    <!-- ############ Main START-->
    <div class="page-container" id="page-container">

        <div class="title-header">
            <div class="d-flex justify-content-between">
              <span>
                  <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-gear"></i> MY PROFILE</h3>
              </span>
        </div>

        <div class="padding">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="bgwhite profileMainDiv">
                        <form method="POST" id="AdminAddNewManager" class="_formSubmit" action="<?php echo base_url(); ?>institute/update_institute_profile" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-md-4 text-center">
                                    <div class="thumbnail" id="thumbnail">
                                        <img class="width100Per" id="blah" src="<?php if (isset($_SESSION['emp_photo']) && $_SESSION['emp_photo'] != NULL && $_SESSION['emp_photo'] != "") {
                                            echo "../uploads/" . $_SESSION['emp_photo'];
                                            }else{
                                                echo base_url() . 'assets/dashboard/img/profileimg.png';  } ?>">

                                    </div>
                                   <!--  <label class="gredientButtn _fs14_ m-t-15 svebtn" for="fileUpload"><i class="fa fa-upload"></i> Upload</lebel>
                                    <input onchange="readURL(this);" type="file" name="image" id="fileUpload" hidden>
                                    <input type="hidden" name="old_logo" value="<?=$_SESSION['institute_logo']; ?>" /> -->

                                </div>

                                <div class="col-12 col-md-4">
                                    <input type="hidden" name="institute_id" value="<?php echo $_SESSION['institute_id']; ?>">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Employee Name*</label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="institute_name" required  value="<?php echo $_SESSION['emp_name']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number</label>
                                        </div>
                                        <div>
                                            <input type="number" maxlength="12" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="mobile" required value="<?php echo $_SESSION['emp_mobile']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email*</label>
                                        </div>
                                        <div>
                                            <input type="email" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="email" required value="<?php echo $_SESSION['emp_email']; ?>" disabled autocomplete="new">
                                        </div>
                                    </div>
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Employee Code</label>
                                        </div>
                                        <div>
                                            <input type="text" maxlength="12" class="form-control _fs14_ frmBg _drkclr_ _fntwss_"  value="<?php echo $_SESSION['emp_code']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Designation</label>
                                        </div>
                                        <div>
                                            <input type="text" maxlength="12" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" required value="<?php echo $_SESSION['emp_designation']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Department</label>
                                        </div>
                                        <div>
                                            <input type="text" maxlength="12" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" value="<?php echo $_SESSION['emp_department']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-default btn-responsive m-t-15 w-sm mb-1  _fwg500_ _fs14_  btn_hvr_effct nwFntSt" style="float: left">Back</button>
                                            <button type="submit" class=" svebtn btn-responsive m-t-15 w-sm mb-1 _wtClr_ _fwg500_ _fs14_  btn_hvr_effct nwFntSt" style="float:right">Save</button>
                                        </div>
                                    </div>
                                </div> -->

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ############ Main END-->
</div>

<div class="modal" id="profile_picture">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body posRela">
                <!-- Resize image -->
                <div>
                    <button type="button" class="close" data-dismiss="modal"><i class="la la-times"></i></button>
                </div>
                <div class="m-t-25 m-b-15">
                    <h4 class="_fs16_ _greyClr_ _fwg500_">Uploading your photo…</h4>
                </div>

                <section id="sectionResize">
                    <div class="image-resize" id="imageResize"></div>
                    <div class="text-center m-t-15">
                        <button class="btn btn-responsive m-t-15 w-sm mb-1 _wtClr_ _fwg500_ _fs14_ _addMngr_ btn_hvr_effct nwFntSt" id="crop"><span class='fa fa-crop'></span>Save</button>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>