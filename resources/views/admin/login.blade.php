@extends('admin.layouts.login.main')

@section('content')


<div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                                <h4>Login</h4>
                                <form role="form" method="POST" action="{{ url('/admin/login') }}">
                                {{ csrf_field() }}
                                    <div class="form-group has-feedback">
                                        <label>Email address</label>
                                        <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Password</label>
                                        <input id="password" type="password" placeholder="Password" class="form-control" name="password">
                                    </div>
                                    <div class="checkbox has-feedback">
                                        <label><input type="checkbox"> Remember Me</label>
                                        <label class="pull-right"><a href="{{ url('/password/reset') }}">Forgotten Password?</a></label>

                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection