@extends('Admin.layouts.dashboard.main')
        

@section('pageTitle','Media Category')
@section('pageHeadTitle','Media Category')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
          <div class="card">
              
            <div class="card-header">
                <div class="col-sm-12">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ins_media"> Create New Category </button>
            </div>  
              <p id="msg_main"></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped with-check media_category_table">
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

          
          <!-- /.card -->
        </div>
            
        </div>
    </div>
 
</section>


@include('Admin.media.add_category')
@endsection
@section('bottomscript')
<script src="{!! asset('js/module/media.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.media_category.initialize();
    });
</script>
@endsection