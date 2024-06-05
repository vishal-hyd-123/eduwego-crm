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
            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-book"></i>  MY COURSE</h3>
        </span>
        </div>
  </div>
   <div class="page-container" id="page-container">
      <div class="padding">

         <div class="">

           <div class="student_details_box shadow-lg">
             <div class="row profile-box">
                <div class="col-md-3 mb-3">
                    <div class="profile_img_box">
                      <?php
                        if($data['photo'] != null)
                        {
                          ?>
                          <div style="width: 100%; height: auto;">
                            <div class="imgcontent" style="width: 180px;height: auto; text-align: center;">
                                <img class="blah" id="blah" src="<?php echo base_url(); ?>uploads/<?php echo $data['photo']; ?>" style="width: 100%;">
                            </div>

                            <input type="file" name="image" accept="Images/*" id="expertProfile" hidden="">
                          </div>

                          <?php
                        }
                        else{
                          ?>
                            <div style="width: 100%; height: auto;">
                              <div class="imgcontent" style="width: 180px;height: auto; text-align: center;">
                                  <img class="blah" id="blah" src="<?php echo base_url(); ?>assets/dashboard/img/person2.jpg" style="width: 100%;">
                              </div>

                              <input type="file" name="image" accept="Images/*" id="expertProfile" hidden="">
                            </div>
                          <?php
                        }
                      ?>
                        
                    </div>
                </div>

                <div class="col-md-9 pl-3">
                  <div style="width:100%">
                    <table class="table-bordered w-100 details_table">
                      <tr>
                        <th>Course :</th>
                        <td class="text-capitalize"><?php echo $course_details[0]->course; ?></td>
                      </tr>
                      <tr>
                        <th>Stream :</th>
                        <td class="text-capitalize"><?php echo $course_details[0]->stream; ?></td>
                      </tr>
                      <tr>
                        <th>Year of Admission : </th>
                        <td class="text-capitalize"><?php echo $course_details[0]->yoa; ?></td>
                      </tr>
                      <tr>
                        <th>Course Duration : </th>
                        <td class="text-capitalize"><?php echo $course_details[0]->course_dur; ?></td>
                      </tr>
                    
                    </table>
                  </div>
                </div>
                
            </div>
           </div>

         </div>

      </div>
   </div>
</div>

<script>

</script>