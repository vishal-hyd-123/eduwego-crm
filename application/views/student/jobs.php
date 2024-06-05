<style>
.fa{
    color: #8E294F;
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
    background: #FFFFFF;
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
    color: black;
    font-weight: bold;
}
</style>
<div id="content" class="flex ">
    <div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-archive"></i> JOB POSTS</h3>
        </span>
      </div>
    </div>

    <div class="page-container" id="page-container">
        
        <!-- <div class="table-responsive">
            <div class="page-title p-b-40 m-b-20">
               <div class="job-analytics">
                   <h5>Total Jobs Available : <?=count($jobs); ?></h5>
               </div>
            </div>
        </div> -->
        <div class="row my-4">
            <div class="col-md-6">
                <?php if(!empty($jobs)): 
                    foreach($jobs as $key=>$job):
                ?>
                <div class="card">
                  <div class="card-body">
                    <a href="javascript:void(0)" class="job-summary" job_id="<?=$job->job_id; ?>">
                        <h5><?=substr($job->job_title,0,70); ?></h5>
                        <div class="d-flex justify-content-between mt-3">
                            <p><i class="fa fa-user font-weight-bold"></i> <?=$job->recruiter; ?></p>
                            <p><i class="fa fa-map-marker"></i> <?=$job->job_location; ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-archive"></i> <?=$job->experience; ?></p>
                            <p><i class="fa fa-rupee"></i> <?=$job->salary; ?></p>
                        </div>
                        <p><i class="fa fa-cogs"></i> <?=$job->skills; ?></p>
                        <span><i class="fa fa-file"></i> <?=substr($job->job_desc,0,70); ?></span>
                    </a>
                  </div>
                </div>
                <?php 
                    endforeach;
                    endif; 
                ?>
            </div>
            <div class="col-md-6">
                <div class="card">
                  <div class="card-body job-details">
                    <center><h3>Job Details</h3></center>
                    <ul>
                        <li>
                            <h5>Job Title</h5>
                            <p class="job-title"></p>
                        </li>
                        <li>
                            <h5>Recruiter</h5>
                            <p class="recruiter"></p>
                        </li>
                        <li>
                            <h5>Job Location</h5>
                            <p class="location"></p>
                        </li>
                        <li>
                            <h5>Job Description</h5>
                            <p class="desc"></p>
                        </li>
                        <li>
                            <h5>Experience</h5>
                            <p class="experience"></p>
                        </li>
                        <li>
                            <h5>Skills</h5>
                            <p class="skills"></p>
                        </li>
                        <li>
                            <h5>Qualification</h5>
                            <p class="qualification"></p>
                        </li>
                            
                        <li>
                            <h5>Salary</h5>
                            <p class="salary"></p>
                        </li>
                        <li>
                            <h5>Company Phone</h5>
                            <p class="phone"></p>
                        </li>
                        <li>
                            <h5>Company Email</h5>
                            <p class="email"></p>
                        </li>
                    </ul>
                    <div class="apply-btn text-center d-none">
                        <button type="button" class="btn btn-primary apply-now" >Apply Now</button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- add job modal -->
<div class="modal Modal_" id="jobModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#753a88">
                <h5 class="modal-title _fwg500_ _fs16_ nwFntSt text-white">Post New Job</h5>
                <a class="i-con-h-a" data-dismiss="modal"><i class="mr-2 i-con i-con-close text-white"></i></a>
            </div>
            <!-- Modal Header -->
            <div class="modal-body">
                <form id="jobApplyForm" method="POST" action="<?php echo base_url('student/apply_job'); ?>">
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Candidate Name<span class="text-danger">*</span></label>
                            <input type="text" name="student_name" class="form-control makeReqin student_name" required autocomplete="new">
                        </div>
                   
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Qualification</label>
                            <input type="text" name="qualification" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Experience</label>
                            <input type="text" name="experience" class="form-control makeReqin" required autocomplete="new">
                        </div>
                   
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Skills</label>
                            <input type="text" name="skills" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div>

                   <!--  <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Upload Resume</label>
                            <input type="file" name="resume" class="form-control makeReqin" required autocomplete="new">
                        </div>
                    </div> -->

                    <div class="row m-t-16">
                        <div class="col-12 form-group">
                            <input type="hidden" name="job_id" id="job_id">
                            <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                            <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                            <button type="submit" class=" svebtn" style="float:right">Send Now</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- / end modal -->

<script>
$("#jobApplyForm").on('submit',function(e){
  e.preventDefault();
  var form = $(this)[0]; // You need to use standard javascript object here
  var formData = new FormData(form);
  $.ajax({
    type: this.getAttribute('method'),
    url: this.getAttribute('action'),
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function(){
      $('.loadingMyprofile').show();
      $(':submit').attr('disabled','disabled');
    },

    success: function(res){
      $('.loadingMyprofile').hide();
      $(':submit').removeAttr('disabled');
      var data = JSON.parse(res);
      if(data.status == false){
        if(data.errormessage){
          vNotify.error({text:data.errormessage, title:'Error!'});
        }
      }

      if(data.status == true){
        vNotify.success({text:data.message});
        setTimeout(function(){
          location.reload();
        }, 1000);
      }
    }
  })
})
</script>

<script>
    $(".job-summary").on('click',function(){
        var job_id = $(this).attr('job_id');
        $.ajax({
            type : 'GET',
            url : '<?=base_url(); ?>student/get_job_details',
            data : {job_id : job_id},
            success : function(res){
                var data = JSON.parse(res);
                $(".job-details .job-title").html(data.job_title);
                $(".job-details .recruiter").html(data.recruiter);
                $(".job-details .location").html(data.job_location);
                $(".job-details .desc").html(data.job_desc);
                $(".job-details .experience").html(data.experience);
                $(".job-details .skills").html(data.skills);
                $(".job-details .qualification").html(data.qualification);
                $(".job-details .salary").html(data.salary);
                $(".job-details .phone").html(data.company_phone);
                $(".job-details .email").html(data.company_email);
                $(".apply-btn").removeClass('d-none');
                $(".apply-now").attr('job_id',data.job_id);
            }
        });
    });
</script>

<script> 
    $(".apply-now").on('click',function(){
        var job_id = $(this).attr('job_id');
        var job_title = $(".job-details .job-title").html();
        var candidate_name = '<?=$this->session->userdata('name'); ?>';
        $("#jobModal").modal('show');
        $("#jobModal .modal-title").html(job_title);
        $("#jobModal .student_name").val(candidate_name);
        $("#jobModal #job_id").val(job_id);
    });
</script>
