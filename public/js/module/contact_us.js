admin.contact_us = {
    initialize:function()
    {
        var this_class = this;

        $('.sub_contact_us').on('click',function (){
            this_class.add_row();
        });
        
        $('body').on('click','.btnEdit_contact_us',function (){
            var c_us_id = $(this).data('id'); 
            this_class.edit_row(c_us_id);
        });
        
        $('body').on('click','.btnDelete_contact_us',function (){
            var c_us_id = $(this).data('id'); 
            this_class.delete_row(c_us_id);
        });

        admin.contact_us.load_contact_us();
        
        $('body').on('click','.em_reply',function (){
            var id = $(this).data('id'); 
            this_class.email_reply(id);
        });

    },

load_contact_us:function(){
    
    var table= jQuery('.contact_us-table').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "order": [[ 0, "desc" ]],
                    ajax: {
                    url : BASE_URL+'/admin/contact_us/getdata',
                    type : 'POST',
                    data : admin.common.get_csrf_toke_object_data()
                    },
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'name', name: 'name'},
                        { data: 'email', name: 'email'},
                        { data: 'phone_no', name: 'phone_no'},
                        { data: 'description', name: 'description'},
                        { data: 'reply', name: 'reply'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

 
add_row:function (){
                
                var _token = $("input[name='_token']").val();
                
                var name = $("input[name='name']").val();
                var email = $("input[name='email']").val();
                var phone_no = $("input[name='phone_no']").val();
                var description = $("textarea[name='description']").val();
                 
    
                var regex_number = /[0-9]|\./;
                var reemail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                
                var count_error = 0;
                if (name.trim() == '') {
                     $("input[name='name']").addClass('has-error');
                    count_error++;  
                } else{
                     $("input[name='name']").removeClass('has-error');
                }
                if (email.trim() == '') {
                    $("input[name='email']").addClass('has-error');
                    count_error++;
                }
                else{
                    if(reemail.test(email.trim())){  
                        $("input[name='email']").removeClass('has-error');
                    }
                    else{
                        $("input[name='email']").addClass('has-error');
                        count_error++;
                    }
                }
                if (phone_no.trim() == '') {
                    $("input[name='phone_no']").addClass('has-error');
                    count_error++;
                } 
                else{
                    if(regex_number.test(phone_no.trim())){  
                        $("input[name='phone_no']").removeClass('has-error');
                    }
                    else{
                        $("input[name='phone_no']").addClass('has-error');
                        count_error++;
                    }
                }
                if (description.trim() == '') {
                     $("textarea[name='description']").addClass('has-error');
                    count_error++;
                } else{
                     $("textarea[name='description']").removeClass('has-error');
                }
                if(count_error == 0){
                
                    
                    $.ajax({
                    url: BASE_URL+'/admin/contact_us/addrecord',
                    type:'POST',
                    data: $('#frm_contact_us').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg').html(data.msg);
                            $('#msg').attr('style','color:green;');
                            $('#frm_contact_us')[0].reset()
                            admin.contact_us.load_contact_us();
                            $("#ins_con").modal("hide");

                        }   
                        else{
                            return false;
                        }
                    }
                });
                }
    
},


edit_row:function(c_us_id){
    
    
        if(c_us_id > 0){
            $.ajax({
                url: BASE_URL+'/admin/contact_us/edit',
                type:'POST',
                data: {_token:admin.common.get_csrf_token_value(), c_us_id:c_us_id},
                success: function(data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){

                        $("#ins_con").modal("show");
                        $("#id_c_us").val(data.content.id);
                        $("#name").val(data.content.name);
                        $("#email").val(data.content.email);
                        $("#phone_no").val(data.content.phone_no);
                        $("#description").val(data.content.description);
                        admin.contact_us.load_contact_us();
                    }
                }
            });
        }     
                else{
                    return false;
                }
    
},

delete_row:function (c_us_id){
    
    if(c_us_id > 0){
            $.ajax({
                    url: BASE_URL+'/admin/contact_us/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), c_us_id:c_us_id},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            admin.contact_us.load_contact_us();
                        }
                    }
            });
    }           
            else{
                return false;
            }
    
    
},

email_reply:function (id){
        if(id > 0){
            $.ajax({
                url: BASE_URL+'/admin/contact_us/email',
                type:'POST',
                data: {_token:admin.common.get_csrf_token_value(), id:id},
                success: function(data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){

                        $("#reply_email").modal("show");
                        $("#em_name").val(data.content.email);
                        admin.contact_us.load_contact_us();
                    }
                }
            });
        }     
                else{
                    return false;
                }
    
},
    
};