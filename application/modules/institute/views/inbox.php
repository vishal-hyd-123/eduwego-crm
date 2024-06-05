<style type="text/css">
    .enquiryActive ._sdf_ {

        color: #8A0A28 !important;
    }
    .main-con{
    	width:100%;
    	height:500px;
    	background:white;
    	overflow-y: scroll;
    }
    .msg-con{
    	width:90%;
    	min-height:70px;
    	border:1px solid #ccc;
    	border-radius:10px;
    	margin:10px auto;
    	
    }
    .title-header{
      background:#8E294F;
      height:70px;
      padding:20px;
    }
    .msg-con-header{
    	width:100%;
    	min-height:30px;
    	background:#ddd;
    	border-top-left-radius: 10px;
    	border-top-right-radius: 10px;
    }
    .msg-con-header p{
    	color:black;
    	margin-top:5px;
    }
</style>
<div id="content" class="flex ">
	<div class="title-header">
      <div class="">
        <span>
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-envelope"></i> INBOX</h3>
        </span>
      </div>
    </div>

    <div class="page-container" id="page-container">

        <div class="main-con shadow-lg my-4" style="padding: 16px;">
        	<center><h3>Messages</h3></center>
        	<?php
        	foreach($messages as $message)
        	{
        	?>
	           <div class="msg-con">
	            	<div class="msg-con-header d-flex justify-content-around">
	            		<p>Name : <?php echo $message->student_name; ?></p>
	            		<p><i class="fa fa-envelope"></i> <?php echo $message->student_email; ?></p>
	            		<p><i class="fa fa-phone"></i> <?php echo $message->student_mobile; ?></p>
	            		<p>
	            			<i class="fa fa-calendar"></i> 
	            			<?php
	            				$date = strtotime($message->date);
	            				echo date('d-m-Y',$date); 
	            			?>	
	            		</p>
	            	</div>
	            	<div class="msg-body p-2">
	            		<p><?php echo $message->message; ?></p>
	            	</div>
	           </div>
	        <?php
	    	}
	        ?>
        </div>
    </div>
</div>


