
<style type="text/css">
    /*.studentActive, .studentActive:hover{
    background: rgba(91, 193, 70, 0.1);
    border-color: #5BC146;
    color: #8A162B;
  }*/
    .studentActive ._sdf_ {
        color: #8A0A28 !important;
    }

    .imgcontent {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 180px;
    }

.title-header{
  background:#8E294F;
  height:70px;
  padding:20px;

}
/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: white;
  width: 30%;
  height: auto;
  
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border:1px solid #ccc;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
  font-weight:bold;

}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #8E294F;
  color:white;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #8E294F;
  color:white;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 12px 12px;
  border: 1px solid #ccc;
  width: 70%;
  min-height: 530px;
  background:white;
  margin-bottom:20px;
  overflow-y: hidden;
}
#report-table{
  margin-bottom:12px;
  margin-top:12px;
}
#report-table th{
  padding:7px;
}
#report-table td{
  padding:7px;
}
#monthly_fees_table{
  margin-bottom:12px;
  margin-top:12px;
}
#monthly_fees_table th{
  padding:7px;
}
#monthly_fees_table td{
  padding:7px;
}

.expense_table th{
  padding:7px;
}
.expense_table td{
  padding:7px;
}
.institute_table th{
  padding:7px;
}
.institute_table td{
  padding:7px;
}
</style>

<div id="content" class="flex ">
    <div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-user"></i> REPORTS</h3>
        </span>
      </div>
    </div>

    <div class="" id="page-container">

        <div class="padding">
          <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

          <div class="reports-box" style="padding:10px;height:auto">
            <h2>All Reports</h2>

              <p>Click on the buttons inside the tabbed menu:</p>

              <div class="tab" id="tab">
                <button class="tablinks" onclick="openCity(event, 'paid_course_wise')" id="defaultOpen"> >> Total Fee Paid / Due Course Wise</button>
                <button class="tablinks" onclick="openCity(event, 'paid_year_wise')"> >> Total Fee Paid Year Wise </button>
                <button class="tablinks" onclick="openCity(event, 'paid_student_wise')"> >> Total Fee Paid Students Wise</button>
                <button class="tablinks" onclick="openCity(event, 'collected_date_wise')"> >> Total Fee Collected Date Wise</button>
                <button class="tablinks" onclick="openCity(event, 'expenditure_report')"> >> Expenditure Report Month Wise & Year Wise</button>
                <button class="tablinks" onclick="openCity(event, 'strength_report')"> >> Students Strength Report (Institute Wise)</button>
              </div>

              <div id="paid_course_wise" class="tabcontent">
                
                <button onclick="exportTableToExcel('report-table','paid_due')" class="pull-right mb-3" style="cursor:pointer">EXPORT TO EXCEL</button>
                <table id="report-table" class="table-bordered w-100">
                  <thead>
                    <tr>
                      <th colspan="6" style="text-align:center"><h3 class="my-3">Total Fee Paid/Due Course Wise</h3></th>
                    </tr>
                    <tr>
                      <th>Sl. No.</th>
                      <th>Course Name</th>
                      <th>No. Of Students</th>
                      <th>Expected Amount (Rs)</th>
                      <th>Paid Amount (Rs)</th>
                      <th>Due Amount (Rs)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      echo $tbody;
                    ?>
                    <tr>
                      <th colspan="2">Total</th>
                      <th id="no_of_students"></th>
                      <th id="totalExpectedCourse"></th>
                      <th id="totalAmountCourse"></th>
                      <th id="totalDueCourse"></th>
                    </tr>
                  </tbody>
                  
                </table>
              </div>

              <div id="paid_year_wise" class="tabcontent">
                <button onclick="exportTableToExcel('year-wise-table','year_wise_amount')" class="pull-right mb-3" style="cursor:pointer">EXPORT TO EXCEL</button>
                <form id="yr_box">
                  <div class="row form-group">
                    <div class="col-md-3">
                      <label style="font-size:18px;font-weight:bold">Select Year : -</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control year_selected">
                        <option value="">All</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                      </select>
                    </div>
                  </div>
                </form>
                
                <div id="yearly_amount_box" class="">
                    <table class="table-bordered w-100" id="year-wise-table">
                      <tr>
                        <th colspan="2"><center><h3 class="my-3">Total Fee Paid Year Wise </h3></center></th>
                      </tr>
                      <tr>
                        <th style="padding:7px">Year</th>
                        <th style="padding:7px">Total Amount</th>
                      </tr>
                      <tr>
                        <td class="year_td" style="padding:7px"></td>
                        <td class="amount_td" style="padding:7px"></td>
                      </tr>
                    </table>
                </div>
                
              </div>

              <div id="paid_student_wise" class="tabcontent">
                  <button onclick="exportTableToExcel('student_paid_table','student_wise_paid')" class="pull-right mb-3" style="cursor:pointer">EXPORT TO EXCEL</button>
                    <table id="student_paid_table" class="table-bordered w-100">
                        <thead>
                          <tr><center><h3 class="my-3">Total Fee Paid Students Wise</h3></center></tr>
                          <tr>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Sl.No.</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Student Name</span></th>
                            <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Paid Amount</span></th>
                          </tr>
                        </thead>
                        <tbody id="studentTableBody">
                            <?php
                              echo $tbody_student;
                            ?>
                        </tbody>
                    </table>
              </div>

              <div id="collected_date_wise" class="tabcontent">
                <button onclick="exportTableToExcel('monthly_fees_table','month_wise_payment')" class="pull-right mb-3" style="cursor:pointer">EXPORT TO EXCEL</button>
                
                <form id="date_search_form" enctype="multipart/form-data">
                  <div class="row form-group">
                    <div class="col-sm-5 year">
                      <!-- <label for="from">From</label> -->
                      <select class="form-control date_wise_year" name="date_wise_year">
                        <option value="">Select Year</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                      </select>
                    </div>
                    <div class="col-sm-5 month">
                      <!-- <label for="to">to</label> -->
                      <select class="form-control date_wise_month" name="date_wise_month">
                        <option value="">Select Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn" style="background:#8E294F;color:white">Search</button>
                    </div>
                  </div>
                </form>

                <table id="monthly_fees_table" class="table-bordered w-100">
                    <thead>
                      <tr>
                        <th colspan="2"><center><h3 class="my-3">Total Fee Collected Date Wise</h3></center></th>
                      </tr>
                      <tr>
                        <th style="font-size:17px">Date</th>
                        <th style="font-size:17px">Fee Collected</th>
                      </tr>
                    </thead>
                    <tbody id="date_wise_tableBody">
                      
                    </tbody>
                </table>

              </div>

              <div id="expenditure_report" class="tabcontent">
                <button onclick="exportTableToExcel('expense_table','expenditure_report')" class="pull-right mb-3" style="cursor:pointer">EXPORT TO EXCEL</button>
                
                <form id="yrly_expense_form">
                  <div class="row form-group">
                    <div class="col-sm-5">
                      <select class="form-control expense_year" name="expense_year">
                        <option value="">Select Year</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                      </select>
                    </div>
                    <div class="col-sm-5">
                      <select class="form-control expense_month" name="expense_month">
                        <option value="">Select Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn" style="background:#8E294F;color:white">Search</button>
                    </div>
                  </div>
                </form>
                <div style="width:100%">
                  <table id="expense_table" class="expense_table table-bordered w-100">
                    <tr>
                      <th colspan="3"><center><h3 class="my-3">Expenditure Report Month wise and year wise.</h3></center></th>
                    </tr>
                    <tr>
                      <th>Year</th>
                      <th>Month</th>
                      <th>Total Expenditure</th>
                    </tr>
                    <tr class="expense_tr">
                      <td class="expense_year_td"></td>
                      <td class="expense_month_td"></td>
                      <td class="total_expense_td"></td>
                    </tr>
                  </table>
                </div>
              </div>

              <div id="strength_report" class="tabcontent">
                <button onclick="exportTableToExcel('institute_table','students_strength_report')" class="pull-right mb-3" style="cursor:pointer">EXPORT TO EXCEL</button>
                <div>
                  <table id="institute_table" class="institute_table table-bordered w-100">
                    <thead>
                      <tr>
                        <th colspan="3"><center><h3 class="my-3">Students Strength Report (Institute Wise)</h3></center></th>
                      </tr>
                      <tr>
                        <th>Sl. No.</th>
                        <th>Institute Name</th>
                        <th>No. of Students</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        echo $tbody_institute;
                      ?>
                      <tr>
                        <th colspan="2">Total Students</th>
                        <th id="total_students"></th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

          </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------popup----------------------------------------- -->
<div class="modal Modal_ student_modal" id="packagepopup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt _blckClr_">Add Package</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="packageform" method="POST" class="_formSubmit" action="<?php echo base_url('institute/add_package'); ?>">
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Total Package(INR)</label>
                            <input id="package" type="number" name="package" class="form-control makeReqin date" required autocomplete="new">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Course Duration in Year(s)</label>
                            <input id="course_dur" type="number" name="course_dur" class="form-control makeReqin date" required autocomplete="new">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group package_fields_box">
                            
                        </div>
                    </div>
                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="student_id" id="student_id">
                            <input type="hidden" name="full_name" id="full_name">
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
    <div class="modal-dialog Modal-width_580">L
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

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();


</script>

<!-- course wise grand total calculating -->
<script>
  var students_td = document.getElementsByClassName('students_number');
  var amount_td = document.getElementsByClassName('course_wise_amount');
  var due_td = document.getElementsByClassName('course_wise_due');
  var expected_td = document.getElementsByClassName('expected_amount');
  var grand_total = 0;
  var total_due = 0;
  var expected_total = 0
  var total_student = 0;
  var i;
  var j;
  for(i=0;i<amount_td.length;i++)
  {
    grand_total += Number(amount_td[i].innerHTML);
    total_due += Number(due_td[i].innerHTML);
    expected_total += Number(expected_td[i].innerHTML);
    total_student += Number(students_td[i].innerHTML);
  }
  document.getElementById('totalAmountCourse').innerHTML = grand_total;
  document.getElementById('totalDueCourse').innerHTML = total_due;
  document.getElementById('totalExpectedCourse').innerHTML = expected_total;
  document.getElementById('no_of_students').innerHTML = total_student;
  
</script>

<script>
  var students_no_td = document.getElementsByClassName('institute_wise_student');
  var i;
  var total_students = 0;
  for(i=0;i<students_no_td.length;i++)
  {
    total_students += Number(students_no_td[i].innerHTML);
  }
   document.getElementById('total_students').innerHTML = total_students;
</script>

<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>