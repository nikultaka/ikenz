admin.user_role = {
    initialize:function()
    {
        var this_class = this;

        $('.sub_user_cat').on('click',function (){
            this_class.add_row();
        });
        
        $('body').on('click','.btnEdit_user_cat',function (){
            var user_cat_id = $(this).data('id'); 
            this_class.edit_row(user_cat_id);
        });
        
        $('body').on('click','.btnDelete_user_cat',function (){
            var user_cat_id = $(this).data('id'); 
            this_class.delete_row(user_cat_id);
        });

        admin.user_role.load_user_role();

},

load_user_role:function(){
    
    var table= jQuery('.user_role-table').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "order": [[ 0, "desc" ]],
                    ajax: {
                    url : BASE_URL+'/admin/user_role/getdata',
                    type : 'POST',
                    data : admin.common.get_csrf_toke_object_data()
                    },  
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'category', name: 'category'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

 
add_row:function (){
                
//                var _token = $("input[name='_token']").val();
                var user_category = $("input[name='user_category']").val();
                var demo = document.getElementById("status");
                var status = demo.options[demo.selectedIndex].value;
                
                var count_error = 0;
                if (user_category.trim() == '') {
                     $("input[name='user_category']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='user_category']").removeClass('has-error');
                }
                
                if (status == "") {
                     $("select[name='status']").addClass('has-error');
                    count_error++;
                } else{
                     $("select[name='status']").removeClass('has-error');
                }
                if(count_error == 0){
                
                    
                    $.ajax({
                    url: BASE_URL+'/admin/user_role/addrecord',
                    type:'POST',
                    data: $('#frm_user_cat').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg').html(data.msg);
                            $('#msg').attr('style','color:green;');
                            $('#frm_faq_cat')[0].reset()
                            admin.user_role.load_user_role();
                            $("#ins_user_cat").modal("hide");
                        }
                        else{
                            return false;
                        }
                    }
                });
                }
    
},


edit_row:function(user_cat_id){
    
    
        if(user_cat_id > 0){
            $.ajax({
                url: BASE_URL+'/admin/user_role/edit',
                type:'POST',
                data: {_token:admin.common.get_csrf_token_value(), user_cat_id:user_cat_id},
                success: function(data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){

                        $("#ins_user_cat").modal("show");
                        $("#id_user_cat").val(data.content.id);
                        $("#user_category").val(data.content.category);
    
                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected","selected");
                        admin.user_role.load_user_role();
                    }
                }
            });
        }     
                else{
                    return false;
                }
    
},

delete_row:function (user_cat_id){
    
    if(user_cat_id > 0){
            $.ajax({
                    url: BASE_URL+'/admin/user_role/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), user_cat_id:user_cat_id},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            admin.user_role.load_user_role();
                        }
                    }
            });
    }           
            else{
                return false;
            }
    
    
},
    
};