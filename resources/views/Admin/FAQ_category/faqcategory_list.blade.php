@extends('Admin.layouts.dashboard.main')

@section('pageTitle','Faq Category List')
@section('pageHeadTitle','Faq Category List')

@section('content')

<!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ins_faq_cat">Create New Category</button>
                                </div>  
                                <p id="msg_main"></p>
                            </div>
                            <div class="card-body">
                                    <table class="display nowrap table table-hover table-striped table-bordered faq_category-table" cellspacing="0" width="100%">
                                    <thead>

                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </thead>
                                  </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
@include('Admin.FAQ_category.faqcategory')

@endsection

@section('bottomscript')
<script src="{!! asset('js/module/faqcategory.js')!!}"></script>
<script type="text/javascript">
$(document).ready(function () {
    admin.faq_category.initialize();
});
</script>
@endsection