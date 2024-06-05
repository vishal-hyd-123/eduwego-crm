<?php
  $data = $this->session->userdata($data);
?>
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
    padding:20px;
    background:white;
  }

.history_table tr td{
   font-size:17px;
   padding:9px;
}
.history_table tr th{
   font-size:17px;
   padding:9px;
}
/*.fee-box{
    border:1px solid #ccc;
}
.fee-box th,td{
    padding:7px;
    
}*/
.title-header{
      background:#8E294F;
      height:70px;
      padding:20px;

    }
  .receipt_pdf_btn:hover{
    cursor:pointer;
  }
</style>
<div id="content" class="flex ">
  <div class="title-header">
        <div class="">
        <span>
            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-money"></i> FEES DETAILS</h3>
        </span>
        </div>
  </div>
   <div class="page-container" id="page-container">
      <div class="padding">

         <div class="container">

           <div class="student_details_box shadow-lg">
             <div class="table-responsive payment_history_box my-3">
                <center><h4>Payment History</h4></center>
                <table class="history_table table-bordered w-100 mb-3" style="">
                    <tr>
                        <th>Sl. No.</th>
                        <th>Payment Id.</th>
                        <th>Year</th>
                        <th>Payment Amount</th>
                        <th>Payment Mode</th>
                        <th>Date</th>
                        <th>Download Receipt</th>
                    </tr>
                    <?php
                    if($histories == null)
                    {
                      ?>
                        <tr>
                          <td colspan="7" class="text-align:center">No Payment Records Found</td>
                        </tr>
                      <?php
                    }
                    else{
                        $sl = 1;
                        foreach($histories as $history)
                        {
                            
                    ?>
                    <tr>
                        <td><?php echo $sl++; ?></td>
                        <td><?php echo (1000+$history->payment_id); ?></td>
                        <td><?php echo $history->yr_id; ?></td>
                        <td><?php echo $history->paid_amount; ?></td>
                        <td><?php echo $history->payment_mode; ?></td>
                        <td>
                        <?php 
                            $raw_date = strtotime($history->date);
                            echo date('d-m-Y',$raw_date);
                        ?>
                        </td>
                        <td>
                            Download Receipt
                            <i class="fa fa-file-pdf-o receipt_pdf_btn" copy="student" payment_id="<?php echo $history->payment_id; ?>" yr_id="<?php echo $history->yr_id; ?>"></i><br/>
                        </td>
                    </tr>
                    <?php
                        }
                      }
                    ?>
                </table>
            </div>
           </div>

         </div>

      </div>
   </div>
</div>

<script>

</script>