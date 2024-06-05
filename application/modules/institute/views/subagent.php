<style type="text/css">
    /*.subagentActive, .subagentActive:hover{
   color: #8A162B;
   }*/
    .subagentActive ._sdf_ {}

    .appendicon {
        display: inline-block;
        background: green;
        color: white;
        border-radius: 100%;
        width: 20px;
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
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-user"></i> SUB ASSOCIATES</h3>
        </span>
      </div>
    </div>
    <div class="page-container" id="page-container">
        <div class="padding">
            <div class="table-responsive">
                    <div class="page-title p-b-40 m-b-20 pt20">
                        <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="openAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Sub Associates</button><button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button></span>
                    </div>
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
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Sub Associates Name</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Mobile</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Location</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Associates Name</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>
                        </thead>
                        <tbody id="tableBody">

                            <?php
                            $enq = $this->institute_model->getAllActiveSubAgents();
                            // echo '<pre>123'; print_r($enq); echo '</pre>';
                                // echo '<pre>'; print_r(count($enq)); echo '</pre>';
                            for ($i = 0; $i < count($enq); $i++) {
                                $agent_id =  $enq[$i]->agent_id;

                                $agent_details = $this->institute_model->get_agent_by_id($agent_id);
                                // echo '<pre>'; print_r($agent_details); echo '</pre>';
                                $agent_name = $agent_details[0]->agent_name;

                            ?>
                                <tr>
                                    <td>
                                        <!-- <label class="checkboxcontainer">
                           <input type="checkbox" checked="checked" class="pivileges">
                           <span class="checkmark"></span>
                           </label> -->
                                        <label class="checkboxcontainer">
                                            <input type="checkbox" value="<?php echo $enq[$i]->sub_agent_id; ?>" class="pivileges singleInput">
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->sub_agent_name; ?></div>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->sub_agent_mobile; ?></div>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->sub_agent_location; ?></div>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_"><?php echo $agent_name ; ?></div>
                                    </td>

                                    <td class="actionbtns">
                                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_"><button onclick="editSubAgent('<?php echo $enq[$i]->sub_agent_id; ?>')" class="btn _fs14_  _bgyllw_ i-con-h-a edit-bttn"><i class="i-con i-con-edit"></i>Edit</button></span>
                                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button onclick="deleteFunc('<?php echo $enq[$i]->sub_agent_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></button></span>
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
    <div class="modal Modal_" id="opnpopup">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Sub Associates</h5>
                    <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
                </div>
                <!-- Modal Header -->
                <div class="modal-body">
                    <form id="subagentform" method="POST" class="instituteform _formSubmit" action="<?php echo base_url('institute/add_sub_agent'); ?>">
                        <div class="row">
                            <div class="col-12 col-md-4 form-group">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Sub Associates Name:</label>
                                <input id="subagentname" type="text" name="subagentname" class="form-control makeReqin" autocomplete="new">
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>
                                <input id="number" type="text" name="number" class="form-control makeReqin" required autocomplete="new">
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Location*</label>
                                <input id="location" type="location" name="location" class="form-control makeReqin" required autocomplete="new">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Permanent Address*</label>
                                <textarea id="permanentAdd" name="address" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required style="height: 60px;" autocomplete="new"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Associates Name*</label>
                                <select id="agentname" type="text" name="agentname" class="form-control makeReqin" required autocomplete="new">
                                    <?php
                                    $enq = $this->institute_model->getAllActiveAgents();
                                    // echo '<pre>'; print_r($enq); echo '</pre>';
                                    for ($i = 0; $i < count($enq); $i++) {


                                    ?>
                                        <option value="<?php echo $enq[$i]->agent_id; ?>"><?php echo $enq[$i]->agent_name; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Created Date</label>
                                <input id="creatdate" type="text" name="creatdate" class="form-control makeReqin date examDate" autocomplete="new">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Upload PAN number*</label>
                                <input id="kyc" type="text" name="kyc" class="form-control makeReqin" required autocomplete="new">
                            </div>
                        </div>
                        <div class="row m-t-32">
                            <div class="col-12 form-group">
                                <input type="hidden" name="sub_agent_id" id="sub_agent_id">
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
                                    Delete Sub Associates.
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-t-20">
                                <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Sub Associates from the dashboard?</p>
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
                                    Delete this Sub Associates.
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-t-20">
                                <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Sub Associates from the dashboard?</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <form id="singleDeleteIdq" method="POST" action="delete_subagent">
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