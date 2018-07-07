@extends('Admin.layouts.dashboard.main')

@section('pageTitle','User Role')
@section('pageHeadTitle','User Role')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-sm open-modal" data-toggle="modal" data-target="#ins_user_cat"> Create User Role </button>
                        </div>  
                        <p id="msg_main"></p>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped with-check user_role-table">
                            <thead>

                            <!--<th>ID</th>-->
                            <th>Category Name</th>
                            <th>status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</section>

@include('Admin.user.adduser_role')

@endsection
@section('bottomscript')
<script src="{!! asset('js/module/user_role.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.user_role.initialize();
    });
</script>
@endsection