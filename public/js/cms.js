//CKEDITOR.editorConfig = function( config ) {
//	config.language = 'es';
//	config.uiColor = '#F7B42C';
//	config.height = 300;
//	config.toolbarCanCollapse = true;
//};
    
//$(document).ready(function() {    
//    alert("dsa");
//});

//var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
//            lineNumbers: true,
//            mode:  "xml"
//        });
//
//        function submit_html()
//        {
//            editor.save();
//            var code = document.getElementById("editor").value;
//            var data_url = "data:text/html;charset=utf-8;base64," + $.base64.encode(code);
//            document.getElementById("result").src = data_url;
//        }

//    
//    $(".site-setting").click(function(e){
//        
//        $.ajax({
//                    url: $('#base_url').val()+"/admin/sitesetting/save_details",
//                    type:'POST',
//                    data: $('form').serialize(),
//                    success: function(data) {
//                        var data=JSON.parse(data);
//                        $("#msg").show();
//                        $("#msg").html(data.msg);
//                        
//                    }
//                });
//    });
//    
//    
//});
////$("#upload_logo").on('click',function (){
////    
////    $.ajax({
////                    url:$('.base_url').val()+ "/sitesetting/uploadlogo",
////                    type:'POST',
////                    data: $('#logo_upload_form').serialize(),
////                    success: function(data) {
////                        var data=JSON.parse(data);
////                        $("#msg").show();
////                        $("#msg").html(data.msg);
////                        
////                    }
////                });
////});
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
