admin.testimonial = {
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

        $("#user_photo").change(function () {
            $("#u_photo").show();
            this_class.Image_preview(this);
        });

        admin.testimonial.load_testimonial();
        admin.testimonial.refresh_validator();

        $('#ins_tes').on('hidden.bs.modal', function () {
            $('#frm_testimonial')[0].reset();
            $('#frm_testimonial').bootstrapValidator('resetForm', true);
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
    load_testimonial: function () {

        var table = jQuery('.test-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [[0, "desc"]],
            ajax: {
                url: BASE_URL + '/admin/testimonial/getdata',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
//                        { data: 'id', name: 'id'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'feedback', name: 'feedback'},
                {data: 'user_photo', name: 'user_photo'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

    },
    refresh_validator: function () {
        $("#frm_testimonial").bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                cus_name: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
                feedback: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
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

                    var formData = new FormData($('#frm_testimonial')[0]);
                    $.ajax({
                        url: BASE_URL + '/admin/testimonial/addrecord',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        success: function (data) {
                            var data = $.parseJSON(data);
                            if (data.status == 1) {
                                $("#ins_tes").modal("hide");
                                $('#msg_main').html(data.msg);
                                $('#msg_main').attr('style', 'color:green;');
                                $('#frm_testimonial')[0].reset()
                                admin.testimonial.load_testimonial();
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
                url: BASE_URL + '/admin/testimonial/edit',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $("#u_photo").show();

                        $("#id").val(data.content.id);
                        $("#cus_name").val(data.content.customer_name);
                        $("#feedback").val(data.content.feedback);

                        $('#u_photo').attr('src', BASE_URL + '/upload/testimonial/thumbnail/' + data.content.user_photo);
                        $("#hdn_file").val(data.content.user_photo);

                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected", "selected");
                        $("#ins_tes").modal("show");
                        admin.testimonial.load_testimonial();
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
                url: BASE_URL + '/admin/testimonial/delete',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $('#msg_main').html(data.msg);
                        $('#msg_main').attr('style', 'color:green;');
                        admin.testimonial.load_testimonial();
                    }
                }
            });
        }
        else {
            return false;
        }


    },
};