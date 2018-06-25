@extends('Admin.layouts.dashboard.main')

@section('content')
    
   <div id="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Newsletter List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Newsletter List</li>
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
               <p id="msg_main"></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped with-check news_latter-table">
                <thead>
                    
                    <th>ID</th>
                    <th>Email</th>
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


<script src="{!! asset('js/module/newsletter.js')!!}"></script>
<script type="text/javascript">
            $(document).ready(function () {
                admin.news_latter.initialize();
            });
</script>  

@endsection