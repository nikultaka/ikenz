$(document).ready(function() {
    
    $(".site-setting").click(function(e){
        
        $.ajax({
                    url: "sitesetting/save_details",
                    type:'POST',
                    data: $('form').serialize(),
                    success: function(data) {
                        var data=JSON.parse(data);
                        $("#msg").show();
                        $("#msg").html(data.msg);
                        
                    }
                });
    });
});