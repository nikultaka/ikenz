@extends('Admin.layouts.dashboard.main')

@section('pageTitle','Testimonial')
@section('pageHeadTitle','Testimonial List')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-sm open-modal" data-toggle="modal" data-target="#ins_tes"> Create Testimonial </button>
                            <p id="msg_main"></p>
                        </div>  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped with-check test-table">
                            <thead>
                            <!--<th>ID</th>-->
                            <th>Customer</th>
                            <th>Feedback</th>
                            <th>User Photo</th>
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


@include('Admin.testimonial.testimonial')

@endsection

@section('bottomscript')

<script src="{!! asset('js/module/testimonial.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.testimonial.initialize();
    });
</script> 
@endsection