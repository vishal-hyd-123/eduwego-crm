
<style type="text/css">
   /*.agentActive, .agentActive:hover{
   background: rgba(91, 193, 70, 0.1);
   border-color: #5BC146;
   color: #8A162B;
   }*/
   .addinstituteActive ._sdf_{
    color: #8A0A28 !important;
   }
#page-container{
    padding: 20px;
}
.summary-box{
  width: 100%;
  height: 120px;
  background: white;
  border-radius: 5px;
  padding: 10px;
  margin-bottom:10px;
}
.title-header{
  background:#8E294F;
  height:70px;
  padding:20px;

}
</style>
<div id="content" class="flex ">
  <div class="title-header">
        <div class="">
        <span>
            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-tachometer"></i> DASHBOARD</h3>
        </span>
        </div>
  </div>
   <div class="page-container" id="page-container">
      <div class="row my-4">
        <div class="col-md-4">
          <div class="summary-box shadow-sm">
            <center><h5>Total No. of Students</h5></center>
            <hr/>
            <center><h3><?php echo count($students); ?></h3></center>
          </div>
        </div>

        <div class="col-md-4">
          <div class="summary-box shadow-sm">
            
            <center><h5>Total Pending Students</h5></center>
            <hr/>
            <center>
                <h3><?php echo count($requests); ?></h3>
                <a href="<?php echo base_url(); ?>associate/pending_students">See Details</a>
            </center>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="summary-box shadow-sm">
            <center><h5>Total Amount Received</h5></center>
            <hr/>
            <center>
                <h3>
                <?php
                    $total_received = 0;
                    foreach($payments as $payment)
                    {
                        $total_received += $payment->amount;

                    }
                    echo $total_received;
                    ?>
                </h3>
                <a href="<?php echo base_url(); ?>associate/payments_view">See Details</a>
            </center>
          </div>
        </div>

      </div>

      <div class="page-title p-b-40 m-b-20 pt20">
        <h4 class="mb-0 _blckClr_ pull-left">Students List</h4>
        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="studentAddByAgent(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Student</button></span>
    </div>

      <div class="row p-4">
        <div class="col-12 my-4">
          <div class="table-responsive shadow-sm">
                <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
                    <a href="https://datatables.net/extensions/responsive/" target="_blank"></a>
                    <thead>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">ID</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Student Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Mobile</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Stream</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Course</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">YOA</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Fee Committed</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>

                    </thead>
                    <tbody id="tableBody">
                            <?php
                            
                            $i= 1; 
                            foreach($students as $student)
                            {
                            ?>
                             <tr>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i++; ?></div>
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
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->package; ?></div>
                                </td>
                                <td class="actionbtns">
                                    <div class="btn-group" role="group">
                                        <a type="button" href="<?php echo base_url(); ?>associate/agentFeesDetails/<?php echo $student->student_id; ?>" class="btn _fs14_ bg-primary i-con-h-a text-white">Fees Details</a>

                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-print"></i>
                                        </button>

                                       <ul class="dropdownList dropdown-menu" style="height:auto">
                                            <li class="dropdown-item"><a class="btn" target="_blank" href="<?php echo "print_provisional_letter/" . $enq[$i]->student_id; ?>">Provisional Admission Letter</a></li>
                                            <li class="dropdown-item"><a class="btn" target="_blank" href="<?php echo "print_admission_letter/" . $enq[$i]->student_id; ?>">View Admission Letter</a></li>
                                            <li class="dropdown-item"><a class="btn" target="_blank" href="<?php echo "print_bonafied_letter/" . $enq[$i]->student_id; ?>">View Bonafide Certificate</a></li>
                                            <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="feeStructureBonafide(<?php echo $enq[$i]->student_id; ?>,<?php echo $enq[$i]->course_dur; ?>)">Bonafide Certificate With Fees Structure</a></li>
                                            <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="feeStructure(<?php echo $enq[$i]->student_id; ?>,<?php echo $enq[$i]->course_dur; ?>)">Fees Structure</a></li>
                                            <li class="dropdown-item"><a class="btn" target="_blank" href="<?php echo "print_hostel_certificate/" . $enq[$i]->student_id; ?>">Hostel Certificate</a></li>
                                            <li class="dropdown-item"><a class="btn" href="javascript:void(0)" onclick="loanLetter('<?php echo $enq[$i]->student_id; ?>')">View Loan Letter</a></li>
                                        </ul>
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

<div class="modal Modal_" id="opnpopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Student</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="studentAddForm" target="_blank" method="POST" class="instituteform" action="<?php echo base_url('associate/add_student'); ?>">
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
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Full Name*</label>
                            <input id="name" type="text" name="name" class="form-control makeReqin" required autocomplete="new">
                            <input type="hidden" name="save_type" id="save_type">
                        </div>
                   
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">S/D/W of*</label>
                            <input id="father_name" type="text" name="father_name" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mother Name</label>
                            <input id="mother_name" type="text" name="mother_name" class="form-control makeReqin" autocomplete="new">
                        </div>
                   
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Father's Occupation</label>
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
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Address*</label>
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
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">City*</label>
                            <input id="city" type="text" name="city" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Admission Year*</label>
                            <input id="admissionyer" type="text" name="admissionyer" class="form-control makeReqin date" required autocomplete="new">
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course*</label>
                            <select id="course" name="course" class="form-control makeReqin" autocomplete="new" required >
                                <option vlaue="">Select Course</option>
                               <?php
                                    $courses = $this->Associate_model->get_all_courses();
                                    for ($i = 0; $i < count($courses); $i++) {

                                    ?>
                                        <option course_id="<?php echo $courses[$i]->course_id; ?>" value="<?php echo $courses[$i]->course_name; ?>"><?php echo $courses[$i]->course_name; ?></option>

                                    <?php
                                    }
                                ?>
                            </select>
                            <input type="hidden" id="course_id" name="course_id" />
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Stream Applied For*</label>
                            <select id="atreamapply" name="stream" class="form-control makeReqin streamApply" autocomplete="new" required >
                               <?php
                                    $enq = $this->Associate_model->getAllActiveStreams();
                                    for ($i = 0; $i < count($enq); $i++) {

                                    ?>
                                        <option value="<?php echo $enq[$i]->stream_name; ?>"><?php echo $enq[$i]->stream_name; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="agent_name" id="agent_id" value="<?php echo $_SESSION['agent_id']; ?>" />
                            <input type="hidden" name="student_id" id="student_id" />
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
     $("#course").on('change',function(){
      var course_id = $("#course option:selected").attr('course_id');
      if(course_id != "")
      {
        $.ajax({
          type : 'POST',
          url : '<?=base_url(); ?>associate/getStreamsByCourse',
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