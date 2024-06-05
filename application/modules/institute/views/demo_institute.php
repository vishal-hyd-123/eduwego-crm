<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="description" content="" />
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

		@media print {
		  footer {page-break-after: always;}
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
			background: #9cc5e6;
		}

		.oxford_text_clr{
			color: #04053d;
		}
		
		.srored-table .fnt_red_clr{
			color: #ea1717e6!important;
		}

		.clg-heading h1{
			font-size: 45px;
			margin-bottom: 0;
			text-align: center;
		}

		.courses{
			border: 2px solid #3A7F78;
			padding: 12px;
			margin: 5px;
		}

		.courses input{
			margin:10px;
		}

		.course_name{
			width: 100%;
			padding: 12px;
			background: #3A7F78;
			color: white;
		}

		@media only screen and (max-width: 768px)
		{
			.clg-heading h1,h3{
				text-align: center;
			}
		}
    </style>
</head>
<body>
<div class="oxford_bg_clr p-b-40">
<!-- Header section -->
<div class="container p-t-30 p-b-20">
	<?php  
	if($this->session->flashdata('insert_error'))
	{
	?>
	<div class="row mt-3">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="alert alert-danger alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong><?=$this->session->flashdata('insert_error') ?></strong>
			</div>
		</div>
		<div class="col-3"></div>
	</div>
    <?php 
	} 
	?>
	<form id="admisn-form" method="POST" action="<?php echo base_url();?>institute/admissionDetails/<?php echo $this->uri->segment(2); ?>" enctype="multipart/form-data">
		<div class="row">
			<div class="col-12 col-md-2 text-center">
				<div class="logo_main_">
					<img class="nextynFavLogo_" src="<?=base_url(); ?>uploads/<?=$institute[0]->institute_logo; ?>">
				</div>
			</div>
			<div class="col-12 col-md-10 clg-heading">
				
				<h1 class="oxford_text_clr fw-600">Zeqoon Group of Institutions<h1>
				<p class="institute_addss_p">Bettahalsoor Cross, International Airport Road, B.B Road, Bangalore -562157</p>
				
		    </div>
		
		</div>
	
		<div class="container mt-5">
			<div class="row justify-content-center">
				
				<div class="col-12">
					<div class="row justify-content-center">
						<div class="col-12">
							<div class="m-t-25 appli_form_main">
								<h3 class="fs-30 oxford_text_clr fw-600">Application Form</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-12">
					<div class="border_of_form">
						<div class="padding-20">
							<div class="row">
								<div class="col-md-9">

									<div class="courses">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Course Applied For*</label>
									<?php 
										 $institute_id = $institute[0]->institute_id;
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
										 				?>
										 				<input type="radio" name="course_applied_for" value="<?=$stream->stream_name; ?>" stream_id="<?=$stream->stream_id; ?>" course_id="<?=$course->course_id; ?>" class="pivileges singleInput streamInput"> <?=$stream->stream_name; ?>
										 				<?php
										 			}
										 		}
										 	}
										 }
										?>
										<input type="hidden" name="course_id" value="<?=set_value('course_id'); ?>" />
										<input type="hidden" name="stream_id" value="<?=set_value('stream_id'); ?>" />
										<span class="text-danger"><?=form_error('course_applied_for'); ?></span>
									</div>
									
								</div>
								<div class="col-12 col-md-2 mt-2">
									<label class="_passport_img_main_" for="profileImage">
										<img src="" id="profileImg">
										<input type="file" name="profileImage" onchange="getProfileImage(this)" value="<?=set_value('profileImage'); ?>" id="profileImage" style="opacity:0" required />
										<p id="getText">Affix your <br/>Passport size photograph here</p>
									</label>
									</br>
									<span class="text-danger"><?=$this->session->flashdata('profile_photo_error'); ?></span>
								</div> 
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Full Name*</label>
								</div>
								<div class="col-12 col-md-9">
									<input id="name" type="text" name="name" value="<?=set_value('name'); ?>" class="form-control makeReqin" required autocomplete="new">
									<span class="text-danger"><?=form_error('name'); ?></span>
								</div>
							</div>
						</div>	
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Gender*</label>
								</div>
								<div class="col-12 col-md-9">
									<!-- <input id="sex" type="text" name="sex" class="form-control makeReqin" required autocomplete="new"> -->
									<div class="dis-inline-block">
										<label class="checkbox_enquiry m-t-10">
				                        <input type="radio" name="sex" value="Male" value="<?=set_value('sex'); ?>" class="pivileges singleInput">
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">Male</label>
				                    </div>
				                    <div class="dis-inline-block">
				                        <label class="checkbox_enquiry m-t-10">
				                        <input type="radio" name="sex" value="Female" value="<?=set_value('sex'); ?>" class="pivileges singleInput">
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">Female</label>
				                    </div>
									<span class="text-danger"><?=form_error('sex'); ?></span>
								</div>
							</div>
						</div>	
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Father Name*</label>
								</div>
								<div class="col-12 col-md-9">
									<input id="father_mo_number" type="text" name="father_name" value="<?=set_value('father_name'); ?>" class="form-control makeReqin" required autocomplete="new">
									<span class="text-danger"><?=form_error('father_name'); ?></span>
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Mother Name*</label>
								</div>
								<div class="col-12 col-md-9">
									<input id="mother_name" type="text" name="mother_name" value="<?=set_value('mother_name'); ?>" class="form-control makeReqin" required autocomplete="new">
									<span class="text-danger"><?=form_error('mother_name'); ?></span>
								</div>
							</div>
						</div>
						
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-6">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Present Address*</label>
									<textarea class="permanent_address current_address" name="present_address"><?=set_value('present_address'); ?></textarea>
									<span class="text-danger"><?=form_error('present_address'); ?></span>
								</div>
								<div class="col-12 col-md-6">

									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Permanent Address*</label>
									<br/>
									<input type="checkbox" class="same_as_present" /> Same as Present Address
									<textarea class="permanent_address perm_address" name="permanent_address" ><?=set_value('permanent_address'); ?></textarea>
									<span class="text-danger"><?=form_error('permanent_address'); ?></span>
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Student Email Id.*</label>
								</div>
								<div class="col-12 col-md-9">
									<input id="mother_name" type="text" name="student_email" <?=set_value('student_email'); ?> class="form-control makeReqin" required autocomplete="new">
									<span class="text-danger"><?=form_error('student_email'); ?></span>
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Student Mobile Number* :</label>
								</div>
								<div class="col-12 col-md-3">
									<input type="text" name="student_mobile_number" <?=set_value('student_mobile_number'); ?> class="student_mon_inpt form-control" maxlength="10">
									<span class="text-danger"><?=form_error('student_mobile_number'); ?></span>
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Parent's Mobile No* :</label>
								</div>
								<div class="col-12 col-md-3">
									<input id="father_mo_number" type="text" name="father_mo_number" <?=set_value('father_mo_number'); ?> class="student_mon_inpt form-control" maxlength="10" required autocomplete="new">
									<span class="text-danger"><?=form_error('father_mo_number'); ?></span>
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">DOB* :</label>	
								</div>
								<div class="col-12 col-md-3">
									 <input id="dob" type="text" name="dob" <?=set_value('dob'); ?> class="examDate student_mon_inpt form-control" required autocomplete="off">
									 <span class="text-danger"><?=form_error('dob'); ?></span>
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Place of birth :</label>
								</div>
								<div class="col-12 col-md-3">
									<input  type="text" name="placeOfBirth" <?=set_value('placeOfBirth'); ?> class="student_mon_inpt form-control" required autocomplete="new">
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Nationality* :</label>	
								</div>
								<div class="col-12 col-md-3">
									 <input id="nationality_citizen_number" type="text" name="natianality" <?=set_value('natianality'); ?> class="student_mon_inpt form-control" required autocomplete="new">
									 <span class="text-danger"><?=form_error('natianality'); ?></span>
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Aadhar No. :</label>
								</div>
								<div class="col-12 col-md-3">
									<input  type="text" name="nationality_citizen" <?=set_value('nationality_citizen'); ?> class="student_mon_inpt form-control" maxlength="16" required autocomplete="new">
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Father's Profession:</label>
							
								</div>
								<div class="col-12 col-md-3">
									<input type="text" name="father_Profession" <?=set_value('father_Profession'); ?> class="student_mon_inpt form-control">
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Annual income of family<br> from all sources:</label>
								</div>
								<div class="col-12 col-md-3">
									<input type="text" name="income_all" <?=set_value('income_all'); ?> class="student_mon_inpt form-control" required autocomplete="new">
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="row m-t-30">
							<div class="col-12 text-center">
								<div class="padding-20">
									<h3 class="oxford_text_clr fs-24 m-b-0">
										Educational Qualifications
									</h3>
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12">
									<label class="fs-14 fw-600 _blckClr_">Year of passing II PUC/Equivalent Examination :</label>	
									<input  type="text" name="year_of_passing" <?=set_value('year_of_passing'); ?> class="w-full student_mon_inpt form-control" required autocomplete="new">
									<span class="text-danger"><?=form_error('year_of_passing'); ?></span>
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Marks :</label>	
									<p class="fs-14 _blckClr_">
										Obtained in II PUC/ <br>Equivalent Examination
									</p>
								</div>
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Total Marks</label><br/>
									<input type="text" name="extra_exam_total1" <?=set_value('extra_exam_total1'); ?> class="scored_input form-control">
									<span class="text-danger"><?=form_error('extra_exam_total1'); ?></span>
								</div>
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Marks Secured</label><br/>
									<input type="text" name="extra_exam_mark1" <?=set_value('extra_exam_mark1'); ?> class="scored_input form-control">
									<span class="text-danger"><?=form_error('extra_exam_mark1'); ?></span>
								</div>
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Percentage</label><br/>
									<input type="text" name="extra_exam_perc1" <?=set_value('extra_exam_perc1'); ?> class="scored_input form-control">
									<span class="text-danger"><?=form_error('extra_exam_perc1'); ?></span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-12">
								<table class="table table-bordered" width="100%;">
									<tr>
										<td colspan="3">
											<span>Name of University / Board:<input type="text" name="board_name" <?=set_value('board_name'); ?> class="scored_input form-control"></span>
											<span class="text-danger"><?=form_error('board_name'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<span>Name of College / School:<input type="text" name="school_name_twelth" <?=set_value('school_name_twelth'); ?> class="scored_input form-control"></span>
											<span class="text-danger"><?=form_error('school_name_twelth'); ?></span>
										</td>
									</tr>
									<tr class="text-center">
										<th colspan="3" class="padding-10 oxford_text_clr">Marks Scored in Last Qualifying Examination</th>
									</tr>
									<tr class="text-center">
										<td class="padding-10" width="40%">Subject</td>
										<td class="padding-10" width="30%">Marks Obtained</td>
										<td class="padding-10" width="30%">Percentage</td>
									</tr>
									<tr>
										<td class="padding-10 text-center" width="40%"><input type="text" name="sub1" <?=set_value('sub1'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="score1" <?=set_value('score1'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="perc1" <?=set_value('perc1'); ?> class="scored_input"></td>
									</tr>
									<tr>
										<td class="padding-10 text-center" width="40%"><input type="text" name="sub2" <?=set_value('sub2'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="score2" <?=set_value('score2'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="perc2" <?=set_value('perc2'); ?> class="scored_input"></td>
									</tr>
									<tr>
										<td class="padding-10 text-center" width="40%"><input type="text" name="sub3" <?=set_value('sub3'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="score3" <?=set_value('score3'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="perc3" <?=set_value('perc3'); ?> class="scored_input"></td>
									</tr>
									<tr>
										<td class="padding-10 text-center" width="40%"><input type="text" name="sub4" <?=set_value('sub4'); ?> class="scored_input "></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="score4" <?=set_value('score4'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="perc4" <?=set_value('perc4'); ?> class="scored_input"></td>
									</tr>
									<tr>
										<td class="padding-10 text-center" width="40%"><input type="text" name="sub5" <?=set_value('sub5'); ?> class="scored_input "></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="score5" <?=set_value('score5'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="perc5" <?=set_value('perc5'); ?> class="scored_input"></td>
									</tr>
									<tr>
										<td class="padding-10 text-center" width="40%"><input type="text" name="sub6" <?=set_value('sub6'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="score6" <?=set_value('score6'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="perc6" <?=set_value('perc6'); ?> class="scored_input"></td>
									</tr>
									<tr>
										<td align="right" class="padding-10 text-center" width="40%"><span class="m-l-30">Total</span></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="Tscore" <?=set_value('Tscore'); ?> class="scored_input"></td>
										<td class="padding-10 text-center" width="30%"><input type="text" name="Pscore" <?=set_value('Pscore'); ?> class="scored_input"></td>
									</tr>
								</table>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<h3 class="fs-14 fw-600 _blckClr_">Please encode the following certificate</h3>
							<div class="row m-t-16">
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">12th Marks Card</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" id="twelfth_marks" name="twelfth_marks" <?=set_value('twelfth_marks'); ?> class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">10th Marks Card</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="tenth_marks" <?=set_value('tenth_marks'); ?> class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">Migration Certificate</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="migration" <?=set_value('migration'); ?> class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">10th Admit Card</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="admit_card" <?=set_value('admit_card'); ?> class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">School leaving Certificate</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="school_leaving" <?=set_value('school_leaving'); ?> class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">10 Passport Size Photograph</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="photograph" <?=set_value('photograph'); ?> class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12">
									<div>
									 	<label class="checkbox_enquiry">
				                        <input type="checkbox" value="" class="pivileges singleInput" required>
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">I declare that above information is true and correct to the best of my knowledge and belief. In case any of the above information is found to be false and incorrect, I shall forfeit the clain to considered for a seat in the nursing college. I and /or my parent/guardian will also be liable for such civil/criminal action may take against me/us in this behalf. </label>
									</div>
									<p class="m-t-20 fs-14 _blckClr_">*Antiragging affidavit has to be submitted before joining.</p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-md-4">
									<div>
										<label class="fs-14 _blckClr_">Date:</label>
										<input type="text" name="submission_date" <?=set_value('submission_date'); ?> class="examDate form-control"  data-toggle="datepicker">
									</div>
									<div>
										<label class="fs-14 _blckClr_">Place:</label>
										<input type="text" name="submission_place" <?=set_value('submission_place'); ?> class="form-control">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div style="position: relative;">
										<label class="signatureDiv" for="imgInp">
											<img id="blah" class="getSignedImage">
											<input type="file" name="father_sign" <?=set_value('father_sign'); ?> style="opacity:0" onchange="readURLFirst(this);" id="imgInp" required />
											<div class="_df4df_">
												Signature of Father/Guardian
											</div>
										</label>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div style="position: relative;">
										<label class="signatureDiv" for="imgInp1">
											<img id="blah1" class="getSignedImage">
											<input type="file" style="opacity:0" name="student_sign" <?=set_value('student_sign'); ?> onchange="readURLSecnd(this);" id="imgInp1" required />
											<div class="_df4df_">
												Signature of Student
											</div>
										</label>
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
				                <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
				                 <button type="submit" class="svebtn btn">Save</button>
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
  	<script type="text/javascript">
  		function readURLFirst(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

       function readURLSecnd(input) {
		  if (input.files && input.files[0]) {
		    var reader = new FileReader();
		    
		    reader.onload = function(e) {
		      $('#blah1').attr('src', e.target.result);
		    }
		    
		    reader.readAsDataURL(input.files[0]);
		  }
		}

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