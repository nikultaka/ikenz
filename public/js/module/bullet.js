admin.bullet = {
    initialize: function ()
    {
        var this_class = this;

        $("#u_photo").hide();

        $('body').on('click', '.btnEdit_test', function () {
            var id = $(this).data('id');
            this_class.edit_row(id);
        });

        $('body').on('click', '.btnDelete_test', function () {
            var id = $(this).data('id');
            this_class.delete_row(id);
        });
        $('body').on('click', '.btn_publish', function () {
            var id = $(this).data('id');
            this_class.is_publish(id);
        });

        $("#user_photo").change(function () {
            $("#u_photo").show();
            this_class.Image_preview(this);
        });

        admin.bullet.load_bullet();
        admin.bullet.refresh_validator();

        $('#ins_bullet').on('hidden.bs.modal', function () {
            $('#frm_bullet')[0].reset();
            $('#frm_bullet').bootstrapValidator('resetForm', true);
            $("#u_photo").hide();
            $('#u_photo').attr('src', '');
        });

    },
    
    Image_preview: function (input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#u_photo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    },
    load_bullet: function () {

        var table = jQuery('.bullet-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [[0, "desc"]],
            ajax: {
                url: BASE_URL + '/admin/bullet/getdata',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
//                        { data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'image_upload', name: 'image_upload'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

    },
    refresh_validator: function () {
        $("#frm_bullet").bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
                description: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
//                image_upload: {
//                    validators: {
//                        notEmpty: {
//                            message: 'Field required'
//                        }
//                    }
//                },
                status: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
            },
        })
                .on('success.form.bv', function (e) {

                    var formData = new FormData($('#frm_bullet')[0]);
                    $.ajax({
                        url: BASE_URL + '/admin/bullet/addrecord',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        success: function (data) {
                            var data = $.parseJSON(data);
                            if (data.status == 1) {
                                $("#ins_bullet").modal("hide");
                                $('#msg_main').html(data.msg);
                                $('#msg_main').attr('style', 'color:green;');
                                $('#frm_bullet')[0].reset()
                                admin.bullet.load_bullet();
                            }
                            else {
                                return false;
                            }
                        }
                    });
                });

    },
    edit_row: function (id) {

        if (id > 0) {
            $.ajax({
                url: BASE_URL + '/admin/bullet/edit',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $("#u_photo").show();

                        $("#id").val(data.content.id);
                        $("#title").val(data.content.title);
                        $("#description").val(data.content.description);

                        $('#u_photo').attr('src', BASE_URL + '/upload/bullet/thumbnail/' + data.content.image_upload);
                        $("#hdn_file").val(data.content.image_upload);

                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected", "selected");
                        $("#ins_bullet").modal("show");
                        admin.bullet.load_bullet();
                    }
                }
            });
        }
        else {
            return false;
        }

    },
    delete_row: function (id) {

        if (id > 0) {
            $.ajax({
                url: BASE_URL + '/admin/bullet/delete',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $('#msg_main').html(data.msg);
                        $('#msg_main').attr('style', 'color:green;');
                        admin.bullet.load_bullet();
                    }
                }
            });
        }
        else {
            return false;
        }


    },
    
    is_publish: function (id){
        
        if(id > 0){
        
            $.ajax({
                url: BASE_URL + '/admin/bullet/is_publish',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(),id:id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                    }
                }
            });
        }
    },
};