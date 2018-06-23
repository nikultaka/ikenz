@extends('Admin.layouts.dashboard.main')

@section('content')

<!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
<!--                            <div class="card-header">
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#ins_faq_cat"> Create New Category </button>
                                </div>  
                                <p id="msg_main"></p>
                            </div>-->
                            <div class="card-body">
                                <h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                <div class="table-responsive m-t-40">
                                    
                                    <table class="display nowrap table table-hover table-striped table-bordered faq_category-table" cellspacing="0" width="100%">
                                    <thead>

                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </thead>
                                  </table>
                                </div>
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