<style type="text/css">
   /*.agentActive, .agentActive:hover{
   background: rgba(91, 193, 70, 0.1);
   border-color: #5BC146;
   color: #8A162B;
   }*/
   .oldinstituteActive ._sdf_{
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
         <div class="page-title p-b-40 m-b-20 pt20">
            <h2 class="mb-0 nwFntSt _blckClr_ _fwg500_ _fs16_ pull-left"> All old Institute</h2>
           <!--  <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;"><button onclick="" class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn">Add New Institute</button></span> -->
         </div>
         <div class="table-responsive">
            <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
               <a href="https://datatables.net/extensions/responsive/" target="_blank"></a>
               <thead>
                  <th></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">S.No.</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Name</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Email</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">No. of student</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Contact Number</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Actions</span></th>
               </thead>
               <tbody id="tableBody">
                  <tr>
                     <td>
                         <label class="checkboxcontainer">
                           <input type="checkbox" checked="checked" name="<?php echo $enq[$i]->agent_id; ?>" class="pivileges">
                           <span class="checkmark"></span>
                         </label> 
                     </td>
                     <td><div class="item-except _greyClr_ _fs14_">01</div></td>
                    <td><div class="item-except _greyClr_ _fs14_">Name</div></td>
                    <td><div class="item-except _greyClr_ _fs14_">Email</div></td>
                    <td><div class="item-except _greyClr_ _fs14_">No. of student</div></td>
                    <td><div class="item-except _greyClr_ _fs14_">Contact Number</div></td>
                    <td class="actionbtns">
                        
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ makeresponsive"><button  class="btn _fs14_  _bgyllw_ i-con-h-a reactivate-bttn"><i class="i-con i-con-edit"></i>Reactivate</button></span>
                        <span class="item-except mrm5 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><button class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></button></span>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<script>
  
   
</script>