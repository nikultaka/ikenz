<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>@yield('pageTitle')</title>
    <script src="{{url('js/lib/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap Core CSS -->
    <link href="{{url('css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{url('js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Custom CSS -->
    <link href="{{url('css/helper.css')}}" rel="stylesheet">
    <link href="{{url('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
        
    @yield('headLink')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
<style>
    .has-error{
/*        border: 2px solid red;
        border-radius: 5px;*/
    }
</style>
<script type="text/javascript">
    var admin = {};
    var BASE_URL = "{{ url('/') }}";
</script>
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
    <input type="hidden" value="{{ csrf_token() }}" name='csrf-token' id='csrf-token'>
    
    <!-- Navbar -->
     @include('Admin.layouts.dashboard.navbar')
    <!-- EndNavbar -->
    
    <!-- Main Sidebar Container -->
    @include('Admin.layouts.dashboard.sidebar_menu')
    <!-- End Main Sidebar Container -->
    
    <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">@yield('pageHeadTitle')</h3> </div>
                <div class="col-md-7 align-self-center">
                        <?php echo  (new \App\Helper\CommonHelper)->get_breadcrumb(); ?>
<!--                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>-->
                </div>
            </div>
            
            @yield('content')
            
            <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
            <!-- End footer -->
    </div>
    
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <!--<script src="{{url('js/lib/jquery/jquery.min.js')}}"></script>-->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{url('js/lib/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{url('js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
<!--    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>-->
    
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{url('js/jquery.slimscroll.js')}}"></script>
    <!--Menu sidebar -->
    <!--stickey kit -->
    <script src="{{url('js/lib/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <!--Custom JavaScript -->
    
    <script src="{{url('js/lib/datatables/datatables.min.js')}}"></script>
    <script src="{{url('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>
    <script src="{{url('js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')}}"></script>
    <script src="{{url('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js')}}"></script>
    <script src="{{url('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js')}}"></script>
    <script src="{{url('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js')}}"></script>
    <script src="{{url('js/lib/datatables/datatables-init.js')}}"></script>

    <script src="{{url('js/scripts.js')}}"></script>
    
    <script src="{{url('js/common.js')}}"></script>
    
    @yield('bottomscript')

</body>

</html>
    