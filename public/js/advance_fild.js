var table= jQuery('.advance_custome_filds_table').DataTable({
    
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: $('#base_url').val()+'/advancesettings/getdata',
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'label', name: 'label'},
                        { data: 'fild_name', name: 'fild_name'},
                        { data: 'fild_value', name: 'fild_value'},
                        { data: 'status', name: 'status'},
                        
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
    });  



$(document).ready(function() {
   // table.ajax.reload();
});

$('.add-advance-custom-fild-details').on('click',function (){
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
            url: $('#base_url').val()+"/advancesettings/store",
            type:'POST',
            data: $('#advance-custom-fild-form').serialize(),
            datatype:'json',
            success: function(data) {
                var data=$.parseJSON(data);
                if(data.status==1){
                    $('#msg').html(data.msg);
                    $('#msg').attr('style','color:green;');
                    $('#advance-custom-fild-form')[0].reset();
                        table.ajax.reload();
                }
            }
        });
    }
    else{
        return false;
    }
});
