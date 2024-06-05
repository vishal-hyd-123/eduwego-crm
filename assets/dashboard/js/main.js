var loader_html = '<div class="loader_con"><i class="fa fa-spinner fa-spin" ></i></div>';
$("#content").append(loader_html);
$(document).ready(function(){
  $("#content .loader_con").addClass('d-none');
});

// Datepicker with custom datepicker
var getDateAttr = $('.examDate').attr('date-value');
if (getDateAttr != '' || getDateAttr != undefined || getDateAttr != null){
  var getDate = getDateAttr;
}else{
  var getDate = false;
}
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
    startDate: getDate,
    weekStart: 1,
    template: '<div class="datepicker-container _nwcntn_">' + '<div class="datepicker-panel _nwpnt_" data-view="years picker">' + '<ul class="_nwul_ _nwulmn_">' + '<li class="_nwliyr_ _nwprmn_" data-view="years prev">&lsaquo;</li>' + '<li class="_nwlicr_ _nwcrmn_" data-view="years current"></li>' + '<li class="_nwlinx_ _nwprmn_" data-view="years next">&rsaquo;</li>' + '</ul>' + '<ul class="_nwulyr_" data-view="years"></ul>' + '</div>' + '<div class="_nwpnt_ datepicker-panel" data-view="months picker">' + '<ul class="_nwul_ _nwulmn_">' + '<li class="_nwliyr_ _nwprmn_" data-view="year prev">&lsaquo;</li>' + '<li class="_nwlicr_ _nwcrmn_" data-view="year current"></li>' + '<li class="_nwlinx_ _nwprmn_" data-view="year next">&rsaquo;</li>' + '</ul>' + '<ul class="_nwul_" data-view="months"></ul>' + '</div>' + '<div class="datepicker-panel _nwpnt_" data-view="days picker">' + '<ul class="_nwulmn_">' + '<li class="_nwprmn_" data-view="month prev">&lsaquo;</i></li>' + '<li class="_nwcrmn_" data-view="month current"></li>' + '<li class="_nwprmn_ _nwnxmn_" data-view="month next">&rsaquo;</li>' + '</ul>' + '<ul class="_nwulwk_" data-view="week"></ul>' + '<ul class="_nwuldy_" data-view="days"></ul>' + '</div>' + '</div>',
});

$(document).on('submit', '._formSubmit', function(e){
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
      //alert(res);return false;
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

// Open Add Popups
function openAddPopup(curr, id){
  $(id).modal('show');
}

//student add modal show
function studentAddByAgent(curr, id)
{
  $(id).modal('show');
  
  $("#course").on('change',function(){
    var course_id = $('option:selected', this).attr('course_id');;
    $("#course_id").val(course_id);
  });
}

//add student by agent
 $('#studentAddForm').submit(function(event){
       event.preventDefault();
       var action = $(this).attr('action');
       var method = $(this).attr('method');
       $.ajax({
         type: method,
         url:action,
         data: new FormData(this),
         contentType : false,
         processData : false,
         cache : false,
         success: function(data){
             var data = JSON.parse(data);
              if(data.status == false){
                  $( ".error-message" ).remove();
                  if(data.errormessage){
                    vNotify.error({text:data.errormessage, title:'Error!'});
                  }
                   data1   = JSON.parse(data.message);
                  $('form :input').each(function(){                          
                    var elementName = $(this).attr('name');        
                    var message = data1[elementName];
                    if(message){
                      var element = $('<span>' + message + '</span>')
                                    .attr({
                                        'class' : 'error-message'
                                    });
                      $(this).after(element);
                      $(element).fadeIn();
                    }
                  }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    location.reload();
                  }, 1000);
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }
    });
  });


function studentAddPopup(curr, id){
  var default_photo = window.base_url+'assets/dashboard/img/person2.jpg';
  document.getElementById("staffform").reset();
  $("#staffform #blah").attr('src',default_photo);
  document.getElementById('save_type').value = "";
  $('.package_box').removeClass('d-none');
  $("#package").attr('type','number');
  $("#course_dur").attr('type','number');
  $('.fees_box_con').removeClass('d-none');
  $(id).modal('show');
  $(".modal-title").html('Add Student');
  
  $("#course").on('change',function(){
    var course_id = $('option:selected', this).attr('course_id');;
    $("#course_id").val(course_id);
  });
}

function adminAddPopup()
{
  $("#adminAddModal").modal('show');
}

//add institute
 $('#add_institute').submit(function(event){
       event.preventDefault();
       var action = $(this).attr('action');
       var method = $(this).attr('method');
       $.ajax({
         type: method,
         url:action,
         data: new FormData(this),
         contentType : false,
         processData : false,
         cache : false,
         success: function(data){
             var data = JSON.parse(data);
              if(data.status == false){
                  $( ".error-message" ).remove();
                  if(data.errormessage){
                    vNotify.error({text:data.errormessage, title:'Error!'});
                  }
                   data1   = JSON.parse(data.message);
                  $('form :input').each(function(){                          
                    var elementName = $(this).attr('name');        
                    var message = data1[elementName];
                    if(message){
                      var element = $('<span>' + message + '</span>')
                                    .attr({
                                        'class' : 'error-message'
                                    });
                      $(this).after(element);
                      $(element).fadeIn();
                    }
                  }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  window.location = location.href;
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }
    });
  });

//Calculating Yearly fees
$("#course_dur").on('input',function(){
  $(".fees_box_con").html('');
  var save_type = $("#save_type").val();
  var course_dur = $("#course_dur").val();
  var yoa = Number($("#admissionyer").val());
  if(yoa != "")
  {
    if(course_dur != null && save_type == "")
    {
      var html = "";
      var i;
      for(i=1;i<=course_dur;i++)
      {
        var yr =  yoa+i-1;
        html += '<div style="margin-bottom:5px;padding:4px">';
        html += '<label>Year- '+i+' ('+yr+') Fees</label><input type="number" name="yearly_fee_'+i+'" required />';
        html += '<input type="hidden" name="fees_yr[]" value="'+yr+'" />'; 
        html += '</div>';
      }
      $(".fees_box_con").append(html);
    }
  } else{
    alert("Year of admission must not be empty !");
    $(this).val('');
  }
  
});

//add payment
$(".payment_btn").click(function(){
  $("#payment_modal").modal('show');
  var student_id = $(this).attr('student_id');
  var student_name = $(this).attr('student_name');
  var yearly_fees = $(this).attr('yr_fees');
  var yr_id = $(this).attr('yr_id');
  var year = $(this).attr('year');
  var paid = $(this).attr('paid');
  var course_id = $(this).attr('course_id');
  var agent_id = $(this).attr('agent_id');
  var agent_prev_discount = Number($(this).attr('agent_discount'));
  // var agent_discount = $(this).attr('agent_discount');
  $(".yr_id").val(yr_id);
  $(".year").val(year);
  $(".yr_fees").val(yearly_fees);
  $(".total_paid").val(paid);
  var due = (yearly_fees-paid);
  $(".prev_due").val(due);
  $(".due").val(due);
  $(".student_id").val(student_id);
  $(".student_name").val(student_name);
  $(".student_email").val(student_email);
  $(".student_mobile").val(student_mobile);
  $(".course_id").val(course_id);
  $(".agent_id").val(agent_id);
  // $(".agent_discount").val();

  $(".agent_discount_input").on('input',function(){
    var current_val = Number($(this).val());
    var total_discount = (agent_prev_discount+current_val);
    $("#payment_modal .agent_discount").val(total_discount);
  });
  


  // $(".paying_amount").on('input',function(){
  //   var paying_val = $(this).val();
  //   if(paying_val > 0 && paying_val <= due)
  //   {
  //     var cur_due = (due-paying_val);
  //     // $(".due").val(cur_due);
  //   }
  //   else{
  //     alert('Please Enter A Valid number.');
  //   }
    
  // });
  
});

//payment receipt
$(".receipt_btn").on('click',function(){
  var student_id = btoa($(this).attr('student_id'));
  var yr_id = btoa($(this).attr('yr_id'));
  window.open(window.base_url+'institute/noDueCertificate/?student_id='+student_id+'&yr_id='+yr_id);
    
});

$('.receipt_pdf_btn').on('click',function(){
  var id = btoa($(this).attr('payment_id'));
  var yr = btoa($(this).attr('yr_id'));
  var copy = btoa($(this).attr('copy'));
  window.open(window.base_url+'institute/receiptFromHistory/?id='+id+'&yr='+yr+'&copy='+copy);
});

// initialise datatable
var myTable = $('#myTable').dataTable({
  "destroy": true
});

// Show image preview
function readURL(input){
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

function readSigURL(input){
  if(input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#sig').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$(document).on('change', '#expertProfile', function() {
  readURL(this);
});

// Upload front side image(vendor/agent)
function front_side(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#front_side').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}
$(document).on('change', '#frntimg', function() {
  front_side(this);
});
// Upload back side image(vendor/agent)
  function readURL2(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#back_side').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  $(document).on('change', '#backimg', function() {
    readURL2(this);
  });

//view student profile
    function viewStudent(id)
    {
      var id = btoa(id);
      window.location = window.base_url+'institute/viewStudent/?id='+id;
    }

// Student Edit JSON
function editStudent(id){
  document.getElementById('save_type').value = "edit";
  $('.fees_box_con').addClass('d-none');
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/getStudentById',
    data: {
      'student_id': id,
    },
    success: function(res){
      document.getElementById("staffform").reset();
      var res = JSON.parse(res);
      $('#opnpopup').modal('show');
      if(res[0].student_photo != null)
      {
        $('#blah').attr('src',window.base_url+'uploads/'+res[0].student_photo);
      }
      else{
        $('#blah').attr('src',window.base_url+'assets/dashboard/img/person2.jpg');
      }
      $('#name').val(res[0].full_name);
      $('#father_name').val(res[0].s_w_d_of);
      $('#mother_name').val(res[0].mother_name);
      $('#occupation').val(res[0].occupation);
      $('#dob').val(res[0].dob);
      $('#gender').val(res[0].gender);
      $('#course').val(res[0].course);
      $('#course_id').val(res[0].course_id);
      var course_id = res[0].course_id;
      $('#email').val(res[0].email);
      $('#city').val(res[0].city);
      $('#qualification').val(res[0].qualification);
      $('#number').val(res[0].mobile);
      $('#address').val(res[0].address);
      $('#reffered').val(res[0].yoa);
      $('#atreamapply').val(res[0].stream);
      $('#refferedBy').val(res[0].reffered_by);
      $('#admissionyer').val(res[0].yoa);
      $('#package').val(res[0].package);
      $('#course_dur').val(res[0].course_dur);
      $('#package').attr('type','hidden');
      $('#course_dur').attr('type','hidden');
      $(".package_box").addClass('d-none');
      $('.student_modal .modal-title').html('Edit Student Details');
      $('#student_id').val(res[0].student_id);
      $("#agent_name").val(res[0].agent_name);
      $("#sub_institute").val(res[0].sub_institute_id);
      $("#gender").val(res[0].gender);

      $("#course").on('change',function(){
        var course_id = $('option:selected', this).attr('course_id');
        $("#course_id").val(course_id);
      });

      if(course_id != "")
      {
        $.ajax({
          type : 'POST',
          url : base_url+'institute/getStreamsByCourse',
          data : {
            course_id : course_id,
          },
          success : function(res){
            $(".streamApply").html(res);
          }
        });
      }

    }
  })
}

//add Package
$("#add_package_btn").on('click',function(){
  $('#packagepopup').modal('show');
  var stu_id = $(this).attr('stu_id');
  var stu_name = $(this).attr('stu_name');
  $('#packageform #student_id').val(stu_id);
  $('#packageform #full_name').val(stu_name);
  $('#packageform #course_dur').on('input',function(){
      var course_dur = $(this).val();
      if(course_dur != '')
      {
  
        var i;
        for(i=1;i<=course_dur;i++)
        {
          var div = document.createElement('DIV');
          var label = document.createElement('LABEL');
          $(label).html('Year- '+i+' Fees');
          var input = document.createElement('INPUT');
          div.style.marginBottom = "5px";
          div.style.padding = "4px";
          input.type = "number";
          input.required = "required";
          input.name = "yearly_fee_"+i;
          $(div).append(label);
          $(div).append(input);
          $(".package_fields_box").append(div);
         }
      }
      else{
        $(".package_fields_box").html("");
      }
  });
});

// Enquiry Edit js
function editEnquiry(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/getEnqById',
    data: {
      'enq_id': id,
    },
    success: function(res){
      var res = JSON.parse(res)
      console.log("stream", res[0].stream);
      console.log("res", res);  
      $('#opnpopup').modal('show');

      $('#name').val(res[0].full_name);
      $('#enquiry_id').val(res[0].enquiry_id);
      $('#lastname').val(res[0].s_w_d_of);
      $('#mothersname').val(res[0].mother_name);
      $('#occupation').val(res[0].occupation);
      $('#birthDate').val(res[0].dob);
      $('#stream').val(res[0].stream);
      $('#reffered').val(res[0].reffered_by);
      // $('#address').val(res[0].);
      $('#number').val(res[0].mobile);
      $('#cityvillage').val(res[0].city);
      $('#email').val(res[0].email);
      $('#timing').val(res[0].timing);
      $('input[name="gender"][value="'+res[0].gender+'"]').prop("checked", true);
      $('#committed').val(res[0].fee_commited);
      $('#date').val(res[0].reminder_date);
      $('#discount').val(res[0].discount_promissed);
      $('#Fees').val(res[0].net_fee_applicable);
      $('#remark').val(res[0].remark);
      $('#address').val(res[0].address);
      $('#lead_status').val(res[0].lead_status);
      $('#course').val(res[0].course);
      // $('#stream').val(res[0].stream);
    }
  })
}
// Cource Edit js
function editCource(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/getCourseById',
    data: {
      'course_id': id,
    },
    success: function(res){
      var res = JSON.parse(res)
      console.log("res", res);  
      $('#opnpopup').modal('show');
      $('#coursename').val(res[0].course_name);  
      $('#description').val(res[0].course_discription);
      $('#course_id').val(res[0].course_id);
    }
  })
}

// Sub Institute Edit js
function editSubInstitute(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/getSubInstituteById',
    data: {
      'institute_id': id,
    },
    success: function(res){
      var res = JSON.parse(res)
      $('#opnpopup').modal('show');
      $('#institute_name').val(res[0].sub_institute_name);  
      $('#address').val(res[0].address);
      $('#sub_inst_id').val(res[0].sub_inst_id);
    }
  })
}

// view student payment information
  function viewStudentPayment(id)
  {
    var id = btoa(id);
    window.location = window.base_url+'institute/studentPaymentDetails/?id='+id;
  }

//student search by mobile/reg number in institute panel
   $("#student_search_form .srch_number").on('input',function(){
    var srch_by = $('.student_srch_by').val();
    var srch_number = $(this).val();
    if(srch_by != "")
    {
      if(srch_number != "")
      {
        $.ajax({
          type : 'POST',
          url : window.base_url+'institute/searchStudents',
          data : {
            srch_by : srch_by,
            srch_number : srch_number
          },
          success : function(res){
            $('.students_name').html('');
            if(res == 'No Data Found')
            {
              var option = document.createElement('OPTION');
              $(option).html(res);
              $('.students_name').append(option);
            }
            else{
              var option1 = document.createElement('OPTION');
              option1.innerHTML = "Select Student";
              option1.value = "";
              $('.students_name').append(option1);
              var stu_array = JSON.parse(res);
              var i;
              for(i=0;i<stu_array.length;i++)
              {
                var option = document.createElement('OPTION');
                option.setAttribute('stu_id',stu_array[i].student_id);
                option.setAttribute('value',stu_array[i].full_name);
                $(option).html(stu_array[i].full_name);
                $('.students_name').append(option);

              }

            }
            
          }

        });
      }else{
        $('.students_name').html("<option value=''>Select Student</option>");
      }
    } else{
      alert('Please select a Search by option !');
    }
  });

//get student details by selecting student name
   $('.students_name').on('change',function(){
      var stu_id = this.options[this.selectedIndex].getAttribute('stu_id')
      var stu_name = $(this).val();
      $.ajax({
        type : 'POST',
        url : window.base_url+'institute/getStudentData',
        data : {
          stu_id : stu_id,
          stu_name : stu_name
        },
        success : function(res){
          var stu_array = JSON.parse(res);
          console.log(stu_array);
          $(".stu_name").html(stu_array[0].full_name);
          $(".father_name").html(stu_array[0].s_w_d_of);
          $(".mother_name").html(stu_array[0].mother_name);
          $(".occupation").html(stu_array[0].occupation);
          $(".dob").html(stu_array[0].dob);
          $(".gender").html(stu_array[0].gender);
          $(".course_name").html(stu_array[0].course);
          $(".stream_name").html(stu_array[0].stream);
          $(".course_dur").html(stu_array[0].course);
          $(".yoa").html(stu_array[0].yoa);
          $(".reffered_by").html(stu_array[0].reffered_by);
          $(".mobile").html(stu_array[0].mobile);
          $(".package").html(stu_array[0].package);
          $(".yearly_fee").html(stu_array[0].yearly_fee);
          $(".email").html(stu_array[0].email);
          $(".address").html(stu_array[0].address);
          $(".edit_package_btn").attr('student_id',stu_id);
          if(stu_array[0].student_photo != null)
          {
            $(".blah").attr('src',window.base_url+'uploads/'+stu_array[0].student_photo);
          }
          else{
            $(".blah").attr('src',window.base_url+'assets/dashboard/img/person2.jpg');
          }
          var i;
          var paid = 0;
          for(i=1;i<=stu_array.length-1;i++)
          {
            var yr_id = stu_array[i].yr_id;
            paid += Number(stu_array[i].paid_amount);
          }
          $(".paid_amount").html(paid);
          var due = Number(stu_array[0].package-paid);
          $(".due_amount").html(due);
        }
      });
   });

//edit package info in admin panel
  $(".edit_package_btn").on('click',function(){
    var student_id = $(this).attr('student_id');
    $.ajax({
      type : "POST",
      url : window.base_url+"admin/get_package_info",
      data : {
        student_id : student_id,
      },
      success : function(res){
        $("#editPackageModal").modal('show');
        var info = JSON.parse(res);

      //add or substract package
        $(".total_package_td").append(info[0].package);
        var input = document.createElement("INPUT");
        $(".add_package_td").append(input);
        $(".add_package_btn").attr('student_id',student_id);
        $(".add_package_td input").on('input',function(){
          var prev_package = Number(info[0].package);
          var add_value = Number($(this).val());
          var total_value = prev_package+add_value;
          $(".total_package_td").html(total_value);
        });

        $(".add_package_btn").on('click',function(){
          var student_id = $(this).attr('student_id');
          var current_package = $(".total_package_td").html();
          $.ajax({
            type : 'POST',
            url : window.base_url+'admin/update_package',
            data : {
              student_id : student_id,
              current_package : current_package
            },
            success : function(res){
              alert(res);
              
            }
          });
        });

      //add or substract yearly fees
        var i;
        for(i=0;i<info.length;i++)
        {
          var tr = document.createElement('TR');
          var td1 = document.createElement('TD');
          var td2 = document.createElement('TD');
          td2.className = "yearly_fee_td";
          var td3 = document.createElement('TD');
          var td4 = document.createElement('TD');
          var td5 = document.createElement('TD');
      
          $(td1).append(info[i].yr_id);
          $(td2).append(info[i].yearly_fee);
          $(td3).append(info[i].paid_amount);
          var input1 = document.createElement("INPUT");
          input1.className = "yearly_fee_input";
          $(td4).append(input1);
          var button = document.createElement("BUTTON");
          button.innerHTML = "Add/Substract";
          button.className = "btn btn-primary yearly_fee_add_btn";
          button.setAttribute("yr_id",info[i].yr_id);
          button.setAttribute("student_id",info[i].student_id);
          $(td5).append(button);

          $(tr).append(td1);
          $(tr).append(td2);
          $(tr).append(td3);
          $(tr).append(td4);
          $(tr).append(td5);
        
          $("#edit_package_tbody").append(tr);

        }

        $(".yearly_fee_add_btn").on('click',function(){
          var yr_id = $(this).attr('yr_id');
          var student_id = $(this).attr('student_id');
          var parent_tr = this.parentElement.parentElement;
          var td = $(parent_tr).children();
          var prev_yearly_fee = Number($(td[1]).html());
          var add_input = $(td[3]).children();
          var input_value = Number($(add_input).val());
          var current_fee = prev_yearly_fee+input_value;
          $.ajax({
              type : "POST",
              url : window.base_url+"admin/update_yearly_fees",
              data : {
                yr_id : yr_id,
                student_id : student_id,
                current_fee : current_fee
              },
              success : function(res){
                alert(res);
              }
            });
        });

        // $(".yearly_fee_input").on('input',function(){
        //   var add_fee_value = Number($(this).val());
        //   var parent_tr = this.parentElement.parentElement;
        //   var td = $(parent_tr).children();
        //   var prev_yearly_fee = Number($(td[1]).html());
        //   var current_yearly_fee = add_fee_value+prev_yearly_fee;

        //   var add_btn_td = $(td[4]).children();
        //   $(add_btn_td).on('click',function(){
        //   var yr_id = $(this).attr('yr_id');
        //   var student_id = $(this).attr('student_id');
        //     $.ajax({
        //       type : "POST",
        //       url : window.base_url+"admin/update_yearly_fees",
        //       data : {
        //         yr_id : yr_id,
        //         student_id : student_id,
        //         current_fee : current_yearly_fee
        //       },
        //       success : function(res){
        //         alert(res);
        //       }
        //     });
        //   });

        // });

      }
    });
  });

// Agent Edit js
function editAgent(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/getAgentById',
    data: {
      'agent_id': id,
    },
    success: function(res){
      var res = JSON.parse(res)
      console.log("res", res);  
      $('#opnpopup').modal('show');
      $("#blah").attr('src',window.base_url+"uploads/"+res[0].agent_photo);
      $('#number').val(res[0].agent_mobile);
      $('#agentName').val(res[0].agent_name);
      $('#location').val(res[0].agent_location);
      $('#amountword').val(res[0].agent_address);
      $('#amountword').val(res[0].agent_address);
      $('#createDate').val(res[0].created_at);
      $('#kyc').val(res[0].agent_kyc);
      $('#pan_number').val(res[0].pan_number);
      $('#agent_id').val(res[0].agent_id);
      // $('#frntimg').val(res[0].id_front);
      $('#front_side').attr('src',window.base_url+"uploads/"+res[0].id_front);
      $('#back_side').attr('src',window.base_url+"uploads/"+res[0].id_back);
    }
  })
}
// Agent Edit js
function editAannouncment(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/getannouncmentById',
    data: {
      'agent_id': id,
    },
    success: function(res){
      var res = JSON.parse(res)
      $('#opnpopup').modal('show');
      $('#announcement').val(res[0].announcment_title);
      $('#start_date').val(res[0].announcment_start_date);
      $('#end_date').val(res[0].announcment_end_date);
      $('#description').val(res[0].announcment_discription);
      $('#agent_id').val(res[0].announcment_id);
      // $('#frntimg').val(res[0].id_front);
      console.log("res[0].id_front", res[0].id_front);
      $('#front_side').attr('src','/uploads/'+res[0].id_front);
      $('#back_side').attr('src','/uploads/'+res[0].id_back);
    }
  })
}

// SubAgent Edit js
function editSubAgent(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/sub_agent_id',
    data: {
      'sub_agent_id': id,
    },
    success: function(res){
      var res = JSON.parse(res)
      console.log("res", res); 
      $('#opnpopup').modal('show');  
      $('#sub_agent_id').val(res[0].sub_agent_id);
      $('#subagentname').val(res[0].sub_agent_name);
      $('#number').val(res[0].sub_agent_mobile);
      $('#location').val(res[0].sub_agent_location);
      $('#permanentAdd').val(res[0].sub_agent_address);
      $('#agentname').val(res[0].sub_agent_name);
      $('#creatdate').val(res[0].created_at);
      $('#kyc').val(res[0].sub_agent_id);
      
    }
  })
}

// Vendor Edit js
function editVendor(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/editVendor',
    data: {
      'vendor_id': id,
    },
    success: function(res){
      var res = JSON.parse(res)
      console.log("res", res);  
      $('#opnpopup').modal('show');
      $('#vendor_id').val(res[0].vendor_id);
      $('#agentName').val(res[0].vendor_name);
      $('#number').val(res[0].vendor_mobile);
      $('#gst_number').val(res[0].vendor_gst);
      $('#location').val(res[0].vendor_location);
      $('#amountword').val(res[0].vendor_address);
      $('#createDate').val(res[0].vendor_created_date);
      $('#kyc').val(res[0].kyc);
      $('#kyc').val(res[0].vendor_kyc);
      $('#front_side').attr('src','/uploads/'+res[0].id_front);
      $('#back_side').attr('src','/uploads/'+res[0].id_back);
    }
  })
}

// Stream Edit js
function editStream(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/editStream',
    data: {
      'stream_id': id,
    },
    success: function(res){
      var res = JSON.parse(res)
      console.log("res", res);  
      $('#opnpopup').modal('show');
      $('#stream_id').val(res[0].stream_id);
      $('#selectname').val(res[0].course);
      $('#streamname').val(res[0].stream_name);
      $('#description').val(res[0].stream_discription);
      $('#eligibility').val(res[0].eligibility);
    }
  })
}
// Staf Edit js
function editStaff(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/editStaf',
    data: {
      'employee_id': id,
    },
    success: function(res){
      var res = JSON.parse(res)  
      $('#opnpopup').modal('show');
      $("#opnpopup .modal-title").html("Edit Employee");
      if(res[0].emp_photo != null)
      {
        $("#opnpopup #blah").attr('src',base_url+'uploads/'+res[0].emp_photo);
      }else{
        $("#opnpopup #blah").attr('src',base_url+'assets/dashboard/img/person2.jpg');
      }
      $('#employee_id').val(res[0].employee_id);   
      $('#staffname').val(res[0].employee_name);   
      $('#number').val(res[0].employee_mobile);
      $('#location').val(res[0].location);
      $('#email').val(res[0].employee_email);   
      // $('#location').val(res[0].employee_mobile);   
      $('#campaig_passworddfdf').val(res[0].employee_address);   
      $('#kyc').val(res[0].employee_designation);   
      $('#creatdate').val(res[0].date_of_joining);   
      $('#agentname').val(res[0].employee_status);   
      $('#department').val(res[0].department);

      if(res[1].dashboard == 'on')
      {
        $("#staffform input[name=dashboard]").prop('checked',true);
        add_sub_menu("#staffform input[name=dashboard]",'dashboard','dashboard');
      }
      if(res[1].dashboard_edit == 'on')
      {
        $("#staffform input[name=dashboard_edit]").prop('checked',true);
      }
      if(res[1].dashboard_delete == 'on')
      {
        $("#staffform input[name=dashboard_delete]").prop('checked',true);
      }

      if(res[1].inbox == 'on')
      {
        $("#staffform input[name=inbox]").prop('checked',true);
        add_sub_menu("#staffform input[name=inbox]",'inbox','Inbox');
      }
      if(res[1].inbox_edit == 'on')
      {
        $("#staffform input[name=inbox_edit]").prop('checked',true);
      }
      if(res[1].inbox_delete == 'on')
      {
        $("#staffform input[name=inbox_delete]").prop('checked',true);
      }

      if(res[1].search == 'on')
      {
        $("#staffform input[name=student_search]").prop('checked',true);
        add_sub_menu("#staffform input[name=student_search]",'student_search','Student Search');
      }
      if(res[1].search_edit == 'on')
      {
        $("#staffform input[name=student_search_edit]").prop('checked',true);
      }
      if(res[1].search_delete == 'on')
      {
        $("#staffform input[name=student_search_delete]").prop('checked',true);
      }

      if(res[1].leads == 'on')
      {
        $("#staffform input[name=leads]").prop('checked',true);
        add_sub_menu("#staffform input[name=leads]",'leads','Online Leads');
      }
      if(res[1].leads_edit == 'on')
      {
        $("#staffform input[name=leads_edit]").prop('checked',true);
      }
      if(res[1].leads_delete == 'on')
      {
        $("#staffform input[name=leads_delete]").prop('checked',true);
      }

      if(res[1].admission == 'on')
      {
        $("#staffform input[name=admission]").prop('checked',true);
        add_sub_menu("#staffform input[name=admission]",'admission','Admission');
      }
      if(res[1].admission_edit == 'on')
      {
        $("#staffform input[name=admission_edit]").prop('checked',true);
      }
      if(res[1].admission_delete == 'on')
      {
        $("#staffform input[name=admission_delete]").prop('checked',true);
      }

      if(res[1].students == 'on')
      {
        $("#staffform input[name=students]").prop('checked',true);
        add_sub_menu("#staffform input[name=students]",'students','Students');
      }
      if(res[1].students_edit == 'on')
      {
        $("#staffform input[name=students_edit]").prop('checked',true);
      }
      if(res[1].students_delete == 'on')
      {
        $("#staffform input[name=students_delete]").prop('checked',true);
      }

      if(res[1].associate == 'on')
      {
        $("#staffform input[name=associate]").prop('checked',true);
        add_sub_menu("#staffform input[name=associate]",'associate','Associate');
      }
      if(res[1].associate_edit == 'on')
      {
        $("#staffform input[name=associate_edit]").prop('checked',true);
      }
      if(res[1].associate_delete == 'on')
      {
        $("#staffform input[name=associate_delete]").prop('checked',true);
      }

      if(res[1].assos_req == 'on')
      {
        $("#staffform input[name=assos_req]").prop('checked',true);
        add_sub_menu("#staffform input[name=assos_req]",'assos_req','Associate Requests');
      }
      if(res[1].assos_req_edit == 'on')
      {
        $("#staffform input[name=assos_req_edit]").prop('checked',true);
      }
      if(res[1].assos_req_delete == 'on')
      {
        $("#staffform input[name=assos_req_delete]").prop('checked',true);
      }

      if(res[1].institutes == 'on')
      {
        $("#staffform input[name=institutes]").prop('checked',true);
        add_sub_menu("#staffform input[name=institutes]",'institutes','Institutes');
      }
      if(res[1].institutes_edit == 'on')
      {
        $("#staffform input[name=institutes_edit]").prop('checked',true);
      }
      if(res[1].institutes_delete == 'on')
      {
        $("#staffform input[name=institutes_delete]").prop('checked',true);
      }

      if(res[1].fee_mgmt == 'on')
      {
        $("#staffform input[name=fee_mgmt]").prop('checked',true);
        add_sub_menu("#staffform input[name=fee_mgmt]",'fee_mgmt','Fee Management');
      }
      if(res[1].fee_mgmt_edit == 'on')
      {
        $("#staffform input[name=fee_mgmt_edit]").prop('checked',true);
      }
      if(res[1].fee_mgmt_delete == 'on')
      {
        $("#staffform input[name=fee_mgmt_delete]").prop('checked',true);
      }

      if(res[1].courses == 'on')
      {
        $("#staffform input[name=courses]").prop('checked',true);
        add_sub_menu("#staffform input[name=courses]",'courses','Courses');
      }
      if(res[1].courses_edit == 'on')
      {
        $("#staffform input[name=courses_edit]").prop('checked',true);
      }
      if(res[1].courses_delete == 'on')
      {
        $("#staffform input[name=courses_delete]").prop('checked',true);
      }

      if(res[1].stream == 'on')
      {
        $("#staffform input[name=stream]").prop('checked',true);
        add_sub_menu("#staffform input[name=stream]",'stream','Stream');
      }
      if(res[1].stream_edit == 'on')
      {
        $("#staffform input[name=stream_edit]").prop('checked',true);
      }
      if(res[1].stream_delete == 'on')
      {
        $("#staffform input[name=stream_delete]").prop('checked',true);
      }

      if(res[1].vendor == 'on')
      {
        $("#staffform input[name=vendor]").prop('checked',true);
        add_sub_menu("#staffform input[name=vendor]",'vendor','Vendors');
      }
      if(res[1].vendor_edit == 'on')
      {
        $("#staffform input[name=vendor_edit]").prop('checked',true);
      }
      if(res[1].vendor_delete == 'on')
      {
        $("#staffform input[name=vendor_delete]").prop('checked',true);
      }

      if(res[1].reports == 'on')
      {
        $("#staffform input[name=reports]").prop('checked',true);
        add_sub_menu("#staffform input[name=vendor]",'vendor','Vendors');
      }
      if(res[1].reports_edit == 'on')
      {
        $("#staffform input[name=reports_edit]").prop('checked',true);
      }
      if(res[1].reports_delete == 'on')
      {
        $("#staffform input[name=reports_delete]").prop('checked',true);
      }

      if(res[1].sms == 'on')
      {
        $("#staffform input[name=sms]").prop('checked',true);
        add_sub_menu("#staffform input[name=sms]",'sms','Sms');
      }
      if(res[1].sms_edit == 'on')
      {
        $("#staffform input[name=sms_edit]").prop('checked',true);
      }
      if(res[1].sms_delete == 'on')
      {
        $("#staffform input[name=sms_delete]").prop('checked',true);
      }

      if(res[1].social_media == 'on')
      {
        $("#staffform input[name=social_media]").prop('checked',true);
        add_sub_menu("#staffform input[name=social_media]",'social_media','Social Media');
      }
      if(res[1].social_media_edit == 'on')
      {
        $("#staffform input[name=social_media_edit]").prop('checked',true);
      }
      if(res[1].social_media_delete == 'on')
      {
        $("#staffform input[name=social_media_delete]").prop('checked',true);
      }
      
    }
  })
}

// Delete Ajax
var selectedArr = [];
// Select All Checkbox
$('#selectAll').click(function(){
  var current = $(this).prop("checked");
  var allCheck = $(".singleInput");
  
  if (current) {
    var tr = $('#myTable #tableBody').children();
    var tr_length = tr.length;
    var j;
    for(j=0;j<tr_length;j++)
    {
      var td = $(tr[j]).children();
      var email = $(td[4]).children().html();
      selectedEmail.push(email);
    }
    for(var i = 0; i < allCheck.length; i++){
        $(allCheck[i]).prop("checked", true);
        var index = selectedArr.indexOf($(allCheck[i]).val())
        if (index == -1) {
          selectedArr.push($(allCheck[i]).val());
        }
    }
    console.log("selectedArr", selectedArr);
    $('#multiDelete').show();
  }else{
      $('.singleInput').prop("checked", false);
      $('#multiDelete').hide();
      selectedArr = [];
  }
})
// select One By One
var count = 0;
$(document).on('click', '.singleInput', function(){
  var valueTrue = $(this);
  var totCheck = $('.singleInput');
  console.log("totCheck", totCheck.length);
  var index = selectedArr.indexOf(valueTrue.val());
  if (index == -1) {
    selectedArr.push(valueTrue.val());
    count++;
  }else{
    selectedArr.splice(index, 1);
    count--;
  }
  if (count > 1) {
    $('#multiDelete').show();
  }else{
    $('#multiDelete').hide();
  }
  if (count == totCheck.length) {
    $('#selectAll').prop("checked", true);
  }else{
    $('#selectAll').prop("checked", false);
  }
  console.log("selectedArr", selectedArr);
})


function deleteFunc(getId = ''){
  if (getId == ''){}else{
    selectedArr.push(getId);
  }
  console.log("selectedArr", selectedArr);
  $('#DeleteClientPopup').modal('show');
}

$(document).on('submit', '#singleDeleteIdq', function(e){  
  e.preventDefault();
  $.ajax({
    type: this.getAttribute('method'),
    url: this.getAttribute('action'),
    data: {
      'deleteArr': selectedArr,
    },
    success: function(res){
      var res = JSON.parse(res);
      location.reload();
    }
  })
})
  
// payment Append section
var payApp=0;
function appendSection(){
  payApp++;
   $('.appndpymntfiled').append('<div><div class="form-group row formlableinput"><div class="col-12 text-left"><label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount*</label><input id="amount'+payApp+'" type="text" name="amount[]" class="form-control makeReqin" required autocomplete="new"></div></div><div style="margin-left: 73px;" class="form-group row formlableinput"><div class="col-12 text-left"><label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Payment Mode*</label><select id="payment'+payApp+'" type="text" name="payment[]" class="form-control makeReqin" required><option value="1">paid</option><option value="2">unpaid</option></select></div></div><div class="form-group row formlableinput"><div class="col-12 text-left"><label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date*</label><input id="date'+payApp+'" type="text" name="date" class="form-control makeReqin date examDate" required autocomplete="new"></div></div><div style="margin-left: 73px;" class="form-group row formlableinput"><div class="col-12 text-left"><label></label><span style="display:block;" class="item-except m-t-6 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><a onclick="deleteAppend(this);" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></a></span></div></div></div>');  
}
function deleteAppend(e){
  $(e).parent().parent().parent().parent().remove();
  payApp--;
}

function sendSmsPop(e_D, e_M){
  $('#sendSmsPop').modal('show');
  $('#eShiddenid').val(e_D);
  $('#mhiddenid').val(e_M);
}

$(document).on('keyup', '.sendSMSTextArea', function(){
  var charAt = $(this).val().length;
  if (charAt > 160){
    $(this).next('.showMsgLength').css('color','red');
  }else{
    $(this).next('.showMsgLength').css('color','green');
  }

  $(this).next('.showMsgLength').find('.showMsgLengthS').text(charAt);
})


function deleteFunc(getId = ''){
  if (getId == ''){}else{
    selectedArr.push(getId);
  }
  console.log("selectedArr", selectedArr);
  $('#DeleteClientPopup').modal('show');
}

$(document).on('submit', '#singleDeleteIdq', function(){

  $.ajax({
    type: this.getAttribute('method'),
    url: this.getAttribute('action'),
    data: {
      'deleteArr': selectedArr,
    },
    success: function(res){
      var res = JSON.parse(res);
      location.reload();
    }
  })
})
  
// payment Append section
var payApp=0;
function appendSection(){
  payApp++;
   $('.appndpymntfiled').append('<div><div class="form-group row formlableinput"><div class="col-12 text-left"><label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Amount*</label><input id="amount'+payApp+'" type="text" name="amount[]" class="form-control makeReqin" required autocomplete="new"></div></div><div style="margin-left: 73px;" class="form-group row formlableinput"><div class="col-12 text-left"><label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Payment Mode*</label><select id="payment'+payApp+'" type="text" name="payment[]" class="form-control makeReqin" required><option value="1">paid</option><option value="2">unpaid</option></select></div></div><div class="form-group row formlableinput"><div class="col-12 text-left"><label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Date*</label><input id="date'+payApp+'" type="text" name="date" class="form-control makeReqin date examDate" required autocomplete="new"></div></div><div style="margin-left: 73px;" class="form-group row formlableinput"><div class="col-12 text-left"><label></label><span style="display:block;" class="item-except m-t-6 displayBlck _wtClr_ _fs14_" id="Delete-bttn"><a onclick="deleteAppend(this);" class="btn _fs14_ _bggrn_ i-con-h-a Delete-bttn"><i class="i-con i-con-trash"><i></i></i></a></span></div></div></div>');  
}
function deleteAppend(e){
  $(e).parent().parent().parent().parent().remove();
  payApp--;
}

function editPaymentDetails(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/editPaymentDetails',
    data: {
      'payment_id': id,
    },
    success: function(res){
      res = JSON.parse(res);
      console.log("res", res);
      $('#opnPaymentpopup').modal('show');
      $('#date').val(res[0].payment_date);
      $('#subagentname').val(res[0].subagentname);
      $('#amount').val(res[0].amount);
      $('#remark').val(res[0].remark);
      $('#payment').val(res[0].payment_type);
      $('#purpose').val(res[0].purpose);
      $('#total_payment').val(res[0].total_payment);
      $('#m_payment').val(res[0].payment_mode);
      $('#amountInWord').val(res[0].amount_in_words);
      $('#payment_id').val(res[0].payment_id);
    }
  })
}

function print_check(current){
  var getActiveClass = $(current).next('.printDropDown').hasClass('active');
  if (getActiveClass){
    $(current).next('.printDropDown').removeClass('active');
  }else{
    $(current).next('.printDropDown').addClass('active');
  }
}

function firstTd(data){
  return '<td class="sorting_1"><label class="checkboxcontainer"><input type="checkbox" value="'+data+'" class="pivileges singleInput"><span class="checkmark"></span></label></td>';
}

function otherTD(data){
  return '<td><div class="item-except _greyClr_ _fs14_">'+data+'</div></td>';
}

function lastTD(data){
  return '<td class="actionbtns"><button class="btn _fs14_ _bgbrwn_ i-con-h-a edit-bttn" style="color: #fff" onclick="sendToIndivisual('+data+')">Send SMS</button></td>';
}

function appendToTable(tbleData){
  $('#myTable').dataTable().fnClearTable();
  $('#myTable').dataTable().fnDestroy();
  $('#tableBody').empty().append(tbleData);
  $('#myTable').dataTable();
  console.log("sendToAll", sendToAll);
  
}

//select one by one for email send
var count = 0;
var selectedEmail = [];
$(document).on('click', '.singleInput', function(){
  var parent_td = $(this).parent().parent();
  var totCheck = $('.singleInput');
  var parent_tr = $(parent_td).parent();
  var all_td = $(parent_tr).children();
  var email = $(all_td[4]).children().html();
  var name = $(all_td[2]).children().html();
  var details = {
    'name' : name,
    'email' : email,
  };
  //selectedEmail.push(email);
  var index = selectedEmail.indexOf(details);
  if (index == -1) {
    selectedEmail.push(details);
    count++;
  }else{
    selectedEmail.splice(index, 1);
    count--;
  }
  if (count == totCheck.length) {
    $('#selectAll').prop("checked", true);
  }else{
    $('#selectAll').prop("checked", false);
  }
});


//send to selected email
$("#sendEmailAll").on("click",function(){
    if(selectedEmail != 0)
    {
      $("#emailpopup").modal('show');
      $("#sendEmailMess").on("click",function(){
        var subject = $("#emailSubject").val();
        var message = $("#emailMessage").val();
        $.ajax({
          type : "POST",
          url : window.base_url+"institute/sendEmailAll",
          data : {
            details : JSON.stringify(selectedEmail),
            message : message,
            subject : subject
          },
          success : function(res){
            $("#emailpopup").modal('hide');
            //$("#numberofStudentSent").modal('show');
            alert(res);
          }
        });
      });
        
    }
    else{
      alert("No Student selected !");
    }
  });


//send email to all
// $("#sendEmailAll").on("click",function(){
//     var tr = $('#myTable #tableBody').children();
//     var tr_length = tr.length;
//     var i;
//     var emailArray = [];
//     for(i=0;i<tr_length;i++)
//     {
//       var td = $(tr[i]).children();
//       var email = $(td[4]).children().html();
//       emailArray.push(email);
//     }
//     if(emailArray != "")
//     {
//       $("#emailpopup").modal('show');
//       $("#sendEmailMess").on("click",function(){
//         var subject = $("#emailSubject").val();
//         var message = $("#emailMessage").val();
//         $.ajax({
//           type : "POST",
//           url : window.base_url+"institute/sendEmailAll",
//           data : {
//             emails : JSON.stringify(emailArray),
//             message : message,
//             subject : subject
//           },
//           success : function(res){
//             $("#emailpopup").modal('hide');
//             //$("#numberofStudentSent").modal('show');
//             alert(res);
//           }
//         });
//       });
      
//     }
//     else{
//       alert("No student Selected !");
//     }
// });


$(document).on('change', '#byYear', function(){
  var byYear = $(this).val();
  sendToAll = [];
  $.ajax({
    type: 'POST',
    url: window.base_url+"institute/get_all_student_by_year",
    data:{
      'yoa': byYear
    },
    success: function(res){
      res = JSON.parse(res);
      console.log("res", res);
      var tbleData = '';
      for(var i = 0; i < res.length; i++){
        sendToAll.push(res[i].mobile);
        tbleData += '<tr role="row" class="odd">'
        tbleData +=  firstTd(res[i].mobile);         
        tbleData +=  otherTD(i+1);       
        tbleData +=  otherTD(res[i].full_name);    
        tbleData +=  otherTD(res[i].mobile);
        tbleData +=  otherTD(res[i].email); 
        tbleData +=  otherTD(res[i].city);
        tbleData +=  otherTD(res[i].course);
        tbleData +=  otherTD(res[i].stream);
        tbleData +=  otherTD(res[i].yoa);
        tbleData +=  lastTD(res[i].mobile);
        tbleData +=  '</tr>';       
      }
      appendToTable(tbleData);
    }
  })
})

function sendToIndivisual(m_n){
  selectedArr = [];
  $('#opnpopup').modal('show');
  selectedArr.push(m_n);
}

$(document).on('change', '#byStream', function(){
  var byStream = $(this).val();
  sendToAll = [];
  $.ajax({
    type: 'POST',
    url: window.base_url+"institute/get_all_student_by_stream",
    data:{
      'stream': byStream
    },
    success: function(res){
      res = JSON.parse(res);
      console.log("res", res);
      var tbleData = '';
      for(var i = 0; i < res.length; i++){
        sendToAll.push(res[i].mobile);
        tbleData += '<tr role="row" class="odd">'
        tbleData +=  firstTd(res[i].mobile);         
        tbleData +=  otherTD(i+1);       
        tbleData +=  otherTD(res[i].full_name);    
        tbleData +=  otherTD(res[i].mobile);
        tbleData +=  otherTD(res[i].email); 
        tbleData +=  otherTD(res[i].city);
        tbleData +=  otherTD(res[i].course);
        tbleData +=  otherTD(res[i].stream);
        tbleData +=  otherTD(res[i].yoa);
        tbleData +=  lastTD(res[i].mobile);
        tbleData +=  '</tr>';       
      }
      appendToTable(tbleData);
    }
  })
})

$(document).on('change', '#byCourse', function(){
  var byCourse = $(this).val();
  sendToAll = [];
  $.ajax({
    type: 'POST',
    url: window.base_url+"institute/get_all_student_by_course",
    data:{
      'course': byCourse
    },
    success: function(res){
      res = JSON.parse(res);
      console.log("res", res);
      var tbleData = '';
      for(var i = 0; i < res.length; i++){
        sendToAll.push(res[i].mobile);
        tbleData += '<tr role="row" class="odd">'
        tbleData +=  firstTd(res[i].mobile);         
        tbleData +=  otherTD(i+1);       
        tbleData +=  otherTD(res[i].full_name);    
        tbleData +=  otherTD(res[i].mobile);
        tbleData +=  otherTD(res[i].email); 
        tbleData +=  otherTD(res[i].city);
        tbleData +=  otherTD(res[i].course);
        tbleData +=  otherTD(res[i].stream);
        tbleData +=  otherTD(res[i].yoa);
        tbleData +=  lastTD(res[i].mobile);
        tbleData +=  '</tr>';       
      }
      appendToTable(tbleData);
    }
  })
})

$(document).on('change', '#toStaff', function(){
  var toStaff = $(this).val();
  sendToAll = [];
  $.ajax({
    url: window.base_url+"institute/get_all_staff",
    success: function(res){
      res = JSON.parse(res);
      console.log("res", res);
      var tbleData = '';
      for(var i = 0; i < res.length; i++){
        sendToAll.push(res[i].mobile);
        tbleData += '<tr role="row" class="odd">'
        tbleData +=  firstTd(res[i].mobile);         
        tbleData +=  otherTD(i+1);       
        tbleData +=  otherTD(res[i].full_name);    
        tbleData +=  otherTD(res[i].mobile);
        tbleData +=  otherTD(res[i].email); 
        tbleData +=  otherTD(res[i].city);
        tbleData +=  otherTD(res[i].course);
        tbleData +=  otherTD(res[i].stream);
        tbleData +=  otherTD(res[i].yoa);
        tbleData +=  lastTD(res[i].mobile);
        tbleData +=  '</tr>';       
      }
      appendToTable(tbleData);
    }
  })
})


$(document).on('click', '#sendToAllH', function(){
  $('#sendSmsPop').modal('show');
});

$(document).on('click', '#sendSmsPopAll', function(){

console.log("sendToAll", sendToAll);
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/sendIndivisualMess',
    data: {
      'content': $('#sendSmsPopAllText').val(),
      'sendSMS': sendToAll,
    },
    success:function(res){
      alert(res);
      // if (res.status==true) {
      //   vNotify.success({text:res.message})
      // }else{
      //   vNotify.error({text:res.errormessage})
      // }
      // sendToAll = []
    }
  })
})

$(document).on('click', '#sendIndivisualMess', function(e){ 
  console.log("selectedArr", selectedArr);
  $.ajax({
    type: 'POST',
    url: window.base_url+'institute/sendIndivisualMess',
    data: {
      'content': $('#sendIndivisualMessTexts').val(),
      'sendSMS': selectedArr,
    },
    success:function(res){
      alert(res);
      // if (res.status==true) {
      //   vNotify.success({text:res.message})
      // }else{
      //   vNotify.error({text:res.errormessage})
      // }
      // selectedArr = []
    }
  })
})

function showDropDown(geCr){
  var getCr = $(geCr).parents('.actionbtns').find('.dropdownList');
  $('.dropdownList').removeClass('show');
  if (getCr.hasClass('show')){
    $(getCr).removeClass('show');
  }else{
    $(getCr).addClass('show');
  }
}

$(document).mouseup(function (e) {
  if ($(e.target).closest(".dropdownList").length === 0) {
    $(".dropdownList").removeClass('show'); 
  } 
});

$(document).mouseup(function (e) {
  if ($(e.target).closest(".printDropDown").length === 0) {
    $(".printDropDown").removeClass('active'); 
  } 
});

function loanLetter(_id){
  $('#student_HJ').val(_id);
  $('#loan_letter').modal('show');
}

//set fee structure
function feeStructureBonafide(id,dur){
  $("#bonafide_fees_form .course_dur").html("");
  $("#bonafide_fees_form .hostel_fee_div").html("");
  $("#bonafide_fees_form .univ_fee_div").html("");
  $("#bonafide_fees_form .clinical_fee_div").html("");
  $("#bonafide_fees_form .sports_fee_div").html("");
  $("#bonafide_fees_form .misc_fee_div").html("");
  var i;
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var hostel_input = document.createElement('INPUT');
    hostel_input.className = "hostel_input";
    $(hostel_input).attr('required','required');
    $("#bonafide_fees_form .hostel_fee_div").append("Year: "+yr);
    $("#bonafide_fees_form .hostel_fee_div").append(hostel_input);
  }
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var univ_input = document.createElement('INPUT');
    univ_input.className = "univ_input";
    $(univ_input).attr('required','required');
    $("#bonafide_fees_form .univ_fee_div").append("Year: "+yr);
    $("#bonafide_fees_form .univ_fee_div").append(univ_input);
  }
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var clinical_input = document.createElement('INPUT');
    clinical_input.className = "clinical_input";
    $(clinical_input).attr('required','required');
    $("#bonafide_fees_form .clinical_fee_div").append("Year: "+yr);
    $("#bonafide_fees_form .clinical_fee_div").append(clinical_input);
  }
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var sports_input = document.createElement('INPUT');
    sports_input.className = "sports_input";
    $(sports_input).attr('required','required');
    $("#bonafide_fees_form .sports_fee_div").append("Year: "+yr);
    $("#bonafide_fees_form .sports_fee_div").append(sports_input);
  }
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var misc_input = document.createElement('INPUT');
    misc_input.className = "misc_input";
    $(misc_input).attr('required','required');
    $("#bonafide_fees_form .misc_fee_div").append("Year: "+yr);
    $("#bonafide_fees_form .misc_fee_div").append(misc_input);
  }
  
  $('#fee_structure_bonafide').modal('show');

//form submit
  $("#bonafide_fees_form").submit(function(e){
    e.preventDefault();
    var hostel = $(".hostel_input");
    var hostel_length = hostel.length;
    var hostel_arr = [];
    var i;
    for(i=0;i<hostel_length;i++)
    {
      var hostel_val = $(hostel[i]).val();
      hostel_arr[i] = hostel_val;
    }
    var hostel_string = JSON.stringify(hostel_arr);
    
    var univ = $(".univ_input");
    var univ_length = univ.length;
    var univ_arr = [];
    for(i=0;i<univ_length;i++)
    {
      var univ_val = $(univ[i]).val();
      univ_arr[i] = univ_val;
    }
    var univ_string = JSON.stringify(univ_arr);

    var clinical = $(".clinical_input");
    var clinical_length = clinical.length;
    var clinical_arr = [];
    for(i=0;i<clinical_length;i++)
    {
      var clinical_val = $(clinical[i]).val();
      clinical_arr[i] = clinical_val;
    }
    var clinical_string = JSON.stringify(clinical_arr);

    var sports = $(".sports_input");
    var sports_length = sports.length;
    var sports_arr = [];
    for(i=0;i<sports_length;i++)
    {
      var sports_val = $(sports[i]).val();
      sports_arr[i] = sports_val;
    }
    var sports_string = JSON.stringify(sports_arr);

    var misc = $(".misc_input");
    var misc_length = misc.length;
    var misc_arr = [];
    for(i=0;i<misc_length;i++)
    {
      var misc_val = $(misc[i]).val();
      misc_arr[i] = misc_val;
    }
    var misc_string = JSON.stringify(misc_arr);

    window.open(window.base_url+"institute/print_bonafide_fees?student_id="+id+"&course_dur="+dur+"&hostel_fee="+hostel_string+"&univ_fee="+univ_string+"&clinical_fee="+clinical_string+"&sports_fee="+sports_string+"&misc_fee="+misc_string);
    
  });

}

//set fee structure
function feeStructure(id,dur){
  $(".course_dur").html("");
  $(".hostel_fee_div").html("");
  $(".univ_fee_div").html("");
  $(".clinical_fee_div").html("");
  $(".sports_fee_div").html("");
  $(".misc_fee_div").html("");
  var i;
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var hostel_input = document.createElement('INPUT');
    hostel_input.className = "hostel_input";
    $(hostel_input).attr('required','required');
    $(".hostel_fee_div").append("Year: "+yr);
    $(".hostel_fee_div").append(hostel_input);
  }
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var univ_input = document.createElement('INPUT');
    univ_input.className = "univ_input";
    $(univ_input).attr('required','required');
    $(".univ_fee_div").append("Year: "+yr);
    $(".univ_fee_div").append(univ_input);
  }
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var clinical_input = document.createElement('INPUT');
    clinical_input.className = "clinical_input";
    $(clinical_input).attr('required','required');
    $(".clinical_fee_div").append("Year: "+yr);
    $(".clinical_fee_div").append(clinical_input);
  }
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var sports_input = document.createElement('INPUT');
    sports_input.className = "sports_input";
    $(sports_input).attr('required','required');
    $(".sports_fee_div").append("Year: "+yr);
    $(".sports_fee_div").append(sports_input);
  }
  for(i=1;i<=dur;i++)
  {
    var yr = i;
    var misc_input = document.createElement('INPUT');
    misc_input.className = "misc_input";
    $(misc_input).attr('required','required');
    $(".misc_fee_div").append("Year: "+yr);
    $(".misc_fee_div").append(misc_input);
  }
  
  $('#fee_structure').modal('show');

//form submit
  $("#fee_structure_form").submit(function(e){
    e.preventDefault();
    var hostel = $(".hostel_input");
    var hostel_length = hostel.length;
    var hostel_arr = [];
    var i;
    for(i=0;i<hostel_length;i++)
    {
      var hostel_val = $(hostel[i]).val();
      hostel_arr[i] = hostel_val;
    }
    var hostel_string = JSON.stringify(hostel_arr);
    
    var univ = $(".univ_input");
    var univ_length = univ.length;
    var univ_arr = [];
    for(i=0;i<univ_length;i++)
    {
      var univ_val = $(univ[i]).val();
      univ_arr[i] = univ_val;
    }
    var univ_string = JSON.stringify(univ_arr);

    var clinical = $(".clinical_input");
    var clinical_length = clinical.length;
    var clinical_arr = [];
    for(i=0;i<clinical_length;i++)
    {
      var clinical_val = $(clinical[i]).val();
      clinical_arr[i] = clinical_val;
    }
    var clinical_string = JSON.stringify(clinical_arr);

    var sports = $(".sports_input");
    var sports_length = sports.length;
    var sports_arr = [];
    for(i=0;i<sports_length;i++)
    {
      var sports_val = $(sports[i]).val();
      sports_arr[i] = sports_val;
    }
    var sports_string = JSON.stringify(sports_arr);

    var misc = $(".misc_input");
    var misc_length = misc.length;
    var misc_arr = [];
    for(i=0;i<misc_length;i++)
    {
      var misc_val = $(misc[i]).val();
      misc_arr[i] = misc_val;
    }
    var misc_string = JSON.stringify(misc_arr);

    window.open(window.base_url+"institute/print_fees_structure?student_id="+id+"&course_dur="+dur+"&hostel_fee="+hostel_string+"&univ_fee="+univ_string+"&clinical_fee="+clinical_string+"&sports_fee="+sports_string+"&misc_fee="+misc_string);
    
  });

}

function editInstitute(id){
  $.ajax({
    type: 'POST',
    url: window.base_url+'admin/getInstituteById',
    data: {
      'institute_id': id,
    },
    success: function(res){
      res = JSON.parse(res);
      console.log("res", res);
      $('#opnpopup').modal('show');
      $('#name').val(res[0].institute_name);
      $('#admin').val(res[0].admin_name);
      $('#affiliation').val(res[0].affiliations);
      $('#mobile').val(res[0].institute_mobile);
      $('#landline').val(res[0].landline_no);
      $('#email').val(res[0].institute_email);
      $('#website').val(res[0].institute_website);
      $('#facebook').val(res[0].facebook_link);
      $('#instagram').val(res[0].instagram_link);
      $('#youtube').val(res[0].youtube_link);
      $('#google').val(res[0].google_business_link);
      $('#brochure').val(res[0].brochure_link);
      $('#refund').val(res[0].refund_link);
      $('#Address').val(res[0].institute_address);
      $('#allowed_student').val(res[0].institute_allowed_student);
      $('#institute_id').val(res[0].institute_id);
      $('#msg_api_username').val(res[0].msg_api_username);
      $('#msg_api_password').val(res[0].msg_api_password);
      $('#expiry_date').val(res[0].institute_expiry_date);
      $('#subdomain').val(res[0].subdomain);
      $('#payment_gateway').val(res[0].payment_api_key);
      $('#state').val(res[0].state);
      $('#city').val(res[0].city);
      $('.bank_name').val(res[0].bank_name);
      $('.branch_name').val(res[0].branch_name);
      $('.account_no').val(res[0].account_no);
      $('.ifsc_code').val(res[0].ifsc_code);
      $('.beneficiary').val(res[0].beneficiary);
      $('#html_file_name').val(res[0].html_file_name);
      $('#html_file_name_editable').val(res[0].html_file_name_editable);
      $('#old_logo').val(res[0].institute_logo);
      $(".logo-img").attr('src',base_url+'/uploads/'+res[0].institute_logo);
      $('#old_sig').val(res[0].institute_sig);
      $(".sig-img").attr('src',base_url+'/uploads/'+res[0].institute_sig);
      $('#old_banner').val(res[0].banner);
      $(".banner-img").attr('src',base_url+'/uploads/'+res[0].banner);
      $('#leads_allowed').val(res[0].leads_allowed);
      $('#emp_allowed').val(res[0].emp_allowed);
      if(res[1].dashboard == "on")
      {
        $("#form .dashboard").prop('checked', true);
      }
      if(res[1].inbox == "on")
      {
        $("#form .inbox").prop('checked', true);
      }
      if(res[1].search == "on")
      {
        $("#form .student_search").prop('checked', true);
      }
      if(res[1].leads == "on")
      {
        $("#form .leads").prop('checked', true);
      }
      if(res[1].students == "on")
      {
        $("#form .students").prop('checked', true);
      }
      if(res[1].admission == "on")
      {
        $("#form .admission").prop('checked', true);
      }
      if(res[1].associates == "on")
      {
        $("#form .associate").prop('checked', true);
      }
      if(res[1].assos_req == "on")
      {
        $("#form .assos_req").prop('checked', true);
      }
      if(res[1].institutes == "on")
      {
        $("#form .institutes").prop('checked', true);
      }
      if(res[1].fee_mgmt == "on")
      {
        $("#form .fee_mgmt").prop('checked', true);
      }
      if(res[1].courses == "on")
      {
        $("#form .courses").prop('checked', true);
      }
      if(res[1].stream == "on")
      {
        $("#form .stream").prop('checked', true);
      }
      if(res[1].staff == "on")
      {
        $("#form .staff").prop('checked', true);
      }
      if(res[1].vendor == "on")
      {
        $("#form .vendor").prop('checked', true);
      }
      if(res[1].sms == "on")
      {
        $("#form .sms").prop('checked', true);
      }
      if(res[1].social_media == "on")
      {
        $("#form .courses").prop('checked', true);
      }
      if(res[1].reports == "on")
      {
        $("#form .reports").prop('checked', true);
      }
      

    }
  })
}

$("#paid_year_wise .year_selected").on('change',function(){
  var year = $('option:selected', this).val();
  $.ajax({
    type : 'POST',
    url : window.base_url+'institute/year_wise_amount',
    data : {
      year : year,
    },
    success : function(res){
      if(res == "No data found")
      {
        $(".year_td").html(year);
        $(".amount_td").html(res);
      }
      else{
        $(".year_td").html(year);
        $(".amount_td").html(res);
      }
      
    }
  });
});

$("#yrly_expense_form").submit(function(e){
  e.preventDefault();
  var yr = $(".expense_year").val();
  var month = $(".expense_month").val();
  var month_name = $('option:selected', '.expense_month').html();
  if(month_name == "Select Month")
  {
    month_name == "-";
  }
  
  if(yr == "" && month != "")
  {
    alert("Please Select Year !");
  }
  else{
    $.ajax({
      type : 'POST',
      url : window.base_url+'institute/expenditure_report',
      data : $(this).serialize(),
      success : function(res){
        $(".expense_year_td").html(yr);
        $(".expense_month_td").html(month_name);
        $(".total_expense_td").html(res);
        
      }
    });
  }
  
});

$(function() {
  $( "#from" ).datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    onClose: function( selectedDate ) {
      $( "#to" ).datepicker( "option", "minDate", selectedDate );
    }
  });
  $( "#to" ).datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    onClose: function( selectedDate ) {
      $( "#from" ).datepicker( "option", "maxDate", selectedDate );
    }
  });
});
// $(document).ready( function (){
//   var table = $('#monthly_fees_table').dataTable( { "aoColumnDefs": [ {"bSortable": false, "aTargets": [ 0, 1, 2, 5 ] } ],  "aaSorting": [] } );
//   $.fn.dataTable.moment('MMMM D YYYY HH:mm');
//   $('select#positions').change( function() { table.fnFilter( $(this).val() ); } );
//   $('#from').keyup( function() { table.draw(); } );
//   $('#to').keyup( function() { table.draw(); } );
// } );

$("#date_search_form").submit(function(e){
  e.preventDefault();
  $.ajax({
    type : "POST",
    url : window.base_url+"institute/getDateWiseAmount",
    data : $(this).serialize(),
    success : function(res){
      $("#date_wise_tableBody").html("");
      $("#date_wise_tableBody").append(res);
    }
  });
});

//send message to management by student
$("#message_form").submit(function(e){
  e.preventDefault();
  var method = $(this).attr('method');
  var action = $(this).attr('action');
  $.ajax({
    type : method,
    url : action,
    data : $(this).serialize(),
    success : function(res){
      var data = JSON.parse(res);
          if(data.status == false){
          $( ".error-message" ).remove();
            if(data.errormessage){
              vNotify.error({text:data.errormessage, title:'Error!'});
            }
            data1   = JSON.parse(data.message);
            $('form :input').each(function(){                          
            var elementName = $(this).attr('name');        
            var message = data1[elementName];
            if(message){
              var element = $('<span>' + message + '</span>')
              .attr({
                  'class' : 'error-message'
              });
              $(this).after(element);
                $(element).fadeIn();
            }
            }); 
          }
          if(data.status == true){
            vNotify.success({text:data.message});
            $( ".error-message" ).remove();
                   // setTimeout(function(){
                   //    window.location.href = '<?php echo $base_url; ?>institute/dashboard';
                   // }, 1000); 
          }
    }
  });
});


//send mail to student
  $(".email-btn").on("click",function(){
    $("#emailSend_modal").modal('show');
    var stu_name = $(this).attr('stu_name');
    var stu_email = $(this).attr('stu_email');
    $("#stu_name").val(stu_name);
    $("#stu_email").val(stu_email);
    $("#email_send_form").submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url : window.base_url+"institute/sendEmailToStudent",
        data : $(this).serialize(),
        beforeSend: function(){
          $('.loadingMyprofile').show();
         },
        success : function(data){
            $('.loadingMyprofile').hide();
             var data = JSON.parse(data);
            console.log(data);
             if(data.status == false){
                  $( ".error-message" ).remove();
                  if(data.errormessage){
                    vNotify.error({text:data.errormessage, title:'Error!'});
                  }
                   data1   = JSON.parse(data.message);
                  $('form :input').each(function(){                          
                    var elementName = $(this).attr('name');        
                    var message = data1[elementName];
                    if(message){
                      var element = $('<span>' + message + '</span>')
                                    .attr({
                                        'class' : 'error-message'
                                    });
                      $(this).after(element);
                      $(element).fadeIn();
                    }
                  }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
              }
        }
        // error: function(data){                      
        //     $('#validation-error').html(data.message);
        // }
      });
    });
  });

//delete institute
function deleteInstitute(id)
{
  $("#DeleteClientPopup").modal('show');
  $("#singleDeleteIdq #institute_id").val(id);
  $("#singleDeleteIdq").submit(function(e){
    e.preventDefault();
    $.ajax({
      type : "POST",
      url : window.base_url+"institute/delete_institute",
      data : $(this).serialize(),
      beforeSend: function(){
        $('.loadingMyprofile').show();
      },
      success : function(data){
        $('.loadingMyprofile').hide();
             var data = JSON.parse(data);
              console.log(data);
              if(data.status == false){
                  $( ".error-message" ).remove();
                  if(data.errormessage){
                    vNotify.error({text:data.errormessage, title:'Error!'});
                  }
                   data1   = JSON.parse(data.message);
                  $('form :input').each(function(){                          
                    var elementName = $(this).attr('name');        
                    var message = data1[elementName];
                    if(message){
                      var element = $('<span>' + message + '</span>')
                                    .attr({
                                        'class' : 'error-message'
                                    });
                      $(this).after(element);
                      $(element).fadeIn();
                    }
                  }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  window.location = location.href;
              }
      }
    });
  });
  // window.location = window.base_url+"<?php echo base_url(); ?>Institute/";
}

//view institute
function viewInstitute(id)
{
  window.location = window.base_url+"admin/viewInstitute/?id="+id;
}

//student signup / student online enquiry 
$("#studentSignup").submit(function(e){
  e.preventDefault();
  alert();
});

$(".contact_done").on('click',function(){
  var lead_id = $(this).attr('lead_id');
  var result = confirm('If Contact has been done with student then press ok.');
  if(result == true)
  {
    window.location = window.base_url+"institute/updateContactStatus/"+lead_id;
  }
  
});

//student search by mobile/reg number in institute panel
   $('.student_search_by').on('change',function(){
      var srch_by = $(this).val();
      if(srch_by != '')
      {

        $("#student_search_by_admin .srch_number").on('input',function(){
          var srch_number = $(this).val();
          $.ajax({
            type : 'POST',
            url : window.base_url+'admin/searchStudents',
            data : {
              srch_by : srch_by,
              srch_number : srch_number
            },
            success : function(res){
              $('.students_name_in_admin').html('');
              if(res == 'No Data Found')
              {
                var option = document.createElement('OPTION');
                $(option).html(res);
                $('.students_name_in_admin').append(option);
              }
              else{
                var option1 = document.createElement('OPTION');
                option1.innerHTML = "Select Student";
                option1.value = "";
                $('.students_name').append(option1);
                var stu_array = JSON.parse(res);
                var i;
                for(i=0;i<stu_array.length;i++)
                {
                  var option = document.createElement('OPTION');
                  option.setAttribute('stu_id',stu_array[i].student_id);
                  option.setAttribute('value',stu_array[i].full_name);
                  $(option).html(stu_array[i].full_name);
                  $('.students_name_in_admin').append(option);

                }

              }
              
            }

          });
        });
      }

    });

//add admin
$("#add_admin_form #institute_id").on('change',function(){
  var institute_name = this.options[this.selectedIndex].innerHTML;
  $("#institute_name").val(institute_name);
});

//edit admin
$(".edit_admin_btn").on('click',function(){
  var admin_id = $(this).attr('admin_id');
  $("#adminEditModal").modal('show');
  $.ajax({
    type : 'POST',
    url : window.base_url+'admin/getAdminById',
    data : {
      admin_id : admin_id,
    },
    success : function(res){
      var admin = JSON.parse(res);
      $(".institute_id").val(admin[0].institute_id);
      $(".first_institute_name").html(admin[0].institute_name);
      $(".first_institute_name").val(admin[0].institute_id);
      $(".institute_name").val(admin[0].institute_name);
      $(".edit_name").val(admin[0].name);
      $(".edit_mobile").val(admin[0].mobile);
      $(".admin_id").val(admin[0].id);

      //add admin
      $("#edit_admin_form .institute_id").on('change',function(){
        var institute_name = this.options[this.selectedIndex].innerHTML;
        var institute_id = this.options[this.selectedIndex].value;
        $(".institute_name").html(institute_name);
        $(".institute_name").val(institute_name);
        $(".first_institute_name").val(institute_id);
      });
    }
});
});

//delete admin
$(".delete_admin_btn").on('click',function(){
  var admin_id = $(this).attr('admin_id');
  $("#DeleteClientPopup").modal('show');
  $("#singleDeleteIdq #admin_id").val(admin_id);
  $("#singleDeleteIdq").submit(function(e){
    var method = $(this).attr('method');
    var action = $(this).attr('action');
    e.preventDefault();
    $.ajax({
      type : method,
      url : action,
      data : $(this).serialize(),
      beforeSend: function(){
        $('.loadingMyprofile').show();
      },
      success : function(data){
        $('.loadingMyprofile').hide();
             var data = JSON.parse(data);
              if(data.status == false){
                  $( ".error-message" ).remove();
                  if(data.errormessage){
                    vNotify.error({text:data.errormessage, title:'Error!'});
                  }
                   data1   = JSON.parse(data.message);
                  $('form :input').each(function(){                          
                    var elementName = $(this).attr('name');        
                    var message = data1[elementName];
                    if(message){
                      var element = $('<span>' + message + '</span>')
                                    .attr({
                                        'class' : 'error-message'
                                    });
                      $(this).after(element);
                      $(element).fadeIn();
                    }
                  }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    window.location = location.href;
                  },3000);
                  
              }
      }
    });
  });
});



//get student details by selecting student name
   $('.students_name_in_admin').on('change',function(){
      var stu_id = this.options[this.selectedIndex].getAttribute('stu_id')
      var stu_name = $(this).val();
      $.ajax({
        type : 'POST',
        url : window.base_url+'admin/getStudentData',
        data : {
          stu_id : stu_id,
          stu_name : stu_name
        },
        success : function(res){
          var stu_array = JSON.parse(res);
          console.log(stu_array);
          $(".stu_name").html(stu_array[0].full_name);
          $(".father_name").html(stu_array[0].s_w_d_of);
          $(".mother_name").html(stu_array[0].mother_name);
          $(".occupation").html(stu_array[0].occupation);
          $(".dob").html(stu_array[0].dob);
          $(".gender").html(stu_array[0].gender);
          $(".course_name").html(stu_array[0].course);
          $(".stream_name").html(stu_array[0].stream);
          $(".course_dur").html(stu_array[0].course);
          $(".yoa").html(stu_array[0].yoa);
          $(".reffered_by").html(stu_array[0].reffered_by);
          $(".mobile").html(stu_array[0].mobile);
          $(".package").html(stu_array[0].package);
          $(".yearly_fee").html(stu_array[0].yearly_fee);
          $(".email").html(stu_array[0].email);
          $(".address").html(stu_array[0].address);
          if(stu_array[0].student_photo != null)
          {
            $(".blah").attr('src',window.base_url+'uploads/'+stu_array[0].student_photo);
          }
          else{
            $(".blah").attr('src',window.base_url+'assets/dashboard/img/person2.jpg');
          }
          var i;
          var paid = 0;
          for(i=1;i<=stu_array.length-1;i++)
          {
            var yr_id = stu_array[i].yr_id;
            paid += Number(stu_array[i].paid_amount);
          }
          $(".paid_amount").html(paid);
          var due = Number(stu_array[0].package-paid);
          $(".due_amount").html(due);
        }
      });
   });

//documents form submit or edit
$("#documents_form").submit(function(e){
    e.preventDefault();
    var method = $(this).attr('method');
    var action = $(this).attr('action');
    $.ajax({
      type : method,
      url : action,
      data : $(this).serialize(),
      success : function(data){
          var data = JSON.parse(data);
          if(data.status == false){
            $( ".error-message" ).remove();
              if(data.errormessage){
                vNotify.error({text:data.errormessage, title:'Error!'});
              }
              data1   = JSON.parse(data.message);
              $('form :input').each(function(){                          
                var elementName = $(this).attr('name');        
                var message = data1[elementName];
                if(message){
                var element = $('<span>' + message + '</span>')
                    .attr({
                      'class' : 'error-message'
                    });
                    $(this).after(element);
                    $(element).fadeIn();
                  }
                }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    window.location = location.href;
                  },3000);
                  
              }
      }
    });
  });

function makepaymentpopup(id)
{
  $.ajax({
    type : 'POST',
    url : window.base_url+'institute/getAgentById',
    data : {
      'agent_id' : id,
    },
    success : function(res){
      var res = JSON.parse(res);
      $("#opnPaymentpopup").modal('show');
      $("#subagentname").val(res[0].agent_name);
      $(".agent_id").val(res[0].agent_id);
    }
  });

  $("#add_payment_form").submit(function(e){
    e.preventDefault();
    var method = $(this).attr('method');
    var action = $(this).attr('action');
    var subagent = $("#subagentname").val();
    alert(subagent);
    $.ajax({
      type : method,
      url : action,
      data : $(this).serialize(),
      success : function(res){
          alert(res);
          var data = JSON.parse(res);
          if(data.status == false){
            $( ".error-message" ).remove();
              if(data.errormessage){
                vNotify.error({text:data.errormessage, title:'Error!'});
              }
              data1   = JSON.parse(data.message);
              $('form :input').each(function(){                          
                var elementName = $(this).attr('name');        
                var message = data1[elementName];
                if(message){
                var element = $('<span>' + message + '</span>')
                    .attr({
                      'class' : 'error-message'
                    });
                    $(this).after(element);
                    $(element).fadeIn();
                  }
                }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    window.location = location.href;
                  },3000);
              }
      }
  });
});
}

function makepaymentvendor(id)
{
  $.ajax({
    type : 'POST',
    url : window.base_url+'institute/getVendorById',
    data : {
      'vendor_id' : id,
    },
    success : function(res){
      var res = JSON.parse(res);
      $("#opnPaymentpopup").modal('show');
      $("#subagentname").val(res[0].vendor_name);
      $(".vendor_id").val(res[0].vendor_id);
    }
  });

  $("#add_vendor_payment").submit(function(e){
    e.preventDefault();
    var method = $(this).attr('method');
    var action = $(this).attr('action');
    $.ajax({
      type : method,
      url : action,
      data : $(this).serialize(),
      success : function(res){
          var data = JSON.parse(res);
          if(data.status == false){
            $( ".error-message" ).remove();
              if(data.errormessage){
                vNotify.error({text:data.errormessage, title:'Error!'});
              }
              data1   = JSON.parse(data.message);
              $('form :input').each(function(){                          
                var elementName = $(this).attr('name');        
                var message = data1[elementName];
                if(message){
                var element = $('<span>' + message + '</span>')
                    .attr({
                      'class' : 'error-message'
                    });
                    $(this).after(element);
                    $(element).fadeIn();
                  }
                }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    window.location = location.href;
                  },3000);
              }
      }
  });
});
}

$("#front_upload_btn").click(function(){
  $("#id_front_upload").click();
  $("#id_front_upload").on('change',function(){
    var file = this.files[0];
    var blob = URL.createObjectURL(file);
    $("#id_front").attr('src',blob);
    $("#front_id_form").submit();
  });
 
});

$("#back_upload_btn").click(function(){
  $("#id_back_upload").click();
  $("#id_back_upload").on('change',function(){
    var file = this.files[0];
    var blob = URL.createObjectURL(file);
    $("#id_back").attr('src',blob);
    $("#back_id_form").submit();
  });
 
});

$(".view_kyc_btn").on('click',function(){
  var path = $(this).attr('img_path');
  $("#kyc_view_modal").modal('show');
  $("#kyc_image").attr('src',path);
});

$("#applicationTable").on("click",'.convert_btn',function(){
  var enquiry_id = $(this).attr('enquiry_id');
  $("#convertModal").modal('show');
  $.ajax({
      type : "POST",
      url : window.base_url+'institute/fetchAdmissionData',
      data : {
        enquiry_id : enquiry_id,
      },
      success: function(res){
        document.getElementById("staffform").reset();
        var res = JSON.parse(res);
        if(res[0].student_photo != null)
        {
          $('#blah').attr('src',window.base_url+'uploads/'+res[0].student_photo);
        }
        else{
          $('#blah').attr('src',window.base_url+'assets/dashboard/img/person2.jpg');
        }
        $('#staffform #name').val(res[0].name);
        $('#staffform #father_name').val(res[0].father_name);
        $('#staffform #mother_name').val(res[0].mother_name);
        $('#staffform #occupation').val(res[0].father_Profession);
        $('#staffform #gender').val(res[0].sex);
        $('#staffform #qualification').val(res[0].last_exam_pass);
        $('#staffform #number').val(res[0].student_mobile_number);
        $('#staffform #email').val(res[0].student_email);
        $('#staffform #address').val(res[0].permanent_address);
        $('#staffform #enquiry_id').val(res[0].online_enquiry_id);

        $("#course").on('change',function(){
          var course_id = $('option:selected', this).attr('course_id');
          $("#course_id").val(course_id);
        });

        

      }
  });
});

//approve student
// $(".approve-btn").on("click",function(){
//   var student_id = $(this).attr('student_id');
//   var confirm = window.confirm("Are you sure, want to approve this student ?");
//   if(confirm == true){
//     $.ajax({
//       type : "POST",
//       url : window.base_url+'institute/approveStudent',
//       data : {
//        student_id : student_id,
//       },
//       success : function(res){
//           var data = JSON.parse(res);
//           if(data.status == false){
//             $( ".error-message" ).remove();
//               if(data.errormessage){
//                 vNotify.error({text:data.errormessage, title:'Error!'});
//               }
//               data1   = JSON.parse(data.message);
//               $('form :input').each(function(){                          
//                 var elementName = $(this).attr('name');        
//                 var message = data1[elementName];
//                 if(message){
//                 var element = $('<span>' + message + '</span>')
//                     .attr({
//                       'class' : 'error-message'
//                     });
//                     $(this).after(element);
//                     $(element).fadeIn();
//                   }
//                 }); 
//               }
//               if(data.status == true){
//                   vNotify.success({text:data.message});
//                   $( ".error-message" ).remove();
//                   setTimeout(function(){
//                     window.location = location.href;
//                   },3000);
//               }
//       }
//     });
//   }

  
// });

//delete leads
function delete_leads(id)
{
   $.ajax({
      type : "POST",
      url : window.base_url+'institute/delete_leads',
      data : {
       lead_id : id,
      },
      success : function(res){
          var data = JSON.parse(res);
          if(data.status == false){
            $( ".error-message" ).remove();
              if(data.errormessage){
                vNotify.error({text:data.errormessage, title:'Error!'});
              }
              data1   = JSON.parse(data.message);
              $('form :input').each(function(){                          
                var elementName = $(this).attr('name');        
                var message = data1[elementName];
                if(message){
                var element = $('<span>' + message + '</span>')
                    .attr({
                      'class' : 'error-message'
                    });
                    $(this).after(element);
                    $(element).fadeIn();
                  }
                }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
                  setTimeout(function(){
                    window.location = location.href;
                  },3000);
              }
      }
    });
}

//restrict staff to edit and delete
  // if(staff_session == "staff")
  // {
  //    var unable_sections = document.getElementsByClassName("staff_unable");
  //    $(unable_sections).addClass('d-none');
  // }

$("#offer_form #install_no").on('input',function(){
  var install_no = $(this).val();
  var html ='';
  for(i=1;i<=install_no;i++)
  {
    html += '<div style="margin-bottom:5px;padding:4px">';
    html += '<label>Installment - '+i+'</label><input type="number" name="installment_amount[]" required />';
    html += '</div>';
  }

  $(".installment_fields").html(html);
  
});

$("#offer_form .add-doc").click(function(){
  var html ='';
  html += '<div style="margin-bottom:5px;padding:4px">';
  html += '<input type="text" class="form-control" name="doc_name[]" placeholder="Document Name" required />';
  html += '</div>';
  $(".docs_fields").append(html);
});


$(".lead-filter .csv-btn").on('click',function(){
  var time_frame = $(".lead-filter .time-frame").val();
  var selected_date = $(".lead-filter .selected_date").val();
  if(time_frame == "" && selected_date == "")
  {
    alert("Select a time frame or date !");
    return false;
  }else if(time_frame != "" && selected_date != "")
  {
    alert("Select Time frame or Date at a time !");
    return false;
  }else{
    window.location = base_url+"institute/exportLeads?time_frame="+time_frame+"&selected_date="+selected_date;
  }

});
