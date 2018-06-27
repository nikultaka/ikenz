@extends('Admin.layouts.dashboard.main')

@section('pageTitle','Media Upload')
@section('pageHeadTitle','Media Upload')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/basic.css" rel="stylesheet" type="text/css" />
<style>
 
#my-dropzone .message {
    font-family: "Segoe UI Light", "Arial", serif;
    font-weight: 600;
    color: #0087F7;
    font-size: 1.5em;
    letter-spacing: 0.05em;
    text-align: center !important;
}
 
.dropzone {
    border: 2px dashed #0087F7;
    background: white;
    border-radius: 5px;
    min-height: 300px;
    padding: 90px 0;
    vertical-align: baseline;
}

</style>
<!--<link href="{!! asset('css/dropzonecustome.css')!!}" type="text/css">-->
<link href="{!! asset('css/dropzone.css')!!}" type="text/css">
<script type="text/javascript" src="{!! asset('js/dropzone.js')!!}"></script>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Media Upload</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Media Upload</li>
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
                    <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modalImageUpload">Upload Image</button>
                </div>
<!--                <div class="col-sm-2" style="float: left;">
                    <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modalVideoUpload">Upload Video</button>
                </div>-->
 

              <p id="msg_main"></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped with-check media-datatable">    
                <thead>
                    
                <th>id</th>
                <th>Media</th>
                <th>Media Name</th>
                <th>Action</th>
                </thead>
              </table>
                      
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
             
        </div>
    </div>
 
</section>



<!--Model Popup-->
<div class="modal fade" id="modalImageUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Upload media </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Input Select</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="MediaType" >
                            <option value="1">Image</option>
                            <option value="2">Video</option>
                            
                        </select>
                    </div>
                </div>

                <div class="dropzone" id="dropzoneFileUpload">
            </div>
                        

                
                <div class="control-group">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-warning btn-outline btn-rounded m-b-10 m-l-5" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="{!! asset('js/module/media.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        admin.media_upload.ini();
    });
</script>

<script type="text/javascript">

    
        var baseUrl = "{{ url('/') }}";
        var token = "{{ Session::getToken() }}";
        var mediatype = $('select#MediaType option:selected').val();
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
            addRemoveLinks: true,
            url: baseUrl + "/admin/upload-media/upload",
            params: {
                _token: token,
                mediatype:mediatype
            },
            success: function(data) {
                admin.media_upload.load_datatabel();
            }
            
        });
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 250, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
 
            },
        };
        
    </script>
@endsection
