<style type="text/css">

    /*.agentActive, .agentActive:hover{

   background: rgba(91, 193, 70, 0.1);

   border-color: #5BC146;

   color: #8A162B;

   }*/

    .agentActive ._sdf_ {

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

</style>

<div id="content" class="flex ">

    <div class="page-container" id="page-container">

        <div class="title-header">

          <div class="">

            <span>

              <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-user"></i> ASSOCIATES REQUESTS</h3>

            </span>

          </div>

        </div>

        <div class="padding">

            <div class="table-responsive">
                <div class="page-title p-b-40 m-b-20 pt20">

                    <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

                </div>
                <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">

                    <a href="https://datatables.net/extensions/responsive/" target="_blank"></a>

                    <thead>

                        

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Sl.</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Associate Name</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Student Name</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Mobile</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Course Interested</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>

                    </thead>

                    <tbody id="tableBody">

                        <?php

                        $sl = 1;

                        foreach($requests as $request)

                        {

                        ?>

                            <tr>

                                <td>

                                    <?php echo $sl++; ?>

                                </td>

                                <td>

                                    <?php 

                                        $agent_id = $request->agent_name;

                                        $agent_name = $this->institute_model->getAgentName($agent_id);

                                        echo $agent_name[0]->agent_name;

                                    ?>

                                </td>

                                <td class="text-capitalize">

                                    <?php echo $request->full_name; ?>

                                </td>

                                <td>

                                    <?php echo $request->mobile; ?>

                                </td>

                                <td class="text-capitalize">

                                    <?php echo $request->stream; ?>

                                </td>

                                <td>

                                    <div class="btn-group">
                                        <div class="btn-group">
                                            <button class="btn btn-success approve-btn"  stu_id="<?=$request->student_id; ?>" stu_name="<?=$request->student_id; ?>" yoa="<?=$request->yoa; ?>" >Approve</button>
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



<!--------------------------------------Payment popup---------------------------------------->





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

                                Delete Associates.

                            </h3>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 m-t-20">

                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Associates from the dashboard?</p>

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

                                Delete this Associates.

                            </h3>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 m-t-20">

                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Associates from the dashboard?</p>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 text-right">

                            <form id="singleDeleteIdq" method="POST" action="delete_agent">

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