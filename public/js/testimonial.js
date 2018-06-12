var table= jQuery('.test-table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: 'testimonial/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'customer_name', name: 'customer_name'},
                        { data: 'feedback', name: 'feedback'},
                        { data: 'user_photo', name: 'user_photo'},
                        { data: 'status', name: 'status'},
                        { data: 'created_date', name: 'created_date'},
                        { data: 'updated_date', name: 'updated_date'},
//                        { data: 'edit', name: 'edit'},
//                        { data: 'delete', name: 'delete'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    });  
    
    
$(document).ready(function() {
           table.ajax.reload();
//                alert("dasd");
            $(".sub_tes").click(function(e){
                
                e.preventDefault();
//                var demo = document.getElementById("block_list");
//                var block_id = demo.options[demo.selectedIndex].value;
//                
                var _token = $("input[name='_token']").val();
                var cus_name = $("input[name='cus_name']").val();
                var feedback = $("textarea[name='feedback']").val();
                var user_photo = $("input[name='user_photo']").val();
                var demo = document.getElementById("status");
                var status = demo.options[demo.selectedIndex].value;
                
//                var status = $("input[name='status']").val();
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
                if (user_photo.trim() == '') {
                     $("input[name='user_photo']").addClass('has-error');
                    count_error++;
                } else{
                    $("input[name='user_photo']").removeClass('has-error');
                }
                if (status == "") {
                     $("select[name='status']").addClass('has-error');
                    count_error++;
                } else{
                     $("select[name='status']").removeClass('has-error');
                }
                if(count_error == 0){
//                    
                   var formData = new FormData($('#frm_testimonial')[0]);
                    $.ajax({
                    url: 'testimonial/addrecord',
                    type:'POST',
                    data:formData,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function(data) {
                            
                            table.ajax.reload();
                            $('#frm_testimonialddd')[0].reset()

                    }
                });
                }
            })
            }); 
            
function delete_test(id){
        var _token = $("input[name='_token']").val();
             $.ajax({
                    url: 'testimonial/delete',
                    type:'POST',
                    data: {_token:_token, id:id},
                    success: function(data) {
                        if(data.status==1){
                            alert(data.msg);
                            table.ajax.reload();
                        }
                    }
                })
               
}