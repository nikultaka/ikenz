admin.user = {
    initialize:function()
    {
        var this_class = this;
     
        $('body').on('click','.btnEdit_user',function (){
            var id = $(this).data('id'); 
            this_class.edit_row(id);
        });
        
        $('body').on('click','.btnDelete_user',function (){
            var user_id = $(this).data('id'); 
            this_class.delete_row(user_id);
        });

        admin.user.load_user();
        
        admin.user.refresh_validator();
        
        $('#ins_user').on('hidden.bs.modal', function () {
            $('#frm_user')[0].reset();
            $('#frm_user').bootstrapValidator('resetForm', true);
        });

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
                        { data: 'role_name', name: 'role_name'},
                        { data: 'name', name: 'name'},
                        { data: 'email', name: 'email'},
                        { data: 'password', name: 'password'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

refresh_validator:function (){
    $("#frm_user").bootstrapValidator({
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    excluded: ':disabled',
                    fields: {
                        role_name: {
                            validators: {
                                notEmpty: {
                                    message: 'Field required'
                                }
                            }
                        },
                        u_name: {
                            validators: {
                                notEmpty: {
                                    message: 'Field required'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Field required'
                                },
                                emailAddress: {
                                    message: 'The email address is not valid'
                                },
                                remote: {
                                    type: 'POST',
                                    url: BASE_URL+'/admin/user/email',
                                    data: function(validator) {
                                        return {
                                            '_token':admin.common.get_csrf_token_value(),
                                            email: validator.getFieldElements('email').val(),
                                            id:$("#id").val()
                                        };
                                    },
                                    message: 'The email is not available',
                                    delay: 2000
                                }
                            }
                        },
                        password: {
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
                    url: BASE_URL+'/admin/user/addrecord',
                    type:'POST',
                    data: $('#frm_user').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $("#ins_user").modal("hide");
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            $('#frm_user')[0].reset()
                             admin.user.load_user();

                        }
                        else{
                            return false;
                        }
                    }
                    });
                });
                
                
},


edit_row:function(id){
    
    
        if(id > 0){
            $.ajax({
                url: BASE_URL+'/admin/user/edit',
                type:'POST',
                data: {_token:admin.common.get_csrf_token_value(), id:id},
                success: function(data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){

                        $("#id").val(data.content.id);
                        $("#u_name").val(data.content.name);
                        $("#email").val(data.content.email);
                        $("#password").val(data.content.password);
    
                        var role_name = $("#role_name").val(data.content.role_id);
                        role_name.attr("selected","selected");

                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected","selected");
                        $("#ins_user").modal("show");
                        admin.user.load_user();
                    }
                }
            });
        }     
                else{
                    return false;
                }
    
},

delete_row:function (id){
    
    if(id > 0){
            $.ajax({
                    url: BASE_URL+'/admin/user/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), id:id},
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