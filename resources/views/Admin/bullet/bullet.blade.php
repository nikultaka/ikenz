<section class="content">

    <div class="col-xs-12">
        <div class="card card-primary">

            <form id="frm_bullet" name="frm_bullet" action="" onsubmit="return false" enctype="multipart/form-data">
                <!--        modal-->
                <div class="modal fade" id="ins_bullet" role="dialog">
                    <div class="modal-dialog">

                        <!--                modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Create new account</h4>
                            </div>
                            <div class="modal-body">
                                <p id="msg"></p>
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="title" class="col-sm-3">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="title" id="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-3">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image_upload" class="col-sm-3">User Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="image_upload" id="image_upload" />
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

                            </div>
                            <div class="modal-footer justify-content-center" >
                                <button type="submit" class="btn btn-primary sub_tes" name="submit">Submit</button>
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

