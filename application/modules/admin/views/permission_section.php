<style type="text/css">
   .agentActive ._sdf_{
   color: #8A0A28 !important;
   }
   .actnUl
   {
    list-style: none;
    vertical-align: middle;
    border:0px;
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
   }
   .checkboxcontainer {
   display: block;
   position: relative;
   padding:0 21px;
   margin-bottom: 12px;
   cursor: pointer;
   font-size: 14px;
   }
   /* Hide the browser's default checkbox */
   .checkboxcontainer .checkboxinpt {
   position: absolute;
   opacity: 0;
   cursor: pointer;
   height: 0;
   width: 0;
   }
   /* Create a custom checkbox */
   .checkmark {
   position: absolute;
   top: 0;
   left: 0;
   height: 17px;
   width: 17px;
   background-color: #eee;
   border-radius: 4px;
   }
   /* On mouse-over, add a grey background color */
   .checkboxcontainer:hover .checkboxinpt ~ .checkmark {
   background-color: #ccc;
   }
   /* When the checkbox is checked, add a blue background */
   .checkboxcontainer .checkboxinpt:checked ~ .checkmark {
   background-color: #2196F3;
   }
   
   /* Show the checkmark when checked */
   .checkboxcontainer .checkboxinpt:checked ~ .checkmark:after {
   display: block;
   }
   /* Style the checkmark/indicator */
   .checkboxcontainer .checkmark:after {
   left: 5px;
   top: 2px;
   width: 7px;
   height: 11px;
   border: solid white;
   border-width: 0 3px 3px 0;
   -webkit-transform: rotate(45deg);
   -ms-transform: rotate(45deg);
   transform: rotate(45deg);
   }
</style>
<div id="content" class="flex ">
   <div class="page-container" id="page-container">
      <div class="padding">
         <div class="row justify-content-between">
            <div class="box">
               <div class="formhead p-t-20 p-l-10">
                  <!-- <h4 class="text-muted _blckClr_ _fwg500_ nwFntSt" >Permission Section</h4> -->
               </div>
               <table class="table">
                  <tbody>
                     <tr>
                        <td>
                           <input type="checkbox" name="" data-toggle="collapse" href="#questions" class="mainSection"><label class="_fs14_ _fwg600_ p-l-10" >Admission</label>
                           <ul id="questions" class="collapse actnUl" data-parent="#questions"style="list-style: none; vertical-align: middle;">
                              <li>
                                 <label class="checkboxcontainer _fwg600_">Enquiry
                                   <input type="checkbox" class="checkboxinpt checkbtn" name="enquirycheck" data-attr="enquiry">
                                   <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li>
                                 <label class="checkboxcontainer _fwg600_">Students
                                   <input type="checkbox"  class="checkboxinpt checkbtn" name="studentscheck" data-attr="students">
                                   <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li> 
                                 <label class="checkboxcontainer _fwg600_">Courses
                                   <input type="checkbox"  class="checkboxinpt checkbtn" name="coursescheck"data-attr="courses">
                                   <span class="checkmark"></span>
                                 </label>
                              </li>
                           </ul>
                        </td>
                        <td>
                          <div style="padding-top: 26px;"></div>
                          <div class="actinotn" style="display: none;" data-attr="enquiry">
                             <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                   <input type="checkbox" class="checkboxinpt" name="enquiryadd">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                   <input type="checkbox"  class="checkboxinpt" name="enquiryedit">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                   <input type="checkbox"  class="checkboxinpt"name="enquirydelete">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                   <input type="checkbox"  class="checkboxinpt" name="enquiryview">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                          </div>
                           <div class="actinotn"style="display: none;" data-attr="students">
                             <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                   <input type="checkbox" class="checkboxinpt" name="studentsadd">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                   <input type="checkbox"  class="checkboxinpt" name="studentsedit">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                   <input type="checkbox"  class="checkboxinpt"name="studentsdelete">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                   <input type="checkbox"  class="checkboxinpt" name="studentsview">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                           <div class="actinotn" style="display: none;"data-attr="courses">
                              <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                   <input type="checkbox" class="checkboxinpt" name="coursesadd">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                   <input type="checkbox"  class="checkboxinpt" name="coursesedit">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                   <input type="checkbox"  class="checkboxinpt"name="coursesdelete">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                   <input type="checkbox"  class="checkboxinpt" name="coursesview">
                                   <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <input type="checkbox" name="" data-toggle="collapse" href="#agent" class="mainSection"><label class="_fs14_ _fwg600_ p-l-10 " >Agent</label>
                           <ul id="agent" class="collapse" data-parent="#agent"style="list-style: none; vertical-align: middle;">
                              <li>
                                 <label class="checkboxcontainer _fwg600_">Agent
                                   <input type="checkbox" class="checkboxinpt checkbtn" name="agentcheck" data-attr="agent">
                                   <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li>
                                 <label class="checkboxcontainer _fwg600_"> Sub Agent
                                   <input type="checkbox"  class="checkboxinpt checkbtn" name="subagentcheck" data-attr="sub_agent">
                                   <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li> 
                                 <label class="checkboxcontainer _fwg600_">Payments
                                   <input type="checkbox"  class="checkboxinpt checkbtn" name="paymentscheck" data-attr="payments">
                                   <span class="checkmark"></span>
                                 </label>
                              </li>
                           </ul>
                        </td>
                        <td>
                          <div style="padding-top: 26px;"></div>
                           <div class="actinotn" data-attr="agent" style="display: none;">
                              <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="agentadd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="agentedit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="agentdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="agentview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                           <div class="actinotn" data-attr="sub_agent" style="display: none" >
                              <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="subagentadd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="subagentedit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="subagentdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="subagentview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                           <div class="actinotn" data-attr="payments" style="display: none" >
                              <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="paymentsadd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="paymentsedit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="paymentsdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="paymentsview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <input type="checkbox" name="" data-toggle="collapse" href="#vendor" class="mainSection"><label class="_fs14_ _fwg600_ p-l-10" >Vendor Inner Section</label>
                           <ul id="vendor" class="collapse" data-parent="#vendor"style="list-style: none; vertical-align: middle;">
                              <li>
                                 <label class="checkboxcontainer _fwg600_">Add Vendor
                                     <input type="checkbox" class="checkboxinpt checkbtn" name="addvendorcheck" data-attr="addvendor">
                                     <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li>
                                 <label class="checkboxcontainer _fwg600_"> Add Payments
                                     <input type="checkbox"  class="checkboxinpt checkbtn" name="addpaymentscheck" data-attr="addpayments">
                                     <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li> 
                                 <label class="checkboxcontainer _fwg600_">Print Voucher
                                     <input type="checkbox"  class="checkboxinpt checkbtn" name="printvouchercheck" data-attr="printvoucher">
                                     <span class="checkmark"></span>
                                 </label>
                              </li>
                           </ul>
                        </td>
                        <td>
                          <div style="padding-top: 26px;"></div>
                           <div class="actinotn" style="display: none;" data-attr="addvendor">
                             <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="addvendoradd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="addvendoredit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="addvendordelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="addvendorview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                           <div class="actinotn" style="display: none" data-attr="addpayments">
                               <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="addpaymentsadd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="addpaymentsedit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="addpaymentsdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="addpaymentsview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                           <div class="actinotn" style="display: none" data-attr="printvoucher">
                              <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="printvoucheradd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="printvoucheredit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="printvoucherdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="printvoucherview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td style="vertical-align: middle;">
                           <label class=" _fwg600_ _fs14_">
                             <input type="checkbox"  class=" getOptions checkboxcontainer m-r-10" style="display: inline-block;"name="streamcheck">Stream
                           </label>
                        </td>
                        <td>
                           <div class="actinotn" style="display: none;padding-top: 5px;">
                              <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="Streamadd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="Streamedit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="Streamdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="Streamview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td style="vertical-align: middle;">
                            <label class=" _fwg600_ _fs14_">
                              <input type="checkbox"  class=" getOptions checkboxcontainer m-r-10" style="display: inline-block;padding-top: 5px;pad"name="printchequecheck">Print cheque
                           </label>
                        </td>
                        <td>
                           <div class="actinotn" style="display: none">
                              <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="printchequeadd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="printchequeedit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="printchequedelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="printchequeview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <input type="checkbox" name="" data-toggle="collapse" href="#Staff_faculties" class="mainSection"><label class="_fs14_ _fwg600_ p-l-10" >Staff/faculties</label>
                           <ul id="Staff_faculties" class="collapse" data-parent="#Staff_faculties"style="list-style: none; vertical-align: middle;">
                              <li>
                                 <label class="checkboxcontainer _fwg600_">Add Staff
                                   <input type="checkbox" class="checkboxinpt checkbtn" name="addstaffcheck" data-attr="addstaff">
                                   <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li>
                                 <label class="checkboxcontainer _fwg600_"> Payments
                                   <input type="checkbox"  class="checkboxinpt checkbtn" name="paymentscheck" data-attr="payments">
                                   <span class="checkmark"></span>
                                 </label>
                              </li>
                              <li> 
                                 <label class="checkboxcontainer _fwg600_ ">Voucher
                                   <input type="checkbox"  class="checkboxinpt checkbtn p-l-10" name="vouchercheck" data-attr="voucher">
                                   <span class="checkmark"></span>
                                 </label>
                              </li>
                           </ul>
                        </td>
                        <td>
                          <div style="padding-top: 26px;"></div>
                           <div class="actinotn" style="display: none" data-attr="addstaff">
                              <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="addstaffadd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="addstaffedit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="addstaffdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="addstaffview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                           <div class="actinotn" style="display: none" data-attr="payments">
                              <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="paymentsadd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="paymentsedit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="paymentsdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="paymentsview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                           <div class="actinotn" style="display: none" data-attr="voucher">
                             <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="voucheradd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="voucheredit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="voucherdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="voucherview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td style="vertical-align: middle;">
                           <label class=" _fwg600_ _fs14_">
                              <input type="checkbox"  class=" getOptions checkboxcontainer m-r-10" style="display: inline-block;"name="sendsmscheck">Send sms
                           </label>
                        </td>
                        <td>
                           <div class="actinotn" style="display: none;padding-top: 5px;">
                             <ul class="nav actnUl" >
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Add
                                     <input type="checkbox" class="checkboxinpt" name="sendsmsadd">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Edit
                                     <input type="checkbox"  class="checkboxinpt" name="sendsmsedit">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">Delete
                                     <input type="checkbox"  class="checkboxinpt"name="sendsmsdelete">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                                <li class="nav-item">
                                   <label class="checkboxcontainer">View
                                     <input type="checkbox"  class="checkboxinpt" name="sendsmsview">
                                     <span class="checkmark"></span>
                                   </label>
                                </li>
                             </ul>
                           </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
  
</script>