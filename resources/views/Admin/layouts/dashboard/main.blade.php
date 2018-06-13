<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  
<!--  <link rel="stylesheet" href="{{url('css/font-awesome.css')}}" type="text/css">-->
  <link 
  href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('css/adminlte.min.css')}}">
  <!-- iCheck -->
<!--  <link rel="stylesheet" href="{{url('css/blue.css')}}">-->
  <!-- Morris chart -->
<!--  <link rel="stylesheet" href="{{url('css/morris.css')}}">-->
  <!-- jvectormap -->
<!--  <link rel="stylesheet" href="{{url('css/jquery-jvectormap-1.2.2.css')}}">-->
  <!-- Date Picker -->
<!--  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">-->
  <!-- Daterange picker -->
<!--  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">-->
  <!-- bootstrap wysihtml5 - text editor -->
<!--  <link rel="stylesheet" href="{{url('css/bootstrap3-wysihtml5.min.css')}}">-->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
<script src="{{url('js/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
 
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
    .has-error{
        border: 2px solid red;
        border-radius: 5px;
    }
</style>
<script type="text/javascript">
    var admin = {};
    var BASE_URL = "{{ url('/') }}";
</script>
</script>
</head>
<body class="hold-transition sidebar-mini">
    
    <input type="hidden" value="{{ url('/') }}" name='base_url' id='base_url' class="base_url">
<div class="wrapper">
 <!-- Navbar -->
 @include('Admin.layouts.dashboard.navbar')
  <!-- EndNavbar -->
  
  <!-- Main Sidebar Container -->
  @include('Admin.layouts.dashboard.sidebar_menu')
  <!-- End Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @yield('content')
  </div>
  <!--End Content Wrapper. Contains page content -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-alpha
    </div>
  </footer>

</div>


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!--<script src="plugins/morris/morris.min.js"></script>-->
<!-- Sparkline -->
<!--<script src="plugins/sparkline/jquery.sparkline.min.js"></script>-->
<!-- jvectormap -->
<!--<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->
<!-- jQuery Knob Chart -->
<!--<script src="plugins/knob/jquery.knob.js"></script>-->
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<!--<script src="plugins/daterangepicker/daterangepicker.js"></script>-->
<!-- datepicker -->
<!--<script src="plugins/datepicker/bootstrap-datepicker.js"></script>-->
<!-- Bootstrap WYSIHTML5 -->
<!--<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>-->
<!-- Slimscroll -->
<!--<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>-->
<!-- FastClick -->
<script src="{{url('js/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('js/adminlte.js')}}"></script>
<!--<script src="{{url('js/demo.js')}}"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes -->
<!--<script src="dist/js/demo.js"></script>-->
</body>
</html>
    