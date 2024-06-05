

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

   font-weight:bold;

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

.payment-title{
  display: flex;
  justify-content: space-between;
}
.payment-title span{
  cursor: pointer;
  font-size: 20px;
}

</style>



<div id="content" class="flex ">

    <div class="title-header">

      <div class="">

        <span>

          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-user"></i> STUDENT PROFILE</h3>

        </span>

      </div>

    </div>



    <div class="page-container" id="page-container">



        <div class="padding">

            <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>



            <div class="page-title p-b-40 m-b-20">

              <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;">

                <a href="tel:<?php echo "+91 ".$profile[0]->mobile; ?>" class="btn btn-success i-con-h-a call-btn"><i class="fa fa-phone"></i> Call</a>

                <a  class="btn btn-success i-con-h-a" href="mailto:<?=$profile[0]->email; ?>" /><i class="fa fa-envelope"></i> Email</a>

                <a target="_blank" href="https://wa.me/<?="+91".$profile[0]->mobile; ?>" class="btn btn-success i-con-h-a call-btn"><i class="fa fa-whatsapp"></i> Whatsapp</a>

                <a href="<?=base_url(); ?>institute/smsTemplates/<?=base64_encode($profile[0]->student_id); ?>" class="btn btn-success i-con-h-a call-btn"><i class="fa fa-whatsapp"></i> Templates</a>

              </span>

            </div>



            <div class="row profile-box shadow-lg" style="padding:20px;background:white">

                <div class="col-md-3">

                    

                    <div class="profile_img_box">

                        <div style="width: 100%; height: auto;">

                            <div class="imgcontent" style="width: 180px;height: auto; text-align: center;">

                              <?php

                                if(isset($profile[0]->student_photo))

                                {

                              ?>

                                <img class="blah" id="blah" src="<?php echo base_url();?>uploads/<?php echo $profile[0]->student_photo; ?>" style="width: 100%;">

                              <?php

                                }

                                else {

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

                                echo $profile[0]->full_name;

                            ?>

                        </h4>

                    </center>

                    <div style="width:100%;">

                        <p>

                            <?php

                                echo "<i class='fa fa-envelope'></i>".$profile[0]->email;

                            ?>

                        </p>

                        <p>

                            <?php

                                echo "<i class='fa fa-phone'></i> ".$profile[0]->mobile;

                            ?>

                        </p>

                    </div>

                </div>

                <div class="col-md-9">

  

                    <div class="tab">

                      <button class="tablinks active" onclick="openCity(event, 'basic')">Basic Details</button>

                      <button class="tablinks" onclick="openCity(event, 'course')">Course Details</button>

                      <button class="tablinks" onclick="openCity(event, 'payment')">Fees Details</button>

                      <button class="tablinks" onclick="openCity(event, 'associate')">Associate Details</button>

                      <button class="tablinks" onclick="openCity(event, 'documents')">Documents Details</button>

                      <button class="tablinks" onclick="openCity(event, 'contact')">Contact</button>

                      <button class="tablinks" onclick="openCity(event, 'receipt')">General Receipt</button>

                    </div>



                    <div id="basic" class="tabcontent active" style="display:block">

                      <h3>Basic Details</h3>

                      <table class="details_table table-bordered w-100">

                          <tr>

                              <td >Name :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $profile[0]->full_name;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Father's Name :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $profile[0]->s_w_d_of;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >Mother's Name :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $profile[0]->mother_name;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >Ftaher's Occupation :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $profile[0]->occupation;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >D.O.B :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $profile[0]->dob;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >Gender :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $profile[0]->gender;

                                ?>

                              </td>

                          </tr>

                      </table>

                    </div>



                    <div id="course" class="tabcontent">

                      <h3>Course Details</h3>

                      <table class="details_table table-bordered w-100">

                          <tr>

                              <td>Course Name :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $profile[0]->course;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Stream Name :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $profile[0]->stream;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Course Duration :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $profile[0]->course_dur;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >Year of Admission :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $profile[0]->yoa;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >Reffered By : </td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $profile[0]->reffered_by;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Institute Name :</td>

                              <td  class="text-capitalize">

                                <?php

                                    $institute_id = $profile[0]->sub_institute_id;

                                    $sub_institute = $this->institute_model->getSubInstitute($institute_id);

                                    echo $sub_institute[0]->sub_institute_name;

                                ?>

                              </td>

                          </tr>

                          

                      </table>

                    </div>



                    <div id="payment" class="tabcontent">
                      <div class="payment-title">
                        <h3>Fees Details</h3>
                        <?php 
                        if($profile[0]->approval != '0')
                        {
                          ?>
                          <span class="text-success edit-fees"><i class="fa fa-edit"></i> Edit</span>
                          <?php
                        }
                        ?>
                      </div>
                      
                      <?php
                        
                      ?> 
                      <table class="details_table table-bordered w-100">
                          <tr>
                              <td>Total Course Fee (Total Package)(Rs.) :</td>
                              <td class="text-capitalize">
                                <?php
                                  if($profile[0]->approval == '0')
                                  {
                                    ?>
                                      <button class="btn btn-primary staff_unable approve-btn" stu_id="<?=$profile[0]->student_id; ?>" stu_name="<?=$profile[0]->full_name; ?>" yoa="<?=$profile[0]->yoa; ?>">Add Package</button>
                                    <?php
                                  }
                                  else{
                                    echo $payments[0]->package;
                                  }
                                    
                                ?>
                              </td>
                          </tr>

                          <tr>
                              <td>Total Paid Amount(Rs): </td>
                              <td  class="text-capitalize">
                                <?php
                                $paid = 0;
                                if(!empty($histories))
                                {
                                    foreach($histories as $key=>$history)
                                    {
                                        $paid += $history->total_fee;
                                    }
                                    echo $paid;
                                } else{
                                  echo $paid;
                                } 
                                ?>
                              </td>
                          </tr>
                          <tr>
                              <td >Total Due Amount (Rs.) :</td>
                              <td  class="text-capitalize">
                                <?php
                                  $package = $payments[0]->package;
                                  $due = $package-$paid;
                                  echo $due;
                                ?>
                              </td>
                          </tr>
                      </table>
                      <div class="fee-box bg-dark">
                        <table class="details_table w-100 table-bordered">
                            
                            <tr>

                                <th>Total Package (Rs.)</th>

                                <?php

                                foreach($payments as $payment)

                                {

                                ?>

                                  <th>Year(<?php echo $payment->yr_id; ?>)</th> 

                                <?php

                                }

                                ?> 

                            </tr>

                            <tr>

                              <td><?php echo $payments[0]->package; ?></td>

                              <?php

                              foreach($payments as $payment)

                              {

                              ?>

                               <td><?php echo $payment->yearly_fee; ?></td>

                               <?php

                              }

                               ?>

                            </tr>

                            <tr>

                              <td>Paid Amount</td>

                              <?php
                              
                              if(!empty($payments))
                              {
                                foreach($payments as $payment)
                                {
                                  $yr_id = $payment->yr_id;
                                  $student_id = $payment->student_id;
                                  $total_paid = 0;
                                  $yearly_paid = $this->db->query("SELECT * FROM payment_history WHERE yr_id = '".$yr_id."' AND student_id = '".$student_id."' ")->result();
                                  
                                  if(!empty($yearly_paid))
                                  {
                                    foreach($yearly_paid as $fees_paid)
                                    {
                                      $total_paid += $fees_paid->total_fee;
                                    }
                                  }
                                ?>

                                 <td><?php echo $total_paid; ?></td>

                                 <?php

                                }
                              } else{
                                echo $total_paid;
                              }

                              ?>

                            </tr>
                        </table>
                      </div>
                    </div>



                    <div id="associate" class="tabcontent associate_table">

                      <h3>Associate Details</h3>

                      <table class="details_table table-bordered w-100">

                        <?php

                          $agent_id = $profile[0]->agent_name;

                          $agent_details = $this->institute_model->get_agent_by_id($agent_id);

                        ?>

                        <tr>

                          <td>Associate Name</td>

                          <td>

                            <?php

                                echo $agent_details[0]->agent_name;

                            ?>

                          </td>

                        </tr>

                        <tr>

                          <td>Associate Mobile</td>

                          <td>

                            <?php

                                echo $agent_details[0]->agent_mobile;

                            ?>

                          </td>

                        </tr>

                        <tr>

                          <td>Associate Location</td>

                          <td>

                            <?php

                                echo $agent_details[0]->agent_location;

                            ?>

                          </td>

                        </tr>

                        <tr>

                          <td>Associate Address</td>

                          <td>

                            <?php

                                echo $agent_details[0]->agent_address;

                            ?>

                          </td>

                        </tr>

                      </table>

                    </div>

                    

                     <div id="documents" class="tabcontent documents_table">

                      <h3>Documents Details</h3>

                      <form id="documents_form" method="post" action="<?php echo base_url(); ?>institute/save_documents">

                      <table class="details_table table-bordered w-100 mb-4">

                        <tr>

                          <th>Document Name</th>

                          <th>Yes</th>

                          <th>Pending</th>

                          <th>Cleared</th>

                          <th>Returned</th>

                        </tr>

                        <tr>

                          <td>10th Marksheet</td>

                          <td><input type="checkbox" name="tenth_marks_submit" id="tenth_marks_submit" <?php if($documents[0]->tenth_marks_submit == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="tenth_marks_pending" id="tenth_marks_pending" <?php if($documents[0]->tenth_marks_pending == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="tenth_marks_cleared" id="tenth_marks_submit" <?php if($documents[0]->tenth_marks_cleared == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="tenth_marks_return" id="tenth_marks_return" <?php if($documents[0]->tenth_marks_return == "on"){echo "checked";} ?> /></td>

                        </tr>

                        <tr>

                          <td>12th Marksheet</td>

                          <td><input type="checkbox" name="twelth_marks_submit" id="twelth_marks_submit" <?php if($documents[0]->twelth_marks_submit == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="twelth_marks_pending" id="twelth_marks_pending" <?php if($documents[0]->twelth_marks_pending == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="twelth_marks_cleared" id="twelth_marks_submit" <?php if($documents[0]->twelth_marks_cleared == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="twelth_marks_return" id="twelth_marks_return" <?php if($documents[0]->twelth_marks_return == "on"){echo "checked";} ?> /></td>

                        </tr>

                        <tr>

                          <td>10th Admit Card</td>

                          <td><input type="checkbox" name="tenth_admit_submit" id="tenth_admit_submit" <?php if($documents[0]->tenth_admit_submit == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="tenth_admit_pending" id="tenth_admit_pending" <?php if($documents[0]->tenth_admit_pending == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="tenth_admit_cleared" id="tenth_admit_cleared" <?php if($documents[0]->tenth_admit_cleared == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="tenth_admit_return" id="tenth_admit_return" <?php if($documents[0]->tenth_admit_return == "on"){echo "checked";} ?> /></td>

                        </tr>

                        <tr>

                          <td>12th Admit Card</td>

                          <td><input type="checkbox" name="twelth_admit_submit" id="twelth_admit_submit"  <?php if($documents[0]->twelth_admit_submit == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="twelth_admit_pending" id="twelth_admit_pending"  <?php if($documents[0]->twelth_admit_pending == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="twelth_admit_cleared" id="twelth_admit_cleared"  <?php if($documents[0]->twelth_admit_cleared == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="twelth_admit_return" id="twelth_admit_return"  <?php if($documents[0]->twelth_admit_return == "on"){echo "checked";} ?> /></td>

                        </tr>

                        <tr>

                          <td>Migration Certificate</td>

                          <td><input type="checkbox" name="migration_submit" id="migration_submit" <?php if($documents[0]->migration_submit == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="migration_pending" id="migration_pending" <?php if($documents[0]->migration_pending == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="migration_cleared" id="migration_cleared" <?php if($documents[0]->migration_cleared == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="migration_return" id="migration_return" <?php if($documents[0]->migration_return == "on"){echo "checked";} ?> /></td>

                        </tr>

                        <tr>

                          <td>School leaving Certificate</td>

                          <td><input type="checkbox" name="school_leaving_submit" id="school_leaving_submit" <?php if($documents[0]->school_leaving_submit == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="school_leaving_pending" id="school_leaving_pending" <?php if($documents[0]->school_leaving_pending == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="school_leaving_cleared" id="school_leaving_cleared" <?php if($documents[0]->school_leaving_cleared == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="school_leaving_return" id="school_leaving_return" <?php if($documents[0]->school_leaving_return == "on"){echo "checked";} ?> /></td>

                        </tr>

                        <tr>

                          <td>10 number passport size photo</td>

                          <td><input type="checkbox" name="photo_submit" id="photo_submit" <?php if($documents[0]->photo_submit == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="photo_pending" id="photo_pending" <?php if($documents[0]->photo_pending == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="photo_cleared" id="photo_cleared" <?php if($documents[0]->photo_cleared == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="photo_return" id="photo_return" <?php if($documents[0]->photo_return == "on"){echo "checked";} ?> /></td>

                        </tr>

                        <tr>

                          <td>Aadhar Card Xerox</td>

                          <td><input type="checkbox" name="adhar_submit" id="adhar_submit" <?php if($documents[0]->adhar_submit == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="adhar_pending" id="adhar_pending" <?php if($documents[0]->adhar_pending == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="adhar_cleared" id="adhar_cleared" <?php if($documents[0]->adhar_cleared == "on"){echo "checked";} ?> /></td>

                          <td><input type="checkbox" name="adhar_return" id="adhar_return" <?php if($documents[0]->adhar_return == "on"){echo "checked";} ?> /></td>

                        </tr>



                      </table>

                      <div style="text-align:center">

                        <input type="hidden" name="student_id" value="<?php echo $profile[0]->student_id; ?>" />

                        <button type="submit" class="btn btn-primary">Save</button>

                        <a target="_blank" href="<?php echo base_url(); ?>institute/print_document_details/<?php echo $profile[0]->student_id; ?>" class="btn btn-info">Print</a>

                      </div>



                      </form>

                    </div>



                    <div id="contact" class="tabcontent contact_table">

                      <h3>Contact Details</h3>

                      <table class="details_table table-bordered w-100">

                        <tr>

                          <td>Phone:</td>

                          <td>

                            <?php

                                echo $profile[0]->mobile;

                            ?>

                          </td>

                        </tr>

                        <tr>

                          <td>Email:</td>

                          <td>

                            <?php

                                echo $profile[0]->email;

                            ?>

                          </td>

                        </tr>

                        <tr>

                          <td>Address:</td>

                          <td>

                            <?php

                                echo $profile[0]->address;

                            ?>

                          </td>

                        </tr>

                      </table>

                    </div>

                    <div id="receipt" class="tabcontent contact_table">
                      <h3>General Receipt</h3>
                      <form id="receipt-form" action="<?=base_url(); ?>institute/saveGeneralReceipt" method="post">
                        
                        <div class="row form-group particular-row">
                          <div class="col-md-6">
                            <input type="text" class="form-control mb-2" name="particular_name[]" placeholder="Particular Name" required />
                          </div>
                          <div class="col-md-6" >
                            <input type="text" class="form-control part-amt mb-2" name="particular_amt[]" placeholder="Amount" required />
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-4">
                            <button type="button" class="btn btn-danger particular-btn">Add</button>
                          </div>
                          <div class="col-md-4">
                            <label>Grand Total</label>
                          </div>
                          <div class="col-md-4" >
                            <input type="text" class="form-control mb-2 total_amt" name="total_amt" placeholder="Total Amount" readonly />
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 text-right">
                            <input type="text" class="form-control mb-2" name="amt_words" placeholder="Amount in Words" required />
                          </div>
                          <div class="col-md-6" >
                            <input type="text" class="form-control mb-2" name="payment_mode"  placeholder="Payment Mode" required />
                          </div>
                          <div class="col-md-6" >
                            <input type="text" class="form-control mb-2" name="txn_number"  placeholder="TXN Number" />
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 text-right">
                            <input type="hidden" name="student_id" value="<?=$profile[0]->student_id;?>" />
                            <button type="submit" class="btn btn-primary">Generate Receipt</button>
                          </div>
                        </div>

                      </form>
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
<div class="modal Modal_ edit_fees_modal" id="feesModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Edit Fees</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close feesModal-remove"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="editFeesForm" method="POST" class="_formSubmit" action="<?php echo base_url('institute/edit_fees'); ?>">
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Total Package(INR)</label>
                            <input id="package" type="number" name="package" class="form-control makeReqin date" value="<?=$payments[0]->package; ?>" required autocomplete="new" >
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course Duration in Year(s)</label>
                            <input id="course_dur" type="number" name="course_dur" value="<?=$payments[0]->course_dur; ?>" class="form-control makeReqin date" required autocomplete="new">
                        </div>
                        <?php  
                        if(!empty($payments))
                        {
                          foreach($payments as $key=>$fee)
                          {
                          ?>
                          <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Year- <?=$fee->yr_id; ?></label>
                          <span>
                            <input type="number" name="yearly_fees[]" class="form-control makeReqin yearly_fees" value="<?=$fee->yearly_fee; ?>" yr_id="<?=$fee->yr_id; ?>" required autocomplete="new">
                          </span>
                          </div>
                          <?php
                          }
                        }
                        ?>
                        
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group package_fields_box">
                            
                        </div>
                    </div>
                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="student_id" value="<?=$payments[0]->student_id; ?>" id="student_id">
                            <input type="hidden" name="full_name" id="full_name">
                            <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_ feesModal-remove" style="float: left" data-dismiss="modal">Back</a>
                            <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                            <button type="submit" class=" svebtn" style="float:right">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  $(".particular-btn").on('click',function(){
    var html = '';
    html += '<div class="col-md-6 mb-2">';
    html += '<input type="text" class="form-control" name="particular_name[]" placeholder="Particular Name" /></div>';
    
    html += '<div class="col-md-6 mb-2" ><input type="text" class="form-control part-amt" name="particular_amt[]" placeholder="Amount" /></div>';
    
    $(".particular-row").append(html);
    
  });

  $("#receipt-form").on('input','.part-amt',function(){
    var amt_box = $("#receipt-form .part-amt");
    var i;
    var total = 0;
    for(i=0;i<amt_box.length;i++)
    {
      total += Number(amt_box[i].value);
    }
    $(".total_amt").val(total);
    
  });
</script>

<script>
$(".approve-btn").on('click',function(){
  $('#packagepopup').modal('show');
  var stu_id = $(this).attr('stu_id');
  var stu_name = $(this).attr('stu_name');
  var yoa = Number($(this).attr('yoa'));
  $('#packageform #student_id').val(stu_id);
  $('#packageform #yoa').val(yoa);
  $('#packageform #course_dur').on('input',function(){
      var course_dur = $(this).val();
      if(course_dur != '')
      {
        var html = "";
        var i;
        for(i=1;i<=course_dur;i++)
        {
            var yr =  (yoa+i)-1;
            html += '<div style="margin-bottom:5px;padding:4px">';
            html += '<label>Year- '+i+' ('+yr+') Fees</label><input type="number" name="yearly_fee_'+i+'" required />';
            html += '<input type="hidden" name="fees_yr[]" value="'+yr+'" />'; 
            html += '</div>';
        }
        $(".package_fields_box").append(html);
      }
      else{
        $(".package_fields_box").html("");
      }
  });
});
</script>

<script>
  $(".edit-fees").on('click',function(){
    $(".edit_fees_modal").show('modal');
  });

  $(".feesModal-remove").on("click",function(){
    $(".edit_fees_modal").hide('modal');
  });

  $(".save-fees").on('click',function(){
    var input = $(this).prev();
    var fees = $(input).val();
    var yr_id = $(input).attr('yr_id');
    var student_id = $(this).attr('student_id');
    alert(student_id);
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/editFees',
      data : {
        yr_id : yr_id,
        fees : fees,
        student_id : student_id
      },
      success : function(res){
        var data = JSON.parse(res);
        if(data.status == false){
          if(data.errormessage){
            vNotify.error({text:data.errormessage, title:'Error!'});
          }
        }

        if(data.status == true){
          vNotify.success({text:data.message});
          setTimeout(function(){
            location.reload();
          }, 1000);
        }
      }
    });

  });
</script>

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

