admin.faq_category = {
    initialize: function ()
    {
        var this_class = this;

        $('body').on('click', '.btnEdit_faqcat', function () {
            var id = $(this).data('id');
            this_class.edit_row(id);
        });

        $('body').on('click', '.btnDelete_faqcat', function () {
            var id = $(this).data('id');
            this_class.delete_row(id);
        });

        admin.faq_category.load_faq_category();
        admin.faq_category.refresh_validator();

        $('#ins_faq_cat').on('hidden.bs.modal', function () {
            $('#frm_faq_cat')[0].reset();
            $('#frm_faq_cat').bootstrapValidator('resetForm', true);
        });

    },
    load_faq_category: function () {

        var table = jQuery('.faq_category-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [[0, "desc"]],
            ajax: {
                url: BASE_URL + '/admin/faq_category/getdata',
                type: "POST",
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
//                        { data: 'id', name: 'id'},
                {data: 'category_name', name: 'category_name'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

    },
    refresh_validator: function () {
        $("#frm_faq_cat").bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                category_name: {
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
                    $.ajax({
                        url: BASE_URL + '/admin/faq_category/addrecord',
                        type: 'POST',
                        data: $('#frm_faq_cat').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            var data = $.parseJSON(data);
                            if (data.status == 1) {
                                $("#ins_faq_cat").modal("hide");
                                $('#frm_faq_cat')[0].reset()
                                $('#msg_main').html(data.msg);
                                $('#msg_main').attr('style', 'color:green;');
                                admin.faq_category.load_faq_category();
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
                url: BASE_URL + '/admin/faq_category/edit',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {

                        $("#id").val(data.content.id);
                        $("#category_name").val(data.content.category_name);
                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected", "selected");
                        $("#ins_faq_cat").modal("show");
                        admin.faq_category.load_faq_category();
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
                url: BASE_URL + '/admin/faq_category/delete',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $('#msg_main').html(data.msg);
                        $('#msg_main').attr('style', 'color:green;');
                        admin.faq_category.load_faq_category();
                    }
                }
            });
        }
        else {
            return false;
        }


    },
};