
<style type="text/css">
    /*.studentActive, .studentActive:hover{
    background: rgba(91, 193, 70, 0.1);
    border-color: #5BC146;
    color: #8A162B;
  }*/
    .studentActive ._sdf_ {
        color: #8A0A28 !important;
    }

    .imgcontent {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 180px;
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
   padding:7px;
}
.contact_table tr td{
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
.title-header{
  background:#8E294F;
  height:70px;
  padding:20px;

}
.front_side_con,.back_side_con{
    width: 80%;
    height:200px;
    border: 1px solid #ccc;
}


</style>

<div id="content" class="flex ">
    <div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-money"></i> Pending Students</h3>
        </span>
      </div>
    </div>

    <div class="page-container" id="page-container">

    <div class="padding">

      <div class="row p-4">
        <div class="col-12 my-4">
          <div class="table-responsive shadow-sm">
                <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
                    <a href="https://datatables.net/extensions/responsive/" target="_blank"></a>
                    <thead>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">ID</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Student Name</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Mobile</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Stream</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Course</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">YOA</span></th>
                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">Fee Committed</span></th>

                        <th><span class="text-muted _blckClr_ _fs14_ _fwg500_ nwFntSt">#Actions</span></th>

                    </thead>
                    <tbody id="tableBody">
                            <?php
                            
                            $i= 1; 
                            foreach($students as $student)
                            {
                            ?>
                             <tr>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $i++; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_ text-capitalize"><?php echo $student->full_name; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->mobile; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->stream; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->course; ?></div>
                                </td>
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->yoa; ?></div>
                                </td>
                                
                                <td>
                                    <div class="item-except _greyClr_ _fs14_"><?php echo $student->package; ?></div>
                                </td>
                                <td class="actionbtns">
                                    <div class="btn-group" role="group">
                                        <a type="button" href="<?php echo base_url(); ?>associate/deleteRequest/<?=base64_encode($student->student_id); ?>" class="btn _fs14_ bg-danger "><i class="fa fa-trash"></i></a>

                                    </div>
                                </td> 
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>

    </div>
    </div>
</div>
<!--------------------------------------------------------popup----------------------------------------- -->

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
