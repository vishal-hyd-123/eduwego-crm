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

  }

  /* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent{
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

.details_table tr td{
   font-size:17px;
   font-weight:bold;
   padding:7px;
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
.lead-info{
  background: #823b55;
  color: white;
}

.lead-info h4{
  color: white;
}

.lead-info,.lead-details,.lead-tabs{
  width: 100%;
  border: 1px solid #ccc;
  padding: 12px;
  box-sizing: border-box;
  margin-bottom: 7px;
}
.action-btns span{
  margin: 3px;
}
.list-inline{
  display: flex;
  
}
.list-inline li{
  padding: 7px;
  border: 1px solid #ccc;
}
.profile-box span{
  font-weight: bold;
}

</style>


<div id="content" class="flex ">
  <div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-search"></i>  LEAD DETAILS</h3>
        </span>
      </div>
  </div>
   <div class="page-container" id="page-container">
      <div class="padding">
         <div class="container">
           <div class="student_details_box shadow-sm bg-light">
            <div class="row my-4">
              <input type="hidden" name="student_id" id="student_id">
              <input type="hidden" name="yoa" id="yoa">
              <div class="col-md-4">
                <div class="form-group">
                    <select class="contacted_medium form-control" lead_id="<?=$lead[0]->id; ?>">
                       <option value="">Select Status</option>
                       <option value="Emailed" <?php if($lead[0]->contacted_medium == "Emailed"){echo "selected";} ?>>Emailed</option>
                       <option value="Prospectus Sent" <?php if($lead[0]->contacted_medium == "Prospectus Sent"){echo "selected";} ?>>Prospectus Sent</option>
                       <option value="Called" <?php if($lead[0]->contacted_medium == "Called"){echo "selected";} ?> >Called</option>
                       <option value="Whatsapp Done" <?php if($lead[0]->contacted_medium == "Whatsapp Done"){echo "selected";} ?> >Whatsapp Done</option>
                       <option value="Documents Collected" <?php if($lead[0]->contacted_medium == "Documents Collected"){echo "selected";} ?>>Documents Collected</option>

                       <option value="Online Application Done" <?php if($lead[0]->contacted_medium == "Online Application Done"){echo "selected";} ?>>Online Application Done</option>

                       <option value="Offer Letter Sent" <?php if($lead[0]->contacted_medium == "Offer Letter Sent"){echo "selected";} ?>>Offer Letter Sent</option>

                       <option value="Admission Fee Paid" <?php if($lead[0]->contacted_medium == "Admission Fee Paid"){echo "selected";} ?>>Admission Fee Paid</option>

                       <option value="Fee Receipt Sent" <?php if($lead[0]->contacted_medium == "Fee Receipt Sent"){echo "selected";} ?>>Fee Receipt Sent</option>

                       <option value="Admission Done" <?php if($lead[0]->contacted_medium == "Admission Done"){echo "selected";} ?>>Admission Done</option>

                       <option value="Junk Lead" <?php if($lead[0]->contacted_medium == "Junk Lead"){echo "selected";} ?>>Junk Lead</option>

                       <option value="Invalid Number" <?php if($lead[0]->contacted_medium == "Invalid Number"){echo "selected";} ?>>Invalid Number</option>

                       <option value="Lost" <?php if($lead[0]->contacted_medium == "Lost"){echo "selected";} ?>>Lost</option>

                       <option value="Lost" <?php if($lead[0]->contacted_medium == "Duplicate"){echo "selected";} ?>>Duplicate</option>

                       <option value="Transferred to Associate" <?php if($lead[0]->contacted_medium == "Transferred to Associate"){echo "selected";} ?>>Transferred to Associate</option>

                    </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <select class="staff_assigned form-control" lead_id="<?=$lead[0]->id; ?>">
                    <option value="">Assign Member</option>
                    <?php 
                    if($_SESSION['is_institute_in'])
                    { 
                      if(!empty($staffs))
                      foreach($staffs as $staff)
                      {
                      ?>
                        <option value="<?=$staff->employee_id; ?>" <?php if($staff->employee_id == $lead[0]->assign_to){echo "selected";} ?> class="text-capitalize"><?=$staff->employee_name; ?></option>
                      <?php
                      }
                    }
                    ?>
                    
                  </select>
                </div>
              </div>
              <div class="col-md-4 text-right">
                <a href="javascript:void(0)" class="btn btn-danger delete-lead" lead_id="<?=$lead[0]->id; ?>" ><i class="fa fa-trash"></i> Delete Lead</a>
                <a href="javascript:void(0)" class="btn btn-success edit-lead" lead_id="<?=$lead[0]->id; ?>" ><i class="fa fa-trash"></i> Edit Lead</a>
              </div>
            </div>

            <div class="row profile-box">
                <div class="col-md-5">
                    <div class="lead-info">
                      <h4 class="text-capitalize"><?=$lead[0]->student_name; ?></h4>
                      <span>Status : </span><?=$lead[0]->contacted_medium; ?>
                      <br/>
                      <span>Course Interested : </span><?=$lead[0]->course; ?>
                      <br/>
                      <span>Stream : </span><?=$lead[0]->stream; ?>
                      <br/>
                      <span>Email Id : </span><?= substr($lead[0]->email, 0, 4).'*******'.substr($lead[0]->email, strpos($lead[0]->email, "@")); ?>
                      <br/>
                      <span>Mobile : </span><?= substr($lead[0]->mobile, 0, 3) . "****" . substr($lead[0]->mobile, 7, 4); ?>
                      <br/>
                      <span>State : </span><?=$lead[0]->state; ?>
                      <br/>
                      <span>City : </span><?=$lead[0]->city; ?>
                      <br/>
                      
                      <div class="action-btns">
                      <span class="badge badge-success"><a href="javascript:void(0)" class="text-white activity" lead_id="<?=$lead[0]->id; ?>" message="Whatsapp Initiated" data-toggle="modal" data-target="#templateModal"><i class="fa fa-whatsapp"></i> Whatsapp</a></span>
                      <span class="badge badge-info"><a href="javascript:void(0)" onclick="makecall('<?=$lead[0]->mobile; ?>')"  message="Call Done" class="text-white activity" ><i class="fa fa-phone"></i> Call</a></span>
                      <span class="badge badge-danger"><a href="mailto:<?='+91'.$lead[0]->email; ?>" message="Email Sent" lead_id="<?=$lead[0]->id; ?>" class="text-white activity" ><i class="fa fa-envelope"></i> Email</a></span>
                      <span class="badge badge-primary"><a href="" lead_id="<?=$lead[0]->id; ?>" message="SMS Sent" class="text-white activity"><i class="fa fa-comment"></i> SMS</a></span>
                      </div>
                    </div>

                    <div class="lead-details">
                      <h4>Lead Details</h4>
                      <span class="text-success leadUpdate-success"></span>
                      <span class="text-danger leadUpdate-error"></span>
                      <br />
                      <span>Lead Type : </span>

                      <input type="radio" class='lead_type' name="lead_type" value="Hot" lead_id="<?=$lead[0]->id; ?>" <?php if($lead[0]->lead_type == "Hot"){echo 'checked';} ?> />Hot
                      <input type="radio" class='lead_type' name="lead_type" value="Warm" lead_id="<?=$lead[0]->id; ?>" <?php if($lead[0]->lead_type == "Warm"){echo 'checked';} ?> />Warm
                      <input type="radio" class='lead_type' name="lead_type" value="Cold" lead_id="<?=$lead[0]->id; ?>" <?php if($lead[0]->lead_type == "Cold"){echo 'checked';} ?> />Cold
                      <br/>
                      <span>Lead Status : </span><?=$lead[0]->contacted_medium; ?>
                      <br/>
                      
                      <span>Last Update Date : </span>
                      <?php 
                        if(!empty($lead[0]->updated_at)){
                          echo date('d-M-Y H:i A',strtotime($lead[0]->updated_at));
                        }
                      ?>
                      <br/>
                      <span>
                        Age of Lead : 
                      </span>
                      <?php 
                          $lead_date = date('d-m-Y',strtotime($lead[0]->created_at));
                          $curr_date = date('d-m-Y');
                          $datediff = ($curr_date-$lead_date);
                          echo $datediff.' Day(s)';
                        ?>
                      <br/>
                      <span class="sources">
                        Lead Source:
                      </span>

                      <input type="radio" name="lead_src" class='lead_sources' value="Facebook" lead_id="<?=$lead[0]->id; ?>" <?php if($lead[0]->lead_src == "Facebook"){echo 'checked';} ?> />Facebook
                      <input type="radio" class='lead_sources' name="lead_src" value="Google" lead_id="<?=$lead[0]->id; ?>" <?php if($lead[0]->lead_src == "Google"){echo 'checked';} ?> />Google
                      <input type="radio" class='lead_sources' name="lead_src" value="Linkedin" lead_id="<?=$lead[0]->id; ?>" <?php if($lead[0]->lead_src == "Linkedin"){echo 'checked';} ?> />Linkedin
                      <br/>
                      
                    </div>

                </div>
                <div class="col-md-7">
                  <div class="lead-tabs">
                    
                    <!-- Tab links -->
                    <div class="tab">
                      <button class="tablinks active" onclick="openCity(event, 'activity')" >Activity</button>
                      <button class="tablinks" onclick="openCity(event, 'comments')">Comments</button>
                      <button class="tablinks" onclick="openCity(event, 'reminder')">Reminders</button>
                      <button class="tablinks" onclick="openCity(event, 'academics')">Academics</button>
                    </div>

                    <!-- Tab content -->
                    <div id="activity" class="tabcontent" style="display:block">
                      <!--<form id="activity-form">-->
                      <!--  <label>Add Activity</label>-->
                      <!--  <textarea class="form-control lead_activity" name="activity"></textarea>-->
                      <!--  <div class="submit-con my-2">-->
                      <!--    <input type="hidden" value="<?=$lead[0]->id; ?>" class="lead_id" name="lead_id" />-->
                      <!--    <button type="submit" class="btn btn-primary">Save</button>-->
                      <!--  </div>-->
                      <!--  <span class="text-success activity-success"></span>-->
                      <!--  <span class="text-danger activity-error"></span>-->
                      <!--</form>-->
                       
                      <div class="activity-list records">
                        <?php  
                         
                        if(!empty($activities))
                        {
                          foreach($activities as $key=>$a)
                          {
                          ?>
                            <div class="activity-detail">

                              <div class="action-btns">
                                <span><?=date('d-M-Y H:i A',strtotime($a->created_at)) ?></span>
                                <!--<i class="fa fa-trash delete-btn text-danger" type="activity" act_id="<?=$a->activity_id ?>"></i>-->
                              </div>

                              <span class="comment-text">
                                <?=$a->activity; ?>
                              </span>
                            </div>
                          <?php
                          }
                        }
                        ?>
                        
                      </div>
                    </div>

                    <div id="comments" class="tabcontent">

                      <form id="comment-form">
                        <label>Student Comment</label>
                        <textarea class="form-control lead_comment" name="comment"></textarea>
                        <div class="submit-con my-2">
                          <input type="hidden" value="<?=$lead[0]->id; ?>" class="lead_id" name="lead_id" />
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <span class="text-success comment-success"></span>
                        <span class="text-danger comment-error"></span>
                      </form>

                      <div class="comments-list records">
                        <?php  
                        if(!empty($comments))
                        {
                          foreach($comments as $key=>$c)
                          {
                          ?>
                            <div class="comment-detail">

                              <div class="action-btns">
                                <span><?=date('d-M-Y H:i A',strtotime($c->created_at)) ?></span>
                                <i class="fa fa-trash delete-btn text-danger" type="comment" act_id="<?=$c->comment_id ?>"></i>
                              </div>

                              <span class="comment-text">
                                <?=$c->comment; ?>
                              </span>
                            </div>
                          <?php
                          }
                        }
                        ?>
                        
                      </div>

                    </div>

                    <div id="reminder" class="tabcontent">
                      <form id="reminder-form">
                        <div class="form-group">
                          <label>Reminder</label>
                          <textarea class="form-control reminder_content" name="reminder_content"></textarea>
                        </div>

                        <div class="row">
                          <div class="form-group col-md-6">
                          <label>Date</label>
                            <input type="date" class="form-control reminder_date" name="reminder_date" />
                          </div>
                          <div class="form-group col-md-6">
                            <label>Time</label>
                            <input type="time" class="form-control reminder_time" name="reminder_time" />
                          </div>
                        </div>
                        
                        <div class="submit-con my-2">
                          <input type="hidden" value="<?=$lead[0]->id; ?>" class="lead_id" name="lead_id" />
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <span class="text-success reminder-success"></span>
                        <span class="text-danger reminder-error"></span>
                      </form>

                      <div class="reminder-list records">
                        <?php  
                        if(!empty($reminders))
                        {
                          foreach($reminders as $key=>$r)
                          {
                          ?>
                            <div class="comment-detail">

                              <div class="action-btns">
                                <span><?=date('d-M-Y',strtotime($r->reminder_date)); ?></span> <span><?=date('H:i A',strtotime($r->reminder_time)); ?></span>
                                <i class="fa fa-trash delete-btn text-danger" type="reminder" act_id="<?=$r->reminder_id ?>"></i>
                              </div>

                              <span class="comment-text">
                                <?=$r->reminder_content; ?>
                              </span>
                            </div>
                          <?php
                          }
                        }
                        ?>
                        
                      </div>

                    </div>

                    <div id="academics" class="tabcontent">
                        <form id="academic-form">
                          <div class="form-group">
                            <label>Academic Details</label>
                            <textarea class="form-control academic_content" name="academic_content"></textarea>
                          </div>

                          <div class="submit-con my-2">
                            <input type="hidden" value="<?=$lead[0]->id; ?>" class="lead_id" name="lead_id" />
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                          <span class="text-success academic-success"></span>
                          <span class="text-danger academic-error"></span>
                        </form>

                        <div class="comments-list records">
                          <?php  
                          if(!empty($academics))
                          {
                            foreach($academics as $key=>$a)
                            {
                            ?>
                              <div class="academic-detail">

                                <div class="action-btns">
                                  <i class="fa fa-trash delete-btn text-danger" type="academic" act_id="<?=$a->academic_id ?>"></i>
                                </div>

                                <span class="academic-text">
                                  <?=$a->academic_content; ?>
                                </span>
                              </div>
                            <?php
                            }
                          }
                          ?>
                        </div>

                    </div>

                  </div>
                  <!--<a href="javascript:void(0)" onclick="hangcall('<?=$lead[0]->mobile; ?>')" class="btn btn-danger"><i class="fa fa-phone"></i> Call Hang Up</a>-->
                  
                </div>
                
            </div>
           </div>

         </div>

      </div>
   </div>
</div>

<!-- Whatsapp Templates Modal -->
<div class="modal fade" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Templates</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <a class="btn" data-toggle="collapse" href="#feeDue" role="button" aria-expanded="false" aria-controls="collapseExample">
          1. Welcome message
        </a>
        <div class="collapse" id="feeDue">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>,Thank you for showing interest for admission in <?=$lead[0]->stream; ?> at <?=$_SESSION['name'] ?> <?=$_SESSION['city'] ?>.
            For admissions you need to complete you application online. Check the online application URL:<?=$_SESSION['admission_link'] ?>  link to complete the online application form 

            You can also click on this video link to get a quick glimpse of life at our college video URL : <?=$_SESSION['youtube_link'] ?>

            Thanks
            Team Admissions
            <?=$_SESSION['name'] ?>. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p> 
            <a><i class="fa fa-send text-success welcome" href="javascript:void(0)" onclick="welcome('<?=$lead[0]->student_name; ?>' , '<?=$_SESSION['name'] ?>' , '<?=$_SESSION['city'] ?>' ,'<?=$_SESSION['admission_link'] ?>' , '<?=$_SESSION['youtube_link'] ?>' , '<?=$_SESSION['admin'] ?>' , '<?=$lead[0]->stream; ?>', '<?=$_SESSION['name'] ?>', '<?=$_SESSION['city'] ?>','<?=$lead[0]->mobile; ?>','Welcome Message',<?=$lead[0]->id; ?>)" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>

        <a class="btn" data-toggle="collapse" href="#feeDue" role="button" aria-expanded="false" aria-controls="collapseExample">
          2. Fee Due
        </a>
        <div class="collapse" id="feeDue">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>,Your course fee is pending in <?=$_SESSION['name']; ?>. Kindly pay your fee as soon as possible to avoid late fine, <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p> 
            <a><i class="fa fa-send text-success feedue" href="javascript:void(0)" onclick="feeduefunc('<?=$lead[0]->student_name; ?>'  , '<?=$_SESSION['payment_link'] ?>' ,'<?=$acount_details[0]->beneficiary ?>' , '<?=$acount_details[0]->account_no ?>' , '<?=$acount_details[0]->ifsc_code ?>' , '<?=$acount_details[0]->branch_name; ?>', '<?=$acount_details[0]->bank_name; ?>', '<?=$acount_details[0]->institute_name; ?>','<?=$lead[0]->mobile; ?>')" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#feePending" role="button" aria-expanded="false" aria-controls="collapseExample">
          3. Application Fee Pending
        </a>
        <div class="collapse" id="feePending">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, Thanks for taking online admission in our college. Kindly pay application fee .Payment Link : <?=$_SESSION['payment_link']; ?>. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?></p> 
            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, Thanks for taking online admission in our college. Kindly pay application fee .Payment Link : <?=$_SESSION['payment_link']; ?>. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#referEarn" role="button" aria-expanded="false" aria-controls="collapseExample">
          4. Refer and Earn
        </a>
        <div class="collapse" id="referEarn">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?> you can refer and earn scholarship upto 1 lakh by refering students in our college. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, you can refer and earn scholarship upto 1 lakh by refering students in our college. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#originalDocs" role="button" aria-expanded="false" aria-controls="collapseExample">
          5. Original Documents Collection
        </a>
        <div class="collapse" id="originalDocs">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, Kindly submit your original documents for verification in our college. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, Kindly submit your original documents for verification in our college. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>

        <a class="btn" data-toggle="collapse" href="#docsRequire" role="button" aria-expanded="false" aria-controls="collapseExample">
          6. Documents Required
        </a>
        <div class="collapse" id="docsRequire">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, Please share your following documents to proceed  your admission application. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, Please share your following documents to proceed  your admission application. 1. 10th / HS Marksheet 2. 10 / HS Admit card 3. Passport Size Colour Photo 4. 12th / SS Admit card or Marksheet. You can mail us on <?=$_SESSION['email']; ?> or send whatsaap on <?=$_SESSION['mobile']; ?>. Please Note: Be aware of Fake Promising Consultants , We suggest you to take Direct Online Admission to prevent any type of fake commitments. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        
        <a class="btn" data-toggle="collapse" href="#showingInterest" role="button" aria-expanded="false" aria-controls="collapseExample">
          7. Thanks for showing interest
        </a>
        <div class="collapse" id="showingInterest">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, thanks for showing interest in our college. Kindly meet us to become the associate in our college. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, thanks for showing interest in our college. Kindly meet us to become the associate in our college. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#leadClosure" role="button" aria-expanded="false" aria-controls="collapseExample">
          8. Lead Closure
        </a>
        <div class="collapse" id="leadClosure">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, unfortunately we couldnot process your admission in our college. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, unfortunately we couldnot process your admission in our college. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#lastDate" role="button" aria-expanded="false" aria-controls="collapseExample">
          9. Last Date of Admission
        </a>
        <div class="collapse" id="lastDate">
          <div class="card card-body d-flex flex-row">
            <div>
            <b>1. Within a Day</b>
              <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, last date of admission is within a day. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
            </div>
            <br/>
            <div>
            <b>2. Within a Week</b>
              <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, last date of admission is within a week. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
            </div>
            <br/>
            <div>
            <b>3. Within a Month</b>
              <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, last date of admission is within a month. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
            </div>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#notConnect" role="button" aria-expanded="false" aria-controls="collapseExample">
          10. Could not connect
        </a>
        <div class="collapse" id="notConnect">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, we called you regarding your admission unfortunately we could not connect on call.Please share your convenient time to get call back from our team. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, we called you regarding your admission unfortunately we could not connect on call.Please share your convenient time to get call back from our team. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#scholarship" role="button" aria-expanded="false" aria-controls="collapseExample">
          11. Scholarship Offer
        </a>
        <div class="collapse" id="scholarship">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, we value your effort for taking online/direct admission. You are eligible for scholarship on your merit basis. Kindly share your documents to know your eligible amount of scholarship. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, we value your effort for taking online/direct admission. You are eligible for scholarship on your merit basis. Kindly share your documents to know your eligible amount of scholarship. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#admsnPending" role="button" aria-expanded="false" aria-controls="collapseExample">
          12. Online admission pending
        </a>
        <div class="collapse" id="admsnPending">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, Your Online Admission is still pending with us . Kindly visit this link <?=$_SESSION['admission_link']; ?> and fill up all the details. And Proceed for Seat Booking Fee to get Admission Confirmation Letter. Please do not refresh the payment page. For any assistance call <?=$_SESSION['mobile']; ?> Thanks & Regards <?=$_SESSION['name']; ?> <?=$_SESSION['city']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, Your Online Admission is still pending with us . Kindly visit this link <?=$_SESSION['admission_link']; ?> and fill up all the details. And Proceed for Seat Booking Fee to get Admission Confirmation Letter. Please do not refresh the payment page. For any assistance call <?=$_SESSION['mobile']; ?> Thanks & Regards <?=$_SESSION['name']; ?>, <?=$_SESSION['city']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#finalFollowup" role="button" aria-expanded="false" aria-controls="collapseExample">
          13. Final followup
        </a>
        <div class="collapse" id="finalFollowup">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, If you are looking for your admission in our College Please Reply YES or NO. Our Admission Team will followup according to your interest . If Yes please pay the seat booking fee <?=$_SESSION['payment_link']; ?> ASAP as we have limited seats and scholarship amount will not be available anymore. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, If you are looking for your admission in our College Please Reply YES or NO. Our Admission Team will followup according to your interest . If Yes please pay the seat booking fee <?=$_SESSION['payment_link']; ?> ASAP as we have limited seats and scholarship amount will not be available anymore. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#socialLink" role="button" aria-expanded="false" aria-controls="collapseExample">
          14. Social Link Share
        </a>
        <div class="collapse" id="socialLink">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, to connect with us in social media please follow and subscribe our pages and channel Facebook Link URL: <?=$_SESSION['facebook_link']; ?> Instagram Link URL: <?=$_SESSION['facebook_link']; ?> Youtube Link URL: <?=$_SESSION['youtube_link']; ?> Google Business Link URL: <?=$_SESSION['google_business_link']; ?>. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, If you are looking for your admission in our College Please Reply YES or NO. Our Admission Team will followup according to your interest . If Yes please pay the seat booking fee <?=$_SESSION['payment_link']; ?> ASAP as we have limited seats and scholarship amount will not be available anymore. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>
        <br/>
        <a class="btn" data-toggle="collapse" href="#brochure" role="button" aria-expanded="false" aria-controls="collapseExample">
          15. Brochure Download Link
        </a>
        <div class="collapse" id="brochure">
          <div class="card card-body d-flex flex-row">
            <p>Dear <?=$lead[0]->student_name; ?>, to download our college brochure click the link URL : <?=$_SESSION['brochure_link']; ?>. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>

            <a target="_blank" href="https://wa.me/<?='+91'.$lead[0]->mobile; ?>?text=Dear <?=$lead[0]->student_name; ?>, to download our college brochure click the link URL : <?=$_SESSION['brochure_link']; ?>. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
          </div>
        </div>

      </div>
     
    </div>
  </div>
</div>
<!-- Whatsapp Templates Modal -->

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
                                Delete this Lead.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Student from the dashboard?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <form id="leadDeleteForm">
                                <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                                <input type="hidden" name="lead_id" value="<?=$lead[0]->id; ?>">
                                <button type="submit" class="btn btn-responsive YesDlt-btn">Yes Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="leadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Lead</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form id="staffform" method="POST" class="_formSubmit" action="<?php echo base_url('institute/edit_lead'); ?>">
           
            <div class="row">
                <div class="col-12 col-md-6 form-group">
                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Full Name<span class="text-danger">*</span></label>
                    <input id="name" type="text" name="name" class="form-control makeReqin" value="<?=$lead[0]->student_name; ?>" required autocomplete="new">
                </div>
          
                <div class="col-12 col-md-6 form-group">
                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">S/D/W of<span class="text-danger">*</span></label>
                    <input id="father_name" type="text" name="father_name" value="<?=$lead[0]->father_name; ?>" class="form-control makeReqin" required autocomplete="new">
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 form-group">
                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email Id.*</label>
                    <input id="email" type="text" name="email" value="<?=$lead[0]->email; ?>" class="form-control makeReqin" autocomplete="new">
                </div>
          
                <div class="col-12 col-md-6 form-group">
                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile*</label>
                    <input id="moble" type="number" name="mobile" value="<?=$lead[0]->mobile; ?>" class="form-control makeReqin" autocomplete="new">
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 form-group">
                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course*</label>
                      <select name="course" class="courses form-control makeReqin" >
                        <option value="">Select Course Interested</option>
                        <?php
                          foreach($courses as $course)
                          {
                        ?>
                          <option value="<?php echo $course->course_id; ?>" <?php if($course->course_name == $lead[0]->course){echo "selected";} ?>><?php echo $course->course_name; ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    <input type="hidden" class="course_name" name="course_name" value="<?=$lead[0]->course; ?>" />
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Stream*</label>
                    <select name="stream" class="streams form-control makeReqin" >
                      <option value="">Select Stream</option>
                      <?php  
                        if($lead[0]->stream)
                        {
                          echo '<option value="'.$lead[0]->stream.'" selected>'.$lead[0]->stream.'</option>';
                        }
                      ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 form-group">
                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">State*</label>
                    <select name="state" class="state form-control makeReqin" >
                      <option value="">Select State</option>
                      <?php
                        if(!empty($states))
                        {
                        foreach($states as $state)
                        {
                      ?>
                        <option value="<?php echo $state->id; ?>" <?php if($state->name == $lead[0]->state){echo "selected";} ?>><?php echo $state->name; ?></option>
                      <?php
                        }
                        }
                      ?>
                    </select>
                    <input type="hidden" class="state_name" name="state_name" value="<?= $lead[0]->state ?>" />

                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">City</label>
                    <select name="city" class="city form-control makeReqin" >
                      <option value="">Select City</option>
                      <?php  
                        if($lead[0]->city)
                        {
                          echo '<option value="'.$lead[0]->city.'" selected>'.$lead[0]->city.'</option>';
                        }
                      ?>
                    </select>
                </div>
            </div>
        
            <div class="row m-t-16">
                <div class="col-12 form-group">
                    <input type="hidden" name="lead_id" value="<?=$lead[0]->id; ?>" >
                    <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                    <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                    <button type="submit" class=" svebtn" style="float:right">Save</button>
                </div>
            </div>
        </form>
      </div>
     
    </div>
  </div>
</div>

<script>
     $(".courses").on('change',function(){
      var course_id = $(this).val();
      var course_name = $(".courses option:selected").html();
      $(".course_name").val(course_name);
      var institute_id = $(".institute_id").val();
      
      if(course_id != "")
      {
        $.ajax({
          type : 'POST',
          url : '<?=base_url(); ?>institute/getStreamsByCourse',
          data : {
            course_id : course_id,
            institute_id : institute_id
          },
          success : function(res){
            $(".streams").html(res);
          }
        });
      }
     });
</script>

<script>
    $(".state").on('change',function(){
        var state_id = $(this).val();
        var state_name = $( ".state option:selected" ).text();
        $(".state_name").val(state_name);
        $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/cityByState',
            data : {
                state_id : state_id,
            },
            success : function(res){
                $(".city").html(res);
            }
        });
    });
</script>

<script>
  $(".edit-lead").on("click",function(){
      var lead_id = $(this).attr('lead_id');
       // store status in activity panel
          $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/save_lead_activity',
            data : {
                lead_id : lead_id,
                message : 'Lead Edited',
            },
            success : function(res){
             
            },
        });
    $("#leadModal").modal('show');
  });
</script>


<script>
  $(".activity").on("click",function(){
      var lead_id = $(this).attr('lead_id');
      var message = $(this).attr('message');
       // store status in activity panel
          $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/save_lead_activity',
            data : {
                lead_id : lead_id,
                message : message,
            },
            success : function(res){
             
            },
        });
  });
</script>

<script>
  $(".lead_type").on("click",function(){
      var lead_id = $(this).attr('lead_id');
      var message = 'Lead Type Changed to '+$(this).val();
       // store status in activity panel
          $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/save_lead_activity',
            data : {
                lead_id : lead_id,
                message : message,
            },
            success : function(res){
             
            },
        });
  });
</script>

<script>
  $(".lead_sources").on("click",function(){
      var lead_id = $(this).attr('lead_id');
      var message = 'Lead Source Changed '+$(this).val();
       // store status in activity panel
          $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/save_lead_activity',
            data : {
                lead_id : lead_id,
                message : message,
            },
            success : function(res){
             
            },
        });
  });
</script>

<script>
  $(".staff_assigned").on('change',function(){
    var emp_id = $(this).val();
    var lead_id = $(this).attr('lead_id');
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/leadAssign',
      data : {
        emp_id : emp_id,
        lead_id : lead_id
      },
      success : function(res){
        var data = JSON.parse(res);
        if(data.status == false){
            vNotify.error({text:data.errormessage});
        }
        if(data.status == true){
            vNotify.success({text:data.message});
            $( ".error-message" ).remove();
            setTimeout(function(){
              window.location = location.href;
            },3000);
        }
      }
    });
  });
</script>

<script>
  $(".delete-lead").on('click',function(){
    $("#DeleteClientPopup").modal('show');
    $("#leadDeleteForm").submit(function(e){
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '<?=base_url(); ?>institute/delete_leads',
        data: $(this).serialize(),
        success: function(res){
          var data = JSON.parse(res);
          if(data.status == false){
              vNotify.error({text:data.errormessage});
              setTimeout(function(){
                window.location = location.href;
              },2000); 
          }
          if(data.status == true){
              vNotify.success({text:data.message});
              $( ".error-message" ).remove();
              setTimeout(function(){
                window.location = "<?=base_url(); ?>institute/leads_page";
              },2000);
          } 
        }
      })
    })
  });
</script>

<script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
</script>

<script>
  $("input[name=lead_type]").on('change',function(){
    var lead_type = $(this).val();
    var lead_id = $(this).attr('lead_id');
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/saveLeadType',
      data : {
        lead_type : lead_type,
        lead_id : lead_id,
      },
      success : function(res){
        var data = JSON.parse(res);
        var status = data.status;
        if(status == true)
        {

            $(".leadUpdate-success").html(data.message);
            setTimeout(function(){
                window.location = location.href;
            },4000);
        } else if(status == false){
            $(".leadUpdate-error").html(data.errormessage);
            setTimeout(function(){
                $(".leadUpdate-error").html('');
            },4000);
        }  
      }

    });
  });
</script>

<script>
  $("input[name=lead_src]").on('change',function(){
    var lead_src = $(this).val();
    var lead_id = $(this).attr('lead_id'); 
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/saveLeadSource',
      data : {
        lead_src : lead_src,
        lead_id : lead_id,
      },
      success : function(res){
        var data = JSON.parse(res);
        var status = data.status;
        if(status == true)
        {
            $(".leadUpdate-success").html(data.message);
            setTimeout(function(){
                window.location = location.href;
            },4000);
        } else if(status == false){
            $(".leadUpdate-error").html(data.errormessage);
            setTimeout(function(){
                $(".leadUpdate-error").html('');
            },4000);
        }  
      }

    });
  });
</script>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<script>
  $("#comment-form").submit(function(e){
    e.preventDefault();
    var comment = $(".lead_comment").val();
    var lead_id = $(".lead_id").val();
    if(comment != "")
    {
      $.ajax({
        type : 'POST',
        url : '<?=base_url(); ?>institute/save_lead_comment',
        data : $(this).serialize(),
        success : function(data){
            var data = JSON.parse(data);
            var status = data.status;
            if(status == true)
            {
                $(".comment-success").html(data.message);
                setTimeout(function(){
                    $(".comment-success").html('');
                },4000);
                getComments(lead_id);
            } else if(status == false){
                $(".comment-error").html(data.errormessage);
                setTimeout(function(){
                    $(".comment-error").html('');
                },4000);
            }  
        }
      });
    } else{
      alert("Comment must not be empty !");
    }
  });
</script>

<script>
  $("#activity-form").submit(function(e){
    e.preventDefault();
    var activity = $(".lead_activity").val();
    var lead_id = $(".lead_id").val();
    if(activity != "")
    {
      $.ajax({
        type : 'POST',
        url : '<?=base_url(); ?>institute/save_lead_activity',
        data : $(this).serialize(),
        success : function(data){
            var data = JSON.parse(data);
            var status = data.status;
            if(status == true)
            {
                $(".activity-success").html(data.message);
                setTimeout(function(){
                    $(".comment-success").html('');
                },4000);
                getActivities(lead_id);
            } else if(status == false){
                $(".activity-error").html(data.errormessage);
                setTimeout(function(){
                    $(".activity-error").html('');
                },4000);
            }  
        }
      });
    } else{
      alert("Activity must not be empty !");
    }
  });
</script>

<script>
  $("#academic-form").submit(function(e){
    e.preventDefault();
    var academic = $(".academic_content").val();
    var lead_id = $(".lead_id").val();
    
    if(academic != "")
    {
      $.ajax({
        type : 'POST',
        url : '<?=base_url(); ?>institute/save_lead_academic',
        data : $(this).serialize(),
        success : function(data){
            var data = JSON.parse(data);
            var status = data.status;
            if(status == true)
            {
                $(".academic-success").html(data.message);
                setTimeout(function(){
                    $(".academic-success").html('');
                },4000);
                getAcademics(lead_id);
            } else if(status == false){
                $(".academic-error").html(data.errormessage);
                setTimeout(function(){
                    $(".academic-error").html('');
                },4000);
            }  
        }
      });
    } else{
      alert("Comment must not be empty !");
    }
  });
</script>

<script>
//get all comments
  function getComments(lead_id)
  {
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/getLeadComments',
      data : {lead_id : lead_id},
      success : function(data){
        $(".comments-list").html(data);
      }
    });
  }

//get all academics
  function getAcademics(lead_id)
  {
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/getLeadAcademics',
      data : {lead_id : lead_id},
      success : function(data){
        $(".comments-list").html(data);
      }
    });
  }

//get all activities
  function getActivities(lead_id)
  {
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/getLeadActivities',
      data : {lead_id : lead_id},
      success : function(data){
        $(".activity-list").html(data);
      }
    });
  }

</script>

<script>
  $("#reminder-form").submit(function(e){
    e.preventDefault();
    var flag = 1;
    var reminder = $('.reminder_content').val();
    if(reminder.length < 1)
    {
      flag = 0;
      $('.reminder_content').after('<span class="text-danger">Reminder must not be empty !</span>');
      return false;
    } else{
      flag = 1;
    }

    var date = $('.reminder_date').val();
    if(date.length < 1)
    {
      flag = 0;
      $('.reminder_date').after('<span class="text-danger">Date must not be empty !</span>');
      return false;
    } else{
      flag = 1;
    }

    var time = $('.reminder_time').val();
    if(time.length < 1)
    {
      flag = 0;
      $('.reminder_time').after('<span class="text-danger">Time must not be empty !</span>');
      return false;
    } else{
      flag = 1;
    }
    var lead_id = $(".lead_id").val();
    if(flag == 1)
    {
      $.ajax({
        type : 'POST',
        url : '<?=base_url(); ?>institute/save_reminder',
        data : $(this).serialize(),
        success : function(data){
            var data = JSON.parse(data);
            var status = data.status;
            if(status == true)
            {
                $(".reminder-success").html(data.message);
                setTimeout(function(){
                    $(".reminder-success").html('');
                },4000);
                getReminders(lead_id);
            } else if(status == false){
                $(".reminder-error").html(data.errormessage);
                setTimeout(function(){
                    $(".reminder-error").html('');
                },4000);
            }  
        }
      });
    } else{
      alert("Something went wrong !");
    }
  });

  function getReminders(lead_id)
  {
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/getLeadReminders',
      data : {lead_id : lead_id},
      success : function(data){
        $(".reminder-list").html(data);
      }
    });
  }
</script>

<script>
  $(".records").on('click','.delete-btn',function(){
    var delete_btn = this;
    var act_id = $(this).attr('act_id');
    var act_type = $(this).attr('type');
    $.ajax({
      type : 'POST',
      url : '<?=base_url(); ?>institute/deleteLeadActions',
      data : {
        act_id : act_id,
        act_type : act_type
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
            $(delete_btn).parent().parent().remove();
        }
      }
    });

  });
</script>

<script>
$('.contacted_medium').on("change",function(){
    var medium = $(this).val();
    var lead_id = $(this).attr('lead_id');
    if(medium != "")
    {
        $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/change_contacted_medium',
            data : {
                medium : medium,
                lead_id : lead_id
            },
            success : function(res){
                var data = JSON.parse(res);
                if(data.status == false){
                  vNotify.error({text:data.errormessage});
                  setTimeout(function(){
                    window.location = location.href;
                  },2000); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    window.location = location.href;
                  },2000);
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }

        });
        // store status in activity panel
          $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/save_lead_activity',
            data : {
                medium : medium,
                lead_id : lead_id,
                message : 'Status Changed to '+medium,
            },
            success : function(res){
             
            },
            

        });
        
    }
});    
</script>

<script>
function welcome(student_name,name,city,admission_link,youtube_link,admin,stream,name1,city1,mobile,message,lead_id){
    $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/welcome_lead_whatsapp',
            data : {
                student_name : student_name,
                name : name,
                city : city,
                admission_link : admission_link,
                youtube_link : youtube_link,
                admin : admin,
                stream : stream,
                name1 : name1,
                city1 : city1,
                mobile: mobile,
            },
            success : function(res){
                var data = JSON.parse(res);
                if(data.status == false){
                  vNotify.error({text:data.errormessage});
                  setTimeout(function(){
            
                  },2000); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    
                  },2000);
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }

        });
    }
         // store status in activity panel
          $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/save_lead_activity',
            data : {
                lead_id : lead_id,
                message : 'whatsapp Done for '+message,
            },
            success : function(res){
             
            },
        });
        
        // for fee due notifications
        
        function feeduefunc(student_name,payment_link,beneficiary,account_no,ifsc_code,branch_name,bank_name,institute_name,mobile){
      
    $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/fee_due',
            data : {
                student_name : student_name,
                payment_link : payment_link,
                beneficiary : beneficiary,
                account_no : account_no,
                ifsc_code : ifsc_code,
                branch_name : branch_name,
                bank_name : bank_name,
                institute_name : institute_name,
                mobile: mobile,
              
            },
            success : function(res){
                console.log(res);
                var data = JSON.parse(res);
                if(data.status == false){
                  vNotify.error({text:data.errormessage});
                  setTimeout(function(){
            
                  },2000); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    
                  },2000);
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }

        });
   
}    


        // for fee due notifications
        
        function makecall(mobile){
      
            $.ajax({
                    type : 'POST',
                    url : '<?=base_url(); ?>institute/make_call',
                    data : {
                        mobile: mobile,
                      
                    },
                    success : function(res){
                        console.log(res);
                        var data = JSON.parse(res);
                        if(data.status == false){
                          vNotify.error({text:data.errormessage});
                          setTimeout(function(){
                    
                          },2000); 
                      }
                      if(data.status == true){
                          vNotify.success({text:data.message});
                          $( ".error-message" ).remove();
                          setTimeout(function(){
                            
                          },2000);
                      }
                    },
                    error: function(data){                      
                      $('#validation-error').html(data.message);
                    }
        
                });
           
        }   
        
                // for fee due notifications
        
        function hangcall(mobile){
      
            $.ajax({
                    type : 'POST',
                    url : '<?=base_url(); ?>institute/hang_call',
                    data : {
                        mobile: mobile,
                      
                    },
                    success : function(res){
                        console.log(res);
                        var data = JSON.parse(res);
                        if(data.status == false){
                          vNotify.error({text:data.errormessage});
                          setTimeout(function(){
                    
                          },2000); 
                      }
                      if(data.status == true){
                          vNotify.success({text:data.message});
                          $( ".error-message" ).remove();
                          setTimeout(function(){
                            
                          },2000);
                      }
                    },
                    error: function(data){                      
                      $('#validation-error').html(data.message);
                    }
        
                });
           
        } 

</script>
