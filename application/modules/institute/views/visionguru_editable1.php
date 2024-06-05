<!DOCTYPE html>
<html>
<head>
	<title>VISION GURU</title>
	<meta name="description" content="Online Admission Application Form - CNK GROUP OF INSTITUTIONS" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <!-- style -->
     
      <link rel="manifest" href="<?php echo base_url(); ?>assets/dashboard/favicon/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="assets/dashboard/favicon/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/i-con.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/theme.css" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower-components/DataTables/DataTables/css/dataTables.bootstrap4.min.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower-components/datepicker/dist/datepicker.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/style.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/util.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/expert.css" type="text/css" />
      <style>
      <style>
      .error-message {position: absolute;font-size: 12px;color: red;left: 15px;}
      .box-shadows{
	       box-shadow: 0px 0px 11px rgba(0, 0, 0, 0.25);
	   }
	   .padding-10 {
			padding: 8px 3px!important;
			vertical-align: inherit!important;}
		.table-bordered td, .table-bordered th{
			border:1px solid #333!important;
			color: #000 !important}
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			  -webkit-appearance: none;
			  margin: 0;
		}
		.checkbox_enquiry .pivileges:checked ~ .checkmark_enquiry {
		    background: #ec2725!important;
		}
		
		.for_signature_img{
			height: 100%;
			width: 100%;
			/*background: #efefef;*/
			margin-bottom: 10px;
		}
	   ._nwcntn_ {
		    width: 270px;
		    border: 1px solid transparent;
		    border-radius: 4px;
		    z-index: 10000 !important;
		}
		._nwulmn_ {
		    width: 100% !important;
		    background: #FCFCFD;
		    padding: 10px 0 !important;
		}

		@page {
		    size: auto;
		    margin: 0;
		}

		@media only screen and (max-width: 414px){
			.form-group{
				margin-bottom: 0px;
			}
		}

		.fnt_red_clr{
			color: #ea1717e6;
		}

		.oxford_bg_clr{
			/*background: #13c290;*/
		}

		.oxford_text_clr{
			color: #04053d;
		}
		
		.srored-table .fnt_red_clr{
			color: #ea1717e6!important;
		}

		.main-con{
			border: 1px solid #09664c;
		}

		.clg_header{
			/*background: #3A7F78;*/
			padding: 20px;
		}
		.clg-heading h2{
			
		}
		.clg-heading p{
			font-size: 17px;
		}

		.clg-heading div{
			width: 70%;
			font-size: 17px;
			padding: 5px;
			border-radius: 10px;
		}

		.app-no{
			/*border: 2px solid #3A7F78;*/
			margin: 5px;
		}

		.courses{
			/*border: 2px solid #3A7F78;*/
			padding: 12px;
			margin: 5px;
		}

		.courses input{
			margin: 4px;
		}

		.session-yr{
			text-align: center;
			align-items: center;
			margin-top: 30px;
		}

		.candidate-details{
			/*border: 2px solid #3A7F78;*/
		}

		.course_name{
			width: 100%;
			padding: 6px;
			background: #cb444a;
			color: white;
		}

		#q-table th,td{
			padding: 5px;
		}

		.vision{
			font-family: sans-serif;
			color: #2C61A2;
		}
		.vision-logo img{
			width: 72%;
		}
		.fileDiv{
			background: #fff;
			width: 100%;
			height: 170px;
			text-align: center;
			cursor: pointer;
		}

		.fileDiv img{
			width: 100%;
			height: 100%;
		}

		@media print {
		  .vision-logo{
		  	width: 100%;
		  }
		  .vision-logo img{
		  	width: 120px;
		  }

		  .clg-heading{
		  	width: 80%;
		  }
		  .clg-heading img{
		  	width: 50%;
		  }
		  footer {page-break-after: always;}
		}

		@media only screen and (max-width: 768px)
		{

			.main-con{
				width: 100%;
			}

			.clg-heading h1,h3{
				text-align: center;
			}
		}
    </style>
</head>
<body>

<!-- Header section -->
<div class="container-fluid main-con">
	<form id="admisn-form" method="POST" action="<?php echo base_url();?>institute/admissionDetails/<?php echo $this->uri->segment(2); ?>" enctype="multipart/form-data">
		<div class="row clg_header">
			<div class="col-12 col-md-3 text-center">
				<div class="vision-logo">
					<img class="" src="<?php echo base_url(); ?>assets/dashboard/img/visionguru-logo.png">
				</div>
			</div>
			<div class="col-12 col-md-6 clg-heading my-2">
				<center>
					<img class="nextynFavLogo_" src="<?php echo base_url(); ?>assets/dashboard/img/visionguru-header.png">
					<div class="bg-danger">MEMBERSHIP APPLICATION PROCESS</div>
				</center>
		    </div>
		    <div class="col-12 col-md-3 text-center">
		    	<?php $img_url = base_url().'uploads/'.$details[0]->student_photo; ?>
				<label class="_passport_img_main_" for="profileImage">
					<img src="<?=$img_url ?>" id="profileImg" >
				</label>
			</div>
		</div>
		<div class="container-fluid mt-3">
			<div class="row">
				<div class="col-md-9">
					<div class="padding-20">
						<div class="row">
							<div class="col-12 col-md-4">
								<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Name Of The Candidate*</label>
							</div>
							<div class="col-12 col-md-8">
								<input id="name" type="text" name="name" class="form-control makeReqin" required autocomplete="new" value="<?=$details[0]->name; ?>">
							</div>
						</div>
					</div>
					
					<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-4">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Gender*</label>
								</div>
								<div class="col-12 col-md-8">
									<div class="dis-inline-block">
										<label class="checkbox_enquiry m-t-10">
				                        <input type="radio" name="sex" <?php if($details[0]->sex == "Male"){echo "checked";} ?> value="Male" class="pivileges singleInput"  />
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">Male</label>
				                    </div>
				                    <div class="dis-inline-block">
				                        <label class="checkbox_enquiry m-t-10">
				                        <input type="radio" name="sex" value="Female" <?php if($details[0]->sex == "Female"){echo "checked";} ?> class="pivileges singleInput">
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">Female</label>
				                    </div>
								</div>
							</div>
						</div>	
						
						<div class="padding-20">
							<div class="row">
								<div class="col-md-4">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Father Name*</label>
								</div>
								<div class="col-md-8">
									<input id="" type="text" name="father_name" class="form-control makeReqin" value="<?=$details[0]->father_name; ?>" required autocomplete="new">
								</div>
							</div>
						</div>
						
						<div class="padding-20">
							<div class="row">
								<div class="col-md-4">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Mother Name*</label>
								</div>
								<div class="col-md-8">
									<input id="" type="text" name="mother_name" class="form-control makeReqin" value="<?=$details[0]->mother_name; ?>" required autocomplete="new">
								</div>
							</div>
						</div>
				</div>
				<div class="col-md-3">
					<div class="app-no">
						<center><h5 style="font-weight:bold">Courses</h5></center>
					</div>
					<div class="courses">
						<?php 
						 $institute_id = $institute->institute_id;
						 $courses = $this->db->query("SELECT course_id,course_name FROM courses WHERE institute_id = '".$institute_id."' AND course_status = '1' ")->result();
						 if(!empty($courses))
						 {
						 	foreach($courses as $course)
						 	{
						 		$course_id = $course->course_id;
						 		
						 	?>
						 		<div class="course_name text-capitalize"><?=$course->course_name; ?></div>
						 	<?php
						 		$streams = $this->db->query("SELECT stream_id,stream_name FROM streams WHERE course = '".$course_id."' AND institute_id = '".$institute_id."' AND stream_status = '1' ")->result();
						 		if(!empty($streams))
						 		{
						 			foreach($streams as $stream)
						 			{
						 				$checked = $stream->stream_id == $details[0]->stream_id ? 'checked' : '';
						 				?>
						 				<input type="radio" name="course_applied_for" value="<?=$stream->stream_name; ?>" stream_id="<?=$stream->stream_id; ?>" course_id="<?=$course->course_id; ?>" class="pivileges singleInput streamInput" <?php if($stream->stream_id == $details[0]->stream_id){echo "checked";} ?> > <?=$stream->stream_name; ?>
						 				<?php
						 			}
						 		}
						 	}
						 }
						?>
						<input type="hidden" name="course_id" />
						<input type="hidden" name="stream_id" />
						
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-12">
					<div class="candidate-details">
						<div class="padding-20">
							<div class="row">
								<div class="col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Email Id.*</label>
								</div>
								<div class="col-md-9">
									<input type="email" name="student_email" class="form-control makeReqin" value="<?=$details[0]->student_email; ?>" required autocomplete="new">
								</div>
								
							</div>
						</div>
						
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-6">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Present Address*</label>
									<textarea class="permanent_address current_address" name="present_address"><?=$details[0]->present_address; ?></textarea>
								</div>
								<div class="col-12 col-md-6">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Permanent Address*</label>
									<br/>
									<input type="checkbox" class="same_as_present" /> Same as Present Address
									<textarea class="permanent_address perm_address" name="permanent_address"><?=$details[0]->permanent_address; ?></textarea>
								</div>
							</div>
						</div>
						
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Student Mobile Number*</label>
							
								</div>
								<div class="col-12 col-md-3">
									<input type="text" name="student_mobile_number" class="student_mon_inpt form-control" value="<?=$details[0]->student_mobile_number; ?>" maxlength="10">
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Parent's Mobile No.*</label>
								</div>
								<div class="col-12 col-md-3">
									<input id="father_mo_number" type="text" name="father_mo_number" class="student_mon_inpt form-control" maxlength="10" value="<?=$details[0]->father_mo_number; ?>" required autocomplete="new">
								</div>
							</div>
						</div>
						
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">DOB*</label>	
								</div>
								<div class="col-12 col-md-3">
									 <input id="dob" type="text" name="dob" class="examDate student_mon_inpt form-control" value="<?=$details[0]->dob; ?>" required autocomplete="off">
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Place of birth :</label>
								</div>
								<div class="col-12 col-md-3">
									<input  type="text" name="placeOfBirth" class="student_mon_inpt form-control" value="<?=$details[0]->birth_place; ?>" required autocomplete="new">
								</div>
							</div>
						</div>
						
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Nationality :</label>	
								</div>
								<div class="col-12 col-md-3">
									 <input id="nationality_citizen_number" type="text" name="natianality" class="student_mon_inpt form-control" value="<?=$details[0]->natianality; ?>" required autocomplete="new">
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Aadhar No. :</label>
								</div>
								<div class="col-12 col-md-3">
									<input  type="text" name="nationality_citizen" class="student_mon_inpt form-control" value="<?=$details[0]->nationality_citizen; ?>" maxlength="16" required autocomplete="new">
								</div>
							</div>
						</div>
						
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Father's Profession:</label>
							
								</div>
								<div class="col-12 col-md-3">
									<input type="text" name="father_Profession" value="<?=$details[0]->father_Profession; ?>" class="student_mon_inpt form-control">
								</div>
							</div>
							<div class="row m-t-16">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Annual income of family<br> from all sources:</label>
								</div>
								<div class="col-12 col-md-3">
									<input type="text" name="income_all" class="student_mon_inpt form-control" value="<?=$details[0]->annual_income; ?>" required autocomplete="new">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-12">
								<table id="q-table" class="table table-bordered table-responsive" width="100%">
									<thead>
										<tr>
											<th></th>
											<th>INSTITUTION/COLLEGE</th>
											<th>STREAM</th>
											<th>PERCENTAGE(%)</th>
											<th>PASSING YEAR</th>
										</tr>
								   </thead>
								   <tbody>
										<tr>
											<th>10th</th>
											<td><input type="text" class="form-control" name="tenth_inst" value="<?=$details[0]->tenth_inst; ?>" /></td>
											<td><input type="text" class="form-control" name="tenth_stream" value="<?=$details[0]->tenth_stream; ?>" /></td>
											<td><input type="number" class="form-control" name="tenth_percent" value="<?=$details[0]->tenth_percent; ?>" /></td>
											<td><input type="number" class="form-control" name="tenth_pass_year" value="<?=$details[0]->tenth_pass_year; ?>" /></td>
										</tr>
										<tr>
											<th>12th</th>
											<td><input type="text" class="form-control" name="twelth_inst" value="<?=$details[0]->twelth_inst; ?>" /></td>
											<td><input type="text" class="form-control" name="twelth_stream" value="<?=$details[0]->twelth_stream; ?>" /></td>
											<td><input type="number" class="form-control" name="twelth_percent" value="<?=$details[0]->twelth_percent; ?>" /></td>
											<td><input type="number" class="form-control" name="twelth_pass_year" value="<?=$details[0]->twelth_pass_year; ?>" /></td>
										</tr>
										<tr>
											<th>Graduation</th>
											<td><input type="text" class="form-control" name="grad_inst" value="<?=$details[0]->grad_inst; ?>" /></td>
											<td><input type="text" class="form-control" name="grad_stream" value="<?=$details[0]->grad_stream; ?>" /></td>
											<td><input type="number" class="form-control" name="grad_percent" value="<?=$details[0]->grad_percent; ?>" /></td>
											<td><input type="number" class="form-control" name="grad_pass_year" value="<?=$details[0]->grad_pass_year; ?>" /></td>
										</tr>
									</tbody>	
								</table>
							</div>
						</div>

						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-2">
									<label class="fs-14 fw-600 _blckClr_">Preferred Location :</label>	
								</div>
								<div class="col-12 col-md-4">
									 <input type="text" name="pref_location" class="form-control" value="<?=$details[0]->preferred_location; ?>" autocomplete="new">
								</div>
							</div>
						</div>
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-2">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Preferred College :</label>
								</div>
								<div class="col-12 col-md-3">
									<input  type="text" name="pref_college1" class="form-control" value="<?=$details[0]->pref_college1; ?>" autocomplete="new">
								</div>
								<div class="col-12 col-md-3">
									<input  type="text" name="pref_college2" class="form-control" value="<?=$details[0]->pref_college2; ?>" autocomplete="new">
								</div>
								<div class="col-12 col-md-3">
									<input  type="text" name="pref_college3" class="form-control" value="<?=$details[0]->pref_college3; ?>" autocomplete="new">
								</div>
							</div>
						</div>

						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-2">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Apply for scholarship</label>
								</div>
								<div class="col-12 col-md-10">
									<input type="radio" name="scholarship" value="Yes" <?php if($details[0]->scholarship == "Yes"){echo "checked";}  ?> />Yes
									<input type="radio" name="scholarship" value="No" <?php if($details[0]->scholarship == "No"){echo "checked";}  ?> />No
								</div>
							</div>
						</div>

						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Are you being assisted by any of our conselor ?</label>
								</div>
								<div class="col-12 col-md-5">
									<?php $disabled = $_SESSION['institute'] ? '' : 'disabled'; ?>
									<select class="form-control" name="associate" <?=$disabled ?>>
										<option value="">No</option>
										<?php 
											$institute_id = $institute->institute_id;
											$staffs = $this->db->query("SELECT employee_id,employee_name,emp_code FROM staff WHERE institute_id = '".$institute_id."' AND employee_status = 2 ")->result();
											if(!empty($staffs))
											{
												foreach($staffs as $key=>$staff)
												{
													?>
													<option value="<?=$staff->employee_id; ?>" <?php if($staff->employee_id == $details[0]->assisted_by){echo "selected";} ?>  ><?=$staff->employee_name; ?></option>
													<?php
												}
											}
										?>

									</select>
								</div>
							</div>
						</div>

						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-2">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Any Entrance Exam ?</label>
								</div>
								<div class="col-12 col-md-5">
									<input type="text" name="entrance_exam" class="form-control makeReqin" value="<?=$details[0]->entrance_exam; ?>" />
								</div>
							</div>
						</div>

						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-4">
									<div style="position: relative;">
										<label class="fileDiv" for="imgInp">
											<?php if($details[0]->tenth_marksheet != ""){
												?>
												<img src="<?=base_url().'uploads/'.$details[0]->tenth_marksheet; ?>" class="getSignedImage">
												<?php
											} ?>
											<div class="_df4df_">
												Tenth Marksheet
											</div>
										</label>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div style="position: relative;">
										<label class="fileDiv" for="imgInp1">
											<?php if($details[0]->twelth_marksheet != ""){
												?>
												<img src="<?=base_url().'uploads/'.$details[0]->twelth_marksheet; ?>" class="getSignedImage">
												<?php
											} ?>
											<div class="_df4df_">
												Twelth Marksheet
											</div>
										</label>
									</div>
									
								</div>
								<div class="col-12 col-md-4">
									<div style="position: relative;">
										<label class="fileDiv" for="imgInp1">
											<?php if($details[0]->grad_marksheet != ""){
												?>
												<img src="<?=base_url().'uploads/'.$details[0]->grad_marksheet; ?>" class="getSignedImage">
												<?php
											} ?>
										</label>
										<div class="_df4df_">
											Graduaion Marksheet
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="padding-20">
							<div class="row justify-content-center m-t-30">
				              <div class="col-12 col-md-6 btnposition">
				                <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
				              </div>
				              <div class="col-12 col-md-6 btn_position">
				                <button type="button" class="btn print-btn" style="background:#CB444A;color:white">Print</button>
				              </div>
				           </div>
				        </div>
					</div>
				</div>
			</div>
		</div>
	
	</form>
	<!-- </form> -->
</div>

	<script src="<?php echo base_url(); ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower-components/datepicker/dist/datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script> 
 	<script src="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>
 
 	<script type="text/javascript">
     window.base_url = './';
  	</script> 
  <!-- Bootstrap -->
  	<script src="<?php echo base_url(); ?>assets/dashboard/libs/datatables/media/js/jquery.dataTables.min.js"></script>
  
  	<script src="<?php echo base_url(); ?>assets/dashboard/libs/pace-progress/pace.min.js"></script>
  <!-- <script src="<?php //echo base_url(); ?>assets/dashboard/libs/pjax/pjax.js"></script> -->
  <!-- <script src="<?php //echo base_url(); ?>assets/dashboard/js/ajax.js"></script> -->
  <!-- lazyload plugin -->
  	<script src="<?php echo base_url(); ?>assets/dashboard/js/lazyload.config.js"></script>
  	<script src="<?php echo base_url(); ?>assets/dashboard/js/lazyload.js"></script>
  	<script src="<?php echo base_url(); ?>assets/dashboard/js/plugin.js"></script>
  	<!-- theme -->
  	<script src="<?php echo base_url(); ?>assets/dashboard/js/theme.js"></script>
  	<!-- <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script> -->
  <!-- endbuild -->
  	<script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/main.js"></script>

  	<script>
  		$(".print-btn").on('click',function(){
  			window.print();
  		});
  	</script>

  	<script type="text/javascript">
		function getProfileImage(input) {
		  if (input.files && input.files[0]) {
		    var reader = new FileReader();
		    
		    reader.onload = function(e) {
		      $('#profileImg').attr('src', e.target.result);
		      $('#profileImg').css({
		      	'width' : '100%',
		      	'height': '100%'
		      });
		      $('#getText').hide();
		    }
		    
		    reader.readAsDataURL(input.files[0]);
		  }
		}
  	</script>
  	<!-- <script type="text/javascript">
            const nwDate = $(".examDate").datepicker({
            autoHide: true,
            inline: false,
            container: null,
            format: 'dd/mm/yyyy',
            startView: 0,
            daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            itemTag: 'li',
            mutedClass: 'muted',
            pickedClass: 'picked',
            disabledClass: 'disabled',
            highlightedClass: 'highlighted',
            startDate: '+1d',
            weekStart: 1,
            template: '<div class="datepicker-container _nwcntn_">' + '<div class="datepicker-panel _nwpnt_" data-view="years picker">' + '<ul class="_nwul_ _nwulmn_">' + '<li class="_nwliyr_ _nwprmn_" data-view="years prev">&lsaquo;</li>' + '<li class="_nwlicr_ _nwcrmn_" data-view="years current"></li>' + '<li class="_nwlinx_ _nwprmn_" data-view="years next">&rsaquo;</li>' + '</ul>' + '<ul class="_nwulyr_" data-view="years"></ul>' + '</div>' + '<div class="_nwpnt_ datepicker-panel" data-view="months picker">' + '<ul class="_nwul_ _nwulmn_">' + '<li class="_nwliyr_ _nwprmn_" data-view="year prev">&lsaquo;</li>' + '<li class="_nwlicr_ _nwcrmn_" data-view="year current"></li>' + '<li class="_nwlinx_ _nwprmn_" data-view="year next">&rsaquo;</li>' + '</ul>' + '<ul class="_nwul_" data-view="months"></ul>' + '</div>' + '<div class="datepicker-panel _nwpnt_" data-view="days picker">' + '<ul class="_nwulmn_">' + '<li class="_nwprmn_" data-view="month prev">&lsaquo;</i></li>' + '<li class="_nwcrmn_" data-view="month current"></li>' + '<li class="_nwprmn_ _nwnxmn_" data-view="month next">&rsaquo;</li>' + '</ul>' + '<ul class="_nwulwk_" data-view="week"></ul>' + '<ul class="_nwuldy_" data-view="days"></ul>' + '</div>' + '</div>',
        });
    </script> -->

    <script>
    	$(".courses input[name=course_applied_for]").on('click',function(){
    		var course_id = $(this).attr('course_id');
    		var stream_id = $(this).attr('stream_id');
    		$("input[name=course_id]").val(course_id);
    		$("input[name=stream_id]").val(stream_id);
    	});
    </script>

    <script>
    	$(".same_as_present").on('click',function(){
    		if($(this).prop('checked') == true)
	   		{
	   			$present_address = $(".current_address").val();
	   			$(".perm_address").val($present_address);
	   		}else{
	   			$(".perm_address").val("");
	   		}
    	});
   		
    </script>

</body>
</html>