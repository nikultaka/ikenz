@extends('Admin.layouts.dashboard.main')

@section('pageTitle','Advance Settings')
@section('pageHeadTitle','Advance Settings')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
          <div class="card">
              
            <div class="card-header">
                <div class="col-sm-12">
            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalRegisterForm">Add Filds</button>
            
            </div>  
              <p id="msg_main"></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <table class="table table-bordered table-striped with-check advance_custome_filds_table">    
                <thead>
                    
                <!--<th>ID</th>-->
                <th>Label</th>
                <th>Fild Name</th>
                <th>Fild value</th>
                <th>Status</th>
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



<!--Model Popup-->
<form id="advance-custom-fild-form" name="advance-custom-fild-form" method="post" action="" onsubmit="return false;" >

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
                <input type="hidden" name="id" id="id" value="">
                <div class="form-group">
                    <label class="control-label col-sm-3">Label</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="adc_label" name="adc_label" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Fild name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="adc_fild_name" name="adc_fild_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Fild Value</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="adc_fild_value" name="adc_fild_value" >
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" name="submit" class="btn btn-deep-orange btn-info add-advance-custom-fild-details">Save</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
@section('bottomscript')
<script src="{!! asset('js/module/advance_fild.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        admin.advance_custom.initialize();
    });
</script>    
@endsection