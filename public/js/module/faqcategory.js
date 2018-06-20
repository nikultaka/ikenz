admin.faq_category = {
    initialize:function()
    {
        var this_class = this;

        $('.sub_faq_cat').on('click',function (){
            this_class.add_row();
        });
        
        $('body').on('click','.btnEdit_faqcat',function (){
            var faq_cat_id = $(this).data('id'); 
            this_class.edit_row(faq_cat_id);
        });
        
        $('body').on('click','.btnDelete_faqcat',function (){
            var faq_cat_id = $(this).data('id'); 
            this_class.delete_row(faq_cat_id);
        });

        admin.faq_category.load_faq_category();
          
          

},

load_faq_category:function(){
    
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
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

 
add_row:function (){
                
                var _token = $("input[name='_token']").val();
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
                    url: BASE_URL+'/admin/faq_category/addrecord',
                    type:'POST',
                    data: $('#frm_faq_cat').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg').html(data.msg);
                            $('#msg').attr('style','color:green;');
                            $('#frm_faq_cat')[0].reset()
                            admin.faq_category.load_faq_category();
                            $("#ins_faq_cat").modal("hide");
                        }
                        else{
                            return false;
                        }
                    }
                });
                }
    
},


edit_row:function(faq_cat_id){
    
        
        if(faq_cat_id > 0){
            $.ajax({
                url: BASE_URL+'/admin/faq_category/edit',
                type:'POST',
                data: {_token :admin.common.get_csrf_token_value(), faq_cat_id:faq_cat_id},
                success: function(data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){

                        $("#ins_faq_cat").modal("show");

                        $("#id_faq_cat").val(data.content.id);
                        $("#category_name").val(data.content.category_name);
                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected","selected");
                        $('select[name^="status"] option[value=]').attr("selected","selected");
                        admin.faq_category.load_faq_category();
                    }
                }
            });
        }     
                else{
                    return false;
                }
    
},

delete_row:function (faq_cat_id){
    
    if(faq_cat_id > 0){
            $.ajax({
                    url: BASE_URL+'/admin/faq_category/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), faq_cat_id:faq_cat_id},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            admin.faq_category.load_faq_category();
                        }
                    }
            });
    }           
            else{
                return false;
            }
    
    
},
    
};