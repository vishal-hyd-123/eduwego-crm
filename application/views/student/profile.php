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
    padding:12px;
    background:white;
  }

.details_table tr td{
   font-size:17px;
   padding:9px;
}
.fee-box{
    border:1px solid #ccc;
}
.fee-box th,td{
    padding:7px;
    
}
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
            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-user"></i> MY PROFILE</h3>
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
                    <table class="w-100 details_table">
                      <tr>
                        <th>Name :</th>
                        <td class="text-capitalize"><?php echo $data['name']; ?></td>
                      </tr>
                      <tr>
                        <th>Son/Daughter/Wife of :</th>
                        <td class="text-capitalize"><?php echo $data['father']; ?></td>
                      </tr>
                      <tr>
                        <th>Mother Name : </th>
                        <td class="text-capitalize"><?php echo $data['mother']; ?></td>
                      </tr>
                      <tr>
                        <th>Occupation : </th>
                        <td class="text-capitalize"><?php echo $data['occupation']; ?></td>
                      </tr>
                      <tr>
                        <th>Date of Birth(D.O.B.) : </th>
                        <td class="text-capitalize">
                          <?php 
                            $date = strtotime($data['dob']);
                            $date = date('d-m-Y',$date); 
                            echo $date;
                          ?>
                            
                        </td>
                      </tr>
                      <tr>
                        <th>Gender : </th>
                        <td class="text-capitalize"><?php echo $data['gender']; ?></td>
                      </tr>
                      <tr>
                        <th>Email : </th>
                        <td class="text-capitalize"><?php echo $data['email']; ?></td>
                      </tr>
                      <tr>
                        <th>Mobile : </th>
                        <td class="text-capitalize"><?php echo $data['mobile']; ?></td>
                      </tr>
                      <tr>
                        <th>City : </th>
                        <td class="text-capitalize"><?php echo $data['city']; ?></td>
                      </tr>
                      <tr>
                        <th>Address : </th>
                        <td class="text-capitalize"><?php echo $data['address']; ?></td>
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