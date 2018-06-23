@extends('Admin.layouts.dashboard.main')


@section('pageTitle','Contact us')
@section('pageHeadTitle','Contact us List')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
          <div class="card">
              
            <div class="card-header">
                <div class="col-sm-12">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ins_con"> Create New </button>
            </div>  
              <p id="msg_main"></p>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped with-check contact_us-table">
                <thead>
                    
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Reply</th>
                    <th>Action</th>
                </thead>
              </table>
                      
            </div>
          </div>
        </div>
        </div>
    </div>
 
</section>


@include('Admin.contact_us.contact_us')

@endsection

@section('bottomscript')
<script src="{!! asset('js/module/contact_us.js')!!}"></script>
<script type="text/javascript">
            $(document).ready(function () {
                admin.contact_us.initialize();
            });
</script>
@endsection