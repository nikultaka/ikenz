@extends('Admin.layouts.dashboard.main')

@section('pageTitle','Settings')
@section('pageHeadTitle','Settings')
@section('content')

<section class="content">
    <div class="container-fluid">
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Logo Upload</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data" id="logo_upload_form" name="logo_upload_form" > 
               {{ csrf_field() }}
                <div class="card-body">
                    <div id="image_preview"><img id="previewing" src="<?php echo isset($site_logo) ? url('/thumbnail/'.$site_logo) : ''?>" style="width: 100px;" /></div>
                    
                    <input type="hidden" name="logo_image_name" id="logo_image_name" value="">
                  <div class="form-group">
                    <label for="exampleInputFile">Select logo image</label>
                    <div class="input-group">
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" id="setting_logo_upload" name="setting_logo_upload">
                        <label class="custom-file-label logo-upload" for="setting_logo_upload">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="upload_logo">Upload</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <p id="msg" style="color: orange;margin-left: 30px; display: none" ></p>
                
              </form>
            </div>
          
          </div>
    <div class="col-md-1"></div>
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
                    <input class="form-control" id="site_title" name="site_title" placeholder="Enter Site Title" value="{{$site_title}}" type="text">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email Address</label>
                    <input class="form-control" id="email_id" name="email_id" value="{{$user_email}}" placeholder="Email Address" type="email">
                  </div>
                    <hr>
                        <h3 class="card-title">Smtp setting</h3>
                    <hr>
                    
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email Address</label>
                    <input class="form-control" id="smtp_email" name="smtp_email" placeholder="email" value="{{$smtp_email}}" type="email">
                  </div>
                     <div class="form-group">
                    <label for="exampleInputPassword1">password</label>
                    <input class="form-control" id="smtp_password" name="smtp_password" value="{{$smtp_password}}" placeholder="Password" type="password">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">SMTP host</label>
                    <input class="form-control" id="smtp_host" name="smtp_host" placeholder="SMTP host" value="{{$smtp_host}}" type="text">
                  </div>
                     <div class="form-group">
                    <label for="exampleInputPassword1">Port</label>
                    <input class="form-control" id="smtp_port" name="smtp_port" placeholder="Port" value="<?php if(isset($smtp_port) && $smtp_port != '') { echo $smtp_port;}else{'';}?>"type="text">
                  </div>
                  
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
@section('bottomscript')
<script type="text/javascript" src="{!! asset('js/jquery.ajaxfileupload.js')!!}"></script>
<script src="{!! asset('js/module/site_setting.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        admin.site_setting.initialize();
    });
</script>
@endsection