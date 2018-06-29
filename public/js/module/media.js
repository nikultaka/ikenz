admin.media_category = {
    initialize:function()
    {
        var this_class = this;

        $('.sub_media').on('click',function (){
            this_class.add_row();
        });
        
        $('body').on('click','.btnEdit_media',function (){
            var id_media = $(this).data('id'); 
            this_class.edit_row(id_media);
        });
        
        $('body').on('click','.btnDelete_media',function (){
            var id_media = $(this).data('id'); 
            this_class.delete_row(id_media);
        });

        admin.media_category.load_media_category();
          
          

},

load_media_category:function(){
    
    var table= jQuery('.media_category_table').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    order: [[ 0, "desc" ]],
                    ajax: {
                        url: BASE_URL+"/admin/media/get_category_data",
                        type: "POST",
                        data: admin.common.get_csrf_toke_object_data()
                    },
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'category_name', name: 'category_name'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
    }); 
    
},

 
add_row:function (){
                
                var category_name = $("input[name='category_name']").val();
                var demo = document.getElementById("status");
                var status = demo.options[demo.selectedIndex].value;
                
                var count_error = 0;
                if (category_name.trim() == '') {
                     $("input[name='category_name']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='category_name']").removeClass('has-error');
                }
                
                if (status == "") {
                     $("select[name='status']").addClass('has-error');
                    count_error++;
                } else{
                     $("select[name='status']").removeClass('has-error');
                }
                if(count_error == 0){
                
                    
                    $.ajax({
                    url: BASE_URL+'/admin/media/addrecord',
                    type:'POST',
                    data: $('#frm_media').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg').html(data.msg);
                            $('#msg').attr('style','color:green;');
                            $('#frm_media')[0].reset()
                            admin.media_category.load_media_category();
                            $("#ins_media").modal("hide");
                        }
                        else{
                            return false;
                        }
                    }
                });
                }
    
},


edit_row:function(id_media){
    
        
        if(id_media > 0){
            $.ajax({
                url: BASE_URL+'/admin/media/edit',
                type:'POST',
                data: {_token :admin.common.get_csrf_token_value(), id_media:id_media},
                success: function(data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){

                        $("#ins_media").modal("show");

                        $("#id_media").val(data.content.id);
                        $("#category_name").val(data.content.category_name);
                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected","selected");
//                        $('select[name^="status"] option[value=]').attr("selected","selected");
                        admin.media_category.load_media_category();
                    }
                }
            });
        }     
                else{
                    return false;
                }
    
},

delete_row:function (id_media){
    
    var _token = $("input[name='_token']").val();
    if(id_media > 0){
            $.ajax({
                    url: BASE_URL+'/admin/media/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), id_media:id_media},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            admin.media_category.load_media_category();
                        }
                    }
            });
    }           
            else{
                return false;
            }
    
    
},
    
};
admin.media_upload={
    
    ini:function (){
        
        var this_class = this;
//        Dropzone.autoDiscover = false;
//        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
//            addRemoveLinks: true,
//            url: BASE_URL + "/admin/upload-media/upload",
//            params: {
//                _token: admin.common.get_csrf_token_value(),
//                
//            },
//            
//        });
//        Dropzone.options.myAwesomeDropzone = {
//            paramName: "file", // The name that will be used to transfer the file
//            maxFilesize: 250, // MB
//            addRemoveLinks: true,
//            accept: function(file, done) {
// 
//            },
//        };
        $('body').on('click','.btnDeleteMediaUploded',function (){
            
            var mediaid = $(this).data("id");
            var mediatype = $(this).data("mediatype");
             this_class.delete_uploaded_media(mediaid,mediatype);
            
        });
        $('body').on('click','#upload_video',function (){
            this_class.upload_video();
        });
         admin.media_upload.load_datatabel();
    },
    load_datatabel:function (){
        var table= jQuery('.media-datatable').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    order: [[ 0, "desc" ]],
                    ajax: {
                        url: BASE_URL+"/admin/upload-media/getdatatabel",
                        type: "POST",
                        data: admin.common.get_csrf_toke_object_data()
                    },
                    columns: [
                       { data: 'id', name: 'id'},
                       { data: 'media_image', name: 'media_image'},
                       { data: 'category_name', name: 'category_name'},
                        { data: 'media_name', name: 'media_name'},
                        { data: 'media_type', name: 'media_type'},
                        {data: 'action', name: 'action',targets: 'no-sort', orderable: false},
                            ],
    });
    },
    delete_uploaded_media:function (mediaid,mediatype){
        if(mediaid > 0){
            $.ajax({
                    url: BASE_URL+'/admin/upload-media/delete_media',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), media_id:mediaid,mediatype:mediatype},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            admin.media_upload.load_datatabel();
                        }
                    }
            });
    }           
            else{
                return false;
            }
    
    
    },
    upload_video:function (){
        var formData = new FormData($('#VideoUploadForm')[0]);
        formData.append('media_type',$('#mediaTypehidden').val());
        formData.append('media_category',$('select#MediaCategory option:selected').val());
        $.ajax({
               type : 'post',
               url : BASE_URL+'/admin/upload-media/videoupload',
               data: formData,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
               success: function(data) {
                    $('#VideoUploadForm')[0].reset();
                    
                   admin.media_upload.load_datatabel();
               }
        });
    }
};