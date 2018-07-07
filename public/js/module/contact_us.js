admin.contact_us = {
    initialize: function ()
    {
        var this_class = this;

        $('.send').on('click', function () {
            this_class.email_send();
        });

        $('body').on('click', '.btnEdit_contact_us', function () {
            var id = $(this).data('id');
            this_class.edit_row(id);
        });

        $('body').on('click', '.btnDelete_contact_us', function () {
            var id = $(this).data('id');
            this_class.delete_row(id);
        });

        admin.contact_us.load_contact_us();
        admin.contact_us.refresh_validator();

        $('body').on('click', '.em_reply', function () {
            var id = $(this).data('id');
            this_class.email_reply(id);
        });

        $(".open-modal").on('click', function () {
            $('#frm_contact_us')[0].reset();
        });
        
        

    },
    load_contact_us: function () {

        var table = jQuery('.contact_us-table').DataTable({
            paging: true,
            pageLength: 10,
            bDestroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            "order": [[0, "desc"]],
            ajax: {
                url: BASE_URL + '/admin/contact_us/getdata',
                type: 'POST',
                data: admin.common.get_csrf_toke_object_data()
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_no', name: 'phone_no'},
                {data: 'description', name: 'description'},
                {data: 'status', name: 'status'},
                {data: 'reply', name: 'reply'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

    },
    
    refresh_validator: function () {
        $("#frm_contact_us").bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Field required'
                        },
                        emailAddress: {
                            message: 'The email address is not valid'
                        },
//                        remote: {
//                            type: 'POST',
//                            url: BASE_URL + '/admin/user/email',
//                            data: function (validator) {
//                                return {
//                                    '_token': admin.common.get_csrf_token_value(),
//                                    email: validator.getFieldElements('email').val(),
//                                    id: $("#id").val()
//                                };
//                            },
//                            message: 'The email is not available',
//                            delay: 2000
//                        }
                    }
                },
                phone_no: {
                            validators: {
                                numeric: {
                                    message: 'Please enter number.'
                                },
                                notEmpty: {
                                    message: 'Field required'
                                },
                                stringLength: {
                                    min: 10,
                                    max: 10,
                                    message: 'Mobile num must be 10 digit long'
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
                url: BASE_URL + '/admin/contact_us/addrecord',
                type: 'POST',
                data: $('#frm_contact_us').serialize(),
                datatype: 'json',
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $('#msg').html(data.msg);
                        $('#msg').attr('style', 'color:green;');
                        $('#frm_contact_us')[0].reset()
                        admin.contact_us.load_contact_us();
                        $("#ins_con").modal("hide");

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
                url: BASE_URL + '/admin/contact_us/edit',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {

                        $("#ins_con").modal("show");
                        $("#id").val(data.content.id);
                        $("#name").val(data.content.name);
                        $("#email").val(data.content.email);
                        $("#phone_no").val(data.content.phone_no);
                        $("#description").val(data.content.description);
                        var status_id = $("#status").val(data.content.status);
                        status_id.attr("selected", "selected");
                        admin.contact_us.load_contact_us();
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
                url: BASE_URL + '/admin/contact_us/delete',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {
                        $('#msg_main').html(data.msg);
                        $('#msg_main').attr('style', 'color:green;');
                        admin.contact_us.load_contact_us();
                    }
                }
            });
        }
        else {
            return false;
        }


    },
    email_reply: function (id) {
        if (id > 0) {
            $.ajax({
                url: BASE_URL + '/admin/contact_us/email',
                type: 'POST',
                data: {_token: admin.common.get_csrf_token_value(), id: id},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.status == 1) {

                        $("#reply_email").modal("show");
                        $("#em_name").val(data.content.email);
                        admin.contact_us.load_contact_us();
                    }
                }
            });
        }
        else {
            return false;
        }

    },
    
    email_send: function (){
     
        $.ajax({
            url: BASE_URL + '/admin/contact_us/email_send',
            type: 'POST',
            data: $('#frm_email_send').serialize(),
            success: function (data) {
                
            }
        });
    }
    
    
};