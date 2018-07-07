<section class="content">

    <div class="col-xs-12">
        <div class="card card-primary">
            <form id="frm_contact_us" name="frm_contact_us" action="" method="post" onsubmit="return false;">
            <!--        modal-->
            <div class="modal fade" id="ins_con" role="dialog">
                <div class="modal-dialog">

                    <!--modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Create new</h4>
                        </div>
                        <div class="modal-body">
                            <p id="msg"></p>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id">
                                    <label for="name" class="col-sm-3">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-3">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" id="email" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone_no" class="col-sm-3">Phone No</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="phone_no" id="phone_no" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-3">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3">Status</label>
                                    <div class="col-sm-9">
                                        <select id="status" name="status" class="form-control">
                                            <option value="">----Select Status----</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer justify-content-center" >
                            <button type="submit" class="btn btn-primary sub_contact_us" name="submit">Submit</button>
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <div class="modal fade" id="reply_email" role="dialog">
                <div class="modal-dialog">

                    <form id="frm_email_send" name="frm_email_send" action="" method="post" onsubmit="return false;">
                    <!--modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Reply to user</h4>
                        </div>
                        <div class="modal-body">
                            <p id="msg"></p>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="" id="">
                                    <label for="em_name" class="col-sm-3">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="em_name" id="em_name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="col-sm-3">Subject</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="subject" id="subject" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reply" class="col-sm-3">Reply</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="reply" id="reply"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer justify-content-center" >
                            <button type="submit" class="btn btn-primary send" name="submit">Send</button>
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>

        </div>
    </div>
</section>  
