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
 .details-con{
   width: 100%;
   padding: 35px;
   background: #FFFFFF;
 }
 .details-con p span{
   font-weight: bold;
 }
 </style>
<div id="content" class="flex ">
   <div class="page-container" id="page-container">
      <div class="padding">
         
         <div class="row details-con mb-4">
               <div class="col-12">
                  <center><h3>Request Details</h3></center>
                  <hr />
               </div>
               <div class="col-md-6">
                  <p><span>Institute Name : </span><?=$details->institute_name; ?></p>
                  <p><span>Institute Website : </span><?=$details->website; ?></p>
                  <p><span>User Name : </span><?=$details->name; ?></p>
                  <p><span>Designation : </span><?=$details->designation; ?></p>
                  <p><span>Email : </span><?=$details->email; ?></p>
                  <p><span>Phone : </span><?=$details->phone; ?></p>
               </div>

               <div class="col-md-6">
                  <p><span>Demo Date : </span><?=date('d-M-Y',strtotime($details->demo_date)); ?></p>
                  <p><span>Demo Time : </span><?=date('H:i A',strtotime($details->demo_time)); ?></p>
                  <p><span>Preffered Time to Call : </span><?=date('H:i A',strtotime($details->time_to_call)); ?></p>
                  <p><span>Language : </span><?=$details->time_to_call; ?></p>
                  <p><span>Status : </span><?=$details->status; ?></p>
                  <p><span>Request Date : </span><?=date('d-M-Y',strtotime($details->created_at)); ?></p>
               </div>
            
         </div>
         
         
      </div>
   </div>
</div>

<!-- / .modal -->
<!--<============
   Delete Popup 
     ============>-->

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