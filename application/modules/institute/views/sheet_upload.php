<style>  

.box  
{  
     width:90%;  
     padding:20px;  
     background-color:#fff;  
     border:1px solid #ccc;  
     border-radius:5px;  
     margin-top:100px;  
}  
.title-header{
     background:#8E294F;
      height:70px;
      padding:20px;
      
}
.table-responsive{
     background:white;
     padding:15px;
     border-radius:10px;
}

</style>  
      
<div id="content" class="flex ">
    <div class="title-header">
      <div class="">
        <span>
          <h4 class="mb-0 pull-left" style="color:white"><i class="fa fa-upload"></i> Upload Students</h4>
        </span>
      </div>
    </div>
     <div class="container-fluid box">  
          <h3 align="center">Upload Excel Sheet</h3>  
          <br /><br />  
          <br /><br />  
          <form mehtod="post" id="export_excel">  
               <label>Select Excel File</label>  
               <input type="file" name="excel_file" id="excel_file" />
               <button type="submit">Upload Now</button>  
          </form>  
          <br />  
          <br />  
          <div id="result">  
          </div>  
     </div>  
</div> 
 <!-- <script>  
 $(document).ready(function(){  
      $('#excel_file').change(function(){  
           $('#export_excel').submit();  
      });  
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
 </script>   -->