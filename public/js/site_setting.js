$(document).ready(function() {
    
    $(".site-setting").click(function(e){
        
        $.ajax({
                    url: $('#base_url').val()+"/admin/sitesetting/save_details",
                    type:'POST',
                    data: $('form').serialize(),
                    success: function(data) {
                        var data=JSON.parse(data);
                        $("#msg").show();
                        $("#msg").html(data.msg);
                        
                    }
                });
    });
    
    
});
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#previewing').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#setting_logo_upload").change(function() {
  readURL(this);
});
$("#upload_logo").on('click',function (){
     var formData = new FormData($('#logo_upload_form')[0]);
    $.ajax({
                    url:BASE_URL+ "/admin/sitesetting/uploadlogo",
                    type:'POST',
                    data: formData,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function(data) {
                    var data=JSON.parse(data);
                        if(data.status==1){
                           // $('#previewing').attr('src', BASE_URL +'/thumbnail/'+data.data)
                            $('#logo_image_name').val(data.data);
                        }    
                        
                    }
                });
});
//$('#exampleInputFile').ajaxfileupload({
//  action: $('.base_url').val() + '/admin/sitesetting/uploadlogo',
//  valid_extensions : ['jpg','png',"jpeg",'gif'],
//  params: {
//    extra: 'info'
//  },
//  onComplete: function(response) {
//      //var result = JSON.parse(response);
//      if(response.status == 1){
//          $("#hdn_media_name").val(response.file_name);
//          $('#image_frame').show();
//          $('#image_frame').attr('src','<?php echo base_url(); ?>assets/uploads/post/'+response.file_name);
//          $('#image_frame_view').attr('src','<?php echo base_url(); ?>assets/uploads/post/'+response.file_name);
//      } else if(result.status == 1){
//          $("#upload_image_msg").html(response.error);
//          $("#upload_image_msg").css("color","red");
//      }
//  },
//});
