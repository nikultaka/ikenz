admin.advance_custom = {
    initialize: function ()
    {
        var this_class = this;
        $('body').on('click', '.btnDeletefilddetails', function () {
            var id = $(this).data('id');
            this_class.delete_row(id);
        });
        $('body').on('click', '.btnEditfilddetails', function () {
            var id = $(this).data('id');
            this_class.edit_row(id);
        });

        admin.advance_custom.load_advance_setting();
        admin.advance_custom.refresh_validator();
        $('#modalRegisterForm').on('hidden.bs.modal', function () {
            $('#advance-custom-fild-form')[0].reset();
            $('#advance-custom-fild-form').bootstrapValidator('resetForm', true);
        });
    },
    load_advance_setting: function () {
        var table = jQuery('.advance_custome_filds_table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [[0, "desc"]],
            ajax: {
                url: BASE_URL + '/admin/advancesettings/getdata',
                type: "POST",
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
//                        { data: 'id', name: 'id'},
                {data: 'label', name: 'label'},
                {data: 'fild_name', name: 'fild_name'},
                {data: 'fild_value', name: 'fild_value'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'},
            ],
        });
    },
    delete_row: function (id) {

        if (id > 0) {
            $.ajax({
                url: BASE_URL + '/admin/advancesettings/delete',
                type: 'post',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data, textStatus, jqXHR) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $('#msg_main').html(data.msg);
                        $('#msg_main').attr('style', 'color:green;');
                        admin.advance_custom.load_advance_setting();
                    }
                }
            });
        }
        else {
            return false;
        }
    },
    edit_row: function (id) {

        if (id > 0) {
            $.ajax({
                url: BASE_URL + '/admin/advancesettings/edit',
                type: 'post',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $('#id').val(data.content.id);
                        $('#adc_label').val(data.content.label);
                        $('#adc_fild_name').val(data.content.fild_name);
                        $('#adc_fild_value').val(data.content.fild_value);
                        $('#modalRegisterForm').modal('show');
                    }
                }
            });
        }
        else {
            return false;
        }
    },

    refresh_validator: function () {

        $("#advance-custom-fild-form").bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                adc_label: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
                adc_fild_name: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
                adc_fild_value: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
            },
        })
                .on('success.form.bv', function (e) {
                    $.ajax({
                        url: BASE_URL + "/admin/advancesettings/store",
                        type: 'POST',
                        data: $('#advance-custom-fild-form').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            var data = $.parseJSON(data);
                            if (data.status == 1) {
                                $("#modalRegisterForm").modal("hide");
                                $('#msg_main').html(data.msg);
                                $('#msg_main').attr('style', 'color:green;');
                                $('#advance-custom-fild-form')[0].reset();
                                admin.advance_custom.load_advance_setting();
                            }
                        }
                    });
                });

    }
};
