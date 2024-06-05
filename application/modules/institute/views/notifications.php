
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
.smsActive ._sdf_{
   color: #8A162B !important;
   }
   .smsselectbox
   {
   background: #FFFFFF;
   border: 1px solid #ECECEC;
   box-sizing: border-box;
   border-radius: 2px;
   width: 100%;
   height: 30px;
   color: #888888;
   }
   .title-header{
      background:#8E294F;
      height:70px;
      padding:20px;

    }

    .action-con i{
        cursor: pointer;
    }

    .notice-list li{
        display: flex;
        border: 1px solid #ccc;
        padding: 7px;
        margin-bottom: 5px;
    }

    .notice-list li .notice-sl{
        min-width: 25px;
        height: 25px;
        padding: 3px;
        background: #8b152b;
        color: white;
        text-align: center;
        margin-right: 12px;
    }

    .notice-type{
        color: #8b152b;
    }

</style>
<div id="content" class="flex ">
    <div class="title-header">
        <div class="">
        <span>
            <h3 class="mb-0 pull-left" style="color:white"><i class="fa fa-check-square-o"></i> Notifications</h3>
        </span>
        </div>
    </div>

    <div class="page-container" id="page-container">

        <div class="padding">
            
            <div class="shadow-lg" style="background:white;padding:35px">
                <ul class="notice-list">
                    <?php 
                    if(!empty($notifications))
                    {
                        foreach($notifications as $key=>$notice)
                        {
                            ?>
                            <li>
                                <div class="notice-sl"><?=($key+1); ?></div>
                                <a href="<?=$notice->url; ?>">
                                   <span class="notice-type"><?=$notice->type; ?></span> : <?=$notice->msg; ?> 
                                </a>
                                    
                            </li>
                            <?php
                        }
                    } else{
                        echo '<li class="text-center">No Notification Found !</li>';
                    }
                    ?>
                    
                </ul>
            </div>

        </div>
    </div>
</div>
<!--------------------------------------------------------popup----------------------------------------- -->

<!--<============
      Delete Popup End
      ============>-->

<script>

$(".contacted_medium").on("change",function(){
    var medium = $(this).val();
    var lead_id = $(this).attr('lead_id');
    if(medium != "")
    {
        $.ajax({
            type : 'POST',
            url : '<?=base_url(); ?>institute/change_contacted_medium',
            data : {
                medium : medium,
                lead_id : lead_id
            },
            success : function(res){
                var data = JSON.parse(res);
                if(data.status == false){
                  vNotify.error({text:data.errormessage});
                  // $( ".error-message" ).remove();
                  // if(data.errormessage){
                  //   vNotify.error({text:data.errormessage, title:'Error!'});
                  // }
                  //  data1   = JSON.parse(data.message);
                  // $('form :input').each(function(){                          
                  //   var elementName = $(this).attr('name');        
                  //   var message = data1[elementName];
                  //   if(message){
                  //     var element = $('<span>' + message + '</span>')
                  //                   .attr({
                  //                       'class' : 'error-message'
                  //                   });
                  //     $(this).after(element);
                  //     $(element).fadeIn();
                  //   }
                  // }); 
              }
              if(data.status == true){
                  vNotify.success({text:data.message});
                  $( ".error-message" ).remove();
              }
            },
            error: function(data){                      
              $('#validation-error').html(data.message);
            }

        });
    }
});    
</script>

