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
		.office_section_{
			width: 100%!important;
		}
		.get_Text {
		    position: absolute;
		    top: 38%;
		    left: 0;
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
		@media only screen and (max-width: 768px)
		{
			.get_Text {
			    position: unset!important;
			    top: 38%;
			    left: 0;
			}
		}
		@media only screen and (max-width: 414px){
			.form-group{
				margin-bottom: 0px;
			}
		}


		/*onlin application form*/
		.bg_grn{
			background: #299629bd;
		}
    </style>
</head>
<body>
<div class="page_grn_bg_clr p-b-40">
	<!-- Header section -->
	<div class="container p-t-30 p-b-20">
		<div class="row justify-content-center">
			<div class="col-11 text-center">
				<h1 class="institute_name_h1">SOWRABHA INSTITUTE OF NURSING SCIENCE</h1>
				<p class="institute_addss_p">Recognisezd by the Govt. of Karnataka and Affiliated to KSNC & INC New Delhi</p>
			</div>
		</div>
	</div>
	<div class="container-fluid p-l-16 p-r-16">
		<div class="row">
			<div class="col-12 col-md-2 text-center">
				<div style="position: relative;">
					<div class="text-center sowrabha_logo_main" style="">
						<img  src="<?php echo base_url(); ?>assets/dashboard/img/logoMain.png">
					</div>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<h2 class="fs-24 fnt_red_clr fw-600">REGISTER OFFICE : </h2>
				<p class="fs-14 fnt_grn_clr fw-600">Rajkiran Building, Near Rural Police Station, <br>General Kariyappa Road, K.E. Extn., Tumkur 572 101.</p>
			</div>
			<div class="col-12 col-md-4 text-center">
				<h2 class="fs-24 fnt_red_clr fw-600">CAMPUS OFFICE : </h2>
				<p class="fs-14 fnt_grn_clr fw-600">Magadi Main Road, Vishwaneedam Post, <br>Bangalore - 560 091</p>
			</div>
			<div class="col-12 col-md-2 passportImgCenter position_relative">
				<label class="passportImgMain" for="profileImage">
					<img src="" id="profileImg" >
					<input type="file" name="profileImage" onchange="getProfileImage(this)" id="profileImage" hidden required>
					<p id="getText" class="get_Text">Affix your Passport size photograph here</p>
				</label>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-11">
				<div class="contact_Main_Div">
					<p class="fs-20 fnt_grn_clr m-b-0"><span>Mob <a class="fs-20 fnt_grn_clr" href="tel: 960 6688 111 ">960 6688 111 </a></span> / <span>E-mail <a class="fs-20 fnt_grn_clr" href="mailto: sincbangalore@gmail.com"> sincbangalore@gmail.com</a></span> / <span><a class="fs-20 fnt_grn_clr" href="#">www.sowrabhainstituteofnursing.in</a></span>
					</p>
				</div>
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
				
				<div class="col-12">
					<label class="fnt_grn_clr fs-14">Admission Number: </label>
					<input type="text" name="admisn_number" style="width: 50%" class="admisn_numb" disabled="disabled"  value="{_admisn_number_}">
					<!-- <input type="text" name="" class="admisn_number_input m-r-10">
					<input type="text" name="" class="admisn_number_input">
					<input type="text" name="" class="admisn_number_input m-r-10">
					<input type="text" name="" class="admisn_number_input">
					<input type="text" name="" class="admisn_number_input">
					<input type="text" name="" class="admisn_number_input">
					<input type="text" name="" class="admisn_number_input"> -->
				</div>
				<!-- <div class="col-12 col-sm-4 col-lg-4">
					<label class="fnt_grn_clr fs-14">Serial Number:</label>
					<input type="text" name="serial_number" class="make_Reqin" disabled="disabled">
				</div>
				<div class=" col-12 col-sm-4 col-lg-3  position_relative">
					<label class="passport_img_main" for="profileImage">
						<img src="" id="profileImg" >
						<input type="file" name="profileImage" onchange="getProfileImage(this)" id="profileImage" hidden required>
						<p id="getText">Affix your Passport size photograph here</p>
					</label>
				</div> -->
			</div>
			
			<!-- form upper section end -->
			<!-- Students Information -->
			<div class="bg_grn student_info_main">
				<div class="">
					<h3 class="_wtClr_ fs-14 m-b-0 fw-600">Students Information</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-12 padding">
	                <div class="form-group row">
	                  <div class="col-12 col-md-8">
	                     <label for="" class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Full Name*</label>
	                     <input id="name" type="text" name="name" class="form-control _inputField_ dis-inline-block" required autocomplete="new" value="{name}">
	                  </div>
	                  <div class="col-12 col-md-4">
	                     <label for="" class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Dob</label>
	                     <input id="dob" type="text" name="dob" class="form-control _inputField_ dis-inline-block examDate" required autocomplete="new" value="{dob}">
	                  </div>
	                </div>
	                <div class="form-group row">
	                  <div class="col-12 col-md-8">
	                     <label for="" class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Father Name*</label>
	                     <input id="father_name" type="text" name="father_name" class="form-control _inputField_ dis-inline-block" required autocomplete="new" value="{father_name}">
	                  </div>
	                  <div class="col-12 col-md-4">
	                     <label for="" class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Father Number*</label>
	                     <input id="father_mo_number" type="text" name="father_mo_number" class="form-control _inputField_ dis-inline-block" required autocomplete="new" value="{father_mo_number}">
	                  </div>
	                </div>
	                <div class="form-group row">
	                  <div class="col-12 col-md-8">
	                     <label for="" class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Mothers Name*</label>
	                     <input id="mothersname" type="text" name="mothersname" class="form-control _inputField_ dis-inline-block" required autocomplete="new" value="{mothersname}">
	                  </div>
	                  <div class="col-12 col-md-4">
	                     <label for="" class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Mobile Number*</label>
	                     <input id="mother_mo_number" type="text" name="mother_mo_number" class="form-control _inputField_ dis-inline-block" required autocomplete="new" value="{mother_mo_number}">
	                  </div>
	                </div>
	                <div class="form-group row">
	                  <div class="col-12 col-md-4">
	                     <label for="" class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Natianality*</label>
	                     <input id="mothersname" type="text" name="natianality" class="form-control _inputField_ dis-inline-block" required autocomplete="new" value="{natianality}">
	                  </div>
	                  <div class="col-12 col-md-4">
	                     <label for="" class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Caste*</label>
	                     <input id="mother_mo_number" type="text" name="caste" class="form-control _inputField_ dis-inline-block" required autocomplete="new" value="{caste}">
	                  </div>
	                  <div class="col-12 col-md-4">
	                     <label for="" class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Sex*</label>
	                     <input id="sex" type="text" name="sex" class="form-control _inputField_ dis-inline-block" required autocomplete="new" value="{sex}">
	                  </div>
	                </div>
	                <div class="form-group row">
	                	<div class="col-12">
	                		<label class=" _fs14_ _fwg500_ fnt_grn_clr text-left dis-inline-block">Nationality Citizenship No.</label>
	                		<input id="nationality_citizen_number" type="text" name="nationality_citizen" class="form-control _inputField_ dis-inline-block" required autocomplete="new" value="{nationality_citizen}">
	                	</div>
	                </div>
				</div>
			</div>
			<!-- Students Information End-->
			<!-- Course Apply For: -->
			<div class="bg_grn p-b-30">
				<div class="bg_grn student_info_main">
					<h3 class="_wtClr_ fs-14 m-b-0 fw-600">Course Apply For:</h3>
				</div>
				<div class="bg_lyt_grn">
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="padding-30">
								<div class="row">
									<div class="col-12">
										 <div class="">
										 	<label class="checkbox_enquiryGrn">
					                        <input type="radio" name="course_applied_for" value="{course_applied_for}" class="pivileges singleInput" checked>
					                        <span class="checkmark_enquiryGrn"></span>
					                        </label>
					                        <label class="m-l-30 fs-24 fnt_red_clr fw-600">{course_applied_for}</label>
										 </div>
										 <div class="">
										 	<label class="checkbox_enquiryGrn">
					                        <input type="radio" name="course_applied_for" value="GNM" class="pivileges singleInput">
					                        <span class="checkmark_enquiryGrn"></span>
					                        </label>
					                        <label class="m-l-30 fs-24 fnt_red_clr fw-600">GNM</label>
										 </div>
										 <div class="m-t-25">
										 	<label class="checkbox_enquiryGrn">
					                        <input type="radio" name="course_applied_for" value="B.Sc. Nursing" class="pivileges singleInput">
					                        <span class="checkmark_enquiryGrn"></span>
					                        </label>
					                        <label class="m-l-30 fs-24 fnt_red_clr fw-600">B.Sc. Nursing</label>
										 </div>
										 <div class="m-t-25">
										 	<label class="checkbox_enquiryGrn">
					                        <input type="radio" name="course_applied_for" value="P.C.B.Sc. Nursing" class="pivileges singleInput">
					                        <span class="checkmark_enquiryGrn"></span>
					                        </label>
					                        <label class="m-l-30 fs-24 fnt_red_clr fw-600">P.C.B.Sc. Nursing</label>
										 </div>
									</div>
									<!-- <div class="col-12 col-sm-6">
										<h2 class="fnt_grn_clr fs-14 mobl_vw_m">M.Sc. Nursing</h2>
										<div class="m-t-25">
										 	<label class="checkbox_enquiryGrn">
					                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing Pediatric" class="pivileges singleInput">
					                        <span class="checkmark_enquiryGrn"></span>
					                        </label>
					                        <label class="m-l-30 fs-14 fnt_grn_clr">Pediatric</label>
										 </div>
										 <div class="m-t-25">
										 	<label class="checkbox_enquiryGrn">
					                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing Medical Surgical" class="pivileges singleInput">
					                        <span class="checkmark_enquiryGrn"></span>
					                        </label>
					                        <label class="m-l-30 fs-14 fnt_grn_clr">Medical Surgical</label>
										 </div>
										 <div class="m-t-25">
										 	<label class="checkbox_enquiryGrn">
					                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing Community" class="pivileges singleInput">
					                        <span class="checkmark_enquiryGrn"></span>
					                        </label>
					                        <label class="m-l-30 fs-14 fnt_grn_clr">Community</label>
										 </div>
										 <div class="m-t-25">
										 	<label class="checkbox_enquiryGrn">
					                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing OBG" class="pivileges singleInput">
					                        <span class="checkmark_enquiryGrn"></span>
					                        </label>
					                        <label class="m-l-30 fs-14 fnt_grn_clr">OBG</label>
										 </div>
										 <div class="m-t-25">
										 	<label class="checkbox_enquiryGrn">
					                        <input type="radio" name="course_applied_for" value="M.Sc. Nursing Pshychiatry" class="pivileges singleInput">
					                        <span class="checkmark_enquiryGrn"></span>
					                        </label>
					                        <label class="m-l-30 fs-14 fnt_grn_clr">Pshychiatry</label>
										 </div>
									</div> -->
								</div>
							</div><!-- 
							<h3 class="fs-14 fnt_grn_clr margn_top_res">Paramedical</h3>
							<div class="row">
								<div class="col-12 col-sm-6">
									<div>
									 	<label class="checkbox_enquiry">
				                        <input type="radio" name="course_applied_for" value="Pediatric" class="pivileges singleInput">
				                        <span class="checkmark_enquiryGrn"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 fnt_grn_clr">Pediatric</label>
									 </div>
								</div>
								<div class="col-12 col-sm-6">
									<div>
									 	<label class="checkbox_enquiry">
				                        <input type="radio" name="course_applied_for" value="Pediatric" class="pivileges singleInput">
				                        <span class="checkmark_enquiryGrn"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 fnt_grn_clr">Pediatric</label>
									 </div>
								</div>
							</div> -->
						</div>
						<!-- table section -->
						<div class="col col-md-4">
							<div class="p-t-10 tbl_border_grn">
								<table class="table table-bordered srored_table" width="100%;">
									<tr class="text-center">
										<th colspan="2" class="padding-10 fnt_grn_clr"><span class="fnt_grn_clr fw-700">Marks Scored in Class XII</span></th>
									</tr>
									<tr class="text-center">
										<td class="padding-10 fnt_grn_clr" width="50%">Subject</td>
										<td class="padding-10 fnt_grn_clr" width="50%">Scored</td>
									</tr>
									<tr>
										<!-- <td class="padding-10" width="50%"><input type="text" name="sub1" class="scored_input"></td> -->
										<td class="padding-10 fnt_grn_clr" width="50%"><span class="fnt_grn_clr m-l-10">Lang-I</span></td>
										<td class="padding-10" width="50%"><input type="text" name="score1" class="scored_input" value="{score1}"></td>
									</tr>
									<tr>
										<!-- <td class="padding-10" width="50%"><input type="text" name="sub2" class="scored_input"></td> -->
										<td class="padding-10 fnt_grn_clr" width="50%"><span class="fnt_grn_clr m-l-10">Lang-II</span></td>
										<td class="padding-10" width="50%"><input type="text" name="score2" class="scored_input" value="{score2}"></td>
									</tr>
									<tr>
										<!-- <td class="padding-10" width="50%"><input type="text" name="sub3" class="scored_input"></td> -->
										<td class="padding-10 fnt_grn_clr" width="50%"><span class="fnt_grn_clr m-l-10">Chemistry</span></td>
										<td class="padding-10" width="50%"><input type="text" name="score3" class="scored_input" value="{score3}"></td>
									</tr>
									<tr>
										<!-- <td class="padding-10" width="50%"><input type="text" name="sub4" class="scored_input"></td> -->
										<td class="padding-10 fnt_grn_clr" width="50%"><span class="fnt_grn_clr m-l-10">Maths</span></td>
										<td class="padding-10" width="50%"><input type="text" name="score4" class="scored_input" value="{score4}"></td>
									</tr>
									<tr>
										<!-- <td class="padding-10" width="50%"><input type="text" name="sub5" class="scored_input"></td> -->
										<td class="padding-10 fnt_grn_clr" width="50%"><span class="fnt_grn_clr m-l-10">Biology</span></td>
										<td class="padding-10" width="50%"><input type="text" name="score5" class="scored_input" value="{score5}"></td>
									</tr>
									<tr>
										<!-- <td class="padding-10" width="50%"><input type="text" name="sub5" class="scored_input"></td> -->
										<td class="padding-10 fnt_grn_clr" width="50%"><span class="fnt_grn_clr m-l-10">Physics</span></td>
										<td class="padding-10" width="50%"><input type="text" name="score6" class="scored_input" value="{score6}"></td>
									</tr>
									<tr>
										<td class="padding-10" width="50%"><span class="fnt_grn_clr m-l-10">Total</span></td>
										<td class="padding-10" width="50%"><input type="text" name="Tscore" class="scored_input" value="{Tscore}"></td>
									</tr>
									<tr class="border">
										<td class="padding-10" width="50%"><span class="fnt_grn_clr m-l-10">Percentage</span></td>
										<td class="padding-10" width="50%"><input type="text" name="Pscore" class="scored_input" value="{Pscore}"></td>
									</tr>
								</table>
							</div>
						</div>
						<!-- form section -->
						<div class="col-12 col-md-4">
							<div class="p-t-30">
								<div class="m-b-15">
									<label class="fs-14 fnt_grn_clr">Last Exam Passed:</label>
									<input type="text" name="last_exam_pass" class="scoredDetailIinput" value="{last_exam_pass}">
								</div>
								<div class="m-b-15">
									<label class="fs-14 fnt_grn_clr">Board Name:</label>
									<input type="text" name="board_name" class="scoredDetailIinput " value="{board_name}">
								</div>
								<div class="m-b-15">
									<label class="fs-14 fnt_grn_clr">Year of Passing:</label>
									<input type="text" name="year_of_passing" class="scoredDetailIinput" value="{year_of_passing}">
								</div>
								<div class="m-b-15">
									<label class="fs-14 fnt_grn_clr">Registration No.:</label>
									<input type="text" name="registration_no" class="scoredDetailIinput" value="{registration_no}">
								</div>
								<div class="m-b-15">
									<label class="fs-14 fnt_grn_clr">Name and address of school last attended:</label>
									<input type="text" name="school_name_twelth" class="scoredDetailIinput w-full" value="{school_name_twelth}">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Cource apply for end -->
			<!-- Student Contact Information start -->
			<div class="text-center m-t-30">
				<h3 class="fnt_grn_clr fs-24 m-b-0">Student Contact Information</h3>
			</div>
			<div class="padding">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="permanent_add_main">
							<div class="m-b-15">
								<label class="fs-14 fnt_grn_clr">Permanent Address :</label>
								<textarea style="height: 125px;" class="addrss_textarea_inpt" name="permanent_address">{permanent_address}</textarea>
							</div>
							<div class="">
								<label class="fs-14 fnt_grn_clr">Student Mobile Number :</label>
								<input type="text" name="student_mobile_number" class="student_mon_inpt" value="{student_mobile_number}">
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="local_add_main">
							<div class="m-b-12 m-t-768">
								<label class="fs-14 fnt_grn_clr">Local Guardian Address :</label>
								<textarea class="addrss_textarea_inpt" name="local_address">{localaddress}</textarea>
							</div>
							<div class="m-b-15 borde_bottom_input">
								<label class="fs-14 fnt_grn_clr">Relation with Student :</label>
								<input type="text" name="relation_with_student" class="student_mon_inpt"  value="{relation_with_student}">
							</div>
							<div class="m-b-15 ">
								<label class="fs-14 fnt_grn_clr">Mobile Number :</label>
								<input type="text" name="mob_number" class="student_mon_inpt" value="{mob_number}">
							</div>
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
		<!-- <div class="_bgwht_ appli_form_main">
			<h3 class="fs-30 _mhrnclr_ ">Application Form</h3>
		</div> -->
		<div class="container">
			<!-- DOcument required start  -->
			<div class="bg_grn student_info_main m-t-20">
				<h3 class="_wtClr_ fs-24 m-b-0">Document Required Affix Photocopies (Original to be Produced at the time of Admission)</h3>
			</div>
			<div class="padding">
				<div class="row">
					<div class="col-12 col-md-6">
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">SSLC Marks Sheet</label>
						</div>
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">II PUC/10+2/PDC Marks Sheet/”A”Level</label>
						</div>
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">Transfer Certificate</label>
						</div>
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">Conduct Certificiate (Issued from institute last studied)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">Migration certificate from the Concern University/Board</label>
						</div>
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">Recent 4 Passport  &  1 stamp size latest colour photographs</label>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">Citizenship proof (Aadhar, Passport, Nagarikta)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">Student Passport Visa (for foreign nationals)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">Degree Certificates & Marks Sheets (for PG Programs)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">Income & Caste Certificate (if applicable)</label>
						</div>
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput">
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">Diploma Certificate/ Marks Sheets/ Registration for  Pc. B.Sc.</label>
						</div>
					</div>
				</div>
			</div>
			<!-- DOcument required End -->
			<!-- Declaration start -->
			<div class="bg_grn student_info_main m-t-20">
				<h3 class="_wtClr_ fs-24 m-b-0">Declaration</h3>
			</div>
			<div class="padding">
				<div class="row">
					<div class="col-12">
						<div>
						 	<label class="checkbox_enquiryGrn">
	                        <input type="checkbox" value="" class="pivileges singleInput" required>
	                        <span class="checkmark_enquiryGrn"></span>
	                        </label>
	                        <label class="m-l-30 fs-14 fnt_grn_clr">I/We pledged that all information provided herewith is true to best of our knowledge. I/We fully agree to abide by all the policies , rules and regulations of the institutions and in case of non-confirmation would accept the verdict of the institution as the final. I/We also understood and accept that in case of discontinuation of the course for any reason. I/We shall forgo the entire fee including deposite paid to the institution and not claim any reimbursements for compensations. </label>
						</div>
						<p class="m-t-20 fs-14 fnt_grn_clr">*Antiragging affidavit has to be submitted before joining.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-4">
						<div>
							<label class="fs-14 fnt_grn_clr">Date:</label>
							<input type="text" name="submission_date" class="form_input examDate"  data-toggle="datepicker">
						</div>
						<div>
							<label class="fs-14 fnt_grn_clr">Place:</label>
							<input type="text" name="submission_place" class="form_input">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div style="position: relative;">
							<label class="signatureDiv" for="imgInp">
								<img id="blah" class="getSignedImage" src="<?php echo base_url();?>uploads/{father_sign}">
								<input type="file" name="father_sign" hidden="" onchange="readURLFirst(this);" id="imgInp" required  value="{father_sign}">
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
								<input type="file" hidden="" name="student_sign" onchange="readURLSecnd(this);" id="imgInp1" required value="{student_sign}">
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
			<div class="bg_grn student_info_main m-t-20">
				<h3 class="_wtClr_ fs-24 m-b-0">For Office Use Only</h3>
			</div>
			<div class="text-center m-t-30">
				<h3 class="fs-20 fnt_grn_clr">FEES DETAILS</h3>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="table-responsive score_tbl">
						<table class="table">
							<tr class="text-center">
								<th class="fs-14 fnt_grn_clr"><span>Course</span></th>
								<th class="fs-14 fnt_grn_clr"><span>1st Year</span></th>
								<th class="fs-14 fnt_grn_clr"><span>2nd Year</span></th>
								<th class="fs-14 fnt_grn_clr"><span>3rd Year</span></th>
								<th class="fs-14 fnt_grn_clr"><span>4th Year</span></th>
							</tr>
							<tr>
								<td class="padding-10">
									<div>
									 	<!-- <label class="checkbox_enquiryGrn">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiryGrn"></span>
				                        </label> -->
				                        <!-- <label class="m-l-30 fs-14 fnt_grn_clr">GNM</label> -->
				                        <input type="text" name="" class="scoredDetailIinput" readonly>
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
							</tr>
							<tr>
								<td class="padding-10">
									<div>
									 	<!-- <label class="checkbox_enquiryGrn">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiryGrn"></span>
				                        </label> -->
				                        <!-- <label class="m-l-30 fs-14 fnt_grn_clr">B.Sc. Nursing</label> -->
				                        <input type="text" name="" class="scoredDetailIinput" readonly>
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
							</tr>
							<tr>
								<td class="padding-10">
									<div>
									 	<!-- <label class="checkbox_enquiryGrn">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiryGrn"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 fnt_grn_clr">P.C.B.Sc. Nursing</label> -->
				                        <input type="text" name="" class="scoredDetailIinput" readonly>
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
							</tr>
							<tr>
								<td class="padding-10">
									<div>
									 	<!-- <label class="checkbox_enquiryGrn">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiryGrn"></span>
				                        </label>
				                        <label class="m-l-30 fs-14 fnt_grn_clr">M.Sc. Nursing</label> -->
				                        <input type="text" name="" class="scoredDetailIinput" readonly>
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
							</tr>
							<tr>
								<td class="padding-10">
									<div class="">
									 	<!-- <label class="checkbox_enquiryGrn">
				                        <input type="checkbox" value="" class="pivileges singleInput" disabled>
				                        <span class="checkmark_enquiryGrn"></span>
				                        </label> -->
				                        <!-- <label class="m-l-30 fs-14 fnt_grn_clr ">Paramedical</label> -->
				                        <input type="text" name="" class="text-center fs-14 scoredDetailIinput fnt_grn_clr" placeholder="Total Fee" readonly style="width: 92%;">
									</div>
								</td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
								<td class="padding-10"><input type="text" name="" class="scoredDetailIinput" readonly></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row m-t-30">
				<div class="col-12 col-md-4">
					<div class="office_section office_section_">
						<div class="text-center p-t-10 height_admitSection">
							<h3 class="fs-14 fnt_grn_clr">Admitted By</h3>
						</div>
						<div class="Admited_by_text">
							<label class="fs-14 fnt_grn_clr">Name:</label>
							<input type="text" name="admitted_by" class="scoredDetailIinput" autocomplete="off" readonly value="{admitted_by}">
						</div>
						<div>
							<label class="fs-14 fnt_grn_clr dis-inline-block">Mobile Number:</label>
							<input type="text" name="admitted_by_number" class="scoredDetailIinput dis-inline-block" readonly value="{admitted_by_number}">
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="office_section office_section_">
						<div class="text-center p-t-10 height-100">
							<h3 class="fs-14 fnt_grn_clr">Verified By</h3>
						</div>
						<div class="Admited_by_text">
							<label class="fs-14 fnt_grn_clr">Name:</label>
							<input type="text" name="varified_by" class="scoredDetailIinput" autocomplete="off" readonly value="{varified_by}">
						</div>
					</div>
				</div>
				<div  class="col-12 col-md-4">
					<div class="office_section office_section_">
						<div class="text-center p-t-10 height-100">
							<h3 class="fs-14 fnt_grn_clr">Entered By</h3>
						</div>
						<div class="Admited_by_text">
							<label class="fs-14 fnt_grn_clr">Name:</label>
							<input type="text" name="entered_by" class="scoredDetailIinput" autocomplete="off" readonly value="{entered_by}">
						</div>
					</div>
				</div>
			</div>
			<!-- For Office Use End -->
			<div class="row justify-content-center m-t-30">
              <div class="col-12 col-sm-6 btnposition">
                <a style="color: #fff" href="javascript:void(0)" class="btn back_btn btn-default _bggry_" style="float: left" data-dismiss="modal">Back</a>
              </div>
              <div class="col-12 col-sm-6 btn_position">
                <span class="loadingMyprofile" style="top: 2px; right: -3%"><img src="<?php echo base_url(); ?>assets/dashboard/img/loading7.gif"></span>
                 <button type="submit" class="svebtn btn">Save</button>
              </div>
           </div>
           <!-- <div class="_mhrnbg_ student_info_main m-t-20 text-right">
				<h3 class="_wtClr_ fs-14 m-b-0">Marketing By: ASGK Health Care Hub Pvt. Ltd.</h3>
			</div> -->
			<div class="row m-t-20 m-b-20">
				<div class="col-12">
					<div class="text-center">
						<img src="<?php echo base_url(); ?>assets/dashboard/img/logoMain.png">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<h1 class="institute_name_h1">SOWRABHA INSTITUTE OF NURSING SCIENCE</h1>
				</div>
			</div>
			<div class="row m-t-20">
				<div class="col-12 col-md-4">
					<div class="padding-10 text-center footer_logo_main">
						<img src="<?php echo base_url(); ?>assets/dashboard/img/knclogo.png">
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="padding-10 text-center footer_logo_main">
						<img src="<?php echo base_url(); ?>assets/dashboard/img/logo1.png">
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="padding-10 text-center footer_logo_main">
						<img src="<?php echo base_url(); ?>assets/dashboard/img/inc_logo.jpg">
					</div>
				</div>
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