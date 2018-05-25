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
              <li class="breadcrumb-item active">Logo Upload</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<section class="content">
    <div class="container-fluid">
<div class="row">
    <div class="col-md-1"></div>
<div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Site Setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" id="site_setting" onclick="return false;" onsubmit="return false;"> 
               {{ csrf_field() }}
                  <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Site Title</label>
                    <input class="form-control" id="site_title" name="site_title" placeholder="Enter Site Title" type="text">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email Address</label>
                    <input class="form-control" id="email_id" name="email_id"  placeholder="Email Address" type="email">
                  </div>
                    <hr>
                        <h3 class="card-title">Smtp setting</h3>
                    <hr>
                    
                  
                  
                </div>
                <!-- /.card-body -->
                <p id="msg" style="color: orange;margin-left: 30px; display: none" ></p>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary site-setting">Submit</button>
                </div>
              </form>
            </div>
          
          </div>
        <div class="col-md-1"></div>

    </div>
 </div>
</section>

@endsection