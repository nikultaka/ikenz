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
              <li class="breadcrumb-item active">Setting</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


<section class="content">
    <div class="container-fluid">
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10" style="float: right;">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Logo Upload</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <input type="file">
            </div>
          
          </div>
    <div class="col-md-1"></div>

    </div>
 </div>
</section>
