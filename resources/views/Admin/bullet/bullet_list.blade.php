@extends('Admin.layouts.dashboard.main')

@section('pageTitle','Bullet')
@section('pageHeadTitle','Bullet List')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-sm open-modal" data-toggle="modal" data-target="#ins_bullet"> Create Bullet </button>
                            <center><p id="msg_main"></p></center>
                        </div>  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped with-check bullet-table">
                            <thead>
                            <!--<th>ID</th>-->
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>status</th>
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


@include('Admin.bullet.bullet')

@endsection

@section('bottomscript')

<script src="{!! asset('js/module/bullet.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.bullet.initialize();
    });
</script> 
@endsection