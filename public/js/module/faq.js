admin.faq = {
    initialize:function()
    {
        var this_class = this;

//        $('.sub_faq').on('click',function (){
//            this_class.add_row();
//        });
        
        $('body').on('click','.btnEdit_faq',function (){
            var id = $(this).data('id'); 
            this_class.edit_row(id);
        });
        
        $('body').on('click','.btnDelete_faq',function (){
            var id = $(this).data('id'); 
            this_class.delete_row(id);
        });

        admin.faq.load_faq();
        
        admin.faq.refresh_validator();
        
        
                
//            $('#frm_faq').on('shown.bs.modal', function() {
//            });
//                
        $(".open-modal").on('click',function (){

            $('#frm_faq')[0].reset();
            $('#frm_faq').bootstrapValidator('resetForm', true);
            
        });

//        $('#frm_faq').remove('data-bv-field');
//        $('#frm_faq').data('bootstrapValidator').resetForm();

  
//            $('#frm_faq').bootstrapValidator('resetForm', true);

    //            $('#ins_faq').on('hidden.bs.modal', function () {
    //                $("#frm_faq").validate().resetForm();
    //            });

            //        
//        $('#ins_faq').empty();
//            $('#frm_faq').reset();
//            $('#frm_faq').removeClass('has-success','has-error');
            
//            return false;
//            $("form#frm_faq").validator("destroy");
//            var validator = $( "#frm_faq" ).validate();
//            validator.resetForm();
//        var validator = $("#ins_faq").validate();
//        $('#ins_faq').on('shown.bs.modal', function (){
//           validator.resetForm();
//        });
            $('.modal').on('hidden.bs.modal', function(){
//                alert("fsd");
//                $('#frm_faq').bootstrapValidator('resetForm', true);
//                $('#frm_faq').bootstrapValidator('resetForm', true);
//                alert("asdfs");
//                $(this).find('form')[0].reset();
            });

//        $('.modal-overlay').on('click', function() {
//            alert("dfs");
//            $('.modal-overlay').hide();
//            $('.modal').hide();
//        });
////            $('.modal').on('hidden.bs.modal', function () {
//                $(this).find('input').val('');
//            });

},

load_faq:function(){
    
    var table= jQuery('.faq-table').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "order": [[ 0, "desc" ]],
                    ajax: {
                    url : BASE_URL+'/admin/faq/getdata',
                    type : 'POST',
                    data : admin.common.get_csrf_toke_object_data()
                    },  
                    columns: [
//                        { data: 'id', name: 'id'},
                        { data: 'category_name', name: 'category_name'},
                        { data: 'question', name: 'question'},
                        { data: 'answer', name: 'answer'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
        
        
        
    
},

refresh_validator:function()
{
    $('#frm_faq').data('bootstrapValidator', null);
    
    $("#frm_faq").bootstrapValidator({
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        category_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Field required'
                                }
                            }
                        },
                        question: {
                            validators: {
                                notEmpty: {
                                    message: 'Field required'
                                }
                            }
                        },
                        answer: {
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
                    url: BASE_URL+'/admin/faq/addrecord',
                    type:'POST',
                    data: $('#frm_faq').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $("#ins_faq").modal("hide");
//                            $('#msg').html(data.msg);
//                            $('#msg').attr('style','color:green;');
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            $('#frm_faq')[0].reset();
                            $('#frm_faq').bootstrapValidator('resetForm', true);
                            admin.faq.load_faq();
                        }
                        else{
                            return false;
                        }
                    }
                    });
                    
        });
},

add_row:function (){
            
            

},

edit_row:function(id){
    
    
        if(id > 0){
            $.ajax({
                url: BASE_URL+'/admin/faq/edit',
                type:'POST',
                data: {_token:admin.common.get_csrf_token_value(), id:id},
                success: function(data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){
                        
                        $("#id").val(data.content.id);
                        $("#question").val(data.content.question);
                        $("#answer").val(data.content.answer);
                        
    
                        var category_id = $("#category_id").val(data.content.category_id);
                        category_id.attr("selected","selected");

                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected","selected");
                        
                        admin.faq.refresh_validator();
                        $("#frm_faq").bootstrapValidator('disableSubmitButtons',false);
                        
                        $("#ins_faq").modal("show");
                        //admin.faq.load_faq();
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
                    url: BASE_URL+'/admin/faq/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), id:id},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            admin.faq.load_faq();
                        }
                    }
            });
    }           
            else{
                return false;
            }
    
    
},
    
};