<section class="content">

    <div class="col-xs-12">
        <div class="card card-primary">

            <!--        modal-->
            <div class="modal fade" id="ins_tes" role="dialog">
                <div class="modal-dialog">

                    <!--                modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Create new account</h4>
                        </div>
                        <div class="modal-body">
                            <p id="msg"></p>
                            <form id="frm_testimonial" name="frm_testimonial" action="" onsubmit="return false" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="cus_name" class="col-sm-3">Customer Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="cus_name" id="cus_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="feedback" class="col-sm-3">Feedback</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="feedback" id="feedback"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_photo" class="col-sm-3">User Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="user_photo" id="user_photo" />
                                        <input type="hidden" name="hdn_file" id="hdn_file">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <img id="u_photo" src="" alt="No Image" class="form-control" style="height: 100px; width: 100px;"/>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3">Status</label>
                                    <div class="col-sm-9">
                                        <select id="status" class="form-control" name="status">
                                            <option value="">----Select Status----</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer justify-content-center" >
                            <button type="submit" class="btn btn-primary sub_tes" name="submit">Submit</button>
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
