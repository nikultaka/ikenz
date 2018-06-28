<?php // print_r($user_role); exit;?>
<section class="content">

    <div class="col-xs-12">
        <div class="card card-primary">
            <!--        modal-->
            <div class="modal fade" id="ins_user" role="dialog">
                <div class="modal-dialog">

                    <!--modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Create new User</h4>
                        </div>
                        <div class="modal-body">
                            <p id="msg"></p>
                            <form id="frm_user" name="frm_user">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id">
                                    <label for="role_name" class="col-sm-3">Category</label>
                                    <div class="col-sm-9">
                                        <select id="role_name" name="role_name" class="form-control">
                                            <option value="">----Select Category----</option>
                                            @if($user_role > 0)
                                                @foreach($user_role as $category)
                                                 <option value="{{$category->id}}">{{$category  ->role_name}}</option>
                                                @endForeach
                                                @else
                                                 No Record Found
                                                  @endif 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="u_name" class="col-sm-3">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="u_name" id="u_name" />
                                    </div>
                                </div>
<!--                                <div class="form-group">
                                    <label for="l_name" class="col-sm-3">Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="l_name" id="l_name" />
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="email" class="col-sm-3">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" id="email" />
                                        <div id="email_ch"><p>Email already exist</p></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" id="password" />
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
                            </form>

                        </div>
                        <div class="modal-footer justify-content-center" >
                            <button type="submit" class="btn btn-primary sub_user" name="submit">Submit</button>
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
