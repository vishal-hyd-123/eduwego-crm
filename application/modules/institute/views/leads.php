<?php 

  if(isset($_SESSION['is_staff_in']))
  {
      $emp_id = $_SESSION['employee_id'];
      $institute_id = $_SESSION['institute_id'];
      $menus = $this->db->query("SELECT * FROM emp_menus WHERE institute_id = '".$institute_id."' AND emp_id = '".$emp_id."' ")->row();
  }
?>
<style type="text/css">
  
.studentActive ._sdf_ {
    color: #8A0A28 !important;
}

.imgcontent {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 180px;
}
/* Style the tab */
.tab {
  overflow: hidden;
  background-color: #f1f1f1;
  /*padding: 12px;*/
}

.tab button{
    padding: 3px 3px;
    margin: 5px;
    font-size: 13px;
    color: #8D294F;
    font-weight: bold;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #8D294F;
  color: white;
  cursor: pointer;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #8D294F;
  color: white;
}
.smsActive ._sdf_{
   color: #8A162B !important;
   }
   .smsselectbox
   {
   background: #FFFFFF;
   border: 1px solid #ECECEC;
   box-sizing: border-box;
   border-radius: 2px;
   width: 100%;
   height: 30px;
   color: #888888;
   }
   .title-header{
      background:#8E294F;
      height:70px;
      padding:20px;

    }

    .action-con i{
        cursor: pointer;
    }
    
    .csv-con .fa-calendar{
        font-size: 25px;
        cursor: pointer;
    }

    .csv-con input{
        border-radius: 7px;
    }

    #myTable td,th{
        padding: 7px;
    }

    #fbLeadsTable td,th{
        padding: 7px;
    }

    ul {
  list-style: none;
}
.container {
  max-width: 960px;
  padding-left: 60px;
  padding-right: 60px;
  margin: 0 auto;
}
.tab {
  margin: 0 0 2em;
}
.tabs-btn {
  display: flex;
  justify-content: center;
  margin-bottom: 0 !important;
}
.tab-btn {
  flex: 1;
  color: #333;
  text-align: center;
  padding: 1em 2em;
  background-color: #d0ddec;
  /*border: 1px solid #000;*/
  /*border-radius: 10px 10px 0 0;*/
  cursor: pointer;
}
.tab-btn:not(:last-of-type) {
  border-right: 0;
}
.tab-content {
  display: none;
  padding: 1em;
  /*border: 1px solid #000;*/
  border-top: 0;
  background-color: #fff;
}

/* tab open */
.tab-btn.tab-open {
  font-weight: bold;
  background-color: #fff;
  border-bottom: 0;

  transition: 0.3s;
}
.tab-content.tab-open {
  display: block;
}
   
</style>
<?php  
    $total = array();
    $untouched = array();
    $emailed = array();
    $prospectus = array();
    $called = array();
    $whatsapp = array();
    $docs = array();
    $online_apps = array();
    $offer_letter = array();
    $admission_fee = array();
    $junk = array();
    $invalid = array();
    $lost = array();
    $transfered = array();
    $duplicate = array();
    $total_lead = array();

    if(!empty($leads))
    {
        
        foreach($leads as $key=>$lead)
        {
            $total_lead[] = $lead->id;
            if($lead->contacted_medium == "")
            {
                $untouched[] = $lead->id;
            }
            if($lead->contacted_medium == "Emailed")
            {
                $emailed[] = $lead->id;
            }

            if($lead->contacted_medium == "Prospectus Sent")
            {
                $prospectus[] = $lead->id;
            }

            if($lead->contacted_medium == "Called")
            {
                $called[] = $lead->id;
            }

            if($lead->contacted_medium == "Whatsapp Done")
            {
                $whatsapp[] = $lead->id;
            }
            if($lead->contacted_medium == "Documents Collected")
            {
                $docs[] = $lead->id;
            }

            if($lead->contacted_medium == "Online Application Done")
            {
                $online_apps[] = $lead->id;
            }

            if($lead->contacted_medium == "Offer Letter Sent")
            {
                $offer_letter[] = $lead->id;
            }

            if($lead->contacted_medium == "Admission Fee Paid")
            {
                $admission_fee[] = $lead->id;
            }
            if($lead->contacted_medium == "Junk Lead")
            {
                $junk[] = $lead->id;
            }

            if($lead->contacted_medium == "Invalid Number")
            {
                $invalid[] = $lead->id;
            }

            if($lead->contacted_medium == "Lost")
            {
                $lost[] = $lead->id;
            }

            if($lead->contacted_medium == "Duplicate")
            {
                $duplicate[] = $lead->id;
            }

            if($lead->contacted_medium == "Transferred to Associate")
            {
                $transfered[] = $lead->id;
            }
        }
    }
?>
<div id="content" class="flex ">
    <div class="title-header">
        <div>
            <span>
                <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-check-square-o"></i> LEADS</h3>
            </span>
        </div>
    </div>

    <div class="page-container" id="page-container">

    <div class="mobile-leads">

      <div class="container-fluid">
        
        <div class="row justify-content-center">
          <?php  
          if(!empty($leads))
          {
              $sl = 1;
              foreach($leads as $key=>$lead)
              {
                  $lead_id = base64_encode($lead->id);
              ?>
              <div class="col-11 card">
                <div class="row justify-content-evenly card2 m-2">
                  <div class="col-2 profile text-center">
                    <?=$sl++; ?>
                  </div>
                  <div class="col-6 info basic-detail">
                    <h6 class="text-capitalize"><?=$lead->student_name; ?></h6>
                    <p><?=$lead->email; ?></p>
                    <p><?="+91".$lead->mobile; ?></p>
                  </div>
                  <div class="col-4 text-center d-flex">
                    <div class="circle-menu">
                      <a href="tel:+91<?=$lead->mobile; ?>"><i class="fa fa-phone"></i></a>
                    </div>
                    <div class="circle-menu">
                      <a href="https://wa.me/<?='+91'.$lead->mobile ?>?text=Dear <?=$lead->student_name; ?> , Thanks for Showing Interest in <?=$lead->stream; ?> in <?=$_SESSION['name']; ?> Our Online Admission Team will get in touch with you shortly. Kindly Share your documents to assist you further. Thanks & Regards" target="_blank"><i class="fa fa-whatsapp text-success"></i></a>
                    </div>
                    <div class="circle-menu">
                      <i class="dropdown-toggle" data-toggle="dropdown"></i>
                      <ul class="dropdown-menu text-left">
                          <li><a href="##">Select Status</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Emailed&leadId=<?=$lead_id;?>">Emailed</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Prospectus Sent&leadId=<?=$lead_id;?>">Prospectus Sent</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Called&leadId=<?=$lead_id; ?>">Called</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Whatsapp Done&leadId=<?=$lead_id; ?>">Whatsapp Done</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Documents Collected&leadId=<?=$lead_id; ?>">Documents Collected</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Online Application Done&leadId=<?=$lead_id; ?>">Online Application Done</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Admission Fee Paid&leadId=<?=$lead_id; ?>">Admission Fee Paid</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Fee Receipt Sent&leadId=<?=$lead_id;?>">Fee Receipt Sent</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Admission Done&leadId=<?=$lead_id;?>">Admission Done</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Junk Lead&leadId=<?=$lead_id;?>">Junk Lead</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Invalid Number&leadId=<?=$lead_id;?>">Invalid Number</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Lost&leadId=<?=$lead_id;?>">Lost</a></li>
                          <li><a href="<?=base_url();?>institute/updateLeadStatus?status=Transferred to Associate&leadId=<?=$lead_id;?>">Transferred to Associate</a></li>
                      </ul>
                    </div>
                  </div>
                  
                  <div class="row card-footer m-2 p-1">
                    <div class="col-4 bl text-center">
                      <h5>Course</h5> 
                      <p><?=$lead->stream; ?></p>
                    </div>
                    <div class="col-4 bl text-center">
                      <h5>Lead Status</h5> 
                      <p><?=$lead->contacted_medium; ?></p> 
                    </div>
                    <div class="col-4 bl text-center">
                      <h5>Date & Time</h5>
                      <p>
                          <?=date('d-M-Y',strtotime($lead->created_at)); ?><br>
                          <?=date('H:i A',strtotime($lead->created_at)); ?>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
              <?php
              }
          }
          ?>
          
        </div>
      </div>
    </div>

    <div class="desktop-leads mt-4">
        
        <div class="shadow-lg" style="background:white">
            <div class="">

              <div class="tab">
                <ul class="tabs-btn">
                  <li class="tab-btn">Web Leads</li>
                  <li class="tab-btn">Facebook Leads</li>
                  <li class="tab-btn">Import Leads</li>
                </ul>
                <div class="tabs-content">
                  <div class="tab-content">
                    <div id="lead-filters">
                        <?php if($_SESSION['is_institute_in']){ ?>
                        <div class="lead-filter csv-con">
                          <div class="col-12">
                            <div class="row">
                            
                                <div class="col-md-4">
                                    <select class="export-leads time-frame form-control">
                                        <option value="">Select</option>
                                        <option value="1">Today</option>
                                        <option value="7">This Week</option>
                                        <option value="30">This Month</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>
                                <div class="col-md-1">OR</div>
                                <div class="col-md-3">
                                    <input type="date" class="selected_date form-control" name="selected_date" />
                                </div>
                                <div class="col-md-2 text-right">
                                    <a href="javascript:void(0)" class="btn btn-success csv-btn"><i class="fa fa-download"></i> DOWNLOAD CSV</a> 
                                </div>
                                <div class="col-md-2">
                                    <a href="javascript:void(0)" class="btn btn-primary add-lead-btn"><i class="fa fa-plus-circle"></i> Add Lead</a>
                                </div>
                                
                            </div>
                          </div>
                        </div>

                        <?php } ?>
                        <!-- Tab links -->
                        <div class="filtertab">
                          <button class="tablinks status active" type="All">All(<?=count($total_lead); ?>)</button>
                          <button class="tablinks status" type="Untouched">Untouched(<?=count($untouched); ?>)</button>
                          <button class="tablinks status" type="Emailed">Emailed(<?=count($emailed); ?>)</button>
                          <button class="tablinks status" type="Prospectus Sent">Prospectus Sent(<?=count($prospectus); ?>)</button>
                          <button class="tablinks status" type="Called">Called(<?=count($called); ?>)</button>
                          <button class="tablinks status" type="Whatsapp Done">Whatsapp Done(<?=count($whatsapp); ?>)</button>
                          <button class="tablinks status" type="Documents Collected">Documents Collected(<?=count($docs); ?>)</button>
                          <button class="tablinks status" type="Online Application Done">Online Application Done(<?=count($online_apps); ?>)</button>
                          <button class="tablinks status" type="Offer Letter Sent">Offer Letter Sent(<?=count($offer_letter); ?>)</button>
                          <button class="tablinks status" type="Admission Fee Paid">Admission Fee Paid(<?=count($admission_fee); ?>)</button>
                          <button class="tablinks status" type="Junk Lead">Junk Lead(<?=count($junk); ?>)</button>
                          <button class="tablinks status" type="Invalid Number">Invalid Number(<?=count($invalid); ?>)</button>
                          <button class="tablinks status" type="Lost">Lost(<?=count($lost); ?>)</button>
                          <button class="tablinks status" type="Duplicate">Duplicate(<?=count($duplicate); ?>)</button>
                          <button class="tablinks status" type="Transferred to Associate">Transferred to Associate(<?=count($transfered); ?>)</button>
                        </div>
                        <ul>
                    </div>
                    <div style="overflow-x:scroll">
                        <table id="leadTable" class="table-bordered table-responsive" role="grid" aria-describedby="clientTable_info">
                           
                            <thead>
                                <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Sl No.</span></th>
                                <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Student Name</span></th>
                                <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Mobile</span></th>
                                
                                <th width="80px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Stream</span></th>
                          
                                <th width="80px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">City</span></th>
                                <th width="92px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Date & Time</span></th>
                                <?php if($_SESSION['is_institute_in']){ ?>
                                <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Assigned to</span></th>
                                <?php } ?>
                                <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Offer Letter</span></th>
                                <th style="width:170px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Status</span></th>
                                <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Actions</span></th>
                            </thead>
                            <tbody id="tableBody " class="stu_fees_table">
                                <?php
                                $sl = 1;
                                foreach($leads as $lead)
                                {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="item-except _greyClr_ _fs14_"><?php echo $sl++; ?></div>
                                        </td>
                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ text-capitalize stu_name"><?php echo $lead->student_name; ?></div>
                                        </td>
                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ mobile"><?php echo substr($lead->mobile, 0, 3) . "****" . substr($lead->mobile, 7, 4); ?></div>
                                        </td>

                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ yoa text-capitalize"><?php echo $lead->stream; ?></div>
                                        </td>

                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ yoa text-capitalize"><?php echo $lead->city; ?></div>
                                        </td>

                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ yoa text-capitalize">
                                            <?php 
                                            if(!empty($lead->created_at))
                                            {
                                                echo date('d-M-Y',strtotime($lead->created_at))."<br>";
                                                echo date('h:i A',strtotime($lead->created_at));
                                            } else{
                                                echo "-";
                                            }
                                            ?>
                                                    
                                            </div>
                                        </td>

                                        <?php if($_SESSION['is_institute_in']){ ?>
                                         <td>
                                            <div class="item-except _greyClr_ _fs14_">
                                            <select class="staff_assigned form-control" lead_id="<?=$lead->id; ?>">
                                              <option value="">Select Employee</option>
                                               <?php  
                                               if(!empty($staffs))
                                               {
                                                foreach($staffs as $staff)
                                                {
                                                  ?>
                                                  <option value="<?=$staff->employee_id; ?>" <?php if($staff->employee_id == $lead->assign_to){echo "selected";} ?> class="text-capitalize"><?=$staff->employee_name; ?></option>
                                                  <?php
                                                }
                                               }
                                               ?>
                                            </select>
                                            </div>
                                        </td>
                                        <?php } ?>

                                        <td style="text-align:center">
                                           <a href="<?=base_url(); ?>institute/offerLetter/<?=base64_encode($lead->id) ?>"><i class="fa fa-envelope"></i></a>
                                        </td>

                                        <td>
                                            <select class="contacted_medium form-control" lead_id="<?=$lead->id; ?>">
                                               <option value="">Select Status</option>
                                               <option value="Emailed" <?php if($lead->contacted_medium == "Emailed"){echo "selected";} ?>>Emailed</option>
                                               <option value="Prospectus Sent" <?php if($lead->contacted_medium == "Prospectus Sent"){echo "selected";} ?>>Prospectus Sent</option>
                                               <option value="Called" <?php if($lead->contacted_medium == "Called"){echo "selected";} ?> >Called</option>
                                               <option value="Whatsapp Done" <?php if($lead->contacted_medium == "Whatsapp Done"){echo "selected";} ?> >Whatsapp Done</option>
                                               <option value="Documents Collected" <?php if($lead->contacted_medium == "Documents Collected"){echo "selected";} ?>>Documents Collected</option>

                                               <option value="Online Application Done" <?php if($lead->contacted_medium == "Online Application Done"){echo "selected";} ?>>Online Application Done</option>

                                               <option value="Offer Letter Sent" <?php if($lead->contacted_medium == "Offer Letter Sent"){echo "selected";} ?>>Offer Letter Sent</option>

                                               <option value="Admission Fee Paid" <?php if($lead->contacted_medium == "Admission Fee Paid"){echo "selected";} ?>>Admission Fee Paid</option>

                                               <option value="Fee Receipt Sent" <?php if($lead->contacted_medium == "Fee Receipt Sent"){echo "selected";} ?>>Fee Receipt Sent</option>

                                               <option value="Admission Done" <?php if($lead->contacted_medium == "Admission Done"){echo "selected";} ?>>Admission Done</option>

                                               <option value="Junk Lead" <?php if($lead->contacted_medium == "Junk Lead"){echo "selected";} ?>>Junk Lead</option>

                                               <option value="Invalid Number" <?php if($lead->contacted_medium == "Invalid Number"){echo "selected";} ?>>Invalid Number</option>

                                               <option value="Lost" <?php if($lead->contacted_medium == "Lost"){echo "selected";} ?>>Lost</option>

                                               <option value="Lost" <?php if($lead->contacted_medium == "Duplicate"){echo "selected";} ?>>Duplicate</option>

                                               <option value="Transferred to Associate" <?php if($lead->contacted_medium == "Transferred to Associate"){echo "selected";} ?>>Transferred to Associate</option>

                                            </select>
                                        </td>

                                        <td class="text-center">
                                           <div class="item-except _greyClr_ _fs14_ text-capitalize stu_name action-con">

                                                <a target="_blank" href="<?=base_url(); ?>institute/lead_details/<?=$lead->id; ?>"><i class="fa fa-eye text-success"  style="font-size:20px" ></i></a>

                                                <?php
                                                if($_SESSION['is_institute_in'])
                                                {
                                                  ?>
                                                    <i class="fa fa-trash text-danger" onclick="delete_leads(<?php echo $lead->id; ?>)" style="font-size:20px" ></i>
                                                  <?php
                                                }else if($_SESSION['is_staff_in'])
                                                { 
                                                  if($menus->leads_delete == 'on')
                                                  { 
                                                  ?>
                                                    <i class="fa fa-trash text-danger" onclick="delete_leads(<?php echo $lead->id; ?>)" style="font-size:20px" ></i>
                                                  <?php 
                                                  }
                                                }
                                                ?>
                                            </div> 
                                        </td>
                                        
                                    </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                  </div>

                  <div class="tab-content">
                    <a href="<?=base_url(); ?>institute/updateFbLeads?tab=fb" class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>
                   <table id="fbLeadsTable" class="dataTable table-bordered table-responsive fbLeadsTable" role="grid" aria-describedby="clientTable_info">
                        <thead>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Sl No.</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Name</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Email</span></th> 
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Phone</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Course</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Address</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Status</span></th>
                        </thead>
                        <tbody>
                           <?php  
                            if($allFbLeads)
                            {
                                foreach($allFbLeads as $key=>$fb)
                                {
                                ?>
                                <tr>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_ text-capitalize"><?=($key+1); ?></div>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_ text-capitalize"><?=$fb->name; ?></div>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_ text-capitalize"><?=$fb->email; ?></div>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_ text-capitalize"><?=$fb->phone; ?></div>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_ text-capitalize"><?=$fb->course; ?></div>
                                    </td>
                                    <td>
                                        <div class="item-except _greyClr_ _fs14_ text-capitalize"><?=$fb->address; ?></div>
                                    </td>
                                    <td>
                                        <select class="lead_status form-control" lead_id="<?=$fb->lead_id; ?>">
                                           <option value="">Select Status</option>
                                           <option value="Emailed" <?php if($fb->status == "Emailed"){echo "selected";} ?>>Emailed</option>
                                           <option value="Prospectus Sent" <?php if($fb->status == "Prospectus Sent"){echo "selected";} ?>>Prospectus Sent</option>
                                           <option value="Called" <?php if($fb->status == "Called"){echo "selected";} ?> >Called</option>
                                           <option value="Whatsapp Done" <?php if($fb->status == "Whatsapp Done"){echo "selected";} ?> >Whatsapp Done</option>
                                           <option value="Documents Collected" <?php if($fb->status == "Documents Collected"){echo "selected";} ?>>Documents Collected</option>

                                           <option value="Online Application Done" <?php if($fb->status == "Online Application Done"){echo "selected";} ?>>Online Application Done</option>

                                           <option value="Offer Letter Sent" <?php if($fb->status == "Offer Letter Sent"){echo "selected";} ?>>Offer Letter Sent</option>

                                           <option value="Admission Fee Paid" <?php if($fb->status == "Admission Fee Paid"){echo "selected";} ?>>Admission Fee Paid</option>

                                           <option value="Fee Receipt Sent" <?php if($fb->status == "Fee Receipt Sent"){echo "selected";} ?>>Fee Receipt Sent</option>

                                           <option value="Admission Done" <?php if($fb->status == "Admission Done"){echo "selected";} ?>>Admission Done</option>

                                           <option value="Junk Lead" <?php if($fb->status == "Junk Lead"){echo "selected";} ?>>Junk Lead</option>

                                           <option value="Invalid Number" <?php if($fb->status == "Invalid Number"){echo "selected";} ?>>Invalid Number</option>

                                           <option value="Lost" <?php if($fb->status == "Lost"){echo "selected";} ?>>Lost</option>

                                           <option value="Transferred to Associate" <?php if($fb->status == "Transferred to Associate"){echo "selected";} ?>>Transferred to Associate</option>

                                        </select>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                           ?>
                        </tbody>
                        </table>
                  </div>
                  
                  <div class="tab-content">
                    <div id="lead-filters">
                        <?php if($_SESSION['is_institute_in']){ ?>
                        <div class="lead-filter csv-con">
                          <div class="col-12">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <a href="<?=base_url();?>uploads/csv/import-lead-sample.csv" class="btn btn-success"><i class="fa fa-download"></i> DOWNLOAD SAMPLE CSV</a> 
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:void(0)" class="btn btn-primary import-lead-btn"><i class="fa fa-plus-circle"></i> IMPORT LEAD</a>
                                </div>
                                
                            </div>
                          </div>
                        </div>

                        <?php } ?>
                        <!-- Tab links -->
                    </div>
                    <div style="overflow-x:scroll">
                        <table id="Importlead" class="table-bordered table-responsive" role="grid" aria-describedby="clientTable_info">
                           
                            <thead>
                                <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Sl No.</span></th>
                                <th width="180px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Student Name</span></th>
                                <th width="180px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Mobile</span></th>
                                
                                 <th width="180px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Email</span></th>
                                
                                <th width="180px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Stream</span></th>
                          
                                <th width="180px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">City</span></th>
                                <th width="180px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">State</span></th>
                                <th width="92px"><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Date & Time</span></th>
                                
                                <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Actions</span></th>
                            </thead>
                            <tbody id="tableBody " class="stu_fees_table">
                                <?php
                                $sl = 1;
                                foreach($importleads as $lead)
                                {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="item-except _greyClr_ _fs14_"><?php echo $sl++; ?></div>
                                        </td>
                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ text-capitalize stu_name"><?php echo $lead->name; ?></div>
                                        </td>
                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ mobile"><?php echo substr($lead->phone, 0, 3) . "****" . substr($lead->phone, 7, 4); ?></div>
                                        </td>

                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ yoa text-capitalize"><?php echo $lead->email; ?></div>
                                        </td>

                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ yoa text-capitalize"><?php echo $lead->qualification; ?></div>
                                        </td>
                                        
                                          <td>
                                            <div class="item-except _greyClr_ _fs14_ yoa text-capitalize"><?php echo $lead->city; ?></div>
                                        </td>
                                        
                                          <td>
                                            <div class="item-except _greyClr_ _fs14_ yoa text-capitalize"><?php echo $lead->state; ?></div>
                                        </td>

                                        <td>
                                            <div class="item-except _greyClr_ _fs14_ yoa text-capitalize">
                                            <?php 
                                            
                                            if(!empty($lead->created_at))
                                            {
                                                echo date('d-M-Y',strtotime($lead->created_at))."<br>";
                                                echo date('h:i A',strtotime($lead->created_at));
                                            } else{
                                                echo "-";
                                            }
                                            ?>
                                                    
                                            </div>
                                        </td>

                          
                                        <td style="text-align:center">
                                           <a target="_blank" href="https://wa.me/<?='+91'.$lead->phone; ?>?text=Hello , Greetings from <?=$_SESSION['name']; ?>, Admissions are open for Academic Year <?= date('Y') ?> For More Details Please Contact <?=$_SESSION['admin']; ?>  <?=$_SESSION['mobile']; ?>"><i style="font-size: 25px;color:green" class="fa fa-whatsapp"></i></a>
                                           
                                           <a href="tel:<?= $lead->phone; ?>"><i style="font-size: 25px;" class="fa fa-phone"></i></a>
                                        </td>

                            
                                        
                                    </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                  </div>
                  
                </div>
              </div>
              
            </div>

        </div>

    </div>
    </div>
</div>
<!--------------------------------------------------------popup----------------------------------------- -->
<div class="modal Modal_ student_modal" id="opnpopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Student</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="fee_collect_form" method="POST" class="_formSubmit" action="<?php echo base_url('institute/'); ?>">
                    <div class="row">
                        <div class="col-12 text-center">
                        
                            <div style="width: 100%; height: auto;">
                                <div class="imgcontent text-center" style="width: 180px;height: auto; text-align: center;">
                                    <img class="blah" id="blah" src="<?php echo base_url(); ?>assets/dashboard/img/person2.jpg" style="width: 100%;">
                                </div>

                                <input type="file" name="image" accept="Images/*" id="expertProfile" hidden="">
                                <label for="expertProfile" class="_fntwss_ _fwg500_ _wtClr_ _bgmhrnG_ btn btn-responsive mt15 upload-btn">Upload Photo</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Full Name*</label>
                            <input id="name" type="text" name="name" class="form-control makeReqin" required autocomplete="new">
                        </div>
                   
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">S/D/W of*</label>
                            <input id="lastname" type="text" name="lastname" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div><!-- row -->
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Email*</label>
                            <input id="email" type="email" name="email" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="inputEmail3" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Qualification*</label>
                            <input id="qualification" type="text" name="qualification" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div><!-- row -->
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>
                            <input id="number" type="text" name="number" class="form-control makeReqin" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Address</label>
                            <textarea id="address" name="address" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required autocomplete="new" style="height: 109px;"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Associates Name</label>
                            <!-- <input id="reffered" type="text" name="reffered" class="form-control makeReqin" autocomplete="new"> -->
                            <select id="agent_name" name="agent_name" class="form-control makeReqin" autocomplete="new">
                               <?php
                                    $enq = $this->institute_model->getAllActiveAgents();
                                    for ($i = 0; $i < count($enq); $i++) {

                                    ?>
                                        <option value="<?php echo $enq[$i]->agent_id; ?>"><?php echo $enq[$i]->agent_name; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Stream Applied For</label>
                            <select id="atreamapply" name="stream" class="form-control makeReqin" autocomplete="new">
                               <?php
                                    $enq = $this->institute_model->getAllActiveStreams();
                                    for ($i = 0; $i < count($enq); $i++) {


                                    ?>
                                        <option value="<?php echo $enq[$i]->stream_name; ?>"><?php echo $enq[$i]->stream_name; ?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Admission Year</label>
                            <input id="admissionyer" type="text" name="admissionyer" class="form-control makeReqin date" autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Reffered By</label>
                            <select id="refferedBy" name="refferedBy" class="form-control makeReqin" autocomplete="new">
                                <option value="Online">Online</option>
                                <option value="Google ads">Google ads</option>
                                <option value="Facebook ads ">Facebook ads </option>
                                <option value="Student ">Student </option>
                                <option value="Parent ">Parent </option>
                                <option value="Management ">Management </option>
                                <option value="Staff ">Staff </option>
                                <option value="Campus Walkin ">Campus Walkin </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Total Package(INR)</label>
                            <input id="package" type="number" name="package" class="form-control makeReqin date" autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course Duration in Year(s)</label>
                            <input id="course_dur" type="number" name="course_dur" class="form-control makeReqin date" autocomplete="new">
                        </div>
                    </div>
                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="student_id" id="student_id">
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
<!-- / .modal -->

<div class="modal Modal_ add_lead_modal" id="addLeadModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Lead</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="fee_collect_form" method="POST" class="_formSubmit" action="<?php echo base_url('institute/studentSignup'); ?>">
                    
                    <div class="row">
                        <div class="col-md-6">
                            Student Name <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="text" name="student_name" placeholder="Full Name" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            Father Name <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="text" name="father" placeholder="Father Name" class="form-control" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            Email Id
                            <br>
                            <input type="email" name="email" placeholder="Email Address" class="form-control" placeholder="Enter your Email Id">
                        </div>
                        <div class="col-md-6">
                            Phone/Mobile <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="number" name="mobile" class="form-control" id="mobile" placeholder="10 Digit phone number">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            States<span class="ast" style="color:red;"> * </span>
                            <br>
                            <select name="state" class="state form-control" >
                              <option value="">Select State</option>
                              <?php
                                if(!empty($states))
                                {
                                    print_r($states);
                                foreach($states as $state)
                                {
                              ?>
                                <option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
                              <?php
                                }
                                }
                              ?>
                            </select>
                            <input type="hidden" class="state_name" name="state_name" />
                        </div>
                        <div class="col-md-6">
                            City <span class="ast" style="color:red;"> * </span>
                            <br>
                            <select name="city" class="city form-control" >
                              <option value="">Select City</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            Select Course <span class="ast" style="color:red;"> * </span>
                            <br>
                            <select name="course" class="courses form-control" >
                              <option value="">Select Course Interested</option>
                              <?php
                                foreach($courses as $course)
                                {
                              ?>
                                <option value="<?php echo $course->course_id; ?>"><?php echo $course->course_name; ?></option>
                              <?php
                                }
                              ?>
                            </select>
                            <input type="hidden" class="course_name" name="course_name" />
                        </div>
                        <div class="col-md-6">
                            Select Stream <span class="ast" style="color:red;"> * </span>
                            <br>
                            <select name="stream" class="streams form-control" >
                              <option value="">Select Stream</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row my-4">
                        <div class="col-12">
                            <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                            <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                            <button type="submit" class="svebtn" style="float:right">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal Modal_ add_lead_modal" id="ImportLeadModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Import Lead</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="fee_collect_form" method="POST" action="<?php echo base_url('institute/csv'); ?>" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-6">
                            Upload File <span class="ast" style="color:red;"> * </span>
                            <br>
                            <input type="file" name="userfile" />
                        </div>
                        
                    </div>

                    <div class="form-group row my-4">
                        <div class="col-12">
                            <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                            <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                            <button type="submit" class="svebtn" style="float:right">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(".add-lead-btn").on('click',function(){
        $("#addLeadModal").modal('show');
    });
</script>

<script>
    $(".import-lead-btn").on('click',function(){
        $("#ImportLeadModal").modal('show');
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
//student signup / student online enquiry 
  $("#studentSignup").submit(function(e){
    e.preventDefault();
    var data   = $(this).serialize();
    var action = $(this).attr('action');
    var method = $(this).attr('method');
    
    $.ajax({
     type: method,
     url:action,
     data: data,
     success: function(res){
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
            $(".streams").append(res);
          }
        });
      }
     });
</script>

<script>
$(document).ready(function(){
    fill_datatable();
    function fill_datatable(lead_status = ''){
       var dataTable = $('#leadTable').DataTable({
            "processing" : true,
            "serverSide" : false,
            "order" : [],
            "searching" : true,
            "ajax" : {
                url : '<?=base_url(); ?>institute/fetchLeads',
                type : 'POST',
                data : {lead_status : lead_status}
            }
       }); 
    }

    $(".filtertab .tablinks").on('click',function(){
        var lead_status = $(this).attr('type');
        if(lead_status != '')
        {
            if(lead_status == 'All')
            {
                lead_status = "";
                $('#leadTable').DataTable().destroy();
                fill_datatable(lead_status);
            }else{
                $('#leadTable').DataTable().destroy();
                fill_datatable(lead_status);
            }
        }

        $(".filtertab .tablinks").each(function(){
            $(this).removeClass('active');
        });

        $(this).addClass('active');
        
    });
    
});
</script>

<script>
$(document).ready(function() {
$('#Importlead').DataTable();
});
</script>


<script>
  $("#leadTable").on('change','.staff_assigned',function(){
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
const tab = document.querySelectorAll(".tab");
const toggleTab = function (element) {
  const tabBtn = element.querySelectorAll(".tab-btn");
  const tabContent = element.querySelectorAll(".tab-content");
  tabBtn[0].classList.add("tab-open");
  tabContent[0].classList.add("tab-open");

  const removeTab = function (element) {
    for (const i of element) {
      i.classList.remove("tab-open");
    }
  };
  const openTab = function (index) {
    removeTab(tabBtn);
    removeTab(tabContent);
    tabBtn[index].classList.add("tab-open");
    tabContent[index].classList.add("tab-open");
  };
  tabBtn.forEach((el, i) => (el.onclick = () => openTab(i)));
};
[...tab].forEach((el) => toggleTab(el));
</script>

<script>
$("#leadTable").on("change",'.contacted_medium',function(){
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
                    // window.location = location.href;
                  },2000);
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    // window.location = location.href;
                  },2000);
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }

        });
    }
});    
</script>

<script>
$(".lead_status").on("change",function(){
    var status = $(this).val();
    var lead_id = $(this).attr('lead_id');
    if(status != "")
    {
        $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/change_lead_status',
            data : {
                status : status,
                lead_id : lead_id
            },
            success : function(res){
                var data = JSON.parse(res);
                if(data.status == false){
                  vNotify.error({text:data.errormessage});
                  window.location = location.href;
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  window.location = location.href;
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }

        });
    }
});    
</script>

<script>
$(document).ready(function(){
  var width = $(window).width();
  if (width >= 320 && width <= 425 ){
    $(".mobile-leads").css('display','block');
    $(".desktop-leads").css('display','none');
  } else{
    $(".mobile-leads").css('display','none');
    $(".desktop-leads").css('display','block');
  }
});

$(window).resize(function() {
  var width = $(window).width();
  if (width >= 320 && width <=425 ){
    $(".mobile-leads").css('display','block');
    $(".desktop-leads").css('display','none');
  } else{
    $(".mobile-leads").css('display','none');
    $(".desktop-leads").css('display','block');
  }
});
</script>

