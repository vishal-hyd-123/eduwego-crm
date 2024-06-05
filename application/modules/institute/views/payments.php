<style type="text/css">
    .paymentsActive ._sdf_ {

        color: #8A162B !important;
    }

    .appendicon {
        display: inline-block;
        background: green;
        color: white;
        border-radius: 100%;
        width: 20px;
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
              <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-exchange"></i> PAYEMNTS</h3>
            </span>
          </div>
        </div>
        <div class="padding">
            <div class="page-title p-b-40 m-b-20 pt20">
                <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="openAddPopup(this, '#opnPaymentpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Payment</button></span>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
                    <a href="https://datatables.net/extensions/responsive/" target="_blank"></a>
                    <thead>
                        <th></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#ID</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#<?php echo $paid_to_name_display; ?> Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Payment Mode</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Date</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Amount</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Porpose</span></th>

                    </thead>
                    <tbody id="tableBody">
                        <?php
                        // echo '<pre>'; print_r($payments); echo '</pre>';
                        // echo $this->db->last_query();
                        for ($i = 0; $i < count($payments); $i++) {

                        ?>
                            <tr>
                                <td><label class="checkboxcontainer">
                                        <input type="checkbox" class="pivileges">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo  $payments[$i]->paid_to_name; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo  $payments[$i]->payment_mode; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo  $payments[$i]->payment_date; ?></div>
                                </td>
                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo  $payments[$i]->amount; ?></div>
                                </td>
                                <td class="actionbtns">

                                    <!-- Controller name will be "print_check" with id parameter-->
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ printDrpDwn"><button onclick="print_check(this)" class="btn _fs14_ _bgbrwn_ i-con-h-a print-bttn">Print</button>
                                        <ul class="printDropDown">
                                            <li><a href="<?php echo base_url('institute/print_cheque/' . $payments[$i]->payment_id); ?>">Print Cheque</a></li>
                                            <li><a href="<?php echo base_url('institute/print_voucher/' . $payments[$i]->payment_id); ?>">Print Voucher</a></li>
                                        </ul>
                                    </span>

                                    <!-- Controller name will be 'editPaymentDetails' with id parameter -->
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ makeresponsive"><button onclick="editPaymentDetails('1')" class="btn _fs14_  _bgyllw_ i-con-h-a edit-bttn">Edit</button></span>

                                    <!-- add action url at bottom form id "singleDeleteIdq" -->
                                    <!--  <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" onclick="deleteFunc('id')" id="Delete-bttn"><button class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></button></span> -->

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
                <form id="staffform" method="POST" class="instituteform _formSubmit" action="<?php echo base_url('institute/add_payments'); ?>">
                    <input type="hidden" name="payment_type" value="<?php echo $payment_type; ?>">
                    <div class="row">
                        <div class="col-12 text-left col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date*</label>
                            <input id="date" type="text" name="date" class="form-control makeReqin examDate" required autocomplete="new-date" />
                        </div>
                        <div class="col-12 text-left col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left"><?php echo $paid_to_name_display ;?>  Name*</label>
                            <select id="subagentname" type="text" name="subagentname" class="form-control makeReqin" required>

                                <option>Please Select</option>
                                <?php
                                if ($payment_type == 1) {
                                    $paid_to;
                                    // echo '<pre>'; print_r($enq); echo '</pre>';
                                    for ($i = 0; $i < count($paid_to); $i++) {


                                ?>
                                        <option value="<?php echo $paid_to[$i]->vendor_name . "____" . $paid_to[$i]->vendor_id; ?>"><?php echo $paid_to[$i]->vendor_name; ?></option>
                                <?php
                                    }
                                }
                                ?>
                                <?php
                                if ($payment_type == 2) {
                                    $paid_to;
                                    // echo '<pre>'; print_r($enq); echo '</pre>';
                                    for ($i = 0; $i < count($paid_to); $i++) {


                                ?>
                                        <option value="<?php echo $enq[$i]->agent_name . "____" . $paid_to[$i]->agent_id; ?>"><?php echo $paid_to[$i]->agent_name; ?></option>
                                <?php
                                    }
                                }
                                ?>
                                <?php
                                if ($payment_type == 3) {
                                    $paid_to;
                                    // echo '<pre>'; print_r($enq); echo '</pre>';
                                    for ($i = 0; $i < count($paid_to); $i++) {

                                ?>
                                        <option value="<?php echo $paid_to[$i]->employee_name . "____" . $paid_to[$i]->employee_id;; ?>"><?php echo $paid_to[$i]->employee_name; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-left col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount* (in RS)</label>
                            <input id="amount" type="tel" name="amount" class="form-control makeReqin" required autocomplete="new" />
                        </div>

                        <div class="col-12 text-left col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Remark (if any)</label>
                            <input id="remark" type="text" name="remark" class="form-control makeReqin" autocomplete="new" />
                        </div>
                    </div>
                    <div class="appndpymntfiled">
                        <div class="row">
                            <div class="col-12 text-left col-md-6 form-group">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Payment Status*</label>
                                <select id="payment" type="text" name="payment" class="form-control makeReqin" required>
                                    <option value="paid">PAID</option>
                                    <option value="unpaid">UNPAID</option>
                                </select>
                            </div>

                            <div class="col-12 text-left col-md-6 form-group">
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
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Total Payment </label>
                            <input id="total_payment" type="text" name="total_payment" class="form-control makeReqin" autocomplete="new" />
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Payment Mode*</label>
                            <select id="m_payment" type="text" name="m_payment" class="form-control makeReqin" required>
                                <option value="Cheque">Cheque</option>
                                <option value="Cash">Cash</option>
                                <option value="Netbanking">Netbanking</option>
                                <option value="NEFT/RTGS">NEFT/RTGS</option>
                                <option value="GOOGLE PAY">GOOGLE PAY</option>
                                <option value="PHONEPE">PHONE PE</option>
                                <option value="ACCOUNT TRANSFERRED">ACCOUNT TRANSFERRED</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 text-left">
                            <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount in Words*</label>
                            <textarea id="amountInWord" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required style="height: 60px;" autocomplete="new" name="amount_in_words"></textarea>
                        </div>
                    </div>
                    <div class="row m-t-32">
                        <div class="col-12 form-group ">
                            <input type="hidden" name="payment_id" id="payment_id">
                            <a type="button" class="btn back_btn btn-default" style="float: left;" data-dismiss="modal">Back</a>
                            <button type="submit" class="svebtn" style="float: right;">Save</button>
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
                                Delete Payment.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Payment from the dashboard?</p>
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
                                Delete this district.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this district from the dashboard?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <form id="singleDeleteIdq" method="POST" action="">
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

<script></script>