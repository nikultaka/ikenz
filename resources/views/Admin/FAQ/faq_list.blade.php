@extends('Admin.layouts.dashboard.main')

@section('pageTitle','FAQ List')
@section('pageHeadTitle','Faq List')
@section('content')
    
<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
          <div class="card">
              
            <div class="card-header">
                <div class="col-sm-12">
            <button type="button" class="btn btn-info btn-sm open-modal" data-toggle="modal" data-target="#ins_faq">Create New Faq</button>
            </div>  
              <p id="msg_main"></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped with-check faq-table">
                <thead>
                    
                    <!--<th>ID</th>-->
                    <th>Category Name</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>status</th>
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


@include('Admin.faq.faq')

@endsection

@section('bottomscript')
<script src="{!! asset('js/module/faq.js')!!}"></script>
<script type="text/javascript">
                                $(document).ready(function () {
                                    admin.faq.initialize();
                                });
</script>  
@endsection