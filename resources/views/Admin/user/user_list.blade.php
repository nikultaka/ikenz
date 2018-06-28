@extends('Admin.layouts.dashboard.main')


@section('pageTitle','User')
@section('pageHeadTitle','User')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
          <div class="card">
              
            <div class="card-header">
                <div class="col-sm-12">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ins_user"> Create New User </button>
            </div>  
              <p id="msg_main"></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped with-check user-table">
                <thead>
                    
                    <th>Category</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>status</th>
                    <th>Action</th>
                </thead>
              </table>
                      
            </div>
          </div>
        </div> 
        </div>
    </div>
 
</section>


@include('Admin.user.adduser')

@endsection
@section('bottomscript')
<script src="{!! asset('js/module/user.js')!!}"></script>
<script type="text/javascript">
                                $(document).ready(function () {
                                    admin.user.initialize();
                                });
</script>  
@endsection