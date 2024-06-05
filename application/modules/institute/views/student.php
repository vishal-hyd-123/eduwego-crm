<style type="text/css">
    /*.studentActive, .studentActive:hover{
    background: rgba(91, 193, 70, 0.1);
    border-color: #5BC146;
    color: #8A162B;
  }*/
    .studentActive ._sdf_ {
        color: #8A0A28 !important;
    }

    .imgcontent{
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 180px;
    }
    .title-header{
      background:#8E294F;
      height:70px;
      padding:20px;
      
    }

    .approved{
        font-size: 20px;
    }

    .approve-btn{
        cursor: pointer;
    }
    .student-con{
        margin-top: 30px;
    }
    #students-table{
        border-top: 2px solid #ccc;
        padding-top: 10px;
    }
</style>
<div id="content" class="flex ">
    <div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-group"></i> STUDENTS LIST</h3>
        </span>
      </div>
    </div>

    <div class="page-container" id="page-container">
        <div class="">
        
            <div class="student-con table-responsive shadow-lg mb-4">
                <div class="page-title p-b-40 m-b-20 pt20">
                    <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

                    <span class="item-except mr-3 mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;">
                    <button onclick="studentAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Student</button><button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button></span>
                    
                </div>

                <form id="student-details">
                    <div class="row">
                        
                        <div class="col-md-2">
                          <select class="form-control selected_yr" name="selected_year">
                            <?php  
                            $curr_yr = date('Y');
                            $starting_yr = '2021';
                            $diff = $curr_yr-$starting_yr;
                            for($i=0;$i<=$diff;$i++)
                            {
                              $yr = $curr_yr-$i;
                            ?>
                              <option value="<?=$yr; ?>"><?=$yr; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <?php  
                          $institute_id = $_SESSION['institute_id'];
                          $courses = $this->db->query("SELECT course_id,course_name FROM courses WHERE institute_id = '".$institute_id."' AND course_status = '1' ")->result();
                          ?>
                          <select class="form-control selected_course" name="selected_course">
                            <option value="">Select Course</option>
                            <?php  
                            if(!empty($courses))
                            {
                              foreach($courses as $course)
                              {
                                ?>
                                  <option value="<?=$course->course_id; ?>"><?=$course->course_name; ?></option>
                                <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <select class="form-control selected_stream" name="selected_stream">
                            <option value="">Select Stream</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <?php  
                            $agents = $this->db->query("SELECT agent_id,agent_name FROM agents WHERE institute_id = '".$institute_id."' AND agent_status = '1' ")->result();
                          ?>
                          <select class="form-control selected_agent" name="selected_agent">
                            <option value="">Select Associate</option>
                            <?php  
                            if(!empty($agents))
                            {
                              foreach($agents as $agent)
                              {
                                ?>
                                  <option value="<?=$agent->agent_id; ?>"><?=$agent->agent_name; ?></option>
                                <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <button type="submit" class="btn btn-primary">Search</button>
                          <button type="button" class="btn btn-success csv-btn">Download Students List</button>
                        </div>
              
                    </div>
                </form>
            
                <div id="students-table">
                <table id="studentTable" class="table-theme table-row v-middle w-100" role="grid" aria-describedby="clientTable_info">
                    <thead>
                        <th>
                            <label class="checkboxcontainer">
                                <input type="checkbox" name="" class="pivileges" id="selectAll">
                                <span class="checkmark"></span>
                            </label>
                        </th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">ID</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Student Code</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Student Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Mobile</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Stream</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Course</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">YOA</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Agent Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Fee Committed</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Actions</span></th>
                        
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        $enq = $this->institute_model->getAllActiveStudent();
                        // echo '<pre>'; print_r($enq); echo '</pre>';
                        for ($i = 0; $i < count($enq); $i++) {
                            
                            $agent_id =  $enq[$i]->agent_name;

                            $agent_details = $this->institute_model->get_agent_by_id($agent_id);
                            // echo '<pre>'; print_r($agent_details); echo '</pre>';
                            $agent_name = $agent_details[0]->agent_name;


                        ?>
                            <tr>
                                <td>
                                    <label class="checkboxcontainer">
                                        <input type="checkbox" value="<?php echo $enq[$i]->student_id; ?>" class="pivileges singleInput">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->student_code; ?></div>
                                </td>
                                
                                <td>
                                    <div class="item-except _greyClr_ _fs14_ text-capitalize"><?php echo $enq[$i]->full_name; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->mobile; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->stream; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->course; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->yoa; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $agent_name ; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->package; ?></div>
                                </td>
                                <td class="actionbtns">
                                    <div class="item-except _greyClr_ _fs14_">
                                        <div class="btn-group" role="group">
                                
                                        <button type="button" onclick="viewStudent('<?php echo $enq[$i]->student_id; ?>')" class="btn _fs14_  bg-success i-con-h-a view-bttn makeresponsive"><i class="i-con i-con-eye"></i></button>

                                        <button type="button" onclick="editStudent('<?php echo $enq[$i]->student_id; ?>')" class="btn _fs14_  bg-primary i-con-h-a edit-bttn makeresponsive staff_unable"><i class="i-con i-con-edit"></i>Edit</button>

                                        <button type="button" onclick="deleteFunc('<?php echo $enq[$i]->student_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn text-white staff_unable"><i class="i-con i-con-trash"><i></i></i></button>
                                        
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-print"></i>
                                        </button>

                                       <ul class="dropdownList dropdown-menu" style="height:auto">
                                            <li class="dropdown-item"><a class="btn" target="_blank" href="<?php echo "print_admission_letter/" . $enq[$i]->student_id; ?>">View Admission Letter</a></li>
                                            <li class="dropdown-item"><a class="btn" target="_blank" href="<?php echo "print_bonafied_letter/" . $enq[$i]->student_id; ?>">View Bonafide Certificate</a></li>
                                            <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="feeStructureBonafide(<?php echo $enq[$i]->student_id; ?>,<?php echo $enq[$i]->course_dur; ?>)">Bonafide Certificate With Fees Structure</a></li>
                                            <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="feeStructure(<?php echo $enq[$i]->student_id; ?>,<?php echo $enq[$i]->course_dur; ?>)">Fees Structure</a></li>
                                            <li class="dropdown-item"><a class="btn" target="_blank" href="<?php echo "print_hostel_certificate/" . $enq[$i]->student_id; ?>">Hostel Certificate</a></li>
                                            <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="loanLetter('<?php echo $enq[$i]->student_id; ?>')">View Loan Letter</a></li>
                                            <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="demandLetter()">Demand Letter</a></li>
                                        </ul>
                                       </div>
                                        
                                            
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
</div>
<!--------------------------------------------------------popup----------------------------------------- -->
<div class="modal Modal_ student_modal" id="opnpopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#753a88">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt text-white">Add Student</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close text-white"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="staffform" method="POST" class="_formSubmit" action="<?php echo base_url('institute/add_student'); ?>">
                    <div class="row">
                        <div class="col-12 text-center">
                        
                            <div style="width: 100%; height: auto;">
                                <div class="imgcontent text-center" style="width: 180px;height: auto; text-align: center;">
                                    <img class="blah" id="blah" src="<?php echo base_url(); ?>assets/dashboard/img/person2.jpg" style="width: 100%;">
                                </div>

                                <input type="file" name="image" accept="Images/*" id="expertProfile" hidden="">
                                <label for="expertProfile" class="_fntwss_ _fwg500_ _wtClr_ _bgmhrnG_ btn btn-responsive mt15 ">Upload Photo</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Full Name<span class="text-danger">*</span></label>
                            <input id="name" type="text" name="name" class="form-control makeReqin" required autocomplete="new">
                            <input type="hidden" name="save_type" id="save_type">
                        </div>
                   
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">S/D/W of<span class="text-danger">*</span></label>
                            <input id="father_name" type="text" name="father_name" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mother Name*</label>
                            <input id="mother_name" type="text" name="mother_name" class="form-control makeReqin" autocomplete="new">
                        </div>
                   
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Father's Occupation*</label>
                            <input id="occupation" type="text" name="occupation" class="form-control makeReqin" autocomplete="new">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email*</label>
                            <input id="email" type="email" name="email" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Qualification*</label>
                            <input id="qualification" type="text" name="qualification" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>
                            <input id="number" type="text" name="number" class="form-control makeReqin" required autocomplete="new">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Institute Name</label>
                            <select id="sub_institute" name="sub_institute" class="form-control makeReqin" autocomplete="new">
                                <option value="">Select Institute</option>
                                   <?php
                                        $institutes = $this->institute_model->getAllSubInstitutes();
                                        for ($i = 0; $i < count($institutes); $i++) {

                                        ?>
                                            <option value="<?php echo $institutes[$i]->sub_inst_id; ?>"><?php echo $institutes[$i]->sub_institute_name; ?></option>
                                        <?php
                                        }
                                    ?>
                            </select>

                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Address</label>
                            <textarea id="address" name="address" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required autocomplete="new" style="height: 109px;"></textarea>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date of Birth(D.O.B.)*</label>
                            <input id="dob" type="date" name="dob" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Gender</label>
                            <select id="gender" name="gender" class="gender form-control makeReqin">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Associates Name</label>
                            <select id="agent_name" name="agent_name" class="form-control makeReqin" autocomplete="new">
                                <option value="">Select Associate</option>
                               <?php
                                    $enq = $this->institute_model->getAllActiveAgents();
                                    for ($i = 0; $i < count($enq); $i++) {

                                    ?>
                                        <option value="<?php echo $enq[$i]->agent_id; ?>"><?php echo $enq[$i]->agent_name; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">City*</label>
                            <input id="city" type="text" name="city" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Admission Year</label>
                            <input id="admissionyer" type="text" name="admissionyer" class="form-control makeReqin date" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Reffered By</label>
                            <select id="refferedBy" name="refferedBy" class="form-control makeReqin" autocomplete="new">
                                <option value="Associate">Associate</option>
                                <option value="Online">Online</option>
                                <option value="Google ads">Google ads</option>
                                <option value="Facebook ads ">Facebook ads </option>
                                <option value="Student ">Student </option>
                                <option value="Parent ">Parent </option>
                                <option value="Management ">Management </option>
                                <option value="Staff ">Staff </option>
                                <option value="Campus Walkin ">Campus Walkin </option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course</label>
                            <select id="course" name="course" class="form-control makeReqin" autocomplete="new" required >
                                <option vlaue="">Select Course</option>
                               <?php
                                    $courses = $this->institute_model->get_all_courses();
                                    if(!empty($courses))
                                    {
                                       foreach($courses as $key=>$c)
                                       {
                                        ?>
                                        <option course_id="<?= $c->course_id; ?>" value="<?=$c->course_name; ?>"><?=$c->course_name; ?></option>
                                        <?php
                                       } 
                                    }
                                    
                                ?>
                            </select>
                            <input type="hidden" id="course_id" name="course_id" />
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Stream Applied For</label>
                            <select id="atreamapply" name="stream" class="form-control makeReqin streamApply" autocomplete="new" required >
                               <option value="">Select Stream</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row package_box">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Total Package(Rs.)</label>
                            <input id="package" type="number" name="package" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course Duration in Year(s)</label>
                            <input id="course_dur" type="number" name="course_dur" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group fees_box_con">
                            
                        </div>
                        <!-- <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Fees Per Year (Rs.) : <span id="yearly_amount"></span></label>
                            <input type="hidden" id="yearly_fee" name="yearly_fee" class="form-control makeReqin" autocomplete="new">
                        </div> -->
                        <!-- <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course Duration in Year(s)</label>
                            <input id="course_dur" type="number" name="course_dur" class="form-control makeReqin date" autocomplete="new">
                        </div> -->
                    </div>
                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="student_id" id="student_id">
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
<!-- fee structure modal  -->
<div class="modal Modal_" id="fee_structure">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Fees</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="fee_structure_form">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>Hostel Fee</label>
                            <div class="hostel_fee_div">
                                
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label>University & Board Fee</label>
                            <div class="univ_fee_div">
                                
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>Clinical Fee</label>
                            <div class="clinical_fee_div">
                                
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label>Sports & Cultural Fee</label>
                            <div class="sports_fee_div">
                                
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>Miscellaneous Fee</label>
                            <div class="misc_fee_div">
                                
                            </div>
                        </div>
                       
                    </div>
                    <hr />
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

<!-- fee structure with bonafide -->
<div class="modal Modal_" id="fee_structure_bonafide">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Fees</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="bonafide_fees_form">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>Hostel Fee</label>
                            <div class="hostel_fee_div">
                                
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label>University & Board Fee</label>
                            <div class="univ_fee_div">
                                
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>Clinical Fee</label>
                            <div class="clinical_fee_div">
                                
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label>Sports & Cultural Fee</label>
                            <div class="sports_fee_div">
                                
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>Miscellaneous Fee</label>
                            <div class="misc_fee_div">
                                
                            </div>
                        </div>
                       
                    </div>
                    <hr />
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

<div class="modal Modal_ student_modal" id="packagepopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Approve Student</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="packageform" method="POST" class="_formSubmit" action="<?php echo base_url('institute/approve_student'); ?>">
                    
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
                            <input type="hidden" name="yoa" id="yoa">
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

<script>
$(document).ready(function(){
    var yr = $(".selected_yr").val();
    var course = $(".selected_course").val();
    var stream = $(".selected_stream").val();
    var agent = $(".selected_agent").val();
    fill_datatable(yr,course,stream,agent);

    $(".student-con #student-details").submit(function(e){
        e.preventDefault();
        $('#studentTable').DataTable().destroy();
        var yr = $(".selected_yr").val();
        var course = $(".selected_course").val();
        var stream = $(".selected_stream").val();
        var agent = $(".selected_agent").val();
        fill_datatable(yr,course,stream,agent);
    });

    function fill_datatable(yr = "",course= "",stream ="",agent =""){
       var dataTable = $('#studentTable').DataTable({
            "responsive" : true,
            "processing" : true,
            "serverSide" : false,
            "order" : [],
            "searching" : true,
            "ajax" : {
                url : '<?=base_url(); ?>institute/filterStudents',
                type : 'POST',
                data : {
                    yr : yr,
                    course : course,
                    stream : stream,
                    agent : agent
                }
            }
       }); 
    }

});
</script>

<script>
    $(".csv-btn").on('click',function(){
        var yr = $(".selected_yr").val();
        var course = $(".selected_course").val();
        var stream = $(".selected_stream").val();
        var agent = $(".selected_agent").val();
        window.location = "<?=base_url(); ?>institute/student_list_download?year="+yr+"&course="+course+"&stream="+stream+"&agent="+agent;
    });
</script>

<script>
    $("#course").on('change',function(){
      var course_id = $("#course option:selected").attr('course_id');
      if(course_id != "")
      {
        $.ajax({
          type : 'POST',
          url : '<?=base_url(); ?>institute/getStreamsByCourse',
          data : {
            course_id : course_id,
          },
          success : function(res){
            $(".streamApply").html(res);
          }
        });
      }
    });
</script>

<script>
  $(".selected_stream").on('change',function(){
    var stream = $(this).val();
    $(".stream").html(stream);
  });
</script>

<script>
  $(".selected_agent").on('change',function(){
    var agent = $( ".selected_agent option:selected" ).text();
    $(".agent").html(agent);
  });
</script>

<script>
  $(".selected_course").on('change',function(){
    $(".selected_stream").html("");
    var course_id = $(this).val();
    var course_name = $( ".selected_course option:selected" ).text();
    $(".course").html(course_name);
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/getStreamsByCourse',
      data : {course_id : course_id},
      success : function(res){
        $(".selected_stream").append(res);
      }
    });
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