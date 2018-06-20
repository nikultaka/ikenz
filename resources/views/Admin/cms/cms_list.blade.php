@extends('Admin.layouts.dashboard.main')

@section('content')
  
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Setting</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Advance Setting</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
          <div class="card">
              
            <div class="card-header">
                <div class="col-sm-2" style="float: left;">
            <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modalRegisterForm">Add Filds</button>
            
            </div>  
              <p id="msg_main"></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <table class="table table-bordered table-striped with-check advance_custome_filds_table">    
                <thead>
                    
                <th>ID</th>
                <th>Label</th>
                <th>Fild Name</th>
                <th>Fild value</th>
                <th>Status</th>
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

@include('Admin.cms.add')
<script src="{!! asset('js/advance_fild.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
//        admin.advance_custom.initialize();
    });
</script>    
@endsection