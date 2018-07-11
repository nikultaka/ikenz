@extends('Admin.layouts.dashboard.main')

@section('pageTitle','Product')
@section('pageHeadTitle','Product List')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ins_product">Create New Product</button>
                        </div>  
                        <p id="msg_main"></p>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped with-check product-table">
                            <thead>
                            <!--<th>ID</th>-->
                            <th>Name</th>
                            <th>Title</th>
                            <th>Short Des</th>
                            <th>Price</th>
                            <th>status</th>
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


@include('Admin.product.product')

@endsection

@section('bottomscript')
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>-->
		

<script src="{!! asset('js/module/product.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.product.initialize();
        CKEDITOR.replace('description');
        
        // Initialize select2
//        $("#user_id").select2();
//
//        // Read selected option
//        $('#but_read').click(function(){
//          var username = $('#user_id option:selected').text();
//          var userid = $('#user_id').val();
//
//          $('#result').html("id : " + userid + ", name : " + username);
//
//        });

    });
</script>  

@endsection