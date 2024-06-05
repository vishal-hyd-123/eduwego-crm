<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="description" content="Responsive, Bootstrap, BS4" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <!-- style -->
     
      <link rel="manifest" href="<?php echo base_url(); ?>assets/dashboard/favicon/manifest.json">
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
    </style>
</head>
<body>
<div class="page_bg_clr p-b-40">
	<!-- Header section -->
	<div class="container p-t-30 p-b-20">
		<div class="row">
			<div class="col-12 col-sm-5 text-center">
				<div class="logo_main">
					<img class="nextynFavLogo_" src="<?php echo base_url(); ?>assets/dashboard/img/enquiry_logo.png">
				</div>
			</div>
			<div class="col-12 col-sm-7 text-center">
				<span class="_blckClr_ fs-24">SVGN Trust</span>
				<p class="m-b-0"><span class="_mhrnclr_ fs-24">THE CAPITOL</span> <span class="_blckClr_ fs-24"> Group of Institutions</span></p>
				<p class="_blckClr_ fs-18 m-b-0">No 144, Machohalli, Adjacent to Sri Vani Vidya Kendra, Magadi Main Road, Bangalore 560091</p>
				<span><a href="" class="_blckClr_ m-r-16 fs-18">www.capitolcolegeofnursing.in</a></span> <span class="_blckClr_"> <a class="_blckClr_ fs-18" href="">www.svgntrust.in</a></span>
			</div>
		</div>
	</div>
	<!-- Header section End-->
	 <form method="POST" action="<?php echo base_url()."institute/"?>submitonlineenquiry"  enctype="multipart/form-data">
		<div class="_bgwht_ appli_form_main">
			<h3 class="fs-30 _mhrnclr_ ">Application Form</h3>
		</div>
		<div class="container p-t-30">
		<!-- form upper section -->
			<div class="row">
				
				<div class="col-12 col-sm-4 col-lg-5">
					<label class="_blckClr_ fs-14">Admission Number: </label>
					<input type="text" name="admisn_number" class="admisn_numb" disabled="disabled">
					<!-- <input type="text" name="" class="admisn_number_input m-r-10">
					<input type="text" name="" class="admisn_number_input">
					<input type="text" name="" class="admisn_number_input m-r-10">
					<input type="text" name="" class="admisn_number_input">
					<input type="text" name="" class="admisn_number_input">
					<input type="text" name="" class="admisn_number_input">
					<input type="text" name="" class="admisn_number_input"> -->
				</div>
				<div class="col-12 col-sm-4 col-lg-4">
					<label class="_blckClr_ fs-14">Serial Number:</label>
					<input type="text" name="serial_number" class="make_Reqin" disabled="disabled">
				</div>
				<div class=" col-12 col-sm-4 col-lg-3  position_relative">
					<label class="passport_img_main" for="profileImage">
						<img src="" id="profileImg" >
						<input type="file" name="profileImage" onchange="getProfileImage(this)" id="profileImage" hidden required>
						<p id="getText">Affix your Passport size photograph here</p>
					</label>
				</div>
			</div>
			
			<!-- form upper section end -->
			<!-- Students Information -->
			<div class="_mhrnbg_ student_info_main">
				<h3 class="_wtClr_ fs-14 m-b-0">Students Information</h3>
			</div>
			<div class="row">
				<div class="col-12 padding">
	                <div class="form-group row">
	                  <div class="col-12 col-sm-8">
	                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Full Name*</label>
	                     <input id="name" type="text" name="name" class="form-control makeReqin" required autocomplete="new">
	                  </div>
	                  <div class="col-12 col-sm-4">
	                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Dob</label>
	                     <input id="dob" type="text" name="dob" class="form-control makeReqin" required autocomplete="new">
	                  </div>
	                </div>
	                <div class="form-group row">
	                  <div class="col-12 col-sm-8">
	                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Father Name*</label>
	                     <input id="father_name" type="text" name="father_name" class="form-control makeReqin" required autocomplete="new">
	                  </div>
	                  <div class="col-12 col-sm-4">
	                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Father Number*</label>
	                     <input id="father_mo_number" type="text" name="father_mo_number" class="form-control makeReqin" required autocomplete="new">
	                  </div>
	                </div>
	                <div class="form-group row">
	                  <div class="col-12 col-sm-8">
	                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mothers Name*</label>
	                     <input id="mothersname" type="text" name="mothersname" class="form-control makeReqin" required autocomplete="new">
	                  </div>
	                  <div class="col-12 col-sm-4">
	                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Mobile Number*</label>
	                     <input id="mother_mo_number" type="text" name="mother_mo_number" class="form-control makeReqin" required autocomplete="new">
	                  </div>
	                </div>
	                <div class="form-group row">
	                  <div class="col-12 col-sm-4">
	                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Natianality*</label>
	                     <input id="mothersname" type="text" name="natianality" class="form-control makeReqin" required autocomplete="new">
	                  </div>
	                  <div class="col-12 col-sm-4">
	                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Caste*</label>
	                     <input id="mother_mo_number" type="text" name="caste" class="form-control makeReqin" required autocomplete="new">
	                  </div>
	                  <div class="col-12 col-sm-4">
	                     <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Sex*</label>
	                     <input id="sex" type="text" name="sex" class="form-control makeReqin" required autocomplete="new">
	                  </div>
	                </div>
	                <div class="form-group row">
	                	<div class="col-12">
	                		<label class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Nationality Citizenship No.</label>
	                		<input id="nationality_citizen_number" type="text" name="nationality_citizen" class="form-control makeReqin" required autocomplete="new">
	                	</div>
	                </div>
				</div>
			</div>
			<!-- Students Information End-->
			<!-- Course Apply For: -->
			<div class="_mhrnbg_ student_info_main">
				<h3 class="_wtClr_ fs-14 m-b-0">Course Apply For:</h3>
			</div>
			<div class="row">
				<div class="col-12 col-sm-4 col-lg-4">
					<div class="p-t-30">
						<div class="row">
							<div class="col-12 col-sm-6">
								 <div class="">
								 	<label class="checkbox_enquiry">
			                        <input type="radio" name="course_applied_for" value="GNM" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-14 _blckClr_">GNM</label>
								 </div>
								 <div class="m-t-25">
								 	<label class="checkbox_enquiry">
			                        <input type="radio" name="course_applied_for" value="B.Sc. Nursing" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-14 _blckClr_">B.Sc. Nursing</label>
								 </div>
								 <div class="m-t-25">
								 	<label class="checkbox_enquiry">
			                        <input type="radio" name="course_applied_for" value="P.C.B.Sc. Nursing" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-14 _blckClr_">P.C.B.Sc. Nursing</label>
								 </div>
							</div>
							<div class="col-12 col-sm-6">
								<h2 class="_blckClr_ fs-14 mobl_vw_m">M.Sc. Nursing</h2>
								<div class="m-t-25">
								 	<label class="checkbox_enquiry">
			                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing Pediatric" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-14 _blckClr_">Pediatric</label>
								 </div>
								 <div class="m-t-25">
								 	<label class="checkbox_enquiry">
			                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing Medical Surgical" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-14 _blckClr_">Medical Surgical</label>
								 </div>
								 <div class="m-t-25">
								 	<label class="checkbox_enquiry">
			                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing Community" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-14 _blckClr_">Community</label>
								 </div>
								 <div class="m-t-25">
								 	<label class="checkbox_enquiry">
			                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing OBG" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-14 _blckClr_">OBG</label>
								 </div>
								 <div class="m-t-25">
								 	<label class="checkbox_enquiry">
			                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing Pshychiatry" class="pivileges singleInput">
			                        <span class="checkmark_enquiry"></span>
			                        </label>
			                        <label class="m-l-30 fs-14 _blckClr_">Pshychiatry</label>
								 </div>
							</div>
						</div>
					</div>
					<h3 class="fs-14 _blckClr_ margn_top_res">Paramedical</h3>
					<div class="row">
						<div class="col-12 col-sm-6">
							<div>
							 	<label class="checkbox_enquiry">
		                        <input type="radio" name="course_applied_for" value="Pediatric" class="pivileges singleInput">
		                        <span class="checkmark_enquiry"></span>
		                        </label>
		                        <label class="m-l-30 fs-14 _blckClr_">Pediatric</label>
							 </div>
						</div>
						<div class="col-12 col-sm-6">
							<div>
							 	<label class="checkbox_enquiry">
		                        <input type="radio" name="course_applied_for" value="Pediatric" class="pivileges singleInput">
		                        <span class="checkmark_enquiry"></span>
		                        </label>
		                        <label class="m-l-30 fs-14 _blckClr_">Pediatric</label>
							 </div>
						</div>
					</div>
				</div>
				<!-- table section -->
				<div class="col-sm-4">
					<div class="p-t-30">
						<table class="table table-bordered srored_table" width="100%;">
							<tr class="text-center">
								<th colspan="2" class="padding-10">Marks Scored in Class XII</th>
							</tr>
							<tr class="text-center">
								<td class="padding-10" width="50%">Subject</td>
								<td class="padding-10" width="50%">Scored</td>
							</tr>
							<tr>
								<td class="padding-10" width="50%"><input type="text" name="sub1" class="scored_input"></td>
								<td class="padding-10" width="50%"><input type="text" name="score1" class="scored_input"></td>
							</tr>
							<tr>
								<td class="padding-10" width="50%"><input type="text" name="sub2" class="scored_input"></td>
								<td class="padding-10" width="50%"><input type="text" name="score2" class="scored_input"></td>
							</tr>
							<tr>
								<td class="padding-10" width="50%"><input type="text" name="sub3" class="scored_input"></td>
								<td class="padding-10" width="50%"><input type="text" name="score3" class="scored_input"></td>
							</tr>
							<tr>
								<td class="padding-10" width="50%"><input type="text" name="sub4" class="scored_input"></td>
								<td class="padding-10" width="50%"><input type="text" name="score4" class="scored_input"></td>
							</tr>
							<tr>
								<td class="padding-10" width="50%"><input type="text" name="sub5" class="scored_input"></td>
								<td class="padding-10" width="50%"><input type="text" name="score5" class="scored_input"></td>
							</tr>
							<tr>
								<td class="padding-10" width="50%"><span class="m-l-30">Total</span></td>
								<td class="padding-10" width="50%"><input type="text" name="Tscore" class="scored_input"></td>
							</tr>
							<tr class="border">
								<td class="padding-10" width="50%"><span class="m-l-30">Percentage</span></td>
								<td class="padding-10" width="50%"><input type="text" name="Pscore" class="scored_input"></td>
							</tr>
						</table>
					</div>
					<div class="m-t-30">
					 	<label class="checkbox_enquiry">
	                    <input type="checkbox" value="" class="pivileges singleInput">
	                    <span class="checkmark_enquiry"></span>
	                    </label>
	                    <label class="m-l-30 fs-14 _blckClr_">Dialysis</label>
					</div>
				</div>
				<!-- form section -->
				<div class="col-12 col-sm-4 col-lg-4">
					<div class="p-t-30">
						<div class="m-b-15">
							<label class="fs-14 _blckClr_">Last Exam Passed</label>
							<input type="text" name="last_exam_pass" class="scored_detail_input">
						</div>
						<div class="m-b-15">
							<label class="fs-14 _blckClr_">Board Name</label>
							<input type="text" name="board_name" class="scored_detail_input">
						</div>
						<div class="m-b-15">
							<label class="fs-14 _blckClr_">Year of Passing</label>
							<input type="text" name="year_of_passing" class="scored_detail_input">
						</div>
						<div class="m-b-15">
							<label class="fs-14 _blckClr_">Registration No.</label>
							<input type="text" name="registration_no" class="scored_detail_input">
						</div>
						<div class="m-b-15">
							<label class="fs-14 _blckClr_">10+2 School Name</label>
							<input type="text" name="school_name_twelth" class="scored_detail_input">
						</div>
					</div>
				</div>
			</div>
			<!-- Cource apply for end -->
			<!-- Student Contact Information start -->
			<div class="_mhrnbg_ student_info_main m-t-170">
				<h3 class="_wtClr_ fs-14 m-b-0">Student Contact Information</h3>
			</div>
			<div class="padding">
				<div class="row">
					<div class="col-12 col-sm-6">
						<div class="m-b-15">
							<label class="fs-14 _blckClr_">Permanent Address</label>
							<textarea class="permanent_address" name="permanent_address"></textarea>
						</div>
						<div>
							<label class="fs-14 _blckClr_">Student Mobile Number</label>
							<input type="text" name="student_mobile_number" class="student_input">
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<div class="m-b-12 m-t-768">
							<label class="fs-14 _blckClr_">Local Guardian Address</label>
							<textarea class="local_address" name="local_address"></textarea>
						</div>
						<div class="m-b-15">
							<label class="fs-14 _blckClr_">Relation with Student</label>
							<input type="text" name="relation_with_student" class="student_input">
						</div>
						<div class="m-b-15">
							<label class="fs-14 _blckClr_">Mobile Number</label>
							<input type="text" name="mob_number" class="student_input">
						</div>
					</div>
				</div>
			</div>
			<!--  -->
            <div class="modal-footer"style="width: 100%;display: none;">
              <div class="col-12">
                <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
                <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                 <button type="submit" class="svebtn"  style="float:right">Save & Next</button>
              </div>
           </div>
		</div>
	<!-- </form> -->
	<!-- <form> -->
		<div class="_bgwht_ appli_form_main">
			<h3 class="fs-30 _mhrnclr_ ">Application Form</h3>
		</div>
		<div class="container">
			<!-- DOcument required start  -->
			<div class="_mhrnbg_ student_info_main m-t-20">
				<h3 class="_wtClr_ fs-14 m-b-0">Document Required Affix Photocopies (Original to be Produced at the time of Admission)</h3>
			</div>
			<div class="padding">
				<div class="row">
					<div class="col-12 col-sm-6">
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">SSLC Marks Sheet</label>
						</div>
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">II PUC/10+2/PDC Marks Sheet/”A”Level</label>
						</div>
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">Transfer Certificate</label>
						</div>
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">Conduct Certificiate (Issued from institute last studied)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">Migration certificate from the Concern University/Board</label>
						</div>
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">Recent 4 Passport  &  1 stamp size latest colour photographs</label>
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">Citizenship proof (Aadhar, Passport, Nagarikta)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">Student Passport Visa (for foreign nationals)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">Degree Certificates & Marks Sheets (for PG Programs)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">Income & Caste Certificate (if applicable)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiry">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiry"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 _blckClr_">Diploma Certificate/ Marks Sheets/ Registration for  Pc. B.Sc.</label>
						</div>
					</div>
				</div>
			</div>
			<!-- DOcument required End -->
			<!-- Declaration start -->
			<div class="_mhrnbg_ student_info_main m-t-20">
				<h3 class="_wtClr_ fs-14 m-b-0">Declaration</h3>
			</div>
			<div class="padding">
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
					<div class="col-12 col-sm-4">
						<div>
							<label class="fs-14 _blckClr_">Date:</label>
							<input type="text" name="date" class="form_input examDate"  data-toggle="datepicker">
						</div>
						<div>
							<label class="fs-14 _blckClr_">Place:</label>
							<input type="text" name="date" class="form_input">
						</div>
					</div>
					<div class="col-12 col-sm-4">
						<div style="position: relative;">
							<label class="signatureDiv" for="imgInp">
								<img id="blah" class="getSignedImage">
								<input type="file" name="father_sign" hidden="" onchange="readURLFirst(this);" id="imgInp" required>
								<div class="_df4df_">
									Signature of Father/Guardian
								</div>
							</label>
						</div>
					</div>
					<div class="col-12 col-sm-4">
						<div style="position: relative;">
							<label class="signatureDiv" for="imgInp1">
								<img id="blah1" class="getSignedImage">
								<input type="file" hidden="" name="student_sign" onchange="readURLSecnd(this);" id="imgInp1" required>
								<div class="_df4df_">
									Signature of Student
								</div>
							</label>
						</div>
					</div>
				</div>
			</div>
			<!-- Declaration End -->
			<!-- For Office Use Start -->
			<div class="_mhrnbg_ student_info_main m-t-20">
				<h3 class="_wtClr_ fs-14 m-b-0">For Office Use Only</h3>
			</div>
			<div class="text-center m-t-30">
				<h3 class="fs-14 _mhrnclr_">FEES DETAILS</h3>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr class="text-center">
								<th class="fs-14 _blckClr_"><span>Course</span></th>
								<th class="fs-14 _blckClr_"><span>1st Year</span></th>
								<th class="fs-14 _blckClr_"><span>2nd Year</span></th>
								<th class="fs-14 _blckClr_"><span>3rd Year</span></th>
								<th class="fs-14 _blckClr_"><span>4th Year</span></th>
							</tr>
							<tr>
								<td class="padding-10">
									<div>
									 	<label class="checkbox_enquiry">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">GNM</label>
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
							</tr>
							<tr>
								<td class="padding-10">
									<div>
									 	<label class="checkbox_enquiry">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">B.Sc. Nursing</label>
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
							</tr>
							<tr>
								<td class="padding-10">
									<div>
									 	<label class="checkbox_enquiry">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">P.C.B.Sc. Nursing</label>
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
							</tr>
							<tr>
								<td class="padding-10">
									<div>
									 	<label class="checkbox_enquiry">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_">M.Sc. Nursing</label>
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
							</tr>
							<tr>
								<td class="padding-10">
									<div>
									 	<label class="checkbox_enquiry">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiry"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 _blckClr_ ">Paramedical</label>
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scored_input" readonly></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row m-t-30">
				<div class="col-12 col-sm-4">
					<div class="office_section">
						<div class="text-center p-t-10">
							<h3 class="fs-14 _blckClr_">Admitted By</h3>
						</div>
						<div class="m-t-30">
							<label class="fs-14 _blckClr_">Name:</label>
							<input type="text" name="admitted_by" class="form_input_ofc" autocomplete="off" readonly>
						</div>
						<div>
							<label class="fs-14 _blckClr_">Mobile Number:</label>
							<input type="text" name="mob-number" class="form_input_ofc" readonly>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div class="office_section">
						<div class="text-center p-t-10 height-100">
							<h3 class="fs-14 _blckClr_">Verified By</h3>
						</div>
						<div class="m-t-30">
							<label class="fs-14 _blckClr_">Name:</label>
							<input type="text" name="varified_by" class="form_input_ofc" autocomplete="off" readonly>
						</div>
					</div>
				</div>
				<div  class="col-12 col-sm-4">
					<div class="office_section">
						<div class="text-center p-t-10 height-100">
							<h3 class="fs-14 _blckClr_">Entered By</h3>
						</div>
						<div class="m-t-30">
							<label class="fs-14 _blckClr_">Name:</label>
							<input type="text" name="entered_by" class="form_input_ofc" autocomplete="off" readonly>
						</div>
					</div>
				</div>
			</div>
			<!-- For Office Use End -->
			<!-- <div class="modal-footer m-t-20"> -->
				<div class="row justify-content-center m-t-30">
	              <div class="col-12 col-sm-6 btnposition">
	                <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
	              </div>
	              <div class="col-12 col-sm-6 btn_position">
	                <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
	                 <button type="submit" class="svebtn btn">Save</button>
	              </div>
	           </div>
			<!-- </div> -->
           <div class="_mhrnbg_ student_info_main m-t-20 text-right">
				<h3 class="_wtClr_ fs-14 m-b-0">Marketing By: ASGK Health Care Hub Pvt. Ltd.</h3>
			</div>
		</div>
		<!--  -->
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

</body>
</html>