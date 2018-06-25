admin.testimonial = {
    initialize:function()
    {   
        var this_class = this;

        $('.sub_tes').on('click',function (){
            this_class.add_row();
        });
        
        $('body').on('click','.btnEdit_test',function (){
            var test_id = $(this).data('id'); 
            this_class.edit_row(test_id);
        });
        
        $('body').on('click','.btnDelete_test',function (){
            var test_id = $(this).data('id'); 
            this_class.delete_row(test_id);
        });

        $("#user_photo").change(function() {
            $("#u_photo").show();
            this_class.Image_preview(this);
        });
        
        admin.testimonial.load_testimonial();
        $("#u_photo").hide();  
          

    },


Image_preview: function(input) {

                if (input.files && input.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function(e) {
                    $('#u_photo').attr('src', e.target.result);
                  }

                  reader.readAsDataURL(input.files[0]);
                }
},

load_testimonial:function(){
    
    var table= jQuery('.test-table').DataTable({
                    paging: true,   
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "order": [[ 0, "desc" ]],
                    ajax: {
                    url : BASE_URL+'/admin/testimonial/getdata',
                    type : 'POST',
                    data : admin.common.get_csrf_toke_object_data()
                    },
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'customer_name', name: 'customer_name'},
                        { data: 'feedback', name: 'feedback'},
                        { data: 'user_photo', name: 'user_photo'},
                        { data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    }); 
    
},

 
add_row:function (){
                
                var _token = $("input[name='_token']").val();
                var cus_name = $("input[name='cus_name']").val();
                var feedback = $("textarea[name='feedback']").val();
                var user_photo = $("input[name='user_photo']").val();
                var demo = document.getElementById("status");
                var status = demo.options[demo.selectedIndex].value;
                
                var count_error = 0;
                if (cus_name.trim() == '') {
                     $("input[name='cus_name']").addClass('has-error');
                    count_error++;
                   
                } else{
                     $("input[name='cus_name']").removeClass('has-error');
                }
                if (feedback.trim() == '') {
                    $("textarea[name='feedback']").addClass('has-error');
                    count_error++;
                } else{
                    $("textarea[name='feedback']").removeClass('has-error');
                }
                if (status == "") {
                     $("select[name='status']").addClass('has-error');
                    count_error++;
                } else{
                     $("select[name='status']").removeClass('has-error');
                }
                if(count_error == 0){
                
                    
                   var formData = new FormData($('#frm_testimonial')[0]);
                    $.ajax({
                    url: BASE_URL+'/admin/testimonial/addrecord',
                    type:'POST',
                    data:formData,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg').html(data.msg);
                            $('#msg').attr('style','color:green;');
                            $('#frm_testimonial')[0].reset()
                            admin.testimonial.load_testimonial();
                            $("#ins_tes").modal("hide");
                        }
                        else{
                            return false;
                        }
                    }
                });
                }
    
},


edit_row:function(test_id){
    
    
        if(test_id > 0){
        $.ajax({
            url: BASE_URL+'/admin/testimonial/edit',
            type:'POST',
            data: {_token:admin.common.get_csrf_token_value(), test_id:test_id},
            success: function(data) {
                var data=$.parseJSON(data);
                if(data.status==1){
                    $("#ins_tes").modal("show");
                    $("#u_photo").show();
                      
                    $("#id_test").val(data.content.id);
                    $("#cus_name").val(data.content.customer_name);
                    $("#feedback").val(data.content.feedback);
                    
                    $('#u_photo').attr('src',BASE_URL+'/upload/testimonial/'+ data.content.user_photo);
                    $("#hi_file").val(data.content.user_photo);
                    
                    var status_id = $("#status").val(data.content.status);
                    status_id.attr("selected","selected");
                    admin.testimonial.load_testimonial();
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
                    url: BASE_URL+'/admin/testimonial/delete',
                    type:'POST',
                    data: {_token:admin.common.get_csrf_token_value(), id:id},
                    success: function(data) {
                        var data=$.parseJSON(data);
                        if(data.status==1){
                            $('#msg_main').html(data.msg);
                            $('#msg_main').attr('style','color:green;');
                            admin.testimonial.load_testimonial();
                        }
                    }
            });
    }
    else{
        return false;
    }
    
    
},
    
};