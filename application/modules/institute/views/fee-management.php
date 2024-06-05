

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

.smsActive ._sdf_{

   color: #8A162B !important;

   }

   .smsselectbox

   {

   background: #FFFFFF;

   border: 1px solid #ECECEC;

   box-sizing: border-box;

   border-radius: 2px;

   width: 100%;

   height: 30px;

   color: #888888;

   }

   .title-header{

      background:#8E294F;

      height:70px;

      padding:20px;

    }

    .i-con-eye{
        cursor: pointer;
    }

</style>

<div id="content" class="flex ">

    <div class="title-header">

        <div class="">

        <span>

            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-money"></i> FEE MANAGEMENT</h3>

        </span>

        </div>

    </div>

    <div class="page-container" id="page-container">

        <div class="padding">

            <a href="javascript: history.go(-1)" class="btn mb-3 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

            <div class="table-responsive shadow-lg" style="background:white;padding:20px">
                <form id="student-details">
                    <div class="row">
                        <div class="col-md-1">
                            <i class="fa fa-filter"></i> <span>Filter</span>
                        </div>
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
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-primary">Search</button>
                        </div>
              
                    </div>
                </form>
                
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

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Year of Admission</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Total Fee / Package</span></th>



                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#View Payment Details</span></th>



                    </thead>

                    <tbody id="tableBody " class="stu_fees_table">

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

                                    <!-- <label class="checkboxcontainer">

                           <input type="checkbox" checked="checked" class="pivileges">

                           <span class="checkmark"></span>

                           </label>  -->

                                    <label class="checkboxcontainer">

                                        <input type="checkbox" value="<?php echo $enq[$i]->student_id; ?>" class="pivileges singleInput">

                                        <span class="checkmark"></span>

                                    </label>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_ text-capitalize stu_name"><?php echo $enq[$i]->full_name; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_ mobile"><?php echo $enq[$i]->mobile; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_ stream"><?php echo $enq[$i]->stream; ?></div>

                                </td>

                                <td>

                                    <div class="item-except _greyClr_ _fs14_ course"><?php echo $enq[$i]->course; ?></div>

                                </td>



                                <td>

                                    <div class="item-except _greyClr_ _fs14_ yoa"><?php echo $enq[$i]->yoa; ?></div>

                                </td>

                                

                                <td>

                                    <div class="item-except _greyClr_ _fs14_ package"><?php echo $enq[$i]->package; ?></div>

                                </td>

                                <td class="actionbtns text-center">

                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ view_span">

                                        <button onclick="viewStudentPayment('<?php echo $enq[$i]->student_id; ?>')" class="btn _fs14_ i-con-h-a view-bttn makeresponsive" style="background:#8E294F"><i class="i-con i-con-eye"></i></button>

                                    </span>

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

<!--------------------------------------------------------popup----------------------------------------- -->

<div class="modal Modal_ student_modal" id="opnpopup">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Student</h5>

                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>

            </div>

            <!-- Modal Header -->

            <div class="modal-body">

                <form id="fee_collect_form" method="POST" class="_formSubmit" action="<?php echo base_url('institute/'); ?>">

                    <div class="row">

                        <div class="col-12 text-center">

                            <div style="width: 100%; height: auto;">

                                <div class="imgcontent text-center" style="width: 180px;height: auto; text-align: center;">

                                    <img class="blah" id="blah" src="<?php echo base_url(); ?>assets/dashboard/img/person2.jpg" style="width: 100%;">

                                </div>

                                <input type="file" name="image" accept="Images/*" id="expertProfile" hidden="">

                                <label for="expertProfile" class="_fntwss_ _fwg500_ _wtClr_ _bgmhrnG_ btn btn-responsive mt15 upload-btn">Upload Photo</label>

                            </div>

                        </div>

                    </div>

                    

                    <div class="row">

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Full Name*</label>

                            <input id="name" type="text" name="name" class="form-control makeReqin" required autocomplete="new">

                        </div>

                   

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">S/D/W of*</label>

                            <input id="lastname" type="text" name="lastname" class="form-control makeReqin" required autocomplete="new">

                        </div>

                    </div><!-- row -->

                    <div class="row">

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email*</label>

                            <input id="email" type="email" name="email" class="form-control makeReqin" required autocomplete="new">

                        </div>

                        <div class="col-12 col-md-6 form-group">

                            <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Qualification*</label>

                            <input id="qualification" type="text" name="qualification" class="form-control makeReqin" required autocomplete="new">

                        </div>

                    </div><!-- row -->

                    <div class="row">

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>

                            <input id="number" type="text" name="number" class="form-control makeReqin" required autocomplete="new">

                        </div>

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Address</label>

                            <textarea id="address" name="address" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required autocomplete="new" style="height: 109px;"></textarea>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Associates Name</label>

                            <!-- <input id="reffered" type="text" name="reffered" class="form-control makeReqin" autocomplete="new"> -->

                            <select id="agent_name" name="agent_name" class="form-control makeReqin" autocomplete="new">

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

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Stream Applied For</label>

                            <select id="atreamapply" name="stream" class="form-control makeReqin" autocomplete="new">

                               <?php

                                    $enq = $this->institute_model->getAllActiveStreams();

                                    for ($i = 0; $i < count($enq); $i++) {

                                    ?>

                                        <option value="<?php echo $enq[$i]->stream_name; ?>"><?php echo $enq[$i]->stream_name; ?></option>

                                    <?php

                                    }

                                    ?>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Admission Year</label>

                            <input id="admissionyer" type="text" name="admissionyer" class="form-control makeReqin date" autocomplete="new">

                        </div>

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Reffered By</label>

                            <select id="refferedBy" name="refferedBy" class="form-control makeReqin" autocomplete="new">

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

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Total Package(INR)</label>

                            <input id="package" type="number" name="package" class="form-control makeReqin date" autocomplete="new">

                        </div>

                        <div class="col-12 col-md-6 form-group">

                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course Duration in Year(s)</label>

                            <input id="course_dur" type="number" name="course_dur" class="form-control makeReqin date" autocomplete="new">

                        </div>

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
  $("#student-details").submit(function(e){
    e.preventDefault();
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/filterStudentList',
      data : $(this).serialize(),
      success : function(res){
        $(".stu_fees_table").html(res);
      }
    });
  });
</script>

