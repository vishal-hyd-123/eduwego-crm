<style type="text/css">
    /*.VendorActive, .VendorActive:hover{
   background: rgba(91, 193, 70, 0.1);
   border-color: #5BC146;
   color: #8A162B;
   }*/
    .vendorActive ._sdf_ {
        color: #8A0A28 !important;
    }

    .appendicon {
        display: inline-block;
        background: green;
        color: white;
        border-radius: 100%;
        width: 20px;
    }

    .uplodimg[type=file] {
        padding-bottom: 27px;
        font-size: 11px;
        background: #8a162b26;
    }
    .title-header{
      background:#8E294F;
      height:70px;
      padding:20px;

    }
    /*.uplodimg:hover > .button {
  background: dodgerblue;
  color: white;

}*/
</style>
<div id="content" class="flex ">
    <div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-user"></i>  VENDORS</h3>
        </span>
      </div>
    </div>
    <div class="page-container" id="page-container">
        <div class="padding">
            <div class="page-title p-b-40 m-b-20 pt20">
                <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="openAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Vendor</button><button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button></span>
            </div>
            <div class="table-responsive">
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
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Vendor Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Mobile</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Location</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Payment Details</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>
                    </thead>
                    <tbody id="tableBody">

                        <?php
                        $enq = $this->institute_model->getAllActiveVendors();
                        // echo '<pre>'; print_r($enq); echo '</pre>';
                        for ($i = 0; $i < count($enq); $i++) {


                        ?>
                            <tr>
                                <td>
                                    <!-- <label class="checkboxcontainer">
                           <input type="checkbox" checked="checked" name="<?php echo $enq[$i]->vendor_id; ?>" class="pivileges">
                           <span class="checkmark"></span>
                         </label>  -->
                                    <label class="checkboxcontainer">
                                        <input type="checkbox" value="<?php echo $enq[$i]->vendor_id; ?>" class="pivileges singleInput">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->vendor_name; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->vendor_mobile; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->vendor_location; ?></div>
                                </td>

                                <td>
                                    <div class="item-except _greyClr_ _fs14_"> <button onclick="makepaymentvendor(<?php echo $enq[$i]->vendor_id; ?>)" type="button" class="btn btn-outline-success Paymentpopup">Make Payment</button></div>
                                </td>

                                <td class="actionbtns">
                                    <!-- <span class="item-except mrm5 displayBlck _wtClr_ _fs14_"><button onclick="" class="btn _fs14_ _bgbrwn_ i-con-h-a print-bttn">Print</button></span> -->
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ makeresponsive"><button onclick="editVendor('<?php echo $enq[$i]->vendor_id; ?>')" class="btn _fs14_  _bgyllw_ i-con-h-a edit-bttn"><i class="i-con i-con-edit"></i>Edit</button></span>
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button onclick="deleteFunc('<?php echo $enq[$i]->vendor_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></button></span>
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

<!--------------------------------------Payment popup---------------------------------------->
<div class="modal Modal_" id="opnPaymentpopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Payment</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="add_vendor_payment" method="POST" action="<?php echo base_url(); ?>institute/add_payments" class="instituteform">
                    <div class="form-group row">
                        <div class="col-12 text-left col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date*</label>
                            <input id="date" type="text" name="date" class="form-control makeReqin examDate" required autocomplete="new-date" />
                        </div>

                        <div class="col-12 text-left col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Vendor Name*</label>
                            <input id="subagentname" type="text" name="subagentname" class="form-control makeReqin" required autocomplete="new" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 text-left col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount* (in RS)</label>
                            <input id="amount" type="tel" name="amount" class="form-control makeReqin" required autocomplete="new" />
                        </div>

                        <div class="col-12 text-left col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Remark (if any)</label>
                            <input id="remark" type="text" name="remark" class="form-control makeReqin" autocomplete="new" />
                        </div>
                    </div>
                    <div class="appndpymntfiled">
                        <div class="form-group row">
                            <div class="col-12 text-left col-md-6">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Payment Status*</label>
                                <select id="payment" type="text" name="payment" class="form-control makeReqin" required>
                                    <option value="1">PAID</option>
                                    <option value="2">UNPAID</option>
                                </select>
                            </div>

                            <div class="col-12 text-left col-md-6">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Purpose*</label><i class="i-con i-con-delete remove" hidden=""><i></i></i>
                                <input id="purpose" type="text" name="purpose" class="form-control makeReqin" required autocomplete="new" />
                                <!-- <p class="_fs14_ _fwg500_ _greyClr_ text-right appendcontent" style="margin-top: 10px;">
                                    <span>
                                        <a onclick="appendSection();" class="btn btn-responsive add_btn"><i class="_wtClr_ i-con i-con-plus"></i></a>
                                    </span>
                                </p> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 text-left col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Total Payment </label>
                            <input id="total_payment" type="text" name="total_payment" class="form-control makeReqin" autocomplete="new" />
                        </div>
                        <div class="col-12 text-left col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Payment Mode*</label>
                            <select id="m_payment" type="text" name="m_payment" class="form-control makeReqin" required>
                                 <option value="Cheque">Cheque</option>
                                <option value="Cash">Cash</option>
                                <option value="Netbanking">Netbanking</option>
                                <option value="NEFT/RTGS">NEFT/RTGS</option>
                                <option value="GOOGLE PAY">GOOGLE PAY</option>
                                <option value="PHONEPE">PHONEPE</option>
                                <option value="ACCOUNT TRANSFERRED">ACCOUNT TRANSFERRED</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 text-left">
                            <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount in Words*</label>
                            <textarea id="amountInWord" name="amount_in_words" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required style="height: 60px;" autocomplete="new"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="hidden" name="payment_type" value="1">
                            <input type="hidden" class="vendor_id" name="agent_id" />
                            <a type="button" class="btn back_btn btn-default" style="float: left;" data-dismiss="modal">Back</a>
                            <button type="submit" class="svebtn" style="float: right;">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!---------------------------------opnpopup------------------------------------ -->
<div class="modal Modal_" id="opnpopup">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Vendor</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="agentform" method="POST" class="instituteform _formSubmit" action="institute/add_vendor" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-4 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Vendor Name:</label>
                            <input id="agentName" type="text" name="agentName" class="form-control makeReqin" autocomplete="new">
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>
                            <input id="number" type="text" name="number" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Location*</label>
                            <input id="location" type="location" name="location" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 text-left">
                            <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Permanent Address*</label>
                            <textarea id="amountword" name="address" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required style="height: 60px;" autocomplete="new"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 form-group col-md-4">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Created Date</label>
                            <input id="createDate" type="text" name="creatdate" class="form-control makeReqin date examDate" autocomplete="new">
                        </div>
                        <div class="col-12 form-group col-md-4">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">GST Number</label>
                            <input id="gst_number" type="text" maxlength="16" minlength="16" name="gst_number" class="form-control makeReqin" autocomplete="new">
                        </div>
                        <div class="col-12 form-group col-md-4">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">KYC Document Type*</label>
                            <select id="kyc" name="kyc" class="form-control makeReqin" required>
                                <option>KYC Document Type</option>
                                <option value="Adharcard">Adharcard</option>
                                <option value="Voter ID">Voter ID</option>
                                <option value="Passport">Passport</option>
                                <option value="GST Number">GST Number</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group row">

                  <div class="col-12 text-left">
                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Upload Front Side Image</label>
                     <input id="frntimg" type="file" name="frntimg" class="form-control makeReqin uplodimg blah" autocomplete="new">
                  </div>
               </div>
                <div class="form-group row">
                  <div class="col-12 text-left">
                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Upload Back Side Image</label>
                     <input id="backimg" type="file" name="frntimg" class="form-control makeReqin uplodimg blah" autocomplete="new">
                  </div>
               </div> -->

                    <div class="form-group row">
                        <div class="col-12 text-center col-md-6">
                            <div style="width: 100%; height: auto;">
                                <div class="imgcontent text-center" style="">
                                    <img class="front_side" id="front_side" src="<?php echo base_url(); ?>assets/dashboard/img/upload-img.jpg" style="width: 100%;">
                                </div>
                                <label for="frntimg" class="col-form-label _fs14_ _fwg500_ upload_img_btn">Upload KYC</label>
                                <input id="frntimg" accept="Images/*" type="file" name="id_front" class="form-control makeReqin uplodimg file-input" hidden="">
                                <input type="hidden" name="front_hidden" id="front_hidden">

                            </div>
                        </div>
                        <!-- old code  -->
                        <!-- <div class="col-12 text-left">
                     <label for="" class="col-form-label _fs14_ _fwg500_">Upload Front Side Image</label>
                     <input id="frntimg" type="file" name="frntimg" class="form-control makeReqin uplodimg file-input blah" autocomplete="new">
                  </div> -->

                        <div class="col-12 text-center col-md-6">
                            <div style="width: 100%; height: auto;">
                                <div class="imgcontent text-center" style="">
                                    <img class="back_side" id="back_side" src="<?php echo base_url(); ?>assets/dashboard/img/upload-img.jpg" style="width: 100%;">
                                </div>
                                <label for="backimg" class="col-form-label _fs14_ _fwg500_ upload_img_btn">Upload KYC</label>
                                <input id="backimg" accept="Images/*" type="file" name="id_back" class="form-control makeReqin uplodimg file-input" hidden="">
                                <input type="hidden" name="back_hidden" id="back_hidden">
                            </div>
                        </div>

                    </div>
                    <!-- <div class="col-12 text-left">
                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Upload Back Side Image</label>
                     <input id="backimg" type="file" name="frntimg" class="form-control makeReqin uplodimg file-input blah" autocomplete="new">
                  </div> -->
                <div class="row">
                    <div class="col-12">
                        <!-- <button type="button" class="btn btn-default" style="float: left"data-dismiss="modal">Back</button> -->
                        <input type="hidden" name="vendor_id" id="vendor_id">
                        <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                        <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                        <button type="submit" class="svebtn" style="float:right">Save</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

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
                                Delete Vendor.
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Vendor from the dashboard?</p>
                        </div>
                    </div>
                    <form id="multiPleDeleteqw" method="POST" action="<?php echo base_url('institute/delete_vendor'); ?>">
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
                                Delete this Vendor.
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Vendor from the dashboard?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <form id="singleDeleteIdq" method="POST" action="<?php echo base_url('institute/delete_vendor'); ?>">
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
<script>

</script>