@extends('Admin.layouts.dashboard.main')
        

@section('pageTitle','Media')
@section('pageHeadTitle','Media')

@section('content')
    
        <!--   <div id="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Media Category List</h1>
                    </div> /.col 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Media Category List</li>
                        </ol>
                    </div> /.col 
                </div> /.row 
            </div> /.container-fluid 
          </div>-->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
          <div class="card">
              
            <div class="card-header">
                <div class="col-sm-12">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ins_faq_cat"> Create New Category </button>
            </div>  
              <p id="msg_main"></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped with-check media_category_table">
                <thead>
                    
                    <th>ID</th>
                    <th>Category Name</th>
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


@include('Admin.media.add_category')

<script src="{!! asset('js/module/media.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.media_category.initialize();
    });
</script>

@endsection