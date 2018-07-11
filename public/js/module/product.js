admin.product = {
    initialize: function ()
    {
        var this_class = this;

        $('body').on('click', '.btnEdit_product', function () {
            var id = $(this).data('id');
            this_class.edit_row(id);
        });

        $('body').on('click', '.btnDelete_product', function () {
            var id = $(this).data('id');
            this_class.delete_row(id);
        });

        admin.product.load_product();

        admin.product.refresh_validator();

        $('#ins_product').on('hidden.bs.modal', function () {
            $('#frm_product')[0].reset();
            $('#frm_product').bootstrapValidator('resetForm', true);
        })

    },
    load_product: function () {

        var table = jQuery('.product-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [[0, "desc"]],
            ajax: {
                url: BASE_URL + '/admin/product/getdata',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
//                        { data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'title', name: 'title'},
                {data: 'short_description', name: 'short_description'},
                {data: 'price', name: 'price'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });





    },
    refresh_validator: function ()
    {

        $("#frm_product").bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                user_id: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
                title: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
                short_description: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
                price: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
//                description: {
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

                    $.ajax({
                        url: BASE_URL + '/admin/product/addrecord',
                        type: 'POST',
                        data: $('#frm_product').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            var data = $.parseJSON(data);
                            if (data.status == 1) {
                                $("#ins_product").modal("hide");
                                $('#frm_product')[0].reset()
                                $('#msg_main').html(data.msg);
                                $('#msg_main').attr('style', 'color:green;');
                                admin.product.load_product();
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
                url: BASE_URL + '/admin/product/edit',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {

                        $("#id").val(data.content.id);
                        var user_id = $("#user_id").val(data.content.user_id);
                        user_id.attr("selected", "selected");
                        $("#title").val(data.content.title);
                        $("#short_description").val(data.content.short_description);
                        $("#price").val(data.content.price);
                        $("#description").html(data.content.description);


                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected", "selected");
                        $("#ins_product").modal("show");
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
                url: BASE_URL + '/admin/product/delete',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $('#msg_main').html(data.msg);
                        $('#msg_main').attr('style', 'color:green;');
                        admin.product.load_product();
                    }
                }
            });
        }
        else {
            return false;
        }


    },
};