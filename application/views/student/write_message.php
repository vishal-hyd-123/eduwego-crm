<?php
  $data = $this->session->userdata($data);
?>
<style type="text/css">
   /*.agentActive, .agentActive:hover{
   background: rgba(91, 193, 70, 0.1);
   border-color: #5BC146;
   color: #8A162B;
   }*/
   .addinstituteActive ._sdf_{
    color: #8A0A28 !important;
   }
    
  .message_main_box{
    width:100%;
    min-height:400px;
    border:1px solid #ccc;
    padding:20px;
    background:white;
  }

.details_table tr td{
   font-size:17px;
   padding:9px;
}
.details_table tr th{
   font-size:17px;
   padding:9px;
}
/*.fee-box{
    border:1px solid #ccc;
}
.fee-box th,td{
    padding:7px;
    
}*/
.title-header{
      background:#8E294F;
      height:70px;
      padding:20px;

    }
</style>
<div id="content" class="flex ">
  <div class="title-header">
        <div class="">
        <span>
            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-edit"></i> WRITE TO MANAGEMENT</h3>
        </span>
        </div>
  </div>
   <div class="page-container" id="page-container">
      <div class="padding">

         <div class="">

           <div class="message_main_box shadow-lg">
             <form id="message_form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>student/message_to_management">
              <div class="form-group">
                <textarea class="form-control" name="message" rows="9" placeholder="Type Your Messages Here" required></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary message_send_btn">SEND NOW</button>
              </div>
             </form>
           </div>

         </div>

      </div>
   </div>
</div>

<script>
 
</script>