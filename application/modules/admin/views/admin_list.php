<style type="text/css">
   /*.agentActive, .agentActive:hover{
   background: rgba(91, 193, 70, 0.1);
   border-color: #5BC146;
   color: #8A162B;
   }*/
   .instituteActive ._sdf_{
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
 </style>
<div id="content" class="flex ">
   <div class="page-container" id="page-container">
      <div class="padding">
         <div class="row mb-4">
            <div class="col-12 col-md-6">
               <h2 class="mb-0 nwFntSt _blckClr_ _fwg500_ _fs16_ pull-left">Admin List</h2>
            </div>
            <div class="col-12 col-md-6 text-right">
               <button class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete" style="display: none;"><i style="color: #fff" class="i-con i-con-trash"><i></i></i></button>
               <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;">
                <button onclick="adminAddPopup()" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">+ Add Admin</button><button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button>
              </span>
            </div>
            
         </div>
         <div class="form_errors">
           <span class="text-danger"><?php echo form_error('name'); ?></span>
           <span class="text-danger"><?php echo form_error('mobile'); ?></span>
           <span class="text-danger"><?php echo form_error('email'); ?></span>
           <span class="text-danger"><?php echo form_error('password'); ?></span>
         </div>
         <div class="table-responsive">
            <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
               <a href="https://datatables.net/extensions/responsive/" target="_blank"></a>
               <thead>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Sl.No.</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Admin Name</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Institute Name</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Email</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Contact Number</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Actions</span></th>
               </thead>
               <tbody id="tableBody">
                  <?php
                    $sl = 1;
                    foreach($admins as $admin)
                    {
                      ?>
                        <tr>
                          <td><?php echo $sl++; ?></td>
                          <td class="text-capitalize"><?php echo $admin->name; ?></td>
                          <td class="text-capitalize"><?php echo $admin->institute_name; ?></td>
                          <td><?php echo $admin->email; ?></td>
                          <td><?php echo $admin->mobile; ?></td>
                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-success edit_admin_btn" admin_id="<?php echo $admin->id; ?>"><i class="i-con i-con-edit"></i></button>
                              <button type="button" class="btn btn-danger delete_admin_btn" admin_id="<?php echo $admin->id; ?>"><i class="i-con i-con-trash"><i></i></i></button>
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

<div class="modal Modal_" id="adminAddModal">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header ">
            <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Admin</h5>
            <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
         </div>
         <div class="modal-body">
            <form role="form" class="_formSubmit" id="add_admin_form" method="post" action="<?php echo base_url('admin/add_admin'); ?>">
               <div class="col-12">
                  <div class="form-group">
                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Select Institute<span class="validation-color">*</span></label>
                    <select id="institute_id" name="institute_id" class="form-control makeReqin" required>
                      <option value="">Select Institute</option>
                      <?php
                        foreach($institutes as $institute)
                        {
                        ?>
                        <option value="<?php echo $institute->institute_id; ?>"><?php echo $institute->institute_name; ?></option>
                        <?php
                        }
                      ?>
                    <select>
                    <input type="hidden" id="institute_name" name="institute_name" />
                  </div>
                  <div class="form-group">
                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Admin Name<span class="validation-color">*</span></label>
                    <input id="name" type="text" name="name" class="form-control makeReqin" required />
                  </div>
                  <div class="form-group">
                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Contact Number<span class="validation-color">*</span></label>
                    <input id="mobile" type="text" name="mobile" class="form-control makeReqin" required />
                  </div>
                  <div class="form-group">
                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Email<span class="validation-color">*</span></label>
                    <input id="email" type="email" name="email" class="form-control makeReqin" required />
                  </div>

                  <div class="col-sm-12">
                     <div class="box-footer">
                        <center><button type="submit" id="submit" class="btn btn-primary">Add Now</button></center>
                        <!-- <input type="hidden" name="institute_id" value="" id="institute_id"> -->
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>


<div class="modal Modal_" id="adminEditModal">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header ">
            <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Admin</h5>
            <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
         </div>
         <div class="modal-body">
            <form role="form" class="_formSubmit" id="edit_admin_form" method="post" action="<?php echo base_url('admin/edit_admin'); ?>">
               <div class="col-12">
                  <div class="form-group">
                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Select Institute<span class="validation-color">*</span></label>
                    <select name="edit_institute_id" class="form-control makeReqin institute_id" required>
                      <option class="first_institute_name"></option>
                      <?php
                        foreach($institutes as $institute)
                        {
                        ?>
                        <option value="<?php echo $institute->institute_id; ?>"><?php echo $institute->institute_name; ?></option>
                        <?php
                        }
                      ?>
                    <select>
                    <input type="hidden" class="institute_name" name="edit_institute_name" />
                  </div>
                  <div class="form-group">
                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Admin Name<span class="validation-color">*</span></label>
                    <input type="text" name="edit_name" class="form-control makeReqin edit_name" required />
                  </div>
                  <div class="form-group">
                     <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Contact Number<span class="validation-color">*</span></label>
                    <input type="text" name="edit_mobile" class="form-control makeReqin edit_mobile" required />
                  </div>
                  
                  <div class="col-sm-12">
                     <div class="box-footer">
                        <input type="hidden" name="admin_id" value="" class="admin_id">
                        <center><button type="submit" class="btn btn-primary">Save Now</button></center>
                        
                     </div>
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
                        Delete Admin.
                     </h3>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 m-t-20">
                     <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete institute from the dashboard?</p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 text-right">
                     <form id="singleDeleteIdq" method="POST" action="<?php echo base_url('admin/deleteAdmin'); ?>">
                        <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                        <input type="hidden" name="admin_id" id="admin_id">
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