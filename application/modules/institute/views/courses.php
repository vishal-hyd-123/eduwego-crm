<style type="text/css">
    /*.cursesActive, .cursesActive:hover{
   color: #8A162B;
   }*/
    .cursesActive ._sdf_ {
        color: #8A162B !important;
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
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-book"></i> COURSES</h3>
        </span>
      </div>
    </div>
    <div class="page-container" id="page-container">
        
        <div class="padding">
            
            <div class="table-responsive">
                <div class="page-title p-b-40 m-b-20 pt20">
                    <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="openAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Course</button><button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button></span>
                </div>
                <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
                    <thead>
                        <th>
                            <label class="checkboxcontainer">
                                <input type="checkbox" name="" class="pivileges" id="selectAll">
                                <span class="checkmark"></span>
                            </label>
                        </th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#ID</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Course Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Description</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        $enq = $this->institute_model->getAllActiveCourses();
                        // echo '<pre>'; print_r($enq); echo '</pre>';
                        for ($i = 0; $i < count($enq); $i++) {


                        ?>
                            <tr>
                                <td>
                                    <!-- <label class="checkboxcontainer">
                           <input type="checkbox" checked="checked" name="<?php echo $enq[$i]->course_id; ?>" class="pivileges">
                           <span class="checkmark"></span>
                           </label>  -->
                                    <label class="checkboxcontainer">
                                        <input type="checkbox" value="<?php echo $enq[$i]->course_id; ?>" class="pivileges singleInput">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->course_name; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->course_discription; ?></div>
                                </td>

                                <td class="actionbtns">
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_"><button onclick="editCource('<?php echo $enq[$i]->course_id; ?>')" class="btn _fs14_  _bgyllw_ i-con-h-a edit-bttn staff_unable"><i class="i-con i-con-edit"></i>Edit</button></span>
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button onclick="deleteFunc('<?php echo $enq[$i]->course_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn staff_unable"><i class="i-con i-con-trash"><i></i></i></button></span>
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
<div class="modal Modal_" id="opnpopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Course</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="courseform" method="POST" class="instituteform _formSubmit" action="<?php echo base_url('institute/add_course'); ?>">
                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_">Course Name*</label>
                            <input id="coursename" type="text" name="coursename" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-md-6">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Description (Optional)</label>
                            <textarea id="description" name="description" class="form-control makeReqin" autocomplete="new"></textarea>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-md-6">
                            <input type="hidden" name="course_id" id="course_id">
                            <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                            <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                            <button type="submit" class="svebtn" style="float:right">Save</button>
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
                                Delete Course.
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Course from the dashboard?</p>
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
                                Delete this Course.
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Course from the dashboard?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <form id="singleDeleteIdq" method="POST" action="delete_course">
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
<script type="text/javascript">


</script>