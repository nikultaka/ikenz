@extends('Admin.layouts.dashboard.main')

@section('pageTitle','CMS List')
@section('pageHeadTitle','CMS List')

@section('content')

<!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!--<div class="card-header">-->
<!--                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ins_faq_cat">Create New Category</button>
                                </div>  -->
                                <p id="msg_main"></p>
                            <!--</div>-->
                            <div class="card-body">
                                    <table class="display nowrap table table-hover table-striped table-bordered cms-table" cellspacing="0" width="100%">
                                    <thead>

                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Slug URL</th>
                                        <th>Meta Title</th>
                                        <th>Meta Keyword</th>
                                        <th>Created Date</th>
                                        <th>status</th>
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

@endsection

@section('bottomscript')
<script src="{!! asset('js/module/cms.js')!!}"></script>
<script type="text/javascript">
$(document).ready(function () {
     admin.cms.initialize();
});
</script>
@endsection