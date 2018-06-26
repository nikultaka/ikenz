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