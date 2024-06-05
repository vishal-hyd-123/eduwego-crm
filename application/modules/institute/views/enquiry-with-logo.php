<style type="text/css">
  .smsActive ._sdf_{
    
    
    color: #8A162B !important;
  }
  .smsselectbox
  {
    margin: 0px 30px;
   margin-top: 10px;
    background: #FFFFFF;
    border: 1px solid #ECECEC;
    box-sizing: border-box;
    border-radius: 2px;
    width: 201px;
    height: 30px;
    color: #888888;
  }
  /*.selectdropdwn:nth-child(n + 2) select
  {
    margin-left: 32px;
  }*/
 
</style>
<div id="content" class="flex ">
   <div class="page-container" id="page-container">
        <div class="padding">
         	<div class="page-title p-b-40 m-b-20 pt20">
         		<div class="card padding">
         			<div class="row justify-content-center">
         				<div class="col-4">
         					<img src="<?php echo base_url(); ?>assets/dashboard/img/zeqonlogo.png">
         				</div>
         			</div>
		            <form id="" method="POST" class="instituteform _formSubmit" action="">
		               <div class="form-group row m-t-30">
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Full Name*</label>
		                     <input id="name" type="text" name="name" class="form-control makeReqin" required autocomplete="new">
		                  </div>
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">S/W/D of</label>
		                     <input id="lastname" type="text" name="lastname" class="form-control makeReqin" required autocomplete="new">
		                  </div>
		               </div>
		                <div class="form-group row">
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mothers Name*</label>
		                     <input id="mothersname" type="text" name="mothersname" class="form-control makeReqin" required autocomplete="new">
		                  </div>
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Occupation*</label>
		                     <input id="occupation*" type="text" name="occupation" class="form-control makeReqin" required autocomplete="new">
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date of Birth*</label>
		                     <input id="birthDate" type="text" name="dob" class="form-control makeReqin date examDate" required autocomplete="new">
		                  </div>
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left" required>Gender*</label><br>
		                        <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left"><input type="radio" name="gender"value="Male">  Male</label>
		                       <label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left"style="padding-left: 30%;"> <input type="radio" name="gender"value="FeMale">  Female</label>
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <div class="col-12 col-md-6">
		                    <div class="form-group">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Stream*</label>
		                     <select id="stream" name="stream" class="form-control makeReqin" required >
		                       <option value="disabled">Stream</option>
		                       <option value="converted">Converted</option>
		                       <option value="notconverted">Not Converted</option>
		                     </select>
		                     </div>
		                       <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Reffered By</label>
		                       <input id="reffered" type="text" name="reffered" class="form-control makeReqin">
		                  </div>
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Address</label>
		                      <textarea id="address"  class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required autocomplete="new" style="height: 109px;"></textarea>
		                  </div>
		               </div>
		              
		                <div class="form-group row">
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>
		                     <input id="number" type="number" name="number" class="form-control makeReqin" required autocomplete="new">
		                  </div>
		                  <div class="col-12 col-md-6">
		                     <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">City/Village*</label>
		                      <input id="cityvillage*" type="text" name="cityvillage" class="form-control makeReqin" required autocomplete="new">
		                  </div>
		               </div>

		               <div class="form-group row">
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email ID*</label>
		                     <input id="email" type="email" name="email" class="form-control makeReqin" required  autocomplete="new">
		                  </div>
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Timing Preferred</label>
		                      <input id="timing" type="text" name="timing" class="form-control makeReqin" autocomplete="new">
		                  </div>
		               </div>
		              <div class="form-group">
		                  <div class="col-12">
		                    <div class="modal-header"style="width: 100%">
		                      <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left" style="width: 100%;">Fees Details</label>
		                    </div>
		                     
		                   </div>  
		               </div> 
		               <div class="form-group row">
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course Fee Committed</label>
		                     <input id="committed" type="text" name="committed" class="form-control makeReqin" autocomplete="new">
		                  </div>
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Reminder Date*</label>
		                     <input id="date" type="text" name="admissionyer" class="form-control makeReqin date examDate" autocomplete="new">
		                  </div>
		               </div>
		               <div class="form-group row">
		                  <div class="col-12 col-md-6">
		                    <div class="form-group">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Discount Promised (if any)</label>
		                     <input id="discount" type="text" name="discount" class="form-control makeReqin" autocomplete="new">
		                    </div>
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Net Fees Applicable)</label>
		                     <input id="Fees" type="text" name="Fees" class="form-control makeReqin">
		                  </div>
		                  <div class="col-12 col-md-6">
		                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Remark</label>
		                   <textarea id="remark" name="remark" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin"  style="height: 109px;" autocomplete="new"></textarea>
		                  </div>
		               </div>
		                
		                   <div class="modal-footer"style="width: 100%;">
		                  <div class="col-12">
		                    <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
		                    <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
		                     <button type="submit" class="svebtn"  style="float:right">Save</button>
		                  </div>
		               </div> 
		            </form>
	         	</div>
            </div>
    	</div>
	</div>
</div>