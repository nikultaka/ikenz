@extends('Admin.layouts.dashboard.main')

@section('pageTitle','CMS')
@section('pageHeadTitle','CMS')

@section('content')

<section class="content">
    <div class="container-fluid">
<div class="row">
<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <form role="form" method="post" id="frm_cms" name="frm_cms" onsubmit="return false"> 
                    {{ csrf_field() }}
                  <div class="card-body">
                    <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="title" class="col-sm-2">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title" id="title" />
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="slug" class="col-sm-2">Slug</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="slug" id="slug" />
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                      <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="description" class="col-sm-2">Description Editor</label>
                                <div class="col-sm-8">
                                    <textarea id="description" class="form-control" name="description" rows="10" cols="80"></textarea>
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="meta_title" class="col-sm-2">Meta Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="meta_title" id="meta_title" />
                                </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-1"></div>
                            <label for="meta_keyword" class="col-sm-2">Meta Keyword</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" />
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
                                        </select>
                                    </div>
                                <div class="col-sm-1"></div>
                                </div>
                  
                </div>
                <div class="card-footer ">
                    <center><button type="submit" class="btn btn-primary sub-cms">Submit</button></center>
                </div>
              </form>
            </div>
          
          </div>

    </div>
 </div>
</section>


<script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script>
  <!--<script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/jquery.min.js"></script>-->
<script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/angular.min.js"></script>


<!--<script src="{!! asset('js/ckeditor.js')!!}"></script>-->
<!--<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>-->
<script src="{!! asset('js/cms.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function (){
        admin.cms.initialize();
    }); 
</script>
<script>
    
    function DemoCtrl() {

  this.foo = 'foo';
  
  CKEDITOR.editorConfig = function (config) {
    config.extraPlugins = 'confighelper';
  };
  CKEDITOR.replace('description');

}

</script>
<!--<script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() }); // convert all text areas to rich text editor on that page
 
        bkLib.onDomLoaded(function() {
             new nicEditor().panelInstance('description');
        }); // convert text area with id area1 to rich text editor.
 
        bkLib.onDomLoaded(function() {
             new nicEditor({fullPanel : true}).panelInstance('meta_description');
        }); // convert text area with id area2 to rich text editor with full panel.
</script>-->
@endsection