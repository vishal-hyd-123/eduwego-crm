<style type="text/css">

   /*.agentActive, .agentActive:hover{

   background: rgba(91, 193, 70, 0.1);

   border-color: #5BC146;

   color: #8A162B;

   }*/

   .instituteActive ._sdf_{

   color: #8A0A28 !important;

   }

  .appendicon

 {

  display: inline-block;

    background: green;

    color: white;

    border-radius: 100%;

    width: 20px;

 }

 .uplodimg[type=file]{

padding-bottom: 27px;

    font-size: 11px;

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

 </style>

<div id="content" class="flex ">

   <div class="page-container" id="page-container">

      <div class="padding">

<!--          <div class="row">

            <div class="col-12 col-md-6">

               <h2 class="mb-0 nwFntSt _blckClr_ _fwg500_ _fs16_ pull-left">Institute List</h2>

            </div>

            <div class="col-12 col-md-6 text-right">

               <button class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete" style="display: none;"><i style="color: #fff" class="i-con i-con-trash"><i></i></i></button>

            </div>

         </div> -->

         

         <div class="row profile-box shadow-lg" style="padding:20px;background:white">

                <div class="col-12">

                    <div class="tab">

                      <button class="tablinks active" onclick="openCity(event, 'basic')">Institute Details</button>

                      <button class="tablinks" onclick="openCity(event, 'students')">Students Details</button>

                      <button class="tablinks" onclick="openCity(event, 'associates')">Associates Details</button>

                      <button class="tablinks" onclick="openCity(event, 'staff')">Employees/Staff</button>

                      <button class="tablinks" onclick="openCity(event, 'password')">Change Password</button>

                    </div>

                    <div id="basic" class="tabcontent active" style="display:block">

                      <h3>Institute Details</h3>

                      <table class="details_table table-bordered w-100">

                          <tr>

                              <td >Institute Name :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $details[0]->institute_name;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Institute Mobile :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $details[0]->institute_mobile;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >Institute Email :</td>

                              <td >

                                <?php

                                    echo $details[0]->institute_email;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >Institute Address :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $details[0]->institute_address;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >Institute Expiry Date :</td>

                              <td  class="text-capitalize">

                                <?php

                                    $date = strtotime($details[0]->institute_expiry_date);

                                    $date = date('d-m-Y',$date);

                                    echo $date;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td >Subdomain :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $details[0]->subdomain;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Html File Name :</td>

                              <td  class="text-capitalize">

                                <?php

                                    echo $details[0]->html_file_name;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Facebook Link :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $details[0]->html_file_name;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Google Business Link :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $details[0]->google_business_link;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Twitter Link :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $details[0]->twitter_link;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Instagram Link :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $details[0]->instagram_link;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Message API Username :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $details[0]->msg_api_username;

                                ?>

                              </td>

                          </tr>

                           <tr>

                              <td>Message API Password :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $details[0]->msg_api_password;

                                ?>

                              </td>

                          </tr>

                          <tr>

                              <td>Institute IVR Link :</td>

                              <td class="text-capitalize">

                                <?php

                                    echo $details[0]->my_ivr_link;

                                ?>

                              </td>

                          </tr>



                      </table>

                    </div>



                    <div id="students" class="tabcontent">

                      <h3>Student Details</h3>

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

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Mobile</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Stream</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Course</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#YOA</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Agent Name</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Fee Committed</span></th>



                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>



                    </thead>

                    <tbody id="tableBody">

                        <?php

                        foreach($students as $student)

                        {

                        ?>

                            <tr>

                                <td>

                                    <!-- <label class="checkboxcontainer">

                           <input type="checkbox" checked="checked" class="pivileges">

                           <span class="checkmark"></span>

                           </label>  -->

                                    <label class="checkboxcontainer">

                                        <input type="checkbox" value="<?php echo $student->student_id; ?>" class="pivileges singleInput">

                                        <span class="checkmark"></span>

                                    </label>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_ text-capitalize"><?php echo $student->full_name; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->mobile; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->stream; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->course; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->yoa; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $agent_name ; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->package; ?></div>

                                </td>

                                <td class="actionbtns">

                                    <!--  <span class="item-except mrm5 displayBlck _wtClr_ _fs14_">

                                      <a style="color: #fff" href="#" class="btn _fs14_ _bgbrwn_ i-con-h-a print-bttn" target="_blank">Print</a>

                                    </span> -->

                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_">

                                        <button onclick="viewStudent('<?php echo $student->student_id; ?>')" class="btn _fs14_  bg-success i-con-h-a view-bttn makeresponsive"><i class="i-con i-con-eye"></i></button><button onclick="editStudent('<?php echo $student->student_id; ?>')" class="btn _fs14_  bg-primary i-con-h-a edit-bttn makeresponsive staff_unable"><i class="i-con i-con-edit"></i>Edit</button></span>

                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button onclick="deleteFunc('<?php echo $student->student_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn staff_unable"><i class="i-con i-con-trash"><i></i></i></button></span>

                                    <span>

                                        <a onclick="showDropDown(this)" class="i-con-h-a">

                                            <i class="i-con i-con-more"><i></i></i>

                                        </a>

                                    </span>

                                    <ul class="dropdownList">

                                        <li><a class="btn" href="<?php echo "print_admission_letter/" . $student->student_id; ?>">View Admission Letter</a></li>

                                        <li><a class="btn" href="<?php echo "print_bonafied_letter/" . $student->student_id; ?>">View Bonafide Certificate</a></li>

                                        <li><a class="btn" href="javascript:void(0)" onclick="loanLetter('<?php echo $student->student_id; ?>')">View Loan Letter</a></li>

                                    </ul>

                                </td>

                            </tr>



                        <?php

                        }

                        ?>



                    </tbody>

                  </table>

                    </div>



                  <div id="associates" class="tabcontent">

                    <h3>Associates List</h3>

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

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Associate Name</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Mobile</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Location</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Address</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Agent KYC</span></th>

                         <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#PAN No.</span></th>

                        <!-- <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th> -->



                    </thead>

                    <tbody id="tableBody">

                        <?php

                        foreach($agents as $agent)

                        {

                        ?>

                            <tr>

                                <td>

                                    <!-- <label class="checkboxcontainer">

                           <input type="checkbox" checked="checked" class="pivileges">

                           <span class="checkmark"></span>

                           </label>  -->

                                    <label class="checkboxcontainer">

                                        <input type="checkbox" value="<?php echo $agent->agent_id; ?>" class="pivileges singleInput">

                                        <span class="checkmark"></span>

                                    </label>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_ text-capitalize"><?php echo $agent->agent_name; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $agent->agent_mobile; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $agent->agent_location; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $agent->agent_address; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $agent->agent_kyc; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $agent->pan_number; ?></div>

                                </td>

                                

                                <!-- <td class="actionbtns">

                                    

                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_">

                                        <button onclick="viewStudent('<?php echo $student->student_id; ?>')" class="btn _fs14_  bg-success i-con-h-a view-bttn makeresponsive"><i class="i-con i-con-eye"></i></button><button onclick="editStudent('<?php echo $student->student_id; ?>')" class="btn _fs14_  bg-primary i-con-h-a edit-bttn makeresponsive staff_unable"><i class="i-con i-con-edit"></i>Edit</button></span>

                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button onclick="deleteFunc('<?php echo $student->student_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn staff_unable"><i class="i-con i-con-trash"><i></i></i></button></span>

                                    <span>

                                        <a onclick="showDropDown(this)" class="i-con-h-a">

                                            <i class="i-con i-con-more"><i></i></i>

                                        </a>

                                    </span>

                                    <ul class="dropdownList">

                                        <li><a class="btn" href="<?php echo "print_admission_letter/" . $student->student_id; ?>">View Admission Letter</a></li>

                                        <li><a class="btn" href="<?php echo "print_bonafied_letter/" . $student->student_id; ?>">View Bonafide Certificate</a></li>

                                        <li><a class="btn" href="javascript:void(0)" onclick="loanLetter('<?php echo $student->student_id; ?>')">View Loan Letter</a></li>

                                    </ul>

                                </td> -->

                            </tr>



                        <?php

                        }

                        ?>



                    </tbody>

                  </table>

                      

                    </div>



                    <div id="staff" class="tabcontent contact_table">

                      <h3>Employee/Staff Details</h3>

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

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Employee Name</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Mobile</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Location</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Address</span></th>

                        <!-- <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th> -->



                    </thead>

                    <tbody id="tableBody">

                        <?php

                        $i = 1;

                        foreach($staffs as $staff)

                        {

                        ?>

                            <tr>

                                <td>

                                    <!-- <label class="checkboxcontainer">

                           <input type="checkbox" checked="checked" class="pivileges">

                           <span class="checkmark"></span>

                           </label>  -->

                                    <label class="checkboxcontainer">

                                        <input type="checkbox" value="<?php echo $agent->agent_id; ?>" class="pivileges singleInput">

                                        <span class="checkmark"></span>

                                    </label>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i++; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_ text-capitalize"><?php echo $staff->employee_name; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $staff->employee_mobile; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $staff->location; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $staff->employee_address; ?></div>

                                </td>

                                

                              <!--  <td class="actionbtns">

                                

                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_">

                                        <button onclick="viewStudent('<?php echo $student->student_id; ?>')" class="btn _fs14_  bg-success i-con-h-a view-bttn makeresponsive"><i class="i-con i-con-eye"></i></button><button onclick="editStudent('<?php echo $student->student_id; ?>')" class="btn _fs14_  bg-primary i-con-h-a edit-bttn makeresponsive staff_unable"><i class="i-con i-con-edit"></i>Edit</button></span>

                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button onclick="deleteFunc('<?php echo $student->student_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn staff_unable"><i class="i-con i-con-trash"><i></i></i></button></span>

                                    <span>

                                        <a onclick="showDropDown(this)" class="i-con-h-a">

                                            <i class="i-con i-con-more"><i></i></i>

                                        </a>

                                    </span>

                                    <ul class="dropdownList">

                                        <li><a class="btn" href="<?php echo "print_admission_letter/" . $student->student_id; ?>">View Admission Letter</a></li>

                                        <li><a class="btn" href="<?php echo "print_bonafied_letter/" . $student->student_id; ?>">View Bonafide Certificate</a></li>

                                        <li><a class="btn" href="javascript:void(0)" onclick="loanLetter('<?php echo $student->student_id; ?>')">View Loan Letter</a></li>

                                    </ul>

                                </td> -->

                            </tr>



                        <?php

                        }

                        ?>



                    </tbody>

                  </table>

                </div>

                <div id="password" class="tabcontent contact_table">
                    <h3>Change Password</h3>
                    <form id="passwordForm" class="_formSubmit" action="<?=base_url(); ?>admin/changeInstPassword" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <lebel>New Passwod</lebel>
                                <input type="text" class="form-control" name="new_pass" />
                                <input type="hidden" name="institute_id" value="<?=$details[0]->institute_id; ?>" />
                                <button type="submit" class="btn btn-primary my-2">Submit</button>
                            </div>
                        </div>
                        
                    </form>
                </div>



                    

                </div>

                

            </div>

         

      </div>

   </div>

</div>

<div class="modal Modal_" id="opnpopup">

   <div class="modal-dialog modal-lg">

      <div class="modal-content">

         <div class="modal-header ">

            <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Edit Institute</h5>

            <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>

         </div>

         <div class="modal-body">

            <form role="form" class="_formSubmit" id="form" method="post" action="<?php echo base_url('admin/add_institute'); ?>">

               <div class="col-12 col-sm-6">

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Institute Name<span class="validation-color">*</span></label>

                    <input id="name" type="text" name="name" class="form-control makeReqin">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Contact Number<span class="validation-color">*</span></label>

                    <input id="mobile" type="text" name="mobile" class="form-control makeReqin">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Email<span class="validation-color">*</span></label>

                    <input id="email" type="email" name="email" class="form-control makeReqin">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Number of Students<span class="validation-color">*</span></label>

                    <input id="allowed_student" type="text" name="allowed_student" class="form-control makeReqin">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Message Api Username*<span class="validation-color">*</span></label>

                    <input id="msg_api_username" type="text" name="msg_api_username" class="form-control makeReqin">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Message Api Password<span class="validation-color">*</span></label>

                    <input id="msg_api_password" type="text" name="msg_api_password" class="form-control makeReqin">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Subdomain Name<span class="validation-color">*</span></label>

                    <input id="subdomain" type="text" name="subdomain" class="form-control makeReqin">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Registration Form Html File Name<span class="validation-color">*</span></label>

                    <input id="html_file_name" type="text" name="html_file_name" class="form-control makeReqin">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Registration Form Html File Name Editable<span class="validation-color">*</span></label>

                    <input id="html_file_name_editable" type="text" name="html_file_name_editable" class="form-control makeReqin">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Expiry Date<span class="validation-color">*</span></label>

                    <input id="expiry_date" type="text" name="expiry_date" class="form-control makeReqin date examDate">

                  </div>

                  <div class="form-group">

                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Address<span class="validation-color">*</span></label>

                     <textarea id="Address"  name="address" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required style="height: 60px;"></textarea>

                  </div>



                  <div class="col-sm-12">

                     <div class="box-footer">

                        <button type="submit" id="submit" class="btn btn-primary">Update</button>

                        <input type="hidden" name="institute_id" value="" id="institute_id">

                     </div>

                  </div>

               </div>

            </form>

         </div>

      </div>

   </div>

</div>

<!--------------------------------------Payment popup---------------------------------------->



<!-- / .modal -->

<!--<============

   Delete Popup 

     ============>-->



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

                        Delete Institute.

                     </h3>

                  </div>

               </div>

               <div class="row">

                  <div class="col-12 m-t-20">

                     <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete institute from the dashboard?</p>

                  </div>

               </div>

               <div class="row">

                  <div class="col-12 text-right">

                     <form id="singleDeleteIdq" method="POST" action="<?php echo base_url('admin/deleteInstitute'); ?>">

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