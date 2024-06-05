<!-- <div class="sdfjsd">
  <div class="text-sm p-3 b-t">
    <div class="hidden-folded text-sm row">
      <div class="mt-1 col-12 col-md-6 col-sm-12 col-lg-12">
        <a href="javascript:void(0);" class="text-muted">©2021 ZEQOON TECHNOLOGY PRIVATE LIMITED</a>
      </div>

    </div>
  </div>
</div> -->
<!-- </div> -->

<script src="<?php echo base_url(); ?>assets/dashboard/libs/popper.js/dist/umd/popper.min.js"></script> 
  <script src="<?php echo base_url(); ?>assets/dashboard/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower-components/datepicker/dist/datepicker.min.js"></script>
 
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
  <script type="text/javascript">
  </script>
  <script src="<?php echo base_url(); ?>assets/dashboard/js/lazyload.js"></script>
  <script src="<?php echo base_url(); ?>assets/dashboard/js/plugin.js"></script>
  <!-- theme -->
  <script src="<?php echo base_url(); ?>assets/dashboard/js/theme.js"></script>
  <!-- endbuild -->
  <script src="<?php echo base_url(); ?>assets/vanilla-notify/vanilla-notify.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dashboard/js/main.js?cache=<?php echo time(); ?>"></script>
  
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script src="<?=base_url(); ?>assets/dashboard/libs/chartjs/chartjs.init.js"></script>
<script src="<?=base_url(); ?>assets/dashboard/libs/chart.js/dist/Chart.min.js"></script>

<?php 
  if($_SESSION['is_institute_in'] == TRUE)
  { 
?>
<script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "0af99d058ac02d0e78540a1c35ec9742f91209923ab97fa3b95a8131e41acb2a24f24ef33b0c906a8c0c68e2f3905217", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.in/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>
<?php  
  }
?>
  <!-- datatable cdn link -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  -->
 <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.7/highcharts.js"></script>




<script>
 $(document).ready(function(){
    var width = $(window).width();
    if (width >= 320 && width <= 425 )
    {
      $(".navbar-brand").addClass('d-none');
    } else{
      $(".navbar-brand").removeClass('d-none');
    }
    
  });
</script>

<script>  
 $(document).ready(function(){  
      $('#export_excel').on('submit', function(event){  
           event.preventDefault();  
           $.ajax({  
                url:"<?php echo base_url(); ?>institute/export_to_db",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                success:function(data){  
                     $('#result').html(data);  
                     $('#excel_file').val('');  
                }  
           });  
      });  
 });  
</script>  

</body>
</html>