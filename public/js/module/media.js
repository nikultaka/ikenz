admin.media_category = {
    initialize:function()
    {
        var this_class = this;

        $('body').on('click','.btnEdit_media',function (){
            var id_media = $(this).data('id'); 
            this_class.edit_row(id_media);
        });
        
        $('body').on('click','.btnDelete_media',function (){
            var id_media = $(this).data('id'); 
            this_class.delete_row(id_media);
        });

        admin.media_category.load_media_category();
        admin.media_category.refresh_validator();
          
        $('#ins_media').on('hidden.bs.modal', function () {
            $('#frm_media')[0].reset();
            $('#frm_media').bootstrapValidator('resetForm', true);
        })
          

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
//                        { data: 'id', name: 'id'},
                        { data: 'category_name', name: 'category_name'},
                        { data: 'status', name: 'status'},
                        { data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
    }); 
    
},

 
refresh_validator:function()
{
    $("#frm_media").bootstrapValidator({
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    excluded: ':disabled',
                    fields: {
                        category_name: {
                            validators: {
                                notEmpty: {
                                    message: 'Field required'
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'Field required'
                                }
                            }
                        },
                    },
                
                })
                
                .on('success.form.bv', function (e) {
                    $.ajax({
                    url: BASE_URL+'/admin/media/addrecord',
                    type:'POST',
                    data: $('#frm_media').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $("#ins_media").modal("hide");
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            $('#frm_media')[0].reset()
                            admin.media_category.load_media_category();
                        }
                        else{
                            return false;
                        }
                    }
                    });
                });
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


                        $("#id_media").val(data.content.id);
                        $("#category_name").val(data.content.category_name);
                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected","selected");
                        $("#ins_media").modal("show");
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
        $('body').on('click','.btnDeleteMediaUploded',function (){
            
            var mediaid = $(this).data("id");
            var mediatype = $(this).data("mediatype");
             this_class.delete_uploaded_media(mediaid,mediatype);
            
        });
        $('body').on('click','#submit_video_file',function (){
            this_class.upload_video();
        });
        $('#MediaType').on('change',function (){
           var valuechange = $('select#MediaType option:selected').val(); 
           this_class.ChangeMediaType(valuechange);
        });
        $(document).on("change", ".file_multi_video", function(evt) {
            
            var $source = $('#video_here');
            $source[0].src = URL.createObjectURL(this.files[0]);
            $source.parent()[0].load();
            $('#video_frame').show();
            $('#url_section').hide();
            $('.remove-btn-for-file').show();
            $('#media_url').val('');
            
        });
        $(document).on('click','#remove_video',function (){
            this_class.ClearVideoType();
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
    },
    ChangeMediaType:function (valuechange){
        $('#mediaTypehidden').val(valuechange);
           if(valuechange==1){
               $('#video-section').hide();
               $('#dropzoneFileUpload').show();
               $('.video-details').hide();
           }
           else if(valuechange==2){
               $('#video-section').show();
               $('#dropzoneFileUpload').hide();
               $('.video-details').show();
           }
           else{
               return false;
           }
    },
    VideoPreview:function (){
            
    },
    ClearVideoType:function (){
            var $source = $('#video_here');
            $source[0].src = '';
            $source.parent()[0].load();
            $('#video_frame').hide();
            $('#url_section').show();
            $('#video_file').val('');
            $('.remove-btn-for-file').hide();  
    }
};