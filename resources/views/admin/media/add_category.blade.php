
<section class="content">

    <div class="col-xs-12">
        <div class="card card-primary">
            <form id="frm_media" name="frm_media" action="" method="post" onsubmit="return false;">
            <!--        modal-->
            <div class="modal fade" id="ins_media" role="dialog">
                <div class="modal-dialog">

                    <!--                modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Create new category</h4>
                        </div>
                        <div class="modal-body">
                            <p id="msg"></p>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="id_media" id="id_media">
                                    <label for="category_name" class="col-sm-3">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="category_name" id="category_name">
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
                                <div class="form-group">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                    </div>
                                </div>


                        </div>
                        <div class="modal-footer justify-content-center" >
                            <button type="submit" class="btn btn-primary sub_media" name="submit">Submit</button>
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</section>

