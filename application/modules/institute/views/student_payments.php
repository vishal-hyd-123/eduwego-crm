

<style type="text/css">

    /*.studentActive, .studentActive:hover{

    background: rgba(91, 193, 70, 0.1);

    border-color: #5BC146;

    color: #8A162B;

  }*/

  .header_box{
    width:100%;
    height:auto;
    padding:12px;
  }

  .header_box h5{

    color:gray;

  }

  .yearly_box_con{

    width:100%;

    display:flex;

    overflow-x: scroll;

    

  }

   .yearly_box{

    width:30%;

    height:350px;

    padding:12px;

    margin-right:10px;

   }



   @media(max-width:768px)

   {

        .yearly_box{

            width:100%;

            height:auto;

            padding:12px;

            margin-right:10px;

        }

   }



   .package_table{

    width:100%;

   } 

   .package_table th,td{

    text-align:center;

    padding:7px;

   }



   .payment_history_box{

    width:100%;

    height:auto;

    padding:12px;

   }

   .title-header{

      background:#8E294F;

      height:70px;

      padding:20px;



    }

    .add_btn_box{

        width:100%;

        height:25%;

        background:#ccc;

        position: absolute;

        left:0;

        bottom:0;

    }

    .receipt_pdf_btn{
        cursor: pointer;
    }

</style>

<div id="content" class="flex ">

    <div class="title-header">

        <div class="">

        <span>

            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-money"></i> PAYMENT DETAILS</h3>

        </span>

        </div>

    </div>

    <div class="padding">

        <a href="javascript: history.go(-1)" class="btn m-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

    </div>

    <div class="page-container" id="page-container">

        <div class="padding">

        <div class="padding shadow-lg my-3" style="background:white">

            <center><h3>Payment Details</h3></center>
            <p>
                <i class="fa fa-pdf"></i><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false">General Receipts</a>
            </p>

            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                <table class="history_table table-bordered w-100 mb-3" style="">
                    <tr>
                        <th style="text-align: center">Sl. No.</th>
                        <th style="text-align: center">Date</th>
                        <th style="text-align: center">Payment Amount</th>
                        <th style="text-align: center">Payment Mode</th>
                        <th style="text-align: center">Download Receipt</th>
                    </tr>
                    <?php
                    if($general_receipts == null)
                    {
                      ?>
                        <tr>
                          <td colspan="7" class="text-align:center">No Payment Records Found</td>
                        </tr>
                      <?php
                    }
                    else{
                        $sl = 1;
                        foreach($general_receipts as $history)
                        {
                            
                    ?>
                    <tr>
                        <td><?php echo $sl++; ?></td>
                        <td><?php echo date('d-M-Y',strtotime($history->created_at)); ?></td>
                        <td><?php echo $history->total_amt; ?></td>
                        <td><?php echo $history->payment_mode; ?></td>
                        <td>
                            Download Receipt
                            <a href="<?=base_url(); ?>institute/print_general_receipt/<?=$history->receipt_id; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                      }
                    ?>
                </table>
              </div>
            </div>

            <div class="header_box mb-3">
                <?php
                    echo '<h5 class="text-capitalize my-3"><b>Name : </b>'.$payments[0]->student_name.' | <b>Course Duration : </b>'.$payments[0]->course_dur.' Year(s)</h5>';

                    $paid = 0;
                    for($i=0;$i<count($payments);$i++)
                    {
                        $paid += $payments[$i]->paid_amount;
                    }
                    $paid;

                    $total_package = $payments[0]->package;
                    $student_id = $payments[0]->student_id;

                    $all_payments = $this->db->query("SELECT total_fee,agent_discount FROM payment_history WHERE student_id = '".$student_id."' ")->result();
                    
                    $total_fees_paid = 0;
                    $total_agent_cmsn = 0;
                    if(!empty($all_payments))
                    {
                        foreach($all_payments as $pay)
                        {
                            $total_fees_paid += (float)$pay->total_fee;
                            $total_agent_cmsn += (float)$pay->agent_discount;
                        }
                    }

                    $total_due_amount = $total_package-$total_fees_paid;
                ?>
                
                <table class="package_table table-bordered mb-3" style="">
                    <tr>
                        <th>Total Package (Rs.)</th>
                        <th>Total Paid Amount (Rs.)</th>
                        <th>Total Due Amount (Rs.)</th>
                        <th>Total Paid to Agent (Rs.)</th>
                    </tr>
                    <tr>
                        <td><?php echo $payments[0]->package; ?></td>
                        <td><?php echo $total_fees_paid; ?></td>
                        <td><?php echo $total_due_amount; ?></td>
                        <td>
                        <?php
                            echo $total_agent_cmsn;
                        ?>
                        </td>
                    </tr>
                </table>
                
            </div>
            
            
            <div class="yearly_box_con" >
                
                <?php
                 foreach($payments as $key=>$payment)
                 { 
                    $yr_id = $payment->yr_id;
                    $student_id = $payment->student_id;
                    $history = $this->db->query("SELECT * FROM payment_history WHERE yr_id = '".$yr_id."' AND student_id = '".$student_id."' ")->result();
                    
                    $yearly_fee = $payment->yearly_fee;
                    $total_paid = 0;
                    $agent_cmsn = 0;
                    foreach($history as $his)
                    {
                       $total_paid +=  $his->total_fee;
                       $agent_cmsn += (float)$his->agent_discount;
                    }
                    $due_amount = $yearly_fee-$total_paid;

                ?>
                <div class="yearly_box mb-3" style="border:2px solid #ccc;position:relative">
                    <div style="width:100%;background:padding:5px;border-bottom:1px solid #ccc;margin-bottom:5px">
                        <center><p style="font-weight:bold;font-size:15px">Year : <?php echo $payment->yr_id." (".$payment->year."-".$payment->year_end.")"; ?></p></center>
                    </div>
                    <p style="font-weight:bold">Yearly Fees : <?=$yearly_fee; ?> Rs.</p>
                    <p style="font-weight:bold">Paid Amount : <?=$total_paid; ?> Rs.</p>
                    <p style="font-weight:bold">Due Amount : <?=$due_amount; ?> Rs.</p>
                    <p style="font-weight:bold">Agent Commission : <?=$agent_cmsn; ?> Rs.</p>
                    <?php
                        if($payment->yearly_fee > $total_paid)
                        {
                    ?>
                    <div class="add_btn_box">
                    <center>
                        <button class="btn btn-primary payment_btn my-4" student_id="<?php echo $payment->student_id; ?>" student_name="<?php echo $payment->student_name; ?>" yr_id="<?php echo $payment->yr_id ?>" year="<?php echo $payment->year ?>" yr_fees="<?php echo $payment->yearly_fee; ?>" paid="<?php echo $total_paid; ?>" due="<?php echo $due_amount; ?>" agent_discount="<?php echo $payment->agent_discount; ?>" course_id="<?php echo $payment->course_id; ?>" agent_id="<?php echo $payment->agent_id; ?>" agent_discount="<?php echo $payment->agent_discount; ?>" style="background:#8E294F">+ Add Payment</button>
                    </center>
                    </div>
                    <?php
                        }
                        else{
                            ?>
                            
                            <div class="add_btn_box">
                            <center>
                                <div class="dropdown">
                                    <button class="btn my-4 text-white receipt_btn" type="button" data-toggle="dropdown" student_id="<?php echo $payment->student_id; ?>" yr_id="<?php echo $payment->yr_id ?>" style="background:#8E294F">No Due Certificate
                                    <!-- <span class="caret"></span></button> -->
                                    <!-- <ul class="dropdown-menu">
                                        <li class="receipt_btn" student_id="<?php echo $payment->student_id; ?>" yr_id="<?php echo $payment->yr_id ?>" copy="student"><i class="fa fa-file-pdf-o"></i> Student Copy</li>
                                        <li class="receipt_btn" student_id="<?php echo $payment->student_id; ?>" yr_id="<?php echo $payment->yr_id ?>" copy="college"><i class="fa fa-file-pdf-o"></i> College Copy</li>
                                    </ul> -->
                                </div>
                            </center>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="table-responsive payment_history_box my-3">

                <center><h4>Payment History</h4></center>

                <table class="package_table table-bordered mb-3" style="">

                    <tr>

                        <th>Sl. No.</th>

                        <th>Payment Id.</th>

                        <th>Year</th>

                        <th>Payment Amount</th>

                        <th>Payment Mode</th>

                        <th>Date</th>

                        <th>Download Receipt</th>

                    </tr>

                    <?php

                        $sl = 1;

                        foreach($histories as $history)

                        {

                            

                    ?>

                    <tr>

                        <td><?php echo $sl++; ?></td>

                        <td><?php echo (1000+$history->payment_id); ?></td>

                        <td><?php echo $history->yr_id; ?></td>

                        <?php

                            $total_fee = (float)$history->total_fee;

                        ?>

                        <td><?php echo $total_fee; ?></td>

                        <td><?php echo $history->payment_mode; ?></td>

                        <td>

                        <?php 

                            $raw_date = strtotime($history->date);

                            echo date('d-m-Y',$raw_date);

                        ?>

                        </td>

                        <td>

                            Student Copy
                            <i class="fa fa-file-pdf-o receipt_pdf_btn" copy="student" payment_id="<?php echo $history->payment_id; ?>" yr_id="<?php echo $history->yr_id; ?>"></i><br/>

                            College Copy
                            <i class="fa fa-file-pdf-o receipt_pdf_btn" copy="college" payment_id="<?php echo $history->payment_id; ?>" yr_id="<?php echo $history->yr_id; ?>"></i>

                        </td>

                    </tr>

                    <?php

                        }

                    ?>

                </table>

            </div>

            

        </div>

    </div>

    </div>

</div>

<!--------------------------------------------------------popup----------------------------------------- -->

<div class="modal Modal_ student_modal" id="payment_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Payment</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="staffform" method="POST" class="_formSubmit" action="<?php echo base_url('institute/add_student_payment'); ?>">
                    <div class="row form-group">
                        <input type="hidden" class="student_id" name="student_id" />
                        <input type="hidden" class="student_name" name="student_name" />

                        <input type="hidden" class="course_id" name="course_id" />
                        <div class="col-md-6">
                            <label>Year</label><br>
                            <input type="text" class="year form-control" readonly />
                            <input type="hidden" class="yr_id" name="yr_id" />
                            <input type="hidden" class="year" name="year" />
                        </div>
                        <div class="col-md-6">
                            <label>Total Yearly College Fee</label><br>
                            <input type="number" class="yr_fees form-control" readonly />
                            <input type="hidden" class="yr_fees" name="yr_fees" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 ">
                            <label>Amount Paid (Yearly)</label><br>
                            <input type="number" class="total_paid form-control" readonly />
                            <input type="hidden" class="total_paid" name="total_paid" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Due Amount (Yearly)</label><br>
                            <input type="text" class="due form-control" readonly />
                            <input type="hidden" class="due" name="due" />
                            <input type="hidden" class="prev_due" name="prev_due" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 ">
                            <label>Tution Fees</label><br>
                            <input type="number" class="paying_amount form-control" name="paying_amount">
                        </div>
                        <div class="col-md-6 ">
                            <label>Payment Mode</label><br>
                            <select class="payment_mode form-control" name="payment_mode">
                                <option>Cash</option>
                                <option>Bank Transfer</option>
                                <option>DD</option>
                                <option>Google Pay</option>
                                <option>Phone Pe</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 form-group">
                            <label>Admission Fees</label><br>
                            <input type="number" class="admission_fee form-control" name="admission_fee" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>University Fees</label><br>
                            <input type="number" class="university_fee form-control" name="university_fee" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 ">
                            <label>Hostel Fees</label><br>
                            <input type="number" class="hostel_fee form-control" name="hostel_fee" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Miscellaneous Fees</label><br>
                            <input type="number" class="misc_fee form-control" name="misc_fee" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 ">
                            <label>Transport Fees</label><br>
                            <input type="number" class="transport_fee form-control" name="transport_fee" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Books Fees</label><br>
                            <input type="number" class="books_fee form-control" name="books_fee" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 agent_discount_field">
                            <label>Paid To Associate</label><br>
                            <!-- <input type="number" class="agent_discount_input form-control"> -->
                            <input type="number" class="agent_discount form-control" name="agent_discount">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Total Amounts in Words</label><br>
                            <input type="text" class="amount_in_words form-control" name="amount_in_words" required />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 agent_discount_field">
                            <label>UPI ID.</label><br>
                            <input type="text" name="upi_id" class="upi_id form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Transaction Id.</label><br>
                            <input type="text" class="trans_id form-control" name="trans_id" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 agent_discount_field">
                            <label>Bank Name</label><br>
                            <input type="text" name="bank_name" class="bank_name form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Scholarship</label><br>
                            <input type="text" class="scholarship form-control" name="scholarship" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 agent_discount_field">
                            <label>Student Credit Card</label><br>
                            <input type="text" name="credit_card" class="credit_card form-control">
                        </div>
                    </div>
                    
                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="agent_id" class="agent_id" />
                            <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>

                            <button type="submit" class=" svebtn" style="float:right">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- / .modal -->



<div class="modal Modal_" id="loan_letter">

    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Loan</h5>

                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>

            </div>

            <!-- Modal Header -->

            <div class="modal-body">

                <form id="admission_letter_form" target="_blank" method="POST" class="instituteform" action="<?php echo base_url('institute/print_loan_letter'); ?>">

                    <div class="row">

                        <div class="col-12 col-md-6">

                            <div class="row">

                                <div class="col-12 form-group">

                                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Year*</label>

                                    <input id="year" type="text" name="year" class="form-control makeReqin" required autocomplete="new">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-12 form-group">

                                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount*</label>

                                    <input id="amount" type="text" name="amount" class="form-control makeReqin" autocomplete="new">

                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Description</label>

                            <textarea id="Description" name="Description" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required autocomplete="new" placeholder="1st year acedamic fees & mess fees" style="height: 108px;"></textarea>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-12 text-left">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount In Words</label>

                            <input id="amount_in_words" type="text" name="amount_in_words" class="form-control makeReqin" autocomplete="new">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Academic Year</label>

                            <input id="Academic_Year" type="text" name="Academic_Year" class="form-control makeReqin" autocomplete="new" placeholder="2017-20">

                        </div>

                    </div>

                    <div class="row m-t-16">

                        <div class="col-12 form-group">

                            <input type="hidden" name="student_id" id="student_HJ">

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

