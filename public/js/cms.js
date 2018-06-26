admin.cms = {
    initialize:function()
    {
        var this_class = this;

        $('.sub-cms').on('click',function (){
            this_class.add_row();
        });
        
//        $('body').on('click','.btnEdit_faqcat',function (){
//            var faq_cat_id = $(this).data('id'); 
//            this_class.edit_row(faq_cat_id);
//        });
//        
//        $('body').on('click','.btnDelete_faqcat',function (){
//            var faq_cat_id = $(this).data('id'); 
//            this_class.delete_row(faq_cat_id);
//        });

//        admin.cms.load_cms();
            $("#title").blur(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#slug").val(Text);    
            });
          

},

load_cms:function(){
    
    var table= jQuery('.faq_category-table').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "order": [[ 0, "desc" ]],
                    ajax: {
                        url : BASE_URL+'/admin/faq_category/getdata',
                        type: "POST",
                        data: admin.common.get_csrf_toke_object_data()
                    },
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'category_name', name: 'category_name'},
                        { data: 'status', name: 'status'},
                        { data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

 
 
 
add_row:function (){
                var _token = $("input[name='_token']").val();
                var title = $("input[name='title']").val();
                var slug = $("input[name='slug']").val();
                var description = $("textarea[name='description']").val();
                var meta_keyword = $("input[name='meta_keyword']").val();
                var meta_title = $("input[name='meta_title']").val();
                var meta_description = $("textarea[name='meta_description']").val();
                
                var demo = document.getElementById("status");
                var status = demo.options[demo.selectedIndex].value;
                
                var count_error = 0;
                if (title.trim() == '') {
                     $("input[name='title']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='title']").removeClass('has-error');
                }
                if (slug.trim() == '') {
                     $("input[name='slug']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='slug']").removeClass('has-error');
                }
                if (description.trim() == '') {
                     $("textarea[name='description']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("textarea[name='description']").removeClass('has-error');
                }
                if (meta_keyword.trim() == '') {
                     $("input[name='meta_keyword']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='meta_keyword']").removeClass('has-error');
                }
                if (meta_title.trim() == '') {
                     $("input[name='meta_title']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='meta_title']").removeClass('has-error');
                }
                if (meta_description.trim() == '') {
                     $("textarea[name='meta_description']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("textarea[name='meta_description']").removeClass('has-error');
                }
                if (status == "") {
                     $("select[name='status']").addClass('has-error');
                    count_error++;
                } else{
                     $("select[name='status']").removeClass('has-error');
                }
                if(count_error == 0){
                    $.ajax({
                    type:'POST',
                    url: BASE_URL+'/admin/cms/add',
                    data: $('#frm_cms').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg').html(data.msg);
                            $('#msg').attr('style','color:green;');
                            $('#frm_cms')[0].reset()
                        }
                        else{
                            return false;
                        }
                    }
                });
                }
    
},

//
//edit_row:function(faq_cat_id){
//    
//        
//        if(faq_cat_id > 0){
//            $.ajax({
//                url: BASE_URL+'/admin/faq_category/edit',
//                type:'POST',
//                data: {_token :admin.common.get_csrf_token_value(), faq_cat_id:faq_cat_id},
//                success: function(data) {
//                    var data=$.parseJSON(data);
//                    if(data.status==1){
//
//                        $("#ins_faq_cat").modal("show");
//
//                        $("#id_faq_cat").val(data.content.id);
//                        $("#category_name").val(data.content.category_name);
//                        var status_id = $("#status").val(data.content.status);
//                        status_id.attr("selected","selected");
////                        $('select[name^="status"] option[value=]').attr("selected","selected");
//                        admin.faq_category.load_faq_category();
//                    }
//                }
//            });
//        }     
//                else{
//                    return false;
//                }
//    
//},
//
//delete_row:function (faq_cat_id){
//    
//    if(faq_cat_id > 0){
//            $.ajax({
//                    url: BASE_URL+'/admin/faq_category/delete',
//                    type:'POST',
//                    data: {_token:admin.common.get_csrf_token_value(), faq_cat_id:faq_cat_id},
//                    success: function(data) {
//                        var data=$.parseJSON(data);
//                        if(data.status==1){
//                            $('#msg_main').html(data.msg);
//                            $('#msg_main').attr('style','color:green;');
//                            admin.faq_category.load_faq_category();
//                        }
//                    }
//            });
//    }           
//            else{
//                return false;
//            }
//    
//    
//},
//    
};


////CKEDITOR.editorConfig = function( config ) {
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
