<style>
    .fa{
        color: #8E294F;
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
        
        <div class="table-responsive">
            <div class="page-title p-b-40 m-b-20 pt20">
                <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

                <span class="item-except mrm5 displayBlck _wtClr_ _fs14_ text-" style="float: right;">
                <button class="btn _fs14_ _bgbrwn_ i-con-h-a job-post-btn">+ Post New Job</button></span>
                
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-6">
                <?php if(!empty($jobs)): 
                    foreach($jobs as $key=>$job):
                ?>
                <div class="card">
                  <div class="card-body">
                    <div class="action-btns">
                        <i class="fa fa-trash" job_id="<?=$job->job_id;?>"></i>
                    </div>
                    <a href="javascript:void(0)" class="job-summary" job_id="<?=$job->job_id; ?>">
                        <h5><?=substr($job->job_title,0,70); ?></h5>
                        <div class="d-flex justify-content-between">
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
                <form id="jobAddForm" method="POST" action="<?php echo base_url('admin/add_job_new'); ?>">
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Job Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control makeReqin" autocomplete="new">
                            <span class="text-danger"><?=form_error('title'); ?></span>
                        </div>
                   
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Job Location<span class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control makeReqin" autocomplete="new">
                            <span class="text-danger"><?=form_error('location'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Job Recruiter</label>
                            <input type="text" name="recruiter" class="form-control makeReqin" autocomplete="new">
                            <span class="text-danger"><?=form_error('recruiter'); ?></span>
                        </div>
                   
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Qualification</label>
                            <input type="text" name="qualification" class="form-control makeReqin" autocomplete="new">
                            <span class="text-danger"><?=form_error('qualification'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Experience</label>
                            <input type="text" name="experience" class="form-control makeReqin" autocomplete="new">
                            <span class="text-danger"><?=form_error('experience'); ?></span>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Salary</label>
                            <input type="text" name="salary" class="form-control makeReqin" autocomplete="new">
                            <span class="text-danger"><?=form_error('salary'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Skills</label>
                            <input id="text" type="text" name="skills" class="form-control makeReqin" autocomplete="new">
                            <span class="text-danger"><?=form_error('skills'); ?></span>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Company Email</label>
                            <input type="email" name="company_email" class="form-control makeReqin" autocomplete="new">
                            <span class="text-danger"><?=form_error('company_email'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Company Phone</label>
                            <input type="number" name="phone" class="form-control makeReqin"  autocomplete="new">
                            <span class="text-danger"><?=form_error('phone'); ?></span>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Company Website Link</label>
                            <input type="website" name="website" class="form-control makeReqin" autocomplete="new">
                            <span class="text-danger"><?=form_error('website'); ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Job Description</label>
                            <textarea name="job_desc" class="form-control makeReqin" height="200px"></textarea>
                            <span class="text-danger"><?=form_error('job_desc'); ?></span>
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
<!-- / end modal -->

<script>
    $(".job-post-btn").on('click',function(){
        $("#jobModal").modal('show');
    });
</script>

<script>
$("#jobAddForm").on('submit',function(e){
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
            url : '<?=base_url(); ?>admin/get_job_details',
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
            }
        });
    });
</script>

<script>
    $(".action-btns .fa-trash").on('click',function(){
        var job_id = $(this).attr('job_id');
        var conf = confirm("Are you sure ?");
        $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>admin/delete_job',
            data : {job_id : job_id},
            success : function(res){
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
        });
        
    });
</script>
