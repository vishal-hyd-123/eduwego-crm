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
}
.tab-btn {
  flex: 1;
  color: #333;
  text-align: center;
  padding: 1em 2em;
  background-color: #d0ddec;
  /*border: 1px solid #000;*/
  border-radius: 10px 10px 0 0;
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
<div id="content" class="flex ">
    <div class="title-header">
        <div>
            <span>
                <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-check-square-o"></i> LEADS</h3>
            </span>
        </div>
    </div>

    <div class="page-container" id="page-container">

      <?php if($_SESSION['is_institute_in']){ ?>
        <div class="lead-filter csv-con">
          <div class="col-12">
            <div class="row">
            <div class="col-4 text-right">
                <button class="btn btn-primary"><i class="fa fa-download"></i> CSV</button> 
            </div>
            <div class="col-4">
                <select class="export-leads form-control">
                    <option value="">Select</option>
                    <option value="1">Today</option>
                    <option value="7">This Week</option>
                    <option value="30">This Month</option>
                    <option value="all">All</option>
                </select>
            </div>
            <div class="col-4">
                <input type="date" class="selected_date form-control" name="selected_date" />
            </div>
          </div>
          </div>
        </div>
      <?php } ?>

<div class="mobile-leads">
  <!-- <div class="container-fluid">
    <div class="wrapper navbar">
      <nav>
        <input type="checkbox" id="show-search">
        <input type="checkbox" id="show-menu">
        <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label> &nbsp;
        <div class="content">
        <div class="logo"><a href="#">Manage Leads</a></div>
          <ul class="links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li>
              <a href="#" class="desktop-link" style="text-decoration: none;">Features</a>
              <input type="checkbox" id="show-features">
              <label for="show-features" style="text-decoration: none;">Features</label>
              <ul>
                <li><a href="#">Drop Menu 1</a></li>
                <li><a href="#">Drop Menu 2</a></li>
                <li><a href="#">Drop Menu 3</a></li>
                <li><a href="#">Drop Menu 4</a></li>
              </ul>
            </li>
            <li>
              <a href="#" class="desktop-link">Services</a>
              <input type="checkbox" id="show-services">
              <label for="show-services">Services</label>
              <ul>
                <li><a href="#">Drop Menu 1</a></li>
                <li><a href="#">Drop Menu 2</a></li>
                <li><a href="#">Drop Menu 3</a></li>
                <li>
                  <a href="#" class="desktop-link">More Items</a>
                  <input type="checkbox" id="show-items">
                  <label for="show-items">More Items</label>
                  <ul>
                    <li><a href="#">Sub Menu 1</a></li>
                    <li><a href="#">Sub Menu 2</a></li>
                    <li><a href="#">Sub Menu 3</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#">Feedback</a></li>
          </ul>
        </div>
        <div>
        <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label> &nbsp;
        <i class="fa-solid fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <i class="fa-solid fa-filter" aria-hidden="true"></i>
        </div>
        <form action="#" class="search-box">
          <input type="text" placeholder="Type Something to Search..." required>
          <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
        </form>
      </nav>
    </div>
  </div> -->

  <div class="container-fluid">
    <!-- <div class="row justify-content-center">
      <div class="col-11">
        <div class="dropdown">
          <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
        
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
          <span style="float: right;">
            <i class="fa-solid fa-arrow-down-wide-short"></i>
          </span>
        </div>
      </div>
    </div> -->
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
    
    <div class="shadow-lg" style="background:white;padding:20px;">
        <div class="">
          
          <div class="tab">
            <ul class="tabs-btn">
              <li class="tab-btn">Web Leads</li>
              <li class="tab-btn">Facebook Leads</li>
            </ul>
            <div class="tabs-content">
              <div class="tab-content">
                <div style="overflow-x:scroll">
                    <table id="myTable" class="table-bordered table-responsive" role="grid" aria-describedby="clientTable_info">
                       
                        <thead>
                            <!-- <th>
                                <label class="checkboxcontainer">
                                    <input type="checkbox" name="" class="pivileges" id="selectAll">
                                    <span class="checkmark"></span>
                                </label>
                            </th> -->
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
                                        <div class="item-except _greyClr_ _fs14_ mobile"><?php echo $lead->mobile; ?></div>
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

                                           <option value="Transferred to Associate" <?php if($lead->contacted_medium == "Transferred to Associate"){echo "selected";} ?>>Transferred to Associate</option>

                                        </select>
                                    </td>

                                    <td class="text-center">
                                       <div class="item-except _greyClr_ _fs14_ text-capitalize stu_name action-con">

                                            <a target="_blank" href="<?=base_url(); ?>institute/lead_details/<?=$lead->id; ?>"><i class="fa fa-eye text-success"  style="font-size:20px" ></i></a>
                                            <?php if($menus->leads_delete == 'on'){ ?>
                                              <i class="fa fa-trash text-danger" onclick="delete_leads(<?php echo $lead->id; ?>)" style="font-size:20px" ></i>
                                            <?php } ?>
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
               <?php
                print_r($fbleads);
               ?>
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
                        <!-- <img class="width100" id="blah" src="<?php //echo base_url(); 
                                                                    ?>assets/dashboard/img/profile.png"> -->
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

<div class="modal Modal_" id="loan_letter">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Loan</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="admission_letter_form" target="_blank" method="POST" class="instituteform" action="<?php echo base_url('institute/print_loan_letter'); ?>">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Year*</label>
                                    <input id="year" type="text" name="year" class="form-control makeReqin" required autocomplete="new">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount*</label>
                                    <input id="amount" type="text" name="amount" class="form-control makeReqin" autocomplete="new">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Description</label>
                            <textarea id="Description" name="Description" class="form-control _fs14_ frmBg _drkclr_ _fntwss_ makeReqin" required autocomplete="new" placeholder="1st year acedamic fees & mess fees" style="height: 108px;"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 text-left">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount In Words</label>
                            <input id="amount_in_words" type="text" name="amount_in_words" class="form-control makeReqin" autocomplete="new">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Academic Year</label>
                            <input id="Academic_Year" type="text" name="Academic_Year" class="form-control makeReqin" autocomplete="new" placeholder="2017-20">
                        </div>
                    </div>
                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="student_id" id="student_HJ">
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

<!--<============
    Delete Popup 
      ============>-->

<div class="modal Modal_" id="DeleteClientPopupMultiple">
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
                                Delete Student.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Student from the dashboard?</p>
                        </div>
                    </div>
                    <form id="multiPleDeleteqw" method="POST" action="<?php echo base_url('admin/deletetaluka'); ?>">
                        <div class="row">
                            <div class="col-12 text-right">
                                <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                                <button type="submit" id="multiPleDelete" class="btn btn-responsive YesDlt-btn">Yes Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
                            Delete this Student.</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-t-20">
                            <p id="p_action" class="_fs14_ _greyClr_ _fwg300_ ">This action can not be undone. <br>Are you sure you want to delete this Student from the dashboard?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <form id="singleDeleteIdq" method="POST" action="delete_student">
                                <span data-dismiss="modal" class="btn btn-responsive NoStay-btn">No stay</span>
                                <input type="hidden" name="taluka_id" id="ehiddenid">
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
$(".contacted_medium").on("change",function(){
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
                  // $( ".error-message" ).remove();
                  // if(data.errormessage){
                  //   vNotify.error({text:data.errormessage, title:'Error!'});
                  // }
                  //  data1   = JSON.parse(data.message);
                  // $('form :input').each(function(){                          
                  //   var elementName = $(this).attr('name');        
                  //   var message = data1[elementName];
                  //   if(message){
                  //     var element = $('<span>' + message + '</span>')
                  //                   .attr({
                  //                       'class' : 'error-message'
                  //                   });
                  //     $(this).after(element);
                  //     $(element).fadeIn();
                  //   }
                  // }); 
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

