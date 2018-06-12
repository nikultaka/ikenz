
    <section class="content">
        
        <div class="col-xs-12">
    <div class="card card-primary">
          <div class="col-xs-6">
            <!--<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ins_tes" style="margin-bottom: 20px;">Create New</button>-->
          </div>

        <!--        modal-->
        <div class="modal fade" id="ins_tes" role="dialog">
            <div class="modal-dialog">
                
<!--                modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create new account</h4>
                </div>
                <div class="modal-body">
                    
                    <!--<form class="form-horizontal" id="frm_testimonial">-->
                        <form id="frm_testimonial" name="frm_testimonial" action="" onsubmit="return false" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" id="id_manage">
                            <label for="cus_name" class="col-sm-3">Customer Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="cus_name" id="cus_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="feedback" class="col-sm-3">Feedback</label>
                        <div class="col-sm-9">
                            <textarea class="form_control" name="feedback" id="feedback"></textarea>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="user_photo" class="col-sm-3">User Photo</label>
                            <div class="col-sm-9">
                                <input type="file" name="user_photo" id="user_photo" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-3">Status</label>
                            <div class="col-sm-9">
                                <select id="status" name="status">
                                    <option value="">----Select Status----</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                    <option value="-1">Deleted</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary sub_tes" name="submit">Submit</button>
                        </div>
                            </div>
                        
                    </form>
                        
                </div>
                <div class="modal-footer">
                              <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!--<table id="acc_table" class="display" style="width:100%; display: none;"  class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone no</th>
                                    <th>GST No</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone no</th>
                                    <th>GST No</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                        </table>-->
        
                    </div>
                </div>
            </div>
        </div>
        
    <!--</section>-->
</div>

              <!--slcvslvlsvl-->
            <!--</div>-->
          
          </div>
        <!--<div class="col-md-1"></div>-->

    </div>
 <!--</div>-->
</section>
<script src="{!! asset('js/testimonial.js')!!}"></script>
