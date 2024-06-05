<style type="text/css">
   /*.agentActive, .agentActive:hover{
   background: rgba(91, 193, 70, 0.1);
   border-color: #5BC146;
   color: #8A162B;
   }*/
   .addinstituteActive ._sdf_{
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

 .box
 {
   position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    height: 100%;
    padding: 20px;
 }
 .formhead
 {
   padding: 20px;
 }
</style>
<div id="content" class="flex ">
   <div class="page-container" id="page-container">
      <div class="padding">
         <div class="row justify-content-between">
               <div class="box">
                  <div class="formhead">
                     <h4 class="text-muted _blckClr_ _fwg500_ nwFntSt" >Generate Offer Letter</h4>
                  </div>
                  <form id="offer_form" method="post" action="<?php echo base_url(); ?>institute/print_offer_letter" target="_blank">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Candidate Name<span class="validation-color">*</span></label>
                             <input type="text" name="name" class="form-control" value="<?=$lead_details[0]->student_name; ?>" readonly required="required">
                           </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Course<span class="validation-color">*</span></label>
                             <select name="course_id" class="form-control courses">
                                <option value="">Select Course</option>
                                <?php  
                                if(!empty($courses))
                                {
                                 foreach($courses as $course)
                                 {
                                    ?>
                                    <option value="<?=$course->course_id; ?>" <?php if($course->course_name == $lead_details[0]->course){echo "selected";} ?>><?=$course->course_name ?></option>
                                    <?php
                                 }
                                }
                                ?>
                             </select>
                             <input type="hidden" name="course_name" class="course_name" value="<?=$lead_details[0]->course; ?>" />
                           </div>
                        </div>
                        <?php 
                           $course = $lead_details[0]->course;
                           $institute_id = $_SESSION['institute_id'];
                           $course_details = $this->db->query("SELECT course_id,course_name FROM courses WHERE institute_id = '".$institute_id."' AND course_name = '".$course."' ")->result();
                           $course_id = $course_details[0]->course_id;
                           $streams = $this->db->query("SELECT stream_id,stream_name FROM streams WHERE institute_id = '".$institute_id."' AND course = '".$course_id."' AND stream_status = 1 ")->result();
                        ?>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Stream<span class="validation-color">*</span></label>
                             <select name="stream" class="form-control streams">
                                 <?php  
                                 if(!empty($streams))
                                 {
                                    foreach($streams as $stream)
                                    {
                                       ?>
                                       <option value="<?=$stream->stream_name; ?>" <?php if($stream->stream_name == $lead_details[0]->stream){echo "selected";} ?>><?=$stream->stream_name; ?></option>
                                       <?php
                                    }
                                 }
                                 ?>
                             </select>
                             
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Admission Fee<span class="validation-color">*</span></label>
                             <input type="text" name="admsn_fee" class="form-control" required="required">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Amounts in words<span class="validation-color">*</span></label>
                             <input type="text" name="amount_in_words" class="form-control" required="required">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Fee Submission Last Date<span class="validation-color">*</span></label>
                             <input type="date" name="fee_last_date" class="form-control" required="required">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Scholarship Offered<span class="validation-color">*</span></label>
                             <input type="number" name="scholarship_amount" class="form-control" >
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Package Amount<span class="validation-color">*</span></label>
                             <input type="number" name="package" class="form-control" required="required">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">No. of instalments<span class="validation-color">*</span></label>
                             <input id="install_no" type="number" name="no_of_install" class="form-control" required="required">
                           </div>
                           <div class="installment_fields">
                           
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Documents Required<span class="validation-color">*</span></label>
                             <input id="docs" type="text" name="doc_name[]" class="form-control" placeholder="Document Name" required="required">
                           </div>
                           <div class="docs_fields">
                           
                           </div>
                           <button type="button" class="btn btn-success add-doc">Add</button>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Fee Inclusion</label><br/>
                             <input type="checkbox" name="tution_fees" /> <span>Tution Fees</span>
                             <input type="checkbox" name="board_fees" /> <span>Board Fees</span>
                             <input type="checkbox" name="food_fees" /> <span>Food & Hostel Fees</span>
                             <input type="checkbox" name="library_fees" /> <span>Library Fees</span>
                             <input type="checkbox" name="sports_fees" /> <span>Sports Fees</span>
                             <input type="checkbox" name="journal_fees" /> <span>Journal Fees</span>
                             <input type="checkbox" name="lab_fees" /> <span>Lab Fees</span>
                             <input type="checkbox" value="placement_fees" /> <span>Placement Fees</span>
                             <input type="checkbox" name="ojt_fees" /> <span>OJT Fees</span>
                             <input type="checkbox" name="dress_fees" /> <span>Dress Fees</span>
                             <input type="checkbox" name="portal_fees" /> <span>Portal Fees</span>
                           </div>
                        </div>
                       
                        <div class="col-sm-12 mt-3">
                           <div class="box-footer">
                              <button type="submit" id="submit" class="btn btn-primary float-right">Generate</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
         </div>
      </div>
   </div>
</div>

<script>
   $(".courses").on('change',function(){
      $(".streams").html("");
      var course_id = $(this).val();
      var course_name = $(".courses option:selected").html();
      $(".course_name").val(course_name);
     $.ajax({
       type : 'POST',
       url : '<?=base_url(); ?>institute/getStreamsByCourse',
       data : {
         course_id : course_id,
       },
       success : function(res){
         $(".streams").append(res);
       }
     });

   });
</script>