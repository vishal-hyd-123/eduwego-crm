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
</style>
<div id="content" class="flex ">
    <div class="page-container" id="page-container">
        <div class="padding">
            <div class="page-title p-b-40 m-b-20 pt20">
                <h2 class="mb-0 nwFntSt _blckClr_ _fwg500_ _fs16_ pull-left">Notices</h2>
                <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="openAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Notices</button><button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button></span>
            </div>
            <div class="table-responsive">
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
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Notice Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Description</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Start Date</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#End Date</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>
                    </thead>
                    <!-- <tbody id="tableBody">

                        <?php
                        $enq = $this->admin_model->get_all_announcment();
                        for ($i = 0; $i < count($enq); $i++) {


                        ?>
                            <tr>
                                <td>
                                    <label class="checkboxcontainer">
                                        <input type="checkbox" value="<?php echo $enq[$i]->agent_id; ?>" class="pivileges singleInput">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->announcment_title; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->announcment_discription; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->announcment_start_date; ?></div>
                                </td>
                                <td>
                                    
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->announcment_end_date; ?></div>
                                </td>
                                <td class="actionbtns">
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ makeresponsive"><button onclick="editAannouncment('<?php echo $enq[$i]->announcment_id; ?>')" class="btn _fs14_  _bgyllw_ i-con-h-a edit-bttn"><i class="i-con i-con-edit"></i>Edit</button></span>
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button onclick="deleteFunc('<?php echo $enq[$i]->announcment_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></button></span>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                    </tbody> -->
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal Modal_" id="opnpopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Announcement</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="agentform" method="POST" class="instituteform _formSubmit" action="add_aannouncment" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-4 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Announcement Name:</label>
                            <input id="announcement" type="text" name="announcement" class="form-control makeReqin" autocomplete="new" required>
                        </div>

                        <div class="col-12 col-md-4 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Start Date*</label>
                            <input id="start_date" type="text" name="start_date" class="form-control makeReqin examDate" required autocomplete="new" readonly date-value="<?php echo date('d/m/Y'); ?>">
                        </div>

                        <div class="col-12 col-md-4 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">End Date*</label>
                            <input id="end_date" type="location" name="end_date" class="form-control makeReqin examDate" required autocomplete="new" readonly date-value="<?php echo date('d/m/Y'); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 form-group text-left">
                            <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Description*</label>
                            <textarea id="description" name="description" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required style="height: 60px;" autocomplete="new"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="hidden" name="agent_id" id="agent_id">
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
                                Delete Announcement.
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this announcement from the dashboard?</p>
                        </div>
                    </div>
                    <form id="multiPleDeleteqw" method="POST" action="<?php echo base_url(); ?>admin/delete_announcment">
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
                                Delete this Announcement.
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this announcement from the dashboard?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <form id="singleDeleteIdq" method="POST" action="delete_announcment">
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


</script>