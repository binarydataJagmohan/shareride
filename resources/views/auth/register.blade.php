@extends('layouts.app')
@section('title','Signup')
@section('content')
<style>
    .form-control:focus {
        border-color:unset;
    }
    .main-menu a.main-logo {
    width: 200px;
    margin-left: 65px;
}
#register-form .form-group{
    display: block;
}
.error{
    color:red;
}
</style>
    <div class="container py-5">
        <div class="form-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-container">
                            <h3 class="text-center">Sign in to Shareride</h3>
                            <form method="POST" action="{{ route('register') }}" class="form-horizontal" id="register-form">
                                @csrf
                                <h6>Sign in to your account with:</h6>
                                <div class="userid text-center">
                                    <a href="{{ url('auth/facebook') }}" class="form-control position-relative mb-3">
                                        <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-social-facebook.76512ffeaf2e.png" alt="">
                                        facebook
                                    </a>
                                   <a href="{{ url('authorized/google') }}" class="form-control position-relative mb-3">
                                        <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-social-google.1446d6483197.png" alt="">
                                        Google
                                    </a>
                                </div>
                                <h6>Or, sign up with your email (all fields required)
                                    <p class="phead">Already a member?<a href="{{url('login')}}" class="alread"> Log in with your email</a></p>
                                </h6>
                                <div class="form-group mb-3">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="First Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input id="last_name" type="text" class="form-control @error('name') is-invalid @enderror" name="last_name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Last Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input id="passwordconfirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                </div>
                                 <div class="form-group mb-3">
                                    <div class="g-recaptcha" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" required></div>
                                </div>
                                @error('g-recaptcha-response')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                               @enderror 
                                <button class="register1" type="submit">Sign up</button>
                                <span class="forgot-pass"><a href="{{url('forget-password')}}">Forgot your password?
                                    </a></span>
                                <hr>
                                <div class="rister">
                                    <p>Not feeling social? <a href="{{url('login')}}">Login up with your email</a> </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
            $(document).ready(function() {
                $('#register-form').validate({
                   rules : {
                      name:{
                          required: true,
                      },
                       last_name:{
                          required: true,
                      }, 
                      email:{
                          required: true,
                      },
                      password:{
                          required: true,
                      },
                       passwordconfirm:{
                          required: true,
                      },
                   },
                   messages:{
                       name:{
                           required:"Please enter your name"
                           }, 
                       last_name:{
                           required:"Please enter your last name"
                           }, 
                       email:{
                           required:"Please enter your email"
                           },
                       password:{
                           required:"Please enter your password"
                           },
                      passwordconfirm:{
                           required:"Please enter your confirm password"
                        },
                   },
                });
            });
        </script>
@endsection