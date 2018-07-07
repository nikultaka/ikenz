admin.site_setting = {
    initialize: function ()
    {
        var this_class = this;
        $(".site-setting").click(function (e) {
            this_class.SaveFormDetails();
        });
        $("#setting_logo_upload").change(function () {
            this_class.readURL(this);
        });
        $("#upload_logo").on('click', function () {
            this_class.UploadLogoImage();
        });

    },
    SaveFormDetails: function () {
        $.ajax({
            url: BASE_URL + "/admin/sitesetting/save_details",
            type: 'POST',
            data: $('form').serialize(),
            success: function (data) {
                var data = JSON.parse(data);
                $("#msg").show();
                $("#msg").html(data.msg);

            }
        });
    },
    readURL: function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#previewing').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    },
    UploadLogoImage: function () {
        var formData = new FormData($('#logo_upload_form')[0]);
        $.ajax({
            url: BASE_URL + "/admin/sitesetting/uploadlogo",
            type: 'POST',
            data: formData,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.status == 1) {
                    // $('#previewing').attr('src', BASE_URL +'/thumbnail/'+data.data)
                    $('#logo_image_name').val(data.data);
                }

            }
        });
    }
};

