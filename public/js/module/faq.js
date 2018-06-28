admin.faq = {
    initialize:function()
    {
        var this_class = this;

        $('.sub_faq').on('click',function (){
            this_class.add_row();
        });
        
        $('body').on('click','.btnEdit_faq',function (){
            var faq_id = $(this).data('id'); 
            this_class.edit_row(faq_id);
        });
        
        $('body').on('click','.btnDelete_faq',function (){
            var faq_id = $(this).data('id'); 
            this_class.delete_row(faq_id);
        });

        admin.faq.load_faq();

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
                        { data: 'id', name: 'id'},
                        { data: 'category_name', name: 'category_name'},
                        { data: 'question', name: 'question'},
                        { data: 'answer', name: 'answer'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

 
add_row:function (){
                
                var _token = $("input[name='_token']").val();
                
                var c_id = document.getElementById("category_id");
                var category_id = c_id.options[c_id.selectedIndex].value;
                
                var question = $("input[name='question']").val();
                var answer = $("textarea[name='answer']").val();
                var demo = document.getElementById("status");
                var status = demo.options[demo.selectedIndex].value;
                
                var count_error = 0;
                if (category_id == '') {
                     $("select[name='category_id']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("select[name='category_id']").removeClass('has-error');
                }
                if (question.trim() == '') {
                    $("input[name='question']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='question']").removeClass('has-error');
                }
                if (answer.trim() == '') {
                     $("textarea[name='answer']").addClass('has-error');
                    count_error++;
                } else{
                    $("textarea[name='answer']").removeClass('has-error');
                }
                if (status == "") {
                     $("select[name='status']").addClass('has-error');
                    count_error++;
                } else{
                     $("select[name='status']").removeClass('has-error');
                }
                if(count_error == 0){
                
                    
                    $.ajax({
                    url: BASE_URL+'/admin/faq/addrecord',
                    type:'POST',
                    data: $('#frm_faq').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg').html(data.msg);
                            $('#msg').attr('style','color:green;');
                            $('#frm_faq')[0].reset()
                            admin.faq.load_faq();
                            $("#ins_faq").modal("hide");

                        }
                        else{
                            return false;
                        }
                    }
                });
                }
    
},


edit_row:function(faq_id){
    
    
        if(faq_id > 0){
            $.ajax({
                url: BASE_URL+'/admin/faq/edit',
                type:'POST',
                data: {_token:admin.common.get_csrf_token_value(), faq_id:faq_id},
                success: function(data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){

                        $("#ins_faq").modal("show");
                        $("#id_faq").val(data.content.id);
                        $("#question").val(data.content.question);
                        $("#answer").val(data.content.answer);
    
                        var category_id = $("#category_id").val(data.content.category_id);
                        category_id.attr("selected","selected");

                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected","selected");
                        admin.faq.load_faq();
                    }
                }
            });
        }     
                else{
                    return false;
                }
    
},

delete_row:function (faq_id){
    
    if(faq_id > 0){
            $.ajax({
                    url: BASE_URL+'/admin/faq/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), faq_id:faq_id},
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