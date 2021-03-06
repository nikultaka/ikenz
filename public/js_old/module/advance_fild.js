admin.advance_custom = {
    
  initialize:function()
  {
      var this_class = this;
      $('body').on('click','.btnDeletefilddetails',function (){
        var fildid = $(this).data('id');
        this_class.delete_row(fildid);
      });
      $('body').on('click','.btnEditfilddetails',function (){
        var fildid = $(this).data('id');
        this_class.edit_row(fildid);
      });
      $('.add-advance-custom-fild-details').on('click',function (){
          this_class.add_row();
      });
       
      admin.advance_custom.load_advance_setting();
        
  },
  load_advance_setting:function(){
      var table= jQuery('.advance_custome_filds_table').DataTable({
                    paging: true,
                    pageLength: 10,
                    bDestroy: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "order": [[ 0, "desc" ]],
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                    ajax: {
                        url: BASE_URL+'/admin/advancesettings/getdata',
                        type: "POST",
                        data: admin.common.get_csrf_toke_object_data()
                    },
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'label', name: 'label'},
                        { data: 'fild_name', name: 'fild_name'},
                        { data: 'fild_value', name: 'fild_value'},
                        { data: 'status', name: 'status'},
                        
                        
                        {data: 'action', name: 'action'},
                            ],
        });
  },
  
  delete_row:function(fildid){
        var _token = $("input[name='_token']").val();
        if(fildid>0){
            $.ajax({
               url : BASE_URL+'/admin/advancesettings/delete',
               type:'post',

               data:{_token:_token,fildid:fildid},
                success: function (data, textStatus, jqXHR) {
                    var data=$.parseJSON(data);
                    if(data.status==1){
                        $('#msg_main').html(data.msg);
                        $('#msg_main').attr('style','color:green;');
                        admin.advance_custom.load_advance_setting();
                    }
                }
            });
        }
        else{
            return false;
        }
  },
  edit_row:function (fildid){
        
    var _token = $("input[name='_token']").val();
    
    if(fildid>0){
        $.ajax({
           url: BASE_URL+'/admin/advancesettings/edit',
           type:'post',
               
           data:{_token:_token,fildid:fildid},
            success: function (data, textStatus, jqXHR) {
                var data=$.parseJSON(data);
                if(data.status==1){
                    $('#fild_id').val(data.msg.id);
                    $('#adc_label').val(data.msg.label);
                    $('#adc_fild_name').val(data.msg.fild_name);
                    $('#adc_fild_value').val(data.msg.fild_value);
                    $('#modalRegisterForm').modal('show');
                }
            }
        });
    }
    else{
        return false;
    }
  },
  add_row:function (){
      var count=0;
    if($('#adc_label').val().trim() == ''){
        $('#adc_label').parent('div').addClass('has-error');
        count++;
    }
    else{
        $('#adc_label').parent('div').removeClass('has-error');
    }
    if($('#adc_fild_name').val().trim() == ''){
        $('#adc_fild_name').parent('div').addClass('has-error');
        count++;
    }
    else{
        $('#adc_fild_name').parent('div').removeClass('has-error');
    }
    if($('#adc_fild_value').val().trim() == ''){
        $('#adc_fild_value').parent('div').addClass('has-error');
        count++;
    }
    else{
        $('#adc_fild_value').parent('div').removeClass('has-error');
    }
    if(count==0){
        $.ajax({
            url: BASE_URL+"/admin/advancesettings/store",
            type:'POST',
            data: $('#advance-custom-fild-form').serialize(),
            datatype:'json',
            success: function(data) {
                var data=$.parseJSON(data);
                if(data.status==1){
                    $('#msg').html(data.msg);
                    $('#msg').attr('style','color:green;');
                    $('#advance-custom-fild-form')[0].reset();
                    admin.advance_custom.load_advance_setting();
                }
            }
        });
    }
    else{
        return false;
    }
  } 
};
