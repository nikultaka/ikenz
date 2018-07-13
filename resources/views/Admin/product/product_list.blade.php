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

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

		

<script src="{!! asset('js/module/product.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.product.initialize();
        CKEDITOR.replace('description');

    });
</script>  

@endsection