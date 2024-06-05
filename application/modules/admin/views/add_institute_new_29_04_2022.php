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
    padding-bottom: 20px;
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
                     <h4 class="text-muted _blckClr_ _fwg500_ nwFntSt" >Add New Institute</h4>
                  </div>
                  <form id="add_institute" method="post" action="<?php echo base_url(); ?>admin/add_institute" enctype="multipart/form-data">
                        <div class="col-12 col-sm-6">
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Institute Name<span class="validation-color">*</span></label>
                             <input id="name" type="text" name="name" class="form-control makeReqin" required="required">
                           </div>
                          <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Username<span class="validation-color">*</span></label>
                             <input id="username" type="text" name="username" class="form-control makeReqin" required="required">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Logo<span class="validation-color">*</span></label>
                             <input id="logo" type="file" name="logo" class="form-control makeReqin uplodimg" />
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Banner<span class="validation-color">*</span></label>
                             <input id="banner" type="file" name="banner" class="form-control makeReqin uplodimg" />
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Contact Number<span class="validation-color">*</span></label>
                             <input id="mobile" type="text" name="mobile" class="form-control makeReqin" required="required">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Email<span class="validation-color">*</span></label>
                             <input id="email" type="email" name="email" class="form-control makeReqin" required="required">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">password<span class="validation-color">*</span></label>
                             <input id="password" type="password" name="password" class="form-control makeReqin" required="required">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Number of Students<span class="validation-color">*</span></label>
                             <input id="allowed_student" type="text" name="allowed_student" class="form-control makeReqin" required="required">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Website Link<span class="validation-color">*</span></label>
                             <input id="website" type="website" name="website" class="form-control makeReqin" placeholder="ex- https://websitename.com" />
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Message Api Username<span class="validation-color">*</span></label>
                             <input id="msg_api_username" type="text" name="msg_api_username" class="form-control makeReqin">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Message Api Password<span class="validation-color">*</span></label>
                             <input id="msg_api_password" type="text" name="msg_api_password" class="form-control makeReqin">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Payment Gateway Link<span class="validation-color">*</span></label>
                             <input id="payment_api_key" type="text" name="payment_api_key" class="form-control makeReqin">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Subdomain Name<span class="validation-color">*</span></label>
                             <input id="subdomain" type="text" name="subdomain" class="form-control makeReqin">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Registration Form Html File Name<span class="validation-color">*</span></label>
                             <input id="html_file_name" type="text" name="html_file_name" class="form-control makeReqin">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Registration Form Html File Name Editable<span class="validation-color">*</span></label>
                             <input id="html_file_name_editable" type="text" name="html_file_name_editable" class="form-control makeReqin">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Expiry Date<span class="validation-color">*</span></label>
                             <input id="expiry_date" type="text" name="expiry_date" class="form-control makeReqin date examDate">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">State<span class="validation-color">*</span></label>
                             <input id="state" type="text" name="state" class="form-control makeReqin">
                           </div>
                           <div class="form-group">
                              <label class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Address<span class="validation-color">*</span></label>
                              <textarea id="address"  name="address" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required style="height: 60px;" required="required"></textarea>
                           </div>

                           <div class="col-sm-12">
                              <div class="box-footer">
                                 <button type="submit" id="submit" class="btn btn-primary">Add</button>
                                 <span class="btn btn-default float-right" id="cancel" style="margin-left: 2%" onclick="cancel('department')">Cancel</span>
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

   
</script>