@extends('Admin.layouts.login.main')

@section('content')
<body class="hold-transition login-page">
<div class="login-box">
 <div class="login-logo">
     <img src="{{url('img/logo.png')}}" style="width: 300px;">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form role="form" method="POST" action="{{ url('/login') }}">
          {{ csrf_field() }}
        <div class="form-group has-feedback">
          <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}">
          <span class="fa fa-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input id="password" type="password" placeholder="Password" class="form-control" name="password">
          <span class="fa fa-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
<!--              <label>
                <input type="checkbox" name="remember"> Remember Me
              </label>-->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

<!--      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fa fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fa fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>-->
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ url('/password/reset') }}">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{ url('home/register') }}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

@endsection