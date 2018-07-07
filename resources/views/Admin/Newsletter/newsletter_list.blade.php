@extends('Admin.layouts.dashboard.main')


@section('pageTitle','Newsletter')
@section('pageHeadTitle','Newsletter')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <p id="msg_main"></p>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped with-check news_latter-table">
                            <thead>
                            <!--<th>ID</th>-->
                            <th>Email</th>
                            <th>status</th>
                            <th>Created Date</th>
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


<script src="{!! asset('js/module/newsletter.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        admin.news_latter.initialize();
    });
</script>  

@endsection