<style type="text/css">
    .enquiryActive ._sdf_ {
        color: #8A0A28 !important;
    }
    .main-con{
    	width:100%;

    	background:white;
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
          <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-envelope"></i> TEMPLATES</h3>
        </span>
      </div>
    </div>

    <div class="page-container" id="page-container">

        <div class="main-con shadow-lg my-4" style="padding: 16px;">
        	<div class="d-flex justify-content-between">
        		<h5>1. Fee Due</h5>
        		<a target="_blank" href="https://wa.me/<?='+91'.$student->mobile; ?>?text=Dear <?=$student->full_name; ?>,Your course fee is pending in <?=$_SESSION['name']; ?>. Kindly pay your fee as soon as possible to avoid late fine, Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
        	</div>
        	<p><b>Message :</b> Dear <?=$student->full_name; ?>,Your course fee is pending in <?=$_SESSION['name']; ?>. Kindly pay your fee as soon as possible to avoid late fine, <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>
        </div>

        <div class="main-con shadow-lg my-4" style="padding: 16px;">
        	<div class="d-flex justify-content-between">
        		<h5>2. Application Fee Pending</h5>
        		<a target="_blank" href="https://wa.me/<?='+91'.$student->mobile; ?>?text=Dear <?=$student->full_name; ?>, Thanks for taking online admission in our college. Kindly pay application fee .Payment Link : <?=$_SESSION['payment_link']; ?>. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
        	</div>
        	<p><b>Message :</b> Dear <?=$student->full_name; ?> Thanks for taking online admission in our college. Kindly pay application fee .Payment Link : <?=$_SESSION['payment_link']; ?>. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>
        </div>

        <div class="main-con shadow-lg my-4" style="padding: 16px;">
        	<div class="d-flex justify-content-between">
        		<h5>3. Refer and Earn</h5>
        		<a target="_blank" href="https://wa.me/<?='+91'.$student->mobile; ?>?text=Dear <?=$student->full_name; ?>, you can refer and earn scholarship upto 1 lakh by refering students in our college. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
        	</div>
        	<p><b>Message :</b> Dear <?=$student->full_name; ?> you can refer and earn scholarship upto 1 lakh by refering students in our college. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>
        </div>

        <div class="main-con shadow-lg my-4" style="padding: 16px;">
        	<div class="d-flex justify-content-between">
        		<h5>4. Original Documents Collection</h5>
        		<a target="_blank" href="https://wa.me/<?='+91'.$student->mobile; ?>?text=Dear <?=$student->full_name; ?>, Kindly submit your original documents for verification in our college. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
        	</div>
        	<p><b>Message :</b> Dear <?=$student->full_name; ?>, Kindly submit your original documents for verification in our college. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>
        </div>

        <div class="main-con shadow-lg my-4" style="padding: 16px;">
        	<div class="d-flex justify-content-between">
        		<h5>5. Thanks for showing interest</h5>
        		<a target="_blank" href="https://wa.me/<?='+91'.$student->mobile; ?>?text=Dear <?=$student->full_name; ?>, thanks for showing interest in our college. Kindly meet us to become the associate in our college. Thanks and Regards <?=$_SESSION['name']; ?> Ph.: <?=$_SESSION['landline']; ?>"><i class="fa fa-send text-success" style="font-size: 20px;"></i></a>
        	</div>
        	<p><b>Message :</b> Dear <?=$student->full_name; ?>, thanks for showing interest in our college. Kindly meet us to become the associate in our college. <br/>Thanks & Regards<br/><?=$_SESSION['name']; ?></p>
        </div>

    </div>
</div>


