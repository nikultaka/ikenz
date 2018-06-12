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



<!--Model Popup-->
<form id="advance-custom-fild-form" onsubmit="return false;" data-toggle="validator" role="form">

		{{ csrf_field() }}
<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Custom fild </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="msg"></p>
                <input type="hidden" name="fild_id" id="fild_id" value="">
                <div class="control-group">
                    <label class="control-label">Label</label>
                    <div class="controls">
                      <input type="text" class="form-control" id="adc_label" name="adc_label" placeholder="Please enter label name" >
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Fild name</label>
                    <div class="controls">
                      <input type="text" class="form-control" id="adc_fild_name" name="adc_fild_name" placeholder="Please enter fild name" required>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Fild Value</label>
                    <div class="controls">
                      <input type="text" class="form-control" id="adc_fild_value" name="adc_fild_value" placeholder="Please enter fild value" required>
                    </div>
                </div>
                
                
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-deep-orange btn-info add-advance-custom-fild-details">Save</button>
            </div>
        </div>
    </div>
</div>
</form>
<script src="{!! asset('js/advance_fild.js')!!}"></script>
@endsection