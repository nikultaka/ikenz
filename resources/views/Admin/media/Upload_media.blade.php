@extends('Admin.layouts.dashboard.main')

@section('pageTitle','Media Upload')
@section('pageHeadTitle','Media Upload')
@section('headLink')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/basic.css" rel="stylesheet" type="text/css" />
<link href="{!! asset('css/dropzone.css')!!}" type="text/css">
<script type="text/javascript" src="{!! asset('js/dropzone.js')!!}"></script>

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

@endsection
@section('content')
<!--<link href="{!! asset('css/dropzonecustome.css')!!}" type="text/css">-->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
          <div class="card">
              
            <div class="card-header">

                <div class="col-sm-2" style="float: left;">
                    <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modalImageUpload">Upload Media</button>
                </div>
                 

              <p id="msg_main"></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped with-check media-datatable">    
                <thead>
                    
                <th>id</th>
                <th>Media</th>
                <th>Media category</th>
                <th>Media Name</th>
                <th>Media Type</th>
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
                    
                    <label class="col-sm-12 control-label ">Media Type</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="MediaType" >
                            <option value="1">Image</option>
                            <option value="2">Video</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    
                    <label class="col-sm-12 control-label ">Media Category</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="MediaCategory">
                        @if($media_category)
                        @foreach($media_category as $media)
                         <option  value="{{$media->id}}">{{$media->category_name}}</option>
                        @endForeach
                        @else
                        <option  value="0">No Record Found</option>
                        @endif   
                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    
                    <label class="col-sm-12 control-label ">Upload Media</label>
                    <div class="col-sm-10">
                
                        <div class="dropzone" id="dropzoneFileUpload">
                            <input type="hidden" id="mediaTypehidden" value="1">
                        </div>
                    </div>
                </div>    
                <div id="video-section" style="display: none;">    
                    <form method="post" onsubmit="return false" id="VideoUploadForm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <video width="400" controls>
                      <source src="" id="video_here">
                        Your browser does not support HTML5 video.
                    </video>
                    <div class="form-group">
                    <label class="col-sm-12 control-label">Select Video </label>
                    <div class="col-sm-10">
                    <div class="input-group">
                      <div class="custom-file">
                          <input class="custom-file-input file_multi_video" accept="video/*" id="setting_logo_upload" name="file" type="file">
                        <label class="custom-file-label logo-upload" for="setting_logo_upload">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="upload_video">Upload</span>
                      </div>
                    </div>
                    </div>
                  </div>
                    <div> <h1 style="text-align: center;">OR</h1></div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Enter Video URL </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                              <div class="custom-file">
                                 <input type="text" class="form-control" name="media_url" id="media_url">
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="submit_video_url">Submit</span>
                              </div>
                            </div>
                        </div>
                  </div>
                   </form>
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



@endsection
@section('bottomscript')
<script src="{!! asset('js/module/media.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        admin.media_upload.ini();
    });
</script>

<script type="text/javascript">

    
        var baseUrl = "{{ url('/') }}";
        var token = "{{ Session::getToken() }}";
        
        var mediatype = $('#mediaTypehidden').val();
        
        Dropzone.autoDiscover = false;
        
        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            url: baseUrl + "/admin/upload-media/upload",
            params: {
                mediatype: $('#mediaTypehidden').val(),
                _token: token,
               
            },
            init: function() {
                 this.on("sending", function(file, xhr, formData){
                    formData.append("mediatype", $('#mediaTypehidden').val());
                    formData.append("media_category", $('select#MediaCategory option:selected').val());
                });
                this.on("complete", function(file) {
                    $(".dz-remove").html('<div class="datatable_btn"><a data-id="" id="image_delete_btn" class="btn btn-xs btn-danger btnDeleteMediaUploded"> Delete</a></div>');
                });

                this.on("success", function(file, response) {
                    $('#image_delete_btn').data('id',response.id);
                     admin.media_upload.load_datatabel();
                 })

            },
            
        });
        
        
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 250, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
 
            },
        };
        $('#MediaType').on('change',function (){
           var valuechange = $('select#MediaType option:selected').val(); 
           $('#mediaTypehidden').val(valuechange);
           if(valuechange==1){
               $('#video-section').hide();
               $('#dropzoneFileUpload').show();
           }
           else if(valuechange==2){
               $('#video-section').show();
               $('#dropzoneFileUpload').hide();
           }
           else{
               return false;
           }
        });
        $(document).on("change", ".file_multi_video", function(evt) {
            var $source = $('#video_here');
            $source[0].src = URL.createObjectURL(this.files[0]);
            $source.parent()[0].load();
        });
        
    </script>
@endsection
