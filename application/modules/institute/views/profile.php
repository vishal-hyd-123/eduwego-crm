<div id="content" class="flex ">
    <!-- ############ Main START-->
    <div class="page-container" id="page-container">

        <div class="title-header">
            <div class="d-flex justify-content-between">
              <span>
                  <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-gear"></i> INSTITUTE PROFILE</h3>
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
                                        <img class="width100Per" id="blah" src="<?php if (isset($_SESSION['institute_logo']) && $_SESSION['institute_logo'] != NULL && $_SESSION['institute_logo'] != "") {
                                            echo "../uploads/" . $_SESSION['institute_logo'];
                                            }else{
                                                echo base_url() . 'assets/dashboard/img/profileimg.png';  } ?>">

                                    </div>
                                    <label class="gredientButtn _fs14_ m-t-15 svebtn" for="fileUpload"><i class="fa fa-upload"></i> Upload Logo</lebel>
                                    <input onchange="readURL(this);" type="file" name="image" id="fileUpload" hidden>
                                    <input type="hidden" name="old_logo" value="<?=$_SESSION['institute_logo']; ?>" />

                                </div>
                                <div class="col-12 col-md-4 text-center">
                                    <div class="thumbnail" id="thumbnail">
                                        <img class="width100Per" id="sig" src="<?php if (isset($_SESSION['institute_sig']) && $_SESSION['institute_sig'] != NULL && $_SESSION['institute_sig'] != "") {
                                            echo "../uploads/" . $_SESSION['institute_sig'];
                                            }else{
                                                echo base_url() . 'assets/dashboard/img/profileimg.png';  } ?>">

                                    </div>
                                    <label class="gredientButtn _fs14_ m-t-15 svebtn" for="fileupload1"><i class="fa fa-upload"></i> Upload Signature</lebel>
                                    <input onchange="readSigURL(this);" type="file" name="sig" id="fileupload1" hidden>
                                    <input type="hidden" name="old_sig" value="<?=$_SESSION['institute_sig']; ?>" />

                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="hidden" name="institute_id" value="<?php echo $_SESSION['institute_id']; ?>">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Institute Name*</label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="institute_name" required placeholder="Institute Name" value="<?php echo $_SESSION['name']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number</label>
                                        </div>
                                        <div>
                                            <input type="number" maxlength="12" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="mobile" required value="<?php echo $_SESSION['mobile']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email*</label>
                                        </div>
                                        <div>
                                            <input type="email" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="email" required placeholder="Isntituteemail@gmail.com" value="<?php echo $_SESSION['email']; ?>" disabled autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Landline No.</label>
                                        </div>
                                        <div>
                                            <input type="number" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="landline_no" value="<?php echo $_SESSION['landline']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Payment Link</label>
                                        </div>
                                        <div>
                                            <input type="website" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="payment_link" value="<?php echo $_SESSION['payment_link']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Refund Policy Link</label>
                                        </div>
                                        <div>
                                            <input type="website" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="refund_link" value="<?php echo $_SESSION['refund_link']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Facebook Link</label>
                                        </div>
                                        <div>
                                            <input type="website" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="facebook_link" value="<?php echo $_SESSION['facebook_link']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Google Business Link</label>
                                        </div>
                                        <div>
                                            <input type="website" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="google_business_link" value="<?php echo $_SESSION['google_business_link']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Brochure Download Link</label>
                                        </div>
                                        <div>
                                            <input type="website" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="brochure_link" value="<?php echo $_SESSION['brochure_link']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Twitter Link</label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="twitter_link" value="<?php echo $_SESSION['twitter_link']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Instagram Link</label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="instagram_link" value="<?php echo $_SESSION['instagram_link']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Youtube Link</label>
                                        </div>
                                        <div>
                                            <input type="website" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="youtube_link" value="<?php echo $_SESSION['youtube_link']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Subscription Expiry Date</label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" value="<?=date('d-M-Y',strtotime($_SESSION['institute_expiry_date'])); ?>" autocomplete="new" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Max No. of Leads</label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" value="" autocomplete="new" disabled />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Admission Fee</label>
                                        </div>
                                        <div>
                                            <input type="number" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="admsn_fee" value="<?php echo $_SESSION['admission_fee']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Institute Address*</label>
                                        </div>
                                        <div>
                                            <textarea class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="address" required><?php echo $_SESSION['institute_address']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">State</label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="state" value="<?php echo $_SESSION['state']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">City</label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control _fs14_ frmBg _drkclr_ _fntwss_" name="city" value="<?php echo $_SESSION['city']; ?>" autocomplete="new">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Admission Link</label>
                                        </div>
                                        <div>
                                            <input type="website" class="form-control _fs14_ frmBg _drkclr_ _fntwss_"  value="<?php echo $_SESSION['admission_link']; ?>" autocomplete="new" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group m-t-15">
                                        <div>
                                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Enquiry Link</label>
                                        </div>
                                        <div>
                                            <input type="website" class="form-control _fs14_ frmBg _drkclr_ _fntwss_"  value="<?php echo $_SESSION['enquiry_link']; ?>" autocomplete="new" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-default btn-responsive m-t-15 w-sm mb-1  _fwg500_ _fs14_  btn_hvr_effct nwFntSt" style="float: left">Back</button>
                                            <button type="submit" class=" svebtn btn-responsive m-t-15 w-sm mb-1 _wtClr_ _fwg500_ _fs14_  btn_hvr_effct nwFntSt" style="float:right">Save</button>
                                        </div>
                                    </div>
                                </div>
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