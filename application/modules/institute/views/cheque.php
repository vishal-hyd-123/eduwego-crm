<style type="text/css">
   /*.chequeActive{
   border-color: #5BC146;
   color: #8A162B;
   }*/
   .chequeActive ._sdf_{
   color: #8A0A28 !important;
   }
   .checkmarkpo
   {
      margin-left: 10px;
   }
   .main_div{width: 766.934px;border:1px solid #Efefef}
   .header{
      background: #fff;height: 56.67px;
   }
   .logo_div{padding-left: 52.892px}
   .center_div{
      background: #47b9e42e;height: 232.347px;padding-left: 32.113px;padding-right: 26.446px;
   }
   .pay_div{
      border-bottom: 1px solid #146ACB;height: 37.78px;vertical-align: bottom; position: relative;
   }
   .pay_lable{color: #146ACB;position: absolute;bottom: 0;}
   .ruppe_div{border-bottom: 1px solid #146ACB;height: 31.3574px;vertical-align: bottom;width: 528.92px; position: relative;}
   .paid_div{border-bottom: 1px solid #146ACB;height: 31.3574px;vertical-align: bottom;width: 528.92px;float: left;position: relative;}
   .account_num{margin-top: 15.112px;width: 264.46px;height: 25.6904px;border:1px solid #146ACB; float: left;}
   .amount_div{width:173.788px;border:1px solid #146ACB;float: right;height: 31.3574px;}
</style>
<div id="content" class="flex ">
   <div class="page-container" id="page-container">
      <div class="padding">
         <div class="page-title p-b-40 m-b-20 pt20">
            <h2 class="mb-0 nwFntSt _blckClr_ _fwg500_ _fs16_ pull-left">All Cheque</h2>
             <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="openAddPopup(this, '#opnpopup')" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">Print Cheque</button><button style="display: none;" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete"><i class="i-con i-con-trash"><i></i></i></button></span>
         </div>
         <div class="table-responsive">
            <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
               <a href="https://datatables.net/extensions/responsive/" target="_blank"></a>
               <thead>
                  <th></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#ID</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Receiver’s Name</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Cheque No</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Date</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Amount</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Porpose</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>
               </thead>
               <tbody id="tableBody">
                  <tr>
                     <td><label class="checkboxcontainer">
                           <input type="checkbox" class="pivileges">
                           <span class="checkmark"></span>
                           </label> 
                      </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">1</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">Priyam Junaval</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">8989898989</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">B.Tech</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">2021</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">Amitesh</div>
                     </td>
                     <td class="actionbtns">
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_">
                           <button onclick="" class="btn _fs14_ _bgbrwn_ i-con-h-a print-bttn">
                              Print<!-- <i class="i-con i-con-down"></i> -->
                           </button>
                        </span>
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ makeresponsive">
                           <button onclick="" class="btn _fs14_  _bgyllw_ i-con-h-a edit-bttn"><i class="i-con i-con-edit"></i>Edit
                           </button>
                        </span>
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button  class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></button></span>
                     </td>
                  </tr>
                   <tr>
                     <td><label class="checkboxcontainer">
                           <input type="checkbox" checked="checked" class="pivileges">
                           <span class="checkmark"></span>
                           </label> 
                      </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">2</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">Priyam Junaval</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">8989898989</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">B.Tech</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">2021</div>
                     </td>
                     <td>
                        <div class="item-except _greyClr_ _fs14_">Amitesh</div>
                     </td>
                     <td class="actionbtns">
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_">
                           <button onclick="" class="btn _fs14_ _bgbrwn_ i-con-h-a Delete-bttn">
                              Print<!-- <i class="i-con i-con-down"></i> -->
                           </button>
                        </span>
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ makeresponsive">
                           <button class="btn _fs14_  _bgyllw_ i-con-h-a edit-bttn"><i class="i-con i-con-edit"></i>Edit</button>
                        </span>
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button  class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></button></span>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="main_div" style="">
            <div class="header" style="">
               <div class="logo_div" style="">
                  <img src="state-bank-of-india-logo.jpg" height="50px;">
               </div>
            </div>
            <div class="center_div" style="">
               <div class="pay_div" style="">
                  <!-- <label class="pay_lable" style="">pay</label> -->
               </div>
               <div class="ruppe_div" style="">
                  <!-- <label class="pay_lable">Rupees</label> -->
               </div>
               <div class="paid_div" style="">
                  <!-- <label class="pay_lable" style="right: 0">Rupees</label> -->
               </div>
               <div class="amount_div" style="">
               </div>
               <div class="account_num" style="">
                  <div class="" style="padding-left: 26.446px;"></div>
               </div>
               
            </div>
            <div class="footer" style="height:60.448px;background: #fff;"></div>
         </div>
      </div>
   </div>
</div>
<div class="modal Modal_" id="opnpopup">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header ">
            <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Print Cheque</h5>
            <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
         </div>
         <!-- Modal Header -->
         <div class="modal-body">
            <div class="main_div" style="">
               <div class="header" style="">
                  <div class="logo_div" style="">
                     <img src="state-bank-of-india-logo.jpg" height="50px;">
                  </div>
               </div>
               <div class="center_div" style="">
                  <div class="pay_div" style="">
                     <!-- <label class="pay_lable" style="">pay</label> -->
                  </div>
                  <div class="ruppe_div" style="">
                     <!-- <label class="pay_lable">Rupees</label> -->
                  </div>
                  <div class="paid_div" style="">
                     <!-- <label class="pay_lable" style="right: 0">Rupees</label> -->
                  </div>
                  <div class="amount_div" style="">
                  </div>
                  <div class="account_num" style="">
                     <div class="" style="padding-left: 26.446px;"></div>
                  </div>
                  
               </div>
               <div class="footer" style="height:60.448px;background: #fff;"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- <div class="modal Modal_" id="opnpopup">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header ">
            <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Print Cheque</h5>
            <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
         </div>
         <div class="modal-body">
            <form id="chequeform" method="POST" class="instituteform _formSubmit" action="<?php echo base_url('institute/add_cheque'); ?>">
               <div class="form-group row formlable">
                  <div class="col-12 text-left">
                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date*</label>
                     <input id="date" type="text" name="date" class="form-control makeReqin date examDate" required autocomplete="new">
                  </div>
               </div>
               <div class="form-group row formlable">
                  <div class="col-12 text-left">
                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Receiver’s Name*</label>
                     <input id="receiver" type="text" name="receiver" class="form-control makeReqin" required autocomplete="new">
                  </div>
               </div>
               <div class="form-group row formlable">
                  <div class="col-12 text-left">
                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount* (in RS)</label>
                     <input id="amount" type="tel" name="amount" class="form-control makeReqin" required autocomplete="new">
                  </div>
               </div>
              <div class="form-group row formtextlable">
                  <div class="col-12 text-left">
                     <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount in Words*</label>
                     <textarea id="amountword"  class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required style="height: 60px;" autocomplete="new"></textarea>
                  </div>
               </div>
               <div class="form-group row formlable" style="margin-top: 16px;">
                  <div class="col-12 text-left">
                     <label class="checkboxcontainerpo col-form-label _fs14_ _fwg500_ _greyClr_ text-left">
                     <input type="checkbox" checked="checkedpo" class="pivilegespo">Account Payee
                     <span class="checkmarkpo"></span>
                     </label> 
                  </div>
               </div>
               <div class="form-group row formlable">
                  <div class="col-12 text-left">
                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Purpose*</label>
                     <input id="purpose" type="text" name="purpose" class="form-control makeReqin" autocomplete="new">
                  </div>
               </div>
               <div class="form-group row formlable">
                  <div class="col-12 text-left">
                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Remark (if any)</label>
                     <input id="Remark" type="text" name="Remark" class="form-control makeReqin" required autocomplete="new">
                  </div>
               </div>
            <div class="modal-footer"style="width: 100%;">
                  <div class="col-12">
                     <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                     <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                     <button type="button" class="svebtn"  style="float:right">Save</button>
                  </div>
              </div>
            </form>
         </div>
      </div>
   </div>
</div> -->
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
                        Delete Cheque.
                     </h3>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 m-t-20">
                     <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Cheque from the dashboard?</p>
                  </div>
               </div>
               <form id="multiPleDeleteqw" method="POST" action="<?php echo base_url('admin/deletetaluka'); ?>">
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
                        Delete this Cheque.
                     </h3>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 m-t-20">
                     <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Cheque from the dashboard?</p>
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
<!--<============
   Delete Popup End
   ============>-->


<script>

 
</script>