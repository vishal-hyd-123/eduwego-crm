<style type="text/css">
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
   /*.selectdropdwn:nth-child(n + 2) select
   {
   margin-left: 32px;
   }*/
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
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-envelope"></i>  SMS & EMAIL</h3>
        </span>
      </div>
    </div>
   <div class="page-container" id="page-container">
      <div class="padding">
         <div class="page-title p-b-40 m-b-20 pt20">
            <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="openAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">Send SMS</button>
              <!-- <button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button> -->
            </span>
         </div>
         <div class="selectdropdwn">
            <div class="row">
               <div class="col-12 col-sm-6 col-md-3">
                  <select  class=" _fs12_ _fwg500_ nwFntSt smsselectbox" id="byYear">
                     <option value="">By Year</option>
                     <?php
                        $years = $this->institute_model->get_all_years();
                        for ($i=0; $i <count($years) ; $i++) { 
                         ?>
                     <option value="<?php echo $years[$i]->yoa; ?>"><?php echo $years[$i]->yoa; ?></option>
                     <?php
                        }
                        ?>
                  </select>
               </div>
               <div class="col-12 col-sm-6 col-md-3">
                  <select  class=" _fs12_ _fwg500_ nwFntSt smsselectbox" id="byStream">
                     <option value="">By Stream</option>
                     <?php
                        $streams = $this->institute_model->get_all_streams();
                        for ($i=0; $i <count($streams) ; $i++) { 
                         ?>
                     <option value="<?php echo $streams[$i]->stream_name; ?>"><?php echo $streams[$i]->stream_name; ?></option>
                     <?php
                        }
                        ?>
                  </select>
               </div>
               <div class="col-12 col-sm-6 col-md-3">
                  <select  class=" _fs12_ _fwg500_ nwFntSt smsselectbox" id="byCourse">
                     <option value="">By Course</option>
                     <?php
                        $courses = $this->institute_model->get_all_courses();
                        for ($i=0; $i <count($courses) ; $i++) { 
                         ?>
                     <option value="<?php echo $courses[$i]->course_name; ?>"><?php echo $courses[$i]->course_name; ?></option>
                     <?php
                        }
                        ?>
                  </select>
               </div>
               <div class="col-12 col-sm-6 col-md-3">
                  <select  class=" _fs12_ _fwg500_ nwFntSt smsselectbox" id="toStaff">
                     <option value="">To Staff</option>
                  </select>
               </div>
            </div>
         </div>

         <div class="row">
           <div class="col-12 text-right">
            <button class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn" style="color: #fff" id="sendEmailAll">Send Email</button>
            <button class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn" style="color: #fff" id="sendToAllH">Send SMS</button>
           </div>
         </div>

         <div class="table-responsive">
            <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
               <thead>
                  <th>
                     <label class="checkboxcontainer">
                     <input type="checkbox" email="" name="" class="pivileges" id="selectAll">
                     <span class="checkmark"></span>
                     </label>
                  </th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#ID</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Student Name</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Mobile No.</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Email Id.</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Location</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Course</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Stream</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Year of Admission</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Send SMS</span></th>
               </thead>
               <tbody id="tableBody">
                  <script type="text/javascript">
                    sendToAll.push('mobile');
                  </script>
                 
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="modal Modal_" id="opnpopup">
   <div class="modal-dialog Modal-width_580">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-body">
              <button type="button" class="close Popup_Delete_icn" data-dismiss="modal">
                <a class="i-con-h-a"><i class="mr-2 i-con i-con-close"></i></a>
              </button>
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 popup_bg_color padding-16">
                <!-- <form id="sendSmsForm" method="POST" action="sendIndivisualMess" enctype="multipart/form-data"> -->
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
                          <textarea class="form-control sendSMSTextArea" id="sendIndivisualMessTexts" name = "content"></textarea>
                          <p class="showMsgLength"><span class="showMsgLengthS">0</span>/160</p>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-12 text-right">
                          <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                        <button type="submit" class="btn btn-responsive YesDlt-btn" id="sendIndivisualMess">Send Message</button>
                      </div>
                  </div>
                <!-- </form> -->
              </div>
          </div>
      </div>
  </div>
</div>

<div class="modal Modal_" id="emailpopup">
   <div class="modal-dialog Modal-width_580">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-body">
              <button type="button" class="close Popup_Delete_icn" data-dismiss="modal">
                <a class="i-con-h-a"><i class="mr-2 i-con i-con-close"></i></a>
              </button>
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 popup_bg_color padding-16">
                <!-- <form id="" method="POST" action="sendIndivisualMess"> -->
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
                          <input type="text" id="emailSubject" class="form-control" placeholder="Subject" />
                          
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-12 m-t-20">
                          <textarea class="form-control sendSMSTextArea" placeholder="Write Message" id="emailMessage" name = "content"></textarea>
                          <p class="showMsgLength"><span class="showMsgLengthS">0</span>/160</p>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-12 text-right">
                          <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                        <button type="submit" class="btn btn-responsive YesDlt-btn" id="sendEmailMess">Send Message</button>
                      </div>
                  </div>
                <!-- </form> -->
              </div>
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
                        Delete Password.
                     </h3>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 m-t-20">
                     <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Password from the dashboard?</p>
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
                        Delete this district.
                     </h3>
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

<div class="modal Modal_" id="sendSmsPop">
        <div class="modal-dialog Modal-width_580">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-body">
                    <button type="button" class="close Popup_Delete_icn" data-dismiss="modal">
                      <a class="i-con-h-a"><i class="mr-2 i-con i-con-close"></i></a>
                    </button>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 popup_bg_color padding-16">
                      <!-- <form id="" method="POST" action="sendIndivisualMess"> -->
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
                                <textarea class="form-control sendSMSTextArea" id="sendSmsPopAllText"></textarea>
                                <p class="showMsgLength"><span class="showMsgLengthS">0</span>/160</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                                  <button type="submit" class="btn btn-responsive YesDlt-btn" id="sendSmsPopAll">Send SMS</button>
                            </div>
                        </div>
                      <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="modal Modal_" id="numberofStudentSent">
        <div class="modal-dialog Modal-width_580">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-body">
                    <button type="button" class="close Popup_Delete_icn" data-dismiss="modal">
                      <a class="i-con-h-a"><i class="mr-2 i-con i-con-close"></i></a>
                    </button>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 popup_bg_color padding-16">
                      <!-- <form id="" method="POST" action="sendIndivisualMess"> -->
                        <div class="row">
                            <div class="col-12 Botm_brdr">
                              <h3 class="_fs16_">
                                Email send to <span id="no_of_student">0</span> Student(s).
                              </h3>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 text-right">
                                <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">Ok</span>
                            </div>
                        </div>
                      <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
</div>
<!--<============
   Delete Popup End
   ============>-->
<script>
  // $("#sendSmsForm").submit(function(e){
  //   e.preventDefault();
  //   $.ajax({
  //     type : "POST",
  //     url : "",
  //   });
  // });
</script>