<section class="content">

    <div class="col-xs-12">
        <div class="card card-primary">
            <!--        modal-->
            <form id="frm_user_cat" name="frm_user_cat" action="" method="post" onsubmit="return false;">
                <div class="modal fade" id="ins_user_cat" role="dialog">
                    <div class="modal-dialog">

                        <!--                modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Create new Role</h4>
                            </div>
                            <div class="modal-body">
                                <p id="msg"></p>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id">
                                    <label for="role_name" class="col-sm-3">Role Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="role_name" id="role_name">
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
                                <button type="submit" class="btn btn-primary sub_user_cat" name="submit">Submit</button>
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
