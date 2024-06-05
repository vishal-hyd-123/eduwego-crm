
<style type="text/css">
   /*.agentActive, .agentActive:hover{
   background: rgba(91, 193, 70, 0.1);
   border-color: #5BC146;
   color: #8A162B;
   }*/
   .addinstituteActive ._sdf_{
    color: #8A0A28 !important;
   }
#page-container{
    padding: 20px;
}
.title-header{
      background:#8E294F;
      height:70px;
      padding:20px;

    }
</style>
<div id="content" class="flex ">
  
   <div class="page-container" id="page-container">
      <div class="row my-4">
        <h4>Total Package : <?php echo $fees[0]->package; ?></h4>
        <table class="w-100 table table-bordered table-responsive" >
            <tr>
                <th>Year</th>
                <th>Fees (Rs)</th>
                <th>Paid (Rs)</th>
                <th>Commission (Rs)</th>
            </tr>
            <?php
            foreach($fees as $fee)
            {
            ?>
                <tr>
                    <td><?php echo "Year- ".$fee->yr_id ?></td>
                    <td><?php echo $fee->yearly_fee; ?></td>
                    <td><?php echo $fee->paid_amount; ?></td>
                    <td><?php echo $fee->agent_discount; ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <th></th>
            </tr>
        </table>
      </div>

   </div>
</div>

<script>

   <div class="page-container" id="page-container">
</script>