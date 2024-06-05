<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="description" content="Responsive, Bootstrap, BS4" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <!-- style -->
     
      <link rel="manifest" href="./assets/dashboard/favicon/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="assets/dashboard/favicon/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">

      <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet"> -->


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
		  .logo_main_{
		  	width: 150px;
		  	heght: 150px;
		  	
		  }
		  ._passport_img_main_{
		  	display: none;
		  }
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
		
		.srored-table .fnt_red_clr{
			color: #ea1717e6!important;
		}
		#profileImg{
			background-size: cover;
			height:100%;
		}
    </style>
</head>
<body>
<div class="page_bg_clr p-b-40">
	<!-- Header section -->
	<div class="container p-t-30 p-b-20">
		<div class="row">
			<div class="col-12 col-md-2 text-center">
				<div class="logo_main_">
					<img class="nextynFavLogo_" src="<?php echo base_url(); ?>assets/dashboard/img/sapthagiri_logo.png">
				</div>
			</div>
			<div class="col-12 col-md-10 text-center">
				<p class="fnt_blue_clr">Sri Raghavendra Educational Institutions Society (Regd.)</p>
				<h3 class="fs-42 text-danger fw-600">SAPTHAGIRI SCHOOL OF NURSING</h3>
				<h3 class="fs-42 text-danger fw-600">SRI KRISHNA COLLEGE OF NURSING</h3>
				<h3 class="fs-42 text-danger fw-600">SRI RAGHAVENDRA COLLEGE OF NURSING</h3>
				<p class="fnt_blue_clr font-weight-bold">No. 29/57, Chimey Hills, Pipeline Road, Next to Jindal Govt. School, Chikkabanavara P.O., Bengaluru - 560 090.<br/>
				E-mail : sapthagiri.nursing@gmail.com<br/>
				Website : www.sapthagirischoolofnursing.com</p>
				
			</div>
			
		</div>
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="contact_Main_Div">
					<h3 class="text-primary">APPLICATION FORM</h3>
				</div>
			</div>
		</div>
	</div>
	<form method="POST" action="<?php echo base_url()."institute/"?>editAdmissionDetails" enctype="multipart/form-data">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10">
				<div class="row justify-content-center">
					<div class="col-12 col-md-10">
						<div class="checkbox_for_corse_dv">
							<ul class="checkbox_for_corse_ul">
								<li>
									<label class="checkbox_enquiry m-t-10">
			                        <input type="radio" name="course_applied_for" value="{course_applied_for}" class="pivileges singleInput" checked>
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-18 _blckClr_">{course_applied_for}</label>
								</li>
								<li>
									<label class="checkbox_enquiry m-t-10">
			                        <input type="radio" name="course_applied_for" value="GNM" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-18 _blckClr_">GNM</label>
								</li>
								<li>
									<label class="checkbox_enquiry m-t-10">
			                        <input type="radio" name="course_applied_for" value="B.Sc. Nursing" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-18 _blckClr_">B.Sc. Nursing</label>
								</li>
								<li>
									<label class="checkbox_enquiry m-t-10">
			                        <input type="radio" name="course_applied_for" value="P.C.B.Sc. Nursing" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-18 _blckClr_">P.C.B.Sc. Nursing</label>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-12 text-center">
						<div class="m-t-25">
							<label class="_blckClr_ fs-14">Admission Number: </label>
							<input type="text" name="admisn_number" class="admisn_numb_inpt" value="{_admisn_number_}">
							<span class="fs-13">(For Office use only)</span>
						</div>
					</div>
					<div class="col-12">
						<div class="m-t-25 appli_form_main">
							<h3 class="fs-30 fnt_red_clr fw-600">Application Form</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-2">
				<label class="_passport_img_main_" for="profileImage">
					<img src="<?php echo base_url(); ?>uploads/{student_photo}" id="profileImg" >
					<input type="file" name="profileImage" id="profileImage" style="opacity:0"  value="<?php echo base_url(); ?>uploads/{student_photo}">
					<?php
					$photo = "{student_photo}";
					if($photo == "")
					{
						?>
							<p id="getText">Affix your Passport size photograph here</p>
						<?php
					}
					?>
				</label>
			</div>
		</div>
		<!-- Header section End-->
		<!-- form upper section -->
			<div class="row">
				<div class="col-12">
					<div class="border_of_form">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Full Name*</label>
								</div>
								<div class="col-12 col-md-9">
									<input id="name" type="text" name="name" class="form-control makeReqin" required autocomplete="new"  value="{name}">
								</div>
							</div>
						</div>	
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Gender</label>
								</div>
								<div class="col-12 col-md-9">
									<input id="sex" type="text" name="sex" class="form-control makeReqin" required autocomplete="new" value="{sex}">
									<!-- <div class="dis-inline-block">
										<label class="checkbox_enquiry m-t-10">
				                        <input type="radio" name="gender_type" value="Male" class="pivileges singleInput">
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">Male</label>
				                    </div>
				                    <div class="dis-inline-block">
				                        <label class="checkbox_enquiry m-t-10">
				                        <input type="radio" name="gender_type" value="GNM" class="pivileges singleInput">
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">Female</label>
				                    </div> -->
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
									<input id="father_mo_number" type="text" name="father_name" class="form-control makeReqin" required autocomplete="new"  value="{father_name}">
								</div>
							</div>
						</div>
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Postal address for communication</label>
								</div>
								<div class="col-12 col-md-9">
									<textarea class="permanent_address" name="permanent_address">{permanent_address}</textarea>
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Student Mobile Number :</label>
							
								</div>
								<div class="col-12 col-md-3">
									<input type="text" name="student_mobile_number" class="student_mon_inpt" value="{student_mobile_number}">
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Parent's Mobile No. :</label>
								</div>
								<div class="col-12 col-md-3">
									<input id="father_mo_number" type="text" name="father_mo_number" class="student_mon_inpt" required autocomplete="new" value="{father_mo_number}">
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">DOB :</label>	
								</div>
								<div class="col-12 col-md-3">
									 <input id="dob" type="text" name="dob" class="examDate student_mon_inpt" required autocomplete="off" value="{dob}">
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Place of birth :</label>
								</div>
								<div class="col-12 col-md-3">
									<input  type="text" name="placeOfBirth" class="student_mon_inpt" required autocomplete="new" value="{birth_place}">
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12">
									<label class="fs-14 fw-600 _blckClr_">Date of passing II PUC/Equivalent Examination :</label>	
									<input  type="text" name="year_of_passing" class="w-full student_mon_inpt" required autocomplete="new" value="{year_of_passing}">
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
									<label class="fs-14 fw-600 _blckClr_">Total Marks</label>
									<input type="text" name="extra_exam_total1" class="scored_input" value="{extra_exam_total1}">
								</div>
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Marks Secured</label>
									<input type="text" name="extra_exam_mark1" class="scored_input" value="{extra_exam_mark1}">
								</div>
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Percentage</label>
									<input type="text" name="extra_exam_perc1" class="scored_input" value="{extra_exam_perc1}">
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="padding-20">
							<div class="row">
								<div class="col-12 col-md-3">
									<label class="fs-14 fw-600 _blckClr_">Nationality :</label>	
								</div>
								<div class="col-12 col-md-3">
									 <input id="nationality_citizen_number" type="text" name="natianality" class="student_mon_inpt" required autocomplete="new" value="{natianality}">
								</div>
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Aadhar No. :</label>
								</div>
								<div class="col-12 col-md-3">
									<input  type="text" name="nationality_citizen" class="student_mon_inpt" required autocomplete="new" value="{nationality_citizen}">
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
									<input type="text" name="father_Profession" class="student_mon_inpt" value="{father_Profession}">
								</div>
							</div>
							<div class="row m-t-16">
								<div class="col-12 col-md-3">
									<label for="" class="col-form-label _fs14_ fw-600 _blckClr_ text-left">Annual income of family<br> from all sources:</label>
								</div>
								<div class="col-12 col-md-3">
									<input type="text" name="income_all" class="student_mon_inpt" required autocomplete="new" value="{annual_income}">
								</div>
							</div>
						</div>
						<hr class="hr_class">
						<div class="row m-t-30">
							<div class="col-12 text-center">
								<div class="padding-20 bg_red">
									<h3 class="_wtClr_ fs-24 m-b-0">
										Previous Academic Detail
									</h3>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<table class="table table-bordered srored-table" width="100%;">
									<tr>
										<td colspan="3">
											<span>Name of University / Board:<input type="text" name="board_name" class="scored_input" value="{board_name}"></span>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<span>Name of College / School:<input type="text" name="school_name_twelth" class="scored_input" value="{school_name_twelth}"></span>
										</td>
									</tr>
									<tr class="text-center">
										<th colspan="3" class="padding-10 fnt_red_clr">Marks Scored in Last Qualifying Examination</th>
									</tr>
									<tr class="text-center">
										<td class="padding-10" width="40%">Subject</td>
										<td class="padding-10" width="30%">Marks Obtained</td>
										<td class="padding-10" width="30%">Percentage</td>
									</tr>
									<tr>
										<td class="padding-10" width="40%"><input type="text" name="sub1" class="scored_input" value="{sub1}"></td>
										<td class="padding-10" width="30%"><input type="text" name="score1" class="scored_input" value="{score1}"></td>
										<td class="padding-10" width="30%"><input type="text" name="perc1" class="scored_input" value="{perc1}"></td>
									</tr>
									<tr>
										<td class="padding-10" width="40%"><input type="text" name="sub2" class="scored_input" value="{sub2}"></td>
										<td class="padding-10" width="30%"><input type="text" name="score2" class="scored_input" value="{score2}"></td>
										<td class="padding-10" width="30%"><input type="text" name="perc2" class="scored_input" value="{perc2}"></td>
									</tr>
									<tr>
										<td class="padding-10" width="40%"><input type="text" name="sub3" class="scored_input" value="{sub3}"></td>
										<td class="padding-10" width="30%"><input type="text" name="score3" class="scored_input" value="{score3}"></td>
										<td class="padding-10" width="30%"><input type="text" name="perc3" class="scored_input" value="{perc3}"></td>
									</tr>
									<tr>
										<td class="padding-10" width="40%"><input type="text" name="sub4" class="scored_input" value="{sub4}"></td>
										<td class="padding-10" width="30%"><input type="text" name="score4" class="scored_input" value="{score4}"></td>
										<td class="padding-10" width="30%"><input type="text" name="perc4" class="scored_input" value="{perc4}"></td>
									</tr>
									<tr>
										<td class="padding-10" width="40%"><input type="text" name="sub5" class="scored_input" value="{sub5}"></td>
										<td class="padding-10" width="30%"><input type="text" name="score5" class="scored_input" value="{score5}"></td>
										<td class="padding-10" width="30%"><input type="text" name="perc5" class="scored_input" value="{perc5}"></td>
									</tr>
									<tr>
										<td class="padding-10" width="40%"><input type="text" name="sub6" class="scored_input" value="{sub6}"></td>
										<td class="padding-10" width="30%"><input type="text" name="score6" class="scored_input" value="{score6}"></td>
										<td class="padding-10" width="30%"><input type="text" name="perc6" class="scored_input" value="{perc6}"></td>
									</tr>
									<tr>
										<td align="right" class="padding-10" width="40%"><span class="m-l-30">Total</span></td>
										<td class="padding-10" width="30%"><input type="text" name="Tscore" class="scored_input" value="{Tscore}"></td>
										<td class="padding-10" width="30%"><input type="text" name="Pscore" class="scored_input" value="{Pscore}"></td>
									</tr>
									<!-- <tr class="border">
										<td class="padding-10" width="40%"><span class="m-l-30">Percentage</span></td>
										<td class="padding-10" width="30%"><input type="text" name="Pscore" class="scored_input"></td>
										<td class="padding-10" width="30%"><input type="text" name="Pscore" class="scored_input"></td>
									</tr> -->
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
			                        <input type="checkbox" name="twelfth_marks" value="" class="pivileges singleInput" {twelfth_marks} >
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">10th Marks Card</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="tenth_marks" {tenth_marks} class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">Migration Certificate</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="migration" {migration} class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">10th Admit Card</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="admit_card" {admit_card} class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">School leaving Certificate</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="school_leaving" {school_leaving} class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
								</div>
								<div class="col-12 col-md-4">
									<label class="m-l-30 fs-14 _blckClr_">10 Passport Size Photograph</label>
									<label class="checkbox_enquiry" style="top:-30px;">
			                        <input type="checkbox" name="photograph" {photograph} class="pivileges singleInput">
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
				                        <label class="m-l-30 fs-14 _blckClr_">I/We pledged that all information provided herewith is true to best of our knowledge. I/We fully agree to abide by all the policies , rules and regulations of the institutions and in case of non-confirmation would accept the verdict of the institution as the final. I/We also understood and accept that in case of discontinuation of the course for any reason. I/We shall forgo the entire fee including deposite paid to the institution and not claim any reimbursements for compensations. </label>
									</div>
									<p class="m-t-20 fs-14 _blckClr_">*Antiragging affidavit has to be submitted before joining.</p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-md-4">
									<div>
										<label class="fs-14 _blckClr_">Date:</label>
										<input type="text" name="submission_date" class="form_input examDate"  data-toggle="datepicker" value="{submission_date}">
									</div>
									<div>
										<label class="fs-14 _blckClr_">Place:</label>
										<input type="text" name="submission_place" class="form_input" value="{submission_place}" >
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div style="position: relative;">
										<label class="signatureDiv" for="imgInp">
											<img id="blah" class="getSignedImage" src="<?php echo base_url();?>uploads/{father_sign}">
											<input type="file" name="father_sign" style="opacity:0" id="father_sign" value="{father_sign}">
											<div class="_df4df_">
												Signature of Father/Guardian
											</div>
										</label>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div style="position: relative;">
										<label class="signatureDiv" for="imgInp1">
											<img id="blah1" class="getSignedImage" src="<?php echo base_url();?>uploads/{student_sign}">
											<input type="file" style="opacity: 0" name="student_sign" id="student_sign" value="{student_sign}">
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
							<input type="hidden" name="enquiry_id" value="{online_enquiry_id}">
				              <div class="col-12 col-md-6 btnposition">
				                <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
				              </div>
				              <div class="col-12 col-md-6 btn_position">
				                <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
				                
				                 <button type="submit" class="svebtn btn">Save</button>	
				                <button type="button" class="print_btn btn">Print</button>
				              </div>
				           </div>
				        </div>
					</div>
				</div>
			</div>
		</div>
	<!-- </form> -->
	</form>
</div>


	<script src="<?php echo base_url(); ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower-components/datepicker/dist/datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script> 
 	<script src="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>
 
 	<script type="text/javascript">
     window.base_url = '<?php echo base_url(); ?>';
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
  	<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
  <!-- endbuild -->
  	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/main.js"></script> -->
  	<script type="text/javascript">
  		// function readURLFirst(input) {
    //         if (input.files && input.files[0]) {
    //             var reader = new FileReader();

    //             reader.onload = function (e) {
    //                 $('#blah')
    //                     .attr('src', e.target.result);
    //             };

    //             reader.readAsDataURL(input.files[0]);
    //         }
    //     }

  //      function readURLSecnd(input) {
		//   if (input.files && input.files[0]) {
		//     var reader = new FileReader();
		    
		//     reader.onload = function(e) {
		//       $('#blah1').attr('src', e.target.result);
		//     }
		    
		//     reader.readAsDataURL(input.files[0]);
		//   }
		// }

		// $("#profileImage").on('change',function(){
		// 	if (this.files && this.files[0]) {
		// 		var blob = URL.createObjectURL(this.files[0]);
		// 		$('#profileImg').attr('src',blob);
		//     //var reader = new FileReader();
		//     // reader.onload = function(e) {
		//     //   $('#profileImg').attr('src', e.target.result);
		//     //   $('#getText').hide();
		//     // }
		//     	$(this).val(this.files[0]);
		//   }
		// });
		 

  	</script>
  	<script type="text/javascript">
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
    </script>

    <script>
    	$(".print_btn").on("click",function(){
    		window.print(function(){
    			$(".logo_main_ img").css('text-align','center');
    		});
    	});
    </script>

</body>
</html>