<style type="text/css">
    .staffActive ._sdf_ {
        color: #8A162B !important;
    }

    .title-header{
      background:#8E294F;
      height:70px;
      padding:20px;
    }
    .sub-check{
        margin-left: 20px;
        background: #ccc;
        padding: 4px;
    }
    .sub-check span{
        font-size: 11px;
    }
</style>
<div id="content" class="flex ">
    <div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-group"></i>  Add Employee</h3>
        </span>
      </div>
    </div>
    <div class="page-container" id="page-container">

        <div class="padding">
            
            <div class="table-responsive">
                <div class="page-title p-b-40 m-b-20 pt20">
                     <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="openAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Employee</button><button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button></span>

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
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">ID</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Photo</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Emp. Code</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Employee Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Mobile</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Department</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Date of Joining</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Designation</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Status</span></th>

                        <th class="action_Btn"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>

                    </thead>
                    <tbody id="tableBody">
                        <?php
                        $enq = $this->institute_model->getAllActiveStaff();
                        // echo '<pre>'; print_r($enq); echo '</pre>';
                        for ($i = 0; $i < count($enq); $i++) {


                        ?>
                            <tr>
                                <td>
                                    <label class="checkboxcontainer">
                                        <input type="checkbox" value="<?php echo $enq[$i]->employee_id; ?>" class="pivileges singleInput">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i + 1; ?></div>
                                </td>
                                <td>
                                    <?php  
                                    if(!empty($enq[$i]->emp_photo))
                                    {
                                        ?>
                                            <img src="<?=base_url(); ?>uploads/<?=$enq[$i]->emp_photo; ?>" width="80px" height="80px" />
                                        <?php
                                    }else{
                                        ?>
                                            <img src="<?=base_url(); ?>assets/dashboard/img/person2.jpg" width="80px" height="80px" />
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->emp_code; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->employee_name; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->employee_mobile; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->employee_designation; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?=date('d-M-Y',strtotime($enq[$i]->date_of_joining)); ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $enq[$i]->employee_designation; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs15_ grnclr"><?php if ($enq[$i]->employee_status == 2) {                                          echo "Active";
                                                }
                                                if ($enq[$i]->employee_status == 3){
                                                    echo "Inactive";
                                                } ?></div>
                                </td>
                                <td class="actionbtns">
                                    <!-- <span class="item-except mrm5 displayBlck _wtClr_ _fs14_"><button onclick="" class="btn _fs14_ _bgbrwn_ i-con-h-a print-bttn">Print<i class="i-con i-con-down"></i></button></span> -->
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ makeresponsive"><button onclick="editStaff('<?php echo $enq[$i]->employee_id; ?>')" class="btn _fs14_  _bgyllw_ i-con-h-a edit-bttn"><i class="i-con i-con-edit"></i>Edit</button></span>
                                    <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button onclick="deleteFunc('<?php echo $enq[$i]->employee_id; ?>');" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></button></span>
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
<!--<============
    Add Staff Popup 
      ============>-->
<div class="modal Modal_" id="opnpopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Employee</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="staffform" method="POST" class="instituteform _formSubmit" action="<?php echo base_url('institute/add_staff'); ?>">

                    <div class="row">
                        <div class="col-12 text-center">
                            <div style="width: 100%; height: auto;">
                                <div class="imgcontent text-center" style="width: 180px;height: auto; text-align: center;">
                                    <img class="blah" id="blah" src="<?php echo base_url(); ?>assets/dashboard/img/person2.jpg" style="width: 100%;">
                                </div>

                                <input type="file" name="image" accept="Images/*" id="expertProfile" hidden="">
                                <input type="hidden" name="photo_hidden" id="photo_hidden" />
                                <label for="expertProfile" class="_fntwss_ _fwg500_ _wtClr_ _bgmhrnG_ btn btn-responsive mt15 ">Upload Photo</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Employee Name*</label>
                            <input id="staffname" type="text" name="staffname" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Location*</label>
                            <input id="location" type="location" name="location" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                           <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>
                            <input id="number" type="text" name="number" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email*</label>
                            <input id="email" type="email" name="email" class="form-control makeReqin" autocomplete="new">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 form-group text-left">
                            <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Permanent Address*</label>
                            <textarea id="campaig_passworddfdf" name="address" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required autocomplete="new"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Role/Designation*</label>
                            <select class="form-control" name="role">
                                <option value="manager">Manager</option>
                                <option value="admission_councellor">Admission Councellor</option>
                                <option value="team_lead">Team Lead</option>
                                <option value="admission_councellor">Admission Councellor</option>
                                <option value="principal">Principal</option>
                                <option value="teacher">Teacher</option>
                                <option value="driver">Driver</option>
                                <option value="librarian">Librarian</option>
                                <option value="hr">HR</option>
                                <option value="accountant">Accountant</option>
                                <option value="faculty">Faculty</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date of Joining</label>
                            <input id="creatdate" type="date" name="creatdate" class="form-control makeReqin date examDate" autocomplete="new">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group text-left">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Status*</label>
                            <select id="status" name="status" class="form-control makeReqin" required autocomplete="new">
                                <option value="2">Active</option>
                                <option value="3">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 form-group text-left">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Department*</label>
                            <select id="department" name="department" class="form-control makeReqin" required autocomplete="new">
                                <option value="Teaching">Teaching</option>
                                <option value="Non-Teaching">Non-Teaching</option>
                                <option value="Placement">Placement</option>
                                <option value="Training">Training</option>
                                <option value="Accounts">Accounts</option>
                                <option value="Library">Library</option>
                                <option value="Hostel">Hostel</option>
                                <option value="Food">Food</option>
                                <option value="Admission">Admission</option>
                                <option value="IT">IT</option>
                                <option value="Others">Others</option>.
                                
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12"><h5>Employee Permissions</h5></div>
                        <div class="col-md-3">
                           <input type="checkbox" class="main-check" menu_name="Dashboard" name="dashboard"> <span>Dashboard</span>
                            
                        </div>
                        <div class="col-md-3">
                           <input type="checkbox" class="main-check" menu_name="Inbox" name="inbox"> <span>Inbox</span> 
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Student Search" name="student_search"> <span>Student Search</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Online Leads" name="leads"> <span>Online Leads</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Admission" name="admission"> <span>Admission</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Students" name="students"> <span>Students</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Associate" name="associate"> <span>Associate</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Associate Requests" name="assos_req"> <span>Associate Requests</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Our Institutes" name="institutes"> <span>Our Institutes</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Fee management" name="fee_mgmt"> <span>Fee management</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Courses" name="courses"> <span>Courses</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Stream" name="stream"> <span>Stream</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Vendors" name="vendor"> <span>Vendors</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Reports" name="reports"> <span>Reports</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="SMS/Email" name="sms"> <span>SMS/Email</span>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="main-check" menu_name="Social Media" name="social_media"> <span>Social Media</span>
                        </div>
                    </div>
                    
                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="employee_id" id="employee_id">
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
                                Delete Staff.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Staff from the dashboard?</p>
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
                                Delete this Staff.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Staff from the dashboard?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <form id="singleDeleteIdq" method="POST" action="delete_staff">
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
$(".main-check").on('click',function(){
    var name_value = $(this).attr('name');
    var menu_name = $(this).attr('menu_name');
    if($(this).prop("checked") == true)
    {
       add_sub_menu(this,name_value,menu_name);
    }else{
        $('.'+name_value).remove();
    }
    
});

function add_sub_menu(main_check,name_value,menu_name)
{
    var html = '';
    html += '<div class="sub-check '+name_value+'">';
    html += '<input type="checkbox" name="'+name_value+'_edit">'; 
    html += '<span>'+menu_name+' Edit</span><br/>';
    html += '<input type="checkbox" name="'+name_value+'_delete">'; 
    html += '<span>'+menu_name+' Delete</span></div>';
    $(main_check).parent().append(html);
}

</script>
