<style type="text/css">
   .filter-con{
    background: #F7F8FA;
    padding: 15px;
   }

   .info-box{
     width: 100%;
     height: 90px;
     border-radius: 12px;
     display: flex;
     justify-content: center;
     align-items: center;
     flex-direction: column;
     margin-bottom: 10px;
     text-align: center;
     padding: 8px;
   }

   .info-box p{
     font-size: 15px;
     color: white;
   }

   .info-box span{
     font-size: 20px;
     color: white;
   }

   .lead-box{
     background: #10dada;
   }

   .admsn-box{
     background: #ff99cc;
   }

   .fee-box{
     background: #ff9966;
   }

   .apps-box{
     background: #21d35c;
   }

</style>
<div id="content" class="flex ">
    <div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-line-chart"></i> Analytics</h3>
        </span>
      </div>
    </div>

    <div class="page-container" id="page-container">
        <div class="container card leads">
            <div class="card-body">
                <h4>Lead Analytics</h4>
                <div class="filter-con">
                    <form id="filter-form">
                        <div class="row">
                            <div class="col-md-3">
                              <select class="form-control selected_yr" name="selected_year">
                                <?php  
                                $curr_yr = date('Y');
                                $starting_yr = '2021';
                                $diff = $curr_yr-$starting_yr;
                                for($i=0;$i<=$diff;$i++)
                                {
                                  $yr = $curr_yr-$i;
                                ?>
                                  <option value="<?=$yr; ?>"><?=$yr; ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                            <div class="col-md-3">
                              <select class="form-control selected_staff" name="selected_staff">
                                <option value="">Select Counsellor </option>
                                <?php  
                                if(!empty($staffs))
                                {
                                  foreach($staffs as $staff)
                                  {
                                    ?>
                                    <option value="<?=$staff->employee_id; ?>"><?=$staff->employee_name; ?></option>
                                    <?php
                                  }
                                }
                                ?>
                              </select>
                            </div>
                            <div class="col-md-3">
                              <select class="form-control selected_time" name="selected_time">
                                <option value="">Select Time Frame</option>
                                <option value="1">Today</option>
                                <option value="7">Last Seven Days</option>
                                <option value="30">Last Thirty Days</option>
                              </select>
                            </div>
                            
                            <!-- <div class="col-md-3">
                              <?php  
                              $institute_id = $_SESSION['institute_id'];
                              $courses = $this->db->query("SELECT course_id,course_name FROM courses WHERE institute_id = '".$institute_id."' AND course_status = '1' ")->result();
                              ?>
                              <select id="course" class="form-control selected_course" name="selected_course">
                                <option value="">Select Course</option>
                                <?php  
                                if(!empty($courses))
                                {
                                  foreach($courses as $course)
                                  {
                                    ?>
                                      <option value="<?=$course->course_id; ?>"><?=$course->course_name; ?></option>
                                    <?php
                                  }
                                }
                                ?>
                              </select>
                            </div>
                            <div class="col-md-3">
                              <select class="form-control streamApply selected_stream" name="selected_stream">
                                <option value="">Select Stream</option>
                              </select>
                              <input type="hidden" name="stream_id" class="stream_id" />
                            </div> -->
                  
                        </div>
                    </form>
                </div>

                <div class="row justify-content-center my-3">
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box lead-box">
                          <p class="info-box-content">Total Leads</p>
                          <span class="total_leads">
                            0
                          </span>
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box lead-box">
                          <p class="info-box-content">Untouched</p>
                          <span class="untouched">
                            0
                          </span>
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12">
                        <div class="info-box apps-box">
                          <p class="info-box-content">Called</p>
                          <span class="called">
                            0
                          </span>
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box apps-box">
                           <p class="info-box-content">Whatsapp Done</p>
                           <span class="whatsapp_done">0</span>
                         
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box apps-box">
                           <p class="info-box-content">Emailed</p>
                           <span class="emailed">0</span>
                         
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box apps-box">
                           <p class="info-box-content">Prospectus Sent</p>
                           <span class="prospectus_sent">0</span>
                         
                        </div>
                     </div>
                     
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box apps-box">
                           <p class="info-box-content">Online Applications Done</p>
                           <span class="online_applications">0</span>
                         
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12">
                        <div class="info-box apps-box">
                          <p class="info-box-content">Admission fee paid</p>
                          <span class="admsn_fee_paid">
                            0
                          </span>
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box apps-box">
                           <p class="info-box-content">Documents Collected</p>
                           <span class="docs_collected">0</span>
                         
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box apps-box">
                           <p class="info-box-content">Offer Letter Sent</p>
                           <span class="offer_letter_sent">0</span>
                         
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box apps-box">
                           <p class="info-box-content">Transferred to associate</p>
                           <span class="transferred_assos">0</span>
                         
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12">
                        <div class="info-box apps-box">
                          <p class="info-box-content">Admission Done</p>
                          <span class="admsn_done">
                            0
                          </span>
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box fee-box">
                           <p class="info-box-content">Junk Lead</p>
                           <span class="junk_lead">0</span>
                         
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box fee-box">
                           <p class="info-box-content">Invalid Number</p>
                           <span class="invalid_number">0</span>
                         
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box fee-box">
                           <p class="info-box-content">Lost Lead</p>
                           <span class="lost_leads">0</span>
                         
                        </div>
                     </div>
                     <div class="col-xl-2 col-md-6 col-12 box">
                        <div class="info-box fee-box">
                           <p class="info-box-content">Duplicate</p>
                           <span class="duplicate">0</span>
                         
                        </div>
                     </div>

                     <div class="col-12 my-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Employee Wise Leads</h4>
                                <div>
                                    <canvas id="emp-chart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="container card leads">
            <div class="card-body">
                <h4>Admissions/Students Analytics</h4>
                <div class="filter-con">
                    <form id="student-filter-form">
                        <div class="row">
                                   <div class="col-md-3">
                              <select class="form-control student_filter_time" name="selected_time">
                                <option value="">Select Time Frame</option>
                                <option value="1">Today</option>
                                <option value="7">Last Seven Days</option>
                                <option value="30">Last Thirty Days</option>
                              </select>
                            </div>
                            <div class="col-md-3">
                              <select class="form-control student_filter_yr" name="selected_year">
                                <?php  
                                $curr_yr = date('Y');
                                $starting_yr = '2021';
                                $diff = $curr_yr-$starting_yr;
                                for($i=0;$i<=$diff;$i++)
                                {
                                  $yr = $curr_yr-$i;
                                ?>
                                  <option value="<?=$yr; ?>"><?=$yr; ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                     
                  
                        </div>
                    </form>
                </div>

                <div class="row justify-content-center my-3">
                     
                      <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                              <center><h4 class="card-title">Course Wise Students Chart</h4></center>
                            </div>
                            <div class="card-body">
                                <div>
                                    <canvas id="course-chart" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="card">
                         <div class="card-header">
                           <center><h4>Stream wise students</h4></center>
                          </div>
                          <div class="card-body">
                            <canvas id="stream-chart"></canvas>
                          </div>
                       </div>
                     </div>
                     
                     <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                              <center><h4 class="card-title">Gender Chart</h4></center>
                            </div>
                            <div class="card-body">
                                <div>
                                    <canvas id="gender-chart" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                       <div class="card">
                         <div class="card-header">
                          <center><h4 class="card-title">Online Applications vs Admissions</h4></center>
                          </div>
                         <div class="card-body">
                           <canvas id="applications-chart"></canvas>
                         </div>
                       </div>
                      </div>
                    
                </div>

            </div>
        </div>

    </div>
</div>

<script>
  $(document).ready(function(){
    filter_data();
    student_analytics();
  });
</script>

<script>
  $("#student-filter-form .student_filter_yr").on("change",function(){
    student_analytics();
  });
</script>

<script>
  function student_analytics()
  {
    var yr = $(".student_filter_yr").val();
    var time_frame = $(".student_filter_time").val();
    // alert(yr);return false;
    $.ajax({
      type : 'GET',
      url : '<?=base_url(); ?>institute/filter_student_analytics',
      data : {
        yr : yr,
        time : time_frame
      },
      success : function(res){
        var data = JSON.parse(res);
        var genders = data.gender;
        var gender_arr = [genders.male,genders.female];
        var label = "Gender wise Students";
        var chart_data = gender_arr;
        var text = "Gender wise Students in "+yr;
        gender_chart(label,chart_data,text);

        var course = data.course;
        var courses = [];
        var numbers = [];
        var i;
        for(i=0;i<course.length;i++)
        {
          courses[i] = course[i].course_name;
          numbers[i] = course[i].no_of_students; 
        }

        var labels = courses;
        var label = "Course wise Students";
        var chart_data = numbers;
        var text = "Course wise Students in "+yr;
        course_chart(labels,label,chart_data,text);

        var stream = data.stream;
        var streams = [];
        var students = [];
        var i;
        for(i=0;i<stream.length;i++)
        {
          streams[i] = stream[i].stream_name;
          students[i] = stream[i].no_of_students; 
        }

        var stream_labels = streams;
        var steram_label = "Steam wise Students";
        var stream_chart_data = students;
        var stream_text = "Stream wise Students in "+yr;
        stream_chart(stream_labels,steram_label,stream_chart_data,stream_text);

        var total_applications = data.total_applications;
        var pending_applications = data.pending_applications;
        var admitted_applications = data.admitted_applications;
        var applications_label = "Online Applications";
        var applications_text = "Total Online Applications - "+total_applications+" in "+yr;
        var application_chart_data = [pending_applications,admitted_applications];
        applications_chart(applications_label,application_chart_data,applications_text);
      }
    });
  }
</script>

<script>
  //gender chart
  function applications_chart(label,chart_data,text)
  {
     new Chart(document.getElementById('applications-chart'), {
      type: 'pie',
      data: {
         labels: ['Applications Received','Admission Done'],
         datasets: [{
         label: label,
         backgroundColor: ["#E74C3C","#2ECC71","#3498DB","#F1C40F","#1ABC9C","#34495E","#BDC3C7"],
         data: chart_data
         }]
      },
      options: {
         title: {
         display: true,
         text: text
         }
      }
     });
  }

  //gender chart
  function gender_chart(label,chart_data,text)
  {
    new Chart(document.getElementById('gender-chart'), {
      type: 'pie',
      data: {
        labels: ['Male','Female'],
        datasets: [{
        label: label,
        backgroundColor: ["#2ECC71","#3498DB","#F1C40F","#1ABC9C","#E74C3C","#34495E","#BDC3C7"],
        data: chart_data
        }]
      },
      options: {
        title: {
        display: true,
        text: text
        }
      }
    });
  }

  //Course Chart
  function course_chart(labels,label,chart_data,text)
  {
      new Chart(document.getElementById('course-chart'), {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
          label: label,
          backgroundColor: ["#2ECC71","#3498DB","#F1C40F","#1ABC9C","#E74C3C","#34495E","#BDC3C7"],
          data: chart_data
          }]
        },
        options: {
          title: {
          display: true,
          text: text
          }
        }
      });
  }

  //Stream Chart
  function stream_chart(labels,label,chart_data,text)
  {
      new Chart(document.getElementById('stream-chart'), {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
          label: label,
          backgroundColor: ["#2ECC71","#3498DB","#F1C40F","#1ABC9C","#E74C3C","#34495E","#BDC3C7"],
          data: chart_data
          }]
        },
        options: {
          title: {
          display: true,
          text: text
          }
        }
      });
  }
  
</script>

<script>
    $("#course").on('change',function(){
      var course_id = $("#course").val();
      if(course_id != "")
      {
        $.ajax({
          type : 'POST',
          url : '<?=base_url(); ?>institute/getStreamsByCourse',
          data : {
            course_id : course_id,
          },
          success : function(res){
            $(".streamApply").append(res);
          }
        });
      }
      filter_data();
    });
</script>

<script>
  function filter_data()
  {
    var yr = $(".selected_yr").val();
    var time_frame = $(".selected_time").val();
    var staff_id = $(".selected_staff").val();
    $.ajax({
      type : 'GET',
      url : '<?=base_url(); ?>institute/filter_analytics/?yr='+yr+'&time='+time_frame+'&counsellor='+staff_id,
      data : {},
      success : function(res){
        var data = JSON.parse(res);
        $(".total_leads").html(data.total_leads);
        $(".untouched").html(data.untouched);
        $(".called").html(data.called_count);
        $(".whatsapp_done").html(data.whatsapp_count);
        $(".emailed").html(data.emailed);
        $(".prospectus_sent").html(data.prospectus_sent);
        $(".online_applications").html(data.online_applications);
        $(".admsn_fee_paid").html(data.admsn_fee_paid);
        $(".junk_lead").html(data.junk_lead);
        $(".invalid_number").html(data.invalid_number);
        $(".duplicate").html(data.duplicate);
        $(".lost_leads").html(data.lost_leads);
        $(".docs_collected").html(data.docs_count);
        $(".offer_letter_sent").html(data.offer_letter);
        $(".admsn_done").html(data.admsn_done);

        var staffs = data.staffs;
        var staff_name = [];
        var no_of_leads = [];
        var i;
        for(i=0;i<staffs.length;i++)
        {
          staff_name[i] = staffs[i].staff_name;
          no_of_leads[i] = staffs[i].no_of_leads;
        }

        //Employee wise leads chart
        new Chart(document.getElementById("emp-chart"), {
          type: 'bar',
          data: {
            labels: staff_name,
            datasets: [
            {
              label: "Employee Wise Chart",
              backgroundColor: ["#6174d5", "#5f76e8", "#768bf4", "#7385df", "#b1bdfa"],
              data: no_of_leads
            }
            ]
          },
          options: {
            legend: { display: false },
            title: {
            display: true, 
            text: 'Employee Wise Chart'
            }
          }
        });
        
        student_analytics();
      }
    });
  }

  $("#filter-form .selected_yr").on('change',function(){
    var curr_yr = '<?=date('Y'); ?>';
    var selected_yr = $(this).val();
    if(curr_yr != selected_yr)
    {
      $("#filter-form .selected_time").attr('disabled',true);
    }else{
      $("#filter-form .selected_time").attr('disabled',false);
    }
    filter_data();
  });

  $("#filter-form .selected_time").on('change',function(){
    filter_data();
  });

  $("#filter-form .selected_staff").on('change',function(){
    filter_data();
  });

  $("#filter-form .selected_stream").on('change',function(){
    var stream_id = $(".selected_stream option:selected").attr('stream_id');
    $(".stream_id").val(stream_id);
    filter_data();
  });
</script>

