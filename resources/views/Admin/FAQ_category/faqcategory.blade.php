<section class="content">

    <div class="col-xs-12">
        <div class="card card-primary">
            <!--        modal-->
            <div class="modal fade" id="ins_faq_cat" role="dialog">
                <div class="modal-dialog">

                    <!--                modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Create new category</h4>
                        </div>
                        <div class="modal-body">
                            <p id="msg"></p>
                            <form id="frm_faq_cat" name="frm_faq_cat">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="id_faq_cat" id="id_faq_cat">
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
                                            <!--<option value="-1">Deleted</option>-->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer justify-content-center" >
                            <button type="submit" class="btn btn-primary sub_faq_cat" name="submit">Submit</button>
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
