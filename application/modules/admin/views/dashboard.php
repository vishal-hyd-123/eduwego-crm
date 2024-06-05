
<style type="text/css">
   /*.agentActive, .agentActive:hover{
   background: rgba(91, 193, 70, 0.1);
   border-color: #5BC146;
   color: #8A162B;
   }*/
   .addinstituteActive ._sdf_{
    color: #8A0A28 !important;
   }
    
  .student_details_box{
    width:100%;
    min-height:400px;
    border:1px solid #ccc;
    padding:12px;

  }

  /* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent{
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

.details_table tr td{
   font-size:17px;
   font-weight:bold;
   padding:7px;
}
.fee-box{
    border:1px solid #ccc;
}
.fee-box th,td{
    padding:7px;
    
}

 </style>
<div id="content" class="flex ">
   <div class="page-container" id="page-container">
      <div class="padding">
         <div class="row">
            <div class="col-12 col-md-6">
               <h2 class="mb-0 nwFntSt _blckClr_ _fwg500_ _fs16_ pull-left">Search Student</h2>
            </div>
            <div class="col-12 col-md-6 text-right">
               <button class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn" onclick="deleteFunc()" id="multiDelete" style="display: none;"><i style="color: #fff" class="i-con i-con-trash"><i></i></i></button>
            </div>
         </div>
         <hr />
        
         <div class="container">
           <form id="student_search_by_admin">

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                 <label>Search By</label>
                 <select class="student_search_by form-control">
                  <option value="">Search By</option>
                   <option value="mobile">Mobile Number</option>
                   <option value="reg">Registration Number</option>
                 </select>
               </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                 <label>Mobile/Registration Number</label>
                 <input type="text" class="srch_number form-control" />
               </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                 <label>Select Student</label>
                 <select class="students_name_in_admin form-control">
                   <option>Student Name</option>
                 </select>
               </div>
              </div>

            </div>

           </form>

           <div class="student_details_box shadow-sm bg-light">
             <div class="row profile-box">
                <div class="col-md-3">
                    
                    <div class="profile_img_box">
                        <div style="width: 100%; height: auto;">
                            <div class="imgcontent" style="width: 180px;height: auto; text-align: center;">
                                <img class="blah" id="blah" src="<?php echo base_url(); ?>assets/dashboard/img/person2.jpg" style="width: 100%;">
                            </div>

                            <input type="file" name="image" accept="Images/*" id="expertProfile" hidden="">
                        </div>
                    </div>
                    <center>
                        <h4 class="text-capitalize my-3 stu_name">
                           
                        </h4>
                        <p class="mobile">
                            
                        </p>
                        <p class="email">
                            
                        </p>
                    </center>
                </div>
                <div class="col-md-9">
                    <div class="tab">
                      <button class="tablinks" onclick="openCity(event, 'basic')">Basic Details</button>
                      <button class="tablinks" onclick="openCity(event, 'course')">Course Details</button>
                      <button class="tablinks" onclick="openCity(event, 'payment')">Payment Details</button>
                      <button class="tablinks" onclick="openCity(event, 'contact')">Contact</button>
                      
                    </div>

                    <div id="basic" class="tabcontent" style="display:block">
                      <h3>Basic Details</h3>
                      <table class="details_table table-bordered w-100">
                          <tr>
                              <td>Name :</td>
                              <td class="text-capitalize stu_name">
                                
                              </td>
                          </tr>
                          <tr>
                              <td>Father's Name :</td>
                              <td  class="text-capitalize father_name">
                                
                              </td>
                          </tr>
                          <tr>
                              <td>Mother's Name :</td>
                              <td  class="text-capitalize mother_name">
                                
                              </td>
                          </tr>
                          <tr>
                              <td>Ftaher's Occupation :</td>
                              <td class="text-capitalize occupation">
                                
                              </td>
                          </tr>
                          <tr>
                              <td >D.O.B :</td>
                              <td  class="text-capitalize dob">
                                
                              </td>
                          </tr>
                          <tr>
                              <td >Gender :</td>
                              <td  class="text-capitalize gender">
                                
                              </td>
                          </tr>
                      </table>
                    </div>

                    <div id="course" class="tabcontent">
                      <h3>Course Details</h3>
                      <table class="details_table table-bordered w-100">
                          <tr>
                              <td>Course Name :</td>
                              <td class="text-capitalize course_name">
                                
                              </td>
                          </tr>
                          <tr>
                              <td>Stream Name :</td>
                              <td class="text-capitalize stream_name">
                                
                              </td>
                          </tr>
                          <tr>
                              <td>Course Duration :</td>
                              <td class="text-capitalize course_dur">
                                
                              </td>
                          </tr>
                          <tr>
                              <td >Year of Admission :</td>
                              <td  class="text-capitalize yoa">
                                
                              </td>
                          </tr>
                          <tr>
                              <td >Reffered By : </td>
                              <td  class="text-capitalize reffered_by">
                                
                              </td>
                          </tr>
                      </table>
                    </div>

                    <div id="payment" class="tabcontent">
                      <h3>Payment Details</h3>
                      <table class="details_table table-bordered w-100">
                          <tr>
                              <td>Total Course Fee (Total Package) :</td>
                              <td class="text-capitalize package">
    
                              </td>
                          </tr>
                          <tr>
                              <td>Total Paid Amount (Rs): </td>
                              <td  class="text-capitalize paid_amount">
                                
                              </td>
                          </tr>
                          <tr>
                              <td >Total Due Amount (Rs.) :</td>
                              <td  class="text-capitalize due_amount">
                                
                              </td>
                          </tr>
                          
                      </table>
                      
                    </div>

                    <div id="contact" class="tabcontent">
                      <h3>Contact Details</h3>
                      <table>
                        <tr>
                          <td>Contact Number</td>
                          <td class="mobile"></td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td class="email"></td>
                        </tr>
                        <tr>
                          <td>Address</td>
                          <td class="address"></td>
                        </tr>
                      </table>
                    </div>

                    <div class="fee-box bg-dark">
                        <table class="w-100 table-bordered">
                            
                        </table>
                    </div>
                </div>
                
            </div>
           </div>

         </div>

      </div>
   </div>
</div>

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
</script>