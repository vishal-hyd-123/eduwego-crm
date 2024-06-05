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
 .fa-eye{
   cursor: pointer;
 }
 </style>
<div id="content" class="flex ">
   <div class="page-container" id="page-container">
      <div class="padding">
         <div class="row mb-4">
            <div class="col-12 col-md-6">
               <h2 class="mb-0 nwFntSt _blckClr_ _fwg500_ _fs16_ pull-left">Demo Requests List</h2>
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
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Institute Name</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Username</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Demo Date & Time</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Phone</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Status</span></th>
                  <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Actions</span></th>
               </thead>
               <tbody id="tableBody">
                  <?php
                  if(!empty($requests))
                  {
                    $sl = 1;
                    foreach($requests as $key=>$request)
                    {
                      ?>
                        <tr>
                          <td><?=($key+1); ?></td>
                          <td><?=$request->institute_name; ?></td>
                          <td><?=$request->name; ?></td>
                          <td>
                            <?php
                               echo date('d-M-Y',strtotime($request->demo_date))."<br/>".date('H:i A',strtotime($request->demo_time)); 
                            ?>
                          </td>
                          <td><?=$request->phone; ?></td>
                          <td>
                             <select class="form-control demo-status" req_id="<?=$request->request_id; ?>">
                                <option value="">Select Status</option>
                                <option value="Called" <?php if($request->status == 'Called'){echo 'selected';} ?> >Called</option>
                                <option value="Demo Completed" <?php if($request->status == 'Demo Completed'){echo 'selected';} ?>>Demo Completed</option>
                             </select>
                          </td>
                          <td>
                             <a href="<?=base_url(); ?>admin/viewRequestDetails/<?=base64_encode($request->request_id); ?>"><i class="fa fa-eye"></i></a>
                             <a href="javascript:void(0)" onclick="deleteRequest(<?=$request->request_id ?>)"><i class="fa fa-trash text-danger"></i></a>
                          </td>
                        </tr>
                      <?php
                    }
                  }
                  ?>
                  
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>


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
   function deleteRequest(req_id)
   {
      var conf = confirm("Are you sure?");
      if(conf == 1)
      {
         $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>admin/deleteRequest',
            data : {
               req_id : req_id,
            },
            success : function(res){
                 var data = JSON.parse(res);
                 if(data.status == false){
                     $( ".error-message" ).remove();
                     if(data.errormessage){
                       vNotify.error({text:data.errormessage, title:'Error!'});
                     }
                     data1   = JSON.parse(data.message);
                     $('form :input').each(function(){                          
                       var elementName = $(this).attr('name');        
                       var message = data1[elementName];
                       if(message){
                         var element = $('<span>' + message + '</span>')
                                       .attr({
                                           'class' : 'error-message'
                                       });
                         $(this).after(element);
                         $(element).fadeIn();
                       }
                     }); 
                 }
                 if(data.status == true){
                     vNotify.success({text:data.message});
                     $( ".error-message" ).remove();
                     window.location = location.href;
                 }
            } 
         
         });
      }
   }
</script>

<script>
   $(".demo-status").on('change',function(){
      var req_id = $(this).attr('req_id');
      var status = $(this).val();
      if(status != "")
      {
         $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>admin/changeDemoStatus',
            data : {
               req_id : req_id,
               status : status
            },
            success : function(data){
              var data = JSON.parse(data);
              if(data.status == false){
                  $( ".error-message" ).remove();
                  if(data.errormessage){
                    vNotify.error({text:data.errormessage, title:'Error!'});
                  }
                  data1   = JSON.parse(data.message);
                  $('form :input').each(function(){                          
                    var elementName = $(this).attr('name');        
                    var message = data1[elementName];
                    if(message){
                      var element = $('<span>' + message + '</span>')
                                    .attr({
                                        'class' : 'error-message'
                                    });
                      $(this).after(element);
                      $(element).fadeIn();
                    }
                  }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }
            
         });
      }

   });

</script>