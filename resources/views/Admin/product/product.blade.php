<section class="content">

    <div class="col-xs-12">
        <div class="card card-primary">
            <!--        modal-->
            <form id="frm_product" name="frm_product" action="" method="post" onsubmit="return false;">
                <div class="modal fade commonModel" id="ins_product" role="dialog">
                    <div class="modal-dialog modal-lg" style="top:0 !important; transform:translateY(0%) !important; width: 1000px !important;">

                        <!--modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Create new Product</h4>
                            </div>
                            <div class="modal-body">
                                <p id="msg"></p>

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id">
                                    <label for="user_id" class="col-sm-12">Users</label>
                                    <div class="col-sm-12">
                                        <select id="user_id" name="user_id" class="form-control">
                                            <option value="">----Select User----</option>
                                            @if($user > 0)
                                            @foreach($user as $row)
                                            <option value="{{$row->id}}">{{$row ->name}}</option>
                                            @endForeach
                                            @else
                                            No Record Found
                                            @endif 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-12">Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="title" id="title" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="short_description" class="col-sm-12">Short Description</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="short_description" id="short_description" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price" class="col-sm-12">Price</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="price" id="price" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-12">Description</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-12">Status</label>
                                    <div class="col-sm-12">
                                        <select id="status" name="status" class="form-control">
                                            <option value="">----Select Status----</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-center" >
                                <button type="submit" class="btn btn-primary sub_product" name="submit">Submit</button>
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
