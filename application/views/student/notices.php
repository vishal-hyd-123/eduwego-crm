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
    
  .student_details_box{
    width:100%;
    min-height:500px;
    border:1px solid #ccc;
    padding:20px;
    background:white;
    overflow-y: scroll;
  }

.history_table tr td{
   font-size:17px;
   padding:9px;
}
.history_table tr th{
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
  .notice-con{
    width:100%;
    min-height: 150px;
    border:1px solid #ccc;
    border-radius:10px;
    margin-bottom:12px;
  }
  .notice-header{
    width:100%;
    height:50px;
    padding:10px;
    color:white;
    background:#8E294F;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  .notice-date p{
    margin-right:7px;
  }
</style>
<div id="content" class="flex ">
  <div class="title-header">
        <div class="">
        <span>
            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-money"></i> NOTICES</h3>
        </span>
        </div>
  </div>
   <div class="page-container" id="page-container">
      <div class="padding">

         <div class="container">

           <div class="student_details_box shadow-lg">
             <?php
              foreach($notices as $notice)
              {
             ?>
              <div class="notice-con">
                <div class="notice-header">
                  <center><p><?php echo $notice->announcment_title; ?></p></center>
                  
                </div>
                <div class="notice-date d-flex justify-content-end">
                  <p>
                    <u>Published On </u>:
                    <?php 
                      $date = strtotime($notice->announcment_start_date);
                      echo date('d-m-Y',$date); 
                    ?>
                  </p>
                  <p>
                    <u>Expires On </u>:
                    <?php 
                      $date = strtotime($notice->announcment_end_date);
                      echo date('d-m-Y',$date);
                    ?>
                  </p>
                </div>

                <div class="notice-details px-4">
                  <p>
                    <?php echo $notice->announcment_discription; ?>
                  </p>
                </div>

              </div>
             <?php
              }
             ?>
           </div>

         </div>

      </div>
   </div>
</div>

<script>

</script>