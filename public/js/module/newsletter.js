admin.news_latter = {
    initialize:function()
    {
        var this_class = this;

            $('body').on('click','.btnDelete_news_latter',function (){
            var id = $(this).data('id'); 
            this_class.delete_row(id);
        });

        admin.news_latter.load_news_latter();
          
          

    },

load_news_latter:function(){
    
    var table= jQuery('.news_latter-table').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "order": [[ 0, "desc" ]],
                    ajax: {
                        url : BASE_URL+'/admin/newsletter/getdata',
                        type: "POST",
                        data: admin.common.get_csrf_toke_object_data()
                    },
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'email', name: 'email'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

delete_row:function (id){
    if(id > 0){
            $.ajax({
                    url: BASE_URL+'/admin/newsletter/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), id:id},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            admin.news_latter.load_news_latter();
                        }
                    }
            });
    }           
            else{
                return false;
            }
    
    
},
    
};