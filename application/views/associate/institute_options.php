<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url(); ?>assets/dashboard/img/icon.png" type="image/jpeg" sizes="">
    <title><?php echo $site_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower-components/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/css/style.css" type="text/css">
</head>
<style>
    .inst-con{
        width: 300px;
        min-height: 350px;
        /*background: #8A152B;*/
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        padding: 20px;
        border: 1px solid #ccc;
        overflow-y: scroll;
    }

    .inst-con ul{
        list-style: none;
    }

    .inst-con ul li{
        margin: 12px;
    }
    .btn-div{
        width: 100%;
        padding: 12px;
        background: #8A152B;
        position: absolute;
        bottom: 0;
        left: 0;
    }
</style>
<body>
    <div class="container">
        <div class="inst-con">
            <center><h3>Select Institutes</h3></center>
            <hr/>
            <?php if($this->session->flashdata('error')){ ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <i class="fa fa-times-circle" style='font-size:20px'></i> 
                <span class='error-msg'><?=$this->session->flashdata('error'); ?></span>
            </div>
            <?php } ?>
            <form action="<?=base_url(); ?>associate/instituteSelected" method="post">
                <ul>
                <?php  
                if(!empty($institutes))
                {
                    foreach($institutes as $inst)
                    {
                        $inst_id = $inst->institute_id;
                        $institute = $this->db->query("SELECT institute_id,institute_name,institute_logo FROM institute WHERE institute_id = '".$inst_id."' ")->row();
                        ?>
                        
                        <li><input type="radio" name="institute" value="<?=$institute->institute_id; ?>" /> <?=$institute->institute_name; ?></li>

                        <?php
                    }
                }
                ?>
               </ul>
               <div class="btn-div">
                <center>
                    <a class="btn btn-danger" href="<?=base_url('institute/logout'); ?>">Logout</a>
                    <button type="submit" class="btn btn-primary">Go</button>
                </center>
               </div>
            </form>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
      $('#associateLogin').submit(function(event){
       event.preventDefault();
    
       $.ajax({
         type : 'POST',
         url : '<?=base_url('associate/associateLogin'); ?>',
         data: $(this).serialize(),
         beforeSend: function(){
          $('.fa-spin').removeClass('d-none');
         },
         success: function(data){
          $('.fa-spin').addClass('d-none');
          var data = JSON.parse(data);
          var status = data.status;

          if(status == true)
          {
            $(".alert-success").removeClass('d-none');
            $(".success-msg").html(data.message);
            setTimeout(function(){
                window.location.href = '<?=base_url(); ?>associate/dashboard';
            },4000);
          } else if(status == false){
            $(".alert-danger").removeClass('d-none');
            $(".error-msg").html(data.errormessage);
            setTimeout(function(){
                $(".alert-danger").addClass('d-none');
            },4000);
          }       
         }
     });

    });

</script>
    
</body>
</html>