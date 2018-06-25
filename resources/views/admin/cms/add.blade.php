@extends('Admin.layouts.dashboard.main')

@section('pageTitle','CMS')
@section('pageHeadTitle','CMS')

@section('content')

<!--<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">CMS</h1>
          </div> /.col 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Cms</li>
            </ol>
          </div> /.col 
        </div> /.row 
      </div> /.container-fluid 
</div>-->

<section class="content">
    <div class="container-fluid">
<div class="row">
<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">CMS</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" id="" onclick="return false;" onsubmit="return false;"> 
               {{ csrf_field() }}
                  <div class="card-body">
                    <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="" class="col-sm-2">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="" id="" />
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="" class="col-sm-2">Slug</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="" id="" disabled/>
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                      <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="" class="col-sm-2">Description Editor</label>
                                <div class="col-sm-8">
                                    <textarea id="description" class="form-control" name="description" rows="10" cols="80"></textarea>
                                    <!--<input type="text" class="form-control" name="" id="" />-->
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                      <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="" class="col-sm-2">Meta Keyword</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="" id="" />
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                      <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="" class="col-sm-2">Meta Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="" id="" />
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                      <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="editor" class="col-sm-2">Meta Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="meta_description" name="meta_description" cols="50" rows="5"></textarea>
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                      <div class="row form-group">
                        <div class="col-sm-1"></div>
                                    <label for="status" class="col-sm-2">Status</label>
                                    <div class="col-sm-8">
                                        <select id="status" class="form-control" name="status">
                                            <option value="">----Select Status----</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                            <option value="-1">Deleted</option>
                                        </select>
                                    </div>
                                <div class="col-sm-1"></div>
                                </div>
                  
                </div>
                <div class="card-footer ">
                    <center><button type="submit" class="btn btn-primary site-setting">Submit</button></center>
                </div>
              </form>
            </div>
          
          </div>

    </div>
 </div>
</section>
<script src="{!! asset('js/cms.js')!!}"></script>
<script src="{!! asset('js/components/ckeditor/ckeditor.js')!!}"></script>

@endsection