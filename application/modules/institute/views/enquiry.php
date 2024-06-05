<style type="text/css">
    .enquiryActive ._sdf_ {

        color: #8A0A28 !important;
    }
    .title-header{
      background:#8E294F;
      height:70px;
      padding:20px;

    }
    .table-responsive{
        background:white;
        padding:10px 15px;
        border-radius:10px;
        margin-top: 30px;
        margin-bottom: 30px;
    }
</style>
<div id="content" class="flex ">
    <div class="title-header">
        <div class="">
            <span>
                <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-question-circle "></i> ALL ENQUIRY</h3>
            </span>
        </div>
    </div>

    <div class="page-container" id="page-container">
        <div class="">
            
            <div class="table-responsive shadow-lg">
                <div class="page-title p-b-40 m-b-20 pt20">
                    <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="openAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Enquiry</button><button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button></span>
                </div>
                <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
                    <a href="https://datatables.net/extensions/responsive/" target="_blank"></a>
                    <thead>
                        <th>
                            <label class="checkboxcontainer">
                                <input type="checkbox" name="" class="pivileges" id="selectAll">
                                <span class="checkmark"></span>
                            </label>
                        </th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#ID</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Student Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Mobile No.</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Location</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Course</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Stream</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Type</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>

                    </thead>
                    <tbody id="tableBody">
                        <?php
                        $enq = $this->institute_model->getAllActiveEnq();
                        // echo '<pre>'; print_r($enq); echo '</pre>';
                        for ($i = 0; $i < count($enq); $i++) {


                        ?>
                            <tr>
                                <td>
                                    <!-- <label class="checkboxcontainer">
                         <input type="checkbox" checked="checked" class="pivileges" name ="<?php //echo $enq[$i]->enquiry_id; 
                                                                                            ?>">
                         <span class="checkmark"></span>
                        </label>  -->
                                    <label class="checkboxcontainer">
                                        <input type="checkbox" value="<?php echo $enq[$i]->enquiry_id; ?>" class="pivileges singleInput">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->full_name; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->mobile; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->city; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->course; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->stream; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->lead_status;
                                                                                ?></div>
                                </td>
                                <td class="actionbtns">
                                <div class="btn-group">
                                    <a type="button" target="_blank" href='https://api.whatsapp.com/send?phone=<?php echo '+91 '.$enq[$i]->mobile; ?>' class="btn _fs14_ bg-success i-con-h-a print-bttn"><i class="fa fa-whatsapp"></i></a>
                                    <a type="button" onclick="editEnquiry('<?php echo $enq[$i]->enquiry_id; ?>')" class="btn _fs14_  _bgyllw_ i-con-h-a edit-bttn text-white staff_unable">Edit
                                            <!-- <i class="i-con i-con-edit"></i> --></a>
                                    <a type="button" onclick="deleteFunc('<?php echo $enq[$i]->enquiry_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn text-white staff_unable"><i class="i-con i-con-trash"><i></i></i></a>
                                </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal Modal_" id="opnpopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Personal Details</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="" method="POST" class="instituteform _formSubmit" action="add_enquiry">
                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Full Name*</label>
                            <input id="name" type="text" name="name" class="form-control makeReqin" autocomplete="new" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">S/W/D of</label>
                            <input id="lastname" type="text" name="lastname" class="form-control makeReqin" autocomplete="new">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mothers Name*</label>
                            <input id="mothersname" type="text" name="mothersname" class="form-control makeReqin" autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Occupation*</label>
                            <input id="occupation" type="text" name="occupation" class="form-control makeReqin" autocomplete="new">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date of Birth*</label>
                            <input id="birthDate" type="text" name="dob" class="form-control makeReqin date examDate" autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Gender*</label><br>
                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left"><input type="radio" name="gender" value="Male"> Male</label>
                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left" style="padding-left: 30%;"> <input type="radio" name="gender" value="FeMale"> Female</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course*</label>
                                <select id="course" name="course" class="form-control makeReqin" required>
                                    <option value>Select Course</option>

                                    <?php
                                    $enq = $this->institute_model->getAllActiveCourses();
                                    // echo '<pre>'; print_r($enq); echo '</pre>';
                                    for ($i = 0; $i < count($enq); $i++) {


                                    ?>
                                        <option value="<?php echo $enq[$i]->course_name; ?>"><?php echo $enq[$i]->course_name; ?></option>


                                    <?php
                                    }
                                    ?>
                                    <!-- <option value="IIT">IIT</option> -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Stream*</label>
                                <select id="stream" name="stream" class="form-control makeReqin" required>
                                    <option value>Select Stream</option>
                                    <?php
                                    $enq = $this->institute_model->getAllActiveStreams();
                                    // echo '<pre>'; print_r($enq); echo '</pre>';
                                    for ($i = 0; $i < count($enq); $i++) {


                                    ?>
                                        <!-- <option value>Select Stream</option> -->
                                        <option value="<?php echo $enq[$i]->stream_name; ?>"><?php echo $enq[$i]->stream_name; ?></option>


                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Reffered By</label>
                            <input id="reffered" type="text" name="reffered" class="form-control makeReqin">
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Address</label>
                                <textarea id="address" name="address" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" autocomplete="new" style="height: 109px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Lead Status*</label>
                                <select id="lead_status" name="lead_status" class="form-control makeReqin">
                                    <option value>Status</option>
                                    <option value="Hot">Hot</option>
                                    <option value="Cold">Cold</option>
                                    <option value="Junk">Junk</option>
                                    <option value="Converted">Converted</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>
                            <input id="number" type="text" maxlength="12" name="number" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">City/Village*</label>
                            <input id="cityvillage" type="text" name="cityvillage" class="form-control makeReqin" autocomplete="new">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email ID*</label>
                            <input id="email" type="email" name="email" class="form-control makeReqin" autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Timing Preferred</label>
                            <input id="timing" type="text" name="timing" class="form-control makeReqin" autocomplete="new">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <div class="modal-header" style="width: 100%">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left" style="width: 100%;">Fees Details</label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course Fee Committed</label>
                            <input id="committed" type="text" name="committed" class="form-control makeReqin" autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Reminder Date*</label>
                            <input id="date" type="text" name="admissionyer" class="form-control makeReqin date examDate" autocomplete="new">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Discount Promised (if any)</label>
                                <input id="discount" type="text" name="discount" class="form-control makeReqin" autocomplete="new">
                            </div>
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Net Fees Applicable)</label>
                            <input id="Fees" type="text" name="Fees" class="form-control makeReqin">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Remark</label>
                            <textarea id="remark" name="remark" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" style="height: 109px;" autocomplete="new"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <input type="hidden" name="enquiry_id" id="enquiry_id">
                            <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                            <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                            <button type="submit" class="svebtn" style="float:right">Save</button>
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
                                Delete Personal Details.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Personal Details from the dashboard?</p>
                        </div>
                    </div>
                    <form id="multiPleDeleteqw" method="POST" action="">
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
                                Delete this Personal Details.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Personal Details from the dashboard?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <form id="singleDeleteIdq" method="POST" action="delete_enquiry">
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

<div class="modal Modal_" id="sendSmsPop">
    <div class="modal-dialog Modal-width_580">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-body">
                <button type="button" class="close Popup_Delete_icn" data-dismiss="modal">
                    <a class="i-con-h-a"><i class="mr-2 i-con i-con-close"></i></a>
                </button>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 popup_bg_color padding-16">
                    <form id="sendSMSFrom" class="_formSubmit" method="POST" action="">
                        <div class="row">
                            <div class="col-12 Botm_brdr">
                                <h3 id="h3_Delete" class="_fs16_">
                                    <a class="i-con-h-a _mhrnclr_">
                                        <i class="mr-2 i-con i-con-bell"><i></i></i>
                                    </a>
                                    Write Message.</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-t-20">
                                <textarea class="form-control sendSMSTextArea"></textarea>
                                <p class="showMsgLength"><span class="showMsgLengthS">0</span>/160</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                                <input type="hidden" name="id" id="eShiddenid">
                                <input type="hidden" name="mobile" id="mhiddenid">
                                <button type="submit" class="btn btn-responsive YesDlt-btn">Send SMS</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>