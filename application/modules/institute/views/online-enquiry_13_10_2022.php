<style type="text/css">
  .enquiryActive ._sdf_{
    
  color: #8A0A28 !important;
  }
   .OadmActive ._sdf_{
    
  color: #8A0A28 !important;
  }

 .title-header{
      background:#8E294F;
      height:70px;
      padding:20px;
}
</style>
<div id="content" class="flex ">
   <div class="page-container" id="page-container">
      <div class="title-header">
          <div class="">
            <span>
              <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-question-circle"></i> ONLINE ADMISSIONS</h3>
            </span>
          </div>
        </div>
      <div class="" style="padding: 16px;">
         
         <div class="table-responsive">
            <div class="page-title p-b-40 m-b-20 pt20">
                <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;">
                  <!-- <button onclick="openAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Enquiry</button> -->
                  <button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button></span>
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
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Admission No.</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Student Name</span></th>

                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Course</span></th>

                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Father Name</span></th> 

                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Mobile No.</span></th>
                   
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Father Number</span></th>

                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt"># Partner Code</span></th>

                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Date</span></th>

                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Whatsapp</span></th> 

                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>
                 
               </thead>
               <tbody id="tableBody">
                  <?php
                    $enq = $this->institute_model->getAllOnlineEnq();
                    // echo '<pre>'; print_r($enq); echo '</pre>';
                    for ($i=0; $i < count($enq); $i++) { 
                     
                  ?>
                  <tr>
                      <td>
                        <!-- <label class="checkboxcontainer">
                         <input type="checkbox" checked="checked" class="pivileges" name ="<?php //echo $enq[$i]->enquiry_id; ?>">
                         <span class="checkmark"></span>
                        </label>  -->
                         <label class="checkboxcontainer">
                         <input type="checkbox" value="<?php echo $enq[$i]->student_id; ?>" class="pivileges singleInput">
                         <span class="checkmark"></span>
                         </label>
                      </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_"><?php echo $i+1; ?></div>
                     </td>
                     <td>
                         <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->admmision_number; ?></div> 
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->name; ?></div>
                     </td>

                     <td>
                        <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->course_applied_for; ?></div>
                     </td>

                     <td>
                        <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->father_name; ?></div>
                     </td>

                     <td>
                        <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->student_mobile_number; ?></div>
                     </td>
                      
                      <td>
                        <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->father_mo_number; ?></div>
                     </td>
                     <td>
                         
                     </td>

                     <td>
                        <div class="item-except _greyClr_ _fs14_"><?=date('d-M-Y',strtotime($enq[$i]->online_enquiry_created_at)); ?>
                            <br />
                            <?=date('H:i A',strtotime($enq[$i]->online_enquiry_created_at)); ?>
                        </div>
                     </td>

                     <td class="text-center">
                        <div class="item-except _greyClr_ _fs14_"><a href="https://wa.me/<?='+91'.$enq[$i]->student_mobile_number; ?>?text=Hi <?=$enq[$i]->name; ?> Thanks for Taking online admission in our <?=$_SESSION['name']; ?> We are looking forward to receive your documents scan copy and payment receipt of seat booking fee. For Any clarifications let me know to assist you to complete your online admission process. Thanks" target="_blank"><i class="fa fa-whatsapp text-success" style="font-size:20px"></i></a></div>
                      </td>

                     <td class="actionbtns">
                       <span class="item-except mrm5 displayBlck _fs14_"><button enquiry_id="<?php echo $enq[$i]->online_enquiry_id; ?>" mobile="<?php echo $enq[$i]->student_mobile_number; ?>" class="btn _wtClr_ _fs14_ _bgbrwn_ i-con-h-a print-bttn convert_btn">Convert Student</button></span>
                        <span class="item-except mrm5 displayBlck makeresponsive"><a target="_blank" href="<?php echo base_url('institute/edit_online_enquiry/'.$enq[$i]->online_enquiry_id.'/edit'); ?>" class="btn _wtClr_ _fs14_  _bgyllw_ i-con-h-a edit-bttn staff_unable"><i class="i-con i-con-edit"></i></a></span>
                        <!-- <span class="item-except mrm5 displayBlck makeresponsive"><a target="_blank" href="<?php echo base_url('institute/online_enqury_page_view/'.$enq[$i]->online_enquiry_id.'/view'); ?>" class="btn _wtClr_ _fs14_  _bgyllw_ i-con-h-a edit-bttn"><i class="i-con i-con-eye"></i></a></span> -->
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button onclick="deleteFunc('<?php echo $enq[$i]->online_enquiry_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn staff_unable"><i class="i-con i-con-trash"><i></i></i></button></span>
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
            <form id="" method="POST" class="instituteform _formSubmit" action="">
                   <div class="form-group row">
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Full Name*</label>
                         <input id="name" type="text" name="name" class="form-control makeReqin" required autocomplete="new">
                      </div>
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">S/W/D of</label>
                         <input id="lastname" type="text" name="lastname" class="form-control makeReqin" required autocomplete="new">
                      </div>
                   </div>
                    <div class="form-group row">
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mothers Name*</label>
                         <input id="mothersname" type="text" name="mothersname" class="form-control makeReqin" required autocomplete="new">
                      </div>
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Occupation*</label>
                         <input id="occupation*" type="text" name="occupation" class="form-control makeReqin" required autocomplete="new">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date of Birth*</label>
                         <input id="birthDate" type="text" name="dob" class="form-control makeReqin date examDate" required autocomplete="new">
                      </div>
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left" required>Gender*</label><br>
                            <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left"><input type="radio" name="gender"value="Male">  Male</label>
                           <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left"style="padding-left: 30%;"> <input type="radio" name="gender"value="FeMale">  Female</label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-12 col-md-6">
                        <div class="form-group">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Stream*</label>
                         <select id="stream" name="stream" class="form-control makeReqin" required >
                           <option value="disabled">Stream</option>
                           <option value="converted">Converted</option>
                           <option value="notconverted">Not Converted</option>
                         </select>
                         </div>
                           <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Reffered By</label>
                           <input id="reffered" type="text" name="reffered" class="form-control makeReqin">
                      </div>
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Address</label>
                          <textarea id="address"  class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required autocomplete="new" style="height: 109px;"></textarea>
                      </div>
                   </div>
                  
                    <div class="form-group row">
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>
                         <input id="number" type="number" name="number" class="form-control makeReqin" required autocomplete="new">
                      </div>
                      <div class="col-12 col-md-6">
                         <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">City/Village*</label>
                          <input id="cityvillage*" type="text" name="cityvillage" class="form-control makeReqin" required autocomplete="new">
                      </div>
                   </div>

                   <div class="form-group row">
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email ID*</label>
                         <input id="email" type="email" name="email" class="form-control makeReqin" required  autocomplete="new">
                      </div>
                      <div class="col-12 col-md-6">
                         <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Timing Preferred</label>
                          <input id="timing" type="text" name="timing" class="form-control makeReqin" autocomplete="new">
                      </div>
                   </div>
                  <div class="form-group">
                      <div class="col-12">
                        <div class="modal-header"style="width: 100%">
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
                       <textarea id="remark" name="remark" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin"  style="height: 109px;" autocomplete="new"></textarea>
                      </div>
                   </div>
                    
                       <div class="modal-footer"style="width: 100%;">
                      <div class="col-12">
                        <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                        <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                         <button type="submit" class="svebtn"  style="float:right">Save</button>
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
                                <form id="singleDeleteIdq" method="POST" action="delete_online_enquiry">
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