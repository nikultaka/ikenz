admin.user = {
    initialize:function()
    {
        var this_class = this;

        $('.sub_user').on('click',function (){
            this_class.add_row();
        });
        
        $('body').on('click','.btnEdit_user',function (){
            var user_id = $(this).data('id'); 
            this_class.edit_row(user_id);
        });
        
        $('body').on('click','.btnDelete_user',function (){
            var user_id = $(this).data('id'); 
            this_class.delete_row(user_id);
        });

        $("#email_ch").hide();
        admin.user.load_user();
},

load_user:function(){
    
    var table= jQuery('.user-table').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "order": [[ 0, "desc" ]],
                    ajax: {
                    url : BASE_URL+'/admin/user/getdata',
                    type : 'POST',
                    data : admin.common.get_csrf_toke_object_data()
                    },  
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'category', name: 'category'},
                        { data: 'f_name', name: 'f_name'},
                        { data: 'l_name', name: 'l_name'},
                        { data: 'email', name: 'email'},
                        { data: 'password', name: 'password'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

add_row:function (){
                
                var f_name = $("input[name='f_name']").val();
                var l_name = $("input[name='l_name']").val();
                var email = $("input[name='email']").val();
                var password = $("input[name='password']").val();
                var demo = document.getElementById("status");
                var status = demo.options[demo.selectedIndex].value;
                
                var reemail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                var count_error = 0;
                if (f_name == '') {
                     $("input[name='f_name']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='f_name']").removeClass('has-error');
                }
                if (l_name.trim() == '') {
                    $("input[name='l_name']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='l_name']").removeClass('has-error');
                }
                if (email.trim() == '') {
                     $("input[name='email']").addClass('has-error');
                    count_error++;
                } 
                else {
                    if(reemail.test(email.trim())){
                    $.ajax({
                            type: 'POST',
                            url: BASE_URL+'/admin/user/email',
                            data: {_token:admin.common.get_csrf_token_value(),email:email},

                            success: function(data) {
                                
                                var data=$.parseJSON(data);
                                
                                if(data.valid == false){
                                    count_error++;
                                    $("#email_ch").show();
                                    $("input[name='email']").addClass('has-error');
                                }
                                else if(data.value == true){   
                                    $("#email_ch").hide(); 
                                    $("input[name='email']").removeClass('has-error');
                                }
                                else{
                                    $("#email_ch").hide();
                                    $("input[name='email']").removeClass('has-error');   
                                }
                    
                            }
                        });
                    }
                    else{
                        $("input[name='email']").addClass('has-error');
                        count_error++;
                    }
                    
                }
                if (password.trim() == '') {
                     $("input[name='password']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='password']").removeClass('has-error');
                }
                if (status == "") {
                     $("select[name='status']").addClass('has-error');
                    count_error++;
                } else{
                     $("select[name='status']").removeClass('has-error');
                }
//                alert(count_error);
                if(count_error == 0){
                    
                    $.ajax({
                    url: BASE_URL+'/admin/user/addrecord',
                    type:'POST',
                    data: $('#frm_user').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg').html(data.msg);
                            $('#msg').attr('style','color:green;');
                            $('#frm_faq')[0].reset()
                             admin.user.load_user();
                            $("#ins_faq").modal("hide");

                        }
                        else{
                            return false;
                        }
                    }
                });
                }
    
},


edit_row:function(user_id){
    
    
        if(user_id > 0){
            $.ajax({
                url: BASE_URL+'/admin/user/edit',
                type:'POST',
                data: {_token:admin.common.get_csrf_token_value(), user_id:user_id},
                success: function(data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){

                        $("#ins_user").modal("show");
                        $("#id_user").val(data.content.id);
                        $("#f_name").val(data.content.f_name);
                        $("#l_name").val(data.content.l_name);
                        $("#email").val(data.content.email);
                        $("#password").val(data.content.password);
    
                        var user_category = $("#user_category").val(data.content.user_category);
                        user_category.attr("selected","selected");

                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected","selected");
                         admin.user.load_user();
                    }
                }
            });
        }     
                else{
                    return false;
                }
    
},

delete_row:function (user_id){
    
    if(user_id > 0){
            $.ajax({
                    url: BASE_URL+'/admin/user/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), user_id:user_id},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                           admin.user.load_user();
                        }
                    }
            });
    }           
            else{
                return false;
            }
    
    
},
    
};