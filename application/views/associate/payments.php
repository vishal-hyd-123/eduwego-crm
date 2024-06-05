
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
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-money"></i> Payment Details</h3>
        </span>
      </div>
    </div>

    <div class="page-container" id="page-container">

        <div class="padding">

        <div class="row my-4">
        
        <table class="table table-responsive">
            <tr>
                <th>Sl.</th>
                <th>Amount(Rs.)</th>
                <th>Payment Date</th>
                <th>Payment Mode</th>
                <th>Purpose</th>
            </tr>
            <?php
            if(!empty($payments))
            {
                $total_paid = 0;
              foreach($payments as $payment)
              {
                $total_paid += $payment->amount;
                ?>
                    <tr>
                        <td><?=$sl++; ?></td>
                        <td><?php echo $payment->amount; ?></td>
                        <td><?php echo $payment->payment_date; ?></td>
                        <td><?php echo $payment->payment_mode; ?></td>
                        <td><?php echo $payment->purpose; ?></td>
                    </tr>
                <?php
               }
               ?>
               <tr>
                   <th>Total Paid Amount</th>
                   <th><?=$total_paid; ?></th>
               </tr>
               <?php  
            }
            
            ?>
            
        </table>
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
