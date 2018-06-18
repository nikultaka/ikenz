<section class="content">

    <div class="col-xs-12">
        <div class="card card-primary">
            <!--        modal-->
            <div class="modal fade" id="ins_faq" role="dialog">
                <div class="modal-dialog">

                    <!--modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Create new faq</h4>
                        </div>
                        <div class="modal-body">
                            <p id="msg"></p>
                            <form id="frm_faq" name="frm_faq">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="hidden" name="id_faq" id="id_faq">
                                        <label for="category_id" class="col-sm-3">Category</label>
                                    <div class="col-sm-9">
                                        <select id="category_id" name="category_id" class="form-control">
                                            <option value="">----Select Category----</option>
                                            @if($cate_id > 0)
                                                @foreach($cate_id as $category)
                                                 <option value="{{$category->id}}">{{$category  ->category_name}}</option>
                                                @endForeach
                                                @else
                                                 No Record Found
                                                  @endif 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="question" class="col-sm-3">Question</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="question" id="question" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="answer" class="col-sm-3">Answer</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="answer" id="answer" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3">Status</label>
                                    <div class="col-sm-9">
                                        <select id="status" name="status" class="form-control">
                                            <option value="">----Select Status----</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                            <option value="-1">Deleted</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer justify-content-center" >
                            <button type="submit" class="btn btn-primary sub_faq" name="submit">Submit</button>
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{!! asset('js/faq.js')!!}"></script>
<script type="text/javascript">
                                $(document).ready(function () {
                                    admin.faq.initialize();
                                });
</script>  
