<style type="text/css">
    .enquiryActive ._sdf_ {

        color: #8A0A28 !important;
    }
    .title-header{
      background:#8E294F;
      height:70px;
      padding:20px;

    }
</style>
<div id="content" class="flex ">
    <div class="page-container" id="page-container">
        <div class="title-header">
            <div class="">
                <span>
                    <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-image "></i> Banner Management</h3>
                </span>
            </div>
        </div>
        <div class="" style="padding: 16px;">
            
            <div class="page-title p-b-40 m-b-20 pt20">
                <a href="javascript: history.go(-1)" class="btn mb-0 nwFntSt btn-primary _fwg500_ _fs16_ pull-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                
            </div>

            <div class="add-banner-section">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible d-none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <i class="fa fa-times-circle" style='font-size:20px'></i> 
                            <span class='error-msg'></span>
                        </div>

                        <div class="alert alert-success alert-dismissible d-none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <i class="fa fa-check-circle" style='font-size:20px'></i> <span class='success-msg'></span>
                        </div>
                    </div>
                </div>
                <form id="banner-form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Add Banner</h3>
                        <hr/>
                        
                        <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Banner Type</label>
                        
                        <select name="banner_type" class="form-control makeReqin" required autocomplete="new">
                            <option value="">Select Banner Type</option>
                            <option value="Enquiry">Enquiry Page Banner</option>
                        </select>

                        <label for="" class="col-form-label _fs14_ _fwg500_ _greyClr_ text-left">Banner Image*</label>
                        <input id="banner" type="file" name="banner_img" class="form-control makeReqin" required autocomplete="new">
                        
                        <div class="img-preview">
                            <img  width="100%" height="100%"/>
                        </div>

                        <div class="mt-2">
                            <input type="hidden" name="institute_id" value="<?=$institute_id; ?>" />
                            <button type="submit" class="svebtn " style="float:left">Save</button>
                            <i class="fa fa-spinner fa-spin d-none" style="font-size:24px"></i>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h3>Banner List</h3>
                        <hr/>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-theme table-row v-middle responsive dataTable no-footer" role="grid" aria-describedby="clientTable_info">
                                
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Banner Image</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php  
                                    if(!empty($banners))
                                    {
                                        foreach($banners as $key=>$banner)
                                        {
                                        ?>
                                        <tr>
                                            <td><?=($key+1); ?></td>
                                            <td>
                                                <img src="<?=base_url();?>uploads/<?=$banner->banner_img; ?>" width="100px" />
                                            </td>
                                            <td>
                                               <?=$banner->banner_type; ?> 
                                            </td>
                                            <td>
                                                <i class="fa fa-trash delete-banner" banner_id="<?=$banner->banner_id; ?>"></i>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
$("#banner").on("change",function(){
    var file = this.files[0];
    var blob = URL.createObjectURL(file);
    $(".img-preview img").attr('src',blob);
});

$(".delete-banner").click(function(){
    var banner_id = $(this).attr('banner_id');
    var institute_id = "<?=$institute_id; ?>";
    var conf = confirm("Are you sure ?");
    if(conf == 1)
    {
       $.ajax({
        type : 'POST',
        url : '<?=base_url(); ?>admin/delete_banner',
        data : {
            banner_id : banner_id,
            institute_id : institute_id
        },
        success : function(data){
            var data = JSON.parse(data);
              var status = data.status;

              if(status == true)
              {
                $(".alert-success").removeClass('d-none');
                $(".success-msg").html(data.message);
                setTimeout(function(){
                    $(".alert-success").addClass('d-none');
                    window.location = location.href;
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
    }
});
</script>

<script>
    $('#banner-form').submit(function(event){
       event.preventDefault();
      var form = $(this)[0]; 
      var formData = new FormData(form);

       $.ajax({
         type: 'POST',
         url: '<?=base_url(); ?>admin/save_banner',
         data: formData,
         processData: false,
         contentType: false,
         cache: false,
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
                $(".alert-success").addClass('d-none');
                window.location = location.href;
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