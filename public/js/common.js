admin.common = {
    initialize:function()
    {
    },
    get_csrf_token_value:function(){
        return $("#csrf-token").val();
    },
    get_csrf_toke_object_data:function(){
        var data = {};
        data._token = this.get_csrf_token_value();
        return data;
    },
    get_csrf_toke_array_data:function(){
        var data = [];
        data['_token'] = this.get_csrf_token_value();
        return data;
    },
    get_success_msg:function (msg){
        var data = [];
        data = $('#msg_main').text(msg);
        data = $('#msg_main').attr('style', 'color:green;');;
        data = setTimeout(function(){ $('#msg_main').hide(); }, 3000);
        return data;
    }
    
};