<style type="text/css">
  /*.dashboardActive, .dashboardActive:hover{
    color: #8A0A28 !important;
    border-color: #8A162B;
  }*/.dashboardActive ._sdf_
  {
    color: #8A0A28 !important;
  }
  .p-4{
    padding: 2.5rem 1.5rem !important;
  }

  .mrqueTable{
    width: 1400px;
  }
  .bg-b-brown {
    background: #606ceb;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
    position: relative;
    height: 111px;
    width: 100%;
    margin-top:15px;
    margin-bottom: 15px;
    }

.info-box-white
  {
    background: white;
    border-radius: 100%;
    color: #8A162B;
    position: absolute;
    top: 50%;
    left: 45px;
    font-size: 23px;
    width: 50px;
    height: 50px;
    text-align: center;
    transform: translate(0, -50%);
    padding-top: 8px;

  }
  .box
  {
    width: 90%;
  }
  .info-box
  {
    background: #4aa7e0;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
    position: relative;
    height: 111px;
    max-width: 100%;
    margin-top: 15px;
    margin-bottom: 15px;
  } 
  
  .info-box-tex
  {
   background: #8A162B;
    border-radius: 100%;
    color: white;
    position: absolute;
    /* padding: 6px 10px 6px 10px; */
    font-size: 23px;
    width: 50px;
    height: 50px;
    text-align: center;
    top: 50%;
    transform: translate(0, -50%);
    left: 45px;
    padding-top: 7px;
}
.info-box-content{
  text-align: center;
    position: absolute;
   left: 124px;
    top: 43px;
    font-size: 17px;
    color: white;
    font-weight: bold;
}
 .tablecontent .table > thead > tr > th
 {
  border: 1px solid #B6B6B6;
 } 
 .headingcontent{
    background: #8A162B;
    color: white;
    text-align: center;
 }

 .enquiryno{
    border-radius: 100%;
    /*width: 23px;*/
    display: inline-block;
    /*height: 22px;*/
    font-size: 13px;
    padding: 5px;
    font-weight: bold;
    background: #C4C4C4;
    color: black;
   
 }

.enquiryboder{
  border-top: 2px solid #3c1c1c33;
    border-radius: 5px 5px 0px 0px;
}

.chatDiv img{
  width: 94%;
}

 #enquriychart {
    height: 525px; 
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
  font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

path.highcharts-button-symbol{
  display: none;
}

@media only screen and (min-width: 1200px){
  .chatDiv img
  {
    width: 94%;
  }
}

.marqueeTag{
  padding: 8px;
  background: #51CDF4;
}
.title-header{
      background:#15659F;
      height:70px;
      padding:20px;

    }
</style>

<!-- ############ Content START-->
<div id="content" class="flex ">
   <!-- ############ Main START-->
   <div class="marqueeTag">
      <div class="row">
        <div class="col-4 col-md-2">
          <p style="margin-bottom: 0;color: #000;font-weight: 600;font-size: 14px;">Announcement:</p>
        </div>

        <div class="col-8 col-md-10">
          <marquee style="color:#8A162B;font-size: 14px" width="100%"><?php echo $announcments; ?></marquee>
        </div>
      </div>
    </div>
    
      <div class="title-header">
        <div class="">
        <span>
            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-dashboard"></i> DASHBOARD</h3>
            <h4 class="text-white text-capitalize pull-right">Welcome <?=$this->session->userdata('admin'); ?></h4>
        </span>
        </div>
      </div>
   <div class="page-container" id="page-container">

      <div class="padding">
         <!-- ==============
            Charts
            ==================== -->

            <section id="charts">
              <div class="row justify-content-center">
               <div class="col-xl-4 col-md-6 col-12 box">
                  <div class="info-box">
                    <span class="info-box-tex">
                      <?php
                      $enq = $this->institute_model->getAllActiveEnq();
                      echo count($enq);
                      ?>
                      
                    </span>
                     <p class="info-box-content">Total Leads</p>
                  </div>
               </div>
               <div class="col-xl-4 col-md-6 col-12 box">
                  <div class="bg-b-brown">
                    <span class="info-box-white">
                      <?php
                      $enqs = $this->institute_model->getAllStudent();
                      echo count($enqs);
                      ?>
                      </span>
                     <p class="info-box-content text-white">Total Students</p>
                  </div>
               </div>
                   <div class="col-xl-4 col-md-6 col-12 box">
                  <div class="bg-b-brown">
                    <span class="info-box-white"> <?php echo $_SESSION['institute_allowed_student'] ?></span>
                     <p class="info-box-content text-white">Students Credit</p>
                  </div>
               </div>
               <div class="col-xl-4 col-md-6 col-12 box">
                  <div class="bg-b-brown">
                    <span class="info-box-white">
                      <?php
                      $enqst = $this->institute_model->getAllActiveStaff();
                      echo count($enqst);
                      ?>
                      </span>
                     <p class="info-box-content text-white">Total Staff</p>
                  </div>
               </div>
                <div class="col-xl-4 col-md-6 col-12 box">
                  <div class="info-box">
                    <span class="info-box-tex">
                      <?php
                      $enqs = $this->institute_model->getAllActiveAgents();
                      echo count($enqs);
                      ?>
                      </span>
                     <p class="info-box-content">Total Associates</p>
                  </div>
               </div>
                <div class="col-xl-4 col-md-6 col-12 box">
                  <div class="info-box">
                    <span class="info-box-tex">
                      <?php
                      $today = date("Y-m-d");
                      $now = time(); 
                      $expiry = strtotime($_SESSION['institute_expiry_date']);
                      $datediff = $expiry - $now;
                      echo round($datediff / (60 * 60 * 24));
                      ?>
                      </span>
                     <p class="info-box-content">Days Left</p>
                  </div>
               </div>
            </div>
           </section>
          <section id="dailySchedule">
            <div class="row">
              <div class="col-xl-8">
                <div class="card">
                 <!--  <div class="card-header">
                    
                  </div> -->
                  <div class="chatDiv page-title pb-0 p-t-32">
                     <div id="enquriychart"></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card">
                  <div class="card-header">
                  <div class="page-title">
                   <h5 class="text-md mb-0">Recent Online Enquiries</h5>
                  </div>
                </div>
                <div class="enquiriesteble">
                    <table class="table table-borderless info-box_" style="max-width: 100%!important;">
                         
                    <?php
                      $enqs = $this->institute_model->getRecentEnq();
                      // echo '<pre>'; print_r($enq); echo '</pre>';
                      $sl = 1;
                      foreach($enqs as $enq) 
                      { 
                       
                      ?>
                          
                            <tr>
                                <td style="vertical-align: middle;">
                                  <span class="enquiryno"><?php echo $sl++; ?></span>
                                </td>
                                <td>
                                  <h6 class="_fwg500_ nwFntSt redclr _fs12_" style="margin: 0px"><?php echo date("d-M-Y",strtotime($enq->created_at)); ?></h6>
                                  <h5 class="_fwg600_ nwFntSt _fs14_ text-capitalize" style="margin: 3px 0px;"><?php echo $enq->student_name; ?></h5>  
                                  <h6 class="_fs14_ _fwg500_ nwFntSt "><?php echo $enq->mobile; ?></h6>
                                </td>
                                <td style="vertical-align: middle;">
                                  <h6 class=" _fwg500_ nwFntSt _fs14_"><?php echo $enq->stream; ?></h6>
                                </td>
                             </tr>
                        <?php
                          }
                        ?>
                        <tr>
                          <td></td>
                          <td></td>
                          <td><a href="<?php echo base_url('institute/leads_page'); ?>">See All</a></td>
                        </tr> 
                        </table>
                 </div>
                </div>
              </div>
            </div>
            <div class="row">
                        <div class="col-xl-12">
<a href="https://wa.aisensy.com/PwD2Qb
"><img width="66%" src="/assets/dashboard/img/Eduwego-sharefeedback-banner.png" alt="" srcset=""></a>
                        </div>
                    </div>
         </section>
      </div>
   </div>
</div>
</div>

<script type="text/javascript">
 Highcharts.chart('enquriychart', {
    chart: {
        // type: 'areaspline'
    },

    title: {
      text: 'Enquiries v/s Students'
    },
   
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#edf04a'
            // color:
            // Highcharts.defaultOptions.legend.color || 'white'
    },
    xAxis: {
        categories: [
            "<?php echo $chart_data[4]['m']; ?>",
            "<?php echo $chart_data[3]['m']; ?>",
            "<?php echo $chart_data[2]['m']; ?>",
            "<?php echo $chart_data[1]['m']; ?>",
            "<?php echo $chart_data[0]['m']; ?>",
        ],
        plotBands: [{ // visualize the weekend
            from: 4.5,
            to: 6.5,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    // yAxis: {
    //     title: {
    //         text: ''
    //     }
    // },
    tooltip: {
        shared: true,
        // valueSuffix: ''
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: [{
        name: 'Enquiries',
        data: [<?php echo $chart_data[4]['enquiry']; ?>, <?php echo $chart_data[3]['enquiry']; ?>, <?php echo $chart_data[2]['enquiry']; ?>,  <?php echo $chart_data[1]['enquiry']; ?>, <?php echo $chart_data[0]['enquiry']; ?>]
    }, {
        name: 'Students',
        data: [<?php echo $chart_data[4]['students']; ?>, <?php echo $chart_data[3]['students']; ?>, <?php echo $chart_data[2]['students']; ?>,  <?php echo $chart_data[1]['students']; ?>, <?php echo $chart_data[0]['students']; ?>]
    }]
});
</script>