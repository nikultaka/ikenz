admin.cms = {
    initialize:function()
    {
        var this_class = this;

        $('.sub-cms').on('click',function (){
            this_class.add_row();
        });
        
        $('body').on('click','.btnDelete_cms',function (){
            var id = $(this).data('id'); 
            this_class.delete_row(id);
        });

        admin.cms.load_cms();
    
        $("#title").blur(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        this_class.check_slug();
        $("#slug").val(Text);    
        });
        
        $("#slug").blur(function(){
        this_class.check_slug();
            
        });
        

        var url = window.location.pathname;
        var id = url.substring(url.lastIndexOf('/') + 1);
        if($.isNumeric(id)){
         this_class.get_details_foredit(id)
        }
        
        $("#slug_exist").hide();



},

check_slug: function (){
                var slug = $("input[name='slug']").val();
                var id = $("input[name='id_cms']").val();

                 $.ajax({
                            type: 'POST',
                            url: BASE_URL+'/admin/cms/slug',
                            data: {_token:admin.common.get_csrf_token_value(),slug:slug,id:id},

                            success: function(data) {
                                var data=$.parseJSON(data);
                                if(data.valid == false){
                                    $("input[name='slug']").addClass('has-error');
                                    $("#slug_exist").attr('style','color:red');
                                    $("#slug_exist").show();
                                }
                                else{
                                    $("#slug_exist").hide();
                                    $("input[name='slug']").removeClass('has-error');   
                                }
                    
                            }
                        });
},


get_details_foredit:function (id){
    
    if(id > 0){
        $.ajax({
            url : BASE_URL+'/admin/cms_list/edit',
            type: 'POST',
            data: {_token :admin.common.get_csrf_token_value(), id:id},
            success: function (data) {
                    var data=$.parseJSON(data);
                    if(data.status==1){
                        $("#id_cms").val(data.content.id);
                        $("#title").val(data.content.title);
                        $("#slug").val(data.content.slug_url);
                        $("#description").val(data.content.description);
                        $("#meta_title").val(data.content.meta_title);
                        $("#meta_keyword").val(data.content.meta_keyword);
                        $("#meta_description").val(data.content.meta_description);
                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected","selected");
                }
                }

        });
    }
                else{
                    return false;
                }
    
},



load_cms:function(){
    
    var table= jQuery('.cms-table').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "order": [[ 0, "desc" ]],
                    ajax: {
                        url : BASE_URL+'/admin/cms_list/getdata',
                        type: "POST",
                        data: admin.common.get_csrf_toke_object_data()
                    },
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'title', name: 'title'},
                        { data: 'slug_url', name: 'slug_url'},
                        { data: 'meta_title', name: 'meta_title'},
                        { data: 'meta_keyword', name: 'meta_keyword'},
                        { data: 'created_at', name: 'created_at'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

 
 
 
add_row:function (){
                var _token = $("input[name='_token']").val();
                var title = $("input[name='title']").val();
                var slug = $("input[name='slug']").val();
                var description = $("textarea[name='description']").val();
                var meta_keyword = $("input[name='meta_keyword']").val();
                var meta_title = $("input[name='meta_title']").val();
                var meta_description = $("textarea[name='meta_description']").val();
                
                var demo = document.getElementById("status");
                var status = demo.options[demo.selectedIndex].value;
                
                var count_error = 0;
                if (title.trim() == '') {
                     $("input[name='title']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='title']").removeClass('has-error');
                }
                if (slug.trim() == '') {
                     $("input[name='slug']").addClass('has-error');
                    count_error++;
                   
                }
                else{
//                     $("input[name='slug']").removeClass('has-error');
                }
                
                
                if (description.trim() == '') {
                     $("textarea[name='description']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("textarea[name='description']").removeClass('has-error');
                }
                if (meta_keyword.trim() == '') {
                     $("input[name='meta_keyword']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='meta_keyword']").removeClass('has-error');
                }
                if (meta_title.trim() == '') {
                     $("input[name='meta_title']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='meta_title']").removeClass('has-error');
                }
                if (meta_description.trim() == '') {
                     $("textarea[name='meta_description']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("textarea[name='meta_description']").removeClass('has-error');
                }
                if (status == "") {
                     $("select[name='status']").addClass('has-error');
                    count_error++;
                } else{
                     $("select[name='status']").removeClass('has-error');
                }
                if($(".has-error").length == 0){
                    $.ajax({
                    type:'POST',
                    url: BASE_URL+'/admin/cms/add',
                    data: $('#frm_cms').serialize(),
                    datatype:'json',
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            window.location.href = BASE_URL+'/admin/cms_list';
                        }
                        else{
                            return false;
                        }
                    }
                });
                }
    
},

delete_row:function (id){
    
    if(id > 0){
            $.ajax({
                    url: BASE_URL+'/admin/cms_list/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), id:id},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            admin.cms.load_cms();
                        }
                    }
            });
    }           
            else{
                return false;
            }
    
    
},
//    
};